<?php

namespace App\Http\Livewire\Contracts;

use Livewire\Component;
use App\Models\Contract;
use App\Models\ContractorPaymentHistory;
use Illuminate\Support\Facades\DB;

class PaymentHistoryComponent extends Component
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

    public function render()
    {
        return view('livewire.contracts.payment-history-component',[
            'contract' => $this->contract,
            'paymentHistory' => $this->paymentHistory,
        ]);
    }
}
