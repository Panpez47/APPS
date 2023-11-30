<?php
include("../conector.php");

$id = $_GET['id'];

$eliminar = "DELETE FROM materia WHERE ID_Materia = '$id'";

$resultado = mysqli_query($conexion, $eliminar);

if($resultado){
    header("Location: materias-data.php");
}else{
    echo" <script>  alert('No') </script> ";
}
?>