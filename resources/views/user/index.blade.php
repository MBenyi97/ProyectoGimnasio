@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <h1>Lista de usuarios
                <a href="/sesions/create" class="btn btn-success btn-lg float-right" role="button">
                <i class="bi bi-person-plus-fill"></i>
                </a>
            </h1>


            <table class="table table-striped">
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Peso</th>
                    <th>Altura</th>
                    <th>Fecha de nacimiento</th>
                    <th>Genero</th>
                    <th class="text-center">Opciones</th>
                </tr>
                @forelse ($users as $user)
                <tr>
                    <td>{{$user->dni}} </td>
                    <td>{{$user->name}} </td>
                    <td>{{$user->email}} </td>
                    <td>{{$user->weight}} </td>
                    <td>{{$user->height}} </td>
                    <td>{{$user->birthdate}} </td>
                    <td>{{$user->gender}} </td>
                    <td class="text-center">
                        <form method="POST" action="/users/{{$user->id}}">
                            @csrf
                            <a class="btn btn-primary" href="/users/{{$user->id}}"><i class="bi bi-eye"></i></a>
                            <a class="btn btn-warning" href="/users/{{$user->id}}/edit"><i class="bi bi-pencil-square"></i></a>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center fw-bold">No hay usuarios registrados</td>
                </tr>
                @endforelse
            </table>





        </div>
    </div>
</div>
@endsection