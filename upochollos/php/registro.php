<!DOCTYPE html>

<html>
    <head>
        <title>UpoChollos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!--FUENTE: Open Sans-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
        
        <!--ESTILOS PROPIOS DE REGISTRO-->
        <link rel="stylesheet" type="text/css" href="../css/estiloRegistro.css"> 
        
        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->
        <?php include 'libreriasJS.php'; ?>
        
        <!--FUNCIONES E INTERACCIONES JS ESPECÍFICAS DE LA PAGINA DE USUARIO-->
        <script type='text/javascript' src='../js/comprobacionRegistro.js'></script>
    </head>
    
    <body>
        <!--TARJETA PRINCIPAL: SE INCLUYE LOGOTIPO Y FORMULARIO-->
        <div id='ventanaLogin'>
            <!--LOGOTIPO DE LA MARCA: 'NEWZ'-->
            <figure><img src="../img/logo.png" alt='logo'/></figure>
            
            <!-- FORMULARIO DE REGISTRO DE USUARIO -->
            <form action="crudProducto.php" method="POST" onsubmit="return comprobarRegistro()">
                
                <!--TEXT FIELD DE NOMBRE DE USUARIO-->
                <div class="inputLogin">
                    <figure><img src="../img/iconos/user.png" alt="icono de contraseña"/></figure>
                    <input id='usuarioTextField' type='text' name='usuario' value='' placeholder='Usuario'/><br/>
                </div>
                
                <!--TEXT FIELD DE CONTRASEÑA-->
                <div class="inputLogin">                    
                    <figure><img src="../img/iconos/password.png" alt="icono de usuario"/></figure>                    
                    <input id='contrasenaTextField' type='password' name='contrasena' value='' placeholder='Contraseña'/><br/>
                </div>
                
                <!--TEXT FIELD DE EMAIL-->
                <div class="inputLogin">                    
                    <figure><img src="../img/iconos/correo.png" alt="icono de correo"/></figure>                    
                    <input id='emailTextField' type='text' name='email' value='' placeholder='Email'/><br/>
                </div>
                
                 <!--BOTON REGISTRAR: submit-->
                <div class="boton" id="divRegistrar">
                    <input type='submit' name='registrar' value='Registrar'/>
                </div>
            </form>
        </div>
    </body>
</html>