<main class="contenedor seccion">
    <h1>Crear vendedor/a</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach($errores AS $error): ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
        

    <?php endforeach; ?>    


    <form class="formulario" method="POST" action="/vendedores/crear">

        <?php include 'formularios.php'; ?>

        <input class="boton-verde btnform" type="submit" value="Enviar">
    </form>
</main>