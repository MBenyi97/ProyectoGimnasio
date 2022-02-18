<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Sesion;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Middleware\CheckRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SesionController extends Controller
{
    public function __construct()
    {
        $this->middleware('role')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sesions = Sesion::paginate(10);
        $name = $request->name;
        ($name) ? $sesions = Sesion::with('activity')
            ->whereHas('activity', function (Builder $query) use ($name) {
                $query->where('name', 'like', "%$name%");
            })->paginate(10) : null;
        $sesions->withPath("/sesions?name=$name");
        (Auth::user()->role_id == 1) ? $view = 'admin' : $view = 'index';
        return view("sesion.$view", [
            'sesions' => $sesions,
            'name' => $name
        ]);
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
        $validator = Validator::make($request->all(), [
            'date' => ['required', 'date', 'max:255'],
            'hour_start' => ['required', 'max:255'],
            'hour_end' => ['required', 'max:255']
        ]);
        if ($validator->fails()) {
            return redirect('/sesions/create')
                ->withErrors($validator)
                ->withInput();
        }
        // Array getting the start hour
        $arrHoraStart = explode(":", $request->hour_start);
        // Array getting the end hour
        $arrHoraEnd = explode(":", $request->hour_end);
        // Date from form and parsed by Carbon
        $dateCarbon = Carbon::parse($request->date);
        // Activity ID
        $activityId = $request->activity_id;
        // Week days selected
        $weekDays = $request->weekDays;
        for ($i = 1; $i < $dateCarbon->daysInMonth + 1; ++$i) {
            $hourStart = Carbon::create($dateCarbon->year, $dateCarbon->month, $i, $arrHoraStart[0], $arrHoraStart[1], 00);
            $hourEnd = Carbon::create($dateCarbon->year, $dateCarbon->month, $i, $arrHoraEnd[0], $arrHoraEnd[1], 00);

            if (in_array($hourStart->englishDayOfWeek, $weekDays, false)) {
                $sesion = new Sesion;
                $sesion->date = $hourStart;
                $sesion->hour_start = $hourStart;
                $sesion->hour_end = $hourEnd;
                $sesion->weekDay = $this->englishWeekDay($hourStart->englishDayOfWeek);
                $sesion->activity_id = $activityId;
                $sesion->save();
            }
        }
        $message = [
            'title' => 'Creada!',
            'message' => 'La sesión ha sido creada.'
        ];
        return redirect('/sesions')->with($message);
    }

    public function englishWeekDay($englishDay)
    {
        $englishDay == 'Monday' ? $weekDay = 'Lunes' : false;
        $englishDay == 'Tuesday' ? $weekDay = 'Martes' : false;
        $englishDay == 'Wednesday' ? $weekDay = 'Miércoles' : false;
        $englishDay == 'Thursday' ? $weekDay = 'Jueves' : false;
        $englishDay == 'Friday' ? $weekDay = 'Viernes' : false;
        $englishDay == 'Saturday' ? $weekDay = 'Sábado' : false;
        $englishDay == 'Sunday' ? $weekDay = 'Domingo' : false;
        return $weekDay;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function edit(Sesion $sesion)
    {
        $activities = Activity::all();
        // Function to load the weekDays selected
        $daysChecked = $this->loadWeekDays($sesion);
        return view('sesion.edit', [
            'sesion' => $sesion,
            'activities' => $activities,
            'daysChecked' => $daysChecked
        ]);
    }

    /**
     * Loads the days of the week in Spanish.
     *
     * @param  \App\Models\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function loadWeekDays(Sesion $sesion)
    {
        // Parsing the start date of the sesion
        $dtStart = Carbon::parse($sesion->date);
        // Array holding the days
        $daysChecked = [
            'Monday' => '',
            'Tuesday' => '',
            'Wednesday' => '',
            'Thursday' => '',
            'Friday' => '',
            'Saturday' => '',
            'Sunday' => '',
        ];
        // Loading the array with the checked week days
        foreach ($daysChecked as $key => $val) {
            ($key == $dtStart->englishDayOfWeek) ? $daysChecked[$key] = 'checked' : '';
        }
        return $daysChecked;
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
        // Array getting the start hour
        $arrHoraStart = explode(":", $request->hour_start);
        // Array getting the end hour
        $arrHoraEnd = explode(":", $request->hour_end);
        // Date from form and parsed by Carbon
        $dateCarbon = Carbon::parse($request->date);
        // Function if the weekDay is not checked it is deleted
        $this->destroyIfDayNotExists($request->sesion_id, $request->weekDays);
        for ($i = 1; $i < $dateCarbon->daysInMonth + 1; ++$i) {
            $hourStart = Carbon::create($dateCarbon->year, $dateCarbon->month, $i, $arrHoraStart[0], $arrHoraStart[1], 00);
            $hourEnd = Carbon::create($dateCarbon->year, $dateCarbon->month, $i, $arrHoraEnd[0], $arrHoraEnd[1], 00);

            if (in_array($hourStart->englishDayOfWeek, $request->weekDays, false)) {
                ($this->findByDate($hourStart)) ? $sesion = Sesion::find($request->sesion_id) : $sesion = new Sesion;
                $sesion->date = $hourStart->format('Y-m-d');
                $sesion->hour_start = $hourStart->format('H:i');
                $sesion->hour_end = $hourEnd->format('H:i');
                $sesion->weekDay = $this->englishWeekDay($hourStart->englishDayOfWeek);
                $sesion->activity_id = $request->activity_id;
                $sesion->save();
            }
        }
        $message = [
            'title' => 'Editado!',
            'message' => 'La sesión ha sido editada.'
        ];
        return redirect('/sesions')->with($message);
    }


    /**
     * Finds the sesion by the given date.
     *
     * @param  $date
     * @return \Illuminate\Http\Response
     */
    public static function findByDate($date)
    {
        $sesions = Sesion::all();
        $id = "";
        foreach ($sesions as $sesion) {
            ($sesion->date == $date) ? $id = $sesion->id : false;
        }
        return Sesion::find($id);
    }

    /**
     * If the weekDay is no longer selected it removes it from storage.
     *
     * @param  $id, $weekDaysSelected
     * @return \Illuminate\Http\Response
     */
    public static function destroyIfDayNotExists($id, $weekDaysSelected)
    {
        $sesion = Sesion::find($id);
        $sesionCarbonDate = Carbon::parse($sesion->date);
        foreach ($weekDaysSelected as $weekDay) {
            ($weekDay != $sesionCarbonDate->englishDayOfWeek) ? Sesion::destroy($sesion) : false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sesion $sesion)
    {
        return $sesion;
        // $user = Auth::user();
        // $sesion->users()->detach($user);
        // return redirect('/sesions');
    }
}
