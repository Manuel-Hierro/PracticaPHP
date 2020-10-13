<div class="div3 card-body">
    <div class="div4 h1-registro">
        <h1>Registro</h1>				
    </div>  
    <?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
        <div class="alert alert-success" align="center">Registro completado</div>
    <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
        <div class="alert alert-danger" align="center">Registro fallido, introduce bien los datos</div>
    <?php endif; ?>
    <?php Utils::deleteSession('register'); ?>
    <div class="div6">
        <form action="<?= base_url ?>usuario/save" method="POST" enctype="multipart/form-data">                    
            <!-- div del NIF -->
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user-edit"></i>
                    </span>                            
                </div>
                <input type="text" class="form-control" name="nif" id="nif" placeholder="Escribe tu NIF     (xxxxxxxx-x)">                               
            </div> 
            <?php if (isset($_SESSION['nif']) && $_SESSION['nif'] == 'failed'): ?>            
                <div class="alert alert-danger" align="center">El NIF no es valido</div>
            <?php endif; ?>
            <?php Utils::deleteSession('nif'); ?>
            <!-- div del Nombre -->
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user-edit"></i>
                    </span>                            
                </div>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escribe tu Nombre     (Solo letras)">                               
            </div>     
            <?php if (isset($_SESSION['nombre']) && $_SESSION['nombre'] == 'failed'): ?>
                <div class="alert alert-danger" align="center">El Nombre no es valido</div>
            <?php endif; ?>
            <?php Utils::deleteSession('nombre'); ?>
            <!-- div del Apellido1 -->
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user-edit"></i>
                    </span>
                </div>
                <input type="text" class="form-control" name="apellido1" id="apellido1" placeholder="Escribe tu 1º Apellido     (Solo letras)">						
            </div>
            <?php if (isset($_SESSION['apellido1']) && $_SESSION['apellido1'] == 'failed'): ?>
                <div class="alert alert-danger" align="center">El primer apellido no es valido</div>
            <?php endif; ?>
            <?php Utils::deleteSession('apellido1'); ?>
            <!-- div del Apellido2 -->
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user-edit"></i>
                    </span>
                </div>
                <input type="text" class="form-control" name="apellido2" id="apellido2" placeholder="Escribe tu 2º Apellido     (Solo letras)">						
            </div>
            <?php if (isset($_SESSION['apellido2']) && $_SESSION['apellido2'] == 'failed'): ?>
                <div class="alert alert-danger" align="center">El segundo apellido no es valido</div>
            <?php endif; ?>
            <?php Utils::deleteSession('apellido2'); ?>
            <!-- div del Username -->
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user-edit"></i>
                    </span>
                </div>
                <input type="text" class="form-control" name="username" id="username" placeholder="Escribe tu Usuario     (Todo)">						
            </div>       
            <?php if (isset($_SESSION['username']) && $_SESSION['username'] == 'failed'): ?>
                <div class="alert alert-danger" align="center">El Usuario no es valido</div>
            <?php endif; ?>
            <?php Utils::deleteSession('username'); ?>
            <!-- div de la password -->
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-unlock-alt"></i>
                    </span>
                </div>
                <input type="password" class="form-control" name="password" id="password"  placeholder="Escribe tu Contraseña     (Mayuscula, minisculas, numeros, caracteres, tamaño 8 y 12)">
            </div>   
            <?php if (isset($_SESSION['password']) && $_SESSION['password'] == 'failed'): ?>
                <div class="alert alert-danger" align="center">La contraseña no es valida</div>
            <?php endif; ?>
            <?php Utils::deleteSession('password'); ?>
            <!-- div del Email -->
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-at"></i>
                    </span>
                </div>
                <input type="text" class="form-control" name="email" id="email"  placeholder="Escribe tu Email     (xxxx@xxxx.xxx)">						
            </div>
            <?php if (isset($_SESSION['email']) && $_SESSION['email'] == 'failed'): ?>
                <div class="alert alert-danger" align="center">El email no es valido</div>
            <?php endif; ?>
            <?php Utils::deleteSession('email'); ?>
            <!-- div de la Fotografia -->
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-image"></i>
                    </span>
                </div>
                <input type="file" class="form-control" name="fotografia" id="fotografia">						
            </div>
            <!-- div del Telefono -->
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-phone"></i>
                    </span>
                </div>
                <input type="text" class="form-control" name="telefono" id="telefono"  placeholder="Escribe tu Telefono     ((9/8)xxxxxxxx)">						
            </div>
            <?php if (isset($_SESSION['telefono']) && $_SESSION['telefono'] == 'failed'): ?>
                <div class="alert alert-danger" align="center">El Telefono no es valido</div>
            <?php endif; ?>
            <?php Utils::deleteSession('telefono'); ?>
            <!-- div del Movil -->
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-mobile-alt"></i>
                    </span>
                </div>
                <input type="text" class="form-control" name="movil" id="movil" placeholder="Escribe tu Movil     ((6/7)xxxxxxxx)">						
            </div>
            <?php if (isset($_SESSION['movil']) && $_SESSION['movil'] == 'failed'): ?>
                <div class="alert alert-danger" align="center">El Movil no es valido</div>
            <?php endif; ?>
            <?php Utils::deleteSession('movil'); ?>
            <!-- div de la Pagina Web -->
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fab fa-weebly"></i>
                    </span>
                </div>
                <input type="text" class="form-control" name="paginaweb" id="paginaweb" placeholder="Escribe tu Pagina Web     (www.xxxxx.xxx)">						
            </div>
            <?php if (isset($_SESSION['paginaweb']) && $_SESSION['paginaweb'] == 'failed'): ?>
                <div class="alert alert-danger" align="center">La Pagina Web no es valida</div>
            <?php endif; ?>
            <?php Utils::deleteSession('paginaweb'); ?>
            <!-- div del Blog -->
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fab fa-blogger"></i>
                    </span>
                </div>
                <input type="text" class="form-control" name="blog" id="blog" placeholder="Escribe tu Blog     (www.blogger.com/xxxx)">						
            </div>
            <?php if (isset($_SESSION['blog']) && $_SESSION['blog'] == 'failed'): ?>
                <div class="alert alert-danger" align="center">El Blog no es valido</div>
            <?php endif; ?>
            <?php Utils::deleteSession('blog'); ?>
            <!-- div de Twitter -->
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fab fa-twitter"></i>
                    </span>
                </div>
                <input type="text" class="form-control" name="twitter" id="twitter" placeholder="Escribe tu Twitter     (www.twitter.com/xxxx)">						
            </div>
            <?php if (isset($_SESSION['twitter']) && $_SESSION['twitter'] == 'failed'): ?>
                <div class="alert alert-danger" align="center">El Twitter no es valido</div>
            <?php endif; ?>
            <?php Utils::deleteSession('twitter'); ?>
            <!-- div de Departamento -->                            
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-briefcase"></i>
                    </span>
                </div>                
                <select type="text" class="form-control" name="departamento" id="departamento">	
                    <option selected="true" disabled>Seleccione el Departamento</option>
                    <option value="informatica">Informatica</option>
                    <option value="administraccion">Administraccion</option>
                    <option value="turismo">Turismo</option>
                    <option value="comercio">Comercio</option>
                </select>
            </div>  
            <?php if (isset($_SESSION['departamento']) && $_SESSION['departamento'] == 'failed'): ?>
                <div class="alert alert-danger" align="center">El Departamento no ha sido seleccionado</div>
            <?php endif; ?>
            <?php Utils::deleteSession('departamento'); ?>
            <!-- div de Cursos -->
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-bezier-curve"></i>
                    </span>
                </div>                
                <select type="text" class="form-control" name="cursos" id="cursos">	
                    <option selected="true" disabled>Seleccione el Curso</option>
                    <option value="1º">1º</option>
                    <option value="2º">2º</option>
                </select>
            </div>  
            <?php if (isset($_SESSION['cursos']) && $_SESSION['cursos'] == 'failed'): ?>
                <div class="alert alert-danger" align="center">El Curso no ha sido seleccionado</div>
            <?php endif; ?>
            <?php Utils::deleteSession('cursos'); ?>
            <!-- div de Asignaturas -->
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-book"></i>
                    </span>
                </div>                
                <select type="text" class="form-control" name="asignaturas" id="asignaturas">	
                    <option selected="true" disabled>Seleccione la Asignatura</option>
                    <option value="matematicas">Matematicas</option>
                    <option value="economia">Economia</option>
                    <option value="lengua">Lengua</option>
                    <option value="fisica">Fisica</option>
                </select>
            </div>  
            <?php if (isset($_SESSION['asignaturas']) && $_SESSION['asignaturas'] == 'failed'): ?>
                <div class="alert alert-danger" align="center">La Asignatura no ha sido seleccionada</div>
            <?php endif; ?>
            <?php Utils::deleteSession('asignaturas'); ?>
            <!-- reCAPTCHA -->            
            <div class="g-recaptcha" data-sitekey="6Ld7z4wUAAAAAJTKKSfKbGI00L-JKH9PF4SWEdoo"></div>      
            <?php if (isset($_SESSION['captcha']) && $_SESSION['captcha'] == 'failed'): ?>
                <div class="alert alert-danger" align="center">Error al comprobar el captcha</div>
            <?php endif; ?>
            <?php Utils::deleteSession('captcha'); ?>
            <!-- div de Enviar(Aceptar) -->
            <div class="form-group">
                <input type="submit" name="submit" value="Aceptar" class="btn aceptar_registro">
                <a type="button" class="btn atras_registro" href="<?= base_url ?>">Atras</a>
            </div>              
        </form> 
    </div>            
</div>
