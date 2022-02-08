@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>
            <strong>Usuario nº {{$user->id}}</strong>
                <a href="/users" class="btn btn-danger">Atrás</a>
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
                </tr>
                <tr>
                    <td>{{$user->dni}} </td>
                    <td>{{$user->name}} </td>
                    <td>{{$user->email}} </td>
                    <td>{{$user->weight}} </td>
                    <td>{{$user->height}} </td>
                    <td>{{$user->birthdate}} </td>
                    <td>{{$user->gender}} </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection