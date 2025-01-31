<?php
namespace Model;

class Propiedad extends ActiveRecord {

  protected static $tabla = 'propiedades'; 
  
  protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'Descripción', 'habitaciones', 'bathroom', 'estacionamiento', 'creado', 'vendedores_idvendedores'];

  public $id;
  public $titulo;
  public $precio;
  public $imagen;
  public $Descripción;
  public $habitaciones;
  public $bathroom;
  public $estacionamiento;
  public $creado;
  public $vendedores_idvendedores;

  public function __construct($args = []) {
    $this->id = $args['id'] ?? null;
    $this->titulo = $args['titulo'] ?? '';
    $this->precio = $args['precio'] ?? '';
    $this->imagen = $args['imagen'] ?? '';
    $this->Descripción = $args['Descripción'] ?? '';
    $this->habitaciones = $args['habitaciones'] ?? '';
    $this->bathroom = $args['bathroom'] ?? '';
    $this->estacionamiento = $args['estacionamiento'] ?? '';
    $this->creado = date('Y/m/d');
    $this->vendedores_idvendedores = $args['vendedores_idvendedores'] ?? '';
    
  }

    public function validar() {
    if(!$this->titulo) {
      self::$errores[] = 'Debes agregar un titulo';
    }
    
    if(!$this->precio) {
      self::$errores[] = 'Debes agregar un precio';
    }

    if(strlen($this->Descripción ) < 50) {
      self::$errores[] = 'Su descrip debe de ser mayor a 50 caracteres de letras.';
    }

    if(!$this->habitaciones) {
      self::$errores[] = 'Debes agregar la cantidad de habitaciones';
    }
    
    if(!$this->bathroom) {
      self::$errores[] = 'Debes agregar la cantidad de bathrooms';
    }

    if(!$this->estacionamiento) {
      self::$errores[] = 'Debes agregar la cantidad de estacionamientos';
    }

    if(!$this->vendedores_idvendedores) {
      self::$errores[] = 'Debes agregar al vendedor';
    }

    if(!$this->imagen) {
      self::$errores[] = 'La imagen de la propiedad es obligatoria.';
    }

    return self::$errores;
  }

}

