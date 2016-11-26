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
            <h4>Carrito</h4>
        </div>		
        <table class="table table-bordered mia">
            <thead class="color">
                <tr>
                    <th class="sin-borde-abajo">Imagen</th>
                    <th class="sin-borde-abajo">Codigo</th>
                    <th class="sin-borde-abajo">Cantidad</th>
                    <th class="sin-borde-abajo">Nombre</th>
                    <th class="sin-borde-abajo"></th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($dato as $r): ?>
                    <tr>    
                        <td class="imagen"><img src='/<?php echo $r['imagen']?>'></td>
                        <td><?php echo $r['id']?></td>
                        <td><?php echo $r['cantidad'] ?></td>
                        <td><?php echo $r['nombre'] ?></td>			            
                        <td>   
                            <a style="margin-right: 1%" href="#<?php echo $r->id ?>/" class="btn btn-info" title="Editar cantidad"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a data-toggle="modal" data-target="#modal-eliminar" codigoe="<?php echo $r[posicion] ?>" class="btn btn-danger tip-top" title="Eliminar del carrito"><i class="glyphicon glyphicon-remove"></i></a>  
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php
                        if($dato==null)
                        {
                            echo "<tr><td colspan='4'>No hay ningun produto</td></tr>";
                        }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div id="modal-eliminar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="/producto/eliminarCarrito/" role="form" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Eliminar producto del carrito</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" id="codigo" name="id" value="" />
            <h5 style="text-align: center">¿Desea realmente eliminar este producto?</h5>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            <button class="btn btn-danger">Eliminar</button>
        </div>      
    </form>
</div>
<script type="text/javascript">
    window.onload = function() {    
        $(document).on('click', 'a', function(event) {

            var codigo_id = $(this).attr('codigoe');
            $('#codigo').val(codigo_id);

        });
    }
</script>