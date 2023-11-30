<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $rutaArchivo = $carpetaGuardado . $nombreHorario . '.json';

    // Guardar el JSON en el archivo
    file_put_contents($rutaArchivo, $json_horario);

    // Redirigir a la página de visualización del horario recién guardado
    header("Location: Horario-data.php?nombre=" . urlencode($nombreHorario));
}
?>
