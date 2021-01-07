
/*CUANDO SE PULSA EDITAR EN UN PATROCINADOR, SE MUESTRA EL FORMULARIO OCULTO CON EL TEXTO DEL COMENTARIO ORIGINAL*/
function editarComentarioC(event) {
    
    let id = event.target.id.split("_")[0];
    
    $(".texto_comentario").show();
    

    $(".editar").hide();
    $("#"+id+"_editar_texto").hide();
    $("#"+id+"_editar").show();
    
    $("#escribirComentarioEditado_"+id).val($("#"+id+"_editar_texto").text());
    
}
