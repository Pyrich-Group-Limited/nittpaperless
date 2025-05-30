<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Department;
use App\Models\UserCompany;
use App\Models\Designation;
use App\Models\LiasonOffice;
use App\Models\Unit;
use App\Models\Subunit;
use App\Models\Employee;
use Spatie\Permission\Models\Role;
use App\Services\DataService;
use App\Exports\FailedUsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Mail;
use App\Mail\StaffProfileMail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class UsersComponent extends Component
{
    use WithFileUploads;
    public $uploadFile;
    public $failed_upload = [];
    protected $listeners = [
        'reset-confimred'=>'resetPassword',
        'reset-code-confimred' => 'resetSecretCode'
    ]; // listen to comfirmatio delete and call delete branch function

    public $actionId;
    public $selUser;
    public $departments = [];
    public $permissions=[];
    public $sel_permissions = [];
    public $units = [];
    public $subunits = [];
    public $surname;
    public $firstname;
    public $email;
    public $location;
    public $location_type;
    public $department;
    public $designation;
    public $ippis;
    public $level;
    public $unit;
    public $subunit;
    public $user_role;
    public $searchTerm;


    public function updatedDepartment($id){
        $this->units = Unit::where('department_id',$id)->get();
    }


    public function resetPassword(){
        $user = User::find($this->actionId);
        $status = Password::sendResetLink(
            $user->only('email')
        );
        User::find($this->actionId)->update([
            'password' => Hash::make('12345678'),
        ]);

        $this->dispatchBrowserEvent('success',['success'=>'Password Successfuly Reset']);
    }

    public function resetSecretCode()
    {
        $user = User::find($this->actionId);

        if (!$user) {
            $this->dispatchBrowserEvent('error', ['error' => 'User not found.']);
            return;
        }

        // Check if the user has a secret code
        if (!$user->secret_code) {
            $this->dispatchBrowserEvent('error', ['error' => 'User does not have a secret code to reset.']);
            return;
        }

        // Reset secret code
        $user->update([
            'secret_code' => null,
        ]);
        $this->dispatchBrowserEvent('success', ['success' => 'Secret Code Successfully Reset']);
    }

    public function getPermission(User $user){
        // $modulePermissions = Permission::all()->pluck('name')->toArray();
        $this->selUser = $user;
        $this->permissions = $user->getDirectPermissions()->pluck('name')->toArray();
        $this->sel_permissions = $user->getDirectPermissions()->pluck('name')->toArray();

    }

    public function clearSearch(){
        $this->searchTerm = "";
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
            'ippis' => ['required'],
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
        $password = substr($this->surname, 0, 4).date('s')."#".sprintf('%04s', count(User::all())+1);

        $userType = $this->user_role == "Human Resource (HR)" ? "client" : strtolower($this->user_role);

        $user = User::create([
            'name' => $this->surname. " ".$this->firstname,
            'location' => $this->location,
            'email' => $this->email,
            'location_type' =>   $this->location == "Headquarters" ? $this->location_type : LiasonOffice::find($this->location_type)->name,
            'department_id' => $this->department,
            'unit_id' => $this->unit,
            'sub_unit_id' => $this->subunit,
            'type' => $userType,
            'designation' => $designation->name,
            'ippis' => $this->ippis,
            'level' => $this->level,
            'password' => Hash::make("12345678"),
            'password_changed' => false,
        ]);

        // Assign role and permissions
        $role = Role::firstOrCreate(['name' => $userType]); // Ensure the role exists
        assignPermissionsToRole($role, $userType); // Call the helper function
        $user->assignRole($role); // Assign the role to the user

        $department = Department::find($user->department_id);
        $unit = Unit::find($user->unit_id);

        // Get permissions for department & unit
        $departmentPermissions = getDepartmentPermissions($department->name ?? '');
        $unitPermissions = getUnitPermissions($unit->name ?? '');

        // Merge both department and unit permissions
        $allPermissions = array_merge($departmentPermissions, $unitPermissions);

        // Assign permissions to user
        if (!empty($allPermissions)) {
            $user->givePermissionTo($allPermissions);
        }

        $this->sendMail($user,$password);
        $this->reset();
        $this->dispatchBrowserEvent('success',["success" =>"User created successfully with assigned default permissions."]);
    }

    public function sendMail($user,$password){
        $url = url('login/');
        try{
            Mail::to($user)->queue(new StaffProfileMail($user,$url,"12345678"));
        }catch (\Exception $e) { }

    }

    public function updateUser(){
        $this->validate([
            'surname' => ['required','max:120'],
            'firstname' => ['required','max:120'],
            'email' => ['required','email','unique:users,email,'.$this->selUser->id],
            'surname' => ['required'],
            'designation' => ['required'],
            'ippis' => ['required'],
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
            'ippis' => $this->ippis,
            'level' => $this->level,
        ]);
        // $this->reset();
        $this->dispatchBrowserEvent('success',["success" =>"User Successfully Updated"]);
    }

    public function updatedLocation(){
        $this->location_type = "";
    }

    public function updatedUnit($id){
        $this->subunits = Subunit::where('unit_id',$id)->get();
    }

    public function setActionId($id){
        $this->actionId = $id;
    }

    public function selUser($id){
        $this->selUser = User::find($id);

        $lisasonOffices = LiasonOffice::where('id',$this->selUser->location_type)->first();
        $designation = Designation::where('name',$this->selUser->designation)->first();
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
        $this->firstname = isset($name[1]) ? $name[1] : '';
        $this->email = $this->selUser->email;
        $this->location = ucwords($this->selUser->location);
        $this->location_type =  ucwords($location_type);
        $this->department = $this->selUser->department_id;
        $this->designation = $designation!=null? $designation->id : "";
        $this->ippis = $this->selUser->ippis;
        $this->level = $this->selUser->level;
        $this->unit = $this->selUser->unit_id;
        $this->subunit = $this->selUser->subunit;
        $this->user_role = ucwords($this->selUser->type);
    }

    // public function uploadUser()
    // {
    //     set_time_limit(0);
    //     $this->validate([
    //         'uploadFile' => ['required','file','mimes:xlsx,csv,xls'],
    //     ]);

    //     $sn = 0;

    //     try{
    //         $staffs  = Excel::toArray(new UsersImport, $this->uploadFile);

    //         foreach($staffs[0] as $row){
    //             $this->uploadUserRecord($row);
    //         }

    //         if(count($this->failed_upload)>0){
    //             $this->dispatchBrowserEvent('error',['error'=>'Some staff were not uploaded. Kindly download the failed excel record to ensure they are currently inputed']);
    //         }else{
    //             $this->dispatchBrowserEvent('success',['success'=>'Upload Successful']);
    //         }

    //     }catch(Throwable $e){
    //         return back()->with('error','There was an error uploading record kindly ensure your data is properly arranged and upload again');
    //     }
    // }

    public function uploadUser()
    {
        set_time_limit(0);

        $this->validate([
            'uploadFile' => ['required','file','mimes:xlsx,csv,xls'],
        ]);

        try {
            $staffs = Excel::toArray(new UsersImport, $this->uploadFile);

            foreach ($staffs[0] as $row) {
                $user = $this->uploadUserRecord($row); // Make sure this returns the created user

                if ($user) {
                    $userType = $user->type ?? 'Staff'; // or however your user type is set

                    // Assign role
                    $role = Role::firstOrCreate(['name' => $userType]);
                    assignPermissionsToRole($role, $userType);
                    $user->assignRole($role);

                    $department = Department::find($user->department_id);
                    $unit = Unit::find($user->unit_id);

                    $departmentPermissions = getDepartmentPermissions($department->name ?? '');
                    $unitPermissions = getUnitPermissions($unit->name ?? '');

                    $allPermissions = array_merge($departmentPermissions, $unitPermissions);

                    if (!empty($allPermissions)) {
                        $user->givePermissionTo($allPermissions);
                    }
                }
            }

            if (count($this->failed_upload) > 0) {
                $this->dispatchBrowserEvent('error', [
                    'error' => 'Some staff were not uploaded. Kindly download the failed excel record to ensure they are correctly inputted.'
                ]);
            } else {
                $this->dispatchBrowserEvent('success', [
                    'success' => 'Upload Successful'
                ]);
            }

        } catch (Throwable $e) {
            return back()->with('error', 'There was an error uploading record. Kindly ensure your data is properly arranged and try again.');
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
            'ippis' => "",
            'comment' => $comment,
        ];
    }

    // public function uploadUserRecord($row){
    //     set_time_limit(0);
    //     $subunit = null;
    //     $units = null;
    //     $departments = Department::where('name',$row['4'])->first();
    //     $designations = Designation::where('name',$row['8'])->first();
    //     if($designations==null){
    //         $designations = Designation::Create([
    //             'name' => $row['8']
    //         ]);
    //     }
    //     if($departments!=null){
    //         $units = Unit::where('name',$row[5])->first();
    //         // $units = Unit::where('name',$row[5])->where('department_id',$departments->id)->first();
    //     }else{
    //         $departments = Department::create([
    //             'name' => $row['4'],
    //             'category' => "department",
    //         ]);
    //     }

    //     if($units!=null){
    //         $subunit = SubUnit::where('name',$row[6])->first();
    //         // $subunit = SubUnit::where('name',$row[6])->where('unit_id',$units->id)->first();
    //     }else{
    //         $units = Unit::create([
    //             'department_id' => $departments->id,
    //             'name' => $row[5]
    //         ]);

    //         $subunit = SubUnit::where('name',$row[5])->first();

    //         if($subunit!=null){
    //             $subunit = Subunit::create([
    //                 'unit_id' => $units->id,
    //                 'name' => $row[6]
    //             ]);
    //         }

    //     }
    //     $lisasonOffice = null;
    //     $location = strtolower($row[2]);
    //     $location_type = strtolower($row[3]);
    //     $selRole = $row[7]=="Human Resource (HR)"? "client" : strtolower($row[7]);
    //     $role = Role::where('name',$row[7])->first();

    //     if(($location == "headquarters" && $location_type=="department") || ($location == "headquarters" && $location_type=="directorate")){
    //         $lisasonOffice = strtolower($row[3]);
    //     }else{
    //         $lisasonOffice = strtolower($row[3]);
    //         // $lisasonOffice = LiasonOffice::where('id',strtolower($row[3]))->first()->name;

    //     }

    //     if($departments==null){
    //         $this->setFailedUpload($row,"Invalid Department");
    //     }elseif($designations==null){
    //         $this->setFailedUpload($row,"Invalid Designation");
    //     }elseif($lisasonOffice==null){
    //         $this->setFailedUpload($row,"Invalid Liason Office");
    //     }elseif($location_type==null){
    //         $this->setFailedUpload($row,"Invalid Office Category");
    //     }elseif($units==null){
    //         $this->setFailedUpload($row,"Invalid Department Unit");
    //     }elseif($role==null){
    //         $this->setFailedUpload($row,"Invalid User Role");
    //     }else{
    //         $valUser = User::where('email',$row[1])->first();
    //         if($valUser==null){
    //             $user = User::create([
    //                 'ippis'  =>"",
    //                 'designation'  => $row[8],
    //                 'name' => $row[0],
    //                 'email' => $row[1],
    //                 'type' => $role->name,
    //                 'location' => ucwords($location),
    //                 'location_type' =>   ucwords($lisasonOffice),
    //                 'department_id' => $departments->id,
    //                 'unit_id' => $units,
    //                 'sub_unit_id' => $subunit!=null? $subunit->id : null ,
    //                 'level' => $row[9],
    //                 'password' =>bcrypt('12345678'),
    //             ]);

    //              // Assign role and permissions
    //             assignPermissionsToRole($role, $role->name); // Custom helper function (if available)
    //             $user->assignRole($role);

    //             $departmentPermissions = getDepartmentPermissions($departments->name ?? '');
    //             $unitPermissions = getUnitPermissions($units->name ?? '');

    //             $allPermissions = array_merge($departmentPermissions, $unitPermissions);

    //             if (!empty($allPermissions)) {
    //                 $user->givePermissionTo($allPermissions);
    //             }
    //             // $this->sendMail($user);

    //         }
    //     }
    // }

    public function uploadUserRecord($row)
    {
        set_time_limit(0);

        $subunit = null;
        $units = null;

        $departments = Department::where('name', $row[4])->first();
        $designations = Designation::firstOrCreate(['name' => $row[8]]);

        if (!$departments) {
            $departments = Department::create([
                'name' => $row[4],
                'category' => "department",
            ]);
        }

        if ($departments) {
            $units = Unit::where('name', $row[5])->first();
        }

        if (!$units) {
            $units = Unit::create([
                'department_id' => $departments->id,
                'name' => $row[5],
            ]);
        }

        $subunit = SubUnit::firstOrCreate([
            'unit_id' => $units->id,
            'name' => $row[6] ?? '',
        ]);

        $location = strtolower($row[2]);
        $location_type = strtolower($row[3]);
        $lisasonOffice = strtolower($row[3]);

        $roleName = $row[7] === "Human Resource (HR)" ? "client" : strtolower($row[7]);
        $role = Role::firstOrCreate(['name' => $row[7]]);

        if (!$departments || !$designations || !$lisasonOffice || !$location_type || !$units || !$role) {
            $this->setFailedUpload($row, "Invalid Data: Check department, designation, location or role");
            return null;
        }

        $valUser = User::where('email', $row[1])->first();

        if (!$valUser) {
            $user = User::create([
                'ippis' => "",
                'designation' => $row[8],
                'name' => $row[0],
                'email' => $row[1],
                'type' => $role->name,
                'location' => ucwords($location),
                'location_type' => ucwords($lisasonOffice),
                'department_id' => $departments->id,
                'unit_id' => $units->id,
                'sub_unit_id' => $subunit->id ?? null,
                'level' => $row[9],
                'password' => bcrypt('12345678'),
            ]);
            assignPermissionsToRole($role, $role->name);
            $user->assignRole($role);
          
            $this->sendMail($user,"12345678");

            $departmentPermissions = getDepartmentPermissions($departments->name ?? '');
            $unitPermissions = getUnitPermissions($units->name ?? '');

            $allPermissions = array_merge($departmentPermissions, $unitPermissions);

            if (!empty($allPermissions)) {
                $user->givePermissionTo($allPermissions);
            }

            return $user;
        }

        return null;
    }


    public function getUsers(){
        $users = User::query()
        ->where('type', '!=', 'contractor')
        ->where(function($query) {
            if($this->searchTerm) {
                $query->where('name', 'like', '%'.$this->searchTerm.'%');
            }
        })
        ->orwhere(function($query) {
            if($this->searchTerm) {
                $department = Department::where('name', 'like', '%'.$this->searchTerm.'%')->get()->pluck('id');
                $query->whereIn('department_id', $department);
            }
         })
         ->orwhere(function($query) {
            if($this->searchTerm) {
                $unit = Unit::where('name', 'like', '%'.$this->searchTerm.'%')->get()->pluck('id');
                $query->whereIn('unit_id', $unit);
            }
         })
         ->latest()->paginate(10);
         return $users;
    }

    public function render()
    {
        $user = \Auth::user();
        if(\Auth::user()->can('manage user'))
        {
            $roles = [];
            $users = $this->getUsers();
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
