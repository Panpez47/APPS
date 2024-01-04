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

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Horario Semanal</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
    <link rel="stylesheet" href="./Styles/table-horario.css">
    <link rel="stylesheet" href="./Styles/barranav.css">
    <!-- Agrega aquí tu CSS para estilos -->
    <style>
        
    </style>
</head>

<body>
<?php
// Al principio de Horario-data.php
if (isset($_GET['error'])) {
    echo "<script>alert('" . $_GET['error'] . "');</script>";
}
?>

        <div class="container">
        <form id="horarioForm" action="actualizar-horario2.php" method="post">
            <input type="hidden" name="idHorario" value="<?php echo $idHorario; ?>">
            <table class="tablita lineasVerticales" id="miTabla">
                <tr id="headerTabla">
                    <th id="hora">Hora</th>
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
            <button class="botones agregar" type="submit">Guardar Horarios</button>
            <button class="botones" type="button" onclick="regresarAHorarioData()">Regresar</button>
        </form>
        
        <button class="botones excel"onclick="exportTableToExcel('miTabla', 'HorarioSemanal')">Exportar a Excel</button>

    </div>
    
       <script>
function setColWidth(ws, specificWidthForColumnA = 10) {
    // Asegúrate de que '!cols' esté inicializado como un array.
    ws['!cols'] = [];
    // Establece el ancho específico para la columna A.
    ws['!cols'][0] = { wch: specificWidthForColumnA };

    // A partir de la columna B, ajusta el ancho de las columnas basado en el contenido.
    var range = XLSX.utils.decode_range(ws['!ref']);
    for (var C = range.s.c + 1; C <= range.e.c; ++C) { // Comienza en la segunda columna (B)
        var maxColWidth = 10; // Ancho mínimo por defecto para las columnas
        for (var R = range.s.r; R <= range.e.r; ++R) {
            var cell_ref = XLSX.utils.encode_cell({c: C, r: R});
            if (!ws[cell_ref]) continue;
            var text = ws[cell_ref].v.toString();
            if (text && text.length > maxColWidth) maxColWidth = text.length;
        }
        ws['!cols'][C] = { wch: maxColWidth };
    }
}

function exportTableToExcel(tableID, filename = ''){
    var tableSelect = document.getElementById(tableID);
    var wb = XLSX.utils.book_new();

    // Creamos un array para guardar los datos
    var aoa = [];

    // Aquí el texto predefinido que aparecerá en las primeras filas
    var headerInfo = [
        ["2023: Año de Francisco Villa, El Revolucionario del Pueblo y del Bicentenario del Heroico Colegio Militar"],
        ["Dir. Gral. Educ. Mil. y Rec. U.D.E.F.A."],
        ["Colegio del Aire. Esc. Mil. de Manto. y Ab. Seccion Academica"],
        ["Colegio del Aire."],
        ["Distribución de tiempo para la semana del ______ 2024."],
        ["Sargentos______. F.A.E.M.A. C.I. (_____ Semestre)"]
    ];

    // Añadir el texto predefinido al arreglo 'aoa'
    headerInfo.forEach(row => aoa.push(row));

    // Añadir una fila vacía como separación
    aoa.push([]);

    // Procesar la fila de encabezado de la tabla
    var headerCells = tableSelect.querySelectorAll('tr')[0].querySelectorAll('th');
    var headerRow = [];
    for(var i = 0; i < headerCells.length; i++) {
        headerRow.push(headerCells[i].innerText);
    }
    aoa.push(headerRow);

    // Iterar sobre cada fila de la tabla, comenzando por la primera fila de datos
    var rows = tableSelect.querySelectorAll('tr');
    for(var rowIndex = 1; rowIndex < rows.length; rowIndex++) {
        var row = [];
        var cells = rows[rowIndex].querySelectorAll('td');
        for(var cellIndex = 0; cellIndex < cells.length; cellIndex++) {
            var cell = cells[cellIndex];
            var text = "";
            if(cellIndex === 0) { // La columna de las horas
                var inputs = cell.querySelectorAll('input[type="time"]');
                if(inputs.length === 2) {
                    text = inputs[0].value + '-' + inputs[1].value; // Formato "HH:MM-HH:MM"
                }
            } else {
                var select = cell.querySelector('select');
                if(select && select.selectedIndex > 0) {
                    text = select.options[select.selectedIndex].text;
                    if(text === "-- Seleccionar --") {
                        text = "";
                    }
                }
            }
            row.push(text);
        }
        aoa.push(row);
    }

    // Agregamos los datos al libro de trabajo
    var ws = XLSX.utils.aoa_to_sheet(aoa);

    // Inicializar la propiedad de merges si aún no existe
    ws['!merges'] = [];

    // Combinar las celdas para el texto predefinido (ajustar el rango según sea necesario)
    headerInfo.forEach((_, index) => {
        ws['!merges'].push({ s: {r: index, c: 0}, e: {r: index, c: 6} }); // Combinar desde columna A a G
    });

    // Ajustar el ancho de las columnas
    setColWidth(ws); // Asegúrate de que esta función esté definida en tu código
    

    
    XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
// Antes de guardar el archivo:

    // Escribir el archivo
    XLSX.writeFile(wb, (filename || 'Horario') + '.xlsx');
}
</script>

<script>
    function regresarAHorarioData() {
        window.location.href = 'horario-data.php';
    }
</script>
</body>
</html>