<?php

use function PHPSTORM_META\type;

$i = 0;
$total = 0;
$cantidad1 = 0;
require 'includes/funciones.php';
incluirTemplate('header');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tmp;
    $tmp1;
    if (!empty($_POST)) {
        $array = $_POST['item'];
        foreach ($_POST['item'] as $key) {
            $tmp[$i] = explode(',', $key);
            $i++;
        }
    }
}
require __DIR__ . '/includes/config/database.php';
$db = conectarDB();
?>

<main class="contenedor seccion tabla">
    <form action="/index.php" method="POST" id="form">

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>IMAGEN</th>
                    <th>NOMBRE</th>
                    <th>PRECIO</th>
                    <th>CANTIDAD</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($j = 0; $j < $i; $j++) {
                    $busqueda = $tmp[$j][0];
                    $cantidad = $tmp[$j][1];
                    $query = "SELECT precio FROM ropa WHERE id =  ${busqueda}";
                    $resultado = mysqli_query($db, $query);
                    $fila = mysqli_fetch_row($resultado);
                    $total += $tmp[$j][1] * $fila[0];
                    $numero = $j + 1;
                    include 'includes/templates/cart.php';
                }
                ?>
            </tbody>
            <tr>
                <td></td>
                <td colspan="3">Total:</td>
                <?php
                for ($j = 0; $j < $i; $j++) {
                    $cantidad1 += $tmp[$j][1];
                    ?>
                <?php
                var_dump($busqueda);
                }
                ?>
                <td onload="total(<?php echo $cantidad1 ?>)"><?php echo $cantidad1 ?></td>
                <td>$ <?php echo $total ?></td>
            </tr>
        </table>
        <input type="submit" value="Confirmar " class="btn-verde">
        <a href="/carrito.php" class="btn-rojo">Cancelar</a>
    </form>
</main>



<?php
incluirTemplate('footer');
?>