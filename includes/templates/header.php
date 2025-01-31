<?php
    
    //echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    if(!isset($_SESSION)) {
        session_start();//Esto permitio el continuo inicio de sesion.
    }

    $auth = $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BienesRaices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img class="logo" src="/build/img/logo.svg" alt="logotipoBienesRaices">
                </a>
                
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="barramenu">
                </div>

                <div class="derecha"> 
                    <img src="/build/img/dark-mode.svg" alt="botondark" class="dark-mode-btn">   
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                        <?php if($auth): ?>
                            <a href="closelogin.php">Cerrar sesion</a>
                        <?php endif; ?>
                    </nav>
                </div>


            </div>

            <?php 

                // if($inicio) {
                //     echo "<h1>Venta de Casas y Departaments Exclusivos de lujo</h1>";
                // }

                echo $inicio ? "<h1>Venta de Casas y Departamentos Exclusivos de lujo</h1>" : '';

            ?>
        </div>

    </header>   