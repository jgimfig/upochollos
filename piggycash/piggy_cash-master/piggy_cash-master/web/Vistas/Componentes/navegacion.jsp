<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags" %>


<%-- FORMULARIOS DE ACCESO RÁPIDO, NO SON VISIBLES PARA EL USUARIO, LOS CONTROLA JS --%>

<div hidden="true">

    <s:form action="irA" id="formChollos">
        <s:textfield name="accionAEjecutar" value="chollos"></s:textfield>
    </s:form>   

    <s:form action="irA" id="formCupones">
        <s:textfield name="accionAEjecutar" value="cupones"></s:textfield>
    </s:form>   
    
    <s:form action="irA" id="formFotoPerfil">
        <s:textfield name="accionAEjecutar" value="fotoPerfil"></s:textfield>
    </s:form>
    
    <s:form action="irA" id="formCerrarSesion">
        <s:textfield name="accionAEjecutar" value="cerrarSesion"></s:textfield>
    </s:form>

</div>