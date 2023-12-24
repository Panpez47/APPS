<?php
include("../conector.php");

$id = $_GET['id'];

$eliminar = "DELETE FROM MaestroMateria WHERE id_maestro_materia = '$id'";

$resultado = mysqli_query($conexion, $eliminar);

if($resultado){
    header("Location: mm-data.php");
}else{
    echo" <script>  alert('No') </script> ";
}
?>