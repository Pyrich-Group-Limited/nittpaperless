<?php

namespace App\Http\Controllers;

use App\Models\CustomField;
use App\Models\Employee;
use App\Models\LoginDetail;
use App\Models\User;
use App\Models\Department;
use App\Models\UserCompany;
use App\Models\Designation;
use App\Models\Unit;
use App\Models\Subunit;
use Auth;
use File;
use App\Models\Utility;
use App\Models\UserToDo;
use App\Models\LiasonOffice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Session;
use Spatie\Permission\Models\Role;
use App\Services\DataService;
use App\Exports\FailedUsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Signature;
use Storage;



class  UserController extends Controller
{
    private $dataService;
    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    public function index()
    {
        $user = \Auth::user();
        if(\Auth::user()->can('manage user'))
        {
            $roles = [];
            $users = User::paginate(12);
            // $users = User::where('created_by', '=', $user->creatorId())->where('type', '!=', 'client')->get();
            $customFields = CustomField::where('created_by', '=', \Auth::user()->creatorId())->where('module', '=', 'user')->get();
            $user  = \Auth::user();
            $allRoles = Role::all();
            foreach($allRoles as $role){
                $roles[] = $role->id = $role->name=="client"? "Human Resource (HR)" : ucwords($role->name);
            }
            $departments = Department::where('category','department')->get()->pluck('name', 'id');
            $designations = Designation::all()->pluck('name', 'id');
            // $designations = Designation::all()->pluck('name', 'id');
            $liasons = $this->dataService->getLiasons();
            $headquaters = $this->dataService->getHeadquaters();
            $directorates = Department::where('category','directorate')->get()->pluck('name', 'id');
            return view('user.index',compact(
                'designations',
                'roles',
                'departments',
                'customFields',
                'liasons',
                'headquaters',
                'directorates'
                ))->with('users', $users);
        }
        else
        {
            return redirect()->back();
        }

    }

    public function getDepartments($id){
         echo $units = json_encode(Unit::where('department_id',$id)->get());
        //  return $units;
    }

    public function getSubUnits($id){
        $subunits = Subunit::where('unit_id',$id)->get();

        if(count($subunits)>0){
            echo json_encode($subunits);
        }else{
            echo 0;
        }
   }

