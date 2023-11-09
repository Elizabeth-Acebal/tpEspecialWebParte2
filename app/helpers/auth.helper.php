<?php

class AuthHelper {
    public function __construct(){
        session_start();
    }
    

    //BARRERA DE SEGURIDAD PARA USUARIO LOGUEADO
    /**
     * Verifica que el user este logueado y si no lo está
     * lo redirige al login.
     */
    function checkLogged(){
       // session_start();
        if(!isset($_SESSION['IS_LOGGED'])){
            header("Location: " . BASE_URL . 'login');
            die();
        }
    }

}

?>