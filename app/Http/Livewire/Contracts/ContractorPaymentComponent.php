<?php

namespace App\Http\Livewire\Contracts;

use Livewire\Component;
use App\Models\Contract;
use App\Models\ContractorPaymentHistory;
use Illuminate\Support\Facades\DB;

class ContractorPaymentComponent extends Component
{
    public $contractId;
    public $amount;
    public $percentage;
    public $remarks;
    public $contract;
    public $paymentHistory;

    public function mount($contractId)
    {
        $this->contractId = $contractId;
        $this->contract = Contract::find($contractId);
        $this->paymentHistory = $this->contract->contractorPayments()->orderBy('payment_date', 'desc')->get();
    }

    public function calculateAmountFromPercentage()
    {
        $this->amount = ($this->contract->value * $this->percentage) / 100;
    }

    public function makePayment()
    {
        $remainingBalance = $this->contract->value - $this->contract->amount_paid_to_date;

        if ($this->amount > $remainingBalance) {
            $this->dispatchBrowserEvent('error',["error" =>"Amount you are trying to pay exceeds remaining balance."]);
            return;
        }

        DB::transaction(function () use ($remainingBalance) {
            ContractorPaymentHistory::create([
                'contractor_id' => $this->contract->client_name,
                'project_id' => $this->contract->project_id,
                'contract_id' => $this->contract->id,
                'amount_paid' => $this->amount,
                'payment_date' => now(),
                'remarks' => $this->remarks,
                'remaining_balance' => $remainingBalance - $this->amount,
            ]);

            $this->contract->update([
                'amount_paid_to_date' => $this->contract->amount_paid_to_date + $this->amount
            ]);
        });

        $this->reset(['amount', 'percentage', 'remarks']);
        $this->paymentHistory = $this->contract->contractorPayments()->orderBy('payment_date', 'desc')->get();
        $this->dispatchBrowserEvent('success',["success" =>"Payment recorded successfully."]);
        return redirect()->route('contract.details',$this->contract->id);
    }


    public function render()
    {
        return view('livewire.contracts.contractor-payment-component',[
            'contract' => $this->contract,
            'paymentHistory' => $this->paymentHistory,
        ]);
    }
}
