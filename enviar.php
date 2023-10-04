<?php

 include("conector.php");

if (isset($_POST['enviar1'])){
    if (strlen($_POST['nombre']) >=1 &&
    strlen($_POST['apellido']) >=1 &&
    strlen($_POST['idmateria']) >=1) {
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $idmateria = trim($_POST['idmateria']);
        
        $consulta = "INSERT INTO `MAESTROS`(`Nombre_maestro`, `Ape_maestro`, `ID_Materia`) VALUES ('$nombre','$apellido','$idmateria')";
        $resultado = mysqli_query($conexion,$consulta);
        if ($resultado) { 
            ?>
            <div class="ok"><h3>¡Su registro fue exitoso!</h3></div>
            <?php
        } else {
            ?>
            <div class="bad"><h3>¡Ha ocurrido un error en su registro!</h3></div>
            <?php
        } 
    }else {
        ?>
        <h3 class="bad">¡Por favor complete los campos!</h3>
        <?php
    }
}
 

// "INSERT INTO `registroalumno`(`RegNom_Alumno`, `RegApe_Alumno`, 
//         `RegEdad_ALumno`, `RegCarrera_Alumno`, `RegSemestre_Alumno`, `RegCiudad_Alumno`) VALUES 
//         ('$nombre','$apellido','$edad','$carrera','$semestre','$ciudad')";
 
?> 