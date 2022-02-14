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
    // public function __construct()
    // {
    //     $this->middleware('role');
    // }

    public function filter(Request $request)
    {
        // $sesions = Sesion::paginate(10);
        $userId = Auth::user()->id;
        $filter = $request->filter;
        $query = Sesion::with('activity')
            ->whereHas('activity', function (Builder $q) use ($filter) {
                $q->where('name', $filter);
            })->with('users')->orWhere('date', $filter)->get();

        // Checks if the user alredy has the sesion
        $sesions = [];
        foreach ($query as $sesion) {
            $state = true;
            foreach ($sesion->users as $user) {
                if ($user->id == $userId) {
                    $state = false;
                    break;
                }
            }
            ($state) ? array_push($sesions, $sesion) : null;
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
        $user = auth()->user();
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
        return redirect('/users/show');
    }
}
