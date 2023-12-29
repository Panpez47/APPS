<?php
include("conector.php");
include("funciones.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibes los campos del formulario
    $idHorario = $_POST['idHorario']; // Asegúrate de enviar este dato desde tu formulario
    $horaInicio = $_POST['hora_inicio'];
    $horaFin = $_POST['hora_fin'];
    $maestroMateria = $_POST['maestromateria'];

    // Iniciar la transacción
    mysqli_begin_transaction($conexion);

    try {
        // Usa el ID del horario para insertar cada detalle del horario
        foreach ($maestroMateria as $dia => $valoresDia) {
            foreach ($valoresDia as $indice => $idMaestroMateria) {
                if ($idMaestroMateria !== '') {
                    if (isset($horaInicio[$indice]) && isset($horaFin[$indice])) {
                        $horaInicioActual = $horaInicio[$indice];
                        $horaFinActual = $horaFin[$indice];

                        if (!esMaestroDisponible($conexion, $idMaestroMateria, $dia, $horaInicioActual, $horaFinActual)) {
                            throw new Exception("El maestro no está disponible en el horario seleccionado.");
                        }

                        $queryDetalle = "INSERT INTO DetalleHorario (ID_Horario, Dia, HoraInicio, HoraFin, ID_MaestroMateria) VALUES (?, ?, ?, ?, ?)";
                        $stmtDetalle = mysqli_prepare($conexion, $queryDetalle);
                        mysqli_stmt_bind_param($stmtDetalle, 'isssi', $idHorario, $dia, $horaInicioActual, $horaFinActual, $idMaestroMateria);
                        mysqli_stmt_execute($stmtDetalle);
                        mysqli_stmt_close($stmtDetalle);
                    }
                }
            }
        }

        mysqli_commit($conexion);
    } catch (Exception $e) {
        mysqli_rollback($conexion);
        $error = $e->getMessage();
    }

    mysqli_close($conexion);

    // Redirecciona o realiza alguna otra acción después de procesar los datos
    if (isset($error)) {
        header("Location: Horario2.php?idHorario=" . $idHorario . "&error=" . urlencode($error));
    } else {
        header("Location: Horario-data.php?success=Horario actualizado con ID $idHorario");
    }
    exit();
}
