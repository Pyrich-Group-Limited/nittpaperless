<?php

namespace App\Http\Livewire\PhysicalPlanning\Projects;

use Livewire\Component;
use App\Models\ProjectCreation;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use App\Models\Ergp;
use App\Models\PPProjectBOQ;

use Illuminate\Support\Collection;

class Uploadboq extends Component
{
    public $selProject;
    public $budget;
    public $boq_file;
    public Collection $inputs;
    public $sumTotal;
    public $ergp;
    protected $listeners = ['project' => 'incrementPostCount'];
    use WithFileUploads;

    public function mount($project = null){
        $this->selProject = $project;
        $this->fill([
            'inputs' => collect([['item' => '','description' => '','unit_price' => '','quantity' => '']]),
        ]);
    }

    public function updatedBudget($id){
        $this->ergp = Ergp::where('code',$id)->first();
    }

    public function addInput(){
        $this->inputs->push(['item' => '','description' => '','unit_price' => '','quantity' => '']);
    }

    public function removeInput($key){
        $this->inputs->pull($key);
    }


    public function Updated(){
        foreach($this->inputs as $input){
            $this->sumTotal =  $this->sumTotal + ((double)$input['unit_price'] * (double)$input['quantity']);
        }
    }

    public function uploadBOQ(){

        $this->validate([
            'budget' => ['required'],
            'boq_file' => ['required','max:5000'],
            'inputs.*.item' => 'required',
            'inputs.*.description' => 'required',
            'inputs.*.unit_price' => 'required',
            'inputs.*.quantity' => 'required',
        ]);

        try{
            $boqDocumentName = Carbon::now()->timestamp. '.' . $this->boq_file->getClientOriginalName();
            $this->boq_file->storePubliclyAs('boqs', 'public');

            $this->selProject->update([
                'budget' => (7.5/100 * $this->sumTotal) + ($this->sumTotal),
                'project_boq' => $boqDocumentName
            ]);

            foreach($this->inputs as $input){
                PPProjectBOQ::create([
                    'project_id' => $this->selProject->id,
                    'item' => $input['item'],
                    'description' => $input['description'],
                    'unit_price' => $input['unit_price'],
                    'quantity' => $input['quantity'],
                ]);
            }

            $this->fill([
                'inputs' => collect([['item' => '','description' => '','unit_price' => '','quantity' => '']]),
            ]);
            $this->dispatchBrowserEvent('success',['success'=>'Bill of quantity successfully uploaded']);
            // $this->dispatchBrowserEvent('success',['success'=>'Upload Successful']);
            $this->reset('budget','boq_file');
        }catch(\Exception $e){
            $this->dispatchBrowserEvent('error',['error'=>'Sorry there was an error uploading bill of quantity']);
        }

    }

    public function incrementPostCount(ProjectCreation $project)
    {
        $this->selProject = $project;
    }

    public function render()
    {
        $projAccounts = Ergp::all();
        return view('livewire.physical-planning.projects.uploadboq',compact('projAccounts'));
    }
}
