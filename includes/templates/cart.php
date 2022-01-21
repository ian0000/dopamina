<?php

define('IMAGE_URL',"https://s3-demo-dopa.s3.us-east-2.amazonaws.com/");
$query = "SELECT * FROM ropa WHERE id =  ${busqueda}";

$resultado = mysqli_query($db, $query);
?>

<tr>
    <?php
    while ($fila = mysqli_fetch_row($resultado)) {
    ?>
        <td><?php echo $numero; ?></td>
        <?php echo "<td><img src='".IMAGE_URL."".$fila[7]."' class='imagen-small'></td>"?>
        <td><?php echo $fila[1]; ?></td>
        <td><?php echo $fila[3]; ?></td>
        <td><?php echo $cantidad ?></td>
        <td> $ <?php echo $cantidad * $fila[3] ?></td>
    <?php
    }
    ?>
</tr>