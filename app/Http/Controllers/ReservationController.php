<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Activity;
use App\Models\Sesion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class ReservationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('create');
    }

    public function filter(Request $request)
    {
        $filter = $request->filter;
        $activityJSON = Activity::where('name', 'like', "%$filter%")->get();
        return $activityJSON;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::with('sesions')->get();
        return view('reservation.index', ['activities' => $activities]);
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
        // $sesion->users()->attach($user); 
        $sesion->users()->save($user, ['created_at' => Carbon::now()]);
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
    public function destroy($id)
    {
        $user = auth()->user();
        $sesion = Sesion::find($id);
        $sesion->users()->detach($user);
        return redirect('/users');
    }
}
