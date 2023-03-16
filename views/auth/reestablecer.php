<main class="auth">
    <h2 id="auth__heading" class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Reestablece Tu Contraseña DevWebcamp</p>

    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <?php if($token_valido) { ?>
        <form method="POST" class="formulario">
            <div class="formulario__campo">
                <label for="email" class="formulario__label">Nuevo Password</label>
                <input 
                    type="password"
                    class="formulario__input"
                    id="password"
                    placeholder="Tu Nuevo Password"
                    name="password"
                >
            </div>

            <input 
                type="submit"
                class="formulario__submit"
                value="Guardar Password"
            >
        </form>
    <?php } ?>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Inicia Sesión</a>
        <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? Create una Cuenta</a>
    </div>
</main>