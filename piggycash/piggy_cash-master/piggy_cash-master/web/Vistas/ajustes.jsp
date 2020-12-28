<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags" %>
<!DOCTYPE html>
<html>

    <head>
        <title>Ajustes</title>
        <%--IMPORTACION DE METADATOS Y LIBRERÍAS--%>
        <s:include value="/Vistas/Componentes/head.jsp">
        </s:include>

        <link href="${pageContext.request.contextPath}/Vistas/styles/estilo_chollo.css" rel="stylesheet" type="text/css"/>

        <link href="${pageContext.request.contextPath}/Vistas/styles/estilo_ajustes.css" rel="stylesheet" type="text/css"/>

    </head>


    <body>

        <s:include value="/Vistas/Componentes/header.jsp">
        </s:include>

        <div class="tituloAjustes">
            <h1>Configuración</h1>

            <s:form action="eliminarCuenta" method="POST">
                <s:submit value="ELIMINAR CUENTA" cssClass="boton"></s:submit>
            </s:form>
        </div>
        <main>
            <%--FORMULARIO PARA ACTUALIZAR LA FOTO DE PERDFIL--%>
            <s:form action="actualizarFoto" method="post" enctype="multipart/form-data" id="formFoto">

                <!--FOTO DE PERFIL ACTUAL-->
                <h3>Foto de perfil</h3>

                <s:if test="#session.USUARIO.foto != null">
                    <figure id='fotoPerfilActual'>

                        <img id='imgActual' class='fotoPerfil' src="${pageContext.request.contextPath}/Vistas/imagenes/usuarios/${session.USUARIO.foto}" alt='cambiar foto de perfil'/>
                    </figure>
                </s:if>
                <s:else>
                    <figure id='fotoPerfilActual'>
                        <img id='imgActual' class='fotoPerfil' src="${pageContext.request.contextPath}/Vistas/imagenes/mona_lisa_lol.jpg" alt='cambiar foto de perfil'/>
                    </figure>
                </s:else>



                <!--INPUT: file -> nueva foto de perfil -->
                <s:file id="fotoPerfil" name="fotoPerfil" type="file"> </s:file>
                    <br/>
                    <!--INPUT: submit -->
                <s:submit id="subirFoto" cssClass="boton" name="subirFoto" type="submit" value="Subir foto" > </s:submit>
            </s:form>


            <%--FORMULARIO PARA ACTUALIZAR EL CORREO ELECTRÓNICO ASOCIADO A LA CUENTA--%>
            <s:form action="actualizarCorreo" method="POST">
                <h3>Correo electrónico</h3>

                <p class="label">Nuevo correo electrónico</p> <s:fielderror fieldName="correo" cssClass="errorForm"/> <s:textfield name="correo" cssClass="textInput"></s:textfield> <br/>
                <p class="label">Contraseña</p> <s:fielderror fieldName="correoContrasena" cssClass="errorForm"/> <s:password name="correoContrasena" cssClass="textInput" ></s:password> <br/>

                <s:submit value="Actualizar correo" cssClass="boton"></s:submit>
            </s:form>

            <%--FORMULARIO PARA ACTUALIZAR LA CONTRASEÑA ASOCIADA A LA CUENTA--%>
            <s:form action="actualizarContrasena" method="POST">
                <h3>Cambiar contraseña</h3>

                <p class="label">Contraseña actual</p> <s:fielderror fieldName="contrasenaActual" cssClass="errorForm"/> <s:password name="contrasenaActual" cssClass="textInput"></s:password> <br/>
                <p class="label">Nueva contraseña</p> <s:fielderror fieldName="contrasena" cssClass="errorForm"/> <s:password name="contrasena" cssClass="textInput"></s:password> <br/>
                <p class="label">Repetir contraseña</p> <s:fielderror fieldName="confirmaContrasena" cssClass="errorForm"/> <s:password name="confirmaContrasena" cssClass="textInput" ></s:password> <br/>

                <s:submit value="Cambiar contraseña" cssClass="boton"></s:submit>
            </s:form>
        </main>

        <s:include value="/Vistas/Componentes/footer.jsp">
        </s:include>
</body>
</html>
