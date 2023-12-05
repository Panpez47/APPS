<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén el nombre del archivo desde el formulario
    $nombreArchivo = $_POST['nombreArchivo'];
    
    // Obtén las materias editadas desde el formulario
    $materias = $_POST['materia'];

    // Cargar el horario actual desde el archivo JSON
    $rutaArchivo = "HorariosJSON/{$nombreArchivo}.json";

    if (file_exists($rutaArchivo)) {
        $json_data = file_get_contents($rutaArchivo);
        $horario = json_decode($json_data, true);

        // Actualizar el horario con las materias editadas
        foreach ($materias as $dia => $materiaPorDia) {
            foreach ($materiaPorDia as $hora => $materia) {
                // Crear identificador único para cada celda del horario (por ejemplo, dia_hora)
                $identificador = $dia . '_' . $hora;
                $horario[$identificador] = $materia;
            }
        }

        // Convertir el array a formato JSON
        $json_horario = json_encode($horario, JSON_PRETTY_PRINT);

        // Guardar el JSON en el archivo
        file_put_contents($rutaArchivo, $json_horario);

        // Redirige a la página de visualización después de guardar los cambios
        header("Location: ver_horario.php?archivo=" . urlencode($nombreArchivo));
        exit();
    } else {
        // El archivo no existe, manejar el error según sea necesario
        echo "El archivo no existe.";
    }
}
?>
