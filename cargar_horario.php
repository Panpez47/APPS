<?php
// Cargar el contenido del archivo JSON
$json_horario = file_get_contents('horario.json');

// Decodificar el JSON a un array asociativo
$horario = json_decode($json_horario, true);
?>
