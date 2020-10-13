<nav class="navbar">
    <a class="nav-link" href="<?= base_url ?>usuario/logueado"><i class="fas fa-home"></i>Inicio</a>  
    <!--
    //<?php if(isset($_SESSION['administrador'])): ?>
    <a class="nav-link" href="<?= base_url ?>usuario/administrador"><i class="fas fa-user-circle"></i>Administradores</a>
    //<?php elseif(isset($_SESSION['profesor'])): ?>
    <a class="nav-link" href="<?= base_url ?>usuario/profesor"><i class="fas fa-chalkboard-teacher"></i>Profesores</a>
    //<?php endif; ?>    
    -->
    <a class="nav-link" href="#"><i class="fas fa-envelope"></i>Perfil (<?=$_SESSION['identity']->perfil?> - <?=$_SESSION['identity']->username?>)</a>
    <a class="nav-link" href="#"><i class="fas fa-envelope"></i>Mensajes</a>
    <a class="nav-link" href="<?=base_url?>usuario/logout"><i class="fas fa-sign-out-alt"></i>Cerrar Sesion</a>   
</nav>