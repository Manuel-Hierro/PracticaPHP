<?php if (isset($_SESSION['administrador'])): ?>
    <div class="justify-content-center">
        <div class="card-header text-center">
            <h1>Panel de Administradores</h1>				
        </div> 
        <div class="card-body text-center">  
            <div class="card-body">
                <a class="btn btn-primary btn-lg" href="<?= base_url ?>usuario/listado"><i class="fas fa-clipboard-list"></i> Gestionar Usuarios</a>
            </div> 
            <div class="card-body">   
                <a class="btn btn-lg btn-primary" href="<?= base_url ?>usuario/solicitudes"><i class="fas fa-clipboard-list"></i> Gestionar Solicitudes</a>
            </div>
            <div class="card-body">
                <a class="btn btn-primary btn-lg" href="#"><i class="fas fa-clipboard-list"></i> Gestionar Correos</a>
            </div> 
            <div class="card-body">
                <a class="btn btn-primary btn-lg" href="<?= base_url ?>usuario/log"><i class="fas fa-clipboard-list"></i> Gestionar Logs</a>
            </div> 
        </div>
    </div>
<?php elseif (isset($_SESSION['profesor'])): ?>
    <div class="justify-content-center">
        <div class="card-header text-center">
            <h1>Panel de Profesores</h1>				
        </div> 
        <div class="card-body text-center">  
            <div class="card-body">
                <a class="btn btn-primary btn-lg" href="#"><i class="fas fa-clipboard-list"></i> Enviar mensaje</a>
            </div> 
            <div class="card-body">   
                <a class="btn btn-lg btn-primary" href="#"><i class="fas fa-clipboard-list"></i> Eliminar mensaje</a>
            </div>
            <div class="card-body">
                <a class="btn btn-primary btn-lg" href="#"><i class="fas fa-clipboard-list"></i> Buscar/Filtrar mensajes</a>
            </div> 
        </div>
    </div>
<?php else: ?>
    <?= header("Location:" . base_url); ?>
<?php endif; ?>
 