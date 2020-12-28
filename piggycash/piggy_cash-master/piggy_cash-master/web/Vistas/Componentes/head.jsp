<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags" %>


<%-- FAVICON --%>
<link rel="icon" type="image/png" href="${pageContext.request.contextPath}/Vistas/imagenes/favicon.png">

<%-- CSS ESTANDAR --%>
<link href="${pageContext.request.contextPath}/Vistas/styles/estilo_estandar.css" rel="stylesheet" type="text/css"/>

<%-- JQUERY IMPORT --%>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>   

<%-- CARGA DE NAVEGACION --%>
<s:include value="/Vistas/Componentes/navegacion.jsp">
</s:include>
<script src="${pageContext.request.contextPath}/Vistas/javascript/acciones/irA.js" type="text/javascript"></script>

<%-- PARA COPIAR LOS CUPONES AL PORTAPAPELES --%>
<script src="${pageContext.request.contextPath}/Vistas/javascript/interaccones/botones_de_accion.js" type="text/javascript"></script>

<%-- JQueryRotate: PLUGIN PARA ROTAR ELEMENTOS GRÁFICOS --%>
<script src="${pageContext.request.contextPath}/Vistas/javascript/plugins/JQueryRotate/jQueryRotate.js" type="text/javascript"></script>

<%-- CONTEXTO DE LA APP PARA JS --%>
<div hidden="true">
    <input type="hidden" id="contexto" value="${pageContext.request.contextPath}"/>
</div>



