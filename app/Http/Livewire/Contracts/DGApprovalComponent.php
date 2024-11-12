<?php

namespace App\Http\Livewire\Contracts;

use Livewire\Component;
use App\Models\Contract;
use App\Models\ContractorPaymentHistory;
use App\Models\PaymentRequest;
use Illuminate\Support\Facades\DB;

class DGApprovalComponent extends Component
{
    public $paymentRequest;
    public $remarks;

    public function mount($paymentRequestId)
    {
        $this->paymentRequest = PaymentRequest::find($paymentRequestId);
    }

    public function approve()
    {
        $this->paymentRequest->update([
            'approved_by' => auth()->id(),
            'status' => 'approved',
            'remarks' => $this->remarks,
        ]);
        $this->dispatchBrowserEvent('success',["success" =>"Payment recommendation approved."]);
        return redirect()->route('contracts.recommend',$this->paymentRequest->contract->id);
    }

    public function reject()
    {
        $this->paymentRequest->update([
            'status' => 'pending',
            'remarks' => $this->remarks,
        ]);
        $this->dispatchBrowserEvent('error',["error" =>"Payment recommendation rejected."]);
    }

    public function render()
    {
        return view('livewire.contracts.d-g-approval-component');
    }
}
