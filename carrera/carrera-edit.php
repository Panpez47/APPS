<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" href="../Styles/tables.css">

    <title>Carrera</title>
</head>
<body>
    <?php
    include("../conector.php");
    ?>
   <!--Menu-->
   <nav class="stroke">
        <ul>
            <li><a href="../Horario.php">Horario</a></li>
            <li><a href="../maestros/maestros-data.php">Maestros</a></li>
            <li><a href="materias-data.php">Materias</a></li>
            <li><a href="../generacion/generacion-data.php">Generacion</a></li> <br> <br>
            <li><a href="../semestre/semestre-data.php">Semestre</a></li>
            <li><a href="../incidencias/incidencias-data.php">Reportes</a></li>
            <li><a href="../actext/actext-data.php">Extras</a></li>
            <li><a href="../grupos/grupos-data.php">Grupos</a></li>
            <li><a href="../carrera/carrera-data.php">Carrera</a></li>

        </ul>
    </nav>
    <div class="ContenedorAgregar">
        <a href="./carrera.php">
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
                $sql="SELECT * from carrera WHERE id_carrera = '$id'";
                $result=mysqli_query($conexion,$sql);
                $filas=['id_carrera'];
                $idSemestre=$filas;
                while($mostrar=mysqli_fetch_array($result)){
                ?>
    
                <tr id="datosTabla">
                    <input type="hidden" name="id" value="<?php echo $mostrar['id_carrera']?>">
                    <td><input type="text" name="carrera" value="<?php echo $mostrar['nombre']?>"></td>
                    <td><input type="submit" name ="enviar1"></td>
                </tr>
                <?php
                }
                include("carrera-actualizar.php");
                ?>
            </table> 
            
        </form>
    </div>
</body>
</html>