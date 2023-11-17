<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Biblioteca SheetJS (excel) -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.6/xlsx.full.min.js"></script>

<!-- Biblioteca jsPDF (pdf) -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    h2 {
      color: #333;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin: 20px 0;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: left;
      max-width: 150px;
    }

    th {
      background-color: #f2f2f2;
    }

    .materias-list {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    .materia-item {
      border: 1px solid #ddd;
      margin: 5px;
      padding: 8px;
      cursor: move;
      background-color: #fff;
      max-width: 150px;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
    }

    .export-buttons {
      margin-top: 10px;
    }

    button {
      background-color: #4caf50;
      color: #fff;
      padding: 10px;
      border: none;
      cursor: pointer;
      margin-right: 10px;
    }

    button:hover {
      background-color: #45a049;
    }

    .combined {
      background-color: #ddd; /* Color de fondo para celdas combinadas */
    }

    .delete-button {
      background-color: #ff6666;
      color: #fff;
      border: none;
      padding: 5px;
      cursor: pointer;
      margin-left: 5px;
    }

  </style>
</head>
<body>

<div id="materias-list">
  <h2>Materias Listas para Arrastrar</h2>
  <ul class="materias-list">
    <li class="materia-item" draggable="true" ondragstart="drag(event)">Matematicas</li>
    <li class="materia-item" draggable="true" ondragstart="drag(event)">Fisica</li>
    <li class="materia-item" draggable="true" ondragstart="drag(event)">Quimica</li>
    <li class="materia-item" draggable="true" ondragstart="drag(event)">Automatas</li>
    <li class="materia-item" draggable="true" ondragstart="drag(event)">Biologia</li>
  </ul>
</div>

<table>
  <!-- Encabezado de la tabla -->
  <tr>
    <th>Hora</th>
    <th>Lunes</th>
    <th>Martes</th>
    <th>Miércoles</th>
    <th>Jueves</th>
    <th>Viernes</th>
  </tr>
  <!-- Filas con el horario -->
  <!-- Desde las 7 am hasta las 8 pm -->
  <!-- Puedes ajustar el intervalo según tus necesidades específicas -->
  <!-- Intervalo de una hora -->
  <?php for ($hour = 7; $hour <= 20; $hour++): ?>
    <tr>
      <td><?php echo sprintf('%02d:00 - %02d:00', $hour, $hour + 1); ?></td>
      <td ondrop="drop(event)" ondragover="allowDrop(event)" class="drop-area" id="lunes-<?php echo $hour; ?>"></td>
      <td ondrop="drop(event)" ondragover="allowDrop(event)" class="drop-area" id="martes-<?php echo $hour; ?>"></td>
      <td ondrop="drop(event)" ondragover="allowDrop(event)" class="drop-area" id="miercoles-<?php echo $hour; ?>"></td>
      <td ondrop="drop(event)" ondragover="allowDrop(event)" class="drop-area" id="jueves-<?php echo $hour; ?>"></td>
      <td ondrop="drop(event)" ondragover="allowDrop(event)" class="drop-area" id="viernes-<?php echo $hour; ?>"></td>
    </tr>
  <?php endfor; ?>
</table>

<!-- Botón para activar el modo de borrado -->
<button onclick="activarModoBorrado()">Activar Modo Borrado</button>

<div class="export-buttons">
  <button onclick="exportToExcel()">Exportar a Excel</button>
  <button onclick="exportToPDF()">Exportar a PDF</button>
</div>

<script>
  function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.textContent);
  }

  function allowDrop(ev) {
    ev.preventDefault();
  }

  /*function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    var draggedElement = document.createElement("div");
    draggedElement.textContent = data;
    draggedElement.setAttribute("draggable", "true");
    draggedElement.setAttribute("ondragstart", "drag(event)");
    ev.target.appendChild(draggedElement);
  }*/

  function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    var draggedElement = document.createElement("div");
    draggedElement.textContent = data;
    draggedElement.setAttribute("draggable", "true");
    draggedElement.setAttribute("ondragstart", "drag(event)");

    // Obtener la hora y el día desde la ID de la celda
    var cellId = ev.target.id.split("-");
    var day = cellId[0];
    var hour = cellId[1];


    // Verificar si la celda ya contiene una materia
    var existingContent = ev.target.textContent.trim();
    if (existingContent !== "") {
      alert("Ya hay una materia en esta celda. Elimina la materia existente antes de agregar otra.");
      return;
    }

    // Verificar si hay celdas combinadas y combinar si es necesario
    var table = document.querySelector("table");
    var rowspan = 1;
    for (var i = hour; i < 20; i++) {
      var currentCell = document.getElementById(day + "-" + (i + 1));
      if (currentCell && currentCell.textContent === data) {
        rowspan++;
      } else {
        break;
      }
    }

    // Aplicar rowspan a las celdas
    if (rowspan > 1) {
      draggedElement.setAttribute("rowspan", rowspan);
      for (var j = hour; j < hour + rowspan; j++) {
        var targetCell = document.getElementById(day + "-" + j);
        if (targetCell) {
          targetCell.classList.add("combined");
        }
      }
    }

    // Agregar el botón de borrar
    var deleteButton = document.createElement("button");
    deleteButton.textContent = "Borrar";
    deleteButton.classList.add("delete-button");
    deleteButton.onclick = function() {
      deleteMateria(this);
    };
    draggedElement.appendChild(deleteButton);

    ev.target.appendChild(draggedElement);
  }




  function deleteMateria(button) {
    var cell = button.parentNode;
    var table = cell.parentNode.parentNode;
    var rowIndex = cell.parentNode.rowIndex;
    var cellIndex = cell.cellIndex;

    // Eliminar la materia y el botón de borrar
    cell.parentNode.removeChild(cell);

    // Restaurar rowspan y eliminar la clase combined de celdas combinadas
    var rowspan = cell.rowSpan;
    for (var i = rowIndex; i < rowIndex + rowspan; i++) {
      var targetCell = table.rows[i].cells[cellIndex];
      if (targetCell) {
        targetCell.rowSpan = 1;
        targetCell.classList.remove("combined");
      }
    }
  }


  var modoBorrado = false;

  function activarModoBorrado() {
    modoBorrado = !modoBorrado;

    var deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(function(button) {
      button.style.display = modoBorrado ? 'inline-block' : 'none';
    });
  }
  

  function exportToExcel() {
    var table = document.querySelector("table");
    var ws = XLSX.utils.table_to_sheet(table);
    var wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Horario");
    XLSX.writeFile(wb, "horario.xlsx");
  }

  function exportToPDF() {
  var table = document.querySelector("table");
  var pdf = new jsPDF();
  pdf.autoTable({ html: table, startY: 10 });

  // Descargar el archivo PDF
  pdf.save("horario.pdf");
}


</script>

</body>
</html>