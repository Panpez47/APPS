<?php
include '../conector.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Asumiendo que estás enviando los IDs del maestro y la materia
  $idMaestro = $_POST['maestro'];
  $idMateria = $_POST['materia'];

  // Preparar la sentencia SQL para evitar inyecciones SQL
  $stmt = $conexion->prepare("INSERT INTO MaestroMateria (ID_Maestro, ID_Materia) VALUES (?, ?)");
  $stmt->bind_param("ii", $idMaestro, $idMateria);

  // Ejecutar la consulta
  if ($stmt->execute()) {
    echo "Materia asignada al maestro correctamente.";
  } else {
    echo "Error al asignar materia: " . $stmt->error;
  }

  // Cerrar la sentencia y la conexión
  $stmt->close();
  $conexion->close();
  header("Location: mm.php");
}
?>
