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
        $date = $request->date;
        $hour_start = $request->hour_start;
        $hour_end = $request->hour_end;
        $activityId = $request->activity_id;
        $weekDays[] = $request->weekDays;

<<<<<<< HEAD
        //version larga, comentada
        // sesion = new Sesion;
        // sesion->code = $request->code;
        // sesion->name = $request->name;
        // sesion->abreviation = $request->abreviation;
        // sesion->save();
=======
        $daysInMonth = $hour_start->daysInMonth;
        for ($i = 1; $i < $daysInMonth; ++$i) {
            $hourStart = Carbon::create($date->year, $date->month, $i, $hour_start->hour, $hour_start->minute, $hour_start->second);
            $hourEnd = Carbon::create($date->year, $date->month, $i, $hour_end->hour, $hour_end->minute, $hour_end->second);

            $dayOfWeek = $hourStart->englishDayOfWeek;
            if (in_array($dayOfWeek, $weekDays)) {
                $sesion = new Sesion;
                $sesion->date_start = $hourStart->format('Y-m-d h:i:s');
                $sesion->date_end = $hourEnd->format('Y-m-d h:i:s');
                $sesion->activity_id = $activityId;
                $sesion->save();
            }
        }
>>>>>>> master

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
        // $sesion->code = $request->code;
        // $sesion->name = $request->name;
        // $sesion->abreviation = $request->abreviation;
        
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
