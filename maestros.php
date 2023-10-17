<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/estilos.css">
    <link rel="stylesheet" href="./Styles/barranav.css">
    <link rel="stylesheet" href="./Styles/forms.css">
    <title>Maestros</title>
</head>
<body>
    
    <!--Header-->

    <nav class="stroke">
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Downloads</a></li>
      <li><a href="#">More</a></li>
    </ul>
  </nav>
    <!--<header>
        <div class="navbar" >
            <ul >
            <li><a href="index.php">Inicio</a></li>
            <li class="active"><a href="maestros.php">Maestro</a></li>
            <li><a href="materias.html">Materias</a></li>
            <li><a href="materias.html">Horarios</a></li>
            <li><a href="reportes.html">Reportes</a></li>
           </ul> 
        </div>
    </header>-->

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