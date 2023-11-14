# tpEspecial-web2

API REST para el recurso de peliculas

Importar la base de datos

importar desde PHPMyAdmin (o cualquiera) db_peliculas.sql

Prueba con postman El endpoint de la API es: http://localhost/tpEspecialWeb2Parte2/api/peliculas

ENDPOINTS PARA UNA API RESTFUL

----Endpoint para mostrar todas las peliculas(GET)----

/peliculas

Ej: http://localhost/tpEspecialWeb2Parte2/api/peliculas

Para traer todas las peliculas se utiliza el metodo GET para RECUPERAR un recurso. El código de respuesta es 200.

----Endpoint para mostrar una pelicula en particular(GET)----

/peliculas/:id

Ej: 

Para traer una pelicula en particular se utiliza el metodo GET para RECUPERAR, pero se debe especificar el id de la pelicula que se quiere traer en la ruta de la api.

El código de respuesta es 200.

----Endpoint para crear una pelicula(POST)----

/peliculas

Ej:  http://localhost/tpEspecialWeb2Parte2/api/peliculas

Para agregar una pelicula se utiliza el metodo POST para CREAR un nuevo recurso.

Para crear una pelicula se debe escribir un JSON de esta forma en el BODY: {  } El id de la pelicula se creará automaticamente.

El código de respuesta es 201.

----Endpoint para eliminar una pelicula en particular(DELETE)----

/peliculas/:id

Ej: http://localhost/tpEspecialWeb2Parte2/api/peliculas/57

Para borrar una pelicula se utiliza el metodo DELETE para eliminar un recurso, pero se debe especificar el id de la pelicula que se quiere eliminar en la ruta de la api.

El código de respuesta es 200.

----Endpoint para modificar un show en particular(PUT)----

/peliculas/:id

Ej: http://localhost/tpEspecialWeb2Parte2/api/peliculas/61

Para modificar una pelicula se utiliza el metodo PUT para EDITAR un recurso, pero se debe especificar el id de la pelicula que se quiere editar en la ruta de la api. En el cuerpo de la petición irá la representación completa del recurso.

Para editar una pelicula se debe escribir un JSON de esta forma en el BODY:

{   "titulo": "CUANDO ACECHA LA MALDAD",
    "descripcion":"Un hombre es encarnado por un demonio en la ruralidad de un pueblo perdido, lejos de las grandes ciudades. Dos hermanos encuentran a este hombre a punto de dar a luz al mal y advierten a los vecinos del pueblo sobre el horror que está por estallar. Deciden deshacerse del hombre encarnado, pero lo único que logran es acelerar el proceso. El demonio ha nacido y empieza a dejar su inconfundible rastro de maldad. Deberán huir antes de que la locura y la destrucción los arrastre consigo.",
    "director": "Demian Rugna",
    "calificacion": "apta para mayores de 16 años",
    "id_genero": 6 }

El código de respuesta es 200.

----Endpoint para crear un token y obtener acceso(GET)----

/user/token

Este endpoint se utiliza para tener acceso a un token de seguridad y de esta manera poder tener acceso a manipular los datos y realizar acciones como por ejemplo: eliminar, editar o crear un recurso.

ej:http://localhost/tpEspecialWeb2Parte2/api/user/token

----Endpoint para paginar----

Agregue parámetros de consulta a las solicitudes GET:

Ej: /

Page se refiere a las páginas y limit refiere a que la pagina deben tener un límite de 10 elementos.

----Endpoint para clasificar----

Agregue parámetros de consulta a las solicitudes GET:
    
Ej:  http://localhost/tpEspecialWeb2Parte2/api/peliculas?sort=ASC&order=titulo
     http://localhost/tpEspecialWeb2Parte2/api/peliculas?sort=ASC&order=genero

Sort es para referir a el elemento mediante el cual se van a ordenar/clasificar los datos, y order se refiera a si el tipo de elemento se ordena de manera ascendente o descendente. Si se omite el parámetro de pedido, el orden predeterminado es ascendente.

----Endpoint para filtrar----

Agregue parámetros de consulta a las solicitudes GET:

Search refiere a una busqueda/filtro de los elementos establecidos en el sortBy.

Ej: 