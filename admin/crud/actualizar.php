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
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id || !$auth) {
    header('Location:/admin');
}

$db = conectarDB();
//consultar la ropa
$consulta = "SELECT * FROM ropa WHERE id = ${id}";
$resultado = mysqli_query($db, $consulta);
$ropa = mysqli_fetch_assoc($resultado);

//arreglo con los mensajes de error
$errores = [];

//datos para crear ropa
$nombre =  $ropa['nombre'];
$precio = $ropa['precio'];
$cantidad = $ropa['cantidad'];
$descuento = $ropa['descuento'];
$descripcion = $ropa['descripcion'];
$imagen = $ropa['imagen'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $cantidad = mysqli_real_escape_string($db, $_POST['cantidad']);
    $descuento = mysqli_real_escape_string($db, $_POST['descuento']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);


    //files
    $imagen = $_FILES['imagen'];
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

   
    //revisar que no este vacio el programa
    if (empty($errores)) {
       
        $nombreImagen = '';
        //subida de archivos

        // generar nombre unico
        if($imagen['name']){

            $data = $_FILES['file']['name'];
            list($filename, $filetype) = explode(".",$data);
            $nombreImagen = md5(uniqid(rand(),true)).".".$filetype;
            $uploadObject = $s3->putObject(
                        [
                            'Bucket' => 's3-demo-dopa',
                            'Key' => $nombreImagen,
                            'SourceFile' => $_FILES['file']['tmp_name']
                        ]); 
                        $linkS3 = $uploadObject['ObjectURL'];
                        var_dump($linkS3);
                        var_dump($nombreImagen);
        }else{
            
            $nombreImagen = $ropa['imagen'];
        }

        // $query = "UPDATE ropa SET nombre = '${nombre}',ropacol = '${$linkS3}',precio = '${precio}',cantidad = '${cantidad}',descuento = '${descuento}',descripcion = '${descripcion}',imagen = '${nombreImagen}.${filetype}' WHERE id = ${id};";
        // $resultado = mysqli_query($db, $query);

        // if ($resultado) {
        //     header('Location:/admin?resultado=2');
        // }
    }
}
incluirTemplate('headerCrud');
?>
<main class="contenedor seccion crud">
    <h1>Actualiza una coleccion</h1>
    <a href="/admin" class="btn-volver">Volver</a>
    <?php foreach ($errores as $error) { ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php } ?>
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Ropa Nueva</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre..." value="<?php echo $nombre ?>">

            <label for="imagen">imagen:</label>
            <input type="file" name="imagen" id="imagen" accept="image.jpg, image.png">

            <label for="precio">Precio:</label>
            <input type="number" name="precio" id="precio" placeholder="Precio..." value="<?php echo $precio ?>">

            <label for="cantidad">cantidad:</label>
            <input type="number" name="cantidad" id="cantidad" placeholder="cantidad..." value="<?php echo $cantidad ?>">

            <label for="descuento">Descuento:</label>
            <input type="number" name="descuento" id="descuento" placeholder="Descuento..." value="<?php echo $descuento ?>">

            <label for="descripcion">Descripcion:</label>
            <textarea name="descripcion" id="descripcion"><?php echo $descripcion ?></textarea>

        </fieldset>
        <input type="submit" value="Actualizar" class="btn-verde">
    </form>

</main>

<?php incluirTemplate('footer'); ?>