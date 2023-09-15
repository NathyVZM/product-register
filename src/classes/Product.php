<?php
class Producto {
    private $nombre;
    private $monto;

    public function __construct($nombre, $monto) {
        $this->nombre = $nombre;
        $this->monto = $monto;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getMonto() {
        return $this->monto;
    }
}
?>