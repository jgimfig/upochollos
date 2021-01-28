function editar(boton){
    var tienda=boton.parentNode.parentNode;
    var img=tienda.childNodes[0].firstChild.src;
    var nombre=tienda.childNodes[1].firstChild.nodeValue;
    var url=img.split('/');
    var nombreImg=url[url.length-1];
    document.getElementById("ntienda").value=nombre;
    var newImg=document.createElement("img");
    var br=document.createElement("br");
    newImg.setAttribute("src","../img/tiendas/"+nombreImg);
    newImg.setAttribute("id","imgEdit");
    var form=document.getElementsByName("ftienda")[0];
    if(document.getElementById("imgEdit")!=null){
        var antigua=document.getElementById("imgEdit");
        var enviar=document.getElementById("crear");
        form.replaceChild(newImg,antigua);
        document.getElementById("ntienda").disabled=true;
    }else{ 
        var enviar=document.getElementById("crear");
        form.insertBefore(newImg,enviar);
        form.insertBefore(br,enviar);
        document.getElementById("ntienda").disabled=true;
    }
   
    
    
}

function error(msg){
    alert(msg);
}

function habilita(){
    if(document.getElementById("imgEdit")!=null){
        var form=document.getElementsByName("ftienda")[0];
        var eliminar=document.getElementById("imgEdit");
        form.removeChild(eliminar);
    }
    var antigua=document.getElementById("imgEdit");
    var t=document.getElementById("ntienda");
    t.disabled=false;
}