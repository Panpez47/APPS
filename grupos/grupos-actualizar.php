<?php
include("../conector.php");

if (isset($_POST['enviar1'])){
    try {
        // Validar que los campos no estén vacíos
        if (!(strlen($_POST['nombregrupo']) >= 1)){
            throw new Exception("¡Por favor complete los campos!");
        }

        $id = trim($_POST['id']);
        $nombre = trim($_POST['nombregrupo']);
        $semestre = trim($_POST['semestre']);
        $id_generacion = trim($_POST['id_generacion']);
        $id_carrera = trim($_POST['id_carrera']);

        // Preparar la consulta SQL para evitar inyección SQL
        $consulta = "UPDATE grupopedagogico SET Nombre = ?, Semestre = ?, ID_Generacion = ?, id_carrera = ? WHERE ID_Grupopedagogico = ?";
        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'siiii', $nombre, $semestre, $id_generacion, $id_carrera, $id);
        $resultado = mysqli_stmt_execute($stmt);

        if (!$resultado) {
            throw new Exception("¡Ha ocurrido un error al actualizar el registro!");
        }

        // Mensaje de éxito
        $mensajeExito = "¡La actualización fue exitosa!";

        // Redirigir al usuario después de la actualización exitosa
        header("Location: grupos-data.php?success=1");
        exit();
    } catch (Exception $e) {
        // Puedes optar por redirigir al usuario a la página con un mensaje de error
        header("Location: grupos-data.php?error=".urlencode($e->getMessage()));
        exit();
    }
}
?>
