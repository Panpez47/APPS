<?php

include("conector.php");

if (isset($_POST['enviar1'])){
    try {
        if (!(strlen($_POST['nombre']) >= 1 &&
            strlen($_POST['apellido']) >= 1 &&
            strlen($_POST['idmateria']) >= 1)) {
            throw new Exception("¡Por favor complete los campos!");
        }

        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $idmateria = trim($_POST['idmateria']);

        $consulta = "INSERT INTO `MAESTROS`(`Nombre_maestro`, `Ape_maestro`, `ID_Materia`) VALUES ('$nombre','$apellido','$idmateria')";
        $resultado = mysqli_query($conexion, $consulta);

        if (!$resultado) {
            throw new Exception("¡Ha ocurrido un error en su registro!");
        }

        // Mensaje de éxito
        $mensajeExito = "¡Su registro fue exitoso!";
        ?>
        
        <div class="ok"><script>
            alert("<?php echo $mensajeExito; ?>");
        </script><h3 style='color: green'><?php echo $mensajeExito; ?></h3></div>
        <?php
    } catch (Exception $e) {
        ?>
        <div class="bad"><script>alert("<?php echo $e->getMessage(); ?>")</script><h3 style='color: red'><?php echo $e->getMessage(); ?></h3></div>
        <?php
    }
}