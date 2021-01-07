<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags" %>

<header>

    <div id="logo"> 
        <figure>
            <a href="${pageContext.request.contextPath}">
                <img src="${pageContext.request.contextPath}/Vistas/imagenes/logo.png" alt="Logo"/>
            </a>

        </figure>
    </div>

<!--    <div id="busqueda">
        <form action="#" method="GET">
            <input type="text" placeholder="Buscar"/>
        </form>
    </div>-->

    <div id="perfil">

        <s:if test="#session.USUARIO.usuario != null">
            <div id="cerrar_sesion">
                <p> <a onclick="irA('formCerrarSesion')" >Cerrar sesión</a> </p>
            </div>
        </s:if>

        <s:if test="#session.USUARIO.foto != null">
            <figure onclick="irA('formFotoPerfil')">
                <img src="${pageContext.request.contextPath}/Vistas/imagenes/usuarios/${session.USUARIO.foto}" alt="Acceso al perfil"/>
            </figure>
        </s:if>
        <s:else>
            <figure onclick="irA('formFotoPerfil')">
                <img src="${pageContext.request.contextPath}/Vistas/imagenes/mona_lisa_lol.jpg" alt="Acceso al perfil"/>
            </figure>
        </s:else>














    </div>

</header>