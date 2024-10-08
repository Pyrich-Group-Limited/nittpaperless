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
use App\Exports\FailedUsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
use Hash;

class UsersComponent extends Component
{
    use WithFileUploads;
    public $uploadFile;
    public $failed_upload = [];

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

    public function uploadUser()
    {
        $this->validate([
            'uploadFile' => ['required','file','mimes:xlsx,csv,xls'],
        ]);

        $sn = 0;

        try{
            $staffs  = Excel::toArray(new UsersImport, $this->uploadFile);

            foreach($staffs[0] as $row){
                $this->uploadUserRecord($row);
            }

        }catch(Throwable $e){
            return back()->with('error','There was an error uploading record kindly ensure your data is properly arranged and upload again');
        }
    }

    //to download failed upload records
    public function downloadFailedUpload(){
        return Excel::download(new FailedUsersExport($this->failed_upload), 'Failed-Uploads.xlsx');
    }

    public function setFailedUpload($row,$comment){
        $this->failed_upload[] = [

            'name' => $row[0],
            'email' => $row[1],
            'location_type' =>   $row[2],
            'location' => $row[3],
            'department_id' => $row[4],
            'unit_id' => $row[5],
            'sub_unit_id' => $row[6],
            'type' => $row[7],
            'designation'  => $row[8],
            'level' => $row[9],
            'comment' => $comment,
        ];
    }

    public function uploadUserRecord($row){

        $subunit = null;
        $departments = Department::where('name',$row['4'])->first();
        $designations = Designation::where('name',$row['8'])->first();
        $units = Unit::where('name',$row[5])->where('department_id',$departments->id)->first();
        if($units!=null){
            $subunit = SubUnit::where('name',$row[6])->where('unit_id',$units->id)->first();
        }
        $lisasonOffice = null;
        $location = strtolower($row[2]);
        $location_type = strtolower($row[3]);
        $selRole = $row[7]=="Human Resource (HR)"? "client" : strtolower($row[7]);
        $role = Role::where('name',$row[7])->first();

        if(($location == "headquarters" && $location_type=="department") || ($location == "headquarters" && $location_type=="directorate")){
            $lisasonOffice = strtolower($row[3]);
        }else{
            $lisasonOffice = LiasonOffice::where('id',strtolower($row[3]))->first()->name;
        }

        if($departments==null){
            $this->setFailedUpload($row,"Invalid Department");
        }elseif($designations==null){
            $this->setFailedUpload($row,"Invalid Designation");
        }elseif($lisasonOffice==null){
            $this->setFailedUpload($row,"Invalid Liason Office");
        }elseif($location_type==null){
            $this->setFailedUpload($row,"Invalid Office Category");
        }elseif($units==null){
            $this->setFailedUpload($row,"Invalid Department Unit");
        }elseif($role==null){
            $this->setFailedUpload($row,"Invalid User Role");
        }else{
            $valUser = User::where('email',$row[3])->first();
            if($row[0]!=null && $valUser==null){
                $user = User::create([
                    'designation'  => $row[0],
                    'name' => $row[0],
                    'email' => $row[1],
                    'type' => $role->name,
                    'location' => $location,
                    'location_type' =>   $lisasonOffice,
                    'department_id' => $departments->id,
                    'unit_id' => $units,
                    'sub_unit_id' => $subunit!=null? $subunit->id : null ,
                    'password' => Hash::make('NITT@2024'),
                    'level' => $row[9],
                ]);
            }
        }

        if(count($this->failed_upload)>0){
            $this->dispatchBrowserEvent('error',['error'=>'Some staff were not uploaded. Kindly download the failed excel record to ensure they are currently inputed']);
        }else{
            $this->dispatchBrowserEvent('success',['success'=>'Upload Successful']);
        }

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
