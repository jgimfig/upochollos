<%@page import="persistencia.UsuarioDAO"%>
<%@page import="pojos.Usuario"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags" %>

<!DOCTYPE html>

<html>
    <head>
        <title> <s:property value="%{categoria}"></s:property> Piggy Cash</title>

        <%--IMPORTACION DE METADATOS Y LIBRERÍAS--%>
        <s:include value="/Vistas/Componentes/head.jsp">
        </s:include>

        <script src="${pageContext.request.contextPath}/Vistas/javascript/ajax/cargarCategorias.js" type="text/javascript"></script>
        <script src="${pageContext.request.contextPath}/Vistas/javascript/ajax/cargarChollos.js" type="text/javascript"></script>
    </head>

    <body>


        <%--HEADER--%>
        <s:include value="/Vistas/Componentes/header.jsp">
        </s:include>

        <main>

            <div id="botones_de_accion">
                <button id="chollos_btn" class="btn_selected">Chollos</button>
                <button id="cupones_btn" onclick="irA('formCupones')">Cupones</button>
            </div>

            <div id="contenido_principal">

                <%-- CHOLLOS --%>
                <%-- SE CARGAN LOS CHOLLOS MEDIANTE AJAX/JS --%>
                <div id="selector_productos">
                   
                </div>

                <%-- CATEGORIAS --%>
                <%-- SE CARGAN LAS CATEGORÍAS MEDIANTE AJAX/JS --%>
                <div id="selector_categorias">

                    <h3>Categorias</h3>
                    <div id="categorias">

                    </div>
                </div>
                
                <s:hidden id="categoriaSeleccionada" value="%{categoria}">
                </s:hidden>
                
                <%---FIN CATEGORÍAS---%>

            </div>
        </main>

        <%--FOOTER--%>
        <s:include value="/Vistas/Componentes/footer.jsp">
        </s:include>

    </body>
</html>

