<?php

require_once 'app/models/pelicula.model.php';
require_once 'app/models/genero.model.php';
require_once 'app/models/auth.model.php';
require_once 'app/views/api.view.php';
require_once 'app/controllers/api.controller.php';

     class PeliculaApiController extends ApiController {
       private $model;

       function __construct() {
         parent::__construct();
         $this -> model = new PeliculaModel();
         
       }


       function get($params =[]) {
         if (empty($params)){
           $peliculas = $this->model->getPeliculas();
           $this ->view-> response($peliculas, 200);
          }
          else{
            $pelicula =  $this->model->getPelicula($params[":ID"]);
            if(!empty($pelicula)){
              return $this->view->response($pelicula, 200);
            }
            else{
              $this->view->response(['msg' => 'La tarea con el id='.$params[':ID'].' no existe'], 404);
            }
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

