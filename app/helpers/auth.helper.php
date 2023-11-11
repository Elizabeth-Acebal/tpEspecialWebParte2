<?php

require_once 'config.php';

function base64url_encode($data){
    return rtrim(strtr(base64_encode($data),'+/','-_'), '=');
}

class AuthHelper {

    
function getAuthHeader(){
    $header = "";
    if(isset($_SERVER['HTTP_AUTHORIZATION'])){
        $header = $_SERVER['HTTP_AUTHORIZATION'];
    }
    if(isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])){
        $header = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
    }
    return $header;
}

function createToken($payload){
   $header = array(
     'alg' => 'HS256',
     'typ' => 'JWT'
    );

    $header = base64url_encode(json_encode($header));
    $payload = base64url_encode(json_encode($payload));
    
    $firma = hash_hmac('SHA256', "$header.$payload", JWT_KEY, true);
    $firma = base64url_encode($firma);

    $token = "$header.$payload.$firma";

    return $token;
}

function verify($token){
    $token = explode(".", $token);

    $header = $token[0];
    $payload = $token[1];
    $firma = $token[2];

    $new_firma = hash_hmac('SHA256', "$header.$payload", JWT_KEY, true);
    $new_firma = base64url_encode($new_firma);

    if($firma != $new_firma){
        return false;
    }

    $payload = json_decode(base64_decode($payload));

    return $payload;
}

function currentUser(){
    $auth = $this->getAuthHeader();
    $auth = explode(" ", $auth);

    if($auth[0] != "Bearer"){
        return false;
    }

    return $this->verify($auth[1]);
}

}

?>