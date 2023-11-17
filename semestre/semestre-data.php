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
        <a href="../semestre/semestre.php">
            <button class="buttonnav"><b>Agregar</b></button>
        </a>
    </div>

    <div>
        <table class = "tablita lineasVerticales">
            <tr id="headerTabla">
                <td><b>ID</b></td>
                <td><b>Semestre</b></td>
                <td><b>Acciones</b></td>
            </tr>

            <?php
            $sql="SELECT * from semestre";
            $result=mysqli_query($conexion,$sql);
            $filas=['ID_Semestre'];
            $idSemestre=$filas;
            while($mostrar=mysqli_fetch_array($result)){
            ?>

            <tr id="datosTabla">
                <td><?php echo $mostrar['ID_Semestre']?></td>
                <td><?php echo $mostrar['Nombre_semestre']?></td>
                

                <td id="botonesss">
                    <a href="semestre-edit.php?id=<?php echo $mostrar['ID_Semestre']?>" <button class="button"><b>Editar</b></button></a>
                    <a href="semestre-delete.php?id=<?php echo $mostrar['ID_Semestre']?>" <button class="button1"><b>Borrar</b></button></a>
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