<?php

require_once 'include/common.php';
require_once 'include/token.php';

$foodId = $_POST['foodID'];


header('Location: ' . $_SERVER['HTTP_REFERER']);
?>