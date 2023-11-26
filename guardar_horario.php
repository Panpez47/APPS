<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $horario = $_POST['materia'];

    // Convertir el array a formato JSON
    $json_horario = json_encode($horario, JSON_PRETTY_PRINT);

    // Guardar en un archivo JSON
    file_put_contents('horario.json', $json_horario);
}
?>
