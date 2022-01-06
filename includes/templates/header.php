<?php

if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="favicon.png">
    <title>DOPAMINA</title>
    <script src="https://kit.fontawesome.com/ca287116b3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="dist/css/main.css">
</head>

<body>
    <header class=" header ">
        <div class="nav ">
            <a class="logo" href="/ugh/ ">
                <img id="logo1" src="dist/img/logo.png" alt="Logotipo de rayo" onclick="data()">
                <img id=" logo2" src="dist/img/DOPAMINA.png" alt="Logotipo de scrubs " onclick="data()">
            </a>
            <div class=" derecha ">
                <nav class=" navegacion ">
                    <a href="nosotros.php">Nosotros</a>
                    <form action="coleccion.php">
                        <input type="submit" value="Colecciones" class="cart" onclick="data()">
                    </form>
                    <a href="pedidos.html ">Pedidos</a>
                    <a href="contacto.php">Contacto</a>

                    <?php if ($auth) { ?>
                        <a href="cerrar-sesion.php">Cerrar Sesion</a>
                        <a href="admin/index.php">Administrar</a>
                    <?php } else { ?>
                        <a href="login.php">Iniciar Sesion</a>
                        <form action="carrito.php" method="POST" id="form">
                            <input type="submit" value="Carrito 0" id="cart" class="cart" onclick="data()">
                        </form>
                    <?php
                    } ?>

                </nav>
            </div>

        </div>
    </header>