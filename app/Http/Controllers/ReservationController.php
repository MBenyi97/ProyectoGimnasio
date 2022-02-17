<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation;
use App\Models\Activity;
use App\Models\Sesion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function filter(Request $request)
    {
        $userId = Auth::id();
        $filter = $request->filter;

        if (ctype_alpha($filter) && !empty($filter)) {
            $sesions = Sesion::whereNotIn('id', function ($q) use ($userId) {
                $q->select('sesion_id')
                    ->from('sesion_user')
                    ->where('sesion_user.user_id', $userId);
            })->where('activity_id', function ($q) use ($filter) {
                $q->select('id')
                    ->from('activities')
                    ->where('name', $filter);
            })->with('activity')->get();
        } else if (!empty($filter)) {
            $sesions = Sesion::whereNotIn('id', function ($q) use ($userId) {
                $q->select('sesion_id')
                    ->from('sesion_user')
                    ->where('sesion_user.user_id', $userId);
            })->where('date', $filter)->with('activity')->get();
        }
        return $sesions;
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
        $user = Auth::user();
        $sesion = Sesion::find($id);
        // $sesion->users()->attach($user); 
        $sesion->users()->save($user, ['created_at' => Carbon::now()]);
        return redirect('/reservations');
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

    public function userSesionDestroy($userId, $sesionId)
    {
        $user = User::find($userId);
        $sesion = Sesion::find($sesionId);
        $sesion->users()->detach($user);
        return redirect('/users');
    }
}
