<?php
include("../conector.php");

if (isset($_POST['enviar1'])){
    try {

        if (!(strlen($_POST['carrera']) >= 1)){
            throw new Exception("¡Por favor complete los campos!");
        }

        $nombre = trim($_POST['carrera']);

        $consulta = "INSERT INTO `carrera`(`nombre`) VALUES ('$nombre')";
        $resultado = mysqli_query($conexion, $consulta);

        if (!$resultado) {
            throw new Exception("¡Ha ocurrido un error en su registro!");
        }else{
            // Mensaje de éxito
            $mensajeExito = "¡Su registro fue exitoso!";
        }

        
        
        // Redirigir al usuario después de la inserción exitosa
        header("Location: carrera.php");
        exit();
        ?>
        
        <div class="ok"><script>
            alert("<?php echo $mensajeExito; ?>");
        </script><h3 style='color: green'><?php echo $mensajeExito; ?></h3></div>
        <?php
    } catch (Exception $e) {
        ?>
        <div class="bad">
                <script>alert("<?php echo $e->getMessage(); ?>")</script>
                <h3 style='color: red'><?php echo $e->getMessage(); ?></h3></div>
        <?php
    }
}
?>