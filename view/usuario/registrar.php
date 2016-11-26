<div class="lateralp">
    <div class="login">
        <div class="head">
            <h4>Registro</h4>
            <p>Todos los campos son obligatorios</p>
        </div>
        <form action="/usuario/guardar/" method="post">
            <input type="hidden" name="id" value="<?php echo is_object($dato)?$dato->id:'' ?>">
            <input type="text" name="nombre" placeholder="Nombre*" value="<?php echo is_object($dato)?$dato->nombre:'' ?>">
            <input type="text" name="identificacion" placeholder="Identificacion*" value="<?php echo is_object($dato)?$dato->identificacion:'' ?>">
            <input type="text" name="telefono" placeholder="Telefono*" value="<?php echo is_object($dato)?$dato->telefono:'' ?>">
            <input type="text" name="direccion" placeholder="Direccion*" value="<?php echo is_object($dato)?$dato->direccion:'' ?>">
            <input type="text" name="correo" placeholder="Correo*" value="<?php echo is_object($dato)?$dato->correo:'' ?>">
            <input type="text" name="usuario" id="usuario" placeholder="Usuario*" value="<?php echo is_object($dato)?$dato->usuario:'' ?>" onblur='validarUsuario(usuario.value)'>
            <input type="password" name="clave" placeholder="Contraseña*">
            <input type="password" name="repetir_clave" placeholder="Repetir contraseña*">
            <input type="submit" value="Guardar">
        </form>
    </div>
</div>


<script type="text/javascript">
    function validarUsuario(usuario){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.responseText=="bad"){
                    document.getElementById("usuario").setAttribute("class","error");
                }else{
                    document.getElementById("usuario").setAttribute("class","");
                }
            }
        };
        xhttp.open("POST", "/usuario/verificar_usuario/", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("usuario="+usuario);
    }
</script>