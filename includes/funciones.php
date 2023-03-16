<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function pagina_actual($path) : bool {
    return str_contains($_SERVER['REQUEST_URI'] ?? '/', $path) ? true : false;
}

function is_auth() : bool{
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    return isset($_SESSION['nombre']) && !empty($_SESSION);
}

function is_admin() : bool{
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}

function aos_animacion() : string{
    $efectos = ['fade-up', 'fade-down', 'fade-left', 'fade-right', 'zoom-in', 'zoom-in-up', 'zoom-in-down', 'zoom-out', 'flip-left', 'flip-right'];
    $efecto = array_rand($efectos, 1);
    $efecto = $efectos[$efecto];
    return 'data-aos = "' . $efecto . '"';
}
