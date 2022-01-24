@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <h1>Creación de estudios</h1>

        <form action="/studies" method="post">
        @csrf
        <div>
            <label for="code">Código</label>
            <input type="text" name="code"> 
        </div>

        <div>
            <label for="name">Nombre</label>
            <input type="text" name="name"> 
        </div>

        <div>
            <label for="abreviation">Abreviatura</label>
            <input type="text" name="abreviation"> 
        </div>

        <div>
            <input type="submit" value="crear"> 
        </div>        
        </form>
        </div>
    </div>

</div>
@endsection