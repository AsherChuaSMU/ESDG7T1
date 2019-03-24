<?php

//require_once 'include/session.php';
require_once 'include/common.php';

$username = '';
if (isset($_POST['username'])) {
    $username = $_POST['username'];
}


?>
<?php include 'include/bootstrap.php' ; ?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="include/css/signin.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
  <div class="container">
    <form class="form-signin" id='login-form' method="post" action="login.php">
    <h2 class="form-signin-heading">Please sign in</h2>
    <?php printErrors(); ?>
        <input name="username" type="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
  </div>
</body>
</html>
