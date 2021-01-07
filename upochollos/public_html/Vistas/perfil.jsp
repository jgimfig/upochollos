<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags" %>
<!DOCTYPE html>
<html>

    <head>
        <title>Perfil</title>
        <%--IMPORTACION DE METADATOS Y LIBRERÍAS--%>
        <s:include value="/Vistas/Componentes/head.jsp"></s:include>
        <link href="${pageContext.request.contextPath}/Vistas/styles/estilo_perfil.css" rel="stylesheet" type="text/css"/>
        <script src="${pageContext.request.contextPath}/Vistas/javascript/interaccones/animacionRuedaDentada.js" type="text/javascript"></script>
        <script src="${pageContext.request.contextPath}/Vistas/javascript/ajax/cargarCategoriasChollo.js" type="text/javascript"></script>
    </head>

    <body>

        <%--HEADER--%>
        <s:include value="/Vistas/Componentes/header.jsp"></s:include>
            <main>
                <div id="perfilZonaSuperior">
                    <div id="datosUsuario">
                        <!--FOTO DE PERFIL-->
                        <div id="imgPerfil">

                        <s:if test="#session.USUARIO.foto != null">
                            <figure id='imgPerfil'><img src='${pageContext.request.contextPath}/Vistas/imagenes/usuarios/${USUARIO.foto}' alt='imagen perfil usuario'/></figure>
                            </s:if>
                            <s:else>
                            <figure id='imgPerfil'><img src='${pageContext.request.contextPath}/Vistas/imagenes/mona_lisa_lol.jpg' alt='imagen perfil usuario'/></figure>
                            </s:else>



                    </div>

                    <!--NOMBRE DE USUARIO Y FECHA DE REGISTRO-->
                    <div id="nombre">
                        <p id='nombreUsuario'> <s:property value="#session.USUARIO.usuario"></s:property> </p>

                        </div>

                        <!--BOTÓN DE AJUSTES-->
                        <div id="ajustes">
                            <figure><a href="${pageContext.request.contextPath}/Vistas/ajustes.jsp"><img src="${pageContext.request.contextPath}/Vistas/imagenes/iconos/iconoAjustes.svg" alt="ajustes de perfil"/></a></figure>
                    </div>
                </div>

                <!--ESTADISTICAS DEL USUARIO-->
                <div id="estadisticas">
                    <h2>Estadísticas</h2>
                    <div id="conjuntoEstadisticas">
                        <div id="puntos" class="datoEstadistica">
                            <!--PUNTOS OBTENIDOS-->
                            <h3>Puntos</h3>
                            <p id='puntosUsuario'><s:property value="#session.PUNTOS"></s:property></p>
                            </div>

                            <!--NUMERO DE NOTICIAS PUBLICADAS-->
                            <div id="nChollos" class="datoEstadistica">
                                <h3>Nº Chollos</h3>
                                <p id='nChollosUsuario'><s:property value="#session.N_CHOLLOS"></s:property></p>
                            </div>

                            <!--NUMERO DE COMENTARIOS PUBLICADOS-->
                            <div id="nComentarios" class="datoEstadistica">
                                <h3>Nº Comentarios</h3>
                                <p id='nComentariosUsuario'><s:property value="#session.N_COMENTARIOS"></s:property></p>
                            </div>
                        </div>
                    </div>
                </div>

            <%-- SI EL USUARIO ES ADMINISTRADOR, SE MUESTRAN SUS OPCIONES--%>
            <s:if test="#session.USUARIO.getTipo() == 'admin'">
                <div id="panelAdministracion">

                    <%-- ADMINISTRAR CATEGORIAS--%>
                    <s:form action="irA">
                        <s:submit cssClass="boton" value="Administrar categorías"></s:submit>
                        <s:hidden name="accionAEjecutar" value="adminCategorias"></s:hidden>
                    </s:form>

                    <%-- ADMINISTRAR TIENDAS--%>
                    <s:form action="irA">
                        <s:submit cssClass="boton" value="Administrar tiendas"></s:submit>
                        <s:hidden name="accionAEjecutar" value="adminTiendas"></s:hidden>
                    </s:form>

                    <%-- ADMINISTRAR CUPONES --%>
                    <s:form action="irA">
                        <s:submit cssClass="boton" value="Administrar cupones"></s:submit>
                        <s:hidden name="accionAEjecutar" value="adminCupones"></s:hidden>
                    </s:form>

                    <%-- ADMINISTRAR ANUNCIOS --%>
                    <s:form action="irA">
                        <s:submit cssClass="boton" value="Administrar anuncios"></s:submit>
                        <s:hidden name="accionAEjecutar" value="adminAnuncios"></s:hidden>
                    </s:form>
                </div>
            </s:if>

            <br/>
            <br/>
            <br/>

            <%-- SUBIR UN CHOLLO NUEVO --%>
            <h1>Subir un chollo nuevo</h1>
            <div id="subirProducto">
                <s:form action="crearChollo" enctype="multipart/form-data">

                    <%-- NOMBRE CHOLLO --%>
                    <div class="chollo_nuevo">
                        <p>Nombre del chollo: </p>
                        <s:fielderror fieldName="nombreChollo" cssClass="errorForm"/>
                        <s:textfield name="nombreChollo">
                        </s:textfield>
                    </div>

                    <%-- ENLACE AL CHOLLO --%>
                    <div class="chollo_nuevo">
                        <p>Enlace al chollo: </p>
                        <s:fielderror fieldName="enlaceChollo" cssClass="errorForm"/>
                        <s:textfield  name="enlaceChollo">
                        </s:textfield>
                    </div>

                    <%-- PRECIO DEL CHOLLO --%>
                    <div class="chollo_nuevo">
                        <p>Precio actual: </p>
                        <s:fielderror fieldName="precioActual" cssClass="errorForm"/>
                        <s:textfield  name="precioActual">
                        </s:textfield> €
                    </div>

                    <%-- PRECIO ANTERIOR --%>
                    <div class="chollo_nuevo">
                        <p>Precio anterior: </p>
                        <s:fielderror fieldName="precioAnterior" cssClass="errorForm"/>
                        <s:textfield  name="precioAnterior">
                        </s:textfield> €
                    </div>

                    <%-- DESCRIPCIÓN/CONDICIONES DEL CHOLLO --%>
                    <div class="chollo_nuevo">
                        <p>Descripción: </p>
                        <s:fielderror fieldName="descripcion" cssClass="errorForm"/>
                        <s:textfield name="descripcion">
                        </s:textfield>
                    </div>

                    <%-- FOTO DESCRIPTIVA DEL PRODUCTO OFERTADO --%>
                    <div class="chollo_nuevo">
                        <p>Subir imagen del chollo: </p>
                        <s:fielderror fieldName="nombreChollo" cssClass="errorForm"/>
                        <s:file name="imagenProducto" accept="application/png">
                        </s:file>
                    </div>

                    <%-- CATEGORÍA DEL PRODUCTO --%>
                    <div class="chollo_nuevo">
                        <p>Categoría del chollo: </p>
                        <s:fielderror fieldName="nombreCategoria" cssClass="errorForm"/>
                        <s:select id="selectorCategorias" label="Editorial" list="{'test'}" name="nombreCategoria" listKey="id" listValue=""></s:select>
                        </div>

                    <%-- TIENDA EN LA QUE SE OFERTA EL PRODUCTO --%>
                    <div class="chollo_nuevo">
                        <p>Tienda: </p>
                        <s:fielderror fieldName="nombreTienda" cssClass="errorForm"/>
                        <s:select id="selectorTiendas" label="Editorial" list="{'test'}" name="nombreTienda" listKey="id" listValue=""></s:select>
                        </div> 
                        
                    <%-- FECHA DE VENCIMIENTO DE LA OFERTA --%>
                    <div class="chollo_nuevo">
                        <p>Fecha de vencimiento </p>
                        <s:fielderror fieldName="fechaVencimiento" cssClass="errorForm"/>
                        <s:textfield name="fechaVencimiento" placeholder="dd/MM/yyyy">
                        </s:textfield>
                    </div> 

                    <div class="chollo_nuevo" id="botonSubirChollo">
                        <s:submit value="Subir chollo" cssClass="boton"></s:submit>
                        </div>

                </s:form>
            </div>



        </main>
        <%--FOOTER--%>
        <s:include value="/Vistas/Componentes/footer.jsp"></s:include>
    </body>

</html>
