<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;

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

    public static function crear() {
        echo "Propiedad creada";
    }

    public static function actualizar() {
        echo "Act propiedades.";
    }
}