<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateTeacherSubjectRequest;
use App\User;
use App\Role;
use App\Subject;
use App\Kidato;
use Auth;
use DB;
use Hash;

class UserController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * Constructor to initialize object
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->user->orderBy('id','DESC')->paginate(10);
        return view('admins.users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all('id', 'display_name')->where('display_name', '!=', 'Student');
        return view('admins.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = $this->user->create($input);

        //adding role to role table
        $user->attachRole($input['role_id']);

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->find($id);
        return view('admins.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);
        $roles = Role::all('display_name','id');
        $userRole = $user->roles->pluck('id','id')->toArray();

            foreach ($userRole as $value) {
                $UserRole = $value;
            }

        return view('admins.users.edit',compact('user','roles','UserRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'role_id' => 'required',
            'gender' => 'required',
        ]);

        $input = $request->all();
        $user = $this->user->find($id);

        $user->update($input);

        DB::table('role_user')->where('user_id',$id)->delete();

        $user->attachRole($input['role_id']);

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Change the password of the logged in user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changepassword(ChangePasswordRequest $request)
    {
        $current_password = Auth::User()->password;
        if(Hash::check($request['old_password'], $current_password))
        {
          $user_id = Auth::User()->id;
          $obj_user = $this->user->find($user_id);
          $obj_user->password = Hash::make($request['password']);
          $obj_user->save();
          Auth::logout();
          return redirect()->route('login')->with('success', 'Password changed successfully, please login with new password');
        }else{
          $errors = array('old_password' => 'Please enter correct current password');
          return redirect()
                      ->back()->withInput($request->input())
                    ->withErrors($errors, $this->errorBag());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user->find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    /**
     * Sort users.
     *
     * @return \Illuminate\Http\Response
     */

    public function teachers(Request $request)
    {
       $data = $this->user->whereHas('roles', function($q){
        $q->where('name', 'teacher');
       })->orderBy('id')->paginate(10);
       $staff_t = 'teachers';
       return view('staff.index', compact('data', 'staff_t'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function accountants(Request $request)
    {
       $data = $this->user->whereHas('roles', function($q){
        $q->where('name', 'accountant');
       })->orderBy('id')->paginate(10);

       $staff_t = 'accountants';
       return view('staff.index', compact('data', 'staff_t'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function teacher_subjects($id)
    {
        $user = $this->user->with('teacherSubjects', 'teacherForms')->find($id);
        return view('staff.show',compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function teacher_subjects_create($id)
    {
        $user = $this->user->find($id);
        $subjects = Subject::select('id', 'name')->get();
        $forms = Form::select('id', 'name')->get();
        $year = date('Y');
        return view('staff.create',compact('user', 'subjects', 'forms', 'year'));
    }

     /**
     * Store data to database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function teacher_subjects_store(CreateTeacherSubjectRequest $request, $id)
    {
        DB::table('teacher_subjects')->insert([
            'user_id' => $id,
            'subject_id' => $request->subject_id,
            'form_id' => $request->form_id,
            'year' => $request->year,
            'created_by' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            ]);
        return redirect()->route('staff.subjects.create', $id)
                        ->with('success','Subject added successfully');
    }
}
