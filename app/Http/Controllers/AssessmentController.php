<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tabia;
use App\Teacher;
use App\Student;
use App\Darasa;
use Carbon\Carbon;
use DB;
use Auth;

class AssessmentController extends Controller
{
     /**
     * Constructor to initialize object
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        if(! session()->has('term')){
            return redirect()->route('teacher.assessment', Auth::user()->teacher->id);
        }
        $term = session('term');
        $year = session('year');
        $students = Student::whereDoesntHave('tabia', function($query1) use($term, $year){
            $query1->where([['year', $year], ['term', $term]]);
        })->join('class_student', function($query) use($id, $term, $year)
        {
            $query->on( 'class_student.student_id', '=', 'students.id')->where('class_id', $id);
        })->orderBy('first_name')->get();

        $allstudents= Student::whereHas('tabia', function($query1) use($term, $year){
            $query1->where([['year', $year], ['term', $term]]);
        })->join('class_student', function($query) use($id)
        {
            $query->on('class_student.student_id', '=', 'students.id' )->where('class_id', $id);
        })->orderBy('first_name')->get();
        
        if(!$students){
            \App::abort('409');
        }

        $darasa = Darasa::select('id', 'name', 'stream')->find($id);
        if(!$darasa){
            \App::abort('409');
        }

        $class_id = $id;
        return view('assessment.create', compact('students', 'class_id', 'allstudents', 'darasa'));
    }

    public function add($class_id, $id)
    {
       $student = Student::find($id);
       $tabia = Tabia::all('id', 'codeID', 'name');
       return view('assessment.add', compact('student', 'tabia', 'class_id'));
    }

    public function store(Request $request, $class_id, $id)
    {
        if(! session()->has('term')){
            return redirect()->route('teacher.assessment', Auth::user()->teacher->id);
        }
        $request->validate([
            'tabia_id.*' => 'required',
            'grade.*' => 'required|max:1|regex:/[A, B, C, D, E, F]/',
        ]);

        $grade = $request->get('grade');
        $term = session('term');
        $year = session('year');

        foreach ($request->input('tabia_id') as $index => $tabia) {
            $ipo = DB::table('student_tabia')->where([
                ['student_id','=', $id],
                ['tabia_id','=', $tabia],
                ['term','=', $term],
                ['year','=', $year],
                ])->first();
            if(!$ipo){
              DB::table('student_tabia')->insert([
                  'student_id' => $id,
                  'tabia_id' => $tabia,
                  'teacher_id' => Auth::user()->teacher->id,
                  'grade' => $grade[$index],
                  'term' => $term,
                  'year' => $year,
                  'created_at' => Carbon::now(),
                  'updated_at' => Carbon::now()
                  ]);
            }
        }

        return redirect()->route('teacher.createassessment', $class_id)
        ->with('flash','Assessment was done successfully.');
    }

    public function set(Request $request, $class_id)
    {
        session(['year' => $request->get('year')]);
        session(['class_id' => $class_id]);
        session(['term' => $request->get('term')]);

        return redirect()->route('teacher.createassessment', $class_id);
    }

    public function edit($student_id, $class_id)
    {
        if(! session()->has('term')){
            return redirect()->route('teacher.assessment', Auth::user()->teacher->id);
        }
        $term = session('term');
        $year = session('year');
        $student = Student::with(['tabia'=>function($query) use($term, $year) {
            $query->where([['year', $year], ['term', $term]])->orderBy('codeID');
        }])->find($student_id);
        
        if(!$student){
            \App::abort('409');
        }
        return view('assessment.edit', compact('student', 'class_id'));
    }

    public function update(Request $request, $student_id)
    {
        //return $request->all();
        if(! session()->has('term')){
            return redirect()->route('teacher.assessment', Auth::user()->teacher->id);
        }
        $request->validate([
            'is_id.*' => 'required',
            'tabia_id.*' => 'required',
            'grade.*' => 'required|max:1|regex:/[A, B, C, D, E, F]/',
        ]);

        $grade = $request->get('grade');
        $ids= $request->get('is_id');
        foreach ($request->input('tabia_id') as $index => $tabia) {
            DB::table('student_tabia')->where('id', $ids[$index])
                ->update([
                  'grade' => $grade[$index],
                  'updated_at' => Carbon::now()
            ]);
        }

        return redirect()->back()->with('flash', 'Updated successful.');
    }
}
