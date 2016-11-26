<div class="lateralp">
    <div class="veruser">
	<div class="head">
            <h4>Datos del usuario</h4>
            <img class="gravatar" src="<?php echo get_gravatar($dato->correo,120); ?>">
	</div>
	<table class="table table-bordered mia m">
	    <tbody>
                <tr>
                    <td class="text-right"><strong>Codigo</strong></td>
                    <td><?php echo $dato->id ?></td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Identificacion</strong></td>
                    <td><?php echo $dato->identificacion ?></td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Nombre</strong></td>
                    <td><?php echo $dato->nombre ?></td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Direccion</strong></td>
                    <td><?php echo $dato->direccion ?></td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Telefono</strong></td>
                    <td><?php echo $dato->telefono ?></td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Usuario</strong></td>
                    <td><?php echo $dato->usuario ?></td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Correo</strong></td>
                    <td><?php echo $dato->correo ?></td>
                </tr>
	    </tbody>
	</table>
    </div>
</div>