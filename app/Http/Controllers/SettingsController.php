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

    public function getclass()
    {
      $year = Carbon::now()->year;
      $vidato = Kidato::all('id', 'name');
      $classes = Darasa::where('year', $year)->get();
      return view('vidato.index', ['vidato' => $vidato, 'year' => $year,
                                    'classes' => $classes]);
    }

    public function setclass(VidatoRequest $request)
    {
      foreach ($request->input('stream') as $stream) {
          $ipo = Darasa::where([
                ['name','=', $request->get('name_form')],
                ['year','=', $request->get('year')],
                ['stream','=', $stream],
                ['level','=', '0'],
                ])->first();
          if(!$ipo){
            $darasa = new Darasa();
            $darasa->name = $request->get('name_form');
            $darasa->level = '0';
            $darasa->stream = $stream;
            $darasa->year = $request->get('year');
            $darasa->save();
          }
      }
      return redirect()->back()->with('flash', 'Class and streams created successfully');
    }
}
