<?php
  require_once('stripephp/config.php');
  require_once 'include/common.php';
  require_once 'include/protect.php';


  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];
  $total_price = 

  $customer = \Stripe\Customer::create([
      'email' => $email,
      'source'  => $token,
  ]);

  $charge = \Stripe\Charge::create([
      'customer' => $customer->id,
      'amount'   => $_SESSION['total_price']*100,
      'currency' => 'sgd',
  ]);

  $amountdollar = ($charge['amount']) / 100 ;

  // echo '<h1>Hi Yong Long</h1>';
  // echo '<h1>You are successfully charged $'.$amountdollar.' for the order</h1>';
?>