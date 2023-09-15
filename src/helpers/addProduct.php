<?php
require_once('./src/classes/Inventory.php');

$inventory = new Inventory();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST["name"];
    $productAmount = $_POST["amount"];

    $result = $inventory->addProduct($productName, $productAmount);

    if ($result === true) {
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit;
    } else {
        echo $result;
    }
}

if (isset($_GET['delete'])) {
    $inventory->restartInventory();
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}
?>