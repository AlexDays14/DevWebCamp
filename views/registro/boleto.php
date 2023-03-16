<main class="pagina">
    <h2 class="pagina__heading"><?php echo $titulo; ?></h2>
    <p class="pagina__descripcion">Ya está listo tu boleto. Guárdalo para acceder al evento.</p>

    <div class="boleto-virtual">
        <div class="boleto boleto--<?php echo strtolower($registro->paquete); ?> boleto--acceso">
            <div class="boleto__contenido">
                <h4 class="boleto__logo">&#60;DevWebCamp/></h4>
                <p class="boleto__plan"><?php echo ($registro->paquete); ?></p>
                <p class="boleto__nombre"><?php echo ($registro->usuario); ?></p>
            </div>

            <p class="boleto__codigo">#<?php echo ($registro->token); ?></p>
        </div>
    </div>
</main>