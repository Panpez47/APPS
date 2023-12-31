<?php
include("conector.php");

if (isset($_GET['idHorario'])) {
    $idHorario = $_GET['idHorario'];

    // Eliminar detalles de horario relacionados
    $queryEliminarDetalles = "DELETE FROM detallehorario WHERE ID_Horario = $idHorario";
    mysqli_query($conexion, $queryEliminarDetalles);

    // Intentar eliminar el horario principal
    $queryEliminarHorario = "DELETE FROM horario WHERE ID_Horario = $idHorario";
    
    if (mysqli_query($conexion, $queryEliminarHorario)) {
        header("Location: Horario-data.php?success=Horario eliminado con ID $idHorario");
        exit();
    } else {
        $error = "Error al eliminar el horario: " . mysqli_error($conexion);
        header("Location: Horario-data.php?error=" . urlencode($error));
        exit();
    }
} else {
    $error = "Parámetro 'id' no proporcionado.";
    header("Location: Horario-data.php?error=" . urlencode($error));
    exit();
}
?>
