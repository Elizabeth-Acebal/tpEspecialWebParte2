<?php
  require_once 'libs/router.php';
  require_once 'app/controllers/pelicula.api.controller.php';


  $router = new Router();


  $router -> addRoute('peliculas', 'GET', 'PeliculaApiController', 'get');
  $router -> addRoute('peliculas/:ID', 'GET', 'PeliculaApiController', 'get');
  $router -> addRoute('peliculas/:ID', 'DELETE', 'PeliculaApiController', 'delete');
  

  $router -> route($_GET['resource'], $_SERVER['REQUEST_METHOD']);