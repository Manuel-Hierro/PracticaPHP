<?php

require_once 'models/usuario.php';
require_once 'models/log.php';

class usuarioController {

    public function index() {
        echo "<h1 align='center'>" . 'Controlador Usuarios, Accion index' . "</h1>";
    }

    public function principal() {
        require_once 'views/login.php';
    }

    public function login() {
        if (isset($_POST)) {
            $usuario = new Usuario();
            $usuario->setUsername($_POST['username']);
            $usuario->setPassword($_POST['password']);

            $identity = $usuario->login();

            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;

                if ($identity->perfil == 'administrador') {
                    $_SESSION['administrador'] = true;
                } elseif ($identity->perfil == 'profesor') {
                    $_SESSION['profesor'] = true;
                }

                /* Añadimos la accion a la tabla de log */
                $id = $_SESSION['identity']->id;
                $log = new Log();
                $log->setId($id);
                $log->setAccion('login');
                $log->log();
            } else {
                $_SESSION['error_login'] = "Identificacion fallida";
            }
        }
        header("Location:" . base_url . 'usuario/principal');
    }

    public function logueado() {
        require_once 'views/nav.php';
        require_once 'views/logueado.php';
    }

    public function logout() {
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }
        if (isset($_SESSION['administrador'])) {
            unset($_SESSION['administrador']);
        } elseif (isset($_SESSION['profesor'])) {
            unset($_SESSION['profesor']);
        }
        header("Location:" . base_url);
    }

    public function registro() {
        require_once 'views/registro.php';
    }

    public function añadir() {
        Utils::isAdministrador('administrador');
        require_once 'views/añadir.php';
    }

    public function save() {
        if (isset($_POST)) {

            $nif = isset($_POST['nif']) ? $_POST['nif'] : false;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellido1 = isset($_POST['apellido1']) ? $_POST['apellido1'] : false;
            $apellido2 = isset($_POST['apellido2']) ? $_POST['apellido2'] : false;
            $username = isset($_POST['username']) ? $_POST['username'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
            $movil = isset($_POST['movil']) ? $_POST['movil'] : false;
            $paginaweb = isset($_POST['paginaweb']) ? $_POST['paginaweb'] : false;
            $blog = isset($_POST['blog']) ? $_POST['blog'] : false;
            $twitter = isset($_POST['twitter']) ? $_POST['twitter'] : false;
            $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : false;
            $cursos = isset($_POST['cursos']) ? $_POST['cursos'] : false;
            $asignaturas = isset($_POST['asignaturas']) ? $_POST['asignaturas'] : false;

            /* ----- captcha ----- */
            $captcha = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : false;
            $secret = '6Ld7z4wUAAAAABWz134Si2_gUx7aUfI8f5chRpbz';
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
            $arr = json_decode($response, TRUE);
            /* -------------------- Validar los datos -------------------- */

            $errores = 0;

            //Validar nif
            if (!empty($nif) && preg_match("/[0-9]{8}-[A-Z]/", $nif)) {
                $_SESSION['nif'] = "complete";
            } else {
                $_SESSION['nif'] = "failed";
                $errores++;
            }
            //Validar nombre
            if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
                $_SESSION['nombre'] = "complete";
            } else {
                $_SESSION['nombre'] = "failed";
                $errores++;
            }
            //Validar apellido1
            if (!empty($apellido1) && !is_numeric($apellido1) && !preg_match("/[0-9]/", $apellido1)) {
                $_SESSION['apellido1'] = "complete";
            } else {
                $_SESSION['apellido1'] = "failed";
                $errores++;
            }
            //Validar apellido2
            if (!empty($apellido2) && !is_numeric($apellido2) && !preg_match("/[0-9]/", $apellido2)) {
                $_SESSION['apellido2'] = "complete";
            } else {
                $_SESSION['apellido2'] = "failed";
                $errores++;
            }
            //Validar username
            if (!empty($username)) {
                $_SESSION['username'] = "complete";
            } else {
                $_SESSION['username'] = "failed";
                $errores++;
            }
            //Validar password
            if (!empty($password) && preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/", $password)) {
                $_SESSION['password'] = "complete";
            } else {
                $_SESSION['password'] = "failed";
                $errores++;
            }
            //Validar email
            if (!empty($email) && preg_match("/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/", $email)) {
                $_SESSION['email'] = "complete";
            } else {
                $_SESSION['email'] = "failed";
                $errores++;
            }
            //Validar telefono
            if (!empty($telefono) && preg_match("/^(\+34|0034|34)?[8|9][0-9]{8}$/", $telefono)) {
                $_SESSION['telefono'] = "complete";
            } else {
                $_SESSION['telefono'] = "failed";
                $errores++;
            }
            //Validar movil
            if (!empty($movil) && preg_match("/^(\+34|0034|34)?[6|7][0-9]{8}$/", $movil)) {
                $_SESSION['movil'] = "complete";
            } else {
                $_SESSION['movil'] = "failed";
                $errores++;
            }
            //Validar paginaweb
            //if (preg_match("/^\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]$/", $paginaweb)) 
            if (!empty($paginaweb) || empty($paginaweb)) {
                $_SESSION['paginaweb'] = "complete";
            } else {
                $_SESSION['paginaweb'] = "failed";
                $errores++;
            }
            //Validar blog
            //if (preg_match("/^(http\:\/\/|https\:\/\/)?((w{3}\.)?)blogger\.com\/(?:#!\/)?(?:pages\/)?(?:[\w\-\.]*\/)*([\w\-\.]*)+$/", $blog)) 
            if (!empty($blog) || empty($blog)) {
                $_SESSION['blog'] = "complete";
            } else {
                $_SESSION['blog'] = "failed";
                $errores++;
            }
            //Validar twitter
            //if (preg_match("/^(https?:\/\/)?((w{3}\.)?)twitter\.com\/(#!\/)?[a-z0-9_]*$/", $twitter)) 
            if (!empty($twitter) || empty($twitter)) {
                $_SESSION['twitter'] = "complete";
            } else {
                $_SESSION['twitter'] = "failed";
                $errores++;
            }
            //Validar departamento
            if (!empty($departamento)) {
                $_SESSION['departamento'] = "complete";
            } else {
                $_SESSION['departamento'] = "failed";
                $errores++;
            }
            //Validar cursos
            if (!empty($cursos)) {
                $_SESSION['cursos'] = "complete";
            } else {
                $_SESSION['cursos'] = "failed";
                $errores++;
            }
            //Validar asignaturas
            if (!empty($asignaturas)) {
                $_SESSION['asignaturas'] = "complete";
            } else {
                $_SESSION['asignaturas'] = "failed";
                $errores++;
            }
            //Validar CAPTCHA
            if ($arr['success']) {
                $_SESSION['captcha'] = "complete";
            } else {
                $_SESSION['captcha'] = "failed";
            }

            if (($errores == 0) && $nif && $nombre && $apellido1 && $apellido2 && $username && $password && $email && $telefono && $movil && /* $paginaweb && $blog && $twitter && */ $departamento && $cursos && $asignaturas && $arr) {

                $usuario = new Usuario();
                $usuario->setNif($nif);
                $usuario->setNombre($nombre);
                $usuario->setApellido1($apellido1);
                $usuario->setApellido2($apellido2);
                $usuario->setUsername($username);
                $usuario->setPassword($password);
                $usuario->setEmail($email);
                $usuario->setTelefono($telefono);
                $usuario->setMovil($movil);
                $usuario->setPaginaweb($paginaweb);
                $usuario->setBlog($blog);
                $usuario->setTwitter($twitter);
                $usuario->setDepartamento($departamento);
                $usuario->setCursos($cursos);
                $usuario->setAsignaturas($asignaturas);

                //Guardar la imagen
                $file = $_FILES['fotografia'];
                $filename = $file['name'];
                $mimetype = $file['type'];

                if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                    if (!is_dir('uploads/images')) {
                        mkdir('uploads/images', 0777, true);
                    }
                    $usuario->setFotografia($filename);
                    move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                }

                //Llamamos a la funcion para guardar el usuario
                $save = $usuario->save();
                if ($save) {
                    $_SESSION['register'] = "complete";
                } else {
                    $_SESSION['register'] = "failed";
                }
            } else {
                $_SESSION['register'] = "failed";
            }
        } else {
            $_SESSION['register'] = "failed";
        }
        header("Location:" . base_url . 'usuario/registro');
    }

    public function saveadmin() {
        if (isset($_POST)) {

            $nif = isset($_POST['nif']) ? $_POST['nif'] : false;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellido1 = isset($_POST['apellido1']) ? $_POST['apellido1'] : false;
            $apellido2 = isset($_POST['apellido2']) ? $_POST['apellido2'] : false;
            $username = isset($_POST['username']) ? $_POST['username'] : false;
            $perfil = isset($_POST['perfil']) ? $_POST['perfil'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
            $movil = isset($_POST['movil']) ? $_POST['movil'] : false;
            $paginaweb = isset($_POST['paginaweb']) ? $_POST['paginaweb'] : false;
            $blog = isset($_POST['blog']) ? $_POST['blog'] : false;
            $twitter = isset($_POST['twitter']) ? $_POST['twitter'] : false;
            $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : false;
            $cursos = isset($_POST['cursos']) ? $_POST['cursos'] : false;
            $asignaturas = isset($_POST['asignaturas']) ? $_POST['asignaturas'] : false;

            /* -------------------- Validar los datos -------------------- */

            $errores = 0;

            //Validar nif
            if (!empty($nif) && preg_match("/[0-9]{8}-[A-Z]/", $nif)) {
                $_SESSION['nif'] = "complete";
            } else {
                $_SESSION['nif'] = "failed";
                $errores++;
            }
            //Validar nombre
            if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
                $_SESSION['nombre'] = "complete";
            } else {
                $_SESSION['nombre'] = "failed";
                $errores++;
            }
            //Validar apellido1
            if (!empty($apellido1) && !is_numeric($apellido1) && !preg_match("/[0-9]/", $apellido1)) {
                $_SESSION['apellido1'] = "complete";
            } else {
                $_SESSION['apellido1'] = "failed";
                $errores++;
            }
            //Validar apellido2
            if (!empty($apellido2) && !is_numeric($apellido2) && !preg_match("/[0-9]/", $apellido2)) {
                $_SESSION['apellido2'] = "complete";
            } else {
                $_SESSION['apellido2'] = "failed";
                $errores++;
            }
            //Validar username
            if (!empty($username)) {
                $_SESSION['username'] = "complete";
            } else {
                $_SESSION['username'] = "failed";
                $errores++;
            }
            //Validar password
            if (!empty($password) && preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/", $password)) {
                $_SESSION['password'] = "complete";
            } else {
                $_SESSION['password'] = "failed";
                $errores++;
            }
            //Validar email
            if (!empty($email) && preg_match("/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/", $email)) {
                $_SESSION['email'] = "complete";
            } else {
                $_SESSION['email'] = "failed";
                $errores++;
            }
            //Validar telefono
            if (!empty($telefono) && preg_match("/^(\+34|0034|34)?[8|9][0-9]{8}$/", $telefono)) {
                $_SESSION['telefono'] = "complete";
            } else {
                $_SESSION['telefono'] = "failed";
                $errores++;
            }
            //Validar movil
            if (!empty($movil) && preg_match("/^(\+34|0034|34)?[6|7][0-9]{8}$/", $movil)) {
                $_SESSION['movil'] = "complete";
            } else {
                $_SESSION['movil'] = "failed";
                $errores++;
            }
            //Validar paginaweb
            //if (preg_match("/^\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]$/", $paginaweb)) 
            if (!empty($paginaweb) || empty($paginaweb)) {
                $_SESSION['paginaweb'] = "complete";
            } else {
                $_SESSION['paginaweb'] = "failed";
                $errores++;
            }
            //Validar blog
            //if (preg_match("/^(http\:\/\/|https\:\/\/)?((w{3}\.)?)blogger\.com\/(?:#!\/)?(?:pages\/)?(?:[\w\-\.]*\/)*([\w\-\.]*)+$/", $blog)) 
            if (!empty($blog) || empty($blog)) {
                $_SESSION['blog'] = "complete";
            } else {
                $_SESSION['blog'] = "failed";
                $errores++;
            }
            //Validar twitter
            //if (preg_match("/^(https?:\/\/)?((w{3}\.)?)twitter\.com\/(#!\/)?[a-z0-9_]*$/", $twitter)) 
            if (!empty($twitter) || empty($twitter)) {
                $_SESSION['twitter'] = "complete";
            } else {
                $_SESSION['twitter'] = "failed";
                $errores++;
            }
            //Validar departamento
            if (!empty($departamento)) {
                $_SESSION['departamento'] = "complete";
            } else {
                $_SESSION['departamento'] = "failed";
                $errores++;
            }
            //Validar cursos
            if (!empty($cursos)) {
                $_SESSION['cursos'] = "complete";
            } else {
                $_SESSION['cursos'] = "failed";
                $errores++;
            }
            //Validar asignaturas
            if (!empty($asignaturas)) {
                $_SESSION['asignaturas'] = "complete";
            } else {
                $_SESSION['asignaturas'] = "failed";
                $errores++;
            }

            if (($errores == 0) && $nif && $nombre && $apellido1 && $apellido2 && $username && $perfil && $password && $email && $telefono && $movil && /* $paginaweb && $blog && $twitter && */ $departamento && $cursos && $asignaturas) {

                $usuario = new Usuario();
                $usuario->setNif($nif);
                $usuario->setNombre($nombre);
                $usuario->setApellido1($apellido1);
                $usuario->setApellido2($apellido2);
                $usuario->setUsername($username);
                $usuario->setPerfil($perfil);
                $usuario->setPassword($password);
                $usuario->setEmail($email);
                $usuario->setTelefono($telefono);
                $usuario->setMovil($movil);
                $usuario->setPaginaweb($paginaweb);
                $usuario->setBlog($blog);
                $usuario->setTwitter($twitter);
                $usuario->setDepartamento($departamento);
                $usuario->setCursos($cursos);
                $usuario->setAsignaturas($asignaturas);

                //Guardar la imagen
                if (isset($_FILES['fotografia'])) {
                    $file = $_FILES['fotografia'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true);
                        }
                        $usuario->setFotografia($filename);
                        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                    }
                }

                $save = $usuario->saveadmin();

                if ($save) {
                    $_SESSION['register'] = "complete";

                    /* Añadimos la accion a la tabla de log */
                    $id = $_SESSION['identity']->id;
                    $log = new Log();
                    $log->setId($id);
                    $log->setAccion('añadir');
                    $log->log();

                    header("Location:" . base_url . 'usuario/listado');
                } else {
                    $_SESSION['register'] = "failed";
                    header("Location:" . base_url . 'usuario/añadir');
                }
            } else {
                $_SESSION['register'] = "failed";
                header("Location:" . base_url . 'usuario/añadir');
            }
        } else {
            $_SESSION['register'] = "failed";
            header("Location:" . base_url . 'usuario/añadir');
        }
    }

    public function edit() {
        if (isset($_POST)) {

            $nif = isset($_POST['nif']) ? $_POST['nif'] : false;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellido1 = isset($_POST['apellido1']) ? $_POST['apellido1'] : false;
            $apellido2 = isset($_POST['apellido2']) ? $_POST['apellido2'] : false;
            $username = isset($_POST['username']) ? $_POST['username'] : false;
            $perfil = isset($_POST['perfil']) ? $_POST['perfil'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
            $movil = isset($_POST['movil']) ? $_POST['movil'] : false;
            $paginaweb = isset($_POST['paginaweb']) ? $_POST['paginaweb'] : false;
            $blog = isset($_POST['blog']) ? $_POST['blog'] : false;
            $twitter = isset($_POST['twitter']) ? $_POST['twitter'] : false;
            $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : false;
            $cursos = isset($_POST['cursos']) ? $_POST['cursos'] : false;
            $asignaturas = isset($_POST['asignaturas']) ? $_POST['asignaturas'] : false;

            /* -------------------- Validar los datos -------------------- */

            $errores = 0;

            //Validar nif
            if (!empty($nif) && preg_match("/[0-9]{8}-[A-Z]/", $nif)) {
                $_SESSION['nif'] = "complete";
            } else {
                $_SESSION['nif'] = "failed";
                $errores++;
            }
            //Validar nombre
            if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
                $_SESSION['nombre'] = "complete";
            } else {
                $_SESSION['nombre'] = "failed";
                $errores++;
            }
            //Validar apellido1
            if (!empty($apellido1) && !is_numeric($apellido1) && !preg_match("/[0-9]/", $apellido1)) {
                $_SESSION['apellido1'] = "complete";
            } else {
                $_SESSION['apellido1'] = "failed";
                $errores++;
            }
            //Validar apellido2
            if (!empty($apellido2) && !is_numeric($apellido2) && !preg_match("/[0-9]/", $apellido2)) {
                $_SESSION['apellido2'] = "complete";
            } else {
                $_SESSION['apellido2'] = "failed";
                $errores++;
            }
            //Validar username
            if (!empty($username)) {
                $_SESSION['username'] = "complete";
            } else {
                $_SESSION['username'] = "failed";
                $errores++;
            }
            //Validar password
            if (!empty($password) && preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/", $password)) {
                $_SESSION['password'] = "complete";
            } else {
                $_SESSION['password'] = "failed";
                $errores++;
            }
            //Validar email
            if (!empty($email) && preg_match("/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/", $email)) {
                $_SESSION['email'] = "complete";
            } else {
                $_SESSION['email'] = "failed";
                $errores++;
            }
            //Validar telefono
            if (!empty($telefono) && preg_match("/^(\+34|0034|34)?[8|9][0-9]{8}$/", $telefono)) {
                $_SESSION['telefono'] = "complete";
            } else {
                $_SESSION['telefono'] = "failed";
                $errores++;
            }
            //Validar movil
            if (!empty($movil) && preg_match("/^(\+34|0034|34)?[6|7][0-9]{8}$/", $movil)) {
                $_SESSION['movil'] = "complete";
            } else {
                $_SESSION['movil'] = "failed";
                $errores++;
            }
            //Validar paginaweb
            //if (preg_match("/^\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]$/", $paginaweb)) 
            if (!empty($paginaweb) || empty($paginaweb)) {
                $_SESSION['paginaweb'] = "complete";
            } else {
                $_SESSION['paginaweb'] = "failed";
                $errores++;
            }
            //Validar blog
            //if (preg_match("/^(http\:\/\/|https\:\/\/)?((w{3}\.)?)blogger\.com\/(?:#!\/)?(?:pages\/)?(?:[\w\-\.]*\/)*([\w\-\.]*)+$/", $blog)) 
            if (!empty($blog) || empty($blog)) {
                $_SESSION['blog'] = "complete";
            } else {
                $_SESSION['blog'] = "failed";
                $errores++;
            }
            //Validar twitter
            //if (preg_match("/^(https?:\/\/)?((w{3}\.)?)twitter\.com\/(#!\/)?[a-z0-9_]*$/", $twitter)) 
            if (!empty($twitter) || empty($twitter)) {
                $_SESSION['twitter'] = "complete";
            } else {
                $_SESSION['twitter'] = "failed";
                $errores++;
            }
            //Validar departamento
            if (!empty($departamento)) {
                $_SESSION['departamento'] = "complete";
            } else {
                $_SESSION['departamento'] = "failed";
                $errores++;
            }
            //Validar cursos
            if (!empty($cursos)) {
                $_SESSION['cursos'] = "complete";
            } else {
                $_SESSION['cursos'] = "failed";
                $errores++;
            }
            //Validar asignaturas
            if (!empty($asignaturas)) {
                $_SESSION['asignaturas'] = "complete";
            } else {
                $_SESSION['asignaturas'] = "failed";
                $errores++;
            }

            if (($errores == 0) || $nif || $nombre || $apellido1 || $apellido2 || $username || $perfil || $password || $email || $telefono || $movil || /* $paginaweb || $blog || $twitter || */ $departamento || $cursos || $asignaturas) {

                $usuario = new Usuario();
                $usuario->setNif($nif);
                $usuario->setNombre($nombre);
                $usuario->setApellido1($apellido1);
                $usuario->setApellido2($apellido2);
                $usuario->setUsername($username);
                $usuario->setPerfil($perfil);
                $usuario->setPassword($password);
                $usuario->setEmail($email);
                $usuario->setTelefono($telefono);
                $usuario->setMovil($movil);
                $usuario->setPaginaweb($paginaweb);
                $usuario->setBlog($blog);
                $usuario->setTwitter($twitter);
                $usuario->setDepartamento($departamento);
                $usuario->setCursos($cursos);
                $usuario->setAsignaturas($asignaturas);

                //Guardar la imagen
                if (isset($_FILES['fotografia'])) {
                    $file = $_FILES['fotografia'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true);
                        }
                        $usuario->setFotografia($filename);
                        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                    }
                }

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $usuario->setId($id);

                    $edit = $usuario->edit();
                }

                if ($edit) {
                    $_SESSION['register'] = "complete";

                    /* Añadimos la accion a la tabla de log */
                    $id = $_SESSION['identity']->id;
                    $log = new Log();
                    $log->setId($id);
                    $log->setAccion('editar');
                    $log->log();
                } else {
                    $_SESSION['register'] = "failed";
                }
            } else {
                $_SESSION['register'] = "failed";
            }
        } else {
            $_SESSION['register'] = "failed";
        }
        header("Location:" . base_url . 'usuario/listado');
    }

    public function listado() {
        //Comprobar si es admin utils::isadmin
        Utils::isAdministrador('administrador');

        $usuario = new Usuario();
        $listado = $usuario->getUsuarios();
        require_once 'views/nav.php';
        require_once 'views/listado.php';
    }

    public function editar() {
        //Comprobar si es admin utils::isadmin
        Utils::isAdministrador('administrador');

        $_SESSION['edit'] = 'edit';
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $usuario = new Usuario();
            $usuario->setId($id);

            $usu = $usuario->getUsuario();

            require_once 'views/añadir.php';
        } else {
            header("Location:" . base_url);
        }
    }

    public function delete() {
        //Comprobar si es admin utils::isadmin
        Utils::isAdministrador('administrador');

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $usuario = new Usuario();
            $usuario->setId($id);

            $delete = $usuario->delete();

            if ($delete) {
                $_SESSION['delete'] = 'complete';

                /* Añadimos la accion a la tabla de log */
                $id = $_SESSION['identity']->id;
                $log = new Log();
                $log->setId($id);
                $log->setAccion('borrar');
                $log->log();
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }
        header("Location:" . base_url . 'usuario/listado');
    }

    public function solicitudes() {
        //Comprobar si es admin utils::isadmin
        Utils::isAdministrador('administrador');

        $usuario = new Usuario();
        $solicitud = $usuario->getUsuarios_inactivos();
        require_once 'views/nav.php';
        require_once 'views/solicitudes.php';
    }

    public function aceptar() {
        //Comprobar si es admin utils::isadmin
        Utils::isAdministrador('administrador');

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $usuario = new Usuario();
            $usuario->setId($id);

            $usuario->aceptar();
        }
        header("Location:" . base_url . 'usuario/solicitudes');
    }

    public function rechazar() {
        //Comprobar si es admin utils::isadmin
        Utils::isAdministrador('administrador');

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $usuario = new Usuario();
            $usuario->setId($id);

            $usuario->rechazar();

            header("Location:" . base_url . 'usuario/solicitudes');
        }
    }
    
    public function log() {    
        Utils::isAdministrador('administrador');
        
        $log = new Log();
        $listado = $log->getLogs();
        require_once 'views/nav.php'; 
        require_once 'views/log.php';        
    }

    public function generarPDF() {
        header("Location:" . base_url . 'generarPDF/generarPDF.php');
    }

}
