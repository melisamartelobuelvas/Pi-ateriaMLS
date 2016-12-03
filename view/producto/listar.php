<div class="lateralp">
    <div class="login">
        <div class="head">
            <h4>Productos</h4>
        </div>
        <form action="/producto/buscar/" method="post" class='buscar'>
            <input type="text" id="buscar" name="buscar" placeholder="¿Que desea encontrar?">
            <input type="submit" value="Buscar">
        </form>
    </div>
    <?php 
        foreach ($dato as $v){
            echo "<div class='producto'>"
                    ."<div class='a'>"
                        ."<h3>".$v->nombre."</h3>"
                        ."<p><strong>Precio: </strong>$".$v->preciodeventa." pesos</p>"
                        ."<p><strong>Disponibles: </strong>".$v->cantidad."</p>"
                        ."<p>".$v->descripcion."</p>";
                        if(isset($_SESSION['rol'])){
                            if($_SESSION['rol']=='administrador'){
                                echo '<a style="margin-right: 1%" href="/producto/crud/'.$v->id.'/" class="btn btn-info" title="Editar producto"><i class="glyphicon glyphicon-pencil"></i></a>'

                                    .'<a data-toggle="modal" data-target="#modal-eliminar" codigoe="'.$v->id.'" class="btn btn-danger tip-top" title="Eliminar producto"><i class="glyphicon glyphicon-remove"></i></a>'; 
                            }else if ($_SESSION['rol']=='usuario') {
                                echo '<div class="agg">'
                                    . '<input value="1" type="number" id="cantidad'.$v->id.'" name="cantidad'.$v->id.'" max="'.$v->cantidad.'" min="0">'
                                    . '<a data-toggle="modal" data-target="#modal-agg" href="#" onclick="AggAlCarrito(cantidad'.$v->id.'.value,'.$v->id.')">Agregar</a>'
                                    . '</div>';
                            }
                        }
                    echo "</div>"
                    ."<div class='b'>"
                        ."<img src='/".$v->ruta."'>"
                    ."</div>"
                ."</div>";
        } 
    ?>
    <a href="/producto/json/">Importar</a>
</div>
<?php if(isset($_SESSION['rol']) && $_SESSION['rol']=='administrador'): ?>
<div id="modal-eliminar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="/producto/eliminar/" role="form" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Eliminar producto</h5>
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
<?php endif; ?>

<?php if(isset($_SESSION['rol']) && $_SESSION['rol']=='usuario'): ?>
<div id="modal-agg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Aviso</h5>
        </div>
        <div class="modal-body">
            <h5 style="text-align: center">Producto agregado al carrito</h5>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Aceptar</button>
        </div>   
    </form>
</div>
<script type="text/javascript">
    function AggAlCarrito(cantidad,id){
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "/producto/aggAlCarrito/", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("cantidad="+cantidad+"&id="+id);
    }
</script>
<?php endif; ?>