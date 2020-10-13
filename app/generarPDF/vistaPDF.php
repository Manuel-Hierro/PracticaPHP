<?php
require_once '../models/usuario.php';
require_once '../config/db.php';
require_once '../config/parameters.php';
require_once '../helpers/utils.php';

$usuario = new Usuario();
$users = $usuario->getUsuarios();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Head</title>
        <meta name="Description" content="head">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    </head>
    <body>
        <div>

            <h1>Manuel</h1>


        </div>

        <div>

            <h2>Jesus</h2>

        </div>        

        <div>
            <h4>Desarrollado por Manuel Jesus Hierro Pinto &copy; <?php echo date('Y') ?></h4>
        </div>
    </body> 
</html>