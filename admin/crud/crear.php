<?php
require '../../includes/funciones.php';
require '../../includes/config/database.php';

require('../../vendor/autoload.php');
use Aws\S3\S3Client; 
use Aws\Exception\AwsException; 
$s3 = new Aws\S3\S3Client([
    'version'  => 'latest',
    'region'   => 'us-east-2', 
]);
$bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');

$auth = autenticacion();
if(!$auth){
    header('Location:/admin');
}

$db = conectarDB();

$consulta ="SELECT * FROM ropa";
$resultado = mysqli_query($db, $consulta);

$errores= [];

$nombre = '';
$precio = '';
$cantidad = '';
$descuento = '';
$descripcion = '';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $cantidad = mysqli_real_escape_string($db, $_POST['cantidad']);
    $descuento = mysqli_real_escape_string($db, $_POST['descuento']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);


    //files
    $file = $_FILES['file'];
    if (!$nombre) {
        $errores[] = 'Debes agregar un nombre';
    }
    if (!$precio) {
        $errores[] = 'Debes agregar un precio';
    }
    if (!$cantidad) {
        $errores[] = 'Debes agregar una cantidad';
    }
    if (!$descripcion) {
        $errores[] = 'Debes agregar una descripcion';
    }
    if (!$file['name'] || $file['error']) {
        $errores[] = 'La imagen es obligatoria';
    }
    $nombreImagen = $file['name'];
    if(empty($errores)){
        try {
            if(isset($_FILES['file'])){
                $uploadObject = $s3->putObject(
                    [
                        'Bucket' => 's3-demo-dopa',
                        'Key' => $_FILES['file']['name'],
                        'SourceFile' => $_FILES['file']['tmp_name']
                    ]); 
                    $linkS3 = $uploadObject['ObjectURL'];
                var_dump($linkS3); 
                $query = "INSERT INTO ropa(nombre, ropacol, precio, cantidad, descuento, descripcion, imagen) VALUES('$nombre','$linkS3','$precio','$cantidad','$descuento','$descripcion','$nombreImagen');";
                $resultado = mysqli_query($db, $query);
              
                    var_dump($query);
                // if ($resultado) {
                //     header('Location:../index.php?resultado=1');
                // }
            }
        } catch (Exception $e) {
            $errores[] = 'Error al subir la imagen'.$e;
        }
    }
}

incluirTemplate('headerCrud');
?>

<main class="contenedor seccion crud">
    <h1>Crear una nueva ropa</h1>
    <a href="/admin" class="btn-volver"></a>
    <?php foreach($errores as $error){ ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php }?>
<form action="" class="formulario" method="POST" enctype="multipart/form-data">
    <fieldset>
            <legend>Ropa Nueva</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre..." value="<?php echo $nombre ?>">

            <label for="file">imagen:</label>
            <input type="file" name="file" id="file" accept="image.jpg, image.png">

            <label for="precio">Precio:</label>
            <input type="number" name="precio" id="precio" placeholder="Precio..." value="<?php echo $precio ?>">

            <label for="cantidad">cantidad:</label>
            <input type="number" name="cantidad" id="cantidad" placeholder="cantidad..." value="<?php echo $cantidad ?>">

            <label for="descuento">Descuento:</label>
            <input type="number" name="descuento" id="descuento" placeholder="Descuento..." value="<?php echo $descuento ?>">

            <label for="descripcion">Descripcion:</label>
            <textarea name="descripcion" id="descripcion"><?php echo $descuento ?></textarea>

        </fieldset>
        <input type="submit" value="Crear Ropa" class="btn-verde">    
</form>
</main>

<?php incluirTemplate('footer');?>