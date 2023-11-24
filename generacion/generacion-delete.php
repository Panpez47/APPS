<?php
include("../conector.php");

$id = $_GET['id'];

$eliminar = "DELETE FROM generacion WHERE ID_Generacion = '$id'";

$resultado = mysqli_query($conexion, $eliminar);

if($resultado){
    header("Location: generacion-data.php");
}else{
    echo" <script>  alert('No') </script> ";
}
?>