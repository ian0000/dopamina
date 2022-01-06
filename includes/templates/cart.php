<?php
$query = "SELECT * FROM ropa WHERE id =  ${busqueda}";

$resultado = mysqli_query($db, $query);
?>

<tr>
    <?php
    while ($fila = mysqli_fetch_row($resultado)) {
    ?>
        <td><?php echo $numero; ?></td>
        <td><img src="data:image/jpg;base64,<?php echo base64_encode($fila[2]);?>" class="imagen-small" alt="imagen"></td>
        <td><?php echo $fila[1]; ?></td>
        <td><?php echo $fila[3]; ?></td>
        <td><?php echo $cantidad ?></td>
        <td> $ <?php echo $cantidad * $fila[3] ?></td>
    <?php
    }
    ?>
</tr>