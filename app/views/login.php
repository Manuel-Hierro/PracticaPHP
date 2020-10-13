<?php if (!isset($_SESSION['identity'])): ?>    
    <?php if (isset($_SESSION['error_login'])): ?>
        <div class="alert alert-danger" align="center">Identificacion fallida</div>    
    <?php endif; ?>
    <?php Utils::deleteSession('error_login'); ?>
    <div class="d-flex justify-content-center h-100">         
        <div class="card">       
            <div class="card-header h1_login">
                <h1>Login</h1>				
            </div>  
            <div class="card-body">
                <form action="<?= base_url ?>usuario/login" method="POST">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Escribe tu Usuario">
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>                        
                        <input type="password" class="form-control" name="password" id="password"  placeholder="Escribe tu Contraseña">
                    </div>                    
                    <div class="form-group">
                        <input type="submit" value="Aceptar" class="btn aceptar_principal">
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center">					
                    <a href="<?= base_url ?>usuario/registro" class="a_principal">¿No tienes una cuenta?</a>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="#" class="a_principal">¿Olvidaste tu contraseña?</a>
                </div>
            </div>              
        </div>        
    </div>
<?php else: ?>        
    <?= header("Location:" . base_url . 'usuario/logueado'); ?>        
<?php endif; ?>