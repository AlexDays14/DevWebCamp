<header class="header">
    <div class="header__contenedor">
        <nav class="header__navegacion">
            <?php if(!is_auth()) : ?>
                <a href="/registro" class="header__enlace">Registro</a>
                <a href="/login" class="header__enlace">Iniciar Sesión</a>
            <?php else : ?>
                <?php if(is_admin()) : ?>
                    <a href="/admin/dashboard" class="header__enlace">Panel de Administración</a>
                <?php else : ?>
                    <?php if(isset($_SESSION['boleto'])){ ?>
                        <a href="/boleto?id=<?php echo urlencode($_SESSION['boleto']) ?>" class="header__enlace">Mi Boleto</a>
                    <?php }else { ?>
                        <a href="/finalizar-registro" class="header__enlace">Registro</a>
                    <?php } ?>
                <?php endif ?>
                <form method="POST" action="/logout" class="header__form">
                    <input type="submit" value="Cerrar Sesión" class="header__submit">
                </form>
            <?php endif ?>
        </nav>

        <div <?php echo aos_animacion(); ?> class="header__contenido">
            <a href="/">
                <h1 class="header__logo">&#60;DevWebCamp/></h1>
            </a>

            <p class="header__texto">Octubre 5-6 - 2023</p>
            <p class="header__texto header__texto--modalidad">En Línea - Presencial</p>

            <?php if(isset($_SESSION['boleto'])) : ?>
                <a href="/workshops-conferencias#navegacion" class="header__boton">Ver más</a>
            <?php else: ?>
                    <?php if(is_auth()){ ?>
                        <a href="/finalizar-registro#navegacion" class="header__boton">Comprar Pase</a>
                    <?php }else{ ?>
                        <a href="/registro#navegacion" class="header__boton">Comprar Pase</a>
                    <?php } ?>
            <?php endif ?>
        </div>
    </div>
</header>
<div class="barra">
    <div class="barra__contenido">
        <a href="/#navegacion">
            <h2 class="barra__logo">
                &#60;DevWebCamp/>
            </h2>
        </a>
        <nav id="navegacion" class="navegacion">
            <a href="/devwebcamp#navegacion" class="navegacion__enlace <?php echo pagina_actual('/devwebcamp') ? 'navegacion__enlace--activo' : '' ?>">Eventos</a>
            <a href="/paquetes#navegacion" class="navegacion__enlace <?php echo pagina_actual('/paquetes') ? 'navegacion__enlace--activo' : '' ?>">Paquetes</a>
            <a href="/workshops-conferencias#navegacion" class="navegacion__enlace <?php echo pagina_actual('/workshops-conferencias') ? 'navegacion__enlace--activo' : '' ?>">Workshops / Conferencias</a>
            <?php if(!is_auth()) : ?>
                <a href="/registro#navegacion" class="navegacion__enlace <?php echo pagina_actual('/registro') ? 'navegacion__enlace--activo' : '' ?>">Comprar Pase</a>
            <?php endif ?>
        </nav>
    </div>
</div>