<?php
    require_once 'app/models/pelicula.model.php';
    require_once 'app/views/api.view.php';
    require_once 'app/helpers/auth.helper.php';

    class peliculaApiController{

        private $peliculaModel;
        private $view;
        private $authHelper;
        private $data;

        function __construct(){
            $this->peliculaModel = new PeliculaModel;
            $this->view= new APIview;
            $this->authHelper= new AuthHelper;
            $this->data = file_get_contents("php://input");

        }

        public function getData(){
            return json_decode($this->data);
        }

        function get($params =null){

            $pelicula_id= $params[":ID"];
            $pelicula =  $this->peliculaModel->ShowPeliculaDetalle($pelicula_id);
            if($pelicula){
                $this->view->response($pelicula, 200);
            }else{
                $this->view->response( 'La pelicula con el id='.$params[':ID'].' no existe', 404);
            }
        }

        public function getAll($params=null){  
            //arreglo vacio
            $parametros=[];

            if(isset($_GET['sort'])){
                $parametros['sort'] = $_GET['sort'];
            }

            if(isset($_GET['order'])){
                $parametros['order'] = $_GET['order'];
            }

            //print_r($parametros);
           // die(__FILE__);


            $peliculasGenero=$this->peliculaModel->getPeliculaConGenero($parametros);
            $this->view->response($peliculasGenero, 200);
           // var_dump($peliculasGenero);
        }

        public function delete($params=null){
            if(!$this->authHelper->isLoggedIn()){
                $this->view->response("Necesitas loguearte para poder realizar esta accion", 401);
                return;
            }

            $pelicula_id= $params[':ID'];
            $success= $this->peliculaModel->eliminarPelicula($pelicula_id);
            if($success){
            $this->view->response("La pelicula con el id=$pelicula_id se borró exitosamente",200);
            }else{
                $this->view->response("La pelicula con el id=$pelicula_id no existe",404);
            }
        }

        public function create($params = null) {
            if(!$this->authHelper->isLoggedIn()){
                $this->view->response("Necesitas loguearte para poder realizar esta accion", 401);
                return;
            }

            $body = $this->getData();
            try{
                if ($this->existData($this->getData())) {
                    $pelicula_id = $this->peliculaModel-> agregarPelicula($body->titulo, $body->descripcion, $body->director, $body->calificacion, $body->id_genero);
                    $this->view->response('la pelicula fue insertada con el id='.$pelicula_id,201);
                }else{
                    $this->view->response("Falta llenar algun campo", 400);
                }

            }catch(Exception){
                $this->view->response("El servidor no pudo interpretar la solicitud dada una sintaxis invalida", 500);
            }

        }
        
        public function modificar($params=null){
            if(!$this->authHelper->isLoggedIn()){
                $this->view->response("Necesitas loguearte para poder realizar esta accion", 401);
                return;
            }
            $body=$this->getData();

            try{
                if ($this->existData($this->getData())){
                    $pelicula_id= $params[':ID'];
                    
                    $this->peliculaModel->editarPelicula($body->titulo, $body->descripcion, $body->director, $body->calificacion, $body->id_genero, $pelicula_id);
                    $this->view->response("Se actualizo la pelicula con el id=$pelicula_id exitosamente",200);

                }else{
                    $this->view->response("No se pudo actualizar la pelicula,completar todos los campos",400);
                }

            }catch(Exception){
                $this->view->response("El servidor no pudo interpretar la solicitud dada una sintaxis invalida", 500);
            }
        }

        function getColumns($param){
            $columns = $this->peliculaModel->getAllColumns();
            for ($i = 0; $i < sizeof($columns); $i++) {
                $aux = $columns[$i]->COLUMN_NAME;
                if ($aux == $param) {
                    return $param;
                }
            }
            return null;
        }

        function existData($param){
            if ($param != null){
                $param->pelicula_id = "skipped";
                $param->imagen = "skipped";
            }
            $columns = $this->peliculaModel->getAllColumns();
        
            foreach ($columns as $column) {
                $aux = $column->COLUMN_NAME;
                if (empty($param->$aux)) {
                    echo "Campo $aux está vacío.";
                    return false;
                }
            }
        
            return true;
        }



    }