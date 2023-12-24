<?php
include("../conector.php");

if (isset($_POST['enviar1'])) {
    try {
        if (!(strlen($_POST['generacion']) >= 1)) {
            throw new Exception("¡Por favor complete los campos!");
        }

        $nombre = trim($_POST['generacion']);

        // Verificar si la generación ya existe
        $verificarQuery = "SELECT COUNT(*) as existe FROM generacion WHERE Nombre = '$nombre'";
        $verificarResult = mysqli_query($conexion, $verificarQuery);
        $row = mysqli_fetch_assoc($verificarResult);
        $existeGeneracion = $row['existe'];

        if ($existeGeneracion > 0) {
            throw new Exception("Error: La generación ya existe.");
        }

        // Insertar la nueva generación
        $insertQuery = "INSERT INTO `generacion`(`Nombre`) VALUES ('$nombre')";
        $resultado = mysqli_query($conexion, $insertQuery);

        if (!$resultado) {
            throw new Exception("¡Ha ocurrido un error en su registro!");
        }

        // Mensaje de éxito
        $mensajeExito = "¡Su registro fue exitoso!";

        // Almacenar el mensaje en la sesión para que se muestre en la página de destino
        session_start();
        $_SESSION['mensajeExito'] = $mensajeExito;

        // Redirigir al usuario después de la inserción exitosa
        header("Location: generacion-data.php");
        exit();
    } catch (Exception $e) {
        // Almacenar el mensaje de error en la sesión para que se muestre en la página de destino
        session_start();
        $_SESSION['error'] = $e->getMessage();

        // Redirigir al usuario después de encontrar un error
        header("Location: generacion.php");
        exit();
    }
}
?>
