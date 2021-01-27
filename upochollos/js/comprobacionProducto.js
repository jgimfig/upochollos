/*
 * ESTE SCRIPT JS VALIDARÁ LOCALMENTE LAS ENTRADAS DEL FORMULARIO DE REGISTRO
 * ANTES DE SER ENVIADAS AL SERVIDOR
 */
function comprobarProducto() {
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
    fallo += validacionFoto();
//    if ($('#url').val().length != 0) {
//        fallo += is_url($('#url').val());
//    } else {
//        fallo += "No se ha introducido una URL.\n";
//    }
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
function is_url(str) {
    regexp = /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;
    if (regexp.test(str)) {
        return "";
    } else {
        return "Por favor, escriba una URL correcta.\n";
    }
}