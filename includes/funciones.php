<?php
require 'app.php';
function incluirTemplate(string $nombre)
{
    // include "includes/templates/${nombre}.php";
    include TEMPLATES_URL . "/${nombre}.php";
}


//para autenticar que se haya iniciado sesion
function autenticacion(): bool
{
    //funcion base que realiza el inicio de sesion
    session_start();

    //cuando se pase el estado de login 
    $auth = $_SESSION['login'];
    //si esta lleno pasa si no false
    if ($auth) {
        return true;
    }

    return false;
}
