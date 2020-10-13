<?php

class Usuario {

    private $id;
    private $nif;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $username;
    private $perfil;
    private $password;
    private $email;
    private $fotografia;
    private $telefono;
    private $movil;
    private $paginaweb;
    private $blog;
    private $twitter;
    private $departamento;
    private $cursos;
    private $asignaturas;
    private $fecha;
    private $activo;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    function getId() {
        return $this->id;
    }

    function getNif() {
        return $this->nif;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido1() {
        return $this->apellido1;
    }

    function getApellido2() {
        return $this->apellido2;
    }

    function getUsername() {
        return $this->username;
    }

    function getPerfil() {
        return $this->perfil;
    }

    function getPassword() {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    function getEmail() {
        return $this->email;
    }

    function getFotografia() {
        return $this->fotografia;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getMovil() {
        return $this->movil;
    }

    function getPaginaweb() {
        return $this->paginaweb;
    }

    function getBlog() {
        return $this->blog;
    }

    function getTwitter() {
        return $this->twitter;
    }

    function getDepartamento() {
        return $this->departamento;
    }

    function getCursos() {
        return $this->cursos;
    }

    function getAsignaturas() {
        return $this->asignaturas;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getActivo() {
        return $this->activo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNif($nif) {
        $this->nif = $this->db->real_escape_string($nif);
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setApellido1($apellido1) {
        $this->apellido1 = $this->db->real_escape_string($apellido1);
    }

    function setApellido2($apellido2) {
        $this->apellido2 = $this->db->real_escape_string($apellido2);
    }

    function setUsername($username) {
        $this->username = $this->db->real_escape_string($username);
    }

    function setPerfil($perfil) {
        $this->perfil = $this->db->real_escape_string($perfil);
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setEmail($email) {
        $this->email = $this->db->real_escape_string($email);
    }

    function setFotografia($fotografia) {
        $this->fotografia = $fotografia;
    }

    function setTelefono($telefono) {
        $this->telefono = $this->db->real_escape_string($telefono);
    }

    function setMovil($movil) {
        $this->movil = $this->db->real_escape_string($movil);
    }

    function setPaginaweb($paginaweb) {
        $this->paginaweb = $this->db->real_escape_string($paginaweb);
    }

    function setBlog($blog) {
        $this->blog = $this->db->real_escape_string($blog);
    }

    function setTwitter($twitter) {
        $this->twitter = $this->db->real_escape_string($twitter);
    }

    function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    function setCursos($cursos) {
        $this->cursos = $cursos;
    }

    function setAsignaturas($asignaturas) {
        $this->asignaturas = $asignaturas;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    public function getUsuarios() {
        $usuarios = $this->db->query("SELECT * FROM usuario WHERE username != 'root' AND activo = 1;");
        return $usuarios;
    }

    public function getUsuarios_inactivos() {
        $usuarios = $this->db->query("SELECT * FROM usuario WHERE username != 'root' AND activo = 0;");
        return $usuarios;
    }

    public function getUsuario() {
        $usuario = $this->db->query("SELECT * FROM usuario WHERE id = {$this->getId()}");
        return $usuario->fetch_object();
    }

    public function login() {
        $result = false;
        $username = $this->username;
        $password = $this->password;

        // Comprobar si existe el usuario
        $sql = "SELECT * FROM usuario WHERE username = '$username' AND activo = 1";
        $login = $this->db->query($sql);

        if ($login && $login->num_rows == 1) {
            $usuario = $login->fetch_object();

            //Verificar la contraseña
            $verify = password_verify($password, $usuario->password);

            if ($verify) {
                $result = $usuario;
            }
        }
        return $result;
    }

    public function save() {
        $sql = "INSERT INTO usuario VALUES("
                . "NULL,"
                . "'{$this->getNif()}',"
                . "'{$this->getNombre()}',"
                . "'{$this->getApellido1()}',"
                . "'{$this->getApellido2()}',"
                . "'{$this->getUsername()}',"
                . "'profesor',"
                . "'{$this->getPassword()}',"
                . "'{$this->getEmail()}',"
                . "'{$this->getFotografia()}',"
                . "'{$this->getTelefono()}',"
                . "'{$this->getMovil()}',"
                . "'{$this->getPaginaweb()}',"
                . "'{$this->getBlog()}',"
                . "'{$this->getTwitter()}', "
                . "'{$this->getDepartamento()}',"
                . "'{$this->getCursos()}',"
                . "'{$this->getAsignaturas()}', "
                . "CURRENT_TIME(), 0);";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function saveadmin() {
        $sql = "INSERT INTO usuario VALUES("
                . "NULL,"
                . "'{$this->getNif()}',"
                . "'{$this->getNombre()}',"
                . "'{$this->getApellido1()}',"
                . "'{$this->getApellido2()}',"
                . "'{$this->getUsername()}',"
                . "'{$this->getPerfil()}',"
                . "'{$this->getPassword()}',"
                . "'{$this->getEmail()}',"
                . "'{$this->getFotografia()}',"
                . "'{$this->getTelefono()}',"
                . "'{$this->getMovil()}',"
                . "'{$this->getPaginaweb()}',"
                . "'{$this->getBlog()}',"
                . "'{$this->getTwitter()}', "
                . "'{$this->getDepartamento()}',"
                . "'{$this->getCursos()}',"
                . "'{$this->getAsignaturas()}', "
                . "CURRENT_TIME(), 1);";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function edit() {
        $sql = "UPDATE usuario SET "
                . "nif='{$this->getNif()}',"
                . "nombre='{$this->getNombre()}',"
                . "apellido1='{$this->getApellido1()}',"
                . "apellido2='{$this->getApellido2()}',"
                . "username='{$this->getUsername()}',"
                . "perfil='{$this->getPerfil()}',"
                . "password='{$this->getPassword()}',"
                . "email='{$this->getEmail()}'";

        if ($this->getFotografia() != null) {
            $sql .= ", fotografia='{$this->getFotografia()}'";
        }
        $sql .= ", telefono='{$this->getTelefono()}'";
        $sql .= ", movil='{$this->getMovil()}'";
        $sql .= ", paginaweb='{$this->getPaginaweb()}'";
        $sql .= ", blog='{$this->getBlog()}'";
        $sql .= ", twitter='{$this->getTwitter()}'";
        $sql .= ", departamento='{$this->getDepartamento()}'";
        $sql .= ", cursos='{$this->getCursos()}'";
        $sql .= ", asignaturas='{$this->getAsignaturas()}'";
        $sql .= "WHERE id = {$this->getId()};";

        $edit = $this->db->query($sql);

        $result = false;
        if ($edit) {
            $result = true;
        }
        return $result;
    }

    public function delete() {
        $sql = "DELETE FROM usuario WHERE id={$this->id}";
        $delete = $this->db->query($sql);

        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }

    public function aceptar() {
        $sql = "UPDATE usuario SET activo = 1 WHERE id = {$this->getId()};";
        $aceptar = $this->db->query($sql);

        $result = false;
        if ($aceptar) {
            $result = true;
        }
        return $result;
    }

    public function rechazar() {
        $sql = "DELETE FROM usuario WHERE id={$this->id};";
        $rechazar = $this->db->query($sql);

        $result = false;
        if ($rechazar) {
            $result = true;
        }
        return $result;
    }
    
}
