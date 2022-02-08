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
        return view('sesion.index', ['sesions' => $sesions]);
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
        // getting whole activities list
        $activities = Activity::all();
        // parsing the start and ending date of the sesion
        $dtStart = Carbon::parse($sesion->date_start);
        $dtEnd = Carbon::parse($sesion->date_end);
        // checking if days are shorter than 1 digit and adding a 0
        (strlen($dtStart->day) < 2) ? $day = "0" . $dtStart->day : $day = $dtStart->day;
        // checking if months are shorter than 1 digit and adding a 0
        (strlen($dtStart->month) < 2) ? $month = "0" . $dtStart->month : $month = $dtStart->month;
        // variable holding the date for the date input in the form
        $dateForm = $dtStart->year . "-" . $month . "-" . $day;
        // checking if minutes are shorter than 1 digit and adding a 0
        (strlen($dtStart->minute) < 2) ? $dtStartMinute = "0" . $dtStart->minute : $dtStartMinute = $dtStart->minute;
        // checking if hours are shorter than 1 digit and adding a 0
        (strlen($dtEnd->minute) < 2) ? $dtEndMinute = "0" . $dtEnd->minute : $dtEndMinute = $dtEnd->minute;
        // array holding the start and ending hours
        $arrHours = [
            'hourStart' => $dtStart->hour . ":" . $dtStartMinute,
            'hourEnd' => $dtEnd->hour . ":" . $dtEndMinute
        ];
        // array holding the days
        $daysChecked = [
            'Monday' => '',
            'Tuesday' => '',
            'Wednesday' => '',
            'Thursday' => '',
            'Friday' => '',
            'Saturday' => '',
            'Sunday' => '',
        ];
        // array holding the days and loading the ones checked
        foreach ($daysChecked as $key => $val) {
            ($key == $dtStart->englishDayOfWeek) ? $daysChecked[$key] = 'checked' : '';
        }
        // array carrying activities, starting/ending hours and the days checked
        $activities_dates = [
            'activities' => $activities,
            'arrHours' => $arrHours,
            'daysChecked' => $daysChecked,
            'date' => $dateForm
        ];
        return view('sesion.edit', ['sesion' => $sesion], ['activities_dates' => $activities_dates]);
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
        // array that picks the starting hours
        $arrHoraStart = explode(":", $request->hour_start);
        // array that picks the ending hours
        $arrHoraEnd = explode(":", $request->hour_end);
        // date selected from the form and parsed into carbon
        $dateCarbon = Carbon::parse($request->date);
        // id of the selected activity
        $activityId = $request->activity_id;
        // array holding the week days selected on the form
        $weekDays = $request->weekDays;
        // method for checking if the week of day is no longer selected it will delete the sesion
        $WeekDayNotExists = new Sesion;
        $WeekDayNotExists::destroyIfDayNotExists($request->sesion_id, $weekDays);
        for ($i = 1; $i < $dateCarbon->daysInMonth + 1; ++$i) {
            $hourStart = Carbon::create($dateCarbon->year, $dateCarbon->month, $i, $arrHoraStart[0], $arrHoraStart[1], 00);
            $hourEnd = Carbon::create($dateCarbon->year, $dateCarbon->month, $i, $arrHoraEnd[0], $arrHoraEnd[1], 00);

            if (in_array($hourStart->englishDayOfWeek, $weekDays, false)) {
                (Sesion::findByDate($hourStart)) ? $sesion = Sesion::find($request->sesion_id) : $sesion = new Sesion;
                $sesion->date_start = $hourStart->format('Y-m-d H:i:s');
                $sesion->date_end = $hourEnd->format('Y-m-d H:i:s');
                $sesion->activity_id = $activityId;
                $sesion->save();
            }
        }
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
