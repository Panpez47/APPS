<?php
include("conector.php");

function esMaestroDisponible($conexion, $idMaestroMateria, $dia, $horaInicio, $horaFin, $semanaHorario) {
    // Incluir la comprobación de la semana en la consulta
    $query = "SELECT COUNT(*)
              FROM DetalleHorario dh
              JOIN Horario h ON dh.ID_Horario = h.ID_Horario
              WHERE dh.ID_MaestroMateria = ? 
                AND dh.Dia = ? 
                AND (? < dh.HoraFin AND ? > dh.HoraInicio)
                AND h.Semana = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, 'issss', $idMaestroMateria, $dia, $horaInicio, $horaFin, $semanaHorario);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $conteo);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    return $conteo == 0; // Si el conteo es 0, no hay horarios solapados en la misma semana y el maestro está disponible
}

function actualizarHorasRestantesMateria($conexion, $idMaestroMateria) {
    $query = "UPDATE Materia SET Horas_impartidas = Horas_impartidas - 1 WHERE ID_Materia = (SELECT ID_Materia FROM MaestroMateria WHERE id_maestro_materia = ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, 'i', $idMaestroMateria);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function obtenerInfoMaestroMateria($conexion, $idMaestroMateria) {
    $info = array('nombre_maestro' => '', 'nombre_materia' => '');

    $query = "SELECT ma.Nombre_maestro, m.Nombre_materia 
              FROM MaestroMateria mm
              JOIN Maestros ma ON ma.ID_Maestro = mm.ID_Maestro
              JOIN Materia m ON m.ID_Materia = mm.ID_Materia
              WHERE mm.id_maestro_materia = ?";

    if ($stmt = mysqli_prepare($conexion, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idMaestroMateria);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        if ($fila = mysqli_fetch_assoc($resultado)) {
            $info['nombre_maestro'] = $fila['Nombre_maestro'];
            $info['nombre_materia'] = $fila['Nombre_materia'];
        }
        mysqli_stmt_close($stmt);
    }

    return $info;
}
?>