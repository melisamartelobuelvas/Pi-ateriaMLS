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
            <h4>Aliados</h4>
        </div>
        <form action="/aliados/buscar/" method="post" class='buscar'>
                <select name="regimen">
                    <option value="">Todos</option>
                    <option value="COMUN">Comun</option>
                    <option value="SIMPLIFICADO">Simplificado</option>
                </select>
                <input type="submit" value="Buscar">
        </form>
        <table class="table table-bordered mia">
            <thead class="color">
                <tr>
                    <th class="sin-borde-abajo">Nombre</th>
                    <th class="sin-borde-abajo">Direccion</th>
                    <th class="sin-borde-abajo">Telefono</th>
                    <th class="sin-borde-abajo">Regimen</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($dato as $r): ?>
                    <tr>
                            <td><?php echo $r->nombre_establecimiento ?></td>
                            <td><?php echo $r->direccion ?></td>
                            <td><?php echo $r->telefono ?></td>	
                            <td><?php echo $r->regimen ?></td>
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