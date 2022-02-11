@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($user->role_id == 1)
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/users">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$user->name}}</li>
                </ol>
            </nav>
            @endif
            <div class="btn-toolbar d-flex justify-content-between" role="toolbar">
                <div class="input-group">
                    <div class="container-fluid">
                        <h1>Tus datos</h1>
                    </div>
                </div>
                @if($user->role->name == 'admin')
                <div class="input-group">
                    <div class="container-fluid">
                        <a class="btn btn-info" href="/users/{{$user->id}}/edit">Modificar</a>
                    </div>
                </div>
                @endif
            </div>

            <table class="table table-striped text-center table-hover align-middle">
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
                    <td>{{Carbon\Carbon::parse($user->birthdate)->format('d-m-Y')}} </td>
                    <td>{{$user->gender}} </td>
                </tr>
            </table>
        </div>

        <div class="col-md-8 mt-3">
            <div class="btn-toolbar d-flex justify-content-between" role="toolbar">
                <div class="input-group">
                    <div class="container-fluid">
                        <h1>Tus sesiones</h1>
                    </div>
                </div>

                <table class="table table-striped text-center table-hover align-middle">
                    <tr>
                        <th>Actividad</th>
                        <th>Día de la semana</th>
                        <th>Duración</th>
                        <th>Hora inicial</th>
                        <th>Fecha</th>
                        <th>Fecha de la reserva</th>
                        <th>Eliminar</th>
                    </tr>
                    @forelse ($user->sesions as $sesion)
                    <tr>
                        <td>{{$sesion->activity->name}}</td>
                        <td>{{$sesion->weekDay}}</td>
                        <td>{{$sesion->activity->duration}} mins</td>
                        <td>{{Carbon\Carbon::parse($sesion->hour_start)->format('H:i')}}</td>
                        <td>{{Carbon\Carbon::parse($sesion->date)->format('d-m-Y')}}</td>
                        <td>{{Carbon\Carbon::parse($sesion->reservations->created_at)->format('H:i d-m-Y')}}</td>
                        <td>
                            <form method="POST" action="/reservations/{{$user->id}}/{{$sesion->id}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center fw-bold"><strong>No hay reservas</strong></td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".remove-reservation").click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                title: 'Estás seguro?',
                text: "No podrás revertir los cambios!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminalo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isDismissed) {
                    Swal.fire(
                        'Cancelado',
                        'La reserva no ha sido eliminada',
                        'error'
                    );
                }
                if (result.isConfirmed) {
                    Swal.fire(
                        'Borrado!',
                        'La reserva ha sido eliminada.',
                        'success'
                    ).then(function() {
                        form.submit();
                    });
                }
            });
        });
    </script>
    @endsection