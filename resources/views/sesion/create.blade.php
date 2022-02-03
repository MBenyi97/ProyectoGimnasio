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
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Actividad') }}</label>

                            <div class="col-md-6">
                            <select class="form-select" aria-label="Default select example" name="activityId">
                                    @foreach ($activities as $activity)
                                    <option value="{{$activity->id}}" selected>{{$activity->name}}</option>
                                    @endforeach
                                </select>


                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- DATE -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Fecha') }}</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control @error('name') is-invalid @enderror" name="date" required autocomplete="fecha" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- WEEK DAYS -->
                        <div class="row mb-3">
                            <label for="diaSemana" class="col-md-4 col-form-label text-md-end">{{ __('Días de la semana') }}</label>

                            <div class="col-md-6">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Monday" name="weekDays[]">
                                    <label class="form-check-label">Lunes</label><br>

                                    <input class="form-check-input" type="checkbox" value="Tuesday" name="weekDays[]">
                                    <label class="form-check-label">Martes</label><br>

                                    <input class="form-check-input" type="checkbox" value="Wednesday" name="weekDays[]">
                                    <label class="form-check-label">Miércoles</label><br>

                                    <input class="form-check-input" type="checkbox" value="Thursday" name="weekDays[]">
                                    <label class="form-check-label">Jueves</label><br>

                                    <input class="form-check-input" type="checkbox" value="Friday" name="weekDays[]">
                                    <label class="form-check-label">Viernes</label><br>

                                    <input class="form-check-input" type="checkbox" value="Saturday" name="weekDays[]">
                                    <label class="form-check-label">Sábado</label><br>

                                    <input class="form-check-input" type="checkbox" value="Sunday" name="weekDays[]">
                                    <label class="form-check-label">Domingo</label>
                                </div>

                                @error('diaSemana')
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
                                <input type="time" class="form-control @error('name') is-invalid @enderror" name="hour_start" required autocomplete="hour_start" autofocus>

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
                                <input type="time" class="form-control @error('name') is-invalid @enderror" name="hour_end" required autocomplete="hour_end" autofocus>

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
@section('js')
<script>
    $(document).ready(function() {
        $("#datepicker").datepicker({
            format: "mm-yyyy",
            viewMode: "months",
            minViewMode: "months"
        });
    })
</script>
@endsection