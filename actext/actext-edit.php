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
    <!--Menu-->
    <nav class="stroke">
        <ul>
            <li><a href="../Horario-data.php">Horario</a></li>
            <li><a href="../maestros/maestros-data.php">Maestros</a></li>
            <li><a href="../materias/materias-data.php">Materias</a></li>
            <li><a href="../generacion/generacion-data.php">Generacion</a></li> <br> <br>
            <li><a href="../semestre/semestre-data.php">Semestre</a></li>
            <li><a href="../incidencias/incidencias-data.php">Incidencias</a></li>
            <li><a class="active" href="../actext/actext-data.php">Extras</a></li>
            <li><a href="../grupos/grupos-data.php">Grupos</a></li>
            <li><a href="../carrera/carrera-data.php">Carrera</a></li>

        </ul>

    </nav>
    
    <div class="ContenedorAgregar">
        <a href="./actext.php">
            <button class="buttonnav"><b>Agregar</b></button>
        </a>
    </div>
    
    <div>
        <form  method="post">
            <table class="tablita lineasVerticales">
                <tr id="headerTabla">
                    <td><b>Actividad</b></td>
                    <td><b>Maestro</b></td>
                    <td><b>Accion</b></td>
                </tr>
    
                <?php
                $id = $_GET["id"];
                $sql_actext = "SELECT * FROM actext WHERE id_act = '$id'";
                $result_actext = mysqli_query($conexion, $sql_actext);

                while($mostrar_actext = mysqli_fetch_array($result_actext)){
                ?>
    
                <tr id="datosTabla">
                    <input type="hidden" name="id" value="<?php echo $mostrar_actext['id_act']?>">
                    <td><input type="text" name="actext" value="<?php echo $mostrar_actext['nombre_act']?>"></td>

                    <td>
                        <select name="ID_Maestro">
                            <?php
                            $selected_maestro_id = $mostrar_actext['ID_Maestro'];
                            $sql_maestros = "SELECT * FROM maestros";
                            $result_maestros = mysqli_query($conexion, $sql_maestros);

                            while($mostrar_maestro = mysqli_fetch_array($result_maestros)){
                                $selected = ($mostrar_maestro['ID_Maestro'] == $selected_maestro_id) ? "selected" : "";
                                echo "<option value='{$mostrar_maestro['ID_Maestro']}' $selected>{$mostrar_maestro['Nombre_maestro']}</option>";
                            }
                            ?>
                        </select>
                    </td>

                    <td><input type="submit" name="enviar1"></td>
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
