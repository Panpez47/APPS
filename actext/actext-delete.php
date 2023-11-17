<?php
include("../conector.php");

$id = $_GET['id'];

$eliminar = "DELETE FROM actext WHERE id_act = '$id'";

$resultado = mysqli_query($conexion, $eliminar);

if($resultado){
    header("Location: actext-data.php");
}else{
    echo" <script>  alert('No') </script> ";
}
?>