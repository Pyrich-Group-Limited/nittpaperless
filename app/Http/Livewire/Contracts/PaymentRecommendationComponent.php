<?php

namespace App\Http\Livewire\Contracts;

use Livewire\Component;
use App\Models\Contract;
use App\Models\ContractorPaymentHistory;
use App\Models\PaymentRequest;
use Illuminate\Support\Facades\DB;

class PaymentRecommendationComponent extends Component
{
    public $recommendedAmount;
    public $recommendedPercentage;
    public $remarks;

    public $includeVAT = false;   // Checkbox for VAT inclusion
    public $vatRate = 7.5;        // Default VAT rate
    public $vatAmount = 0;
    public $totalAmount = 0;

    public function mount($contractId)
    {
        $this->contract = Contract::with('paymentRequests')->find($contractId);
        if (!$this->contract) {
            $this->dispatchBrowserEvent('error',["error" =>"Contract not found."]);
            // abort(404, 'Contract not found');
        }
    }

    public function calculateAmountFromPercentage()
    {
        $this->recommendedAmount = ($this->contract->value * $this->recommendedPercentage) / 100;
        $this->calculateTotalAmount();
        if ($this->recommendedAmount > $this->contract->value) {
            $this->dispatchBrowserEvent('error',["error" =>"Amount exceeds remaining balance."]);
            return;
        }
    }

    public function updatedRecommendedAmount()
    {
        $this->calculateTotalAmount();
    }

    public function updatedIncludeVAT()
    {
        $this->calculateTotalAmount();
    }

    public function updatedVatRate()
    {
        $this->calculateTotalAmount();
    }

    protected function calculateTotalAmount()
    {
        if ($this->includeVAT) {
            $this->vatAmount = ($this->recommendedAmount * $this->vatRate) / 100;
        } else {
            $this->vatAmount = 0;
        }

        $this->totalAmount = $this->recommendedAmount + $this->vatAmount;
    }

    public function recommendPayment()
    {
        PaymentRequest::create([
            'contract_id' => $this->contract->id,
            'recommended_amount' => $this->totalAmount,
            'recommended_percentage' => $this->recommendedPercentage,
            'recommended_by' => auth()->id(),
            'status' => 'recommended',
            'remarks' => $this->remarks,
        ]);
        $this->reset(['recommendedAmount', 'recommendedPercentage', 'remarks','includeVAT']);
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
