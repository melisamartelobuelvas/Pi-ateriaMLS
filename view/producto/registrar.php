<div class="lateralp">
    <div class="login">
        <div class="head">
            <h4>Registro</h4>
            <p>Todos los campos son obligatorios</p>
        </div>
        <form action="/producto/guardar/" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo is_object($dato)?$dato->id:'' ?>">
            <input type="text" name="nombre" placeholder="Nombre*" value="<?php echo is_object($dato)?$dato->nombre:'' ?>">
            <input type="number" name="cantidad" min="0" placeholder="Cantidad*" value="<?php echo is_object($dato)?$dato->cantidad:'' ?>">
            <input type="number" name="preciodecompra" min="0" placeholder="Precio de compra*" value="<?php echo is_object($dato)?$dato->preciodecompra:'' ?>">
            <input type="number" name="preciodeventa" min="0" placeholder="Precio de venta*" value="<?php echo is_object($dato)?$dato->preciodeventa:'' ?>">
            <input type="text" name="descripcion" placeholder="Descripcion*" value="<?php echo is_object($dato)?$dato->descripcion:'' ?>">
            <input type="file" name="imagen">
            <input type="submit" value="Guardar">
        </form>
    </div>
</div>
