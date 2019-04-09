<!DOCTYPE html>
<?php

//require_once 'include/session.php';
require_once 'include/common.php';

$username = '';
if (isset($_POST['username'])) {
    $username = $_POST['username'];
}


?>
<html lang="en">
 
<head>
  <!-- HEAD
  This is where you put your jQuery, Bootstrap JS library imports
-->
<title>Alan Xpress</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

  <style>
    .container{
      background-color: rgb(240, 238, 238);
      margin-top: 50px;
      margin-bottom: 50px;
    }
    
    .panel-heading{
    color: rgb(25, 25, 255);
  }

  
  </style>

</head>

<body style="background-color:#FBEEE6;">
  <!-- BODY
  This is where you put your html presentation code and Bootstrap JS related
  tags, markups, etc
-->

  <div class="container">
    <div class="row header">

      <div class="col-md-12" style="padding-top: 50px" align="center">
      <img src="image/logo.png" alt="Italian Trulli">
      <div class="col-md-12" > 
        <div class="panel-heading" align="center">
          <!-- <h1>Login</h1> -->
          <br>
      </div>
        <div class="login100-form validate-form"  align="center" >
        <div class="col-md-3" > 
        <?php printErrors(); ?>
        </div>
        <form id='login-form' method="post" action="login.php">
            
        	<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter email: ex@abc.xyz" >
						<input class="input100" type="text" name="username" id="inputUsername" placeholder="Username" >
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-20" data-validate = "Please enter password">
						<span class="btn-show-pass">
							<i class="fa fa fa-eye"></i>
						</span>
						<input class="input100" type="password" name="password" placeholder="Password" id="inputPassword">
						<span class="focus-input100"></span>
					</div>


        <div  align="center">
             <div class="col-md-12" style="padding-top: 10px; padding-bottom:20px" align="center">
          <button type="submit" class="btn-login-with bg2 m-b-10" >Login</button>
        </div>

						<!-- <a href="#" class="btn-login-with bg1 m-b-10">
							<i class="fa fa-facebook-official"></i>
							Login with Facebook
						</a> -->

</form>
          <script src='js/facebookscript.js' type='text/javascript'></script>
            <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
            </fb:login-button>
            
            <div id="status">
            </div>
       
        </div>

      </div>
      <!-- end of row for header -->
    </div>
    <!-- end of container -->
  </div>


  <script>
    // <!-- script
    //   Place the script tag at the end of the body tag so the contents are loaded
    //   first before the scripts.
    //   This is where you put all your javascript and/or jQuery scripts for
    //   dynamically changing any html contents.
    // -->
    

  </script>

  <!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
</body>

</html>