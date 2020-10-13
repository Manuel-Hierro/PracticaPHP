<?php

class Log {

    private $id;
    private $usuario_id;
    private $fecha_y_hora_de_actividad;
    private $accion;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    function getId() {
        return $this->id;
    }

    function getUsuario_id() {
        return $this->usuario_id;
    }

    function getFecha_y_hora_de_actividad() {
        return $this->fecha_y_hora_de_actividad;
    }

    function getAccion() {
        return $this->accion;
    }

    function setId($id) {
        $this->id = $this->db->real_escape_string($id);
    }

    function setUsuario_id($usuario_id) {
        $this->usuario_id = $this->db->real_escape_string($usuario_id);
    }

    function setFecha_y_hora_de_actividad($fecha_y_hora_de_actividad) {
        $this->fecha_y_hora_de_actividad = $this->db->real_escape_string($fecha_y_hora_de_actividad);
    }

    function setAccion($accion) {
        $this->accion = $this->db->real_escape_string($accion);
    }
    /*
    public function getLogs() {
        $log = $this->db->query("SELECT * FROM log");
        return $log;
    }
     */
    public function getLogs() {
        $log = $this->db->query("SELECT * FROM usuario, log WHERE usuario.id = log.usuario_id");
        return $log;
    }

    public function log() {
        $sql = "INSERT INTO log VALUES("
                . "NULL,"
                . "'{$this->getId()}',"
                . "CURRENT_TIME(),"
                . "'{$this->getAccion()}');";
        $log = $this->db->query($sql);

        $result = false;
        if ($log) {
            $result = true;
        }
        return $result;
    }

}
