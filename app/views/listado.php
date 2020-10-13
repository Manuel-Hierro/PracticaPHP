<div class="table-responsive">
    <table class="table table-striped table-dark text-center">           
        <div class="text-center">
            <br>
            <a class="btn btn-success text-center" href="<?= base_url ?>usuario/añadir"><span class="glyphicon glyphicon-plus"></span> Añadir Usuario</a>
            <a class="btn btn-success text-center" href="<?= base_url ?>usuario/generarPDF"><span class="glyphicon glyphicon-plus"></span> Generar PDF</a>
        </div>
        <br>
        <tr class="">
            <th>Acciones</th>
            <th></th>
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
        <?php while ($lista = $listado->fetch_object()): ?>
            <tr>
                <td>   
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Editar<?= $lista->id ?>">Editar</button>
                    <!-- Modal de Editar -->
                    <div class="modal fade" id="Editar<?= $lista->id ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirmacion</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Seguro que desea continuar con la Edicion?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" role="link" onclick="window.location = '<?= base_url ?>usuario/editar&id=<?= $lista->id ?>'"><span class="glyphicon glyphicon-edit"></span> Si</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button> 
                               </div>
                            </div>
                        </div>
                    </div>  
                </td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Eliminar<?= $lista->id ?>">Eliminar</button>
                    <!-- Modal de Editar -->
                    <div class="modal fade" id="Eliminar<?= $lista->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmacion</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ¿Seguro que desea continuar con la Eliminacion?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" role="link" onclick="window.location = '<?= base_url ?>usuario/delete&id=<?= $lista->id ?>'"><span class="glyphicon glyphicon-edit"></span> Si</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button> 
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
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
    <div>

    </div>
</div>
<?php Utils::deleteSession('register'); ?>
<?php Utils::deleteSession('delete'); ?>