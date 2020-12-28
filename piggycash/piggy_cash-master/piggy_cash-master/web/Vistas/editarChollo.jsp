<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags" %>
<!DOCTYPE html>
<html>

    <head>
        <title>Editar <s:property value="p.nombre"></s:property> </title>
        <%--IMPORTACION DE METADATOS Y LIBRERÍAS--%>
        <s:include value="/Vistas/Componentes/head.jsp"></s:include>
        <link href="${pageContext.request.contextPath}/Vistas/styles/estilo_perfil.css" rel="stylesheet" type="text/css"/>

    </head>

    <body>

        <%--HEADER--%>
        <s:include value="/Vistas/Componentes/header.jsp"></s:include>
            <main>

                <h1>Editar chollo</h1>
                <div id="subirProducto">
                <%-- FORMULARIO CON LOS DATOS DE UN CHOLLO PRE RELLENOS, LISTOS PARA SER EDITADOS --%>
                <s:form action="actualizarChollo" method="post" enctype="multipart/form-data">

                    <%-- EDITAR NOMBRE DEL CHOLO --%>
                    <div class="chollo_nuevo">
                        <p>Nombre del chollo: </p>
                        <s:textfield name="nombreChollo" value="%{p.nombre}">
                        </s:textfield>
                    </div>

                    <%-- ENLACE AL CHOLLO  --%>
                    <div class="chollo_nuevo">
                        <p>Enlace al chollo: </p>
                        <s:textfield  name="enlaceChollo" value="%{p.enlace}">
                        </s:textfield>
                    </div>

                    <%-- PRECIO CON DESCUENTO --%>
                    <div class="chollo_nuevo">
                        <p>Precio actual: </p>
                        <s:textfield  name="precioActual" value="%{p.precioDescuento}">
                        </s:textfield> €
                    </div>

                    <%-- PRECIO ANTERIOR AL DESCUENTO --%>
                    <div class="chollo_nuevo">
                        <p>Precio anterior: </p>
                        <s:textfield  name="precioAnterior" value="%{p.precioOriginal}">
                        </s:textfield> €
                    </div>

                    <%-- DESCRIPCIÓN / CONDICIONES DEL CHOLLO --%>
                    <div class="chollo_nuevo">
                        <p>Descripción: </p>
                        <s:textfield name="descripcion" value="%{p.descripcion}">
                        </s:textfield>
                    </div>

                    <%-- FOTO DESCRIPTIVA DEL PRODUCTO OFERTADO --%>
                    <div class="chollo_nuevo">
                        <p>Subir imagen del chollo: </p>
                        <figure><img src="${pageContext.request.contextPath}/Vistas/imagenes/productos/${p.imagen}"/></figure>
                            <s:file name="imagenProducto" accept="application/png"></s:file>
                        </div>

                        <%-- CATEGORÍA DEL PRODUCTO, NO ES EDITABLE  --%>
                        <div class="chollo_nuevo">
                            <p>Categoría del chollo: </p>
                        <s:textfield  name="nombreCategoria" value="%{p.categoria.nombre}" disabled="true">
                        </s:textfield>
                    </div>

                    <%-- TIENDA EN LA QUE SE OFERTA EL PRODUCTO, NO ES EDITABLE --%>
                    <div class="chollo_nuevo">
                        <p>Tienda: </p>
                        <s:textfield  name="nombreTienda" value="%{p.tienda.nombre}" disabled="true">
                        </s:textfield>
                    </div> 

                    <%-- FECHA DE VENCIMIENTO DE LA OFERTA --%>
                    <div class="chollo_nuevo">
                        <p>Fecha de vencimiento </p>
                        <s:textfield name="fechaVencimiento" value="%{fechaVencimiento}">
                        </s:textfield>
                    </div> 

                    <%-- ID DEL CHOLLO --%>
                    <div class="chollo_nuevo" id="botonSubirChollo">
                        <s:hidden name="idProducto" value="%{p.id}"></s:hidden>
                        <s:submit value="Editar chollo" cssClass="boton"></s:submit>
                        </div>

                </s:form>
            </div>



        </main>
        <%--FOOTER--%>
        <s:include value="/Vistas/Componentes/footer.jsp"></s:include>
    </body>

</html>
