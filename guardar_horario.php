<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén el nombre del archivo desde el formulario
    $nombreArchivo = $_POST['nombreArchivo'];
    $nombreHorario = $_POST['nombreHorario'];
    $materias = $_POST['materia'];

    // Crear un array para el horario
    $horario = array();

    foreach ($materias as $dia => $materiaPorDia) {
        foreach ($materiaPorDia as $hora => $materia) {
            // Crear identificador único para cada celda del horario (por ejemplo, dia_hora)
            $identificador = $dia . '_' . $hora;
            $horario[$identificador] = $materia;
        }
    }

    // Convertir el array a formato JSON
    $json_horario = json_encode($horario, JSON_PRETTY_PRINT);

    // Especifica la carpeta donde deseas guardar los archivos JSON
    $carpetaGuardado = __DIR__ . '/HorariosJSON/';

    // Asegúrate de que la carpeta exista o créala si es necesario
    if (!file_exists($carpetaGuardado)) {
        mkdir($carpetaGuardado, 0777, true);
    }

    // Especifica la ruta completa del archivo
    $rutaArchivo = $carpetaGuardado . ($nombreArchivo ? $nombreArchivo : $nombreHorario . '.json');

    // Guardar el JSON en el archivo
    file_put_contents($rutaArchivo, $json_horario);

    // Decide si estás editando o creando
    if ($nombreArchivo) {
        // Estás editando, redirige a la página de visualización después de guardar los cambios
        header("Location: ver_horario.php?archivo=" . urlencode($nombreArchivo));
    } else {
        // Estás creando, redirige a la página de visualización del nuevo horario
        header("Location: Horario-data.php?nombre=" . urlencode($nombreHorario));
    }
    exit();
}
?>
