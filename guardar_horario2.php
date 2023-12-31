<?php
include("conector.php");
include("funciones.php");

// Función para obtener el nombre del maestro
function obtenerNombreMaestro($conexion, $idMaestroMateria) {
    $query = "SELECT ma.Nombre_maestro
              FROM Maestros ma
              JOIN MaestroMateria mm ON ma.ID_Maestro = mm.ID_Maestro
              WHERE mm.id_maestro_materia = '$idMaestroMateria'";

    $resultado = mysqli_query($conexion, $query);

    if ($fila = mysqli_fetch_assoc($resultado)) {
        return $fila['Nombre_maestro'];
    }

    return '';
}

// Función para obtener el nombre de la materia
function obtenerNombreMateria($conexion, $idMaestroMateria) {
    $query = "SELECT m.Nombre_materia
              FROM Materia m
              JOIN MaestroMateria mm ON m.ID_Materia = mm.ID_Materia
              WHERE mm.id_maestro_materia = '$idMaestroMateria'";

    $resultado = mysqli_query($conexion, $query);

    if ($fila = mysqli_fetch_assoc($resultado)) {
        return $fila['Nombre_materia'];
    }

    return '';
}

// Función para obtener las horas restantes de la materia
function obtenerHorasRestantesMateria($conexion, $idMaestroMateria) {
    $query = "SELECT m.Horas_restantes
              FROM Materia m
              JOIN MaestroMateria mm ON m.ID_Materia = mm.ID_Materia
              WHERE mm.id_maestro_materia = '$idMaestroMateria'";

    $resultado = mysqli_query($conexion, $query);

    if ($fila = mysqli_fetch_assoc($resultado)) {
        return $fila['Horas_restantes'];
    }

    return 0;
}

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

                        // Verificar si las horas restantes de la materia son mayores a cero
                        $horasRestantes = obtenerHorasRestantesMateria($conexion, $idMaestroMateria);
                        if ($horasRestantes <= 0) {
                            throw new Exception("La materia " . obtenerNombreMateria($conexion, $idMaestroMateria) . " no tiene horas restantes.");
                        }

                        if (!esMaestroDisponible($conexion, $idMaestroMateria, $dia, $horaInicioActual, $horaFinActual)) {
                            $nombreMaestro = obtenerNombreMaestro($conexion, $idMaestroMateria);
                            $nombreMateria = obtenerNombreMateria($conexion, $idMaestroMateria);
        
                            throw new Exception("El maestro $nombreMaestro no está disponible para la materia $nombreMateria en el horario seleccionado.");
                        }
                        // Actualiza las horas restantes de la materia
                         $queryHoras = "UPDATE Materia SET Horas_restantes = Horas_restantes - 1 WHERE ID_Materia = (SELECT ID_Materia FROM MaestroMateria WHERE id_maestro_materia = '$idMaestroMateria')";
                         mysqli_query($conexion, $queryHoras);
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

    if (isset($error)) {
        // Almacena datos en sesión
        $_SESSION['horario_data'] = $_POST;

        // Redirige al usuario de vuelta a la página anterior
        header("Location: " . $_SERVER['HTTP_REFERER'] . "&error=" . urlencode($error));
    } else {
        header("Location: Horario-data.php?success=Horario actualizado con ID $idHorario");
    }
    exit();
}
?>