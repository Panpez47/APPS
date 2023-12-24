<?php
//Datos de la conexión a la base de datos
$host = "localhost"; // El servidor de la base de datos (por lo general, "localhost" en XAMPP)
$usuario = "root"; // El nombre de usuario de la base de datos (generalmente es "root" en XAMPP sin contraseña)
$contrasena = ""; // Deja este campo en blanco, ya que no hay contraseña configurada por defecto en XAMPP
$base_de_datos = "apps"; // El nombre de la base de datos que deseas utilizar

// Intenta establecer la conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verifica si la conexión tuvo éxito
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
} else {
    echo "<p style =Conexión exitosa a la base de datos!";
    // Puedes realizar consultas y operaciones en la base de datos aquí.
}
?>
