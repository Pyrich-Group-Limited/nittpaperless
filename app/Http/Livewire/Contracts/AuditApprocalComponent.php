<?php

namespace App\Http\Livewire\Contracts;

use Livewire\Component;
use App\Models\Contract;
use App\Models\ContractorPaymentHistory;
use App\Models\PaymentRequest;
use Illuminate\Support\Facades\DB;

class AuditApprocalComponent extends Component
{
    public $paymentRequest;

    public function mount($paymentRequestId)
    {
        $this->paymentRequest = PaymentRequest::find($paymentRequestId);
    }

    public function sign()
    {
        $this->paymentRequest->update([
            'audited_by' => auth()->id(),
            'status' => 'audited',
        ]);
        $this->dispatchBrowserEvent('success',["success" =>"Payment Request Stamped by Audit."]);
        return redirect()->route('contracts.recommend',$this->paymentRequest->contract->id);
    }

    public function render()
    {
        return view('livewire.contracts.audit-approcal-component');
    }
}
