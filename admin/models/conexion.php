<?php
class Conexion {
    public function __construct() { 
        require_once 'config/config_db.php';
        $this->conexion = new mysqli(HOST, USER, PASSWORD, DATABASE);
        //activar el modo estricto en esta conexion 
        $this->conexion->query("SET SESSION sql_mode = 'STRICT_ALL_TABLES'");
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    }
}
