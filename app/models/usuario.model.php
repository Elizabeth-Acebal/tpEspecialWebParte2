<?php

class UsuarioModel {

    private $db;

    function __construct() {
        $this->db = new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB.";charset=utf8", 
        MYSQL_USER, MYSQL_PASS);
    }

     /**
     * Retorna un usuario según el email pasado.
     */
    public function getByEmail($email) {
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

}
?>