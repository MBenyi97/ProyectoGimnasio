@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="btn-toolbar d-flex justify-content-between" role="toolbar">
                <h1>{{$user->name}}</h1>
            </div>

            <table class="table table-striped text-center">
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