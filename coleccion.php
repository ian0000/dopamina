<?php
require 'includes/funciones.php';
incluirTemplate('header');
?>
<div class="separacion"></div>
<section class="seccion contenedor">
    <h2> Nuestros Diseños</h2>
    <a class="referencia" href="https://storyset.com/people">People illustrations by Storyset</a>
    <!-- <div class="grid">
        <img src="/build/img/grid-small.svg" alt="grid pequenio">
        <img src="/build/img/grid.svg" alt="grid grande">
    </div> -->
    <?php
    $limite = 10;
    include 'includes/templates/disenio.php';
    ?>
</section>


<?php
incluirTemplate('footer');
?>