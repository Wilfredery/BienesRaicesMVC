<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

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

    public static function entrada(Router $router) {
        $router->renderView('paginas/entrada', []);
    }

    public static function contacto(Router $router) {

        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuestas = $_POST['contacto'];
            //debug($respuestas);
            //Se crea una nueva instancia
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'd5a8935c585bc4';
            $mail->Password = '6c35b810746349';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 25;

            //Configurar el contenido del mail.
            $mail->setFrom('admin@bienesraices.com'); //Quien lo envia
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com'); //A que email le llegara el correo.
            $mail->Subject = 'Tienes un nuevo mensaje.';

            //Habilitar el HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir el contenido
            $contenido = '<html>'; 
            $contenido .='<p>Tienes un nuevo mensaje.</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>'; 
            

            //Enviar de forma condicional algunos campos de email o telefono.
            if($respuestas['contacto'] === 'telefono' ) {
                $contenido .= '<p>Eligio ser contactado por telefono.</p>';
                $contenido .= '<p>Tel: ' . $respuestas['telefono'] . '</p>'; 
                $contenido .= '<p>Fecha: ' . $respuestas['fecha'] . '</p>';  
                $contenido .= '<p>Hora: ' . $respuestas['hora'] . '</p>';  

            } else {
                //Email, se agrega los campos del email.
                $contenido .= '<p>Eligio ser contactado por email.</p>';
                $contenido .= '<p>Correo electronico: ' . $respuestas['email'] . '</p>'; 
            }
             
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>'; 
            $contenido .= '<p>Compra o venta: ' . $respuestas['tipo'] . '</p>'; 
            $contenido .= '<p>Presupuesto o precio: $' . number_format($respuestas['precio'], 2, ".", ','). '</p>';
            $contenido .= '<p>Fomra en que desea ser contactado: ' . $respuestas['contacto'] . '</p>'; 

            $contenido .= '</html?';
            $mail->Body=$contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            //Enviar el email. True si se envio/false si no se envio
            if($mail->send()) {
                $mensaje = "Mensaje enviado";
            } else {
                $mensaje = "El mensaje no se envio";
            }

        }   
        $router->renderView('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}