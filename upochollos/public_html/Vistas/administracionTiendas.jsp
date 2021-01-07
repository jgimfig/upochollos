<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags" %>
<!DOCTYPE html>
<html>

    <head>

        <title>Administrar tiendas</title>
        <%--IMPORTACION DE METADATOS Y LIBRERÍAS--%>
        <s:include value="/Vistas/Componentes/head.jsp"></s:include>
        <link href="${pageContext.request.contextPath}/Vistas/styles/estilo_perfil.css" rel="stylesheet" type="text/css"/>
        <script src="${pageContext.request.contextPath}/Vistas/javascript/acciones/editarTienda.js" type="text/javascript"></script>
        <link href="${pageContext.request.contextPath}/Vistas/styles/estilo_administracion.css" rel="stylesheet" type="text/css"/>

    </head>

    <body>
        <%--HEADER--%>
        <s:include value="/Vistas/Componentes/header.jsp">
        </s:include>
        
        <%--FORMULARIO DE CREACIÓN / EDICION DE TIENDAS--%>
        <main>
            <s:form action="crearTiendas" enctype="multipart/form-data">
                <h2>Gestión tiendas</h2>
                <s:fielderror fieldName="nombreTienda" cssClass="errorForm"/>
                <p>Nombre tienda: </p> <s:textfield id="nombreTienda" name="nombreTienda"></s:textfield> <br/>
                <s:fielderror fieldName="logo" cssClass="errorForm"/>    
                <p>Logo: </p>
                <figure> <img id="logoTienda" src=""/> </figure>
                    <s:file name="logo" accept="application/png"></s:file>
                    <s:submit name="enviar" cssClass="boton" id="crear" value="Crear/Editar"></s:submit><br/>
            </s:form>

            <%--TABLA CON LOS DATOS ACTUALES DE TIENDAS--%>
            <table>
                <tr>
                    <th>Logo</th>
                    <th>Nombre</th>
                    <th></th>
                    <th></th>
                </tr>
                <s:iterator value="#session.TIENDAS" status="tienda">
                    <tr>
                        <td class="logoTienda" id="${nombre}_logo"> <img src="${pageContext.request.contextPath}/Vistas/imagenes/tiendas/${logo}" /></td>
                        <td class="nombreTienda" id="${nombre}_nombre">  <s:property value="%{nombre}"></s:property> </td>
                        <td> <button class="boton" id="${nombre}" onclick="editarTienda(event)">Editar</button> </td>
                        <td> <s:form action="eliminarTiendas"> <s:submit name="eliminar" cssClass="boton" value="Eliminar"></s:submit> <s:hidden name="nombreEliminarTienda" value="%{nombre}"></s:hidden> </s:form>  </td>
                            </tr>

                </s:iterator>
            </table>

        </main>
        <%--FOOTER--%>
        <s:include value="/Vistas/Componentes/footer.jsp">
        </s:include>
    </body>

</html>

