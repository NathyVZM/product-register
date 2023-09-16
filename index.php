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
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <section>
        <div class="container">
            <h1>Registro de Productos</h1>
            <form method="POST">
                <div>
                    <input type="text" name="name" required placeholder="Nombre del producto" class="input">
                    <input type="number" name="amount" required placeholder="Monto (en Bs.)" class="input">
                </div>
                <input type="submit" value="Registrar Producto" class="button">
            </form>
        </div>
    </section>
    
    <section>
        <div class="container">
            <header>
                <div>
                    <h2>Monto Total: <?php echo $inventory->getTotalAmount(); ?> Bs.</h2>
                    <h3>Cantidad de productos registrados: <?php echo count($inventory->getProducts()); ?></h3>
                </div>
                <a href="?delete=1" class="button">Borrar Inventario</a>
            </header>
            <ul>
                <?php foreach ($inventory->getProducts() as $product) { ?>
                    <li class="card">
                        <span><?php echo $product->getName(); ?></span>
                        <span><?php echo $product->getAmount(); ?> Bs.</span>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </section>
</body>
</html>
