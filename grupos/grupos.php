<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" href="../Styles/forms.css">
    <title>Grupos</title>
</head>
<body>
     <!--Menu-->
     <nav class="stroke">
        <ul>
            <li><a href="../Horario.php">Horario</a></li>
            <li><a href="../maestros/maestros-data.php">Maestros</a></li>
            <li><a href="materias-data.php">Materias</a></li>
            <li><a href="../generacion/generacion-data.php">Generacion</a></li> <br> <br>
            <li><a href="../semestre/semestre-data.php">Semestre</a></li>
            <li><a href="../incidencias/incidencias-data.php">Reportes</a></li>
            <li><a href="../actext/actext-data.php">Extras</a></li>
            <li><a href="../grupos/grupos-data.php">Grupos</a></li>
            <li><a href="../carrera/carrera-data.php">Carrera</a></li>

        </ul>
    </nav>

    <!--Formulario-->
    <div class="container">
    <form method="POST">
        <label for="nombregrupo">Nombre del Grupo:</label>
        <input type="text" id="grupo" name="grupo" required>
        <br>
        <input type="submit" name = "enviar1" >
    </form>
    <?php
    include("enviar.php");
    ?>
</body>
</html>