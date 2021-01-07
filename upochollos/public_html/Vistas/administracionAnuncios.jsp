<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags" %>
<!DOCTYPE html>
<html>

    <head>

        <title>Administrar categorías</title>
        <%--IMPORTACION DE METADATOS Y LIBRERÍAS--%>
        <s:include value="/Vistas/Componentes/head.jsp"></s:include>
        <link href="${pageContext.request.contextPath}/Vistas/styles/estilo_perfil.css" rel="stylesheet" type="text/css"/>
        <script src="${pageContext.request.contextPath}/Vistas/javascript/acciones/editarAnuncio.js" type="text/javascript"></script>
        <link href="${pageContext.request.contextPath}/Vistas/styles/estilo_administracion.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>

        <%--HEADER--%>
        <s:include value="/Vistas/Componentes/header.jsp">
        </s:include>

        <%--FORMULARIO DE CREACIÓN / EDICION DE PATROCINADORES--%>
        <main>
            <s:form action="crearPatrocinadores">
                <h2>Gestión patrocinadores</h2>
                <p>CIF: </p> <s:fielderror fieldName="cifPatrocinador" cssClass="errorForm"/> <s:textfield id="cifPatrocinador" name="cifPatrocinador"></s:textfield> <br/>
                <p>Nombre: </p> <s:fielderror fieldName="nombrePatrocinador" cssClass="errorForm"/> <s:textfield id="nombrePatrocinador" name="nombrePatrocinador"></s:textfield> <br/> <br/>
                <s:submit name="enviar" cssClass="boton" id="crear" value="Crear/Editar"></s:submit><br/>
            </s:form>

            <%--TABLA CON LOS DATOS ACTUALES DE PATROCINADORES--%>
            <table>
                <tr>
                    <th>CIF</th>
                    <th>Nombre</th>
                    <th></th>
                    <th></th>
                </tr>
                <s:iterator value="#session.PATROCINADORES" status="patrocinador">
                    <tr>
                        <td class="cifPatrocinador" id="${cif}_cif">  <s:property value="%{cif}"></s:property> </td>
                        <td class="nombrePatrocinador" id="${cif}_nombre">  <s:property value="%{nombre}"></s:property> </td>
                        <td> <button class="boton" id="${cif}" onclick="editarPatrocinador(event)">Editar</button> </td>
                        <td> <s:form action="eliminarPatrocinadores"> <s:submit name="eliminar" cssClass="boton" value="Eliminar"></s:submit> <s:hidden name="cifEliminarPatrocinador" value="%{cif}"></s:hidden> </s:form>  </td>
                            </tr>
                </s:iterator>
            </table>                
        </main>

        <%--FORMULARIO DE CREACIÓN / EDICION DE PATROCINADORES--%>
        <main class="tablaGrande">
            <s:form action="crearAnuncios" enctype="multipart/form-data">
                <h2>Gestión anuncios</h2>
                <p>CIF patrocinador: </p> <s:fielderror fieldName="cifPatrocinadorAnuncio" cssClass="errorForm"/> <s:textfield id="cifPatrocinadorAnuncio" name="cifPatrocinadorAnuncio"></s:textfield>
                <p>Título: </p> <s:fielderror fieldName="tituloAnuncio" cssClass="errorForm"/> <s:textfield id="tituloAnuncio" name="tituloAnuncio"></s:textfield> <br/>
                <p>Fecha inicio: </p> <s:fielderror fieldName="fechaInicioAnuncio" cssClass="errorForm"/> <s:textfield id="fechaInicioAnuncio" name="fechaInicioAnuncio" placeholder="dd/MM/yyyy"></s:textfield> <br/>
                <p>Fecha fin: </p> <s:fielderror fieldName="fechaFinAnuncio" cssClass="errorForm"/> <s:textfield id="fechaFinAnuncio" name="fechaFinAnuncio" placeholder="dd/MM/yyyy"></s:textfield> <br/>
                <p>Descripción: </p> <s:fielderror fieldName="descripcionAnuncio" cssClass="errorForm"/> <s:textfield id="descripcionAnuncio" name="descripcionAnuncio"></s:textfield> <br/>
                <p>Cuantía </p> <s:fielderror fieldName="cuantiaAnuncio" cssClass="errorForm"/> <s:textfield id="cuantiaAnuncio" name="cuantiaAnuncio"></s:textfield> € <br/>
                    <p>Contenido multimedia: </p> 
                    <figure> <img id="contMulAn" src=""/> </figure>
                <s:file name="contenidoMultAnuncio" accept="application/png"></s:file> <br/>
                <s:hidden id="idAnuncio" name="idAnuncio"></s:hidden>
                <s:submit name="enviar" cssClass="boton" id="crear" value="Crear/Editar"></s:submit><br/>
            </s:form>

            <%--TABLA CON LOS DATOS ACTUALES DE LOS ANUNCIOS--%>
            <table>
                <tr>
                    <th>ID</th>
                    <th>CIF patrocinador</th>
                    <th>Título</th>
                    <th>Fecha inicio</th>
                    <th>Fecha fin</th>
                    <th>Descripción</th>
                    <th>Cuantía</th>
                    <th>Contenido multimedia</th>
                    <th></th>
                    <th></th>
                </tr>
                <s:iterator value="#session.ANUNCIOS" status="anuncio">
                    <tr>
                        <td class="idAnuncio" id="${id}_id">  <s:property value="%{id}"></s:property> </td>
                        <td class="cifPatrocinador" id="${id}_cifPatrocinador">  <s:property value="%{patrocinador.cif}"></s:property> </td>
                        <td class="tituloAnuncio" id="${id}_titulo">  <s:property value="%{titulo}"></s:property> </td>
                        <td class="fechaInicioAnuncio" id="${id}_fechaInicio">  <s:date name="%{fechaInicio}" format="dd/MM/yyyy"></s:date> </td>
                        <td class="fechaFinAnuncio" id="${id}_fechaFinAnuncio">  <s:date name="%{fechaFin}" format="dd/MM/yyyy"></s:date> </td>
                        <td class="descripcionAnuncio" id="${id}_descripcion">  <s:property value="%{descripcion}"></s:property> </td>
                        <td class="cuantiaAnuncio" id="${id}_cuantia">  <s:property value="%{cuantia}"></s:property> € </td>
                        <td class="contenidoMultAnuncio" id="${id}_contenidoMult"> <img src="${pageContext.request.contextPath}/Vistas/imagenes/anuncios/${contenidoMultimedia}" /></td>
                        <td> <button class="boton" id="${id}" onclick="editarAnuncio(event)">Editar</button> </td>
                        <td> <s:form action="eliminarAnuncios"> <s:submit name="eliminar" cssClass="boton" value="Eliminar"></s:submit> <s:hidden name="idEliminarAnuncio" value="%{id}"></s:hidden> </s:form>  </td>
                            </tr>

                </s:iterator>
            </table>                
        </main>

        <br/>
        <br/>
        <br/>



        <%--FOOTER--%>
        <s:include value="/Vistas/Componentes/footer.jsp">
        </s:include>
    </body>

</html>

