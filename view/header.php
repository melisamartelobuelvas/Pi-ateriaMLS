<?php
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['carrito'])){
        $_SESSION['carrito']=[];
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Piñateria MLS</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="/assets/css/login.css">
        <link rel="stylesheet" href="/assets/css/estilo.css">
        <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    </head>
    <body>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
                <div class="loginmodal-container">
                    <h1>Iniciar sesión</h1><br>
                    <form action="/usuario/iniciar_sesion/" method="post">
                        <input type="text" name="usuario" placeholder="Usuario">
                        <input type="password" name="clave" placeholder="Contraseña">
                        <input type="submit" name="login" class="login loginmodal-submit" value="Login">
                    </form>
                    <div class="login-help">
                        <a href="/usuario/crud/">Registrarse</a> - <a href="#">Recordar contraseña</a>
                    </div>
                </div>
            </div>
        </div>
        <header>
            <nav>
                <div class="logo">
                    <a href="/"><img src="/assets/img/logo.png"></a>
                </div>
                <div class="navegacion">
                    <ul>
                        <li><a href="/">Inicio</a></li>
                        <li><a href="/producto/">Productos</a></li>
                        <?php
                            if(isset($_SESSION['rol'])){
                                if($_SESSION['rol']=='administrador'){
                                    echo '<li><a href="/producto/crud/">Crear</a></li>';
                                    echo '<li><a href="/usuario/">Usuarios</a></li>';
                                }  else if($_SESSION['rol']=='usuario'){
                                    echo '<li><a href="/producto/carrito/">Carrito</a></li>';
                                }
                            }
                        ?>
                        <li><a href="#">Contacto</a></li>
                        <li><a href="/aliados/">Aliados</a></li>
                        <?php
                            if(isset($_SESSION['rol'])){
                                echo '<li><a href="/usuario/cerrar_sesion/">Salir</a></li>';
                            }else{
                                echo '<li><a href="#" data-toggle="modal" data-target="#login-modal">Ingresar</a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </nav>
        </header>