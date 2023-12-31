<?php
include("conector.php");
$idHorario = isset($_GET['horarioId']) ? $_GET['horarioId'] : null;
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
                <button class="botones agregar" type="button" onclick="agregarFila()">Agregar Horario</button>
                <button class="botones" type="submit">Guardar Horarios</button>
            </form>
            <button class="botones" type="button" onclick="exportarATablaCSV('getHorario.csv')">Exportar a Excel</button>

        </div>
<script>
    function exportarATablaCSV(nombreArchivo) {
    var csv = [];
    var rows = document.querySelectorAll("table tr");
    
    // Añadir BOM para UTF-8
    var BOM = "\uFEFF";
    csv.push(BOM);
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");

        for (var j = 0; j < cols.length; j++) {
            // Manejar inputs de tipo 'time'
            var inputs = cols[j].querySelectorAll("input[type='time']");
            if (inputs.length > 0) {
                // Asumiendo que hay dos inputs de hora en cada celda de tiempo
                var horaInicio = inputs[0].value;
                var horaFin = inputs[1].value;
                row.push('"' + horaInicio + ' - ' + horaFin + '"'); // Concatenar las horas con un guion
            } else if (cols[j].querySelector('select')) {
                // Manejar los elementos select
                var select = cols[j].querySelector('select');
                var texto = select.options[select.selectedIndex].text;
                if (texto !== '-- Seleccionar --') {
                    row.push('"' + texto.replace(/"/g, '""') + '"');
                } else {
                    row.push('');
                }
            } else {
                // Agregar el texto de la celda envuelto en comillas dobles
                row.push('"' + cols[j].innerText.replace(/"/g, '""') + '"');
            }
        }
        csv.push(row.join(","));
    }

    // Convertir el array a un string y crear el archivo CSV
    descargarCSV(csv.join("\n"), nombreArchivo);
}

function descargarCSV(csv, nombreArchivo) {
    var csvFile;
    var downloadLink;

    // Crear archivo CSV
    csvFile = new Blob([csv], {type: "text/csv;charset=utf-8;"});

    // Crear el enlace de descarga
    downloadLink = document.createElement("a");
    downloadLink.download = nombreArchivo;
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = "none";

    // Añadir enlace al DOM y hacer clic para descargar
    document.body.appendChild(downloadLink);
    downloadLink.click();
}


</script>
</body>
</html>
