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
        <a href="./semestre.php">
            <button class="buttonnav"><b>Agregar</b></button>
        </a>
    </div>
    
    <div>
        <form  method="post">
            <table class = "tablita lineasVerticales">
                <tr id="headerTabla">
                    <td><b>Nombre del semestre</b></td>
                    <td><b>Accion</b></td>
                </tr>
    
                <?php
                $id = $_GET["id"];
                $sql="SELECT * from semestre WHERE ID_Semestre = '$id'";
                $result=mysqli_query($conexion,$sql);
                $filas=['ID_Incidencias'];
                $idSemestre=$filas;
                while($mostrar=mysqli_fetch_array($result)){
                ?>
    
                <tr id="datosTabla">
                    <input type="hidden" name="id" value="<?php echo $mostrar['ID_Semestre']?>">
                    <td><input type="text" name="semestre" value="<?php echo $mostrar['Nombre_semestre']?>"></td>
                    <td><input type="submit" name ="enviar1"></td>
                </tr>
                <?php
                }
                include("semestre-actualizar.php");
                ?>
            </table> 
            
        </form>
    </div>

</body>
</html>