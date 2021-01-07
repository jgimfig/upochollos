<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags" %>

<!DOCTYPE html>

<html>
    <head>
        <title>Cupones</title>

        <%--IMPORTACION DE METADATOS Y LIBRERÍAS--%>
        <s:include value="/Vistas/Componentes/head.jsp">
        </s:include>
        <script src="${pageContext.request.contextPath}/Vistas/javascript/ajax/cargarCupones.js" type="text/javascript"></script>
    </head>

    <body>

        <%--HEADER--%>
        <s:include value="/Vistas/Componentes/header.jsp">
        </s:include>

        <main>

            <%-- NAVEGACIÓN --%>
            <div id="botones_de_accion">
                <button id="chollos_btn" onclick="irA('formChollos')">Chollos</button>
                <button id="cupones_btn" class="btn_selected">Cupones</button>
            </div>

            
            <%-- LOS BOTONES SE CARGAN MEDIANTE AJAX Y JS --%>
            <div id="contenido_principal">

                <div id="selector_cupones">

                   
                </div>
            </div>
       
    </main>

    <%--FOOTER--%>
    <s:include value="/Vistas/Componentes/footer.jsp"></s:include>
</body>
</html>

