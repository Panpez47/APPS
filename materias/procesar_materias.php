<?php
// Incluir el archivo de conexión a la base de datos
include("../conector.php");

// Inicializar la variable de sesión para el mensaje
session_start();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["enviar_materia"])) {
    // Obtener los datos del formulario
    $nombreMateria = mysqli_real_escape_string($conexion, $_POST["nombreMateria"]);
    $horasTotales = mysqli_real_escape_string($conexion, $_POST["horas_totales"]);
    $idGrupoPedagogico = mysqli_real_escape_string($conexion, $_POST["grupo"]);

    // Verificar si la materia ya existe con el mismo nombre y grupo pedagógico
    $verificarQuery = "SELECT COUNT(*) as existe FROM materia WHERE Nombre_Materia = '$nombreMateria' AND ID_Grupopedagogico = '$idGrupoPedagogico'";
    $verificarResult = mysqli_query($conexion, $verificarQuery);
    $row = mysqli_fetch_assoc($verificarResult);
    $existeMateria = $row['existe'];

    if ($existeMateria > 0) {
        // Almacena un mensaje de error en la sesión.
        $_SESSION['error'] = "Error: La materia ya existe con el mismo nombre y grupo pedagógico.";
        
        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
        
        // Redirigir a materias.php en caso de error
        header("Location: materias.php");
        exit();
    }

    // Query para insertar datos en la tabla materia
    $insertQuery = "INSERT INTO materia (Nombre_Materia, `Horas_Totales`, `Horas_impartidas`, ID_Grupopedagogico)
                    VALUES ('$nombreMateria', '$horasTotales', '0', '$idGrupoPedagogico')";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $insertQuery)) {
        // Datos insertados correctamente. Almacena un mensaje en la sesión.
        $_SESSION['mensajeExito'] = "Materia agregada exitosamente.";
        
        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
        
        // Redirigir a materias-data.php después de mostrar el mensaje
        header("Location: materias-data.php");
        exit();
    } else {
        // Almacena un mensaje de error en la sesión.
        $_SESSION['error'] = "Error al insertar datos: " . mysqli_error($conexion);
        
        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
        
        // Redirigir a materias.php en caso de error
        header("Location: materias.php");
        exit();
    }
}
?>
