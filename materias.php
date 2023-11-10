<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./Styles/barranav.css">
    <link rel="stylesheet" href="./Styles/forms.css">
    <title>Materias</title>
</head>
<body>

    <!--Header-->

    <nav class="stroke">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="./maestros/maestros-data.php">Maestros</a></li>
            <li><a class="active" href="materias.php">Materias</a></li>
            <li><a href="reportes.php">Reportes</a></li>
        </ul>
    </nav>

    <!--Formulario-->
    <div class="container">
        <form method="POST">
            <label for="nombre">Nombre de la materia:</label>
            <br>
            <input type="text" name="nombre" required>
            <br>
            <label for="maestro">Maestro:</label>
            <br>
            <input type="text" name="maestro" required>
            <br>
            <label for="Semestre">Semestre:</label>
            <br>
            <input type="text" name="Semestre" required>
            <br>
            <label for="Carrera">Carrera:</label>
            <br>
            <input type="text" name="Carrera" required>
            <br>
            <input class="enviar1" type="submit" name="enviar1" required>
        </form>
    </div>

    <?php
    include("enviar.php");
    ?>
</body>
</html>
