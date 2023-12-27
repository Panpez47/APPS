<?php
include("../conector.php");

$id = $_GET['id'];

$eliminar = "DELETE FROM grupopedagogico WHERE ID_Grupopedagogico = '$id'";

$resultado = mysqli_query($conexion, $eliminar);

if($resultado){
    header("Location: grupos-data.php");
} else {
    echo "Error al eliminar el grupo: " . mysqli_error($conexion);
}
?>