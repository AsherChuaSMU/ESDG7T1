<?php

require_once 'include/common.php';
require_once 'include/token.php';

// isMissingOrEmpty(...) is in common.php
$errors = [ isMissingOrEmpty ('username'), isMissingOrEmpty ('password') ];
$errors = array_filter($errors);


if (!isEmpty($errors)) {
    $_SESSION['errors'] = $errors;
    include "login-view.php";
    exit();
}

$username = $_POST['username'];
$enteredPwd = $_POST['password'];


// Replace this serviceURL to yours
$serviceURL = $_SESSION['url'].":8082/users1/".$username;


// Service invocation via GET
$json = file_get_contents($serviceURL);

// parsing the String in JSON format to objects so we can manipulate it by
// looping etc
$data = json_decode($json, TRUE);

// as the data is wrapped in an array with 1 element Book, we have to extract
// the Book, in order to get the list of Books
$password = $data['password'];
$user = $data['username'];
$usertype = $data['usertype'];
$gender = $data['gender'];


if (isset($user) && $password == $enteredPwd && $usertype == 'admin'){
	$_SESSION['admin'] = 1;
	$user->name = "Admin";
	$user->gender = "male";
	$user->username="admin";
	$_SESSION['user'] = $user;
	$token = generate_token($username);
    $_SESSION['token'] = $token;
	header("Location: list-view-restaurant.php");
} elseif (isset($user) && $password == $enteredPwd && $usertype == 'customer') {
	$_SESSION['admin'] = 0;
    $_SESSION['user'] = $user;
    $_SESSION['gender'] = $gender;
    $token = generate_token($username);
    $_SESSION['token'] = $token;
    header("Location: list-view-restaurant.php");
} elseif (isset($user) && $password == $enteredPwd && $usertype == 'driver') {
    $_SESSION['admin'] = 0;
    $_SESSION['user'] = $user;
    $_SESSION['gender'] = $gender;
    $token = generate_token($username);
    $_SESSION['token'] = $token;
    header("Location: driverLocation.php");
} elseif(isset($user) && $password == $enteredPwd && $usertype == 'owner'){
    $_SESSION['restaurant_id'] = $data['restaurant_id'];
    $_SESSION['admin'] = 0;
    $_SESSION['user'] = $user;
    $_SESSION['gender'] = $gender;
    $token = generate_token($username);
    $_SESSION['token'] = $token;
    header("Location: owner-view.php");
} else {
    $_SESSION['errors'] = [ 'Username/password is incorrect' ];
    include 'login-view.php';
}
?>