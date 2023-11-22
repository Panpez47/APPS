<?php
include("../conector.php");

$id = $_GET['id'];

$eliminar = "DELETE FROM carrera WHERE id_carrera = '$id'";

$resultado = mysqli_query($conexion, $eliminar);

if($resultado){
    header("Location: carrera-data.php");
}else{
    echo" <script>  alert('No') </script> ";
}
?>