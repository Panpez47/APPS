<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" href="../Styles/forms.css">
    <title>Maestros</title>
</head>
<body>

    <!--Header-->

    <nav class="stroke">
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a class="active" href="maestros-data.php">Maestros</a></li>
            <li><a href="../materias.php">Materias</a></li>
            <li><a href="../reportes.php">Reportes</a></li>
        </ul>
    </nav>

    <!--Formulario-->
    <div class="container">
    <form method="POST">
        <label for="nombreMaestro">Nombre del Maestro:</label>
        <input type="text" id="nombreMaestro" name="nombreMaestro" required>
        <br>
        <label for="horario">Horario:</label>
        <select name="horario" id="horario">
            <option value="8:00am-1:00pm">8:00am-1:00pm</option>
            <option value="9:00am-2:00pm">9:00am-2:00pm</option>
            <option value="10:00am-3:00pm">10:00am-3:00pm</option>
        </select>
        <br>
        <input type="submit" name = "enviar1" >
    </form>
    
    </div>
    <?php
    include("enviar.php");
    ?>
</body>
</html>