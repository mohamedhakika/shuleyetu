<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Subject;
use Auth;
use App\Http\Requests\CreateSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;

class SubjectController extends Controller
{
    /**
     * @var Subject
     */
    private $subject;

    /**
     * Constructor to initialize object
     *
     * @param Subject $subject
     */
    public function __construct(Subject $subject)
    {
        $this->middleware('auth');
        $this->subject = $subject;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subjects = $this->subject->orderBy('id','DESC')->paginate(10);
        $osubjects = $this->subject->where('level', '=', '0')->orderBy('id', 'DESC')->paginate(10);
        $asubjects = $this->subject->where('level', '=', '1')->orderBy('id', 'DESC')->paginate(10);
        return view('subjects.index',compact('subjects', 'osubjects', 'asubjects'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
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
    public function store(CreateSubjectRequest $request)
    {
        $subject = $this->subject->create([
            'name' => $request->name,
            'level' => $request->level,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            ]);

        return redirect()->route('subjects.index')
                        ->with('success','Subject created successfully');
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
        $subject = $this->subject->find($id);

        return view('subjects.edit',compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectRequest $request, $id)
    {
        $subject = $this->subject->find($id);
        $subject->update([
            'name' => $request->name,
            'level' => $request->level,
            'updated_by' => Auth::user()->id,
            ]);

        return redirect()->route('subjects.index')
                        ->with('success','Subject updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->subject->find($id)->delete();
        return redirect()->route('subjects.index')
                        ->with('success','Subject deleted successfully');
    }
}
