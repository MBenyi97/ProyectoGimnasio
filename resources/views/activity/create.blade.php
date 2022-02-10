@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item"><a href="/activities">Actividades</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear</li>
              </ol>
            </nav>
            <div class="card">
                <div class="card-header">{{ __('Nueva actividad') }}</div>

                <div class="card-body">
                    <form method="POST" action="/activities">
                        @csrf

                        <!-- ACTIVITY -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Actividad') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Descripción') }}</label>

                            <div class="col-md-6">
                                <!-- <input id="description" type="text" class="form-control @error('name') is-invalid @enderror" name="description" required autocomplete="description" autofocus> -->

                                <textarea class="form-control" id="description" class="form-control @error('name') is-invalid @enderror" name="description" required autocomplete="description" autofocus rows="3"></textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- DURATION -->
                        <div class="row mb-3">
                            <label for="duration" class="col-md-4 col-form-label text-md-end">{{ __('Duración') }}</label>

                            <div class="col-md-6">
                                <input id="duration" type="number" class="form-control @error('name') is-invalid @enderror" name="duration" required autocomplete="duration" autofocus>

                                @error('duration')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- CAPACITY -->
                        <div class="row mb-3">
                            <label for="capacity" class="col-md-4 col-form-label text-md-end">{{ __('Capacidad') }}</label>

                            <div class="col-md-6">
                                <input id="capacity" type="number" class="form-control @error('name') is-invalid @enderror" name="capacity" required autocomplete="capacity" autofocus>

                                @error('capacity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a class="btn btn-primary create-activity">Crear</a>
                                <a href="/activities" class="btn btn-danger">Atrás</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".create-activity").click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire(
            'Creada!',
            'La actividad ha sido creada.',
            'success'
        ).then(function() {
            form.submit();
        });
    });
</script>
@endsection