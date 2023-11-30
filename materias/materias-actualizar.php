<?php
include("../conector.php");

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar_materia"])) {
    // Obtener los datos del formulario
    $idMateria = mysqli_real_escape_string($conexion, $_POST["idMateria"]);
    $nombreMateria = mysqli_real_escape_string($conexion, $_POST["nombreMateria"]);
    $horas = mysqli_real_escape_string($conexion, $_POST["horas"]);
    $idMaestro = mysqli_real_escape_string($conexion, $_POST["maestro"]);
    $idGeneracion = mysqli_real_escape_string($conexion, $_POST["generacion"]);
    $idCarrera = mysqli_real_escape_string($conexion, $_POST["carrera"]);
    $idGrupo = mysqli_real_escape_string($conexion, $_POST["grupo"]);
    $idSemestre = mysqli_real_escape_string($conexion, $_POST["semestre"]);

    // Query para actualizar los datos en la tabla materias
    $updateQuery = "UPDATE materia 
                SET Nombre_materia = '$nombreMateria', 
                    Horas = '$horas', 
                    ID_Maestro = '$idMaestro', 
                    ID_Generacion = '$idGeneracion', 
                    id_carrera = '$idCarrera', 
                    ID_Grupopedagogico = '$idGrupo', 
                    ID_Semestre = '$idSemestre'
                WHERE ID_Materia = '$idMateria'";

    // Ejecutar la consulta de actualización
    if (mysqli_query($conexion, $updateQuery)) {
        echo "Datos actualizados correctamente.";
    } else {
        echo "Error al actualizar datos: " . mysqli_error($conexion);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    // Manejar el caso en el que el formulario no se ha enviado correctamente
    echo "Error: El formulario no se ha enviado correctamente.";
}
header("Location: materias-data.php");
?>
