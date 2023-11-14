<?php 
require_once 'config.php';

class PeliculaModel{

    protected $db;
        
        
    function __construct(){
        //LE PASO AL CONSTRUCTOR LA FUNCION DE CONECTAR A LA DB, asi cada vez que 
        //LA USO LA CONEXION ESTA ABIERTA POR EL CONSTRUCTOR.
        //NO NECESITO HACER EL PASO 1 EN CADA FUNCION.
        $this->db= $this->getConection();
    }
    //ABRE LA CONEXION A LA BASE DE DATOS
    //solo se puede llamar el mismo , nadie de afuera se va a conectar por eso el private.
    private function getConection() {
        return new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB.";charset=utf8", 
        MYSQL_USER, MYSQL_PASS);
        $this->deploy();
        
    }

    private function deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql =<<<END
    
            END;
            $this->db->query($sql);
        }
    }



    function getPeliculasFiltradas($inicioPag, $tamanioPag, $order, $sortBy,$search)
    {
        $query = $this->db->prepare("SELECT * FROM `peliculas` WHERE $sortBy = ?
                                                              ORDER BY $sortBy $order
                                                              LIMIT $inicioPag,$tamanioPag");
        $query->execute([$search]);

        $peliculas = $query->fetchAll(PDO::FETCH_OBJ);

        return $peliculas;
    }
 
    public function getAllPeliculas($inicioPag, $tamanioPag, $sortedby = "id_genero", $order = "asc")
    {
        // 1. abro conexión a la DB
        // ya esta abierta por el constructor de la clase
        // 2. ejecuto la sentencia (2 subpasos)
        $query = $this->db->prepare("SELECT `peliculas`.*, generos.genero as `generos` FROM `peliculas` JOIN `generos` ON peliculas.id_genero = generos.id_genero ORDER BY $sortedby $order
        LIMIT $inicioPag,$tamanioPag");
        $query->execute();

        // 3. obtengo los resultados
        $peliculas = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos

        return $peliculas;
    }

        // obtiene la lista de peliculas de la DB.
    function getPeliculas() {
        $query = $this->db->prepare('SELECT * FROM peliculas ');
        $query->execute();
        $peliculas = $query->fetchAll(PDO::FETCH_OBJ);
        return $peliculas;
        

    }

    // obtiene la lista de peliculas de la DB según género
    public function getPeliculaConGenero($parametros){    
        $sql = 'SELECT peliculas.*, generos.genero as genero FROM peliculas JOIN generos ON peliculas.id_genero=generos.id_genero';
        
        //--------------------------------
        // Verifica si hay un filtro por género
        if(isset($parametros['genero'])){
            $sql .= ' WHERE generos.genero = ?';
        }
        //--------------------------------
        if(isset($parametros['order'])){
            $sql .= ' ORDER BY '.$parametros['order'];
            //Si tiene un order utiliza el sort
            if(isset($parametros['sort'])) {
                $sql .= ' '.$parametros['sort'];
            }

        }
        

        $query= $this->db->prepare($sql);  
        //_------------------------------
         // Enlaza el valor del filtro por género si existe
        if(isset($parametros['genero'])){
            $query->bindParam(1, $parametros['genero']);
        }
        //-------------------------------
        $query->execute();
        $peliculas = $query->fetchAll(PDO::FETCH_OBJ);
        return $peliculas;
        
    }

    /**
     * Inserta una pelicula en la base de datos.
     */
    public function agregarPelicula($titulo, $descripcion, $director,$calificacion,$id_genero,$imagen=null) {

        if($imagen){
            $sql= "INSERT INTO peliculas (titulo, descripcion, director,calificacion,id_genero,imagen) VALUES (?,?,?,?,?,?)";
            $params=[$titulo, $descripcion, $director,$calificacion,$id_genero,$imagen];
        }else{
            $sql= "INSERT INTO peliculas (titulo, descripcion, director,calificacion,id_genero) VALUES (?,?,?,?,?)";
            $params=[$titulo, $descripcion, $director,$calificacion,$id_genero];
        }
        $query = $this->db->prepare($sql);
        $query->execute($params);
        return $this->db->lastInsertId();
    }

    function eliminarPelicula($pelicula_id) {
        $query = $this->db->prepare('DELETE FROM peliculas WHERE pelicula_id = ?');
        $query->execute([$pelicula_id]);
        return $query->rowCount(); // devuelve la cantidad de columnas afectadas.
    }

    function editarPelicula($titulo, $descripcion, $director, $calificacion, $id_genero, $pelicula_id ){
        $sql = "UPDATE peliculas 
                SET `titulo`=?,`descripcion`=?,`director`=?,`calificacion`=?, `id_genero`=?
                WHERE `pelicula_id`=?"; 

        $query = $this->db->prepare($sql);
        $result=$query->execute([$titulo, $descripcion, $director, $calificacion,$id_genero,$pelicula_id]);

        return $result;

    }
    function ShowGeneroPeliculas($id_genero){
        $query = $this->db->prepare("SELECT * FROM `peliculas` WHERE `id_genero`=?");
        $query->execute([$id_genero]);
        $peliculas = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        return $peliculas;
    }

    function ShowPeliculaDetalle($peliculaDetalle) {
        $query = $this->db->prepare("SELECT peliculas.*, generos.genero as genero FROM peliculas JOIN generos ON peliculas.id_genero=generos.id_genero WHERE peliculas.pelicula_id=? ");
        $query->execute([$peliculaDetalle]);
        $peliculas = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        return $peliculas;

    }

     //obtener arreglo de las columnas de las tablas
     function getAllColumns(){
        $query = $this->db->prepare("SELECT COLUMN_NAME 
                                                             FROM INFORMATION_SCHEMA.COLUMNS 
                                                             WHERE TABLE_NAME = N'peliculas'");
        $query->execute();
        $columns = $query->fetchAll(PDO::FETCH_OBJ);
        return $columns;
    }

}
    