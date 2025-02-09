<main class="contenedor seccion">
        <h1>contacto</h1>

    <?php if($mensaje) { ?>
    <p class="alerta exito"><?php echo $mensaje; ?></p>
    <?php } ?>



        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="imagencontacto">
        </picture>

        <h2>Llenar el siguiente formulario de contacto</h2>

        <form class="formulario" action="/contacto" method="POST">
            <fieldset>
                <legend>Informacion personal</legend>

                <label for="nombre">Nombre: </label>
                <input type="text" placeholder="Aqui colocar tu nombre" id="nombre" name="contacto[nombre]" >





                <label for="Mensaje">Mensaje</label>
                <textarea name="contacto[mensaje]" id="Mensaje"></textarea>
            </fieldset>


            <fieldset>
                <legend>Informacion sobre la propiedad</legend>

                
                <label for="opciones">Vende o Compra: </label>
                <select id="opciones" name="contacto[tipo]">
                    <option value="" disabled selected>-- Seleccionar--</option>
                    <option value="Compra">Compra</option>
                    <option value="Venda">Venda</option>
                </select>
                <label for="presupuesto">Presupuesto: </label>
                <input type="tel" placeholder="Aqui colocar tu presupuesto" id="presupuesto" name="contacto[precio]">
            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propiedad</legend>

                <p>¿Cómo desea ser contactado?</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" >

                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" >
                </div>

                <div id="contacto"></div>


            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde-block">
        </form>
</main>