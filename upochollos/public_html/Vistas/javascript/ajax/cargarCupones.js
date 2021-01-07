//MEDIANTE AJAX, SE HARA UNA LLAMADA A LA ACCIÓN "cargarCupones".
//UNA VEZ RECIBIDA LA RESPUESTA, SE PROCEDE A ESTRUCTURAR LA INFORMACION EN CODIGO HTML, QUE SERÁ AÑADIDO A cupones.jsp

$("#selector_cupones").ready(
        function () {

            $.ajax({
                url: "cargarCupones",

                error: function (XMLHttpRequest, textStatus, errorThrown) {

                    alert('Error ' + textStatus);
                    alert(errorThrown);
                    alert(XMLHttpRequest.responseText);

                },
                success: function (respuesta) {


                    var cupones = respuesta.trim().split("$");


                    for (var i = 0; i < cupones.length; i++)
                    {
                        var cupon = cupones[i].trim().split("_");

                        var nombre = cupon[0];
                        var descripcion = cupon[1];
                        var fechaPublicado = cupon[2];
                        var fechaVencimiento = cupon[3];
                        var codigo = cupon[4];
                        var id = cupon[5];

                        $("#selector_cupones").append("<div class='cupon' id='" + id + "'> \n\
                                            <div class='datos_cupon'> \n\
                                                <p class='nombre_cupon'>" + nombre + "</p> \n\
                                                <p class='descripcion_cupon'>" + descripcion + "</p> \n\
                                                <p class='inicio_cupon'>" + fechaPublicado + "</p> \n\
                                                <p class='fin_cupon'>" + fechaVencimiento + "</p> \n\
                                                <p hidden='true' id='cupon_id_" + id + "'> " + codigo + " </p> \n\
                                            </div> \n\
                                            <button id='btn_" + id + "' class='btn_cupon tooltip'> \n\
                                                Código \n\
                                                <span class='tooltiptext'>Copiar</span> \n\
                                            </button> \n\
                                        </div>\n\ ");
                    }

                    $(".btn_cupon").click(function (event) {
                        var id = event.target.id.split("_")[1];
                        copiarAlPortapapeles("cupon_id_" + id);
                    });
                }
            });

        }
);




//COPIA EL CODIGO DEL PRODUCTO EN EL PORTAPAPELES
function copiarAlPortapapeles(id_elemento) {
    var aux = document.createElement("input");
    aux.setAttribute("value", document.getElementById(id_elemento).textContent);
    document.body.appendChild(aux);
    aux.select();
    document.execCommand("copy");
    document.body.removeChild(aux);
}