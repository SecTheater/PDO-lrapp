<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Navbar search add on BS 3 - Bootsnipp.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>

   <ul class="nav navbar-nav navbar-left">
     
      <li  class="navbar-brand"><a href="../views/index.php">
    <img src="../inc/logo.jpg" width="30" height="30"  class="img-circle" alt="" style="position:relative;top:-20px;float:left;left:-5px;max-height: 30px;max-width: 30px">
    
  </a></li>
   </ul>
        

    <ul class="nav navbar-nav navbar-right">
     
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php
            session_start();
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
              if(isset($_SESSION['nickname']) && !empty($_SESSION['nickname'])){
                
                ?>

            <img src="<?= ($_SESSION['imagePath'] ?? '../images/picture.png'); ?>" style="position:relative;top:2px;float:left;left:-5px;max-height: 20px;max-width: 20px" class="img-circle">

                <?php

                 echo'<b>' .$_SESSION['nickname']. '</b>';
                }
              }else{
                  echo 'Hello Guest';
              }
                
            ?>
        <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <?php 
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
                switch ($_SESSION['privil']) {
                case ($_SESSION['privil'] === 1):
                  ?>
                  <li><a href="create.php">Create A Post</a></li>
                  <li><a href="../control/index.php">List Newest Posts</a></li>
                  <?php
                  break;
                
                case ($_SESSION['privil'] === 2):
                  ?>
                  <li><a href="create.php">Create A Post</a></li>
                  <li><a href="../control/index.php">List Newest Posts</a></li>
                  <li><a href="../control/users.php">List Users</a></li>

                
                  <?php
                  break;
              }
              ?>
               <li class="divider"></li>
                <li><a href="change_password.php">Change Your Password</a></li>
                <li><a href="change_email.php">Change Your Email</a></li>
                <li><a href="nickname.php">Update your nickname</a></li>
                <li><a href="logout.php">Logout</a></li>
              <?php
            }else{
              ?>
               <li><a href="login.php">login</a></li>
                <li><a href="register.php">Create An Account</a></li>
            <?php
            }
            
          ?>
         
          
         

        </ul>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>
