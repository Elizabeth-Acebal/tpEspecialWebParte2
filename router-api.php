<?php
require_once 'libs/Router.php';
require_once 'app/controllers/peliculaApiController.php';

// crea el router
$router = new Router();
echo "nuevo";
// define la tabla de ruteo
$router->addRoute('peliculas', 'GET', 'peliculaApiController', 'getAll');
$router->addRoute('peliculasConGenero', 'GET', 'peliculaApiController', 'getPeliculasConGenero');

$router->addRoute('peliculasConGenero/:ID', 'DELETE', 'peliculaApiController', 'delete');

$router->addRoute('peliculasConGenero/:ID', 'PUT', 'peliculaApiController', 'modificar');
//http://localhost/tpEspecialWeb2Parte2/api/peliculasConGenero/57
/*{

    "titulo": "Pelicula Modificada",
    "descripcion":"Pelicula modificada en postman",
    "director": "juan perez",
    "calificacion": "apta ",
    "id_genero": 1
}*/




// rutea le paso el recurso, y el metodo
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);