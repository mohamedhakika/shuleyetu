<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

class StudentSubjectController extends Controller
{
    /**
     * Constructor to initialize object
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $teacher = Teacher::find($id);
        if(!$teacher){
            \App::abort('409');
        }
        if($id != Auth::user()->teacher->id){
            \App::abort('409');
        }
        $year = Carbon::now()->year;
        $subjects = Teacher::join('teacher_subjects', 'teachers.id', '=', 'teacher_subjects.teacher_id')
                        ->join('subjects', 'teacher_subjects.subject_id', '=', 'subjects.id')
                        ->join('classes', 'teacher_subjects.class_id', '=', 'classes.id')
                        ->select('teachers.id as teachers_id', 'subjects.id as subjects_id', 'subjects.name as subject_name'
                         ,'classes.id as classes_id', 'classes.name as class_name', 'classes.stream as class_stream'
                         ,'teacher_subjects.year as year')
                        ->where('teachers.id', $id)->where('teacher_subjects.year', $year)->get();
                        //return $subjects;
        return view('staff.teachers.students.index', compact('teacher', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
