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
        $vendedores = Vendedor::all();
        $mensajeAlerta = null;

        $mensajeAlerta = $_GET['mensaje'] ?? null;

        $router->renderView('propiedades/admin', [
            //$key              $value
            'propiedades' => $propiedades,
            'mensajeAlerta' => $mensajeAlerta,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router) {

        $propiedades = new Propiedad;
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
            'propiedad' => $propiedades,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        $id = validarRedireccionar('/admin');

        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getError();

        //Ejecutar el codigo luego del usuario envia el form.
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {

            //Asignar los atributos.
            $args = $_POST['propiedad'];

            $propiedad->sincronizar($args);
            //Validacion
            $errores = $propiedad->validar();

            //Subida de archivos.
        
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                // $nombreImagen = uniqid( rand()). $imagen['name'];
                $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
                $manager = new Image(Driver::class);
                $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800,600);
   
                $propiedad->setImage($nombreImagen);   
        }


        if(empty($errores)) {

            //$Image->save(CARPETA_IMAGENES . $nombreImagen);
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }
            $propiedad->guardar();

        }
    }


        $router->renderView('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            //Validar ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {
                $tipo = $_POST['tipo'];
                if(validarTipoeCont($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}