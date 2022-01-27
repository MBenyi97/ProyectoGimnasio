@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Nueva actividad') }}</div>

                <div class="card-body">
                    <form method="POST" action="/sesions">
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

                        <!-- DATES -->
                        <div class="row mb-3">
                            <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('Descripción') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="text" class="form-control @error('name') is-invalid @enderror" name="date" required autocomplete="date" autofocus>

                                @error('date')
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

                        <!-- END TIME -->
                        <div class="row mb-3">
                            <label for="end" class="col-md-4 col-form-label text-md-end">{{ __('Capacidad') }}</label>

                            <div class="col-md-6">
                                <input id="end" type="text" class="form-control @error('name') is-invalid @enderror" name="end" required autocomplete="end" autofocus>

                                @error('end')
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
                                <a href="/activities" class="btn btn-danger">Atrás</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection