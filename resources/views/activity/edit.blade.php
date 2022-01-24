@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <h1>Actualización de estudios</h1>

        <form action="/studies/{{$study->id}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div>
            <label for="code">Código</label>
            <input type="text" name="code" value="{{$study->code}}"> 
        </div>

        <div>
            <label for="name">Nombre</label>
            <input type="text" name="name" value="{{$study->name}}"> 
        </div>

        <div>
            <label for="abreviation">Abreviatura</label>
            <input type="text" name="abreviation" value="{{$study->abreviation}}"> 
        </div>

        <div>
            <input type="submit" value="actualizar"> 
        </div>        
        </form>
        </div>
    </div>

</div>
@endsection