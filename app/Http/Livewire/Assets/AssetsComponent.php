<?php

namespace App\Http\Livewire\Assets;

use Livewire\Component;
use Livewire\withPagination;
use App\Models\Store;
class AssetsComponent extends Component
{

    use withPagination;
    protected $listeners = ['reset-confimred'=>'resetPassword','delete-confirmed'=>'deleteAsset']; // listen to comfirmatio delete and call delete branch function

    public $actionId;
    public $searchTerm;
    public $searchBy;
    public $description;
    public $initial_cost;
    public $quantity;
    public $model_no;
    public $asset_type;
    public $location;
    public $serial_no;
    public $asset_code;
    public $man_year;
    public $date_purchased;
    public $selAsset;
    public $appreciation;
    public $depreciation;

    public function mount(){
        $this->man_year = '2016';
    }

    public function clearSearch(){
        $this->searchTerm = "";
    }

    public function deleteAsset(){
        Store::find($this->actionId)->delete();
        $this->dispatchBrowserEvent('success',["success" =>"Assets Successfully Deleted"]);
    }


    public function newAsset(){
        $this->validate([
            'description' => ['required','string'],
            'initial_cost' => ['required','string'],
            'quantity' => ['required','string'],
            'model_no' => ['required','string'],
            'location' => ['required','string'],
            'serial_no' => ['required','string'],
            'asset_code' => ['required','string'],
            'asset_type' => ['required','string'],
            'man_year' => ['required','string'],
            'date_purchased' => ['required','string'],
        ]);

        Store::create([
            'asset_identification_code' => $this->asset_code,
            'asset_description' => $this->description,
            'asset_type' => $this->asset_type,
            'location' => $this->location,
            'number_of_units' => $this->quantity,
            'model_number' => $this->model_no,
            'year_of_manufacture' => $this->man_year,
            'serial_number' => $this->serial_no,
            'date_of_purchase' => $this->date_purchased,
            'initial_cost' => $this->initial_cost,
        ]);

        $this->reset();
        $this->dispatchBrowserEvent('success',["success" =>"Assets Successfully Created"]);

    }

    public function updateAsset(){
        $this->validate([
            'description' => ['required','string'],
            'initial_cost' => ['required','string'],
            'quantity' => ['required','string'],
            'model_no' => ['required','string'],
            'location' => ['required','string'],
            'serial_no' => ['required','string'],
            'asset_code' => ['required','string'],
            'asset_type' => ['required','string'],
            'man_year' => ['required','string'],
            'date_purchased' => ['required','string'],
            'depreciation' => ['required','string'],
            'appreciation' => ['required','string'],
        ]);

        if($this->depreciation>0 && $this->appreciation>0 ){
            $this->dispatchBrowserEvent('error',["error" =>"Sorry Asset can not appreciate and depreciate at the same time"]);
        }else{
            $this->selAsset->update([
                'asset_identification_code' => $this->asset_code,
                'asset_description' => $this->description,
                'asset_type' => $this->asset_type,
                'location' => $this->location,
                'number_of_units' => $this->quantity,
                'model_number' => $this->model_no,
                'year_of_manufacture' => $this->man_year,
                'serial_number' => $this->serial_no,
                'date_of_purchase' => $this->date_purchased,
                'initial_cost' => $this->initial_cost,
                'appreciation' => $this->appreciation,
                'depreciation' => $this->depreciation,
            ]);

            $this->reset();
            $this->dispatchBrowserEvent('success',["success" =>"Assets Successfully Updated"]);
        }

    }

    public function setSelectedAsset(Store $asset){
        $this->selAsset = $asset;
        $this->description = $asset->asset_description;
        $this->initial_cost = $asset->initial_cost;
        $this->quantity = (string)$asset->number_of_units;
        $this->model_no = $asset->model_number;
        $this->asset_type = $asset->asset_type;
        $this->location = $asset->location;
        $this->serial_no = $asset->serial_number;
        $this->asset_code = $asset->asset_identification_code;
        $this->man_year = $asset->year_of_manufacture;
        $this->date_purchased = $asset->date_of_purchase;
        $this->depreciation = $asset->depreciation;
        $this->appreciation = $asset->appreciation;
    }

    public function setActionId($id){
        $this->actionId = $id;
    }

    public function getAssets(){
        $users = Store::query()
        ->where(function($query) {
            if($this->searchTerm) {
                $query->where('asset_description', 'like', '%'.$this->searchTerm.'%');
            }
        })
        ->orwhere(function($query) {
            if($this->searchTerm && $this->searchBy) {
                $query->where($this->searchBy, 'like', '%'.$this->searchTerm.'%');
            }
         })
         ->latest()->paginate(20);
         return $users;
    }

    public function render()
    {
        $assets = $this->getAssets();
        return view('livewire.assets.assets-component',compact('assets'));
    }
}
