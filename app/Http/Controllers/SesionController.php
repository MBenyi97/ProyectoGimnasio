<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sesion;
use App\Models\Activity;
use Illuminate\Http\Request;

class SesionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sesions = Sesion::all();
        $activities = Activity::all();

        // dd($sesions);
        return view('sesion.index', ['sesions' => $sesions], ['activities' => $activities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activities = Activity::all();
        return view('sesion.create', ['activities' => $activities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // fecha creada con carbon
        $dt = Carbon::now();
        // array que recoge las horas de comienzo
        $arrHoraStart = explode(":", $request->hour_start);
        // array que recoge las horas del final
        $arrHoraEnd = explode(":", $request->hour_end);
        // fecha pasada por el formulario y parseada a carbon
        $dateCarbon = Carbon::parse($request->date);
        // id de la actividad seleccionada
        $activityId = $request->activity_id;
        // array de los dias de la semana seleccionados
        $weekDays = $request->weekDays;
        for ($i = 1; $i < $dateCarbon->daysInMonth + 1; ++$i) {
            $hourStart = Carbon::create($dateCarbon->year, $dateCarbon->month, $i, $arrHoraStart[0], $arrHoraStart[1], 00);
            $hourEnd = Carbon::create($dateCarbon->year, $dateCarbon->month, $i, $arrHoraEnd[0], $arrHoraEnd[1], 00);

            if (in_array($hourStart->englishDayOfWeek, $weekDays, false)) {
                $sesion = new Sesion;
                $sesion->date_start = $hourStart->format('Y-m-d H:i:s');
                $sesion->date_end = $hourEnd->format('Y-m-d H:i:s');
                $sesion->activity_id = $activityId;
                $sesion->save();
            }
        }
        // header('Location .....');
        return redirect('/sesions');

        // INSERT INTO studies('code', 'name', 'abreviation')
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function show(Sesion $sesion)
    {
        return view('sesion.show', ['sesion' => $sesion]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function edit(Sesion $sesion)
    {
        return view('sesion.edit', ['sesion' => $sesion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sesion $sesion)
    {
        //version larga, comentada
        // $study->code = $request->code;
        // $study->name = $request->name;
        // $study->abreviation = $request->abreviation;

        //version corta
        $sesion->fill($request->all());

        $sesion->save();
        return redirect('/sesions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sesion $sesion)
    {
        $sesion->delete();
        return redirect('/sesions');
    }
}
