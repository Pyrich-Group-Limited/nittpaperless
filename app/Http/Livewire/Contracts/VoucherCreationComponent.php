<?php

namespace App\Http\Livewire\Contracts;

use Livewire\Component;
use App\Models\Contract;
use App\Models\ContractorPaymentHistory;
use Illuminate\Support\Facades\DB;
use App\Models\PaymentRequest;

class VoucherCreationComponent extends Component
{
    public $paymentRequest;

    public function mount($paymentRequestId)
    {
        $this->paymentRequest = PaymentRequest::find($paymentRequestId);
    }

    public function createVoucher()
    {
        $this->paymentRequest->update([
            'voucher_raised_by' => auth()->id(),
            'status' => 'voucher_raised',
        ]);
        $this->dispatchBrowserEvent('success',["success" =>"Payment Voucher created for payment."]);
        return redirect()->route('contracts.recommend',$this->paymentRequest->contract->id);
    }

    public function render()
    {
        return view('livewire.contracts.voucher-creation-component');
    }
}
