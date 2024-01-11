<?php
include("conector.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreHorario = $_POST['nombreHorario'];
    $idGrupoPedagogico = $_POST['grupopedagogico'];
    $semana = $_POST['semana']; // Asegúrate de que este campo esté configurado en tu formulario

    // Preparar la consulta para insertar el nuevo horario incluyendo la semana
    $query = "INSERT INTO Horario (NombreHorario, ID_Grupopedagogico, Semana) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($query);

    // Verificar si la sentencia se preparó correctamente
    if ($stmt === false) {
        die("Error en la preparación de la sentencia: " . $conexion->error);
    }

    // Vincular los parámetros a la sentencia
    $stmt->bind_param("sis", $nombreHorario, $idGrupoPedagogico, $semana);

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        // Obtener el ID del horario recién creado
        $nuevoHorarioId = $stmt->insert_id;

        // Redirigir al formulario de detalles del horario con el ID del nuevo horario
        header("Location: Horario2.php?horarioId=" . $nuevoHorarioId);
        exit();
    } else {
        die("Error al ejecutar la sentencia: " . $stmt->error);
    }

    // Cerrar la sentencia y la conexión
    $stmt->close();
    $conexion->close();
}
?>