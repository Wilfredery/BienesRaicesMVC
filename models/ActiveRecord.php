<?php 

namespace Model;

class ActiveRecord {
     //Base de datos
  protected static $db;
  protected static $columnasDB = [];

protected static $tabla = '';
  //Errores
  protected static $errores = [];



  //Definir la conexion a la base de datos.
  public static function setDB($database) {
    self::$db = $database;

  }

  public function guardar() {
    if(!is_null($this->id)) {
      //actualizar
      $this->actualizar();
      
    } else {
      //Creando un nuevo registro.
      
      $this->crear();
    }
  }

  public function crear() {

    //Sanitizar los datos.
    $atributos = $this->sanitizarDB();

    //insertar en la base de datos
    $query = "INSERT INTO " . static::$tabla . " (";
    $query .= join(', ', array_keys($atributos));
    $query .= ") VALUES ('"; 
    $query .= join("','", array_values($atributos));
    $query .= "')"; 

    // debug($query);

    $resultado = self::$db->query($query);
    // debug($result);

    if($resultado) {
      //redireccionar al usuario.
      header("Location: /admin?mensaje=1");

    }
  }

  public function actualizar() {
    $atributos = $this->atributos();

    $valores = [];

    foreach($atributos as $key => $value) {
        $valores[] = "$key ='$value'";
    }
    $query = "UPDATE " . static::$tabla . " SET ";
    $query .= join(', ', $valores);
    $query .= "WHERE id = '" . self::$db->escape_string($this->id). "' ";
    $query .= " Limit 1 ";
    
    $resultado = self::$db->query($query);

    if($resultado) {
      //redireccionar al usuario.
      header("Location: /admin?mensaje=2");

    }
  }

  //Eliminar un registro
  public function eliminar() {
    //Elimina la propiedad.
    $query =  "DELETE FROM ". static::$tabla ." WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

    $resultado = self::$db->query($query);

    if($resultado) {
      //Llamando al metodo borrar la imagen
      $this->borrarImagen();
      //redireccionar al usuario.
      header("Location: /admin?mensaje=3");

    }
  }

  //Identificar y unir los atributos de la DB. O sea, identificar cuales tenemos.
  public function atributos() {
    $atributos = [];

    foreach(static::$columnasDB as $columna) {
      //Eliminando el id paraque no se sinitize.
      //Si se cumple, continua con el siguiente (continue)
      if($columna === 'id') continue;
      $atributos[$columna] = $this->$columna;
    }
    return $atributos;
  }

  public function sanitizarDB() {
    $atributos = $this->atributos();
    $sanatizado = [];


    //Key columnas de la DB y value los resultados de las columnas del db.
    foreach($atributos as $key => $value) {
      $sanatizado[$key] = self::$db->escape_string($value);

    }
    return $sanatizado;
  }

  //Validaciones de errrores.
  public static function getError() {
    return self::$errores;
  }

  public function validar() {
    static::$errores = [];
    return static::$errores;
  }

  public function setImage($imagen) {
    //Elimina la iamgen previa.
    if(!is_null($this->id)) {
      //Comprobar si existe el archivo.
      $this->borrarImagen();
    }

    //Asigna el atributo de imagen el nombre de la imagen.
    if($imagen) {
      $this->imagen = $imagen;
    }
  }

  //Borar la imagen del archivo.
  public function borrarImagen() {

    $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
      
      if($existeArchivo) {
        unlink(CARPETA_IMAGENES . $this->imagen);
      }
  }


  //Lista todas las registros
  public static function all() {
    $query = "SELECT * FROM " . static::$tabla;
    $resultado = self::consultSQL($query);
    // debug($resultado->fetch_assoc());
    return $resultado;
  }

  //Obtiene determinado numero de regsistros.
  public static function get($cantidad) {
    $query = "SELECT * FROM " . static::$tabla . " LIMIT ".$cantidad;
    $resultado = self::consultSQL($query);
    // debug($resultado->fetch_assoc());
    return $resultado;
  }

  //Busca una registro por su id.
  public static function find($id){
    $query = "SELECT * FROM ". static::$tabla ." WHERE id = $id";
    $resultado = self::consultSQL($query);
    return array_shift($resultado);
  }

  public static function consultSQL($query) {
    //Consultar la base de datos
    $resultado = self::$db->query($query);
    
    //Iterar los resultados.
    // debug($resultado->fetch_assoc());

    $array = [];
    while($registro = $resultado->fetch_assoc() ) {
      $array[] = static::crearObj($registro);
    } 

    // debug($array);

    //Liberar la memoria.
    $resultado->free();
    //Retornar los resultados.
    return $array;
  }

  protected static function crearObj($registro) {
    $objeto = new static;

    // 
    foreach($registro as $key => $value) {
      // debug($key);
      if(property_exists($objeto, $key)) {
        $objeto->$key = $value;
      }
    }

    return $objeto;
  }

  //Sincronizar el objeto en memoria con los cambios realizados por el usuario.
  public function sincronizar($args = []) {
    foreach($args as $key => $value) {
      if (property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }
}

?>