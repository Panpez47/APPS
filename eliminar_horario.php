<?php
if (isset($_GET['archivo'])) {
    $archivo = $_GET['archivo'];
    $rutaArchivo = 'HorariosJSON/' . $archivo;

    if (file_exists($rutaArchivo)) {
        // Intenta eliminar el archivo
        if (unlink($rutaArchivo)) {
            // Redirige a "Horario-data.php" después de la eliminación exitosa
            header("Location: Horario-data.php");
            exit();
        } else {
            echo "Error al intentar eliminar el horario.";
        }
    } else {
        echo "El archivo no existe.";
    }
} else {
    echo "Parámetro 'archivo' no proporcionado.";
}
?>
