<?php
require_once('./src/classes/Inventory.php');

$inventario = new Inventario();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreProducto = $_POST["nombre"];
    $montoProducto = $_POST["monto"];

    $resultado = $inventario->agregarProducto($nombreProducto, $montoProducto);

    if ($resultado === true) {
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit;
    } else {
        echo $resultado;
    }
}

if (isset($_GET['borrar'])) {
    $inventario->reiniciarInventario();
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}
?>