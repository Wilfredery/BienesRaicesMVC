<main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad->titulo; ?></h1>

            <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen;?>" alt="imagenCasaBosque">

        </picture>

        <div class="resumen-propiedad">

            <p class="precio">$<?php echo number_format($propiedad->precio); ?></p>

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

            <p><?php echo $propiedad->Descripción; ?></p>
        </div>
    </main>