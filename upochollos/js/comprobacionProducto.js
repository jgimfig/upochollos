/*
 * ESTE SCRIPT JS VALIDARÁ LOCALMENTE LAS ENTRADAS DEL FORMULARIO DE REGISTRO
 * ANTES DE SER ENVIADAS AL SERVIDOR
 */
function comprobarProducto() {
    var fallo = "";
    if ($.trim($('#nombre').val()).length === 0) {
        fallo += "Error, debe rellenar el nombre.\n";
    }

    if ($.trim($('#descripcion').val()).length === 0) {
        fallo += "Error, debe rellenar la descripción.\n";
    }

    if ($.trim($('#precioOriginal').val()).length === 0) {
        fallo += "Error, debe rellenar el precio original.\n";
    } else if (!$.isNumeric($('#precioOriginal').val()) || $('#precioOriginal').val() <= 0) {
        fallo += "Error, debe rellenar el precio original correctamente. Debe introducir un numero positivo.\n";
    }
    if ($.trim($('#precioDescuento').val()).length === 0) {
        fallo += "Error, debe rellenar el precio con descuento.\n";
    } else if (!$.isNumeric($('#precioDescuento').val()) || $('#precioDescuento').val() <= 0) {
        fallo += "Error, debe rellenar el precio con descuento correctamente. Debe introducir un numero positivo.\n";
    }
    if ($.trim($('#precioDescuento').val()).length != 0 && $.isNumeric($('#precioOriginal').val()) && $.trim($('#precioOriginal').val()).length != 0 && $.isNumeric($('#precioDescuento').val()) && $('#precioDescuento').val().trim() > $('#precioOriginal').val().trim()) {
        fallo += "El precio del descuento debe ser inferior al original.\n";
    }
    fallo += validacionFoto();
    if (fallo != "") {
        alert(fallo);
        return false;
    } else {
        return true;
    }
}

function comprobarModificacionProducto() {
    var fallo = "";
    if ($.trim($('#nombre').val()).length === 0) {
        fallo += "Error, debe rellenar el nombre.\n";
    }

    if ($.trim($('#descripcion').val()).length === 0) {
        fallo += "Error, debe rellenar la descripción.\n";
    }

    if ($.trim($('#precioOriginal').val()).length === 0) {
        fallo += "Error, debe rellenar el precio original.\n";
    } else if (!$.isNumeric($('#precioOriginal').val()) || $('#precioOriginal').val() <= 0) {
        fallo += "Error, debe rellenar el precio original correctamente. Debe introducir un numero positivo.\n";
    }
    if ($.trim($('#precioDescuento').val()).length === 0) {
        fallo += "Error, debe rellenar el precio con descuento.\n";
    } else if (!$.isNumeric($('#precioDescuento').val()) || $('#precioDescuento').val() <= 0) {
        fallo += "Error, debe rellenar el precio con descuento correctamente. Debe introducir un numero positivo.\n";
    }
    if ($.trim($('#precioDescuento').val()).length != 0 && $.isNumeric($('#precioOriginal').val().trim()) && $.trim($('#precioOriginal').val()).length != 0 && $.isNumeric($('#precioDescuento').val().trim()) && $('#precioDescuento').val().trim() > $('#precioOriginal').val().trim()) {
        fallo += "El precio del descuento debe ser inferior al original.\n";
    }

    if (fallo != "") {
        alert(fallo);
        return false;
    } else {
        return true;
    }
}

function validacionFoto() {
    if ($("#imagen").val() == '') {
        return "Error, debe subir una imagen del producto.\n";
    } else {
        var Extension = $("#imagen").val().split('.').pop().toLowerCase();
        if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") {
            return "";
        } else {
            return "Seleccione un archivo con extensión de una fotografía.\n";
        }
    }
}