<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity</title>
</head>

<body>
    <h1>Actividad nº {{$activity->id}}</h1>


    <ul>
        <li>
            <strong>Nombre</strong>
            {{ $activity->name }}
        </li>
        <li>
            <strong>Descripción</strong>
            {{ $activity->description }}
        </li>
        <li>
            <strong>Capacidad</strong>
            {{ $activity->capacity }}
        </li>
        <li>
            <strong>Duración</strong>
            {{ $activity->duration }}
        </li>
    </ul>
</body>

</html>