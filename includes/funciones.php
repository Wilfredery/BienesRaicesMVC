
<?php
//declare(strict_types=1);
// require 'app.php';
define('TEMPLATES_URL', __DIR__ .'/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT']. '/imagenes/');

function addingTemplates(string $nombre, bool $inicio = false ) {
    include TEMPLATES_URL . "/{$nombre}.php";
}

function estaAuth() : bool {
    session_start();
    // echo '<pre>';
    // var_dump($_SESSION);

    // echo '</pre>';
    if(!$_SESSION['login']) {
        header('Location: /');
    }
    return true;

}

function debug($var) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";

    exit;
}

//Escape/Sanitizar el HTML
function sanitizar($html) : string {
    $sanit = htmlspecialchars($html);
    return $sanit;
}


//Validar tipo de contenido propiedad/vendedores
function validarTipoeCont($tipo) {
    $tipos = ['vendedor','propiedad'];

    return in_array($tipo, $tipos);
}

//Muestra los mensajes
function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch($codigo) {
        case 1:
            $mensaje = "Creado correctamente";
            break;

        case 2:
            $mensaje = "Actualizado correctamente";
            break;

        case 3:
            $mensaje = "Borrado correctamente";
            break;

        default:
            $mensake = false;
            break;
    }
    return $mensaje;
}

function validarRedireccionar(string $url) {

    //validar la url por ID valida.
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: $url");
    }
    return $id;
}