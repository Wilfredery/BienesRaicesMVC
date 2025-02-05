<main class="contenedor seccion">
    <h1>Actualizar</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach($errores AS $error): ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
        

    <?php endforeach; ?>  
    <form class="formulario" method="POST" enctype="multipart/form-data">

    <?php include __DIR__ . '/formularios.php'; ?>

    <input class="boton-verde btnform" type="submit" value="Enviar propiedad">
    </form>
    
</main>