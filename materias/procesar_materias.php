<?php
// Incluir el archivo de conexión a la base de datos
include("../conector.php");

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["enviar_materia"])) {
    // Obtener los datos del formulario
    $nombreMateria = mysqli_real_escape_string($conexion, $_POST["nombreMateria"]);
    $horas = mysqli_real_escape_string($conexion, $_POST["horas"]);
    $idMaestro = mysqli_real_escape_string($conexion, $_POST["maestro"]);
    $idGeneracion = mysqli_real_escape_string($conexion, $_POST["generacion"]);
    $idCarrera = mysqli_real_escape_string($conexion, $_POST["carrera"]);
    $idGrupo = mysqli_real_escape_string($conexion, $_POST["grupo"]);
    $idSemestre = mysqli_real_escape_string($conexion, $_POST["semestre"]);

    // Query para insertar datos en la tabla materias
    $insertQuery = "INSERT INTO materia (Nombre_Materia, Horas, ID_Maestro, ID_Generacion, ID_Carrera, ID_Grupopedagogico, ID_Semestre)
                    VALUES ('$nombreMateria', '$horas', '$idMaestro', '$idGeneracion', '$idCarrera', '$idGrupo', '$idSemestre')";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $insertQuery)) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error al insertar datos: " . mysqli_error($conexion);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
}
    // Redirigir si se intenta acceder directamente a este archivo sin enviar el formulario
    header("Location: materias-data.php");
    exit();

?>
