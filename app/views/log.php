<div class="table-responsive">
    <table class="table table-striped table-dark text-center">           
        <div class="text-center">
            <br>
             <a class="btn btn-success text-center" href="<?= base_url ?>usuario/generarPDF"><span class="glyphicon glyphicon-plus"></span> Generar PDF</a>
        </div>
        <br>
        <tr class="">
            <th>Usuario</th>
            <th>Perfil</th>
            <th>Fecha y Hora</th>
            <th>Accion</th>              
        </tr>
        <?php while ($lista = $listado->fetch_object()): ?>
            <tr>                
                <td><?= $lista->username; ?></td>
                <td><?= $lista->perfil; ?></td>
                <td><?= $lista->fecha_y_hora_de_actividad; ?></td>                
                <td><?= $lista->accion; ?></td>                                 
            </tr>        
        <?php endwhile; ?>
    </table>
</div>
<?php Utils::deleteSession('register'); ?>
<?php Utils::deleteSession('delete'); ?>