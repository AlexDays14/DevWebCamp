<div class="evento swiper-slide">
    <p class="evento__hora"><?php echo $conferencia->hora; ?></p>

    <div class="evento__info">
        <h4 class="evento__nombre"><?php echo $conferencia->nombre ?></h4>

        <p class="evento__introduccion"><?php echo $conferencia->descripcion ?></p>

        <div class="evento__autor-info">
            <picture>
                <source srcset="img/speakers/<?php echo $conferencia->ponente->imagen;?>.webp" type="image/webp">
                <source srcset="img/speakers/<?php echo $conferencia->ponente->imagen;?>.png" type="image/png">
                <img loading='lazy' width="200" height="300" class="evento__imagen-autor" src="img/speakers/<?php echo $conferencia->ponente->imagen;?>.png" alt="Imagen Ponente">
            </picture>

            <p class="evento__autor-nombre">
                <?php echo $conferencia->ponente->get_nombre_completo(); ?>
            </p>
        </div>
    </div>
</div>