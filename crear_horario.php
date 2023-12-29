<?php
include("conector.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreHorario = $_POST['nombreHorario'];
    $idGrupoPedagogico = $_POST['grupopedagogico'];

    // Insertar en la tabla Horario
    $query = "INSERT INTO Horario (NombreHorario, ID_Grupopedagogico) VALUES (?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("si", $nombreHorario, $idGrupoPedagogico);
    $stmt->execute();

    // Obtener el ID del horario recién creado
    $nuevoHorarioId = $stmt->insert_id;

    $stmt->close();
    $conexion->close();

    // Redirigir al formulario de detalles del horario
    header("Location: Horario2.php?horarioId=" . $nuevoHorarioId);
    exit();
}
?>
