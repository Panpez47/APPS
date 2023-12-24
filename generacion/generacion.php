<?php

session_start();

// Verificar si hay un error para mostrar
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                alert("' . $error . '");
            });
          </script>';
    unset($_SESSION['error']);  // Limpiar el error para evitar que se muestre nuevamente
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" href="../Styles/forms.css">
    <title>Generación</title>
</head>
<body>
     <!--Menu-->
     <nav class="stroke">
        <ul>
            <li><a href="../Horario-data.php">Horario</a></li>
            <li><a href="../maestros/maestros-data.php">Maestros</a></li>
            <li><a href="../materias/materias-data.php">Materias</a></li>
            <li><a class="active" href="../generacion/generacion-data.php">Generacion</a></li> <br> <br>
            <li><a href="../mm/mm-data.php">Cursos Docentes</a></li>
            <li><a href="../incidencias/incidencias-data.php">Incidencias</a></li>
            <li><a href="../actext/actext-data.php">Extras</a></li>
            <li><a href="../grupos/grupos-data.php">Grupos</a></li>
            <li><a href="../carrera/carrera-data.php">Carrera</a></li>

        </ul>
    </nav>
    <!--Formulario-->
    <div class="container">
    <form method="POST">
        <label for="nombregeneracion">Nombre de la Generacion:</label>
        <input type="text" id="generacion" name="generacion" required>
        <br>
        <input type="submit" name = "enviar1" >
    </form>
    <?php
    include("enviar.php");
    ?>
</body>
</html>