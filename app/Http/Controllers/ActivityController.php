<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        $activities= Activity::all();
        
        return view('activity.index',['activites'=>$activities]);
=======
        $activities = Activity::all();

        return view('activity.index', ['activities' => $activities]);
>>>>>>> master
        dd($activities);
        return $activities;
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
        //version corta
        $activity = Activity::create($request->all());

        //version larga, comentada
        // $activity = new Activity;
        // $activity->code = $request->code;
        // $activity->name = $request->name;
        // $activity->abreviation = $request->abreviation;
        // $activity->save();

        // header('Location .....');
        return redirect('/activities');

        // INSERT INTO studies('code', 'name', 'abreviation')
<<<<<<< HEAD
        
=======
>>>>>>> master
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
        //version larga, comentada
<<<<<<< HEAD
        // $activity->code = $request->code;
        // $activity->name = $request->name;
        // $activity->abreviation = $request->abreviation;
        
=======
        // $study->code = $request->code;
        // $study->name = $request->name;
        // $study->abreviation = $request->abreviation;

>>>>>>> master
        //version corta
        $activity->fill($request->all());

        $activity->save();
<<<<<<< HEAD
        return redirect('/activity');
=======
        return redirect('/activities');
>>>>>>> master
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