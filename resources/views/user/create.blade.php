<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creacion miembros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    @extends('layouts.app')
    <main role="main" class="container">
        <div class="starter-template">
            <h1 class="mb-3">Creación de socios</h1>
            <form>

                <!-- DNI input -->
                <div class="form-outline mb-3">
                    <label class="form-label">DNI</label>
                    <input type="text" id="dni" class="form-control" />
                </div>

                <!-- Name input -->
                <div class="form-outline mb-3">
                    <label class="form-label">Nombre Completo</label>
                    <input type="text" id="name" class="form-control" />
                </div>

                <!-- Weight input -->
                <div class="form-outline mb-3">
                    <label class="form-label">Peso</label>
                    <input type="number" id="weight" class="form-control" />
                </div>

                <!-- Height input -->
                <div class="form-outline mb-3">
                    <label class="form-label">Altura</label>
                    <input type="number" id="height" class="form-control" />
                </div>

                <!-- Birthdate input -->
                <div class="form-outline mb-3">
                    <label class="form-label">Fecha de nacimiento</label>
                    <input type="date" id="birthdate" class="form-control" />
                </div>

                <!-- Sex input -->
                <div class="form-outline mb-3">
                    <label class="form-label">Sexo</label>
                    <!-- <input type="text" id="sexo" class="form-control" /> -->
                    <select class="form-select" aria-label="Default select example">
                        <option selected value="1">Mujer</option>
                        <option value="2">Hombre</option>
                        <option value="3">Otro</option>
                    </select>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-3">Enviar</button>
            </form>
        </div>
    </main>
</body>

</html>