<?php include 'bootstrap.php' ; ?>
<?php
$user = $_SESSION['user'];
$gender = $_SESSION['gender']; 
if (strtolower($gender) == 'male'){
$prefix = 'Mr';
}elseif (strtolower($gender) == 'female'){
$prefix = 'Ms';
}
$name = $prefix.". ".$user;
echo "
    <nav class='navbar navbar-default'>
      <div class='container-fluid'>
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class='navbar-header'>
          <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1' aria-expanded='false'>
            <span class='sr-only'>Toggle navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
          <a class='navbar-brand' href='owner-view.php'>Home</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
          <ul class='nav navbar-nav'>
            <li class='active'><a href='restaurant-view-owner.php'>View Restaurants<span class='sr-only'>(current)</span></a></li>
          </ul>
          <ul class='nav navbar-nav'>
            <li class='active'><a href='order-summary.php'>View Order Summary<span class='sr-only'>(current)</span></a></li>
          </ul>
          <ul class='nav navbar-nav navbar-right'>
            <li class='navbar-text'>Signed in as {$name}</a></li>
            <li><a href='logout.php'>Logout</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
";
?>

