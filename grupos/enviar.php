<?php
include("../conector.php");

if (isset($_POST['enviar1'])){
    try {
        // Validar que los campos no estén vacíos
        if (!(strlen($_POST['nombregrupo']) >= 1 && isset($_POST['semestre']) && isset($_POST['id_generacion']) && isset($_POST['id_carrera']))) {
            throw new Exception("¡Por favor complete todos los campos!");
        }

        $nombre = mysqli_real_escape_string($conexion, trim($_POST['nombregrupo']));
        $semestre = mysqli_real_escape_string($conexion, $_POST['semestre']);
        $id_generacion = mysqli_real_escape_string($conexion, $_POST['id_generacion']);
        $id_carrera = mysqli_real_escape_string($conexion, $_POST['id_carrera']);

        $consulta = "INSERT INTO `grupopedagogico` (`Nombre`, `Semestre`, `ID_Generacion`, `id_carrera`) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'siii', $nombre, $semestre, $id_generacion, $id_carrera);
        $resultado = mysqli_stmt_execute($stmt);

        if (!$resultado) {
            throw new Exception("¡Ha ocurrido un error en su registro!");
        }

        // Mensaje de éxito
        $mensajeExito = "¡Su registro fue exitoso!";
        
        // Redirigir al usuario después de la inserción exitosa
        header("Location: grupos.php?success=1");
        exit();

    } catch (Exception $e) {
        // Puedes optar por redirigir al usuario a la página con un mensaje de error
        header("Location: grupos.php?error=".urlencode($e->getMessage()));
        exit();
    }
}

?>