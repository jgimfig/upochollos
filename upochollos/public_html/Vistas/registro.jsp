<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags" %>

<!DOCTYPE html>

<html>
    <head>
        <title>Registro</title>

        <%--IMPORTACION DE METADATOS Y LIBRERÍAS--%>
        <s:include value="/Vistas/Componentes/head.jsp">
        </s:include>
        <link href="${pageContext.request.contextPath}/Vistas/styles/estilo_login.css" rel="stylesheet" type="text/css"/>

    </head>

    <body>

        <main>
            <!--TARJETA PRINCIPAL: SE INCLUYE LOGOTIPO Y FORMULARIO-->
            <div id='ventanaLogin'>
                <!--LOGOTIPO DE LA MARCA: 'Piggy Cash'-->
                <figure><img src="${pageContext.request.contextPath}/Vistas/imagenes/logo.png" alt='logo'/></figure>

                <!-- FORMULARIO DE REGISTRO DE USUARIO -->
                <s:form action="registro" method="POST" validate="true">

                    <s:fielderror cssClass="errorForm"/>

                    <!--TEXT FIELD DE NOMBRE DE USUARIO-->
                    <div class="inputLogin">
                        <figure><img src="${pageContext.request.contextPath}/Vistas/imagenes/iconos/iconoUsuario.svg" alt="icono de usuario"/></figure>
                            <s:textfield id='usuarioTextField' name='usuario' value='' placeholder='Usuario' >
                            </s:textfield>
                    </div>

                    <!--TEXT FIELD DE EMAIL-->
                    <div class="inputLogin">                    
                        <figure><img src="${pageContext.request.contextPath}/Vistas/imagenes/iconos/iconoEmail.svg" alt="icono de correo"/></figure>                    
                            <s:textfield id='emailTextField' name='email' value='' placeholder='Email'>
                            </s:textfield> <br/>
                    </div>

                    <!--TEXT FIELD DE CONTRASEÑA-->
                    <div class="inputLogin" id="password">                    
                        <figure><img src="${pageContext.request.contextPath}/Vistas/imagenes/iconos/iconoCandado.svg" alt="icono de contraseña"/></figure>                    
                            <s:password id='contrasenaTextField' name='contrasena' value='' placeholder='Contraseña' >
                            </s:password> <br/>
                    </div>

                    <!--BOTON REGISTRAR: submit-->
                    <div id="divRegistrar">
                        <s:submit cssClass="boton" name='registrar' value='Registrar'>

                        </s:submit>
                    </div>
                </s:form>

                <p>¿Ya registrado? <s:a href="Vistas/login.jsp">Iniciar sesión</s:a> </p>

            </div>

        </main>

    </body>
</html>

