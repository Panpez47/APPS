<?php
include("conector.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Supongamos que has enviado la información de horario en campos llamados 'hora_inicio' y 'hora_fin'
    $horaInicio = $_POST['hora_inicio'];
    $horaFin = $_POST['hora_fin'];
    $maestroMateria = $_POST['maestromateria'];

    // Recorre los valores de maestromateria y las horas
    foreach ($maestroMateria as $dia => $valoresDia) {
        foreach ($valoresDia as $indice => $idMaestroMateria) {
            // Verifica si el valor no es la cadena vacía, lo que significa que se seleccionó una materia
            if ($idMaestroMateria !== '') {
                // Asegúrate de que también tienes horas de inicio y fin para este índice
                if (isset($horaInicio[$indice]) && isset($horaFin[$indice])) {
                    // Aquí procesas y guardas los datos en la base de datos
                    $horaInicioActual = $horaInicio[$indice];
                    $horaFinActual = $horaFin[$indice];

                    // Prepara la consulta para insertar en la tabla 'DetalleHorario'
                    $query = "INSERT INTO DetalleHorario (Dia, HoraInicio, HoraFin, ID_MaestroMateria) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_prepare($conexion, $query);
                    mysqli_stmt_bind_param($stmt, 'sssi', $dia, $horaInicioActual, $horaFinActual, $idMaestroMateria);
                    mysqli_stmt_execute($stmt);
                    // Verifica si la inserción fue exitosa y maneja cualquier error
                }
            }
        }
    }

    // Redirecciona o realiza alguna otra acción después de procesar los datos
    header("Location: Horario-data.php");
    exit();
}
?>
