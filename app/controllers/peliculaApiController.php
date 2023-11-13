<?php

require_once 'app/models/pelicula.model.php';
require_once 'app/models/auth.model.php';
require_once 'app/views/api.view.php';
require_once 'app/helpers/auth.helper.php';
require_once 'app/controllers/api.controller.php';

class PeliculaApiController extends ApiController
{
  private $model;
  private $authHelper;

  function __construct()
  {
    parent::__construct();
    $this->model = new PeliculaModel();
    $this->authHelper = new authHelper();
  }

  // $user =  $this->authHelper->currentUser();
  //if(!$user){
  // $this ->view-> response('Sin autorización', 401);
  // return;
  // }

  // if($user->role !='admin'){
  //  $this ->view-> response('Forbidden', 403);
  //  return;
  // }
  function get($params = [])
  {

    if (empty($params)) {
      $peliculas = $this->model->getPeliculas();
      $this->view->response($peliculas, 200);
      return;
    }
    if (!empty($pelicula)) {
      return $this->view->response($pelicula, 200);
    } else {
      $pelicula =  $this->model->ShowPeliculaDetalle($params[":ID"]);
      if (!empty($pelicula)) {
        return $this->view->response($pelicula, 200);
      } else {
        $this->view->response(['msg' => 'La pelicula con el id=' . $params[':ID'] . ' no existe'], 404);
        return;
      }
    }
  }



  function getPorGenero($parms = [])
  {
    if (empty($parms)) {
      $peliculas = $this->model->getPeliculas();
      $this->view->response($peliculas, 200);
    }
    if (!empty($pelicula)) {
      return $this->view->response($pelicula, 200);
    } else {
      $pelicula =  $this->model->getPeliculaPorGenero($parms[":id_genero"]);
      if (!empty($pelicula)) {
        return $this->view->response($pelicula, 200);
      } else {
        $this->view->response(['msg' => 'La pelicula con el id_genero=' . $parms[':id_genero'] . ' no existe'], 404);
      }
    }
  }


  public function delete($params = null)
  {
    $pelicula_id = $params[':ID'];
    $success = $this->model->eliminarPelicula($pelicula_id);
    if ($success) {
      $this->view->response("La pelicula con el id=$pelicula_id se borró exitosamente", 200);
    } else {
      $this->view->response("La pelicula con el id=$pelicula_id no existe", 404);
    }
  }

  public function modificar($params = null)
  {
    $body = $this->getData();
    try {
      if ($this->existData($this->getData())) {
        $pelicula_id = $params[':ID'];
        $this->model->editarPelicula($body->titulo, $body->descripcion, $body->director,  $body->calificacion, $body->id_genero, $pelicula_id);
        $this->view->response("Se actualizo la pelicula con el id=$pelicula_id exitosamente", 200);
      } else {
        $this->view->response("No se pudo actualizar la pelicula", 500);
      }
    } catch (exception) {
      $this->view->response("El servidor no pudo interpretar la solicitud dada una sintaxis invalida", 500);
    }
  }



  function create($params = [])
  {
    $body = $this->getData();

    try {
      if ($this->existData($this->getData())) {
        $id = $this->model->agregarPelicula($body->titulo, $body->descripcion, $body->director,  $body->calificacion, $body->id_genero);
        $this->view->response('la pelicula fue insertada con el id=' . $id, 201);
      } else {
        $this->view->response("No se pudo insertar la pelicula, faltan datos", 400);
      }
    } catch (exception) {
      $this->view->response("El servidor no pudo interpretar la solicitud dada una sintaxis invalida", 500);
    }
  }



  function getColumns($param)
  {
    $columns = $this->model->getAllColumns();
    for ($i = 0; $i < sizeof($columns); $i++) {
      $aux = $columns[$i]->COLUMN_NAME;
      if ($aux == $param) {
        return $param;
      }
    }
    return null;
  }

  function existData($param)
  {
    if ($param != null) {
      $param->pelicula_id = "skipped";
    }
    $columns = $this->model->getAllColumns();
    for ($i = 0; $i < sizeof($columns); $i++) {
      $aux = $columns[$i]->COLUMN_NAME;
      if (empty($param->$aux)) {
        return false;
      }
    }
    return true;
  }
}
