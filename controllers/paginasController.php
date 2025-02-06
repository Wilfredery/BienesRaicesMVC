<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;

class PaginasController {
    public static function index(Router $router) {
        
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->renderView('paginas/index' , [
            'propiedad' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router) {
        $router->renderView('paginas/nosotros', []);
    }
    public static function propiedades(Router $router) {
        $propiedades = Propiedad::all();

        $router->renderView('paginas/propiedades', [
            'propiedad' => $propiedades,
        ]);
    }
    public static function propiedad(Router $router) {
       
        $id =validarRedireccionar('/propiedades');

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
    
        if(!$id) {
            header('Location: /');
        }

        $propiedad = Propiedad::find($id);

        $router->renderView('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router) {
        $router->renderView('paginas/blog', []);
    }
    public static function contacto(Router $router) {
        
    }
    public static function entrada(Router $router) {
        $router->renderView('paginas/entrada', []);
    }
}