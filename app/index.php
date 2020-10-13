<?php
session_start();
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/head.php';
/*require_once 'views/nav.php';*/

/************************************************** CONTENIDO **************************************************/
/* Si no se consigue cargar nigun controlador saldra el 'error' */
function show_error() {
    $error = new errorController();
    $error->index();
}
/* Carga el controlador */
if (isset($_GET['controller'])) {
    $nombre_controlador = $_GET['controller'] . 'Controller';
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $nombre_controlador = controller_default;
} else {
    show_error();
    exit();
}
/* Carga la funcion contenida en el controlador */
if (class_exists($nombre_controlador)) {
    $controlador = new $nombre_controlador();

    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $action = $_GET['action'];
        $controlador->$action();
    } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $action_default = action_default;
        $controlador->$action_default();
    } else {
        show_error();
    }
} else {
    show_error();
}
/************************************************** CONTENIDO **************************************************/

/*Carga el FOOTER (El pie de pagina)*/
require_once 'views/footer.php';
?>

