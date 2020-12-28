
/*CUANDO SE PULSA EDITAR EN UN PATROCINADOR, SE COPIAN LOS VALORES DEL MISMO EN EL FORMULARIO*/
function editarPatrocinador(event)
{
    let id = event.target.id;
    
    let cif = id;
    let nombrePatrocinador = $("#"+cif+"_nombre").text();
    
    
    $("#cifPatrocinador").val(cif.trim());
    $("#nombrePatrocinador").val(nombrePatrocinador.trim());
}

/*CUANDO SE PULSA EDITAR EN UN ANUNCIO, SE COPIAN LOS VALORES DEL MISMO EN EL FORMULARIO*/
function editarAnuncio(event)
{
    let id = event.target.id;
    
    let cifPatrocinador = $("#"+id+"_cifPatrocinador").text().trim();
    let titulo = $("#"+id+"_titulo").text().trim();
    let fechaInicio = $("#"+id+"_fechaInicio").text().trim();
    let fechaFin = $("#"+id+"_fechaFinAnuncio").text().trim();
    let desc = $("#"+id+"_descripcion").text().trim();
    let cuantia = $("#"+id+"_cuantia").text().replace("€", "").trim();
    let contMultim = $("#"+id+"_contenidoMult").find("img").attr("src");

    $("#idAnuncio").val(id);
    $("#cifPatrocinadorAnuncio").val(cifPatrocinador);
    $("#tituloAnuncio").val(titulo);
    $("#fechaInicioAnuncio").val(fechaInicio);
    $("#fechaFinAnuncio").val(fechaFin);
    $("#descripcionAnuncio").val(desc);
    $("#cuantiaAnuncio").val(cuantia);
    $("#contMulAn").attr("src", contMultim);
    
    
    
}

