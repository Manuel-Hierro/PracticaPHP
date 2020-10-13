<?php

class Utils {

    public static function deleteSession($name) {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }

    public static function isAdministrador() {
        if (!isset($_SESSION['administrador'])) {
            header("Location:" . base_url);
        } else {
            return true;
        }
    }
    /********************************************************************/
    /*function mostrarError($errores, $campo) {
        $alerta = '';
        if (isset($errores[$campo])) {
            $alerta = "<div class='alert alert-danger' role='alert'>" . $errores[$campo] . "</div>";
        }
        return $alerta;
    }

    function borrarErrores() {
        $_SESSION['errores'] = null;
        // $borrado = session_unset($_SESSION['errores']);
        $borrado = session_unset();

        return $borrado;
    }*/
}
