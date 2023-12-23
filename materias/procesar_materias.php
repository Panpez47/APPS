<?php
// Incluir el archivo de conexión a la base de datos
include("../conector.php");

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["enviar_materia"])) {
    // Obtener los datos del formulario
    // Obtener los datos del formulario
$nombreMateria = mysqli_real_escape_string($conexion, $_POST["nombreMateria"]);
$horasTotales = mysqli_real_escape_string($conexion, $_POST["horas_totales"]);
$idGrupoPedagogico = mysqli_real_escape_string($conexion, $_POST["grupo"]);

// Query para insertar datos en la tabla materia
$insertQuery = "INSERT INTO materia (Nombre_Materia, `Horas_Totales`, `Horas_Restantes`, ID_Grupopedagogico)
                VALUES ('$nombreMateria', '$horasTotales', '$horasTotales', '$idGrupoPedagogico')";


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
