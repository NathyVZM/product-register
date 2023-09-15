<?php
require_once('./src/classes/Product.php');

class Inventario {
    private $productos = [];
    private $totalMonto = 0;
    private $limiteMontoTotal = 50000;
    private $limiteMontoIndividual = 3500;

    public function __construct() {
        // Verifica si existe una instancia previa de Inventario en la sesión y la carga
        if (isset($_SESSION["inventario"])) {
            $inventario = $_SESSION["inventario"];
            $this->productos = $inventario->getProductos();
            $this->totalMonto = $inventario->getTotalMonto();
        }
    }

    public function agregarProducto($nombre, $monto) {
        // Valida que el monto individual no sea mayor al límite
        if ($monto <= $this->limiteMontoIndividual) {
            // Valida que el monto total no supere el límite
            if (($this->totalMonto + $monto) <= $this->limiteMontoTotal) {
                // Agrega el producto al inventario
                $producto = new Producto($nombre, $monto);
                $this->productos[] = $producto;
                // Actualiza el total del monto
                $this->totalMonto += $monto;

                // Guarda la instancia actual de Inventario en la sesión
                $_SESSION["inventario"] = $this;

                return true;
            } else {
                return "El monto total de los productos no puede superar los {$this->limiteMontoTotal} Bs.";
            }
        } else {
            return "El monto individual de un producto no puede superar los {$this->limiteMontoIndividual} Bs.";
        }
    }

    public function getProductos() {
        return $this->productos;
    }

    public function getTotalMonto() {
        return $this->totalMonto;
    }

    public function reiniciarInventario() {
        $this->productos = [];
        $this->totalMonto = 0;

        // Borra la instancia de Inventario de la sesión
        unset($_SESSION["inventario"]);
    }
}
?>