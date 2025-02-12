<?php

namespace Controllers;
use Model\Admin;
use MVC\Router;


class LoginController {
    public static function login(Router $router) {
        
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);

            $errores = $auth->validar();

            if(empty($errores)) {
                //Verificar si existe el usuario.
                $result = $auth->usuarioExiste();

                if(!$result) {
                    $errores = Admin::getError();
                } else {
                    //Verif el password.
                    $authpass = $auth->comprobarPassword($result);

                    if($authpass) {
                        //Auth el usuario.
                        $auth->autenticar();
                    } else {
                        $errores = Admin::getError();
                    }
                    
                }
                
               
            }
        }
        
        $router->renderView('auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout(Router $router) {
        session_start();
        $_SESSION = []; //Limpiar la session
        header('Location: /');
    }
}