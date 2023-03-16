<?php
    include_once __DIR__ . '/conferencias.php'
?>

<section class="resumen">
    <div class="resumen__grid">
        <div class="resumen__bloque" <?php echo aos_animacion(); ?>>
            <p class="resumen__texto resumen__texto--numero"><?php echo $ponentes_total; ?></p>
            <p class="resumen__texto">Ponentes</p>
        </div>
        <div class="resumen__bloque" <?php echo aos_animacion(); ?>>
            <p class="resumen__texto resumen__texto--numero"><?php echo $conferencias; ?></p>
            <p class="resumen__texto">Conferencias</p>
        </div>
        <div class="resumen__bloque" <?php echo aos_animacion(); ?>>
            <p class="resumen__texto resumen__texto--numero"><?php echo $workshops; ?></p>
            <p class="resumen__texto">Workshops</p>
        </div>
        <div class="resumen__bloque" <?php echo aos_animacion(); ?>>
            <p class="resumen__texto resumen__texto--numero">+500</p>
            <p class="resumen__texto">Asistentes</p>
        </div>
    </div>
</section>

<section class="speakers">
    <h2 class="speakers__heading">Nuestros Ponentes</h2>
    <p class="speakers__descripcion">Conoce a los expertos de DevWebCamp.</p>
    <div class="speakers__grid">
        <?php foreach($ponentes as $ponente) : ?>
            <div class="speaker" <?php echo aos_animacion(); ?>>
                <picture>
                    <source srcset="img/speakers/<?php echo $ponente->imagen;?>.webp" type="image/webp">
                    <source srcset="img/speakers/<?php echo $ponente->imagen;?>.png" type="image/png">
                    <img loading='lazy' width="200" height="300" class="speaker__imagen" src="img/speakers/<?php echo $ponente->imagen;?>.png" alt="Imagen Ponente">
                </picture>

                <div class="speaker__informacion">
                    <h4 class="speaker__nombre"><?php echo $ponente->get_nombre_completo(); ?></h4>
                    <p class="speaker__ubicacion"><?php echo $ponente->get_ubicacion(); ?></p>
                    <nav class="speaker-sociales">
                        <?php 
                            $redes = json_decode($ponente->redes);
                        ?>
                            <?php if($redes->facebook) : ?>
                                <a href="<?php echo $redes->facebook; ?>" target="_blank" class="speaker-sociales__enlace" rel="noopener noreferrer">
                                    <span class="speaker-sociales__ocultar">Facebook</span>
                                </a>
                            <?php endif; ?>

                            <?php if($redes->twitter) : ?>
                                <a href="<?php echo $redes->twitter; ?>" target="_blank" class="speaker-sociales__enlace" rel="noopener noreferrer">
                                    <span class="speaker-sociales__ocultar">Twitter</span>
                                </a>
                            <?php endif; ?>

                            <?php if($redes->youtube) : ?>
                                <a href="<?php echo $redes->youtube; ?>" target="_blank" class="speaker-sociales__enlace" rel="noopener noreferrer">
                                    <span class="speaker-sociales__ocultar">YouTube</span>
                                </a>
                            <?php endif; ?>

                            <?php if($redes->instagram) : ?>
                                <a href="<?php echo $redes->instagram; ?>" target="_blank" class="speaker-sociales__enlace" rel="noopener noreferrer">
                                    <span class="speaker-sociales__ocultar">Instagram</span>
                                </a>
                            <?php endif; ?>

                            <?php if($redes->tiktok) : ?>
                                <a href="<?php echo $redes->tiktok; ?>" target="_blank" class="speaker-sociales__enlace" rel="noopener noreferrer">
                                    <span class="speaker-sociales__ocultar">Tiktok</span>
                                </a>
                            <?php endif; ?>

                            <?php if($redes->github) : ?>
                                <a href="<?php echo $redes->github; ?>" target="_blank" class="speaker-sociales__enlace" rel="noopener noreferrer">
                                    <span class="speaker-sociales__ocultar">Github</span>
                                </a>
                            <?php endif; ?>
                    </nav>
                    <ul class="speaker__listado-skills">
                        <?php 
                            $tags = explode(',', $ponente->tags);
                            foreach($tags as $tag) :
                        ?>
                            <li class="speaker__skill"><?php echo $tag; ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</section>

<div id="mapa" class="mapa">
    <!-- AQUÍ VA EL MAPA DE LEAFLET CARGADO CON JS -->
</div>

<section class="boletos">
    <h2 class="boletos__heading">Boletos y Precios</h2>
    <p class="boletos__descripcion">Nuestros Precios.</p>

    <div class="boletos__grid">
        <div class="boleto boleto--presencial">
            <h4 class="boleto__logo">&#60;DevWebCamp/></h4>
            <p class="boleto__plan">Presencial</p>
            <p class="boleto__precio">$199</p>
        </div>

        <div class="boleto boleto--virtual">
            <h4 class="boleto__logo">&#60;DevWebCamp/></h4>
            <p class="boleto__plan">Virtual</p>
            <p class="boleto__precio">$49</p>
        </div>

        <div class="boleto boleto--gratis">
            <h4 class="boleto__logo">&#60;DevWebCamp/></h4>
            <p class="boleto__plan">Gratis</p>
            <p class="boleto__precio">$0</p>
        </div>
    </div>

    <div class="boleto__enlace-contenedor">
        <a href="/paquetes#navegacion" class="boleto__enlace">Ver Paquetes</a>
    </div>
</section>