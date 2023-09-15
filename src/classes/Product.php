<?php
class Product {
    public function __construct(
        private $name,
        private $amount
    )
    {}

    public function getName() {
        return $this->name;
    }

    public function getAmount() {
        return $this->amount;
    }
}
?>