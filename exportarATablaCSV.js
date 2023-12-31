function exportarATablaCSV(nombreArchivo) {
    var csv = [];
    var rows = document.querySelectorAll("table tr");
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");
        
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(","));        
    }

    // Crear y descargar el archivo CSV
    descargarCSV(csv.join("\n"), nombreArchivo);
}

function descargarCSV(csv, nombreArchivo) {
    var csvFile;
    var downloadLink;

    // Archivo CSV
    csvFile = new Blob([csv], {type: "text/csv"});

    // Enlace de descarga
    downloadLink = document.createElement("a");

    // Nombre de archivo
    downloadLink.download = nombreArchivo;

    // Crear un enlace al archivo
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Ocultar el enlace de descarga
    downloadLink.style.display = "none";

    // Agregar el enlace al DOM
    document.body.appendChild(downloadLink);

    // Hacer clic en el enlace de descarga
    downloadLink.click();
}
