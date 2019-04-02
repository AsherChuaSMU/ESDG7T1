<?php
require_once('vendor/autoload.php');

$stripe = [
  'secret_key'     =>'sk_test_5H6z88lc6DRjpkEElh2uUtal00VGG60gzp',
  'publishable_key' =>'pk_test_UsHiN8jvCBu0IcS7Xwfe29N200ZPgVcKbT'
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>