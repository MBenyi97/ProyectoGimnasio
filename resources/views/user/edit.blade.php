@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar actividad') }}</div>

                <div class="card-body">
                    <form method="POST" action="/activities/{{$user ?? ''->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">

                        <!-- DNI -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('DNI') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user ?? ''->dni}}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- NAME -->
                        <div class="row mb-3">
                            <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('name') is-invalid @enderror" name="nombre" value="{{$user ?? ''->name}}" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- EMAIL -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('name') is-invalid @enderror" name="email" value="{{$user ?? ''->email}}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- WEIGHT -->
                        <div class="row mb-3">
                            <label for="weight" class="col-md-4 col-form-label text-md-end">{{ __('Peso') }}</label>

                            <div class="col-md-6">
                                <input id="weight" type="number" class="form-control @error('name') is-invalid @enderror" name="weight" value="{{$user ?? ''->weight}}" required autocomplete="weight" autofocus>

                                @error('weight')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- HEIGHT -->
                        <div class="row mb-3">
                            <label for="height" class="col-md-4 col-form-label text-md-end">{{ __('Altura') }}</label>

                            <div class="col-md-6">
                                <input id="height" type="number" class="form-control @error('name') is-invalid @enderror" name="height" value="{{$user ?? ''->height}}" required autocomplete="height" autofocus>

                                @error('height')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- BIRTHDATE -->
                        <div class="row mb-3">
                            <label for="birthdate" class="col-md-4 col-form-label text-md-end">{{ __('Fecha de nacimiento') }}</label>

                            <div class="col-md-6">
                                <input id="birthdate" type="date" class="form-control @error('name') is-invalid @enderror" name="birthdate" value="{{$user ?? ''->birthdate}}" required autocomplete="birthdate" autofocus>

                                @error('birthdate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- GENDER -->
                        <div class="row mb-3">
                            <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Género') }}</label>

                            <div class="col-md-6">
                                <input id="gender" type="date" class="form-control @error('name') is-invalid @enderror" name="gender" value="{{$user ?? ''->gender}}" required autocomplete="gender" autofocus>

                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- GENDER -->
                        <div class="form-outline mb-3">
                            <label class="form-label">Sexo</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected value="1">Mujer</option>
                                <option value="2">Hombre</option>
                                <option value="3">Otro</option>
                            </select>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Editar') }}
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