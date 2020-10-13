<div class="table-responsive">
    <table class="table table-striped table-dark text-center">           
        <div class="text-center">
        </div>
        <br>
        <tr class="">
            <th>Acciones</th>
            <th>ID</th>
            <th>NIF</th>
            <th>Nombre</th>
            <th>Apellido</th>                
            <th>Username</th>
            <th>Perfil</th>            
            <th>Email</th>
            <th>Fotografia</th>
            <th>Telefono</th>
            <th>Movil</th>
            <th>PaginaWeb</th>
            <th>Blog</th>
            <th>Twitter</th>
            <th>Departamento</th>
            <th>Cursos</th>
            <th>Asignaturas</th>
            <th>Fecha</th>             
        </tr>
        <?php while ($lista = $solicitud->fetch_object()): ?>
            <tr>
                <td>                
                    <a class="btn btn-primary" href="<?= base_url ?>usuario/aceptar&id=<?= $lista->id ?>"><span class="fas fa-check"></span> Aceptar</a>
                    <a class="btn btn-danger" href="<?= base_url ?>usuario/rechazar&id=<?= $lista->id ?>"><span class="fas fa-times"></span> Rechazar</a>

                </td>
                <td><?= $lista->id; ?></td>
                <td><?= $lista->nif; ?></td>
                <td><?= $lista->nombre; ?></td>
                <td><?= $lista->apellido1 . ' ' . $lista->apellido2; ?></td>
                <td><?= $lista->username; ?></td>
                <td><?= $lista->perfil; ?></td>
                <td><?= $lista->email; ?></td>
                <?php if (isset($lista) && is_object($lista) && !empty($lista->fotografia)): ?>   
                    <td><img src="<?= base_url ?>uploads/images/<?= $lista->fotografia ?>" class="miniatura" /></td>  
                    <?php else: ?>
                    <td></td>
                <?php endif; ?>
                <td><?= $lista->telefono; ?></td>
                <td><?= $lista->movil; ?></td>
                <td><?= $lista->paginaweb; ?></td>
                <td><?= $lista->blog; ?></td>
                <td><?= $lista->twitter; ?></td>
                <td><?= $lista->departamento; ?></td>
                <td><?= $lista->cursos; ?></td>
                <td><?= $lista->asignaturas; ?></td>
                <td><?= $lista->fecha; ?></td>                    
            </tr>        
        <?php endwhile; ?>
    </table>
</div>
<?php Utils::deleteSession('register'); ?>
<?php Utils::deleteSession('delete'); ?>