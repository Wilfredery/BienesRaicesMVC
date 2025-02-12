<?php

namespace Model;


class Admin extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? null;
        $this->password = $args['password'] ?? null;

    }

    public function validar() {
        if(!$this->email) {
            self::$errores[] = 'El email es obligatorio';

        }

        if(!$this->password) {
            self::$errores[] = 'El password es obligatorio';

        }

        return self::$errores;
    }

    public function usuarioExiste() {
        //Revisar si existe o no
        $query = 'SELECT * FROM ' . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $result = self::$db->query($query);

        if(!$result->num_rows) {
            self::$errores[] = 'El usuario no existe.';

            return;
        }

        return $result;
    }

    public function comprobarPassword($result) {
        $usuario = $result->fetch_object();

        $authpass = password_verify($this->password, $usuario->password);

        if(!$authpass) {
            self::$errores[] = 'El password es incorrecto.';
        }
        return $authpass;
    }

    public function autenticar() {
        session_start();

        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}