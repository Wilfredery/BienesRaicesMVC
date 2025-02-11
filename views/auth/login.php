<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>

        <?php foreach($errores as $error) :?>
            <div class="alerta error">
                <?php echo $error; ?>

            </div>
        <?php endforeach;?>

        <form class="formulario" action="" method="POST" action="/login">
            <fieldset>
                <legend>Emaily password</legend>

                <label for="email">E-mail: </label>
                <input name="email" type="email" placeholder="Aqui tu correo electronico" id="Email">

                <label for="password">Password: </label>
                <input name="password" type="password" placeholder="Aqui colocar tu password" id="password">

            </fieldset>

            <input type="submit" value="Iniciar sesion" class="boton boton-verde">

        </form>
    </main>