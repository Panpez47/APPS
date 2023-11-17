<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" href="../Styles/tables.css">

    <title>Semestre</title>
</head>
<body>
    <?php
    include("../conector.php");
    ?>
    <!--Header-->
    <nav class="stroke">
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a class="active" href="../maestros/maestros-data.php">Maestros</a></li>
            <li><a href="../materias.php">Materias</a></li>
            <li><a href="../reportes.php">Reportes</a></li>
        </ul>
    </nav>
    <div class="ContenedorAgregar">
        <a href="./actext.php">
            <button class="buttonnav"><b>Agregar</b></button>
        </a>
    </div>
    
    <div>
        <form  method="post">
            <table class = "tablita lineasVerticales">
                <tr id="headerTabla">
                    <td><b>Actividad</b></td>
                    <td><b>Maestro</b></td>
                    <td><b>Accion</b></td>
                </tr>
    
                <?php
                $id = $_GET["id"];
                $sql="SELECT * from actext WHERE id_act = '$id'";
                $result=mysqli_query($conexion,$sql);
                $filas=['id_act'];
                $idact=$filas;
                while($mostrar=mysqli_fetch_array($result)){
                ?>
    
                <tr id="datosTabla">
                    <input type="hidden" name="id" value="<?php echo $mostrar['id_act']?>">
                    <td><input type="text" name="actext" value="<?php echo $mostrar['nombre_act']?>"></td>
                    <td><input type="text" name="ID_Maestro" value="<?php echo $mostrar['ID_Maestro']?>"></td>
                    <td><input type="submit" name ="enviar1"></td>
                </tr>
                <?php
                }
                include("actext-actualizar.php");
                ?>
            </table> 
            
        </form>
    </div>

</body>
</html>