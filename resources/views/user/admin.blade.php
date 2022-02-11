@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
                </ol>
            </nav>

            <div class="btn-toolbar d-flex justify-content-between" role="toolbar">
                <h1>Lista de usuarios
                    <a href="/users/create" class="btn btn-success btn float-right" role="button">
                        <i class="bi bi-person-plus-fill"></i>
                    </a>
                </h1>
                <div class="input-group">
                    <div class="container-fluid">
                        <form class="d-flex form-filter" action="/users" method="get">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">@</span>
                                <input type="text" class="form-control filter-by-name" placeholder="Filtrar por nombre" aria-label="Usuario" name="name" value="{{$name}}" aria-describedby="basic-addon1">
                                <input type="text" class="form-control filter-by-role" placeholder="Filtrar por role" aria-label="Role" name="role" value="{{$role}}" aria-describedby="basic-addon1">
                                <input class="btn btn-primary" type="submit" value="Filtrar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <table class="table table-striped text-center">
                <tr>
                    <th>Role</th>
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
                    <td>{{$user->role->name}} </td>
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
                            @method('DELETE')
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a class="btn btn-dark" href="/users/{{$user->id}}"><i class="bi bi-bookmarks"></i></a>
                                <!-- <a class="btn btn-primary" href="/users/{{$user->id}}"><i class="bi bi-eye"></i></a> -->
                                <a class="btn btn-warning" href="/users/{{$user->id}}/edit"><i class="bi bi-pencil-square"></i></a>
                                <a class="btn btn-danger remove-user"><i class="bi bi-trash"></i></a>
                            </div>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center fw-bold">No hay usuarios registrados</td>
                </tr>
                @endforelse
            </table>
            {{$users->links("pagination::bootstrap-4")}}
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".remove-user").click(function(event) {
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
                    'El usuario no ha sido eliminado',
                    'error'
                );
            }
            if (result.isConfirmed) {
                Swal.fire(
                    'Borrado!',
                    'El usuario ha sido eliminado.',
                    'success'
                ).then(function() {
                    form.submit();
                });
            }
        });
    });
</script>
@endsection