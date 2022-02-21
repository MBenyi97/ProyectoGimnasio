<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Sesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:activities', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'numeric', 'max:255'],
            'capacity' => ['required', 'numeric', 'max:255']
        ])->validate();
        Activity::create($request->all());
        $message = [
            'title' => 'Creada!',
            'message' => 'La actividad ha sido creada.'
        ];
        return redirect('/activities')->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        return view('activity.show', ['activity' => $activity]);
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
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', Rule::unique('activities')->ignore($activity->name, 'name')],
            'description' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'numeric', 'max:255'],
            'capacity' => ['required', 'numeric', 'max:255']
        ])->validate();
        $activity->fill($request->all());
        $activity->save();
        $message = [
            'title' => 'Editado!',
            'message' => 'La actividad ha sido editada.'
        ];
        return redirect('/activities')->with('message');
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
