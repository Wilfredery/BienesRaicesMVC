<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;

class PropiedadController {
    public static function index(Router $router) {

        $propiedades = Propiedad::all();
        $mensajeAlerta = null;
        $router->renderView('propiedades/admin', [
            //$key              $value
            'propiedades' => $propiedades,
            'mensajeAlerta' => $mensajeAlerta
        ]);
    }

    public static function crear(Router $router) {

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getError();


        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            
            $propiedad = new Propiedad($_POST['propiedad']);
            // $nombreImagen = uniqid( rand()). $imagen['name'];
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
            //Generar un nombre uncico para evitar que las imagenes se reescriban.
            if($_FILES['propiedad']['tmp_name']['imagen']) {
            $manager = new Image(Driver::class);
            $Image = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800,600);
    
            $propiedad->setImage($nombreImagen); 
            }
            
            $errores = $propiedad->validar();
    
            if(empty($errores)) {
                //Subida de archivos.            
    
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
    
                //Guarda la imagen en el servidor
                $Image->save(CARPETA_IMAGENES . $nombreImagen);
    
    
                $propiedad->guardar();
            }
        }
        

        $router->renderView('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar() {
        echo "Act propiedades.";
    }

    public static function eliminar() {
        echo 'ELIMINANDO PROPIEDADES.';
    }
}