
function asignarUbicacion(codubicacion, ubicacion) {
    window.parent.document.getElementById("codubicacion").value = codubicacion;
    window.parent.document.getElementById("ubicacion").value = ubicacion;
    window.parent.closeModal();
}


