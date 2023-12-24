<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" type="text/css" href="../Styles/tables.css">

    <title>Editar grupos</title>
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
            <li><a href="../mm/mm-data.php">Cursos Docentes</a></li>
            <li><a href="../incidencias/incidencias-data.php">Incidencias</a></li>
            <li><a href="../actext/actext-data.php">Extras</a></li>
            <li><a class="active" href="../grupos/grupos-data.php">Grupos</a></li>
            <li><a href="../carrera/carrera-data.php">Carrera</a></li>

        </ul>
    </nav>
    <div class="ContenedorAgregar">
        <a href="./grupos.php">
            <button class="buttonnav"><b>Agregar</b></button>
        </a>
    </div>
    
    <div>
    <div>
        <form action="grupos-actualizar.php" method="post">
            <table class="tablita lineasVerticales">
                <tr id="headerTabla">
                    <td><b>Nombre del Grupo</b></td>
                    <td><b>Semestre</b></td>
                    <td><b>Generación</b></td>
                    <td><b>Carrera</b></td>
                    <td><b>Acciones</b></td>
                </tr>

                <tr id="datosTabla">
                <?php
                $id = $_GET["id"];
                $stmt = mysqli_prepare($conexion, "SELECT * FROM grupopedagogico WHERE ID_Grupopedagogico = ?");
                mysqli_stmt_bind_param($stmt, 'i', $id);
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);
                $fila = mysqli_fetch_assoc($resultado);
                ?>
    
                <td>
                
                <input type="text" id="nombregrupo" name="nombregrupo" value="<?php echo htmlspecialchars($fila['Nombre']); ?>" required>
                <br>
                </td>
    
                <td>
               
                <select id="semestre" name="semestre" required>
                    <?php for($i = 1; $i <= 9; $i++): ?>
                        <option value="<?php echo $i; ?>" <?php echo (int)$fila['Semestre'] === $i ? 'selected' : ''; ?>><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
                <br>
                </td>
                    
                <td>
                
                <select id="id_generacion" name="id_generacion" required>
                    <?php
                    $genSql = "SELECT ID_Generacion, Nombre FROM Generacion";
                    $genResult = mysqli_query($conexion, $genSql);
                    while($genRow = mysqli_fetch_assoc($genResult)): ?>
                        <option value="<?php echo $genRow['ID_Generacion']; ?>" <?php echo $genRow['ID_Generacion'] == $fila['ID_Generacion'] ? 'selected' : ''; ?>>
                            <?php echo $genRow['Nombre']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <br>
                </td>
                    
                <td>
                
                <select id="id_carrera" name="id_carrera" required>
                    <?php
                    $carrSql = "SELECT id_carrera, nombre FROM Carrera";
                    $carrResult = mysqli_query($conexion, $carrSql);
                    while($carrRow = mysqli_fetch_assoc($carrResult)): ?>
                        <option value="<?php echo $carrRow['id_carrera']; ?>" <?php echo $carrRow['id_carrera'] == $fila['id_carrera'] ? 'selected' : ''; ?>>
                            <?php echo $carrRow['nombre']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <br>
                </td>
                    
                <td>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="enviar1" value="Actualizar Grupo">
                </td>
                </tr>
            </table>
        </form>
            
    </div>
</body>
</html>







