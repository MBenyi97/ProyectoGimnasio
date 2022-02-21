<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Rules\Identification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Middleware\CheckRole;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role')->except('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
            'name' => $name,
            'role' => $role
        ]);
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
        Validator::make($request->all(), [
            'dni' => ['required', 'string', 'unique:users', new Identification],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users', 'max:255'],
            'weight' => ['required', 'numeric', 'max:255'],
            'height' => ['required', 'numeric', 'max:255'],
            'birthdate' => ['required', 'date', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();
        User::create($request->all());
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
        return view('user.edit', ['user' => $user]);
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
        Validator::make($request->all(), [
            'dni' => ['required', 'string', 'max:255', new Identification, Rule::unique('users')->ignore($user->dni, 'dni')],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->email, 'email')],
            'weight' => ['required', 'numeric', 'max:255'],
            'height' => ['required', 'numeric', 'max:255'],
            'birthdate' => ['required', 'date', 'max:255'],
            'gender' => ['required', 'string', 'max:255']
        ])->validate();
        $user->fill($request->all());
        $user->save();
        return redirect('/users');
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
