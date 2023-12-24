<?php
include("../conector.php");

function existeMaestro($nombre, $conexion)
{
    $consulta = "SELECT COUNT(*) as total FROM maestros WHERE Nombre_maestro = '$nombre'";
    $resultado = mysqli_query($conexion, $consulta);

    if (!$resultado) {
        throw new Exception("Error al verificar si el maestro ya existe");
    }

    $fila = mysqli_fetch_assoc($resultado);

    return $fila['total'] > 0;
}

if (isset($_POST['enviar1'])) {
    try {
        $nombre = trim($_POST['nombreMaestro']);

        // Verificar si el maestro ya existe
        if (existeMaestro($nombre, $conexion)) {
            throw new Exception("¡El maestro ya existe en la base de datos!");
        }

        $consulta = "INSERT INTO `maestros`(`Nombre_maestro`) VALUES ('$nombre')";
        $resultado = mysqli_query($conexion, $consulta);

        if (!$resultado) {
            throw new Exception("¡Ha ocurrido un error en su registro!");
        }

        // Mensaje de éxito
        $mensajeExito = "¡Su registro fue exitoso!";

        // Redirigir al usuario con el mensaje de éxito
        header("Location: maestros-data.php?exito=" . urlencode($mensajeExito));
        exit();
    } catch (Exception $e) {
        // Mensaje de error
        $mensajeError = $e->getMessage();

        // Redirigir al usuario con el mensaje de error
        header("Location: maestros.php?error=" . urlencode($mensajeError));
        exit();
    }
}
?>
