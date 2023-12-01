<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" href="../Styles/tables.css">
    <title>Incidencias</title>
</head>
<body>
    <?php
    include("../conector.php");
    ?>
    <!--Menu-->
    <nav class="stroke">
        <ul>
            <li><a href="../Horario-data.php">Horario</a></li>
            <li><a href="../maestros/maestros-data.php">Maestros</a></li>
            <li><a href="../materias/materias-data.php">Materias</a></li>
            <li><a href="../generacion/generacion-data.php">Generacion</a></li> <br> <br>
            <li><a href="../semestre/semestre-data.php">Semestre</a></li>
            <li><a class="active" href="../incidencias/incidencias-data.php">Incidencias</a></li>
            <li><a href="../actext/actext-data.php">Extras</a></li>
            <li><a href="../grupos/grupos-data.php">Grupos</a></li>
            <li><a href="../carrera/carrera-data.php">Carrera</a></li>

        </ul>
    </nav>

    <div class="ContenedorAgregar">
        <a href="./incidencias.php">
            <button class="buttonnav"><b>Agregar</b></button>
        </a>
    </div>

    <div>
    <form  method="post">
            <table class = "tablita lineasVerticales">
                <tr id="headerTabla">
                    <td><b>Motivo</b></td>
                    <td><b>Maestro</b></td>
                    <td><b>Fecha</b></td>
                    <td><b>Accion</b></td>
                </tr>
    
                <?php
                $id = $_GET["id"];
                $sql="SELECT * from incidencias WHERE ID_Incidencias = '$id'";
                $result=mysqli_query($conexion,$sql);
                $filas=['ID_Incidencias'];
                $idSemestre=$filas;
                while($mostrar=mysqli_fetch_array($result)){
                ?>
    
                <tr id="datosTabla">
                    <input type="hidden" name="id" value="<?php echo $mostrar['ID_Incidencias']?>">
                    <td><input type="text" name="motivo" value="<?php echo $mostrar['Motivo']?>"></td>
                    <td><input type="text" name="maestro" value="<?php echo $mostrar['ID_Maestro']?>"></td>
                    <td><input type="text" name="fecha" value="<?php echo $mostrar['Fecha']?>"></td>
                    <td><input type="submit" name ="enviar1"></td>
                </tr>
                <?php
                }
                include("incidencias-actualizar.php");
                ?>
            </table> 
            
        </form> 
    </div>
    <script src="confirmacion.js"></script>
</body>
</html>
