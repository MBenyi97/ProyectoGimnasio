@extends('layouts.background')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Página de inicio') }}</div>
                
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    {{ __('Has iniciado sesión corrrectamente!') }}
                </div>
            </div>
        </div>
    </div>
</div> -->
<h1 id="title">
    MUSCLE PLANET
</h1>
<!-- <img alt="gimnasio" src="{{ asset('img/portada.jpg') }}" class="img-fluid"> -->


<style>
    @import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');

    #title {
        font-family: 'Anton', sans-serif;
        color: white;
        text-shadow: 20px 20px 20px black;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        font-size: 100px;
    }
</style>
@endsection