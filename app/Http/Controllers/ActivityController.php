<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Sesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
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
        $activities = Activity::paginate(10);
        $name = $request->name;
        ($name) ? $activities = Activity::where('name', 'like', "%$name%")->paginate(10) : null;
        $activities->withPath("/activities?name=$name");
        (Auth::user()->role_id == 1) ? $view = 'admin' : $view = 'index';
        return view("activity.$view", [
            'activities' => $activities,
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
        return view('activity.create');
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
            'name' => ['required', 'string', 'unique:activities', 'max:255'],
            'duration' => ['required', 'numeric', 'max:255'],
        ]);
        if ($validator->fails()) {
            return redirect('/activities/create')
                ->withErrors($validator)
                ->withInput();
        }
        Activity::create($request->all());
        return redirect('/activities');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        return view('activity.show', ['activity' => $activity, 'users', $users = 0]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        return view('activity.edit', ['activity' => $activity]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'name' => ['required', 'unique:activities', 'max:255'] . $this->activity->id,
            'description' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'integer', 'max:255'],
            'capacity' => ['required', 'integer', 'max:255']
        ]);
        $activity->fill($request->validated());
        $activity->save();
        return redirect('/activities');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect('/activities');
    }
}
