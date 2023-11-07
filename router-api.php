<?php
require_once 'libs/Router.php';

// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('peliculas', 'GET', 'peliculaApiController', 'getPeliculaConGenero');
$router->addRoute('peliculas/:ID', 'GET', 'peliculaApiController', 'obtenerPelicula');

$router->addRoute('tareas', 'POST', 'TaskApiController', 'crearTarea');


// rutea le paso el recurso, y el metodo
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);