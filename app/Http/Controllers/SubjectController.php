<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Subject;
use App\Kidato;
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
        $subjects_1 = $this->subject->where('vidato_id', 1)
                                ->orderBy('name')->get();
        $subjects_2 = $this->subject->where('vidato_id', 2)
                                ->orderBy('name')->get();
        $subjects_3 = $this->subject->where('vidato_id', 3)
                                ->orderBy('name')->get();
        $subjects_4 = $this->subject->where('vidato_id', 4)
                                ->orderBy('name')->get();
        return view('subjects.index',
                    compact('subjects_1', 'subjects_2', 'subjects_3', 'subjects_4'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vidato = Kidato::all('id', 'name');
        return view('subjects.create', compact('vidato'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSubjectRequest $request)
    {
        foreach ($request->input('vidato_id') as $vidato) {
            $ipo = Subject::where([
                  ['name','=', $request->get('name')],
                  ['vidato_id','=', $vidato],
                  ])->first();
            if(!$ipo){
                $subject = new Subject();
                $subject->name = $request->get('name');
                $subject->vidato_id = $vidato;
                $subject->level = '0';
                $subject->created_by = Auth::user()->id;
                $subject->save();
            }
        }
        return redirect()->back()
                        ->with('flash','Subject created successfully');
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique_with:subjects,name,'.$id,
        ]);

        $subject = $this->subject->find($id);
        $subject->name = $request->get('name');
        $subject->updated_by = Auth::user()->id;
        $subject->update();

        return redirect()->route('setting.subjects')
                        ->with('flash','Subject updated successfully');
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
        return redirect()->route('setting.subjects')
                        ->with('flash','Subject deleted successfully');
    }
}
