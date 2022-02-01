@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Nueva sesión') }}</div>

                <div class="card-body">
                    <form method="POST" action="/sesions">
                        @csrf

                        <!-- ACTIVITY -->
                        <!-- <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Actividad') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> -->

                        <!-- DATES -->
                        <div class="row mb-3">
                            <label for="fechaSesion" class="col-md-4 col-form-label text-md-end">{{ __('Fechas') }}</label>

                            <div class="col-md-6">

                                <!-- <select class="form-select form-select-lg mb-3" multiple aria-label="multiple select .form-select-lg example"> -->
                                <select id="id-name" multiple="multiple">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>

                                <!-- <input id="fechaSesion" type="date" class="form-control @error('name') is-invalid @enderror" name="fechaSesion" required autocomplete="fechaSesion" autofocus> -->

                                @error('fechaSesion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- START TIME -->
                        <div class="row mb-3">
                            <label for="horaInicio" class="col-md-4 col-form-label text-md-end">{{ __('Hora de inicio') }}</label>

                            <div class="col-md-6">
                                <input id="horaInicio" type="text" class="form-control @error('name') is-invalid @enderror" name="horaInicio" required autocomplete="horaInicio" autofocus>

                                @error('horaInicio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- END TIME -->
                        <div class="row mb-3">
                            <label for="horaFinal" class="col-md-4 col-form-label text-md-end">{{ __('Hora final') }}</label>

                            <div class="col-md-6">
                                <input id="horaFinal" type="text" class="form-control @error('name') is-invalid @enderror" name="horaFinal" required autocomplete="horaFinal" autofocus>

                                @error('horaFinal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Crear') }}
                                </button>
                                <a href="/sesions" class="btn btn-danger">Atrás</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection