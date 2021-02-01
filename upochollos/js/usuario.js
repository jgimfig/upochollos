function validacionFoto() {
    $a=$("#inputFoto");
    if ($("#inputFoto").val() == '') {
        return false;
    } else {
        var Extension = $("#inputFoto").val().split('.').pop().toLowerCase();
        if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") {
            return true;
        } else {
            alert("El archivo no tiene una extensión válida");
            return false;
        }
    }
}

function elimina(){
    var res=prompt("¿ESTA SEGURO DE ELIMINAR LA CUENTA?\n(Los comentarios, valoraciones,chollos creados también se eliminarán)\n Introduzca S para Si o N para no");
    if(res=="S"){
        return true;
    }
    else{
        return false;
    }
        
}