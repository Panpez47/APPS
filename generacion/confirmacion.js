function confirmacion(e) {
    if (confirm("¿Estas seguro que quieres eliminar este elemento?")) {
        return true;
} else {
    e.preventDefault();
}
}

let linkDelete = document.querySelectorAll(".button1");

for(var i = 0; i < linkDelete.length; i++) {
    linkDelete[i].addEventListener('click', confirmacion); 
}
