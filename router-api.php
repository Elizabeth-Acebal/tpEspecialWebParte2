<?php
require_once 'libs/Router.php';
require_once 'app/controllers/peliculaApiController.php';
require_once 'app/controllers/authApiController.php';

// crea el router
$router = new Router();

// define la tabla de ruteo

$router->addRoute('peliculas', 'GET', 'peliculaApiController', 'getAll');
$router-> addRoute('peliculas/:ID', 'GET', 'peliculaApiController', 'get');
$router->addRoute('peliculas/:ID', 'DELETE', 'peliculaApiController', 'delete');
$router-> addRoute('peliculas', 'POST', 'peliculaApiController', 'create');
$router->addRoute('peliculas/:ID', 'PUT', 'peliculaApiController', 'modificar');
$router->addRoute('user/token', 'GET', 'authApiController', 'getToken');


//$router-> addRoute('generos/:id_genero', 'GET', 'peliculaApiController', 'getPorGenero');


// rutea le paso el recurso, y el metodo
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);