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
    <!--Header-->
   <nav class="stroke">
        <ul>
            <li><a class="active" href="../index.php">Horario</a></li>
            <li><a href="./maestros/maestros-data.php">Maestros</a></li>
            <li><a href="materias.php">Materias</a></li>
            <li><a href="#">Generacion</a></li>
            <li><a href="./semestre.php">Semestre</a></li>
            <li><a href="reportes.php">Reportes</a></li>
            <li><a href="#">Extras</a></li>
            <li><a href="#">GruposP</a></li>
        </ul>
    </nav>

    <div class="ContenedorAgregar">
        <a href="./carrera.php">
            <button class="buttonnav"><b>Agregar</b></button>
        </a>
    </div>

    <div>
        <table class = "tablita lineasVerticales">
            <tr id="headerTabla">
                <td><b>ID</b></td>
                <td><b>Carrera</b></td>
                <td><b>Acciones</b></td>
            </tr>

            <?php
            $sql="SELECT * from carrera";
            $result=mysqli_query($conexion,$sql);
            $filas=['id_carrera'];
            $idSemestre=$filas;
            while($mostrar=mysqli_fetch_array($result)){
            ?>

            <tr id="datosTabla">
                <td><?php echo $mostrar['id_carrera']?></td>
                <td><?php echo $mostrar['nombre']?></td>
                

                <td id="botonesss">
                    <a href="carrera-edit.php?id=<?php echo $mostrar['id_carrera']?>" <button class="button"><b>Editar</b></button></a>
                    <a href="carrera-delete.php?id=<?php echo $mostrar['id_carrera']?>" <button class="button1"><b>Borrar</b></button></a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table> 
    </div>
            <script src ="confirmacion.js"></script>
</body>
</html>