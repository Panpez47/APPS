<?php
include("conector.php");
$idHorario = isset($_GET['idHorario']) ? $_GET['idHorario'] : null;

// Consulta para obtener las opciones de maestro y materia
$queryOpciones = "SELECT mm.id_maestro_materia, m.Nombre_materia, ma.Nombre_maestro, m.Horas_totales, m.Horas_restantes 
                  FROM MaestroMateria mm
                  JOIN Materia m ON mm.ID_Materia = m.ID_Materia
                  JOIN Maestros ma ON mm.ID_Maestro = ma.ID_Maestro";
$resultadoOpciones = mysqli_query($conexion, $queryOpciones);

$maestroMateriaOptions = [];
while ($fila = mysqli_fetch_assoc($resultadoOpciones)) {
    $maestroMateriaOptions[] = [
        'id' => $fila['id_maestro_materia'],
        'texto' => $fila['Nombre_materia'] . ' - ' . $fila['Nombre_maestro'] . ' ' . $fila['Horas_restantes'] . '/' . $fila['Horas_totales']
    ];
}

// Consulta para obtener los detalles del horario actual
$queryHorario = "SELECT Dia, HoraInicio, ID_MaestroMateria 
                 FROM DetalleHorario 
                 WHERE ID_Horario = ?";
$stmtHorario = mysqli_prepare($conexion, $queryHorario);
mysqli_stmt_bind_param($stmtHorario, 'i', $idHorario);
mysqli_stmt_execute($stmtHorario);
$resultadoHorario = mysqli_stmt_get_result($stmtHorario);

$horarioActual = [];
while ($detalle = mysqli_fetch_assoc($resultadoHorario)) {
    $horarioActual[$detalle['Dia']][$detalle['HoraInicio']] = $detalle['ID_MaestroMateria'];
}
mysqli_stmt_close($stmtHorario);

// Comenta esta parte una vez que hayas verificado que los datos son correctos
echo '<pre>';
print_r($horarioActual);
echo '</pre>';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Horario Semanal</title>
    <!-- Agrega aquí tu CSS para estilos -->
    <style>
        /* Tus estilos aquí */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
            overflow: hidden;
        }
        th {
            background-color: #f2f2f2;
        }
        select {
            width: 100%;
            box-sizing: border-box;
        }
        .container {
            overflow-x: auto;
        }
    </style>
</head>
<body>
<?php
// Al principio de Horario-data.php
if (isset($_GET['error'])) {
    echo "<script>alert('" . $_GET['error'] . "');</script>";
}
?>
<script>
        // Aquí pega tu código JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            var selects = document.querySelectorAll('#horarioForm select');
            selects.forEach(function(select, index) {
                cargarOpcionesDisponibles(select, index);
            });
        });

        function cargarOpcionesDisponibles(select, indice) {
            var horaInicio = document.querySelectorAll("input[name='hora_inicio[]']")[indice].value;
            var horaFin = document.querySelectorAll("input[name='hora_fin[]']")[indice].value;
            var dia = select.name.split('[')[0];

            fetch('obtener_opciones_disponibles.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `dia=${dia}&horaInicio=${horaInicio}&horaFin=${horaFin}`
            })
            .then(response => response.json())
            .then(data => {
                select.innerHTML = "<option value=''>-- Seleccionar --</option>";
                data.forEach(opcion => {
                    select.innerHTML += `<option value='${opcion.id}'>${opcion.texto}</option>`;
                });
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
          <div class="container">
        <form id="horarioForm" action="actualizar-horario2.php" method="post">
            <input type="hidden" name="idHorario" value="<?php echo $idHorario; ?>">
            <table>
                <tr>
                    <th>Hora</th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miércoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                    <th>Sábado</th>
                </tr>
                <?php
                $horasInicio = ['05:00:00', '06:00:00', '07:00:00', '08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00', '13:00:00', '14:00:00', '15:00:00', '16:00:00', '17:00:00', '18:00:00', '19:00:00'];
                foreach ($horasInicio as $horaInicio) {
                    $horaFin = date('H:i:s', strtotime($horaInicio . ' + 1 hour'));
                    echo "<tr>";
                    echo "<td>";
                    echo "<input type='time' value='" . substr($horaInicio, 0, 5) . "' name='hora_inicio[]' required>";
                    echo "<input type='time' value='" . substr($horaFin, 0, 5) . "' name='hora_fin[]' required>";
                    echo "</td>";
                    for ($dia = 1; $dia <= 6; $dia++) {
                        $selectedID = $horarioActual[$dia][$horaInicio] ?? '';
                        echo "<td>";
                        echo "<select name='maestromateria[$dia][$horaInicio]'>";
                        echo "<option value=''>-- Seleccionar --</option>";
                        foreach ($maestroMateriaOptions as $opcion) {
                            $selected = ($opcion['id'] == $selectedID) ? 'selected' : '';
                            echo "<option value='{$opcion['id']}' $selected>{$opcion['texto']}</option>";
                        }
                        echo "</select>";
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </table>
            <button type="button" onclick="agregarFila()">Agregar Horario</button>
            <button type="submit">Guardar Horarios</button>
        </form>
    </div>
</body>
</html>