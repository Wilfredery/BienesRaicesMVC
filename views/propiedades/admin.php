<main class="contenedor seccion">
    <h1>Administrador de dinero de Bienes Raices</h1>

    <?php
        if($mensajeAlerta) {
            $mensaje = mostrarNotificacion(intval($mensajeAlerta));
            if($mensaje) { ?>
                <p class="alerta exito"><?php echo sanitizar($mensaje); ?></p>
            <?php } ?>
        <?php } ?>
    
        

    <a href="/propiedades/crear" class="boton boton-verde">Nueva propiedad</a>

    <h2>Propiedades</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!--Mostrar los resultados-->

            <?php foreach( $propiedades as $propiedad): ?>

            <tr>
                <td><?php echo $propiedad->id; ?> </td>
                <td><?php echo $propiedad->titulo; ?> </td>
                <td><img class="imagen-tabla" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt=""></td>
                <td>$<?php echo $propiedad->precio; ?> </td>
                <td>

                    <form method="POST" class="w-100">
                        <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                        <input type="hidden" name="tipo" value="propiedad">
                        <input class="boton-rojo-block" value="Eliminar" type="submit" >
                    </form>
                    
                    <a class="boton-amarillo-block" href="admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>">Actualizar</a>
                </td>
            </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="/admin/vendedores/crear.php" class="boton boton-verde">Nuevo/a vendedor</a>
</main>