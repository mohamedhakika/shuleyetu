<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Teacher;
use App\Role;
use DB;
use App\User;
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
}
