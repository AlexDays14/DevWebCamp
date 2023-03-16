<main class="auth">
    <h2 id="auth__heading" class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Recupera tu Acceso a DevWebcamp</p>

    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <form method="POST" action="/olvide#auth__heading" class="formulario">
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input 
                type="email"
                class="formulario__input"
                id="email"
                placeholder="Tu Email"
                name="email"
            >
        </div>

        <input 
            type="submit"
            class="formulario__submit"
            value="Enviar Instrucciones"
        >
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Inicia Sesión</a>
        <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? Create una Cuenta</a>
    </div>
</main>