<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Collection;

class UserPermission extends Component
{
    public $sel_permissions = [];
    public $old_permissions = [];
    public $permissions=[];
    public $selModule;
    public $selStaff;
    public $selectAll;
    public $modulePermissions;

    public function mount($id){
        $this->selStaff = User::find($id);
        $this->sel_permissions = $this->selStaff->getDirectPermissions()->pluck('name')->toArray();
        $this->old_permissions = $this->selStaff->getDirectPermissions()->pluck('name')->toArray();
    }


    public function setModule($module){
        $this->permissions = [];
        $this->selModule = $module;
        $modulePermissions = Permission::where('module',$module)->pluck('name')->toArray();
        $this->permissions = $modulePermissions;
    }

    public function updatedSelectAll($value){
        if ($value) {
            foreach($this->permissions as $permission){
                $this->sel_permissions[] = $permission;
            }

        } else {
            $selPerm = array_diff($this->sel_permissions, $this->permissions);
            $this->sel_permissions = $selPerm;
        }
    }

    public function updatePermission(){
        $this->selStaff->revokePermissionTo($this->old_permissions);
        $this->selStaff->givePermissionTo($this->sel_permissions);
        $this->dispatchBrowserEvent('success',['success' => 'Staff Permission updated Successfully']);

    }

    public function render()
    {
        $roles = Role::all();
        $modules = Permission::groupBy('module')->orderBy('module','ASC')->get();
        $categories = Permission::groupBy('category')->orderBy('category','ASC')->get();
        return view('livewire.users.user-permission',compact('modules','roles','categories'));
    }
}