    public function create()
    {

        $customFields = CustomField::where('created_by', '=', \Auth::user()->creatorId())->where('module', '=', 'user')->get();
        $user  = \Auth::user();
        $roles = Role::all()->pluck('name', 'id');
        $departments = Department::where('category','department')->get()->pluck('name', 'id');
        $designations = Designation::all()->pluck('name', 'id');
        $liasons =  LiasonOffice::all()->pluck('name', 'id');
        if(\Auth::user()->can('create user'))
        {
            return view('user.create', compact('roles', 'customFields','departments','designations', 'liasons'));
        }
        else
        {
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $data;
        if(\Auth::user()->can('create user'))
        {

            $data = $request->validate([
                'surname' => ['required','max:120'],
                'firstname' => ['required','max:120'],
                'email' => 'required|email|unique:users',
                'surname' => ['required'],
                'designation' => ['required'],
                'level' => ['required'],
                'location' => ['required'],
                'headquarters' => ['required'],
            ]);

            if($data['location']=="headquater"){
                $data = $request->validate([
                    'directorate' => ['required'],
                ]);
            }else{
                $data = $request->validate([
                    'liason' => ['required'],
                    'department' => ['required'],
                    'unit' => ['required'],
                ]);
            }

            $location_type = $data['location']=="Headquater"? $data['headquaters'] : "Liason Office";

            $user = User::create([
                'name' => $data['surname']." ".$data['firstname'],
                'location' => $data['location'],
                'location_type' =>  $location_typ,
                'department_id' => $data['department'],
                'directorate_id' => $data['directorate'],
                'unit_id' => $data['unit'],
                'sub_unit_id' => $data['subunit'],
            ]);
            // $default_language = DB::table('settings')->select('value')->where('name', 'default_language')->first();
            // $validator = \Validator::make(
            //     $request->all(), [
            //                        'firsname' => 'required|max:120',
            //                        'surname' => 'required|max:120',
            //                        'email' => 'required|email|unique:users',
            //                        'password' => 'required|min:6',
            //                        'role' => 'required',
            //                        'designation' => 'required',
            //                        'directorate' => 'required',
            //                        'department' => 'required',
            //                        'unit' => 'required',
            //                        'level' => 'required',
            //                    ]
            // );

            // if($validator->fails())
            // {
            //     $messages = $validator->getMessageBag();
            //     return redirect()->back()->with('error', $messages->first());
            // }


            $objUser    = \Auth::user();
            $role_r                = Role::findById($request->role);


            // $branch                = Branch::where('id', $request->branch_id)->first();
            // $department            = Department::where('id', $request->department_id)->first();
            // $unit                  = Unit::where('id', $request->unit_id)->first();
            // $designation           = Designation::where('id', $request->designation_id)->first();

            $psw                   = "NITT@2024";
            $request['password']   = Hash::make($request->password);
            $request['type']       =  $role_r->name;
            $request['designation']       = $request->designation;
            $request['department_id']       = $request->department;
            $request['unit_id']       = $request->unit;
            $request['name']       = $request->surname." ".$request->firstname;
            $request['level']       = $request->level;
            $request['lang']       = !empty($default_language) ? $default_language->value : 'en';
            $request['created_by'] = \Auth::user()->creatorId();
            $user = User::create($request->all());
            $user->assignRole($role_r);

            if($request['type'] != 'client')
                \App\Models\Utility::employeeDetails($user->id,\Auth::user()->creatorId());

            //Send Email
            $setings = Utility::settings();
            if($setings['new_user'] == 1)
            {
                $user->password = $psw;
                $user->type     = $role_r->name;


                $userArr = [
                    'email' => $user->email,
                    'password' =>  $user->password,
                ];
                $resp = Utility::sendEmailTemplate('new_user', [$user->id => $user->email], $userArr);

                return redirect()->route('users.index')->with('success', __('User successfully created.') . ((!empty($resp) && $resp['is_success'] == false && !empty($resp['error'])) ? '<br> <span class="text-danger">' . $resp['error'] . '</span>' : ''));
            }

            return redirect()->route('users.index')->with('success', __('User successfully created.'));
        }
        else
        {
            return redirect()->back();
        }

    }
    public function show()
    {
        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $userId = $id;
        if(\Auth::user()->can('edit user'))
        {
               return view('user.edit',compact('userId'));
        }
        else
        {
            return redirect()->back();
        }

    }


    public function update(Request $request, $id)
    {

        if(\Auth::user()->can('edit user'))
        {
            if(\Auth::user()->type == 'super admin')
            {
                $user = User::findOrFail($id);
                $validator = \Validator::make(
                    $request->all(), [
                                       'name' => 'required|max:120',
                                       'email' => 'required|email|unique:users,email,' . $id,
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();
                    return redirect()->back()->with('error', $messages->first());
                }

                $role = Role::findById($request->role);
                $input = $request->all();
                $input['type'] = $role->name;

                $user->fill($input)->save();
                CustomField::saveData($user, $request->customField);

                $roles[] = $request->role;
                $user->roles()->sync($roles);

                return redirect()->route('users.index')->with(
                    'success', 'User successfully updated.'
                );
            }
            else
            {
                $user = User::findOrFail($id);
                $this->validate(
                    $request, [
                                'name' => 'required|max:120',
                                'email' => 'required|email|unique:users,email,' . $id,
                                'role' => 'required',
                            ]
                );

                $role          = Role::findById($request->role);
                $input         = $request->all();
                $input['type'] = $role->name;
                $user->fill($input)->save();
                Utility::employeeDetailsUpdate($user->id,\Auth::user()->creatorId());
                CustomField::saveData($user, $request->customField);

                $roles[] = $request->role;
                $user->roles()->sync($roles);

                return redirect()->route('users.index')->with(
                    'success', 'User successfully updated.'
                );
            }
        }
        else
        {
            return redirect()->back();
        }
    }


    public function destroy($id)
    {

        if(\Auth::user()->can('delete user'))
        {
            $user = User::find($id);
            if($user)
            {
                if(\Auth::user()->type == 'super admin')
                {
                    if($user->delete_status == 0)
                    {
                        $user->delete_status = 1;
                    }
                    else
                    {
                        $user->delete_status = 0;
                    }
                    $user->save();
                }
                if(\Auth::user()->type == 'super admin')
                {
                    $employee = Employee::where(['user_id' => $user->id])->delete();
                    if($employee){
                        $delete_user = User::where(['id' => $user->id])->delete();
                        if($delete_user){
                            return redirect()->route('users.index')->with('success', __('User successfully deleted .'));
                        }else{
                            return redirect()->back()->with('error', __('Something is wrong.'));
                        }
                    }else{
                        return redirect()->back()->with('error', __('Something is wrong.'));
                    }
                }

                return redirect()->route('users.index')->with('success', __('User successfully deleted .'));
            }
            else
            {
                return redirect()->back()->with('error', __('Something is wrong.'));
            }
        }
        else
        {
            return redirect()->back();
        }
    }

    public function profile()
    {
        $userDetail              = \Auth::user();
        $userDetail->customField = CustomField::getData($userDetail, 'user');
        $customFields            = CustomField::where('created_by', '=', \Auth::user()->creatorId())->where('module', '=', 'user')->get();

        return view('user.profile', compact('userDetail', 'customFields'));
    }

    public function editprofile(Request $request)
    {

        $userDetail = \Auth::user();
        $user       = User::findOrFail($userDetail['id']);
        $this->validate(
            $request, [
                        'name' => 'required|max:120',
                        'email' => 'required|email|unique:users,email,' . $userDetail['id'],
                    ]
        );
        if($request->hasFile('profile'))
        {
            $filenameWithExt = $request->file('profile')->getClientOriginalName();
            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension       = $request->file('profile')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $dir        = storage_path('uploads/avatar/');
            $image_path = $dir . $userDetail['avatar'];

            if(File::exists($image_path))
            {
                File::delete($image_path);
            }

            if(!file_exists($dir))
            {
                mkdir($dir, 0777, true);
            }
            $path = $request->file('profile')->storeAs('uploads/avatar/', $fileNameToStore);


        }

        if(!empty($request->profile))
        {
            $user['avatar'] = $fileNameToStore;
        }
        $user['name']  = $request['name'];
        $user['email'] = $request['email'];
        $user->save();
        CustomField::saveData($user, $request->customField);

        return redirect()->route('dashboard')->with(
            'success', 'Profile successfully updated.'
        );
    }

    public function updatePassword(Request $request)
    {
        if(Auth::Check())
        {
            $request->validate(
                [
                    'old_password' => 'required',
                    'password' => 'required|min:6',
                    'password_confirmation' => 'required|same:password',
                ]
            );
            $objUser          = Auth::user();
            $request_data     = $request->All();
            $current_password = $objUser->password;
            if(Hash::check($request_data['old_password'], $current_password))
            {
                $user_id            = Auth::User()->id;
                $obj_user           = User::find($user_id);
                $obj_user->password = Hash::make($request_data['password']);;
                $obj_user->save();

                return redirect()->route('profile', $objUser->id)->with('success', __('Password successfully updated.'));
            }
            else
            {
                return redirect()->route('profile', $objUser->id)->with('error', __('Please enter correct current password.'));
            }
        }
        else
        {
            return redirect()->route('profile', \Auth::user()->id)->with('error', __('Something is wrong.'));
        }
    }

    // Method to handle the signature update
    public function updateSignature(Request $request)
    {
        $request->validate([
            'signature' => 'required|image|mimes:jpeg,png,jpg,gif|max:1048',
        ]);

        $user = Auth::user();
        $signature = $user->signature;  // Find the user's existing signature

        // Handle the new signature upload
        if ($request->hasFile('signature')) {
            // Store the new file
            $filePath = $request->file('signature')->store('signatures', 'public');

            // Delete the old signature file if it exists
            if ($signature && Storage::disk('public')->exists($signature->signature_path)) {
                Storage::disk('public')->delete($signature->signature_path);
            }

            // Update or create the user's signature record
            Signature::updateOrCreate(
                ['user_id' => $user->id],  // Condition
                ['signature_path' => $filePath]  // New data
            );

            return redirect()->back()->with('success', 'Signature updated successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload the signature.');
    }


    // User To do module
    public function todo_store(Request $request)
    {
        $request->validate(
            ['title' => 'required|max:120']
        );

        $post            = $request->all();
        $post['user_id'] = Auth::user()->id;
        $todo            = UserToDo::create($post);


        $todo->updateUrl = route(
            'todo.update', [
                             $todo->id,
                         ]
        );
        $todo->deleteUrl = route(
            'todo.destroy', [
                              $todo->id,
                          ]
        );

        return $todo->toJson();
    }

    public function todo_update($todo_id)
    {
        $user_todo = UserToDo::find($todo_id);
        if($user_todo->is_complete == 0)
        {
            $user_todo->is_complete = 1;
        }
        else
        {
            $user_todo->is_complete = 0;
        }
        $user_todo->save();
        return $user_todo->toJson();
    }

    public function todo_destroy($id)
    {
        $todo = UserToDo::find($id);
        $todo->delete();

        return true;
    }

    // change mode 'dark or light'
    public function changeMode()
    {
        $usr = Auth::user();
        if($usr->mode == 'light')
        {
            $usr->mode      = 'dark';
            $usr->dark_mode = 1;
        }
        else
        {
            $usr->mode      = 'light';
            $usr->dark_mode = 0;
        }
        $usr->save();

        return redirect()->back();
    }

    public function upgradePlan($user_id)
    {
        $user = User::find($user_id);

        $plans = Plan::get();

        return view('user.plan', compact('user', 'plans'));
    }
    public function activePlan($user_id, $plan_id)
    {

        $user       = User::find($user_id);
        $assignPlan = $user->assignPlan($plan_id);
        $plan       = Plan::find($plan_id);
        if($assignPlan['is_success'] == true && !empty($plan))
        {
            $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
            Order::create(
                [
                    'order_id' => $orderID,
                    'name' => null,
                    'card_number' => null,
                    'card_exp_month' => null,
                    'card_exp_year' => null,
                    'plan_name' => $plan->name,
                    'plan_id' => $plan->id,
                    'price' => $plan->price,
                    'price_currency' => isset(\Auth::user()->planPrice()['currency']) ? \Auth::user()->planPrice()['currency'] : '',
                    'txn_id' => '',
                    'payment_status' => 'succeeded',
                    'receipt' => null,
                    'user_id' => $user->id,
                ]
            );

            return redirect()->back()->with('success', 'Plan successfully upgraded.');
        }
        else
        {
            return redirect()->back()->with('error', 'Plan fail to upgrade.');
        }

    }

    public function userPassword($id)
    {
        $eId        = \Crypt::decrypt($id);
        $user = User::find($eId);

        return view('user.reset', compact('user'));

    }

    public function userPasswordReset(Request $request, $id)
    {
        $validator = \Validator::make(
            $request->all(), [
                               'password' => 'required|confirmed|same:password_confirmation',
                           ]
        );

        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }


        $user                 = User::where('id', $id)->first();
        $user->forceFill([
                             'password' => Hash::make($request->password),
                         ])->save();

        return redirect()->route('users.index')->with(
            'success', 'User Password successfully updated.'
        );


    }

    //start for user login details
    public function userLog(Request $request)
    {

        $filteruser = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $filteruser->prepend('Select User', '');

        $query = DB::table('login_details')
            ->join('users', 'login_details.user_id', '=', 'users.id')
            ->select(DB::raw('login_details.*, users.id as user_id , users.name as user_name , users.email as user_email ,users.type as user_type'))
            ->where(['login_details.created_by' => \Auth::user()->id]);

        if(!empty($request->month))
        {
            $query->whereMonth('date', date('m',strtotime($request->month)));
            $query->whereYear('date', date('Y',strtotime($request->month)));
        }else{
            $query->whereMonth('date', date('m'));
            $query->whereYear('date', date('Y'));
        }

        if(!empty($request->users))
        {
            $query->where('user_id', '=', $request->users);
        }
        $userdetails = $query->get();
        $last_login_details = LoginDetail::where('created_by', \Auth::user()->creatorId())->get();

        return view('user.userlog', compact( 'userdetails','last_login_details','filteruser'));
    }

    public function userLogView($id)
    {
        $users = LoginDetail::find($id);

        return view('user.userlogview', compact('users'));
    }

    public function userLogDestroy($id)
    {
        $users = LoginDetail::where('user_id', $id)->delete();
        return redirect()->back()->with('success', 'User successfully deleted.');
    }

    //end for user login details

    public function uploadUser(Request $request)
    {
        $data = $request->validate([
            'uploadFile' => ['required','file','mimes:xlsx,csv,xls'],
        ]);

        $sn = 0;

        try{
            $staffs  = Excel::toArray(new UsersImport, $data['uploadFile']);

            dd($staffs );
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

    public function uploadUserRecord($row){
        dd($row);

        $departments = Department::where('',$row['3'])->first();
        $designations = Designation::where('',$row['4'])->first();
        $liasons = $this->dataService->getLiasons();
        $headquaters = $this->dataService->getHeadquaters();
        $directorates = $this->dataService->getDirectorates();

        if($branch==null || $department==null || $unit==null){
            if($branch==null){
                $this->setFailedUpload($row,"Invalid Branch");
            }elseif($department==null){
                $this->setFailedUpload($row,"Invalid Department");
            }elseif($unit==null){
                $this->setFailedUpload($row,"Invalid Unit");
            }
        }else{
            $valUser = User::where('email',$row[3])->first();
            if($row[0]!=null && $valUser==null){
                $user = User::create([
                    'designation'  => $row[0],
                    'surname' => $row[1],
                    'othernames' => $row[2],
                    'email' => $row[3],
                    'user_type' => $row[4],
                    'branch_id' => $branch->id,
                    'department_id' => $department->id,
                    'password' => Hash::make('12345678'),
                ]);

                $role = Role::where('name',trim($row[4]))->first();

                if($role!=null){
                    $user->assignRole([$row[4]]);
                    $user->givePermissionTo($role->permissions->pluck('name'));
                }else{
                    $this->setFailedUpload($row,"Undefined Role (User type)");
                    $user->delete();
                }

                $this->sendMail($user);

            }
        }

        if(count($this->failed_upload)>0){
            $this->dispatchBrowserEvent('errorfeedback',['errorfeedback'=>'Some staff were not uploaded. Kindly download the failed excel record to ensure they are currently inputed']);
        }else{
            $this->dispatchBrowserEvent('feedback',['feedback'=>'Upload Successful']);
        }

    }
}
