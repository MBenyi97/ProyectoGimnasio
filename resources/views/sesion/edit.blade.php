@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item"><a href="/sesions">Sesiones</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
              </ol>
            </nav>
            <div class="card">
                <div class="card-header">{{ __('Editar actividad') }}</div>

                <div class="card-body">
                    <form method="POST" action="/sesions/{{$sesion->id}}">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="sesion_id" value="{{$sesion->id}}">

                        <!-- ACTIVITY -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Actividad') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" aria-label="Default select example" name="activity_id" for="activity_id">
                                    @foreach ($activities_dates['activities'] as $activity)
                                    @if ($activity->id==$sesion->activity_id)
                                    <option value="{{$activity->id}}" selected>{{$activity->name}}</option>
                                    @else
                                    <option value="{{$activity->id}}">{{$activity->name}}</option>
                                    @endif
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
                                <input value="{{$activities_dates['date']}}" type="date" class="form-control @error('name') is-invalid @enderror" name="date" value="{{$sesion->date_start}} required autocomplete=" fecha" autofocus>

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
                                    @foreach ($activities_dates['daysChecked'] as $days => $check)
                                    @if ($check=="checked")
                                    <input class="form-check-input" {{$check}} type="checkbox" value="{{$days}}" name="weekDays[]">
                                    <label class="form-check-label">{{$days}}</label><br>
                                    @else
                                    <input class="form-check-input" type="checkbox" value="{{$days}}" name="weekDays[]">
                                    <label class="form-check-label">{{$days}}</label><br>
                                    @endif
                                    @endforeach
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
                                @foreach($activities_dates['arrHours'] as $type => $time)
                                @if ($type == 'hourStart')
                                <input value="{{$time}}" type="time" class="form-control @error('name') is-invalid @enderror" name="hour_start" required autocomplete="hour_start" autofocus>
                                @endif
                                @endforeach

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
                                @foreach($activities_dates['arrHours'] as $type => $time)
                                @if ($type == 'hourStart')
                                <input value="{{$time}}" type="time" class="form-control @error('name') is-invalid @enderror" name="hour_end" required autocomplete="hour_end" autofocus>
                                @endif
                                @endforeach

                                @error('horaFinal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a class="btn btn-primary edit-sesion">Editar</a>
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
    $(".edit-sesion").click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire(
            'Editado!',
            'La sesión ha sido editada.',
            'success'
        ).then(function() {
            form.submit();
        });
    });
</script>
@endsection