<?php

namespace App\Http\Livewire\Contracts;

use Livewire\Component;
use App\Models\Contract;
use App\Models\ContractorPaymentHistory;
use App\Models\PaymentRequest;
// use App\Models\Voucher;

class PaymentVoucher extends Component
{
    public $contract;
    public $voucher;

    // public function mount($contractId)
    // {
    //     $this->contract = Contract::with(['project', 'contractor', 'paymentRequest'])
    //         ->find($contractId);

    //     // Assuming `paymentRequest` has an associated `voucher` model or data
    //     $this->voucher = $this->contract->paymentRequest;
    //     // $this->voucher = $this->contract->paymentRequest->voucher;
    // }

    public $paymentRequest;

    public function mount($paymentRequestId)
    {
        $this->paymentRequest = PaymentRequest::find($paymentRequestId);
    }

    public function render()
    {
        return view('livewire.contracts.payment-voucher');
    }
}
