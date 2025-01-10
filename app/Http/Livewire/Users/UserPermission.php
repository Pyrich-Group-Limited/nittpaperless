<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserPermission extends Component
{
    public $sel_permissions = []; // Selected permissions (checked)
    public $old_permissions = []; // Original permissions
    public $permissions = []; // Available permissions for the selected module
    public $selModule; // Selected module name
    public $selStaff; // Selected user
    public $selectAll; // Select All checkbox state
    public $modulePermissions;

    public function mount($id)
    {
        // Find the selected staff
        $this->selStaff = User::find($id);

        // Combine direct permissions and role-based permissions
        $this->sel_permissions = $this->selStaff->getAllPermissions()->pluck('name')->toArray();

        // Store old permissions for comparison
        $this->old_permissions = $this->sel_permissions;
    }

    public function setModule($module)
    {
        $this->permissions = [];
        $this->selModule = $module;

        // Fetch permissions for the selected module
        $this->permissions = Permission::where('module', $module)->pluck('name')->toArray();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            // Select all permissions in the current module
            foreach ($this->permissions as $permission) {
                if (!in_array($permission, $this->sel_permissions)) {
                    $this->sel_permissions[] = $permission;
                }
            }
        } else {
            // Deselect all permissions in the current module
            $this->sel_permissions = array_diff($this->sel_permissions, $this->permissions);
        }
    }

    public function updatePermission()
    {
        // Revoke all old permissions
        $this->selStaff->revokePermissionTo($this->old_permissions);

        // Grant the selected permissions
        $this->selStaff->givePermissionTo($this->sel_permissions);

        // Update old permissions for tracking
        $this->old_permissions = $this->sel_permissions;

        // Notify success
        $this->dispatchBrowserEvent('success', ['success' => 'Staff permissions updated successfully!']);
    }

    public function render()
    {
        $roles = Role::all();

        // Fetch unique modules and categories for dropdowns
        $modules = Permission::select('module')->groupBy('module')->orderBy('module', 'ASC')->get();
        $categories = Permission::select('category')->groupBy('category')->orderBy('category', 'ASC')->get();

        return view('livewire.users.user-permission', compact('modules', 'roles', 'categories'));
    }
}
