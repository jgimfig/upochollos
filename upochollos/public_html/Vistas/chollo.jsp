<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags" %>

<!DOCTYPE html>

<html>
    <head>
        <title><s:property value="p.nombre"></s:property></title>

        <%--IMPORTACION DE METADATOS Y LIBRERÍAS--%>
        <s:include value="/Vistas/Componentes/head.jsp"></s:include>
        <link href="${pageContext.request.contextPath}/Vistas/styles/estilo_chollo.css" rel="stylesheet" type="text/css"/>
        <link href="${pageContext.request.contextPath}/Vistas/javascript/plugins/rateYo/jquery.rateyo.css" rel="stylesheet" type="text/css"/>
        <script src="${pageContext.request.contextPath}/Vistas/javascript/plugins/rateYo/jquery.rateyo.js" type="text/javascript"></script>
        <script src="${pageContext.request.contextPath}/Vistas/javascript/interaccones/estrellas.js" type="text/javascript"></script>
        <script src="${pageContext.request.contextPath}/Vistas/javascript/ajax/cargarCategorias.js" type="text/javascript"></script>
        <script src="${pageContext.request.contextPath}/Vistas/javascript/acciones/editarComentario.js" type="text/javascript"></script>
        <script src="${pageContext.request.contextPath}/Vistas/javascript/ajax/cargarTiendas.js" type="text/javascript"></script>

    </head>

    <body>

        <%--HEADER--%>
        <s:include value="/Vistas/Componentes/header.jsp"></s:include>


            <main>
            <%--BOTONES DE NAVEGACIÓN CHOLLOS/CUPONES--%>
            <div id="botones_de_accion">
                <button id="chollos_btn" class="btn_selected">Chollos</button>
                <button id="cupones_btn" onclick="irA('formCupones')">Cupones</button>
            </div>


            <%--DATOS DEL CHOLLO--%>
            <div id="contenido_principal">
                <div id="chollo">
                    <div id="datosChollo">

                        <%--NOMBRE DEL CHOLLO--%>
                        <h1 id="nombreChollo"> <s:property value="p.nombre"></s:property> </h1>
                            <div id="interaccionesChollo">
                            <%--IMAGEN DEL CHOLLO--%>
                            <figure><img id="imgChollo" src="${pageContext.request.contextPath}/Vistas/imagenes/productos/${p.imagen}" alt="Imagen de ${p.nombre}"/></figure>

                            <div id="usuarioYBoton">
                                <%--DATOS DEL AUTOR DE LA PUBLICACIÓN--%>
                                <div id="datosAutor">
                                    <figure><img class="imgUsuario" src="${pageContext.request.contextPath}/Vistas/imagenes/usuarios/${p.usuario.foto}" alt="Foto de perfil de ${p.usuario.usuario}"/></figure>
                                    <h3><s:property value="p.usuario.usuario"></s:property></h3>
                                    </div>

                                <%--BOTÓN CON ENLACE AL CHOLLO--%>
                                <s:a href="%{p.enlace}" cssClass="boton" id="conseguirChollo" target="_blank">Conseguir chollo</s:a>
                                </div>

                            <%--SI EL USUARIO NO ESTÁ LOGEADO, NO PUEDE VOTAR--%>
                            <s:if test="#session.USUARIO.usuario != null">
                                <div id="puntuacion">
                                    <h3>Puntos</h3>
                                    <div id="estrellas">
                                        <p id="puntuacionMedia" hidden> <s:property value="puntuacion"></s:property> </p>
                                        <p id="idProducto_puntuacion" hidden> <s:property value="p.id"></s:property> </p>

                                            <div id="rateYo">

                                            </div> 
                                        </div>
                                    </div>
                            </s:if>
                        </div>

                        <%--DATOS DEL CHOLLO--%>
                        <div id="datos">
                            <p><s:date name="p.fechaPublicado" format="dd/MM/yyyy"></s:date> - <s:date name="p.fechaVencimiento" format="dd/MM/yyyy"></s:date></p>
                            <p><s:property value="p.descripcion"></s:property></p>


                            <%--SI EL USUARIO LOGEADO ES EL MISMO QUE EL AUTOR DEL CHOLLO, PUEDE EDITARLO--%>
                            <s:if test="#session.USUARIO.usuario == p.usuario.usuario">
                                <div class="botonesAccionChollo">
                                    <s:form action="eliminarChollo">
                                        <s:hidden name="idProducto" value="%{p.id}"></s:hidden>
                                        <s:submit cssClass="boton" value="Eliminar"></s:submit>
                                    </s:form>

                                    <s:form action="editarChollo">
                                        <s:hidden name="idProducto" value="%{p.id}"></s:hidden>
                                        <s:submit cssClass="boton" value="Editar"></s:submit>
                                    </s:form>
                                </div>
                            </s:if>

                        </div>
                    </div>

                    <%--ZONA DE COMENTARIOS--%>
                    <div id="comentariosChollos">

                        <%--SI EL USUARIO ESTÁ LOGEADO PUEDE ESCRIBIR COMENTARIOS--%>
                        <h2>Comentarios</h2>
                        <s:if test="#session.USUARIO.usuario != null">
                            <s:form action="publicarComentario">
                                <s:textarea id="escribirComentario" name="escribirComentario" placeholder="Escribir comentario..."></s:textarea>
                                <s:hidden name="idProducto" value="%{p.id}"></s:hidden>
                                <s:submit cssClass="boton" id="enviarComentario" name="enviarComentario" value="Enviar comentario"></s:submit>
                            </s:form>
                        </s:if>

                        <%--TODOS LOS COMENTARIOS PUBLICADOS HASTA LA FEHCA PARA ESTE CHOLLO--%>
                        <s:iterator value="comentarios" status="comentario">
                            <div class="comentario" id="comentario_${id}">
                                <div class="datosComentario">
                                    <figure><img class="imgUsuario" src="${pageContext.request.contextPath}/Vistas/imagenes/usuarios/${usuario.foto}" alt=""/></figure>
                                    <h3><s:property value="%{usuario.usuario}"></s:property></h3>
                                    </div>
                                    <div class="textoYBotonComentario">

                                        <p id="${id}_editar_texto" class="texto_comentario"><s:property value="%{texto}"></s:property></p>

                                    <s:if test="#session.USUARIO.usuario == usuario.usuario">

                                        <%--CAMPO DE TEXTO PARA EDITAR LOS COMENTARIO PULICADOS POR EL USUARIO--%>
                                        <div id="${id}_editar" class="editar" hidden="true">
                                            <s:form action="editarComentario">
                                                <s:textarea id="escribirComentarioEditado_%{id}" cssClass="escribirComentarioEditado" name="escribirComentarioEditado" placeholder="Escribir comentario..."></s:textarea>
                                                <s:hidden name="idProducto" value="%{p.id}"></s:hidden>
                                                <s:hidden name="idComentario" value="%{id}"></s:hidden>
                                                <s:submit cssClass="boton" id="enviarComentario" name="editarComentario" value="Editar comentario"></s:submit>
                                            </s:form>
                                        </div>
                                        <%-- BOTONES DE ACCIÓN EN CASO DE SER EL AUTOR DEL COMENTARIO --%>
                                        <div class="botonera">
                                            <s:form action="eliminarComentario">
                                                <s:hidden name="idComentario" value="%{id}"></s:hidden>
                                                <s:hidden name="idProducto" value="%{p.id}"></s:hidden>
                                                <s:submit name="eliminarComentario" value="Eliminar" cssClass="boton"></s:submit>
                                            </s:form>

                                            <button class="botonComentario" id="${id}_idComentarioEditar" onclick="editarComentarioC(event)">Editar</button>

                                        </div>
                                    </s:if>

                                </div>
                            </div>
                            <br/>
                        </s:iterator>
                    </div>
                </div>

                <%-- CATEGORIAS Y TIENDAS--%>
                <%-- SE CARGAN MEDIANTE AJAX--%>
                <div id="selector_categorias">

                    <h3>Categorías</h3>
                    <div id="categorias">

                    </div>

                    <h3>Tiendas</h3>
                    <div id="tiendas">

                    </div>
                </div>
                <%---FIN CATEGORÍAS Y TIENDAS---%>

            </div>
        </main>

        <%--FOOTER--%>
        <s:include value="/Vistas/Componentes/footer.jsp"></s:include>
    </body>
</html>

