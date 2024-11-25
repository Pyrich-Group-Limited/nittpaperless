<?php

namespace App\Http\Livewire\Contracts;

use Livewire\Component;
use App\Models\Contract;
use App\Models\ContractorPaymentHistory;
use Illuminate\Support\Facades\DB;
use App\Models\PaymentRequest;
use App\Models\ChartOfAccount;

class VoucherCreationComponent extends Component
{
    public $chartAccount;
    public $paymentRequest;

    public function mount($paymentRequestId)
    {
        $this->paymentRequest = PaymentRequest::find($paymentRequestId);

        $this->accounts = ChartOfAccount::all();
    }

    public function createVoucher()
    {
        $this->validate([
            'chartAccount' => 'required',
        ]);

        $this->paymentRequest->update([
            'voucher_raised_by' => auth()->id(),
            'status' => 'voucher_raised',
            'account_id' => $this->chartAccount
        ]);
        $this->dispatchBrowserEvent('success',["success" =>"Payment Voucher created for payment."]);
        return redirect()->route('contracts.recommend',$this->paymentRequest->contract->id);
    }

    public function render()
    {
        return view('livewire.contracts.voucher-creation-component');
    }
}
