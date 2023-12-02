<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/barranav.css">
    <link rel="stylesheet" href="./Styles/table-horario.css">
    <title>Horarios Guardados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        /*table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }*/

         td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        /* Añade este estilo para centrar la columna de acciones */
        #headerTabla th:nth-child(2),
        .tablita td:nth-child(2) {
            text-align: center;
            width: 400px; /* Ajusta el ancho según tus preferencias */
        }

        .ver-horario {
        color: #007BFF; /* Color del texto */
        text-decoration: none; /* Sin subrayado */
        font-weight: bold; /* Texto en negrita */
        padding-top: 0.2rem;
        padding-bottom: 0.2rem; 
        padding-left: 0.5rem;
        padding-right: 0.5rem; 
        border-radius: 0.375rem; 
        color: #ffffff; 
        background-color: #3B82F6; 
        margin-right: 0.5rem;
        }
        
        .ver-horario:hover{
            background-color: #1D4ED8;
        }

        .borrar-horario {
        color: #007BFF; /* Color del texto */
        text-decoration: none; /* Sin subrayado */
        font-weight: bold; /* Texto en negrita */
        padding-top: 0.2rem;
        padding-bottom: 0.2rem; 
        padding-left: 0.5rem;
        padding-right: 0.5rem; 
        border-radius: 0.375rem; 
        color: #ffffff; 
        background-color: #EF4444; 
        margin-right: 0.5rem;
        }
        
        .borrar-horario:hover{
            background-color: #B91C1C;
        }
    </style>
</head>
<body>

<!--Menu-->
<nav class="stroke">
        <ul>
            <li><a class="active" href="./Horario-data.php">Horario</a></li>
            <li><a href="./maestros/maestros-data.php">Maestros</a></li>
            <li><a href="./materias/materias-data.php">Materias</a></li>
            <li><a href="./generacion/generacion-data.php">Generacion</a></li> <br> <br>
            <li><a href="./semestre/semestre-data.php">Semestre</a></li>
            <li><a href="./incidencias/incidencias-data.php">Incidencias</a></li>
            <li><a href="./actext/actext-data.php">Extras</a></li>
            <li><a href="./grupos/grupos-data.php">Grupos</a></li>
            <li><a href="./carrera/carrera-data.php">Carrera</a></li>

        </ul>
    </nav>
    <h1>Horarios Guardados</h1>
    <div class="ContenedorAgregar">
        <a href="./Horario.php">
            <button class="buttonnav"><b>Agregar</b></button>
        </a>
    </div>
    <table class="tablita lineasVerticales">
        <tr id="headerTabla">
            <th>Nombre del Archivo</th>
            <th>Acciones</th>
        </tr>

        <?php
        $directorio = 'HorariosJSON/';
        $archivos = scandir($directorio);

        foreach ($archivos as $archivo) {
            if ($archivo != "." && $archivo != "..") {
                $nombreArchivo = pathinfo($archivo, PATHINFO_FILENAME);
                echo "<tr>";
                echo "<td>{$nombreArchivo}</td>";
                echo "<td><a href='ver_horario.php?archivo={$archivo}' class='ver-horario'>Ver Horario</a><a href='javascript:borrarHorario(\"{$archivo}\")' class='borrar-horario'>Borrar Horario</a></td>";
    
                echo "</tr>";
            }
        }
        ?>
    </table>

    <script>
    function borrarHorario(archivo) {
        // Mostrar un mensaje de confirmación
        var confirmacion = confirm("¿Estás seguro de que quieres borrar el horario?");
        if (confirmacion) {
            // Aquí puedes agregar la lógica para borrar el horario, por ejemplo, una llamada AJAX
            window.location.href = 'borrar_horario.php?archivo=' + archivo; // Cambia 'borrar_horario.php' al archivo y ruta correctos
        }
    }
</script>
</body>
</html>
