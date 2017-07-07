<?php
require_once '../inc/navbar.php';
 ?>
<form class="form-horizontal" action="../control/change_password.php" method="POST">

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="current-password">Current Password</label>  
  <div class="col-md-5">
  <input  name="current_password" placeholder="current password" class="form-control input-md" required="" type="password">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password">Password</label>
  <div class="col-md-5">
    <input  name="new_password" placeholder="New Password" class="form-control input-md" required="" type="password">
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="password">Password</label>
  <div class="col-md-5">
    <input  name="password_confirm" placeholder="Repeat Password" class="form-control input-md" required="" type="password">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-default">Login</button>
  </div>
</div>


</form>
<?php
require_once '../inc/scripts.php';
?>