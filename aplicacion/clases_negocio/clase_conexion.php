<?php

class Conexion extends PDO {

    private $tipo_de_base = 'mysql';
    private $host = '127.0.0.1';
    private $nombre_de_base = 'sgoa';
    private $usuario = 'root';
    private $contrasena = '';

    public function __construct() {
        //Sobreescribo el método constructor de la clase PDO.
        try {
            parent::__construct($this->tipo_de_base . ':host=' . $this->host . ';dbname=' . $this->nombre_de_base.';charset=utf8', $this->usuario, $this->contrasena);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
            exit;
        }
    }
}
?>
