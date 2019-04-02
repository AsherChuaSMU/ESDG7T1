<?php
  require_once('./config.php');

  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];

  $customer = \Stripe\Customer::create([
      'email' => $email,
      'source'  => $token,
  ]);

  $charge = \Stripe\Charge::create([
      'customer' => $customer->id,
      'amount'   => 5000,
      'currency' => 'sgd',
  ]);

  $amountdollar = ($charge['amount']) / 100 ;

  echo '<h1>Hi Yong Long</h1>';
  echo '<h1>You are successfully charged $'.$amountdollar.' for the order</h1>';
?>