<fieldset>
            <legend>Informacion general</legend>

            <label for="titulo">Titulo: </label>
            <input type="text" id="titulo" name="propiedad[titulo]" placeholder="titulo de la propiedad" value="<?php echo sanitizar($propiedad->titulo); ?>">

            <label for="precio">Precio: </label>
            <input type="number" id="precio" name="propiedad[precio]" placeholder="precio propiedad" value="<?php echo sanitizar($propiedad->precio); ?>">

            <label for="imagen">Imagen: </label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">
            
            <?php if($propiedad->imagen) { ?>
                <img src="/imagenes/<?php echo $propiedad->imagen ?>" class= "imagen-small">
            <?php } ?>

            <label for="Descripción">Descripcion</label>
            <textarea id="Descripción" name="propiedad[Descripción]" ><?php echo sanitizar($propiedad->Descripción); ?></textarea>

        </fieldset>

        <fieldset>
            <legend>Informacion de la propiedad</legend>

            <label for="habitaciones">Habitaciones: </label>
            <input type="number" id="habitaciones" placeholder="Cantidad de habitaciones. EJ: 3" min="1" name="propiedad[habitaciones]" value="<?php echo sanitizar($propiedad->habitaciones); ?>">

            <label for="bathroom">Baños: </label>
            <input type="number" id="bathroom" placeholder="Cantidad de habitaciones. EJ: 3" min="1" name="propiedad[bathroom]" value="<?php echo sanitizar($propiedad->bathroom); ?>">


            <label for="estacionamiento">Estacionamientos: </label>
            <input type="number" id="estacionamiento" placeholder="Cantidad de habitaciones. EJ: 3" min="1" name="propiedad[estacionamiento]" value="<?php echo $propiedad->estacionamiento; ?>">
        </fieldset>

        
        <fieldset>
            <legend>Vendedor</legend>
            <label for="Vendedor">Vendedor</label>
            <select name="propiedad[id]" id="vendedor" >
                <option selected value="">--Seleccionar--</option>
                <!-- <option value="1">Juan</option>
                <option value="2">Pablito</option> -->

                <?php foreach ( $vendedores as $vendedor ) { ?>
                    <option 
                    <?php echo $propiedad->id == $vendedor->id ? 'selected' : ''; ?>
                    value="<?php echo sanitizar($vendedor->id)?>">
                    <?php echo sanitizar($vendedor->nombre) . " " . sanitizar($vendedor->apellido);?> 
                    </option>
                
                <?php } ?>
                    
            </select>
        </fieldset>