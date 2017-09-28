<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tabia;
use Auth;

class TabiaController extends Controller
{
    /**
     * @var Tabia
     */
     private $tabia;
     
         /**
          * Constructor to initialize object
          *
          * @param Tabia $tabia
          */
         public function __construct(Tabia $tabia)
         {
             $this->middleware('auth');
             $this->tabia = $tabia;
         }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tabias = Tabia::all('id','codeID', 'name')->sortBy('codeID');
        //$tabias = $this->tabia->select('id', 'codeID', 'name')->orderBy('codeID')->get();
        return view('tabia.index', compact('tabias'));
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
        $request->validate([
            'codeID'=> 'required|unique:tabia,codeID',
            'name' => 'required|string'
        ]);

        $tabia = new Tabia();
        $tabia->codeID = $request->get('codeID');
        $tabia->name = $request->get('name');
        $tabia->created_by = Auth::user()->id;
        $tabia->save();
        return redirect()->back()->with('flash', 'Assesment created successfully.');
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
       $tabia = $this->tabia->find($id);
       return view('tabia.edit', compact('tabia'));
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
            'codeID'=> 'required|unique:tabia,codeID,'.$id,
            'name' => 'required|string'
        ]);
        $tabia = $this->tabia->find($id);
        $tabia->codeID = $request->get('codeID');
        $tabia->name = $request->get('name');
        $tabia->updated_by = Auth::user()->id;
        $tabia->update();
        return redirect()
            ->route('setting.assessment')
            ->with('flash', 'Assessment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tabia = $this->tabia->find($id);
        $tabia->delete();
        return redirect()->back()->with('flash', 'Assesment deleted successfully.');
    }
}
