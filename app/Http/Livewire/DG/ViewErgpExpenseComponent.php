<?php

namespace App\Http\Livewire\DG;

use Livewire\Component;
use App\Models\Ergp;
use App\Models\ProjectCategory;
use App\Models\ProjectCreation;
use App\Models\ProjectAdvert;

class ViewErgpExpenseComponent extends Component
{
    public $ergp_id;

    public function mount($id){
        $this->ergp_id = $id;
        $this->ergp = Ergp::find($id);
    }

    public function render()
    {
        $ergp = Ergp::find($this->ergp_id);
        $ergpDetails = ProjectCreation::where('project_category_id',$ergp->project_category_id)->get();
        // dd($ergpDetails);
        return view('livewire.d-g.view-ergp-expense-component',compact('ergpDetails'));
    }
}
