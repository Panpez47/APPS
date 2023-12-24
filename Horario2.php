<?php
include("conector.php");
// Suponiendo que tienes una conexión a base de datos en $conexion
$query = "SELECT mm.id_maestro_materia, m.Nombre_materia, ma.Nombre_maestro 
          FROM MaestroMateria mm
          JOIN Materia m ON mm.ID_Materia = m.ID_Materia
          JOIN Maestros ma ON mm.ID_Maestro = ma.ID_Maestro";

$resultado = mysqli_query($conexion, $query);

$maestroMateriaOptions = [];
while ($fila = mysqli_fetch_assoc($resultado)) {
    $maestroMateriaOptions[] = [
        'id' => $fila['id_maestro_materia'],
        'texto' => $fila['Nombre_materia'] . ' - ' . $fila['Nombre_maestro']
    ];
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
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <form action="guardar_horario2.php" method="post">
        <table>
            <tr>
                <th>Hora Inicio - Hora Fin</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miercoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
                <th>Sábado</th>
                <!-- Resto de los días hasta Sábado -->
            </tr>
            
<tr>
<?php
// Supongamos que estas son las horas de inicio de las clases
$horas = ['05:00', '06:00', '07:00', '08:00', '09:00', '10:00'. '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00' /* ... hasta las 20:00 */];
foreach ($horas as $hora) {
    echo "<tr>";
    // Dos campos para hora de inicio y fin
    echo "<td>";
    echo "<input type='time' value='{$hora}' name='hora_inicio[]' required> - ";
    echo "<input type='time' value='{$hora}' name='hora_fin[]' required>";
    echo "</td>";
    for ($dia = 1; $dia <= 6; $dia++) { // 6 días de la semana
        echo "<td>";
        echo "<select name='maestromateria[{$dia}][]'>";
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
        <button type="button" onclick="agregarFila()">Agregar Horario</button>
        <button type="submit">Guardar Horarios</button>
    </form>
</body>
</html>
