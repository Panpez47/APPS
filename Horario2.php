<?php
session_start();
include("conector.php");
$idHorario = isset($_GET['horarioId']) ? $_GET['horarioId'] : null;

// Recuperar datos de la sesión si existen
$horarioData = isset($_SESSION['horario_data']) ? $_SESSION['horario_data'] : null;

$query = "SELECT mm.id_maestro_materia, m.Nombre_materia, ma.Nombre_maestro, m.Horas_totales, m.Horas_restantes 
        FROM MaestroMateria mm
        JOIN Materia m ON mm.ID_Materia = m.ID_Materia
        JOIN Maestros ma ON mm.ID_Maestro = ma.ID_Maestro";

$resultado = mysqli_query($conexion, $query);

$maestroMateriaOptions = [];
while ($fila = mysqli_fetch_assoc($resultado)) {
    $maestroMateriaOptions[] = [
        'id' => $fila['id_maestro_materia'],
        'texto' => $fila['Nombre_materia'] . ' - ' . $fila['Nombre_maestro'] . ' ' . $fila['Horas_restantes'] . '/' . $fila['Horas_totales']
    ];
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Horario Semanal</title>
    <link rel="stylesheet" href="./Styles/table-horario.css">
    <link rel="stylesheet" href="./Styles/barranav.css">
</head>
<body>
<?php
// Al principio de Horario2.php
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];

    // Mostrar una alerta con información detallada del error
    echo "<script>alert('Error: $errorMessage');</script>";
}
?>
        <div class="container">
            <form id="horarioForm" action="guardar_horario2.php" method="post">
            <!-- Asegúrate de que $idHorario está definido y es el ID correcto que deseas pasar -->
        <input type="hidden" name="idHorario" value="<?php echo isset($idHorario) ? $idHorario : ''; ?>">
                <table class="tablita lineasVerticales">
                    <tr id="headerTabla">
                        <th id="hora">Hora</th>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miercoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                        <th>Sábado</th>
                        <!-- Resto de los días hasta Sábado -->
                    </tr>
                    
        <tr>
        <input type="hidden" name="idHorario" value="<?php echo $idHorario; ?>">
        <?php
// Supongamos que estas son las horas de inicio de las clases
$horasInicio = ['05:00', '06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00'];
foreach ($horasInicio as $indice => $horaInicio) {
    $horaFin = date('H:i', strtotime($horaInicio . ' + 1 hour'));
    echo "<tr>";
    echo "<td>";
    echo "<input type='time' value='{$horaInicio}' name='hora_inicio[]' required>";
    echo "<input type='time' value='{$horaFin}' name='hora_fin[]' required>";
    echo "</td>";
    for ($dia = 1; $dia <= 6; $dia++) {
        echo "<td>";
        echo "<select name='maestromateria[{$dia}][]' data-hora-inicio='{$indice}' data-hora-fin='{$indice}'>";
                            echo "<option value=''>-- Seleccionar --</option>";
                            foreach ($maestroMateriaOptions as $opcion) {
                                echo "<option value='{$opcion['id']}'>{$opcion['texto']}</option>";
                            }
                            echo "</select>";
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
                <button class="botones" type="submit">Guardar Horarios</button>
            </form>
        </div>

</body>
</html>
