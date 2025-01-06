<?php 
session_start();
define("APPURL","http://localhost/forum/");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome To Forum</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo APPURL; ?>css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo APPURL; ?>css/custom.css" rel="stylesheet">
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">Forum</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="<?php echo APPURL?>">Home</a></li>
              <?php if(isset($_SESSION['username'])) { ?>
              <li><a href="<?php echo APPURL?>topics/create.php">Create Topic</a></li>
              <li class="dropdown">
                  <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <?php echo $_SESSION['email']; ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo APPURL; ?>users/profile.php?name=<?php echo $_SESSION['username']; ?>">Public Profile</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="<?php echo APPURL; ?>users/editUser.php?id=<?php echo $_SESSION['user_id']; ?>">Edit Profile</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="<?php echo APPURL?>authentication/logout.php">Log out</a></li>
                </ul>
                <?php }
                else{ ?>
                  <li><a href="<?php echo APPURL?>authentication/register.php">Register</a></li>
                  <li><a href="<?php echo APPURL?>authentication/login.php">Login</a></li>
                <?php
                } ?>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>