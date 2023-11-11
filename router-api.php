<?php
  require_once 'libs/router.php';
  require_once 'app/controllers/peliculaApiController.php';
  //require_once 'app/controllers/UserApiController.php';
  


  $router = new Router();


  $router -> addRoute('peliculas', 'GET', 'PeliculaApiController', 'get');
  $router -> addRoute('peliculas/:ID', 'GET', 'PeliculaApiController', 'get');
  $router -> addRoute('generos/:id_genero', 'GET', 'PeliculaApiController', 'getPorGenero');
  $router -> addRoute('peliculas', 'POST', 'PeliculaApiController', 'create');
  $router -> addRoute('peliculas/:ID', 'DELETE', 'PeliculaApiController', 'delete');
  $router -> addRoute('peliculas/:ID', 'PUT', 'peliculaApiController', 'modificar');
 // $router -> addRoute('user/token', 'GET', 'UserApiController', 'getToken');


  //http://localhost/tpEspecialWeb2Parte2/api/peliculasConGenero/57
/*{

    "titulo": "Pelicula Modificada",
    "descripcion":"Pelicula modificada en postman",
    "director": "juan perez",
    "calificacion": "apta ",
    "id_genero": 1
}*/




// rutea le paso el recurso, y el metodo

  $router -> route($_GET['resource'], $_SERVER['REQUEST_METHOD']);