<?php
class CartItem {
    public $name;
    public $qty;
    public $price;
    public $total;

    function __construct($name, $qty, $price){
        $this->name = $name;
        $this->qty = $qty;
        $this->price = $price;
        $this->total = $price * $qty;
    }
}
?>