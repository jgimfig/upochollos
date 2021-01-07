<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags" %>

<!DOCTYPE html>

<html>
    <head>
        <title>Entrar</title>

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

                <!-- FORMULARIO DE INICIO DE SESION -->
                <s:form action="login" validate="true">

                    <!--TEXT FIELD DE NOMBRE DE USUARIO-->
                    <s:fielderror cssClass="errorForm"/>
                    <div class="inputLogin" id="nombre_usuario">
                        <figure><img src="${pageContext.request.contextPath}/Vistas/imagenes/iconos/iconoUsuario.svg" alt="icono de contraseña"/></figure>
                            <s:textfield id='usuarioTextField' name='usuario' value='' placeholder='Usuario' >
                            </s:textfield>

                    </div>

                    <!--TEXT FIELD DE PASSWORD-->
                    <div class="inputLogin" id="password">
                        <figure><img src="${pageContext.request.contextPath}/Vistas/imagenes/iconos/iconoCandado.svg" alt="icono de usuario"/></figure>
                            <s:password id='contrasenaTextField' name='contrasena' value='' placeholder='Contraseña' >
                            </s:password> <br/>
                    </div>

                    <!--BOTON INICIAR SESIÓN: submit-->
                    <div id="divIniciarSesion">
                        <s:submit name='iniciarSesion' cssClass="boton" value='Iniciar sesión'>
                        </s:submit>
                    </div>
                </s:form>

                <!--BOTON REGISTRAR: submit-->
                <s:form action="irA">

                    <s:hidden name="accionAEjecutar" value="registrar"></s:hidden>
                    
                    <s:submit type='submit' cssClass="boton" name='registrar' value='Crear cuenta'>
                    </s:submit>

                </s:form>
            </div>

        </main>

    </body>
</html>

