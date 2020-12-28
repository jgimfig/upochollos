//ES UTILIZADO PARA VALORAR LOS CHOLLOS MEDIANTE ESTRELLAS

$(document).ready(function () {

    $("#rateYo").rateYo({
        rating: $("#puntuacionMedia").text() + "%",
        fullStar: true,
        onSet: function (rating, rateYoInstance) {
            rating = Math.ceil(rating);
            
            var idProducto = $("#idProducto_puntuacion").text();

            
            $.ajax({                
                url: "crearPuntuacion?idProducto=" + idProducto + "&puntuacion="+rating,

                error: function (XMLHttpRequest, textStatus, errorThrown) {

                    alert('Error ' + textStatus);
                    alert(errorThrown);
                    alert(XMLHttpRequest.responseText);

                },
                success: function (respuesta) {

                }
            });

        }
    });

});
