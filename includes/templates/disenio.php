<?php
//importa la conexion 
require __DIR__ . '/../config/database.php';

define('IMAGE_URL',"https://s3-demo-dopa.s3.us-east-2.amazonaws.com/");
$db = conectarDB();
$query = "SELECT * FROM ropa ORDER BY id DESC LIMIT ${limite}";
$resultado = mysqli_query($db, $query);
?>

<div class="cartas-nosotros">
    <?php

        while ($ropa = mysqli_fetch_assoc($resultado)) {
            
    ?>
        <div class="carta">
            <p class="stock">stock: <?php echo $ropa['cantidad']; ?></p>
            <?php echo "<td><img src='".IMAGE_URL."".$ropa['imagen']."' class='imagen-small'></td>"?>
            <div class="datos">
                <h4> $<?php echo $ropa['precio']; ?></h4>
                <h3><?php echo $ropa['nombre']; ?></h3>
                <p class="descripcion"><?php echo $ropa['descripcion']; ?></p>
                <div class="conteo">
                    <i id="resta" class="fas fa-minus" onclick="add(-1, <?php echo $ropa['id'] ?>, <?php echo $ropa['cantidad'] ?>)"></i>

                    <p id="value-<?php echo $ropa['id'] ?>"> 0 </p>

                    <i id="suma" class="fas fa-plus" onclick="add(1, <?php echo $ropa['id'] ?>, <?php echo $ropa['cantidad'] ?>)"></i>
                </div>
            </div>
        </div>

    <?php }
    
    ?>

</div>

<script src="src/js/app.js"></script>
<?php
//cerrar la conexion 
mysqli_close($db);
?>