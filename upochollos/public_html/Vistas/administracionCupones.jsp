<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags" %>
<!DOCTYPE html>
<html>

    <head>

        <title>Administrar cupones</title>
        <%--IMPORTACION DE METADATOS Y LIBRERÍAS--%>
        <s:include value="/Vistas/Componentes/head.jsp"></s:include>
        <link href="${pageContext.request.contextPath}/Vistas/styles/estilo_perfil.css" rel="stylesheet" type="text/css"/>
        <script src="${pageContext.request.contextPath}/Vistas/javascript/acciones/editarCupon.js" type="text/javascript"></script>
        <link href="${pageContext.request.contextPath}/Vistas/styles/estilo_administracion.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>

        <%--HEADER--%>
        <s:include value="/Vistas/Componentes/header.jsp">
        </s:include>

        <%--FORMULARIO DE CREACIÓN / EDICION DE CUPONES--%>
        <main class="tablaGrande">
            <s:form action="crearCupones">
                <h2>Gestión cupones</h2>
                <p>Nombre cupón: </p> <s:fielderror fieldName="nombreCupon" cssClass="errorForm"/> <s:textfield id="nombreCupon" name="nombreCupon"></s:textfield> <br/>
                <p>Código cupón: </p> <s:fielderror fieldName="codigoCupon" cssClass="errorForm"/> <s:textfield id="codigoCupon" name="codigoCupon"></s:textfield> <br/>
                <p>Fecha publicación:</p> <s:fielderror fieldName="fechaPubCupon" cssClass="errorForm"/> <s:textfield id="fechaPubCupon" name="fechaPubCupon"  placeholder="dd/MM/yyyy"></s:textfield> <br/><br/>
                <p>Fecha vencimiento: </p><s:fielderror fieldName="fechaVencCupon" cssClass="errorForm"/><s:textfield id="fechaVencCupon" name="fechaVencCupon" placeholder="dd/MM/yyyy"></s:textfield> <br/><br/>
                <p>Descripción: </p>  <s:fielderror fieldName="descCupon" cssClass="errorForm"/> <s:textfield id="descCupon" name="descCupon"></s:textfield> <br/><br/>
                <s:hidden id="cupon_id" name="cupon_id"></s:hidden>
                <s:submit name="enviar" cssClass="boton" id="crear" value="Crear/Editar"></s:submit><br/>
            </s:form>

            <%--TABLA CON LOS DATOS ACTUALES DE CUPONES--%>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Fecha publicación</th>
                    <th>Fecha de vencimiento</th>
                    <th>Descripcion</th>
                    <th></th>
                    <th></th>
                </tr>
                <s:iterator value="#session.CUPONES" status="cupon">

                    <tr>
                        <td class="idCupon" id="${id}_cupon">  <s:property value="%{id}"></s:property> </td>
                        <td class="nombreCupon" id="${id}_nombre">  <s:property value="%{nombre}"></s:property> </td>
                        <td class="codigoCupon" id="${id}_cc">  <s:property value="%{codigo}"></s:property> </td>
                        <td class="fechaPublicCupon" id="${id}_fp">  <s:date name="%{fechaPublicado}" format="dd/MM/yyyy"></s:date> </td>
                        <td class="fechaFinCupon" id="${id}_ff">  <s:date name="%{fechaVencimiento}" format="dd/MM/yyyy"></s:date> </td>
                        <td class="descripcionCupon" id="${id}_desc">  <s:property value="%{descripcion}"></s:property> </td>


                            <td> <button class="boton" id="${id}" onclick="editarCupon(event)">Editar</button> </td>
                        <td> <s:form action="eliminarCupones"> <s:submit name="eliminar" cssClass="boton" value="Eliminar"></s:submit> <s:hidden name="idEliminarCupon" value="%{id}"></s:hidden> </s:form>  </td>
                            </tr>

                </s:iterator>
            </table>
        </main>
        <%--FOOTER--%>
        <s:include value="/Vistas/Componentes/footer.jsp">
        </s:include>
    </body>

</html>

