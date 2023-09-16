<?php
require_once('./src/classes/Product.php');

class Inventory {
    private $products = [];
    private $totalAmount = 0;
    private $maxTotalAmount = 50000;
    private $maxIndividualAmount = 3500;

    public function __construct() {
        if (isset($_SESSION["inventory"])) {
            $inventory = $_SESSION["inventory"];
            $this->products = $inventory->getProducts();
            $this->totalAmount = $inventory->getTotalAmount();
        }
    }

    public function addProduct($name, $amount) {
        if ($amount <= $this->maxIndividualAmount) {
            if (($this->totalAmount + $amount) <= $this->maxTotalAmount) {
                $producto = new Product($name, $amount);
                $this->products[] = $producto;
                $this->totalAmount += $amount;

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
        unset($_SESSION["inventory"]);
    }
}
?>