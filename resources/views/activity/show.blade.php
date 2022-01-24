<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Estudion nº {{$study}}</h1>


    <ul>
        <li>
            <strong>Código</strong>
            {{ $study->code }}
        </li>
        <li>
            <strong>Nombre</strong>
            {{ $study->name }}
        </li>
        <li>
            <strong>Abreviatura</strong>
            {{ $study->abreviation }}
        </li>
    </ul>
</body>
</html>