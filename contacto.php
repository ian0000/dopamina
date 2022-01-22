<?php
require 'includes/funciones.php';
require 'includes/config/database.php';
$errores= [];
// variables del formulario

$db = conectarDB();
$nombre = '';
$correo = '';
$celular = '';
$mensaje='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $celular = $_POST['celular'];
    $mensaje = $_POST['mensaje'];
    if (!$nombre) {
        $errores[] = 'Debes agregar un nombre';
    }
    if (!$correo) {
        $errores[] = 'Debes agregar un correo';
    }
    if (!$celular) {
        $errores[] = 'Debes agregar un celular';
    }
    if (!$mensaje) {
        $errores[] = 'Debes agregar un mensaje';
    }
    if(empty($errores)){
        
        $query = "INSERT INTO contacto(nombre, correo, celular, mensaje) VALUES ('$nombre','$correo', '$celular', '$mensaje');";
        $resultado - mysqli_query($db, $query);
        if($resultado){
            header('Location: contacto.php');
        }
    }
}
incluirTemplate('header');
?>
<?php foreach($errores as $error){ ?>
    <div class="alerta error">
        <?php echo $error ?>
    </div>
<?php }?>
<form action="https://formspree.io/f/mbjqqrkg" method="POST" class="formulario contacto">
    <fieldset>
        <legend>Envianos un Mensaje</legend>
        <label for="nombre">Nombre y Apellido</label>
        <input type="text" class="dato" name="nombre" placeholder="Tu Nombre aquí...." required>
        <label for="correo">Correo de Contacto<span>*</span></label>
        <input type="email" class="dato" name="correo" placeholder="Tu Correo aquí...." required>
        <label for="celular">Tu Número de Celular <span>*</span></label>
        <input type="tel" class="dato" name="celular" placeholder="Tu Número Celular aquí...." required>
        <label for="mensaje">Tu Mensaje <span>*</span></label>
        <textarea name="mensaje" id="mensaje" cols="30" rows="5" required></textarea>
    </fieldset>
    <input type="submit" value="Enviar" class="btn-verde">
</form>

<?php
incluirTemplate('footer');
?>