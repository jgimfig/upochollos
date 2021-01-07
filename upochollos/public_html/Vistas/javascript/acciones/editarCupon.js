/*CUANDO SE PULSA EDITAR EN UN CUPÓN, SE COPIAN LOS VALORES DEL MISMO EN EL FORMULARIO*/

function editarCupon(event)
{
    let id = event.target.id;
    
    let idCupon = $("#"+id+"_cupon").text().trim();
    let nombreCupon = $("#"+id+"_nombre").text().trim();
    let codigoCupon = $("#"+id+"_cc").text().trim();
    let fp = $("#"+id+"_fp").text().trim();
    let ff = $("#"+id+"_ff").text().trim();
    let desc = $("#"+id + "_desc").text().trim();
        
    $("#nombreCupon").val(nombreCupon);
    $("#codigoCupon").val(codigoCupon);
    $("#fechaPubCupon").val(fp);
    $("#fechaVencCupon").val(ff);
    $("#descCupon").val(desc);
    $("#cupon_id").val(id);
    
}

