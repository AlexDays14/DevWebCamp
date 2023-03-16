<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Personal</legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre</label>
        <input 
            class="formulario__input" 
            id="nombre" 
            name="nombre" 
            placeholder="Nombre del Ponente" 
            type="text" 
            value="<?php echo $ponente->nombre ?? '' ?>"
        >
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="apellido">Apellido</label>
        <input 
            class="formulario__input" 
            id="apellido" 
            name="apellido" 
            placeholder="Appelido del Ponente" 
            type="text" 
            value="<?php echo $ponente->apellido ?? '' ?>"
        >
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="ciudad">Ciudad</label>
        <input 
        class="formulario__input" 
        id="ciudad" 
        name="ciudad" 
        placeholder="Ciudad del Ponente" 
        type="text" 
        value="<?php echo $ponente->ciudad ?? '' ?>"
        >
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="pais">País</label>
        <input 
            class="formulario__input" 
            id="pais" 
            name="pais" 
            placeholder="País del Ponente" 
            type="text" 
            value="<?php echo $ponente->pais ?? '' ?>"
        >
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="imagen">Imagen</label>
        <input 
            class="formulario__input formulario__input--file" 
            id="imagen" 
            name="imagen" 
            type="file" 
        >
        <p class="formulario__texto--input-imagen">(JPG, PNG, GIF, BMP o WebP)</p>
    </div>

    <?php if(isset($ponente->imagen_actual)){ ?>
        <p class="formulario__texto">Imagen Actual:</p>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $ponente->imagen;?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $ponente->imagen;?>.png" type="image/png">
                <img src="<?php echo $_ENV['HOST'] . '/img/speakers/' . $ponente->imagen;?>.png" alt="Imagen Ponente">
            </picture>
        </div>
    <?php } ?>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Extra</legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="tags_input">Áreas de Experiencia (separadas por coma)</label>
        <input 
            class="formulario__input" 
            id="tags_input" 
            name="tags_input" 
            placeholder="Ej: PHP, Laravel, JavaScript, React, Vue, CSS, HTML"" 
            type="text" 
        >

        <div id="tags" class="formulario__listado"></div>
        <input type="hidden" name="tags" value="<?php echo $ponente->tags ?? '' ?>">
    </div>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Redes Sociales</legend>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input 
                class="formulario__input--sociales" 
                name="redes[facebook]" 
                placeholder="Facebook" 
                type="text" 
                value="<?php echo $redes->facebook ?? '' ?>"
            >
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-twitter"></i>
            </div>
            <input 
                class="formulario__input--sociales" 
                name="redes[twitter]" 
                placeholder="Twitter" 
                type="text" 
                value="<?php echo $redes->twitter ?? '' ?>"
            >
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input 
                class="formulario__input--sociales" 
                name="redes[youtube]" 
                placeholder="Youtube" 
                type="text" 
                value="<?php echo $redes->youtube ?? '' ?>"
            >
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input 
                class="formulario__input--sociales" 
                name="redes[instagram]" 
                placeholder="Instagram" 
                type="text" 
                value="<?php echo $redes->instagram ?? '' ?>"
            >
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input 
                class="formulario__input--sociales" 
                name="redes[tiktok]" 
                placeholder="TikTok" 
                type="text" 
                value="<?php echo $redes->tiktok ?? '' ?>"
            >
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-github"></i>
            </div>
            <input 
                class="formulario__input--sociales" 
                name="redes[github]" 
                placeholder="Github" 
                type="text" 
                value="<?php echo $redes->github ?? '' ?>"
            >
        </div>
    </div>
</fieldset>