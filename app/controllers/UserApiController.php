<?php


require_once 'app/models/auth.model.php';
require_once 'app/views/api.view.php';
require_once 'app/controllers/api.controller.php';
require_once 'app/helpers/auth.helper.php';

     class UserApiController extends ApiController {
       private $model;
       private $authHelper;

       function __construct() {
         parent::__construct();
         $this -> model = new AuthModel();
         $this -> authHelper = new authHelper();
         
       }


            function getToken($params =[]) {
                $basic = $this->authHelper->getAuthHeader();
                if (empty($basic)){
                $this ->view-> response('No envió encabezados de autenticación', 401);
                return;
                }

                $basic = explode(" ", $basic);

                if($basic[0]!="basic"){
                    $this ->view-> response('Los encabezados de autenticación son incorrectos', 401);
                    return;
                }

            $userpass = base64_decode($basic[1]);
            $userpass = explode(":", $userpass);

            $user = $userpass[0];
            $pass = $userpass[1];

            
            //esta parte hay que rearmarla y llamar a la db
            $userdata = ["name" => $user, "id" => 123, "role" => 'user'];

           if($user == "Joel" && $pass == "admin"){
             $this ->authHelper->createToken($user);
           }else{
             $this ->view-> response('El usuario o contraseña son incorrectos', 401);
           }
        }


        
        }
       