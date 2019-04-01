<?php

class CartItem {
    // property declaration
    // public $isbn13;
    // public $book;
    // public $price;
    public function __construct(){
        $argv = func_get_args();

        switch (func_num_args()){
            case 3:
                self::__construct0($argv[0],$argv[1],$argv[2],$args[3],$args[4],$args[5]);
                break;
        }
    }

     public function __construct0($order_id='', $customer_id='', $food_id='', $restaurant_id='', $driver_id='', $quantity='') {
        $this->order_id = $order_id;
        $this->customer_id = $customer_id;
        $this->food_id = $food_id;
        $this->restaurant_id = $restaurant_id;
        $this->driver_id = $driver_id;
        $this->quantity = $quantity;


    }
}

?>
