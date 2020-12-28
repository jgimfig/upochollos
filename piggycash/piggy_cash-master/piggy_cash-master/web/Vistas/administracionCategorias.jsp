<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags" %>
<!DOCTYPE html>
<html>

    <head>

        <title>Administrar categorías</title>
        <%--IMPORTACION DE METADATOS Y LIBRERÍAS--%>
        <s:include value="/Vistas/Componentes/head.jsp"></s:include>
        <link href="${pageContext.request.contextPath}/Vistas/styles/estilo_perfil.css" rel="stylesheet" type="text/css"/>
        <script src="${pageContext.request.contextPath}/Vistas/javascript/acciones/editarCategoria.js" type="text/javascript"></script>
        <link href="${pageContext.request.contextPath}/Vistas/styles/estilo_administracion.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>

        <%--HEADER--%>
        <s:include value="/Vistas/Componentes/header.jsp">
        </s:include>
        <main>
            <%--FORMULARIO DE CREACIÓN / EDICION DE CATEGORÍAS--%>
            <s:form action="crearCategorias">
                <h2>Gestión categorías</h2>
                <p>Nombre categoría:</p> <s:fielderror fieldName="nombreCategoria" cssClass="errorForm"/> <s:textfield id="nombreCategoria" name="nombreCategoria"></s:textfield> <br/>
                <p>Color del borde:</p> <s:fielderror fieldName="colorBorde" cssClass="errorForm"/> #<s:textfield id="colorBorde" name="colorBorde"></s:textfield> <br/>
                <p>Color de fondo:</p> <s:fielderror fieldName="colorFondo" cssClass="errorForm"/> #<s:textfield id="colorFondo" name="colorFondo"></s:textfield> <br/><br/>
                <s:submit name="enviar" cssClass="boton" id="crear" value="Crear/Editar"></s:submit><br/>
            </s:form>

            <%--TABLA CON LOS DATOS ACTUALES DE LAS CATEGORIAS--%>
            <table>
                <tr>
                    <th>Nombre</th>
                    <th>Color del borde</th>
                    <th>Color de fondo</th>
                    <th></th>
                    <th></th>
                </tr>
                <s:iterator value="#session.CATEGORIAS" status="categoria">

                    <tr>
                        <td class="nombreCategoria" id="${nombre}_nombre">  <s:property value="%{nombre}"></s:property> </td>
                        <td class="colorBordeCategoria" id="${nombre}_cb">  #<s:property value="%{colorBorde}"></s:property> </td>
                        <td class="colorFondoCategoria" id="${nombre}_cf">  #<s:property value="%{colorFondo}"></s:property> </td>
                        <td> <button class="boton" id="${nombre}" onclick="editarCategoria(event)">Editar</button> </td>
                        <td> <s:form action="eliminarCategorias"> <s:submit name="eliminar" cssClass="boton" value="Eliminar"></s:submit> <s:hidden name="nombreEliminarCategoria" value="%{nombre}"></s:hidden> </s:form>  </td>
                            </tr>

                </s:iterator>
            </table>

        </main>
        <%--FOOTER--%>
        <s:include value="/Vistas/Componentes/footer.jsp">
        </s:include>
    </body>

</html>

