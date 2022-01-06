<?php
require 'includes/funciones.php';
incluirTemplate('header');
?>

<div class="bg-image"></div>
<main class="contenedor seccion">
    <h1 class="titulo center">Dopamina Scrub</h1>
    <p class="frase center">el verdadero poder del scrub </p>
    <a href="nosotros.php" class="link">Saber Más <i class="far fa-question-circle"></i></a>
    <a href="coleccion.php" class="btn">Ver Colecciones Scrub </a>
</main>
<!-- seccion de cartas / ultimos 3 disños ingresados en la bd -->
<section class="seccion contenedor">
    <h2> Nuestros Ultimos Diseños</h2>
    <a class="referencia" href="https://storyset.com/people">People illustrations by Storyset</a>

    <?php
    $limite = 3;
    include 'includes/templates/disenio.php';
    ?>
</section>
<a href="http://" class="btn centrado">Ver Más </a>

<!-- los 3 primeros ingresos de personal -->
<section class="seccion contenedor somos">

    <h2>¿Quienes Somos?</h2>
    <div class="bg-image who"></div>

    <div class="informacion">
        <div class="tarj ">
            <img src="dist/img/pic.svg" alt="foto principal">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, esse nam ratione quis itaque voluptas repudiandae culpa natus nostrum perferendis doloribus consequatur debitis non obcaecati!</p>
        </div>
        <div class="tarj ">
            <img src="dist/img/pic.svg" alt="foto principal">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, esse nam ratione quis itaque voluptas repudiandae culpa natus nostrum perferendis doloribus consequatur debitis non obcaecati!</p>
        </div>
        <div class="tarj ">
            <img src="dist/img/pic.svg" alt="foto principal">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, esse nam ratione quis itaque voluptas repudiandae culpa natus nostrum perferendis doloribus consequatur debitis non obcaecati!</p>
        </div>

    </div>
</section>



<?php
incluirTemplate('footer');
?>
