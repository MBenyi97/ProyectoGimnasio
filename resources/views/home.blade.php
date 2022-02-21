@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card justify-content-center text-center">
                <div class="card-header blockquote">
                    "Los récords están para ser superados" <strong>Michael Schumacher</strong>
                </div>
                <div class="card-body">
                    <h3 class="card-title"> {{ Auth::user()->name }}, Bienvenido a la página de nuestro gimnasio</h3>
                    <p class="card-text">El botón de abajo te mostrará tu datos y tus sesiones</p>
                    <a href="/users/{{Auth::id()}}" class="btn btn-primary">Panel de control</a>
                </div>
                <div class="card-footer text-muted">
                    <i>Made by Arthur & Mike</i>
                </div>
            </div>
        </div>
    </div>
</div>
@if(Session::has('message'))
<script type="text/javascript">
    Swal.fire(
        'Bienvenido!',
        'Has iniciado sesión.',
        'success'
    );
</script>
@endif
<script src="https://unpkg.com/turbolinks"></script>
@endsection