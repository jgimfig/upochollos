function editarPatrocinador(boton){
    var tPatrocinadores=boton.parentNode.parentNode;
    var patrocinadores=tPatrocinadores.childNodes;
    var campoCif=document.getElementById("cif");
    var campoNombre=document.getElementById("npatrocinador");
    var cif=patrocinadores[0].firstChild.nodeValue;
    var nombre=patrocinadores[1].firstChild.nodeValue; 
    campoCif.value=cif;
    campoNombre.value=nombre;
    campoCif.disabled=true;
    
}

function habilita(nodo){
    var input=document.getElementById("cif");
    input.disabled=false;
}

function editarAnuncio(boton){
    var tAnuncios=boton.parentNode.parentNode;
    var anuncios=tAnuncios.childNodes;
    var campoCif=document.getElementById("cifPatrocinador");
    var campoTitulo=document.getElementById("titulo");
    var campofInicio=document.getElementById("fechaInicio");
    var campofFin=document.getElementById("fechaFin");
    var campoDescripcion=document.getElementById("descripcion");
    var campoCuantia=document.getElementById("cuantia");
    var editar=document.getElementById("editar");
    var cancelar=document.getElementById("cancelar");
    cancelar.style.visibility = "visible";
    editar.value=anuncios[0].firstChild.nodeValue;
    var cif=anuncios[1].firstChild.nodeValue;
    var Titulo=anuncios[2].firstChild.nodeValue;
    var fInicio=anuncios[3].firstChild.nodeValue;
    var fFin=anuncios[4].firstChild.nodeValue; 
    var Descripcion=anuncios[5].firstChild.nodeValue;
    var Cuantia=anuncios[6].firstChild.nodeValue; 
    campoCif.value=cif;
    campoTitulo.value=Titulo;
    campofInicio.value=fInicio;
    campofFin.value=fFin;
    campoDescripcion.value=Descripcion;
    campoCuantia.value=Cuantia;
}

function cancelar(nodo){
    nodo.style.visibility = "hidden";
    var campoCif=document.getElementById("cifPatrocinador");
    var campoTitulo=document.getElementById("titulo");
    var campofInicio=document.getElementById("fechaInicio");
    var campofFin=document.getElementById("fechaFin");
    var campoDescripcion=document.getElementById("descripcion");
    var campoCuantia=document.getElementById("cuantia");
    var editar=document.getElementById("editar");    
    campoCif.value="";
    campoTitulo.value="";
    campofInicio.value="";
    campofFin.value="";
    campoDescripcion.value="";
    campoCuantia.value=""
    editar.value="";
}