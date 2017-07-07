<?php
require_once '../inc/navbar.php';
 ?>
<form class="form-horizontal" action="../control/nickname.php" method="POST">

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nicname">Nickname</label>  
  <div class="col-md-5">
  <input  name="nickname" placeholder="Enter your Nickname" class="form-control input-md" required="" type="text">
    
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
    <button id="submit" name="submit" class="btn btn-default">Update Your Name</button><br />
    
  </div>
</div>


</form>
<?php
require_once '../inc/scripts.php';
?>