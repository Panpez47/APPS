<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Disponibilidad</title>
</head>
<body>
    <h2>Formulario de Disponibilidad del Maestro</h2>
    <form action="guardar.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label>Días disponibles:</label><br>
        <input type="checkbox" name="dias[]" value="lunes"> Lunes
        <input type="checkbox" name="dias[]" value="martes"> Martes
        <input type="checkbox" name="dias[]" value="miercoles"> Miércoles
        <input type="checkbox" name="dias[]" value="jueves"> Jueves
        <input type="checkbox" name="dias[]" value="viernes"> Viernes<br>

        <label for="horario">Horario disponible:</label>
        <input type="text" name="horario" placeholder="Ej. 9:00 AM - 12:00 PM" required><br>

        <input type="submit" value="Guardar">
    </form>
</body>
</html>
