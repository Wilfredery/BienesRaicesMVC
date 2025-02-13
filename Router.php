<?php

namespace MVC;

use Intervention\Gif\Blocks\Header;

class Router {
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas() {

        session_start();
        
        $auth = $_SESSION['login'] ?? null;

        //Arreglos de rutas protegidas.
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        // if(isset($_SERVER['PATH_INFO'])) {
        //     $urlActual = $_SERVER['PATH_INFO'];
        // } else {
        //     $urlActual = $_SERVER['REQUEST_URI'];
        // }
        $metodo = $_SERVER['REQUEST_METHOD'];
        

        if($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        //Proteger las rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth) {
            Header('Location: /');
        }


        if($fn) {
            
            //La URL existe y hay una funcion asociada.
            call_user_func($fn, $this);
        } else {
            echo "Página no encontrada.";
        }
    }

    //Mustra una vista.
    public function renderView($view, $datos = []) {
        
        foreach ($datos as $key => $value) {
            $$key =$value;
        }
        ob_start();
        include __DIR__ . '/views/' .$view. '.php';

        $contenido = ob_get_clean();

        include __DIR__ . '/views/layout.php';
    }
}