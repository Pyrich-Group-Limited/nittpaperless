<?php

namespace App\Http\Livewire\Contracts;

use Livewire\Component;
use App\Models\Contract;
use App\Models\ContractorPaymentHistory;
use App\Models\PaymentRequest;
use Illuminate\Support\Facades\DB;

class AuditorPaymentComponent extends Component
{
    public $paymentRequestId;
    public $amount;
    public $percentage;
    public $remarks;
    public $contract;
    public $paymentRequest;

    public function mount($paymentRequestId)
    {
        $this->paymentRequest = PaymentRequest::find($paymentRequestId);

        $this->percentage = $this->paymentRequest->recommended_percentage;
        $this->amount = $this->paymentRequest->recommended_amount;
    }

    public function calculateAmountFromPercentage()
    {
        $this->amount = ($this->paymentRequest->contract->value * $this->percentage) / 100;
    }

    public function finalizePayment()
    {
        $remainingBalance = $this->paymentRequest->contract->value - $this->paymentRequest->contract->amount_paid_to_date;

        if ($this->amount > $remainingBalance) {
            $this->dispatchBrowserEvent('error',["error" =>"Amount you are trying to pay exceeds remaining balance."]);
            return;
        }

        DB::transaction(function () use ($remainingBalance) {
            ContractorPaymentHistory::create([
                'payment_request_id' => $this->paymentRequest->id,
                'contractor_id' => $this->paymentRequest->contract->client_name,
                'project_id' => $this->paymentRequest->contract->project_id,
                'contract_id' => $this->paymentRequest->contract->id,
                'amount_paid' => $this->amount,
                'payment_date' => now(),
                'remarks' => $this->remarks,
                'remaining_balance' => $remainingBalance - $this->amount,
                'processed_by' => auth()->id(),
            ]);

            

            $this->paymentRequest->contract->update([
                'amount_paid_to_date' => $this->paymentRequest->contract->amount_paid_to_date + $this->amount
            ]);

            $this->paymentRequest->update([
                'paid_by' => auth()->id(),
                'status' => 'paid',
                'isCompleted' => true,
            ]);

            if ($this->paymentRequest->contract->amount_paid_to_date == $this->paymentRequest->contract->value) {
                $this->paymentRequest->contract->is_complete = true;
            }
        });

        $this->reset(['amount', 'percentage', 'remarks']);
        $this->dispatchBrowserEvent('success',["success" =>"Payment recorded successfully."]);

        return redirect()->route('contract.details',$this->paymentRequest->contract->id);
    }

    public function render()
    {
        return view('livewire.contracts.auditor-payment-component');
    }
}
