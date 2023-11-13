<?php
include("../conector.php");

$id = $_GET['id'];

$eliminar = "DELETE FROM maestros WHERE ID_Maestro = '$id'";

$resultado = mysqli_query($conexion, $eliminar);

if($resultado){
    header("Location: maestros-data.php");
}else{
    echo" <script>  alert('No') </script> ";
}


?>