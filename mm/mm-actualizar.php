<?php
include("../conector.php");

// Verifica si se enviaron los datos necesarios del formulario
if (isset($_POST['id_maestro_materia'], $_POST['id_maestro'], $_POST['id_materia'])) {
    // Asigna los valores de POST a variables
    $id_maestro_materia = $_POST['id_maestro_materia'];
    $id_maestro = $_POST['id_maestro'];
    $id_materia = $_POST['id_materia'];

    // Preparar la sentencia de actualización
    $stmt = $conexion->prepare("UPDATE MaestroMateria SET ID_Maestro = ?, ID_Materia = ? WHERE id_maestro_materia = ?");

    // Vincular los parámetros a la sentencia preparada
    $stmt->bind_param("iii", $id_maestro, $id_materia, $id_maestro_materia);

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        echo "Registro actualizado con éxito.";
        // Redirigir al usuario a la página de listado o donde desees
        header("Location: mm-data.php");
        // exit;
    } else {
        echo "Error al actualizar el registro: " . $conexion->error;
    }

    // Cerrar la sentencia y la conexión
    $stmt->close();
    $conexion->close();
} else {
    echo "Todos los campos son requeridos.";
}
?>
