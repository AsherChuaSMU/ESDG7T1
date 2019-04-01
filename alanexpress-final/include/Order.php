<?php

class Order {
    // property declaration
    // public $id;
    // public $customerId;    
    // public $cartItems;
    public function __construct(){
        $argv = func_get_args();

        switch (func_num_args()){
            case 2:
                self::__construct0($argv[0],$argv[1]);
                break;
            case 3:
                self::__construct0($argv[0],$argv[1], $argv[2]);
                break;
        }
    }

    public function __construct0($customerId='', $cartItems='') {
        $this->customerId = $customerId;
        $this->cartItems = $cartItems;
    }

    public function __construct1($id='', $customerId='', $cartItems='') {
        $this->id = $id;
        $this->customerId = $customerId;
        $this->cartItems = $cartItems;
    }
}

?>
