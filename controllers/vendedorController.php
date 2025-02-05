<?php

namespace Controllers;
use Model\Vendedor;
use MVC\Router;

class VendedorController {
    public static function crear(Router $router) {
        
        $vendedor = new Vendedor;
        $errores = Vendedor::getError();
    
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            //Crear una nueva instancia.
            $vendedor = new Vendedor($_POST['vendedor']);
    
            //Validar que no haya campos vacios.
    
            $errores = $vendedor->validar();
    
            if(empty($errores)) {
                $vendedor->guardar();
            }
    
        }

        $router->renderView('/vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);

    }

    public static function actualizar(Router $router) {

            //Validar que sea un id valido.
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /admin');
    }
    
    //Obtener el arreglo del vendedor.
    $vendedor = Vendedor::find($id);
    $id = validarRedireccionar('/admin');

    //Arreglo con mensajes de errores.
    $errores = Vendedor::getError();

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        //Asignar los valores
        $args = $_POST['vendedor'];

        //Sincronizar objeto en memoria con lo que el usuario escribio.
        $vendedor->sincronizar($args);

        //validacion por si se le olvida rellenar un campo.
        $errores = $vendedor->validar();

        if(empty($errores)) {
            $vendedor->guardar();
        }
    }   
        $router->renderView('/vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Validar el id.
            $id = $_POST['id'];
            filter_var($id, FILTER_VALIDATE_INT);

            if($id) {
                //Valida el tipo eliminar.
                $tipo = $_POST['tipo'];

                if(validarTipoeCont($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}