<?php

require_once 'app/models/pelicula.model.php';
require_once 'app/models/auth.model.php';
require_once 'app/views/api.view.php';
require_once 'app/helpers/auth.helper.php';
require_once 'app/controllers/api.controller.php';

     class PeliculaApiController extends ApiController {
       private $model;
       private $authHelper;

       function __construct() {
         parent::__construct();
         $this -> model = new PeliculaModel();
         $this -> authHelper = new authHelper();
         
       }


       function get($params =[]) {
        // $user =  $this->authHelper->currentUser();
         //if(!$user){
         // $this ->view-> response('Sin autorización', 401);
         // return;
        // }

        // if($user->role !='admin'){
        //  $this ->view-> response('Forbidden', 403);
        //  return;
        // }

         if (empty($params)){
           $peliculas = $this->model->getPeliculas();
           $this ->view-> response($peliculas, 200);
           return;
          }
          if(!empty($pelicula)){
            return $this->view->response($pelicula, 200);
            }
          
          else{
            $pelicula =  $this->model->getPelicula($params[":ID"]);
            if(!empty($pelicula)){
              return $this->view->response($pelicula, 200);
            }
            else{
              $this->view->response(['msg' => 'La pelicula con el id='.$params[':ID'].' no existe'], 404);
              return;
            }
          }
       }

       function getPorGenero($parms = []){
        if (empty($parms)){
          $peliculas = $this->model->getPeliculas();
          $this ->view-> response($peliculas, 200);
         }
         if(!empty($pelicula)){
           return $this->view->response($pelicula, 200);
           }
         
         else{
           $pelicula =  $this->model->getPeliculaPorGenero($parms[":id_genero"]);
           if(!empty($pelicula)){
             return $this->view->response($pelicula, 200);
           }
           else{
             $this->view->response(['msg' => 'La pelicula con el id_genero='.$parms[':id_genero'].' no existe'], 404);
           }
         }    

       }


       public function delete($params=null){
        $pelicula_id= $params[':ID'];
        $success= $this->model->eliminarPelicula($pelicula_id);
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


        $success= $this->model->editarPelicula($titulo, $descripcion, $director, $calificacion,$id_genero,$pelicula_id);

        if($success){
            $this->view->response("Se actualizo la pelicula con el id=$pelicula_id exitosamente",200);

        }else{
            $this->view->response("No se pudo actualizar la pelicula",500);
        }


    }

       function create($params = []) {
         $body = $this->getData();

         
         $titulo = $body->titulo;
         $descripcion = $body->descripcion;
         $director = $body->director;
         $calificacion = $body->calificacion;
         $id_genero = $body->id_genero;

         $id = $this -> model -> agregarPelicula($titulo, $descripcion, $director, $calificacion, $id_genero);
         $this->view->response('la pelicula fue insertada con el id='.$id,201);
       }

     }

