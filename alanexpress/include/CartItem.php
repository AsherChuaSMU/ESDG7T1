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
                self::__construct0($argv[0],$argv[1],$argv[2]);
                break;
        }
    }

     public function __construct0($isbn13='', $book='', $price='') {
        $this->isbn13 = $isbn13;
        $this->book = $book;
        $this->price = $price;
    }
}

?>
