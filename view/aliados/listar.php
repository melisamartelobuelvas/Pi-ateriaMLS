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
            <h4>Combustible</h4>
        </div>
        <h5>Comparar precios</h5>
        <form action="/aliados/comparar/" method="post" class='buscar'>
                <select name="aliado1">
                    <option value="">Aliando...</option>
                    <?php foreach($dato as $r): ?>
                        <option value="<?php echo $r->nombrecomercial ?>"><?php echo $r->nombrecomercial ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="aliado2">
                    <option value="">Aliando...</option>
                    <?php foreach($dato as $r): ?>
                        <option value="<?php echo $r->nombrecomercial ?>"><?php echo $r->nombrecomercial ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" value="Buscar">
        </form>
        <table class="table table-bordered mia">
            <thead class="color">
                <tr>
                    <th class="sin-borde-abajo">Nombre</th>
                    <th class="sin-borde-abajo">Marca</th>
                    <th class="sin-borde-abajo">Producto</th>
                    <th class="sin-borde-abajo">Precio</th>
                    <th class="sin-borde-abajo">Direccion</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($dato as $r): ?>
                    <tr>
                            <td><?php echo $r->nombrecomercial ?></td>
                            <td><?php echo $r->bandera ?></td>
                            <td><?php echo $r->producto ?></td>	
                            <td><?php echo $r->precio ?></td>
                            <td><?php echo $r->direccion ?></td>
                    </tr>
                    </tr>
                <?php endforeach; ?>
                <?php
                        if($dato==null)
                        {
                            echo "<tr><td colspan='4'>No hay ningun aliado</td></tr>";
                        }
                ?>
            </tbody>
        </table>
    </div>
</div>