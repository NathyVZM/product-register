<?php
require_once('./src/classes/Product.php');
require_once('./src/classes/Inventory.php');

session_start();

require_once('./src/helpers/addProduct.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Productos</title>
</head>
<body>
    <h1>Registro de Productos</h1>
    <form method="POST">
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" name="nombre" required><br><br>
        
        <label for="monto">Monto (en Bs.):</label>
        <input type="number" name="monto" required><br><br>
        
        <input type="submit" value="Registrar Producto">
    </form>
    
    <h2>Inventario de Productos:</h2>
    <ul>
        <?php foreach ($inventario->getProductos() as $producto) { ?>
            <li><?php echo $producto->getNombre(); ?> - <?php echo $producto->getMonto(); ?> Bs.</li>
        <?php } ?>
    </ul>
    
    <p>Cantidad de productos registrados: <?php echo count($inventario->getProductos()); ?></p>
    
    <p>Monto Total: <?php echo $inventario->getTotalMonto(); ?> Bs.</p>
    
    <a href="?borrar=1">Borrar Inventario</a>
</body>
</html>
