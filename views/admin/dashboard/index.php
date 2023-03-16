<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<main class="bloques">
    <div class="bloques__grid">
        <div class="bloque">
            <h3 class="bloque__heading">Últimos Registros</h3>
            <?php foreach($registros as $registro){ ?>
                <div class="bloque__contenido">
                    <p class="bloque__texto"><?php echo $registro->usuario->get_nombre_completo(); ?></p>
                </div>
            <?php } ?>
        </div>
        <div class="bloque">
            <h3 class="bloque__heading">Ingresos</h3>
            <div class="bloque__contenido">
                <p class="bloque__texto--ingresos">Total: $ <?php echo $total; ?></p>
            </div>
            <div class="bloque__contenido">
                <p class="bloque__texto--subtotal">Subtotal: $ <?php echo $subtotal; ?></p>
            </div>
        </div>
        <div class="bloque">
            <h3 class="bloque__heading">Eventos mas Populares</h3>
            <?php foreach($menos_lugares as $evento){ ?>
                <div class="bloque__contenido">
                    <p class="bloque__texto"><?php echo $evento->nombre . ' - ' . $evento->disponibles; ?></p>
                </div>
            <?php } ?>
        </div>
        <div class="bloque">
            <h3 class="bloque__heading">Eventos menos Demandados</h3>
            <?php foreach($mas_lugares as $evento){ ?>
                <div class="bloque__contenido">
                    <p class="bloque__texto"><?php echo $evento->nombre . ' - ' . $evento->disponibles; ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</main>