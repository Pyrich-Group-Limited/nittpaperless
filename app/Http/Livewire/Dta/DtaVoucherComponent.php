<?php

namespace App\Http\Livewire\Dta;

use Livewire\Component;
use App\Models\Dta;
use App\Models\DtaApproval;

class DtaVoucherComponent extends Component
{
    public $dtaRequest;

    public function mount($id)
    {
        $this->dtaRequest = Dta::find($id);
    }

    public function render()
    {
        return view('livewire.dta.dta-voucher-component');
    }
}
