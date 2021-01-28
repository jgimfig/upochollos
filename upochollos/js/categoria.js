function editar(boton) {
    var categoria = boton.parentNode.parentNode;
    var nombre = categoria.childNodes[0].firstChild.nodeValue;
    var colorBorde = categoria.childNodes[1].firstChild.nodeValue;
    var colorFondo = categoria.childNodes[2].firstChild.nodeValue;
    document.getElementById("ncategoria").value = nombre;
    document.getElementById("icolorBorde").value = "#"+colorBorde;
    document.getElementById("icolorFondo").value = "#"+colorFondo;
}
