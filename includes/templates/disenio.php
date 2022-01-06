<?php
//importa la conexion 
require __DIR__ . '/../config/database.php';
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
            <img loading="lazy" src="data:image/jpg;base64,<?php echo base64_encode($ropa['ropacol']);?>" alt="scrub de x parte" loading="lazy">
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