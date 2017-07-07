<?php
require_once '../inc/navbar.php';
 
  
  
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    header('refresh:.5; url= ../inc/navbar.php');

  }

?>
<div class="container">
  <div class="row">

<?php 
  if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
    ?>
    <div class="alert alert-danger">
      <center><?= $_SESSION['error'];?></center>
    </div>
    <?php
    unset($_SESSION['error']);
  }elseif(isset($_SESSION['successful']) && !empty($_SESSION['successful'])){
    ?>
    <div class="alert alert-success">
      <center><?= $_SESSION['successful'];?></center>
    </div>
    <?php
    unset($_SESSION['successful']);
  }
  ?>
  <form class="form-horizontal" action="../control/login.php" method="POST">

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="username">Username</label>  
  <div class="col-md-5">
  <input id="username" name="username" placeholder="Enter your Username" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password">Password</label>
  <div class="col-md-5">
    <input id="password" name="password" placeholder="Enter your Password" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-default">Login</button><br />
    <small><a href="password_reset.php">Forget Password?</a></small>
  </div>
</div>


</form>    
  </div>
</div>

<?php
require_once '../inc/scripts.php';
?>