<?php
class Conexion {
    public function __construct() { 
        require_once 'config/config_db.php';
        $this->conexion = new mysqli(HOST, USER, PASSWORD, DATABASE);
    }
}
