/*
 * ESTE SCRIPT JS VALIDARÁ LOCALMENTE LAS ENTRADAS DEL FORMULARIO DE REGISTRO
 * ANTES DE SER ENVIADAS AL SERVIDOR
 */
function comprobarProducto() {
    var fallo = "";
    if ($('#precioOriginal').val().length === 0) {
        fallo += "Error, debe rellenar el precio original.\n";
    } else if (!$.isNumeric($('#precioOriginal').val()) || $('#precioOriginal').val() <= 0) {
        fallo += "Error, debe rellenar el precio original correctamente. Debe introducir un numero positivo.\n";
    }
    if ($('#precioDescuento').val().length === 0) {
        fallo += "Error, debe rellenar el precio con descuento.\n";
    } else if (!$.isNumeric($('#precioDescuento').val()) || $('#precioDescuento').val() <= 0) {
        fallo += "Error, debe rellenar el precio con descuento correctamente. Debe introducir un numero positivo.\n";
    }
    if ($('#precioDescuento').val().length != 0 && $.isNumeric($('#precioOriginal').val()) && $('#precioOriginal').val().length != 0 && $.isNumeric($('#precioDescuento').val()) && $('#precioDescuento').val() > $('#precioOriginal').val()) {
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
    if ($('#nombre').val().length === 0) {
        fallo += "Error, debe rellenar el nombre.\n";
    }

    if ($('#descripcion').val().length === 0) {
        fallo += "Error, debe rellenar la descripción.\n";
    }

    if ($('#precioOriginal').val().length === 0) {
        fallo += "Error, debe rellenar el precio original.\n";
    } else if (!$.isNumeric($('#precioOriginal').val()) || $('#precioOriginal').val() <= 0) {
        fallo += "Error, debe rellenar el precio original correctamente. Debe introducir un numero positivo.\n";
    }
    if ($('#precioDescuento').val().length === 0) {
        fallo += "Error, debe rellenar el precio con descuento.\n";
    } else if (!$.isNumeric($('#precioDescuento').val()) || $('#precioDescuento').val() <= 0) {
        fallo += "Error, debe rellenar el precio con descuento correctamente. Debe introducir un numero positivo.\n";
    }
    if ($('#precioDescuento').val().length != 0 && $.isNumeric($('#precioOriginal').val()) && $('#precioOriginal').val().length != 0 && $.isNumeric($('#precioDescuento').val()) && $('#precioDescuento').val() > $('#precioOriginal').val()) {
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
//            alert($('#imagen').size());
//            var fileSize = $('#imagen').size;
//            var sizeMegaBytes = parseInt(fileSize / (1024*1024));
//            if (sizeMegaBytes > 3) {
//                return "Por favor, selecciona una imagen que pese menos de 5 MB.\n";
//            } else {
            return "";
//            }
        } else {
            return "Seleccione un archivo con extensión de una fotografía.\n";
        }
    }
}