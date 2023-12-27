<?php
include("../conector.php");

if (isset($_POST['enviar1'])) {
    try {
        // Validar que los campos no estén vacíos
        if (!(strlen($_POST['nombregrupo']) >= 1 && isset($_POST['semestre']) && isset($_POST['id_generacion']) && isset($_POST['id_carrera']))) {
            throw new Exception("¡Por favor complete todos los campos!");
        }

        $nombre = mysqli_real_escape_string($conexion, trim($_POST['nombregrupo']));
        $semestre = mysqli_real_escape_string($conexion, $_POST['semestre']);
        $id_generacion = mysqli_real_escape_string($conexion, $_POST['id_generacion']);
        $id_carrera = mysqli_real_escape_string($conexion, $_POST['id_carrera']);

        // Verificar si el grupo ya existe
        $verificarQuery = "SELECT COUNT(*) as existe FROM grupopedagogico WHERE Nombre = '$nombre' AND Semestre = '$semestre' AND ID_Generacion = $id_generacion AND id_carrera = $id_carrera";
        $verificarResult = mysqli_query($conexion, $verificarQuery);
        $row = mysqli_fetch_assoc($verificarResult);
        $existeGrupo = $row['existe'];

        if ($existeGrupo > 0) {
            throw new Exception("Error: El grupo ya existe.");
        }

        // Insertar el nuevo grupo
        $insertQuery = "INSERT INTO `grupopedagogico` (`Nombre`, `Semestre`, `ID_Generacion`, `id_carrera`) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $insertQuery);
        mysqli_stmt_bind_param($stmt, 'siii', $nombre, $semestre, $id_generacion, $id_carrera);
        $resultado = mysqli_stmt_execute($stmt);

        if (!$resultado) {
            throw new Exception("¡Ha ocurrido un error en su registro!");
        }

        // Mensaje de éxito
        $mensajeExito = "¡Su registro fue exitoso!";

        // Almacenar el mensaje en la sesión para que se muestre en la página de destino
        session_start();
        $_SESSION['mensajeExito'] = $mensajeExito;

        // Redirigir al usuario después de la inserción exitosa
        header("Location: grupos-data.php?success=1");
        exit();

    } catch (Exception $e) {
        // Almacenar el mensaje de error en la sesión para que se muestre en la página de destino
        session_start();
        $_SESSION['error'] = $e->getMessage();

        // Redirigir al usuario después de encontrar un error
        header("Location: grupos.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}
?>
