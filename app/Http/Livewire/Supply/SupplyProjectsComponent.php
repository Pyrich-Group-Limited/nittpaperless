<?php

namespace App\Http\Livewire\Supply;

use Livewire\Component;
use App\Models\ProjectCategory;
use App\Models\ProjectCreation;

class SupplyProjectsComponent extends Component
{
    public function render()
    {
        $category = ProjectCategory::where('category_name','Supply')->first();
        $projects = ProjectCreation::where('project_category_id',$category->id)->orderBy('created_at','desc')->get();
        return view('livewire.supply.supply-projects-component',compact('projects'));
    }
}
