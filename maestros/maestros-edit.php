<?php
include("../conector.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" href="../Styles/forms.css">
    <title>Maestros</title>
</head>
<body>
    <!--Header-->
    <nav class="stroke">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a class="active" href="maestros.php">Maestros</a></li>
            <li><a href="materias.php">Materias</a></li>
            <li><a href="reportes.php">Reportes</a></li>
        </ul>
    </nav>

<h1>Editar Maestro</h1>

    <?php
    if(isset($_POST['enviar'])){

    }else{
        $id = $GET['ID_Maestro'];
        $sql ="select * from maestros where id='".$id."'";
        $resultado=mysqli_query($conexion,$sql);

        $fila=mysqli_fetch_assoc($resultado);
        $nombre=$fila["Nombre_maestro"];
        $apellido=$fila["Ape_maestro"];
        $idmateria=$fila["ID_Materia"];
    }
    ?>
    <!--Formulario-->
    <div class="container">
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <label for="nombre">Nombre del Maestro:</label>
            <br>
            <input type="text" name="nombre" 
            value="<?php echo $nombre; ?>">
            <br>
            <label for="apellido">Apellidos:</label>
            <br>
            <input type="text" name="apellido" 
            value="<?php echo $apellido; ?>" >
            <br>
            <label for="Cedula">Cedula:</label>
            <br>
            <input type="text" name="Cedula" value="">
            <br>
            <label for="E-mail">E-mail:</label>
            <br>
            <input type="text" name="E-mail" value="">
            <br>
            <input type="hidden" name="id" 
            value="<?php echo $ID_Maestro; ?>">
            <input class="enviar1" type="submit" name="enviar1" value="ACTUALIZAR">
        </form>
    </div>

    <?php
    include("../enviar.php");
    ?>
</body>
</html>