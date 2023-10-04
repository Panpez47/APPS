<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maestros</title>
</head>
<body>
    
    <!--Header-->
    <header>
        <div>
            <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="maestros.php">Maestro</a></li>
            <li><a href="materias.html">Materias</a></li>
            <li><a href="materias.html">Horarios</a></li>
            <li><a href="reportes.html">Reportes</a></li>
           </ul> 
        </div>
    </header>

    <!--Formulario-->
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

        <input type="submit" name="enviar1" required>

    </form>


    <?php
        include("enviar.php");
    ?>
</body>
</html>