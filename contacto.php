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
        $hostname = getenv('CLOUDMAILIN_FORWARD_ADDRESS');
        $username = getenv('CLOUDMAILIN_USERNAME');
        $password = getenv('CLOUDMAILIN_PASSWORD');

        $transport = (new Swift_SmtpTransport($hostname, 587, 'tls'))
        ->setUsername($username)
        ->setPassword($password);

        $mailer = new Swift_Mailer($transport);
        $message = (new Swift_Message())
        ->setSubject('Hello from PHP SwiftMailer')
        ->setFrom(['ianmenaamagua@gmail.com'])
        ->setTo(['niklas0617@gmail.com' => 'User Name']);

        $headers = ($message->getHeaders())
        -> addTextHeader('X-CloudMTA-Class', 'standard');

        $message->setBody(
        '<body>'.
        '<h1>hello from php</h1>'.
        '</body>'
        );
        $message->addPart('hello from PHP', 'text/plain');
        $mailer->send($message);
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