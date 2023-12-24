<?php
// Recuperar el mensaje de éxito de la URL si existe
$mensajeError = isset($_GET['error']) ? urldecode($_GET['error']) : null;
?>


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

   <!--Menu-->
   <nav class="stroke">
        <ul>
            <li><a href="../Horario-data.php">Horario</a></li>
            <li><a class="active" href="../maestros/maestros-data.php">Maestros</a></li>
            <li><a href="../materias/materias-data.php">Materias</a></li>
            <li><a href="../generacion/generacion-data.php">Generacion</a></li> <br> <br>
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
        <label for="nombreMaestro">Nombre del Maestro:</label>
        <input type="text" id="nombreMaestro" name="nombreMaestro" required>
        <br>
        
        <input type="submit" name = "enviar1" >
    </form>
    
    </div>

    <script>
             // Función para mostrar la alerta después de la carga de la página
        window.onload = function() {
            <?php if (isset($_GET['error'])) : ?>
                alert("<?php echo urldecode($_GET['error']); ?>");
            
            <?php endif; ?>
        };
    </script>

    
    <?php
    include("enviar.php");
    ?>
</body>
</html>