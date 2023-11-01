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
            <li><a href="index.php">Home</a></li>
            <li><a class="active" href="maestros.php">Maestros</a></li>
            <li><a href="materias.php">Materias</a></li>
            <li><a href="reportes.php">Reportes</a></li>
        </ul>
    </nav>

    <div>
        <table>
            <tr>
                <td>id</td>
                <td>Nombre del Maestro</td>
                <td>Apellido del Maestro</td>
                <td>idmateria</td>
                <td>Acciones</td>
            </tr>
            <?php
            $sql="SELECT * from maestros";
            $result=mysqli_query($conexion,$sql);
            $filas=['ID_MAESTRO'];
            $idMaestro=$filas;
            while($mostrar=mysqli_fetch_array($result)){
            ?>

            <tr>
                <td><?php echo $mostrar['ID_Maestro']?></td>
                <td><?php echo $mostrar['Nombre_maestro']?></td>
                <td><?php echo $mostrar['Ape_maestro']?></td>
                <td><?php echo $mostrar['ID_Materia']?></td>
                <td>
                    <a href="maestros-edit.php?
                    $id=<?php echo $mostrar['ID_Maestro']?> &
                    $nombre=<?php echo $mostrar['Nombre_maestro']?> &
                    $apellido=<?php echo $mostrar['Ape_maestro']?> &
                    $idmateria=<?php echo $mostrar['ID_Materia']?>
                    ">Editar<a/>
                    
                
                </td>
            </tr>
            <?php
            }
            ?>
        </table> 
    </div>

</body>
</html>