<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./Styles/barranav.css">
    <link rel="stylesheet" href="./Styles/forms.css">
    <title>Reportes</title>
</head>
<body>

    <!--Header-->

    <nav class="stroke">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="maestros.php">Maestros</a></li>
            <li><a href="materias.php">Materias</a></li>
            <li><a class="active" href="reportes.php">Reportes</a></li>
        </ul>
    </nav>

    <!--Formulario-->
    <div class="container">
        <form method="POST">
            <label for="nombre">Nombre del Maestro:</label>
            <br>
            <input type="text" name="nombre" required>
            <br>
            <label for="apellido">Apellido:</label>
            <br>
            <input type="text" name="apellido" required>
            <br>
            <label for="idmateria">Materia:</label>
            <br>
            <input type="text" name="idmateria" required>
            <br>
            <input class="enviar1" type="submit" name="enviar1" required>
        </form>
    </div>

    <?php
    include("enviar.php");
    ?>
</body>
</html>