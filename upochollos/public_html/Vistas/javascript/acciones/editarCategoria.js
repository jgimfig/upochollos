
/*CUANDO SE PULSA EDITAR EN UNA CATEGHORIA , SE COPIAN LOS VALORES DEL MISMO EN EL FORMULARIO*/
function editarCategoria(event) {

    let id = event.target.id;
    

    $("#nombreCategoria").val(id);
    $("#colorBorde").val($("#" + id + "_cb").text().replace('#', '').trim());
    $("#colorFondo").val($("#" + id + "_cf").text().replace('#', '').trim());
  
   

}