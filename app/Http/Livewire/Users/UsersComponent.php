<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Department;
use App\Models\UserCompany;
use App\Models\Designation;
use App\Models\LiasonOffice;
use App\Models\Unit;
use App\Models\SubUnit;
use App\Models\Employee;
use Spatie\Permission\Models\Role;
use App\Services\DataService;

class UsersComponent extends Component
{
    public $actionId;
    public $selUser;
    public $departments = [];
    public $units = [];
    public $subunits = [];
    public $surname;
    public $firstname;
    public $email;
    public $location;
    public $location_type;
    public $department;
    public $designation;
    public $level;
    public $unit;
    public $subunit;
    public $user_role;


    public function updatedDepartment($id){
        $this->units = Unit::where('department_id',$id)->get();
    }

    public function updatedLocationType($id){
        if($id=="Department" || $id=="Directorate"){
            if($id=="Department"){
                $this->departments = Department::where('category','department')->get();
            }else{
                $this->departments = Department::where('category','directorate')->get();
                $this->unit = null;
                $this->subunit = null;
            }
        }else{
            $this->departments = Department::where('category','department')->get();
        }

    }

    public function registerUser(){
        $this->validate([
            'surname' => ['required','max:120'],
            'firstname' => ['required','max:120'],
            'email' => 'required|email|unique:users',
            'surname' => ['required'],
            'designation' => ['required'],
            'level' => ['required'],
            'location' => ['required'],
            'location_type' => ['required'],
            'user_role' => ['required'],
        ]);

        if($this->location=="Liaison-Offices"){
            $this->validate([
                'department' => ['required'],
                'unit' => ['required'],
            ]);
        }

        $designation = Designation::find($this->designation);

        $user = User::create([
            'name' => $this->surname. " ".$this->firstname,
            'location' => $this->location,
            'email' => $this->email,
            'location_type' =>   $this->location == "Headquarters" ? $this->location_type : LiasonOffice::find($this->location_type)->name,
            'department_id' => $this->department,
            'unit_id' => $this->unit,
            'sub_unit_id' => $this->subunit,
            'type' => $this->user_role=="Human Resource (HR)"? "client" : strtolower($this->user_role),
            'designation' => $designation->name,
            'level' => $this->level,
        ]);

        Employee::create([
            'user_id' => $user->id
        ]);

        $this->reset();
        $this->dispatchBrowserEvent('success',["success" =>"User Successfully Registered"]);
    }


    public function updateUser(){
        $this->validate([
            'surname' => ['required','max:120'],
            'firstname' => ['required','max:120'],
            'email' => ['required','email','unique:users,email,'.$this->selUser->id],
            'surname' => ['required'],
            'designation' => ['required'],
            'level' => ['required'],
            'location' => ['required'],
            'location_type' => ['required'],
            'user_role' => ['required'],
        ]);

        if($this->location=="Liaison-Offices"){
            $this->validate([
                'department' => ['required'],
                'unit' => ['required'],
            ]);
        }

        $designation = Designation::find($this->designation);

        $this->selUser->update([
            'name' => $this->surname. " ".$this->firstname,
            'location' => $this->location,
            'email' => $this->email,
            'location_type' =>   $this->location == "Headquarters" ? $this->location_type : LiasonOffice::find($this->location_type)->id,
            'department_id' => $this->department,
            'unit_id' => $this->unit,
            'sub_unit_id' => $this->subunit,
            'type' => $this->user_role=="Human Resource (HR)"? "client" : strtolower($this->user_role),
            'designation' => $designation->name,
            'level' => $this->level,
        ]);


        // $this->reset();
        $this->dispatchBrowserEvent('success',["success" =>"User Successfully Updated"]);
    }

    public function updatedLocation(){
        $this->location_type = "";
    }

    public function updatedUnit($id){
        $this->subunits = SubUnit::where('unit_id',$id)->get();
    }

    public function setActionId($id){
        $this->setActionId = $id;
    }

    public function selUser($id){
        $this->selUser = User::find($id);

        $lisasonOffices = LiasonOffice::where('id',$this->selUser->location_type)->first();
        $location_type= null;

        if($this->selUser->location == "Headquarters"){
            $location_type = $this->selUser->location_type;
        }elseif($lisasonOffices!=null){
            $location_type = $lisasonOffices->id;
        }

        $name = $words = explode(" ", $this->selUser->name);
        $this->updatedLocationType($this->selUser->location_type);
        $this->updatedDepartment($this->selUser->department_id);
        $this->surname = $name[0];
        $this->firstname = $name[1];
        $this->email = $this->selUser->email;
        $this->location = $this->selUser->location;
        $this->location_type =  $location_type;
        $this->department = $this->selUser->department_id;
        $this->designation = Designation::where('name',$this->selUser->designation)->first()->id;
        $this->level = $this->selUser->level;
        $this->unit = $this->selUser->unit_id;
        $this->subunit = $this->selUser->subunit;
        $this->user_role = ucwords($this->selUser->type);
    }

    public function render()
    {
        $user = \Auth::user();
        if(\Auth::user()->can('manage user'))
        {
            $roles = [];
            $users = User::paginate(12);
            $roles = [];
            $departments = Department::where('category','department')->get();
            $designations = Designation::all();
            $liasons =  LiasonOffice::all();
            $headquaters =  ['Directorates','Departments'];
            $allRoles = Role::all();
            foreach($allRoles as $role){
                $roles[] = $role->id = $role->name=="client"? "Human Resource (HR)" : ucwords($role->name);
            }
            $directorates = Department::where('category','directorate')->get();
            return view('livewire.users.users-component',compact('users','departments','designations','liasons','headquaters','directorates','roles'));
        }
        else
        {
            return redirect()->back();
        }
    }
}
