<?php

require_once 'include/common.php';
require_once 'include/token.php';

// isMissingOrEmpty(...) is in common.php
$errors = [ isMissingOrEmpty ('username'), isMissingOrEmpty ('password') ];
$errors = array_filter($errors);


if (!isEmpty($errors)) {
    $_SESSION['errors'] = $errors;
    include "login2.php";
    exit();
}

$username = $_POST['username'];
$enteredPwd = $_POST['password'];


// Replace this serviceURL to yours
$serviceURL = "http://SMUImage:8080/users/".$username;


// Service invocation via GET
$json = file_get_contents($serviceURL);

// parsing the String in JSON format to objects so we can manipulate it by
// looping etc
$data = json_decode($json, TRUE);

// as the data is wrapped in an array with 1 element Book, we have to extract
// the Book, in order to get the list of Books
$password = $data['password'];
$user = $data['username'];



if ($username == "admin" && $enteredPwd == "admin"){
	$_SESSION['admin'] = 1;
	$user->name = "Admin";
	$user->gender = "male";
	$user->username="admin";
	$_SESSION['user'] = $user;
	$token = generate_token($username);
    $_SESSION['token'] = $token;
	header("Location: list-view-restaurant.php");
}    
elseif (isset($user) && $password == $enteredPwd) {
	$_SESSION['admin'] = 0;
    $_SESSION['user'] = $user;
    $token = generate_token($username);
    $_SESSION['token'] = $token;
    header("Location: list-view-restaurant.php");
} else {
    $_SESSION['errors'] = [ 'Username/password is incorrect' ];
    include 'login2.php';
}
?>