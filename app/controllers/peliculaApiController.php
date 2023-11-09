<?php
    require_once 'app/models/pelicula.model.php';
    require_once 'app/models/genero.model.php';
    require_once 'app/views/api.view.php';
    require_once 'app/helpers/auth.helper.php';

    class peliculaApiController{

        private $peliculaModel;
        private $generoModel;
        private $view;
        private $authHelper;
        private $data;

        function __construct(){
            $this->peliculaModel = new PeliculaModel;
            $this->generoModel= new GeneroModel;
            $this->view= new APIview;

            $this->data = file_get_contents("php://input");

        }

        public function getData(){
            return json_decode($this->data);
        }

        public function getAll($params=null){
            $peliculas=$this->peliculaModel->getPeliculas();
            var_dump($peliculas);
        }

        public function getPeliculasConGenero($params=null){
            $peliculasGenero=$this->peliculaModel->getPeliculaConGenero();
            $this->view->response($peliculasGenero, 200);
           // var_dump($peliculasGenero);
        }

        public function delete($params=null){
            $pelicula_id= $params[':ID'];
            $success= $this->peliculaModel->eliminarPelicula($pelicula_id);
            if($success){
            $this->view->response("La pelicula con el id=$pelicula_id se borró exitosamente",200);
            }else{
                $this->view->response("La pelicula con el id=$pelicula_id no existe",404);
            }
        }
        
        public function modificar($params=null){
            $pelicula_id= $params[':ID'];
            $body=$this->getData();
        
            $titulo= $body->titulo;
            $descripcion= $body->descripcion;
            $director= $body-> director;
            $calificacion= $body-> calificacion;
            $id_genero= $body->id_genero;
    

            $success= $this->peliculaModel->editarPelicula($titulo, $descripcion, $director, $calificacion,$id_genero,$pelicula_id);

            if($success){
                $this->view->response("Se actualizo la pelicula con el id=$pelicula_id exitosamente",200);

            }else{
                $this->view->response("No se pudo actualizar la pelicula",500);
            }


        }



    }