<?php
require('../../vendor/autoload.php');
// this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
use Aws\S3\S3Client; 
use Aws\Exception\AwsException; 

$s3 = new Aws\S3\S3Client([
    'version'  => 'latest',
    'region'   => 'us-east-2',
    
    
]);
$bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');
var_dump($bucket);
?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_FILES);
    try {
        if(isset($_FILES['userfile']))
        {
            $uploadObject = $s3->putObject(
                [
                    'Bucket' => 's3-demo-dopa',
                    'Key' => $_FILES['userfile']['name'],
                    'SourceFile' => $_FILES['userfile']['tmp_name']
                ]); 

            var_dump($uploadObject['ObjectURL']); 
            var_dump($uploadObject['ObjectURL'].PHP_EOL); 
        }
        ?>
        <p>Upload <a href="<?=htmlspecialchars($uploadObject->get('ObjectURL'))?>">successful</a> :)</p>
<?php } catch(Exception $e) { echo $e ?>
        <p>Upload error :(</p>
<?php } } ?>
        <h2>Upload a file</h2>
        <form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <input name="userfile" type="file"><input type="submit" value="Upload">
        </form>
    </body>
</html>