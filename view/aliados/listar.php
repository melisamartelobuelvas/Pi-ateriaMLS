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
        <!--form action="/aliados/buscar/" method="post" class='buscar'>
                <select name="regimen">
                    <option value="">Todos</option>
                    <option value="COMUN">Comun</option>
                    <option value="SIMPLIFICADO">Simplificado</option>
                </select>
                <input type="submit" value="Buscar">
        </form-->
        <h5>Comparar aliados</h5>
        <form action="/aliados/comparar/" method="post" class='buscar'>
                <select name="aliado1">
                    <option value="">Aliando...</option>
                    <?php foreach($dato as $r): ?>
                        <option value="<?php echo $r->hotel ?>"><?php echo $r->hotel ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="aliado2">
                    <option value="">Aliando...</option>
                    <?php foreach($dato as $r): ?>
                        <option value="<?php echo $r->hotel ?>"><?php echo $r->hotel ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" value="Buscar">
        </form>
        <table class="table table-bordered mia">
            <thead class="color">
                <tr>
                    <th class="sin-borde-abajo">Nombre</th>
                    <th class="sin-borde-abajo">Habitaciones</th>
                    <th class="sin-borde-abajo">Camas</th>
                    <th class="sin-borde-abajo">Empleados</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($dato as $r): ?>
                    <tr>
                            <td><?php echo $r->hotel ?></td>
                            <td><?php echo $r->hab ?></td>
                            <td><?php echo $r->camas ?></td>	
                            <td><?php echo $r->emp ?></td>
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