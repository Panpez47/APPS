<?php
if (isset($_GET['archivo'])) {
    $archivo = $_GET['archivo'];
    $rutaArchivo = 'HorariosJSON/' . $archivo;

    if (file_exists($rutaArchivo)) {
        // Redirige directamente a "eliminar_horario.php"
        header("Location: eliminar_horario.php?archivo={$archivo}");
        exit();
    } else {
        echo "El archivo no existe.";
    }
} else {
    echo "Parámetro 'archivo' no proporcionado.";
}
?>
