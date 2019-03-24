<?php

require_once 'include/common.php';
require_once 'include/protect.php';

$dao = new BookDAO();
$book = new Book();

if (isset($_GET['id'])) {
    $book = $dao->retrieve($_GET['id']);
} else if (isset($_POST['title'])) {
    $book->title = $_REQUEST['title'];
    $book->isbn13 = $_REQUEST['isbn13'];
    $book->price = $_REQUEST['price'];
}

// creating new cart item
$cartItem = new CartItem();
$cartItem->isbn13 = $book->isbn13;
$cartItem->book = $book;
$cartItem->quantity = 1;

if (isset ($_SESSION['cart'])) {
  $cart = $_SESSION['cart'];
  if (isset($cart[$book->isbn13])) {
    // obtain existing cartItem and increase quantity
    $cartItem = $cart[$book->isbn13];
    $cartItem->quantity += 1;
  } else {
    // add new cart item to cart array
    $cart[$book->isbn13] = $cartItem;
  }
} else {
  // creating new array of cart item to represent the shopping cart, and add
  // item into array
  // array is represented by isbn => cartItem, with the isbn as the key for
  // searching
  $cart = array ($book->isbn13=>$cartItem);

}
// put the cart into the session
$_SESSION['cart'] = $cart;
$_REQUEST['book-added'] = $book;

include 'cart-view.php';
?>
