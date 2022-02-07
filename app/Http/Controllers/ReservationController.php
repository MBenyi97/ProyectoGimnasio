<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Activity;
use App\Models\Sesion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $activities = Activity::all();
        $sesions = Sesion::all();
        $reservations = Reservation::all();
        $arrActivityNames = [];
        $arrSesionDates = [];
        foreach ($reservations as $reservation) {
            array_push($arrActivityNames, Reservation::getActivityName($reservation));
            array_push($arrSesionDates, Reservation::getSesionDates($reservation));
        }
        $data = [
            'user' => $user,
            'activities' => $activities,
            'activityNames' => $arrActivityNames,
            'sesions' => $sesions,
        ];
        return view('reservation.index', ['data' => $data], ['reservations' => $reservations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = auth()->user();
        $sesion = Sesion::find($id);
        $reservation = new Reservation;
        $reservation->user_id = $user->id;
        $reservation->sesion_id = $sesion->id;
        $reservation->date = Carbon::now();
        $reservation->save();
        return redirect('/sesions');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect('/reservations');
    }
}
