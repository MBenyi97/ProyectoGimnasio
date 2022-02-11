<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Middleware\CheckRole;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('role')->except('showUser');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $users = User::paginate(10);
        $name = $request->name;
        $role = $request->role;
        ($name || $role) ?
            $users = User::with('role')
            ->where('name', 'like', "%$name%")
            ->whereHas('role', function (Builder $query) use ($role) {
                $query->where('name', 'like', "%$role%");
            })->paginate(10) : null;
        $users->withPath("/users?name=$name&role=$role");
        return view('user.admin', [
            'users' => $users,
            'user' => $user,
            'name' => $name,
            'role' => $role
        ]);
    }

    public function showUser()
    {
        $user = Auth::user();
        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('user.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'role_id' => $request->role_id,
            'dni' => $request->dni,
            'name' => $request->name,
            'email' => $request->email,
            'weight' => $request->weight,
            'height' => $request->height,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $genders = [
            'Hombre' => '',
            'Mujer' => '',
            'Otro' => ''
        ];
        foreach ($genders as $key => $value) {
            ($key == $user->gender) ? $genders[$key] = 'selected' : false;
        }
        return view('user.edit', [
            'user' => $user,
            'genders' => $genders,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->fill($request->all());
        $user->save();
        if (Auth::user()->role_id == 1) {
            return redirect('/users');
        } else {
            return redirect('/users/show');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users');
    }
}
