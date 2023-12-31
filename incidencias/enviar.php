<?php
include("../conector.php");

if (isset($_POST['enviar1'])) {
    try {
        // Validar la longitud del motivo
        if (strlen(trim($_POST['motivo'])) < 1) {
            throw new Exception("¡Por favor complete los campos!");
        }

        // Obtener datos del formulario
        $motivo = trim($_POST['motivo']);
        $idGrupo = $_POST['grupo'];

        // Obtener y formatear la fecha (si no está presente, utiliza la fecha actual)
        $fecha = isset($_POST['fecha']) ? date('Y-m-d', strtotime($_POST['fecha'])) : date('Y-m-d');

        // Insertar datos en la tabla "incidencias"
        $consulta = "INSERT INTO `Incidencias` (`Motivo`, `Fecha`, `ID_Grupopedagogico`) VALUES ('$motivo', '$fecha', '$idGrupo')";
        $resultado = mysqli_query($conexion, $consulta);

        if (!$resultado) {
            throw new Exception("¡Ha ocurrido un error en su registro!");
        }

        // Mensaje de éxito
        $mensajeExito = "¡Su registro fue exitoso!";

        // Redirigir al usuario después de la inserción exitosa
        header("Location: incidencias-data.php");
        exit();
    } catch (Exception $e) {
        // Mensaje de error
        $mensajeError = $e->getMessage();
        ?>
        <div class="bad">
            <script>alert("<?php echo $mensajeError; ?>")</script>
            <h3 style='color: red'><?php echo $mensajeError; ?></h3>
        </div>
        <?php
    }
}
?>
