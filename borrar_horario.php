<?php

// Verificar si se proporcionó el nombre de archivo
if (isset($_GET['archivo'])) {
    $archivo = $_GET['archivo'];

    // Ruta completa al archivo
    $rutaArchivo = 'HorariosJSON/' . $archivo;

    // Verificar si el archivo existe antes de intentar borrarlo
    if (file_exists($rutaArchivo)) {
        // Intentar borrar el archivo
        if (unlink($rutaArchivo)) {
            $mensaje = "El horario '$archivo' ha sido borrado exitosamente.";
            $tipoMensaje = "success";
        } else {
            $mensaje = "Error al intentar borrar el horario.";
            $tipoMensaje = "error";
        }
    } else {
        $mensaje = "El horario '$archivo' no existe.";
        $tipoMensaje = "info";
    }
} else {
    $mensaje = "Nombre de archivo no proporcionado.";
    $tipoMensaje = "info";
}

// Imprimir el mensaje de confirmación y ejecutar el script JavaScript
echo "<script>
    alert('$mensaje');
    window.location.href = 'Horario-data.php'; // Cambia la URL según tu estructura de carpetas
</script>";
?>
