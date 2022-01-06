<?php
require 'includes/funciones.php';
incluirTemplate('header');
?>

<form action="https://formspree.io/f/mbjqqrkg" method="POST" class="formulario contacto">
    <fieldset>
        <legend>Envianos un Mensaje</legend>
        <label for="nombre">Nombre y Apellido</label>
        <input type="text" class="dato" name="nombre" placeholder="Tu Nombre aquí....">
        <label for="correo">Correo de Contacto<span>*</span></label>
        <input type="email" class="dato" name="correo" placeholder="Tu Correo aquí...." required>
        <label for="celular">Tu Número de Celular <span>*</span></label>
        <input type="tel" class="dato" name="celular" placeholder="Tu Número Celular aquí...." required>
        <label for="mensaje">Tu Mensaje <span>*</span></label>
        <textarea name="mensaje" id="mensaje" cols="30" rows="5" required></textarea>
    </fieldset>
    <input type="submit" value="Enviar" class="btn-verde" onclick="window.location.href='index.html';">
</form>

<?php
incluirTemplate('footer');
?>