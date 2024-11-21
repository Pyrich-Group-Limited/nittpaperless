<?php

namespace App\Http\Livewire\Projects;

use Livewire\Component;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Contract_attachment;
use App\Models\ContractComment;
use App\Models\ContractNotes;
use App\Models\ContractType;
use App\Models\Project;
use App\Models\User;
use App\Models\UserDefualtView;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ContractorPaymentHistory;

class ShowContractDetailsComponent extends Component
{
    public $contract_id;

    public function mount($id){

        $this->contract_id = $id;
        $contract = Contract::find($id);
    }

    public function calculateAmountFromPercentage()
    {
        $this->amount = ($this->contract->total_contract_sum * $this->percentage) / 100;
    }

    public function render()
    {
        // $contract = Contract::find($this->contract_id)->first();
        $contract = Contract::find($this->contract_id);
        return view('livewire.projects.show-contract-details-component',compact('contract'));
    }
}
