<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\CreateOlStudentRequest;
use App\Http\Requests\CreateAlStudentRequest;
use App\Http\Requests\UpdateOlStudentRequest;
use App\Http\Requests\UpdateAlStudentRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StudentResetPassword;
use App\User;
use App\Student;
use App\Kidato;
use App\Darasa;
use App\Role;
use App\Combination;
use DB;
use Hash;
use Auth;

class StudentController extends Controller
{
    /**
     * @var Student
     */
    private $student;

    /**
     * Constructor to initialize object
     *
     * @param Student $student
     */
    public function __construct(Student $student)
    {
        $this->middleware('auth');
        $this->student = $student;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function o_index(Request $request)
    {
       $students = $this->student->where('level', '=', '0')->orderBy('id','DESC')->paginate(10);
        return view('students.o-index',compact('students'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function a_index(Request $request)
    {
       $students = $this->student->where('level', '=', '1')->orderBy('id','DESC')->paginate(10);
        return view('admins.students.a_index',compact('students'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function o_create()
    {
        $year = Carbon::now()->year;
        $classes = Darasa::where('year', $year)->where('level', '0')
                                ->orderBy('name')
                                ->orderBy('stream')->get();
        $level='O-Level';
        $roles = Role::all('id', 'display_name')->where('display_name', '=', 'Student');

            foreach ($roles as $role) {
                $role_id = $role->id;
            }

        return view('students.o-create', compact('classes', 'level', 'role_id'));
    }

    public function a_create()
    {
        $forms = Form::all('id', 'name', 'level')->where('level', '=', 1);
        $combinations = Combination::all('id', 'name');
        $level='A-Level';
        $roles = Role::all('id', 'display_name')->where('display_name', '=', 'Student');

            foreach ($roles as $role) {
                $role_id = $role->id;
            }
        return view('admins.students.a_create', compact('forms', 'level', 'combinations', 'role_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function o_store(CreateOlStudentRequest $request)
    {   
       //Transaction if one fail all query will fails..
        DB::transaction(function($request) use ($request)
        {
            $password = Hash::make($request->get('password'));
            $name = $request->get('first_name')." ". $request->get('last_name');
            $user = User::create([
                'name' => $name,
                'email' => $request->get('email'),
                'password' => $password,
                'gender' => $request->get('gender'),
            ]);

            //Attaching role to the user created
            $user->attachRole($request->get('role_id'));

            $user_id = $user->id;
            $status = '1';
            $level = '0';
            $student = Student::create([
                    'user_id' => $user_id,
                    'first_name' => $request->get('first_name'),
                    'middle_name' => $request->get('middle_name'),
                    'last_name' => $request->get('last_name'),
                    'reg_no' => $request->get('reg_no'),
                    'address' => $request->get('address'),
                    'mobile_no' => $request->get('mobile'),
                    'dob' => $request->get('dob'),
                    'year_admitted' => $request->get('year_admitted'),
                    'status' => $status,
                    'level' => $level,
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
            ]);

                $mwaka = date('Y');
                $student_id = $student->id;
                $form_student = DB::table('class_student')->insert([
                    'student_id' => $student_id,
                    'class_id' => $request->get('form_id'),
                    'year' => Carbon::now()->year,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
            ]);
        });

        return back()->with('flash','Student ('.$request->get('first_name').' '. $request->get('last_name').') registered successfully');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function a_store(CreateAlStudentRequest $request)
    {   
       //Transaction if one fail all query will fails..
        DB::transaction(function($request) use ($request)
        {
            $password = Hash::make($request->get('password'));
            //Creating user
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => $password,
                'gender' => $request->get('gender'),
            ]);

            //Attaching role to the user created
            $user->attachRole($request->get('role_id'));

            $user_id = $user->id;
            $status = '1';
            $level = '1';
            $dob = $request->get('year').'-'.$request->get('month').'-'.$request->get('day');
            //Creating student
            $student = Student::create([
                    'user_id' => $user_id,
                    'reg_no' => $request->get('reg_no'),
                    'address' => $request->get('address'),
                    'mobile_no' => $request->get('mobile'),
                    'dob' => $dob,
                    'year_admitted' => $request->get('year_admitted'),
                    'status' => $status,
                    'level' => $level,
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
            ]);

                $mwaka = date('Y');
                $student_id = $student->id;
            //Adding to form_student table
            $form_student = DB::table('form_student')->insert([
                    'student_id' => $student_id,
                    'form_id' => $request->get('form_id'),
                    'year' => $mwaka,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
            ]);

            //Adding to combination student
            $combination_student = DB::table('combination_student')->insert([
                    'student_id' => $student_id,
                    'combination_id' => $request->get('combination'),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
            ]);
        });

        return back()->with('success','Student ('.$request->get('name').') registered successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function o_show($id)
    {
        $student = $this->student->with('user', 'forms', 'addedBy')->find($id);
        if(!$student){
            \App::abort('409');
        }
        // return $student;
        return view('students.o-show',compact('student'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function a_show($id)
    {
        $student = $this->student->with('user', 'combination', 'forms', 'addedBy')->find($id);
        if(!$student){
            \App::abort('409');
        }
        return view('admins.students.a_show',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function o_edit($id)
    {
        $student = $this->student->with('user', 'forms')->find($id);
        if(!$student){
            \App::abort('409');
        }
        //Retriving all forms available..
        $year = Carbon::now()->year;
        $classes = Darasa::where('year', $year)->where('level', '0')->get();

        //Student current form
        foreach ($student->forms as $form) {
            $this_year = Carbon::now()->year;
            if($this_year == $form->pivot->year){
                $currentFormId = $form->id;
            }
        }
        $level='O-Level';
        
        return view('students.o-edit',compact('student', 'classes', 'currentFormId', 'level'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function a_edit($id)
    {
        $student = $this->student->with('user', 'forms')->find($id);
        if(!$student){
            \App::abort('409');
        }

        //Extracting day month and year form dob..
        $time = strtotime($student->dob);
        $day = date("d",$time);
        $month = date("m",$time);
        $year = date("Y",$time);

        //Retriving all forms available..
        $forms = Form::all('id', 'name', 'level')->where('level', 1);

        //Student current form
        foreach ($student->forms as $form) {
            $this_year = date('Y');
            if($this_year == $form->pivot->year){
                $currentFormId = $form->id;
            }
        }

        foreach ($student->combination as $comb) {
            $combId = $comb->id;
        }

        $combinations = Combination::all('id', 'name');
        
        return view('admins.students.a_edit',compact('student', 'forms', 'day', 'month', 'year', 'currentFormId', 'combId', 'combinations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function o_update(UpdateOlStudentRequest $request, $id, $userId)
    {
        //return $request->all();
        //Transaction if one fail all query will fails..
        DB::transaction(function($request) use ($request, $id, $userId)
        {
            $user = User::find($userId);
            if(!$user){
                \App::abort('409');
            }
            $student = $this->student->find($id);
            if(!$student){
                \App::abort('409');
            }
            $name = $request->get('first_name')." ". $request->get('last_name');
            $user->update([
                'name' => $name,
                'email' => $request->get('email'),
                'gender' => $request->get('gender'),
                'updated_by' => Auth::user()->id,
            ]);

            $student->update([
                    'first_name' => $request->get('first_name'),
                    'middle_name' => $request->get('middle_name'),
                    'last_name' => $request->get('last_name'),
                    'reg_no' => $request->get('reg_no'),
                    'address' => $request->get('address'),
                    'mobile_no' => $request->get('mobile'),
                    'dob' => $request->get('dob'),
                    'year_admitted' => $request->get('year_admitted'),
                    'updated_by' => Auth::user()->id,
            ]);

            $mwaka = Carbon::now()->year;
            $matchThese = ['student_id' => $id, 'year' => $mwaka];
            DB::table('class_student')->where($matchThese)->delete();
            DB::table('class_student')->insert([
                    'student_id' => $id,
                    'class_id' => $request->get('form_id'),
                    'year' => $mwaka,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
            ]);
        });

        return redirect()->route('students.o-level')
        ->with('flash','Student ('.$request->get('first_name').' '. $request->get('last_name').') updated successfully');
    }

    public function a_update(UpdateAlStudentRequest $request, $id, $userId)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = $this->student->find($id);
        if(!$student){
            \App::abort('409');
        }
        $userid = $student->user_id;
        $user = User::find($userid);
        if(!$user){
            \App::abort('409');
        }
        //detach role to the user created
        $user->detachRole('student');
        $user->delete();
        return redirect()->route('students.o-level')
                        ->with('flash','Student deleted successfully');
    }

    /**
     * Reset password of student.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function password_reset($id)
    {
        $student = $this->student->with('user')->find($id);
        if(!$student){
            \App::abort('409');
        } 
        return view('students.reset_password',compact('student'));
    }

    /**
     * Reset password of student.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function passwordReset(StudentResetPassword $request, $id, $userId)
    {
        $user = User::find($userId);
        if(!$user){
            \App::abort('409');
        }
        $password = Hash::make($request->get('password'));
        $user->update([
            'password' => $password,
        ]);
        return redirect()->route('olevel.show',$id)
        ->with('flash','Student password reset successfully');
    }

    /**
     * Change student image.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profileImage(Request $request, $id)
    {
        $request->validate([
            'profileimg' => 'required|image|mimes:jpg,png,jpeg|max:200',
        ]);

        $image = $request->file('profileimg');
        $image_name = time().'.'.$image->getClientOriginalExtension();
        $image->move('avatars', $image_name);
        
        $path = 'avatars/'.$image_name;
        $student = $this->student->find($id);
        if(! $student){
            \App::abort('409');
        }
        $student->thumbnail = $path;
        $student->update();
       
        return back()->with('flash', 'Photo changed successfully');
     }
    
     /**
     * Student profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function my_profile($id)
     {
        $student = $this->student->with('user', 'forms', 'addedBy')->where('user_id', $id)->first();
        if(! $student){
            \App::abort('409');
        }

        return view('students.profile',compact('student'));

     }
}
