<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation;
use App\Models\Activity;
use App\Models\Sesion;
use App\Mail\ReservationMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> arthur
=======
>>>>>>> a3f597eac792d345ebf378deb712c84419022dee
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
        $sesion->users()->attach($user, ['created_at' => Carbon::now()]);
        // $sesion->users()->save($user, ['created_at' => Carbon::now()]);
        $this->reservationEmail($user, $sesion);
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
        $sesion = Sesion::find($id);
        $sesion->users()->detach(Auth::id());
        return redirect('/users');
    }

    /**
     * Remove the specified sesion from the specified user from storage.
     *
     * @param  $userId, $sesionId
     * @return \Illuminate\Http\Response
     */
    public function userSesionDestroy($userId, $sesionId)
    {
        $user = User::find($userId);
        $sesion = Sesion::find($sesionId);
        $sesion->users()->detach($user);
        return redirect('/users');
    }

    /**
     * Send an email with the reservation.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sesion  $sesion
     */
    public function reservationEmail(User $user, Sesion $sesion)
    {
        $userEmail = $user->email;
        Mail::to($userEmail)->send(new ReservationMail($sesion));
    }
}
