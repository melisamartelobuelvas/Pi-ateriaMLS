<div class="lateralp">
    <?php if(!empty($_SESSION['errores'])): ?>
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul>
            <?php
                foreach ($_SESSION['errores'] as $error){
                    echo "<li>".$error. "</li>";
                }
            ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="login">
        <div class="head">
            <div class="parteA">
                <h3>Iniciar sesión</h3>
            </div>
        </div>
        <form action="/usuario/iniciar_sesion/" method="post">
            <input type="text" name="usuario" placeholder="Usuario">
            <input type="password" name="clave" placeholder="Contraseña">
            <input type="submit" value="Ingresar">
        </form>
    </div>
</div>