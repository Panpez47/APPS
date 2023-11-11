<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" href="../Styles/tables.css">

    <title>Maestros</title>
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
        <a href="../maestros/maestros.php">
            <button class="buttonnav"><b>Agregar</b></button>
        </a>
    </div>
    

    <div>
        <table class = "tablita lineasVerticales">
            <tr id="headerTabla">
                <td><b>ID</b></td>
                <td><b>Nombre del Maestro</b></td>
                <td><b>Horario</b></td>
                <td><b>Acciones</b></td>
            </tr>

            <?php
            $sql="SELECT * from maestros";
            $result=mysqli_query($conexion,$sql);
            $filas=['ID_MAESTRO'];
            $idMaestro=$filas;
            while($mostrar=mysqli_fetch_array($result)){
            ?>

            <tr id="datosTabla">
                <td><?php echo $mostrar['ID_Maestro']?></td>
                <td><?php echo $mostrar['Nombre_maestro']?></td>
                <td><?php echo $mostrar['Horario']?></td>
                

                <td id="botonesss">
                    <a href="maestros-edit.php?id=<?php echo $mostrar['ID_Maestro']?>" <button class="button"><b>Editar</b></button></a>
                    <a href="maestros-delete.php?id=<?php echo $mostrar['ID_Maestro']?>" <button class="button1"><b>Borrar</b></button></a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table> 
    </div>

</body>
</html>