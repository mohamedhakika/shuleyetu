<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tabia;
use App\Teacher;
use App\Student;
use Carbon\Caborn;
use DB;
use Auth;

class AssessmentController extends Controller
{
    public function index($id)
    {
        $teacher = Teacher::with('classes')->find($id);
        if(!$teacher){
            \App::abort('409');
        }
        if(Auth::user()->id != $teacher->user_id){
            \App::abort('409');
        }
        return view('assessment.index', compact('teacher'));
    }

    public function create($id)
    {
        $students = Student::distinct()->join('class_student', function($query) use($id)
        {
            $query->on('students.id', '=', 'class_student.student_id')->where('class_id', $id);
        })->orderBy('first_name')->get();
        
        if(!$students){
            \App::abort('409');
        }
        //return $students;
        
        return view('assessment.create', compact('students'));
    }
}
