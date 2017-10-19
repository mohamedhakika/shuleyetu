<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VidatoRequest;
use App\Kidato;
use App\Darasa;
use Carbon\Carbon;
use DB;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getClass()
    {
      $year = Carbon::now()->year;
      $vidato = Kidato::all('id', 'name');
      $classes = Darasa::where('year', $year)
                    ->orderBy('name')
                    ->orderBy('stream')->get();
      return view('vidato.index', ['vidato' => $vidato, 'year' => $year,
                                    'classes' => $classes]);
    }

    public function setClass(VidatoRequest $request)
    {
        
        list($vidato_id, $name_form) = explode("-", $request->get('name_form'), 2);
        foreach ($request->input('stream') as $stream) {
          $ipo = Darasa::where([
                ['name','=', $name_form],
                ['year','=', $request->get('year')],
                ['stream','=', $stream],
                ['level','=', '0'],
                ])->first();
          if(! $ipo){
            $darasa = new Darasa();
            $darasa->vidato_id = $vidato_id;
            $darasa->name = $name_form;
            $darasa->level = '0';
            $darasa->stream = $stream;
            $darasa->year = $request->get('year');
            $darasa->save();
        }
      }
      return back()->with('flash', 'Class and streams created successfully');
    }

    public function destroyClass($id)
    { 
        $darasa = Darasa::find($id);
        $darasa->delete();
        return redirect()->back()->with('flash', 'Class deleted succesfully.');
    }
}
