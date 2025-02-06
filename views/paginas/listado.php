<div class="contenedor-anuncios">
    <?php foreach($propiedad as $propiedad) { ?>
        <div class="anuncio">

        <img loading="lazy" alt="anuncio" src="/imagenes/<?php echo $propiedad->imagen;?>">
\                

            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p><?php echo $propiedad->Descripción; ?></p>
                <p class="precio">$<?php echo $propiedad->precio; ?></p>

                <ul class="iconos-caracteristicas">

                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="iconowc">
                        <p><?php echo $propiedad->bathroom; ?></p>
                    </li>

                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="iconoestacionamiento">
                        <p><?php echo $propiedad->estacionamiento; ?></p>
                    </li>

                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="iconodormitorio">
                        <p><?php echo $propiedad->habitaciones; ?></p>
                    </li>
                </ul>

                <a class="boton-amarillo-block" href="/propiedad?id=<?php echo $propiedad->id; ?>">Ver propiedad</a>

            </div> <!--Conte-anuncio-->
        </div> <!--anuncio-->
    <?php } ?>
</div> <!--Contenedor-anuncios-->