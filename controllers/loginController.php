<?php

namespace Controllers;
use Model\admin;
use MVC\Router;


class LoginController {
    public static function login(Router $router) {
        
        $errores = [];

        
        $router->renderView('auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout(Router $router) {
        echo "DESDE EL LOGOUT.";
    }
}