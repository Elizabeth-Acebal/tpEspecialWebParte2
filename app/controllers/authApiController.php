<?php
    require_once 'app/models/usuario.model.php';
    require_once 'app/views/api.view.php';
    require_once 'app/helpers/auth.helper.php';

    function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    class AuthApiController{

        
    private $view;
    private $model;
    private $authHelper;
    private $data;
    
    public function __construct() {
        $this->view = new APIview();
        $this->model = new UsuarioModel();
        $this->authHelper = new AuthHelper();

        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    function getToken($params=null){

        $basic = $this->authHelper->getAuthHeaders(); //da el header "authorization"
            if(empty($basic)){
                $this->view->response("NO AUTORIZADO..No se envió encabezados de autenticación",401);
                return;
            }

            $basic = explode(" ", $basic);
            if($basic[0] != "Basic") {
                $this->view->response("LA AUTENTICACION DEBE SER BASIC--Los encabezados de autenticación son incorrectos.",401);
                return;
            }

            $userpass = base64_decode($basic[1]); //userpass
            $userpass = explode(":", $userpass); // [user, pass]

            $email = $userpass[0];
            $password = $userpass[1];
            $account = $this->model->getByEmail($email);

            if($email == $account->email && password_verify($password, $account->password)){
                //ENCABEZADO
                $header = array(
                    'alg' => 'HS256',
                    'typ' => 'JWT'
                );
                $payload = array(
                    'id' => $account->id_usuario,
                    'email' => $account->email,
                    'exp' => time()+3600
                );
        
                $payload['exp'] = time() + 5000;
        
                $header =base64url_encode(json_encode($header));
                $payload = base64url_encode(json_encode($payload));
        
                $signature=hash_hmac('SHA256', "$header.$payload", JWT_KEY, true);
                $signature = base64url_encode($signature);
                $token = "$header.$payload.$signature";

                //devuelve un nuevo token si es valido
                $this->view->response($token,200);
            }else{
                $this->view->response("El usuario o contraseña son incorrectos",401);
            }
    }


    }