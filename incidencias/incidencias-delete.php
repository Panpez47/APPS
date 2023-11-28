<?php
include("../conector.php");

$id = $_GET['id'];

$eliminar = "DELETE FROM incidencias WHERE ID_Incidencias = '$id'";

$resultado = mysqli_query($conexion, $eliminar);

if($resultado){
    header("Location: incidencias-data.php");
}else{
    echo" <script>  alert('No') </script> ";
}
?>