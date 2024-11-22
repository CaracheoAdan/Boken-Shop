<?php 
require_once('config.class.php');

class sistema {
    var $con;
    
    function conexion() {
        try {
            $this->con = new PDO(SGBD.':host='.DBHOST.';dbname='.DBNAME.';port='.DBPORT, DBUSER, DBPASS);
            return $this->con;
        } catch (PDOException $e) {
            echo "Error en la conexión: " . $e->getMessage();
        }
    }
}
?>