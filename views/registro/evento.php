<div class="evento">
    <p class="evento__hora"><?php echo $conferencia->hora; ?></p>

    <div class="evento__info">
        <h4 class="evento__nombre"><?php echo $conferencia->nombre ?></h4>

        <p class="evento__introduccion"><?php echo $conferencia->descripcion ?></p>

        <div class="evento__autor-info">
            <picture>
                <source srcset="/img/speakers/<?php echo $conferencia->ponente->imagen;?>.webp" type="image/webp">
                <source srcset="/img/speakers/<?php echo $conferencia->ponente->imagen;?>.png" type="image/png">
                <img loading='lazy' width="200" height="300" class="evento__imagen-autor" src="/img/speakers/<?php echo $conferencia->ponente->imagen;?>.png" alt="Imagen Ponente">
            </picture>

            <p class="evento__autor-nombre">
                <?php echo $conferencia->ponente->get_nombre_completo(); ?>
            </p>
        </div>

        <button class="evento__boton" type="button" data-id="<?php echo $conferencia->id ?>" <?php echo ($conferencia->disponibles <= '0') ? 'disabled' : '' ?>>
            <?php echo ($conferencia->disponibles <= '0') ? 'Agotado' : 'Agregar - ' . $conferencia->disponibles . ' Disponibles' ?>
        </button>
    </div>
</div>