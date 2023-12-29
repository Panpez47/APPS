<?php
include("conector.php");

// Asegúrate de obtener el ID del horario a editar
$idHorario = isset($_GET['idHorario']) ? $_GET['idHorario'] : null;

if ($idHorario) {
    // Consulta para obtener los detalles del horario
    $query = "SELECT * FROM DetalleHorario WHERE ID_Horario = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $idHorario);
    $stmt->execute();
    $result = $stmt->get_result();
    $horarioDetalles = $result->fetch_all(MYSQLI_ASSOC);

    // Aquí podrías obtener todas las opciones de maestros y materias para tus selects
    // ...

    $stmt->close();
} else {
    echo "ID de horario no especificado.";
    exit();
}
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
        table-layout: fixed; /* Esto ayuda a que todas las columnas tengan el mismo ancho */
    }
    th, td {
        border: 1px solid black;
        padding: 5px;
        text-align: center;
        overflow: hidden; /* Esto asegura que el contenido no desborde */
    }
    th {
        background-color: #f2f2f2;
    }
    select {
        width: 100%; /* Esto hace que el select ocupe todo el ancho de la celda */
        box-sizing: border-box; /* Esto asegura que el padding y border estén incluidos en el ancho */
    }

    .container {
    overflow-x: auto; /* Permite el desplazamiento horizontal si la tabla es muy ancha */
    }

</style>
</head>
<body>
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
        <!-- Contenedor de la tabla de horario -->
    <div class="container">
        <form id="horarioForm" action="guardar_cambios_horario.php" method="post">
            <input type="hidden" name="idHorario" value="<?php echo $idHorario; ?>">
            <table>
                <tr>
                    <th>Hora</th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miercoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                    <th>Sabado</th>
                    <!-- Más días de la semana -->
                </tr>
                <?php foreach ($horarioDetalles as $detalle): ?>
                <tr>
                    <td><?php echo $detalle['HoraInicio'] . ' - ' . $detalle['HoraFin']; ?></td>
                    <!-- Generar selects con los datos de maestros y materias aquí -->
                    <!-- Repite para cada día de la semana según corresponda -->
                </tr>
                <?php endforeach; ?>
            </table>
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>