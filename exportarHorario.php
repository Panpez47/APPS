<?php
require 'vendor/autoload.php'; // Asegúrate de que la ruta al autoload.php es correcta.
include("conector.php");
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

// Crear una nueva instancia de Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Consulta a la base de datos para obtener los datos (este código ya lo tienes)
// Consulta para obtener las opciones de maestro y materia
$queryOpciones = "SELECT mm.id_maestro_materia, m.Nombre_materia, ma.Nombre_maestro, m.Horas_totales, m.Horas_impartidas 
                  FROM MaestroMateria mm
                  JOIN Materia m ON mm.ID_Materia = m.ID_Materia
                  JOIN Maestros ma ON mm.ID_Maestro = ma.ID_Maestro";
$resultadoOpciones = mysqli_query($conexion, $queryOpciones);

$maestroMateriaOptions = [];
while ($fila = mysqli_fetch_assoc($resultadoOpciones)) {
    $maestroMateriaOptions[] = [
        'id' => $fila['id_maestro_materia'],
        'texto' => $fila['Nombre_materia'] . ' - ' . $fila['Nombre_maestro'] . ' ' . $fila['Horas_impartidas'] . '/' . $fila['Horas_totales']
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

// Añadir los encabezados a la primera fila
$encabezados = ['Hora', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
$columnIndex = 'A';
foreach ($encabezados as $encabezado) {
    $sheet->setCellValue($columnIndex.'1', $encabezado);
    $columnIndex++;
}

// Rellenar los datos en el Spreadsheet
$rowCount = 2; // Comenzar desde la fila 2 para no sobreescribir los encabezados
foreach ($horasInicio as $horaInicio) {
    $horaFin = date('H:i:s', strtotime($horaInicio . ' + 1 hour'));
    $sheet->setCellValue('A'.$rowCount, substr($horaInicio, 0, 5) . ' - ' . substr($horaFin, 0, 5));

    $columnIndex = 'B';
    for ($dia = 1; $dia <= 6; $dia++) {
        $selectedID = $horarioActual[$dia][$horaInicio] ?? '';
        $textoCelda = ''; // Aquí recogeremos el texto que irá en la celda

        foreach ($maestroMateriaOptions as $opcion) {
            if ($opcion['id'] == $selectedID) {
                $textoCelda = $opcion['texto'];
                break;
            }
        }

        $sheet->setCellValue($columnIndex.$rowCount, $textoCelda);
        $columnIndex++;
    }
    $rowCount++;
}

// Autoajustar el ancho de las columnas
foreach (range('A', $columnIndex) as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Crear un writer y guardar el archivo
$writer = new Xlsx($spreadsheet);
$writer->save('horario.xlsx');

// Código para descargar el archivo
$fileName = "horario.xlsx";
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="'.$fileName.'"');
$writer->save('php://output');
exit;