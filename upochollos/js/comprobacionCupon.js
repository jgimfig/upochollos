/*
 * ESTE SCRIPT JS VALIDARÁ LOCALMENTE LAS ENTRADAS DEL FORMULARIO DE REGISTRO
 * ANTES DE SER ENVIADAS AL SERVIDOR
 */
function comprobarCupon() {
    var fallo = "";
    if ($.trim($('#nombre').val()).length === 0) {
        fallo += "Error, debe rellenar el nombre del cupón.\n";
    }

    if ($.trim($('#codigo').val()).length === 0) {
        fallo += "Error, debe rellenar el código del cupon.\n";
    }
        if ($.trim($('#descripcion').val()).length === 0) {
        fallo += "Error, debe rellenar la descripción del cupón.\n";
    }

    if (fallo != "") {
        alert(fallo);
        return false;
    } else {
        return true;
    }
}
