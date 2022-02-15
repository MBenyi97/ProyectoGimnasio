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

        // SQL Query
        // select *
        // from sesions as FirstQuery left join sesion_user on FirstQuery.id = sesion_user.sesion_id join activities on FirstQuery.activity_id = activities.id
        // where (name like 'boxeo') or (date like '2022-02-15')
        // group by FirstQuery.id
        // having (FirstQuery.id != (select Subquery.id from sesions as Subquery join sesion_user on Subquery.id = sesion_user.sesion_id where user_id = 4));

        // Sub query
        // $discardSesions = DB::table('sesions')
        //     ->Join('sesion_user', 'sesion_user.sesion_id', '=', 'sesions.id')
        //     ->where('user_id', '=', 4)
        //     ->select('sesions.id')
        //     ->get();

        // Main query
        // $sesions = DB::table('sesions')
        //     ->leftJoin('sesion_user', 'sesion_user.sesion_id', '=', 'sesions.id')
        //     ->Join('activities', 'activities.id', '=', 'sesions.activity_id')
        //     ->orWhere(function ($query) use ($filter) {
        //         $query->where('activities.name', $filter)
        //             ->orWhere('sesions.date', $filter);
        //     })
        //     ->select('sesions.id', 'sesions.weekDay', 'sesions.hour_start', 'sesions.hour_end', 'sesions.date', 'activities.name')
        //     ->groupBy('sesions.id')
        //     ->having(function ($query) use ($discardSesions) {
        //         $query->where('sesions.id', '!=', $discardSesions);
        //     })
        //     ->get();

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
