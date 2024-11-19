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

    public $includeVAT = false;   // Checkbox for VAT inclusion
    public $vatRate = 7.5;        // Default VAT rate
    public $vatAmount = 0;
    // public $totalAmount = 0;

    public $cumulativeTotal = 0;

    // public $contract;
    public $inputs = []; // Store each row's data with percentage, recommended_amount, and remaining_balance

    public function mount($contractId)
    {
        // $this->contract = Contract::with('paymentRequests')->find($contractId);
        // if (!$this->contract) {
        //     $this->dispatchBrowserEvent('error',["error" =>"Contract not found."]);
        // }

        $this->contract = Contract::with(['paymentRequests' => function ($query) {
            $query->orderBy('created_at', 'desc'); // Sorts by 'created_at' in descending order
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

    }

    public function updatePayment($key)
    {
        $percentage = $this->inputs[$key]['percentage'];

        // Ensure the percentage is within a valid range
        if ($percentage === null || $percentage < 0 || $percentage > 100) {
            $this->dispatchBrowserEvent('error',["error" =>"You have entered an invalid perccentage value"]);
            return;
        }

        $initial_balance = $this->inputs[$key]['initial_balance']; // Use the initial balance for calculations

        $recommended_amount = ((double)$percentage / 100) * $initial_balance;

        // Ensure recommended amount does not exceed the remaining balance
        $remaining_balance = $this->inputs[$key]['remaining_balance'];

        if ($recommended_amount > $remaining_balance) {
            $recommended_amount = $remaining_balance;
        }

        // Update the recommended amount and adjust the remaining balance
        $this->inputs[$key]['recommended_amount'] = $recommended_amount;
        $this->inputs[$key]['remaining_balance'] -= $recommended_amount;
        // $this->inputs[$key]['remaining_balance'] = $initial_balance - $recommended_amount;

         // Recalculate the cumulative total
        $this->calculateCumulativeTotal();
    }

    public function calculateCumulativeTotal()
    {
        $this->cumulativeTotal = array_sum(array_column($this->inputs, 'recommended_amount'));
    }

    public function saveRecommendations()
    {
        foreach ($this->inputs as $input) {
            // Check that we have the ID and remaining_balance before attempting to save
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
            'recommended_amount' => $this->cumulativeTotal,
            'recommended_percentage' => '',
            'recommended_by' => auth()->id(),
            'status' => 'recommended',
            'remarks' => $this->remarks,
        ]);
        $this->dispatchBrowserEvent('success',["success" =>"Payment recommendation submitted."]);
    }

    // public function calculateAmountFromPercentage()
    // {
    //     $this->recommendedAmount = ($this->contract->value * $this->recommendedPercentage) / 100;
    //     $this->calculateTotalAmount();
    //     if ($this->recommendedAmount > $this->contract->value) {
    //         $this->dispatchBrowserEvent('error',["error" =>"Amount exceeds remaining balance."]);
    //         return;
    //     }
    // }

    // public function updatedRecommendedAmount()
    // {
    //     $this->calculateTotalAmount();
    // }

    // public function updatedIncludeVAT()
    // {
    //     $this->calculateTotalAmount();
    // }

    // public function updatedVatRate()
    // {
    //     $this->calculateTotalAmount();
    // }

    // protected function calculateTotalAmount()
    // {
    //     if ($this->includeVAT) {
    //         $this->vatAmount = ($this->recommendedAmount * $this->vatRate) / 100;
    //     } else {
    //         $this->vatAmount = 0;
    //     }

    //     $this->totalAmount = $this->recommendedAmount + $this->vatAmount;
    // }

    // public function recommendPayment()
    // {
    //     PaymentRequest::create([
    //         'contract_id' => $this->contract->id,
    //         'recommended_amount' => $this->totalAmount,
    //         'recommended_percentage' => $this->recommendedPercentage,
    //         'recommended_by' => auth()->id(),
    //         'status' => 'recommended',
    //         'remarks' => $this->remarks,
    //     ]);
    //     $this->reset(['recommendedAmount', 'recommendedPercentage', 'remarks','includeVAT']);
    //     $this->dispatchBrowserEvent('success',["success" =>"Payment recommendation submitted."]);
    // }

    public function render()
    {
        $paymentRequests = $this->contract ? $this->contract->paymentRequests : collect();

        return view('livewire.contracts.payment-recommendation-component',[
            'recommendations' => $paymentRequests,
        ]);
    }
}
