/*CUANDO SE PULSA EDITAR EN UNA TIENDA, SE COPIAN LOS VALORES DEL MISMO EN EL FORMULARIO*/
function editarTienda(event)
{
    let id = event.target.id;
    let urlLogo = $("#" + id + "_logo").find("img").attr("src");

    $("#nombreTienda").val(id);
    $("#logoTienda").attr("src", urlLogo);

}