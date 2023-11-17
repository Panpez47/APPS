<?php
include("../conector.php");

$id = $_GET['id'];

$eliminar = "DELETE FROM semestre WHERE ID_Semestre = '$id'";

$resultado = mysqli_query($conexion, $eliminar);

if($resultado){
    header("Location: semestre-data.php");
}else{
    echo" <script>  alert('No') </script> ";
}
?>