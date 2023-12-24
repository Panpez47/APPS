<?php
include("conector.php");

if (isset($_POST['hora_inicio'], $_POST['hora_fin'], $_POST['maestromateria'])) {
    $errores = false;
    $conexion->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

    try {
        for ($i = 0; $i < count($_POST['hora_inicio']); $i++) {
            for ($dia = 1; $dia <= 6; $dia++) {
                $horaInicio = $_POST['hora_inicio'][$i];
                $horaFin = $_POST['hora_fin'][$i];
                $id_maestro_materia = $_POST['maestromateria'][$dia][$i];

                $stmt = $conexion->prepare("INSERT INTO DetalleHorario (HoraInicio, HoraFin, Dia, ID_MaestroMateria) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssii", $horaInicio, $horaFin, $dia, $id_maestro_materia);
                $stmt->execute();
                $stmt->close();
            }
        }
        $conexion->commit();
        echo "Horarios guardados con éxito";
    } catch (mysqli_sql_exception $e) {
        $conexion->rollback();
        $errores = true;
        echo "Error al guardar los horarios: " . $e->getMessage();
    }

    $conexion->close();

    if ($errores) {
        http_response_code(500); // Establecer el código de respuesta HTTP apropiado
    }
} else {
    echo "Todos los campos son requeridos.";
    http_response_code(400); // Código de estado HTTP para solicitud incorrecta
}
?>
