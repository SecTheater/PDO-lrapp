<?php
require_once '../inc/navbar.php';

  if(!isset($_SESSION['loggedin'])){
  	header('refresh:0;url=login.php');
  }
  if(isset($_SESSION['post']) && count($_SESSION['post']) > 0){
  
  ?>

<form class="form-horizontal" action="../control/edit.php" method="POST">

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="title">Title</label>  
  <div class="col-md-5">
  <input name="title" placeholder="Edit Title" class="form-control input-md" required="" type="text" value="<?= $_SESSION['post']['title'];?>">
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="title">Title</label>  
  <div class="col-md-5">
  <textarea name="body" placeholder="Edit Body" class="form-control input-lg" required=""><?= $_SESSION['post']['title'];?></textarea> 
    
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
  <div class="col-md-12">
  		<input type="hidden" name="id" value="<?= $_SESSION['post']['id'] ?>">
    <button id="submit" name="submit" class="btn btn-default center-block">Edit Post</button><br />
   
  </div>
</div>


</form>
  <?php
  	unset($_SESSION['post']);
  }else{
  	$_SESSION['error'] = 'You are not authorized to view this page through url';
	header('refresh:0;url=../views/index.php');
  }



require_once '../inc/scripts.php';
