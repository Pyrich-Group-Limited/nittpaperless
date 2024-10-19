<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserPermission extends Component
{
    public $sel_permissions = [];
    public $old_permissions = [];
    public $permissions=[];
    public $selModule;

    public function mount(){
        $this->sel_permissions = Auth::user()->getDirectPermissions()->pluck('name');
        $this->old_permissions = Auth::user()->getDirectPermissions()->pluck('name');
    }


    public function setModule($module){
        $this->permissions = [];
        $this->selModule = $module;
        $modulePermissions = Permission::where('module',$module)->pluck('name');
        $this->permissions = $modulePermissions;

    }


    public function updatePermission(){
        Auth::user()->revokePermissionTo($this->old_permissions->toArray());
        Auth::user()->givePermissionTo($this->sel_permissions);
        $this->dispatchBrowserEvent('success',['success' => 'Staff Permission updated Successfully']);

    }

    public function render()
    {
        $roles = Role::all();
        $modules = Permission::groupBy('module')->orderBy('module','ASC')->get();
        return view('livewire.users.user-permission',compact('modules','roles'));
    }
}
