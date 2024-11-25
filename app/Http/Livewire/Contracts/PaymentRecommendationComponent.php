<?php

namespace App\Http\Livewire\Contracts;

use Livewire\Component;
use App\Models\Contract;
use App\Models\ContractorPaymentHistory;
use App\Models\PaymentRequest;
use App\Models\PpProjectBoq;
use Illuminate\Support\Facades\DB;

class PaymentRecommendationComponent extends Component
{
    public $recommendedAmount;
    public $recommendedPercentage;
    public $remarks;

    public $vatRate = 0;        // Default VAT rate
    public $vatAmount = 0;

    public $cumulativeTotal = 0;
    public $totalWithVAT = 0;

    // public $contract;
    public $inputs = []; // Store each row's data with percentage, recommended_amount, and remaining_balance

    public function mount($contractId)
    {
        $this->contract = Contract::with(['paymentRequests' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->find($contractId);

        if (!$this->contract) {
            $this->dispatchBrowserEvent('error', ["error" => "Contract not found."]);
        }

        foreach ($this->contract->projects->boqs as $key => $boq) {
            $initialBalance  = $boq->unit_price * $boq->quantity;
            $this->inputs[$key] = [
                'id' => $boq->id,
                'item' => $boq->item,
                'description' => $boq->description,
                'unit_price' => $boq->unit_price,
                'quantity' => $boq->quantity,
                'percentage' => 0,
                'recommended_amount' => 0,
                'initial_balance' => $initialBalance, // Store initial total amount
                'remaining_balance' => $boq->remaining_balance ?? $initialBalance, // Initialize remaining balance
            ];
        }
        $this->calculateCumulativeTotal();
        $this->calculateVAT();
    }

    public function updatePayment($key)
    {
        $percentage = $this->inputs[$key]['percentage'];

        // Ensure the percentage is within a valid range
        if ($percentage === null || $percentage < 0 || $percentage > 100) {
            $this->dispatchBrowserEvent('error', ["error" => "You have entered an invalid percentage value"]);
            return;
        }

        // Calculate recommended amount based on initial balance and percentage
        $initial_balance = $this->inputs[$key]['initial_balance'];
        $recommended_amount = ((double)$percentage / 100) * $initial_balance;

        // Ensure recommended amount does not exceed the remaining balance
        $remaining_balance = $this->inputs[$key]['remaining_balance'];

        if ($recommended_amount > $remaining_balance) {
            // Calculate the maximum percentage the user could enter
            $max_percentage = ($remaining_balance / $initial_balance) * 100;

            // Display error message with remaining amount and maximum allowable percentage
            $this->dispatchBrowserEvent('error', [
                "error" => "The recommended amount exceeds the remaining balance. 
                            You can only enter up to $remaining_balance or $max_percentage%."
            ]);

            // Do not update recommended amount or remaining balance, exit early
            return;
        }

        // Update recommended amount and remaining balance only when valid
        $this->inputs[$key]['recommended_amount'] = $recommended_amount;
        $this->inputs[$key]['remaining_balance'] = $remaining_balance - $recommended_amount;

        // Recalculate the cumulative total and VAT
        $this->calculateCumulativeTotal();
        $this->calculateVAT();
    }



    public function calculateCumulativeTotal()
    {
        $this->cumulativeTotal = array_sum(array_column($this->inputs, 'recommended_amount'));
        $this->calculateVAT();
    }

    public function calculateVAT()
    {
        $this->vatAmount = ($this->cumulativeTotal * (double)$this->vatRate) / 100;
        $this->totalWithVAT = $this->cumulativeTotal + $this->vatAmount;
    }

    public function saveRecommendations()
    {
        foreach ($this->inputs as $input) {
            if (isset($input['id']) && isset($input['remaining_balance'])) {
                $boq = PpProjectBoq::find($input['id']);
                if ($boq) {
                    $boq->remaining_balance = $input['remaining_balance'];
                    $boq->save();
                } else {
                    $this->dispatchBrowserEvent('error',["error" =>"BOQ item with ID {$input['id']} not found."]);
                }
            } else {
                $this->dispatchBrowserEvent('error',["error" =>"ID or remaining_balance missing for input", $input]);
            }
        }

        $payment = PaymentRequest::create([
            'contract_id' => $this->contract->id,
            'recommended_amount' => $this->totalWithVAT,
            'recommended_percentage' => '',
            'recommended_by' => auth()->id(),
            'status' => 'recommended',
            'remarks' => $this->remarks,
        ]);
        $this->dispatchBrowserEvent('success',["success" =>"Payment recommendation submitted."]);
    }

    public function render()
    {
        $paymentRequests = $this->contract ? $this->contract->paymentRequests : collect();

        return view('livewire.contracts.payment-recommendation-component',[
            'recommendations' => $paymentRequests,
        ]);
    }
}
