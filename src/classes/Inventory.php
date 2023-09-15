<?php
require_once('./src/classes/Product.php');

class Inventory {
    private $products = [];
    private $totalAmount = 0;
    private $maxTotalAmount = 50000;
    private $maxIndividualAmount = 3500;

    public function __construct() {
        // Verifica si existe una instancia previa de Inventario en la sesión y la carga
        if (isset($_SESSION["inventory"])) {
            $inventory = $_SESSION["inventory"];
            $this->products = $inventory->getProducts();
            $this->totalAmount = $inventory->getTotalAmount();
        }
    }

    public function addProduct($name, $amount) {
        // Valida que el monto individual no sea mayor al límite
        if ($amount <= $this->maxIndividualAmount) {
            // Valida que el monto total no supere el límite
            if (($this->totalAmount + $amount) <= $this->maxTotalAmount) {
                // Agrega el producto al inventario
                $producto = new Product($name, $amount);
                $this->products[] = $producto;
                // Actualiza el total del monto
                $this->totalAmount += $amount;

                // Guarda la instancia actual de Inventario en la sesión
                $_SESSION["inventory"] = $this;

                return true;
            } else {
                return "El monto total de los productos no puede superar los {$this->maxTotalAmount} Bs.";
            }
        } else {
            return "El monto individual de un producto no puede superar los {$this->maxIndividualAmount} Bs.";
        }
    }

    public function getProducts() {
        return $this->products;
    }

    public function getTotalAmount() {
        return $this->totalAmount;
    }

    public function restartInventory() {
        $this->products = [];
        $this->totalAmount = 0;

        // Borra la instancia de Inventario de la sesión
        unset($_SESSION["inventory"]);
    }
}
?>