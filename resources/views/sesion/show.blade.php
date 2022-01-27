<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity</title>
</head>

<body>
    <h1>Actividad nº {{$sesion->id}}</h1>


    <ul>
        
        <li>
            <strong>Descripción</strong>
            {{ $sesion->fechaSesion }}
        </li>
        <li>
            <strong>Capacidad</strong>
            {{ $sesion->horaInicio }}
        </li>
        <li>
            <strong>Duración</strong>
            {{ $sesion->horaFinal }}
        </li>
    </ul>
</body>

</html>