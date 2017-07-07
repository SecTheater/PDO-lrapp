<?php
require_once '../inc/navbar.php';
 ?>
<form class="form-horizontal" action="../control/change_email.php" method="POST">

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">email</label>  
  <div class="col-md-5">
  <input id="email" name="email" placeholder="Enter your New  email" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password">Password</label>
  <div class="col-md-5">
    <input id="password" name="password" placeholder="Enter your Password" class="form-control input-md" required="" type="password">
    
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