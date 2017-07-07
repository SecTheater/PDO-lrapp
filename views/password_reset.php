<?php
require_once '../inc/navbar.php';
  
  
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    header('refresh:.5; url= navbar.php');
  }
?>
<form class="form-horizontal" action="../control/password_reset.php" method="POST">

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email</label>  
  <div class="col-md-5">
  <input id="Email" name="email" placeholder="Enter your Email" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Password input-->


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-default">Generate Password</button><br />
 
  </div>
</div>


</form>
<?php
require_once '../inc/scripts.php';
?>