<?php
include("../conector.php");

if (isset($_POST['enviar1'])) {
    try {
        if (!(strlen($_POST['carrera']) >= 1)) {
            throw new Exception("¡Por favor complete los campos!");
        }

        $nombre = trim($_POST['carrera']);

        // Verificar si la carrera ya existe
        $verificarQuery = "SELECT COUNT(*) as existe FROM carrera WHERE nombre = '$nombre'";
        $verificarResult = mysqli_query($conexion, $verificarQuery);
        $row = mysqli_fetch_assoc($verificarResult);
        $existeCarrera = $row['existe'];

        if ($existeCarrera > 0) {
            throw new Exception("Error: La carrera ya existe.");
        }

        // Insertar la nueva carrera
        $insertQuery = "INSERT INTO `carrera`(`nombre`) VALUES ('$nombre')";
        $resultado = mysqli_query($conexion, $insertQuery);

        if (!$resultado) {
            throw new Exception("¡Ha ocurrido un error en su registro!");
        } else {
            // Mensaje de éxito
            $mensajeExito = "¡Su registro fue exitoso!";
            // Almacenar el mensaje en una variable de sesión
            session_start();
            $_SESSION['mensajeExito'] = $mensajeExito;
        }

        // Redirigir al usuario después de la inserción exitosa
        header("Location: carrera-data.php");
        exit();
    } catch (Exception $e) {
        // Almacenar el mensaje de error en una variable de sesión
        session_start();
        $_SESSION['error'] = $e->getMessage();
        // Redirigir al usuario después de encontrar un error
        header("Location: carrera.php");
        exit();
    }
}
?>
