<?php

namespace App\Http\Livewire\Contracts;

use Livewire\Component;
use App\Models\Contract;
use App\Models\ContractorPaymentHistory;
use App\Models\PaymentRequest;
use Illuminate\Support\Facades\DB;

class PaymentRecommendationComponent extends Component
{
    // public $contractId;
    public $recommendedAmount;
    public $recommendedPercentage;
    public $remarks;
    // public $recommendations;

    public function mount($contractId)
    {
        $this->contract = Contract::with('paymentRequests')->find($contractId);
        if (!$this->contract) {
            abort(404, 'Contract not found');
        }
    }

    public function calculateAmountFromPercentage()
    {
        $this->recommendedAmount = ($this->contract->value * $this->recommendedPercentage) / 100;
        if ($this->recommendedAmount > $this->contract->value) {
            $this->dispatchBrowserEvent('error',["error" =>"Amount exceeds remaining balance."]);
            return;
        }
    }

    public function recommendPayment()
    {
        // $amount = $this->contract->contract_sum * ($this->recommendationPercentage / 100);

        PaymentRequest::create([
            'contract_id' => $this->contract->id,
            'recommended_amount' => $this->recommendedAmount,
            'recommended_percentage' => $this->recommendedPercentage,
            'recommended_by' => auth()->id(),
            'status' => 'recommended',
            'remarks' => $this->remarks,
        ]);
        $this->reset(['recommendedAmount', 'recommendedPercentage', 'remarks']);
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
