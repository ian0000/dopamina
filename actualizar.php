<?php
require('vendor/autoload.php');
// this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
$s3 = new Aws\S3\S3Client([
    'version'  => 'latest',
    'region'   => 'us-east-2',
    'credentials' =>
    [
		'key' => 'AWS_ACCESS_KEY_ID',
		'secret' => 'AWS_SECRET_ACCESS_KEY'
	]
    
]);
$bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');
var_dump($bucket);
?>
<html>
    <head><meta charset="UTF-8"></head>
    <body>
        <h1>S3 upload example</h1>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' ) {

    if(isset($_FILES['file'])){
        $uploadObject = $s3->putObject(
		[
			'Bucket' => 's3-demo-dopa',
			'Key' => $_FILES['file']['name'],
			'SourceFile' => $_FILES['file']['tmp_name']
		]); 
    }
    
	print_r($uploadObject); 
    var_dump($_FILES);
} ?>
        <h2>Upload a file</h2>
        <form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <input name="file" type="file"><input type="submit" value="Upload">
        </form>
    </body>
</html>