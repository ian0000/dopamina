<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'includes/funciones.php';
require('vendor/autoload.php');
$errores= [];
// variables del formulario
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
        $emailuser = getenv('EMAILUSERNAME');
        $emailpass = getenv('EMAILPASSWORD');
        $emailhost = getenv("EMAILHOST");
        

        $mensajefinal = "correo:".$correo."\n"."nombre".$nombre."\n"."celular".$celular."\n"."mensaje".$mensaje;
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $emailhost;
        $mail->SMTPAuth = "true";
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = $emailuser;
        $mail->Password = $emailpass;
        $mail->Subject = "Test Email";
        $mail->setFrom($emailuser);
        $mail->Body = "this is a test";
        $mail->addAddress("niklas0617@gmail.com");
        if ($mail->Send()) {
            echo "mail sent";
        } else{
            echo "error".$mail->ErrorInfo;
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
<form action="" method="POST" class="formulario contacto">
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
    <input type="submit" value="Enviar" class="btn-verde">
</form>

<?php
incluirTemplate('footer');
?>