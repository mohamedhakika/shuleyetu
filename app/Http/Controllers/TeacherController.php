<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use Carbon\Carbon;
use App\Teacher;
use App\Kidato;
use App\Darasa;
use App\Subject;
use App\Role;
use App\User;
use DB;
use Hash;
use Auth;

class TeacherController extends Controller
{
    /**
     * @var Teacher
     */
     private $teacher;
     
    /**
    * Constructor to initialize object
    *
    * @param Teacher $teacher
    */
    public function __construct(Teacher $teacher)
    {
        $this->middleware('auth');
        $this->teacher = $teacher;
    }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teachers = $this->teacher->orderBy('id','DESC')->paginate(10);
        return view('staff.teachers.index',compact('teachers'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all('id', 'name', 'display_name')->where('name', '=', 'teacher');

            foreach ($roles as $role) {
                $role_id = $role->id;
            }

        return view('staff.teachers.create', compact('role_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTeacherRequest $request)
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
            $teacher = new Teacher();
            $teacher->user_id = $user_id;
            $teacher->first_name = $request->get('first_name');
            $teacher->middle_name = $request->get('middle_name');
            $teacher->last_name = $request->get('last_name');
            $teacher->address = $request->get('address');
            $teacher->mobile_no = $request->get('mobile');
            $teacher->created_by = Auth::user()->id;
            $teacher->updated_by = Auth::user()->id;
            $teacher->save();
        });

        return back()->with('flash','Teacher ('.$request->get('first_name').' '. $request->get('last_name').') registered successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = $this->teacher->find($id);
        if(! $teacher){
            \App::abort('409');
        }

        return view('staff.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = $this->teacher->find($id);
        if(! $teacher){
            \App::abort('409');
        }
        return view('staff.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherRequest $request, $id, $userId)
    {
        //Transaction if one fail all query will fails..
        DB::transaction(function($request) use ($request, $id, $userId)
        {
            $user = User::find($userId);
            if(!$user){
                \App::abort('409');
            }
            $teacher = $this->teacher->find($id);
            if(!$teacher){
                \App::abort('409');
            }
            $name = $request->get('first_name')." ". $request->get('last_name');
            $user->update([
                'name' => $name,
                'email' => $request->get('email'),
                'gender' => $request->get('gender'),
                'updated_by' => Auth::user()->id,
            ]);
            
            $teacher->first_name = $request->get('first_name');
            $teacher->middle_name = $request->get('middle_name');
            $teacher->last_name = $request->get('last_name');
            $teacher->address = $request->get('address');
            $teacher->mobile_no = $request->get('mobile');
            $teacher->updated_by = Auth::user()->id;
            $teacher->update();
        });
        return redirect()->route('teachers.index')
        ->with('flash','Teacher ('.$request->get('first_name').' '. $request->get('last_name').') updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = $this->teacher->find($id);
        if(!$teacher){
            \App::abort('409');
        }
        $userid = $teacher->user_id;
        $user = User::find($userid);
        if(!$user){
            \App::abort('409');
        }
        $user->detachRole('teacher');
        $user->delete();
        return redirect()->route('teachers.index')
                        ->with('flash','Teacher deleted successfully');
    }

    /**
    * Get the subjects of the perticular teacher.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function subjects($id)
    {
        $teacher = $this->teacher->find($id);
        if(!$teacher){
            \App::abort('409');
        }
        $t_id = $teacher->id;
        //return $subjects = $this->teacher->where('id',$id)->with('subjects')->get();
        $subjects = DB::table('teacher_subjects')
            ->join('teachers', 'teachers.id', '=', 'teacher_subjects.teacher_id')
            ->join('classes', 'classes.id', 'teacher_subjects.class_id')
            ->join('subjects', 'subjects.id', '=', 'teacher_subjects.subject_id')
            ->select('teacher_subjects.*', 'classes.name as class_name', 'classes.stream', 'subjects.name as subject_name')
            ->where('teacher_id', $t_id)
            ->get();

        return view('staff.teachers.subjects', compact('subjects', 'teacher'));
    }

    public function addSubjects($id)
    {
        $teacher = $this->teacher->find($id);
        if(!$teacher){
            \App::abort('409');
        }

        $vidato = Kidato::all('id', 'name');
        return view('staff.teachers.add-subjects', compact('teacher', 'vidato'));
    }

    public function subjectsAdd(Request $request, $id)
    {
        $teacher = $this->teacher->find($id);
        if(!$teacher){
            \App::abort('409');
        }
        $request->validate([
            'subject_id' => 'required',
            'class_id' => 'required'
        ]);

        $year = Carbon::now()->year;
        foreach ($request->input('class_id') as $darasa) {
            $ipo = DB::table('teacher_subjects')->where([
                  ['class_id','=', $darasa],
                  ['subject_id','=', $request->get('subject_id')],
                  ['year','=', $year],
                  ])->first();
            if(!$ipo){
                DB::table('teacher_subjects')->insert([
                    'teacher_id' => $id,
                    'subject_id' => $request->get('subject_id'),
                    'class_id' => $darasa,
                    'year' => $year,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
        return back()->with('flash', 'Subject assigned successfully');
    }


    public function getSubjects($id)
    {
        $year = Carbon::now()->year;
        $subjects = Subject::where('vidato_id', $id)->get();
        if(!$subjects){
            \App::abort('409');
        }
        $classes = Darasa::where([['vidato_id', $id],['year', $year]])->get();
        if(!$classes){
            \App::abort('409');
        }

        return response(['subjects'=>$subjects, 'classes'=>$classes]);
    }

    public function subjectDestroy($id)
    {
        $subject = DB::table('teacher_subjects')->find($id);
        if(!$subject){
            \App::abort('409');
        }
        DB::table('teacher_subjects')->where('id', $id)->delete();
        
        return back()->with('flash', 'Subject removed.');
    }

    public function classTeacher($id)
    {
        $teacher = $this->teacher->with('classes')->where('id', $id)->first();
        if(!$teacher){
            \App::abort('409');
        }
        $year = Carbon::now()->year;
        $classes = Darasa::select('id', 'name', 'stream')
                            ->where('year', $year)
                            ->orderBy('name')->orderBy('stream')->get();
        
        if(!$classes){
            \App::abort('409');
        }
        return view('staff.teachers.class_teacher', compact('teacher', 'classes'));
    }

    public function assignClass(Request $request, $id)
    {
        $request->validate([
            'class_id' => 'required'
        ]);
        
        $year = Carbon::now()->year;
        $ipo = DB::table('class_teacher')->where([
            ['class_id','=', $request->get('class_id')],
            ['year','=', $year],
            ])->first();
        if(!$ipo){
          DB::table('class_teacher')->insert([
              'teacher_id' => $id,
              'class_id' => $request->get('class_id'),
              'year' => $year,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
              ]);

        return back()->with('flash','Class assigned successfully.');
        }else{
            $teacher = Teacher::find($ipo->teacher_id);
            if(!$teacher){
                \App::abort('409');
            }
            $errors = array('class_id' => 'This class is already assigned to '.$teacher->user->name);
            return redirect()
                        ->back()->withInput($request->input())
                      ->withErrors($errors);
        }
    }

    public function classTeacherDestroy($id)
    {
        $darasa = DB::table('class_teacher')->find($id);
        if(!$darasa){
            \App::abort('409');
        }
        DB::table('class_teacher')->where('id', $id)->delete();
        
        return back()->with('flash', 'Class unassigned successfully.');
    }
}
