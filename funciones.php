<?php
include("conector.php");

function esMaestroDisponible($conexion, $idMaestroMateria, $dia, $horaInicio, $horaFin) {
    // Aquí iría la lógica para comprobar si el maestro ya tiene asignada una clase en ese horario
    // Esto implica consultar la base de datos y verificar si hay solapamientos de horarios
    // Retorna true si el maestro está disponible, false de lo contrario

    // Ejemplo de consulta (deberás adaptarla a tu base de datos y lógica):
    $query = "SELECT COUNT(*) FROM DetalleHorario WHERE ID_MaestroMateria = ? AND Dia = ? AND (? < HoraFin AND ? > HoraInicio)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, 'isss', $idMaestroMateria, $dia, $horaInicio, $horaFin);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $conteo);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    return $conteo == 0; // Si el conteo es 0, no hay horarios solapados y el maestro está disponible
}

function actualizarHorasRestantesMateria($conexion, $idMaestroMateria) {
    $query = "UPDATE Materia SET Horas_restantes = Horas_restantes - 1 WHERE ID_Materia = (SELECT ID_Materia FROM MaestroMateria WHERE id_maestro_materia = ?)";
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