<?php 

require_once '../inc/navbar.php';
 
if(!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin']) ){
	header('refresh:.5; url=login.php');
}

?>
<div class="conatiner">
	<div class="row">
		
	<?php 
		if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
			?>
			<div class="alert alert-danger">
				<center><?= $_SESSION['error'] ?></center> 
			</div>
			<?php
			unset($_SESSION['error']);
		}elseif(isset($_SESSION['successful']) && !empty($_SESSION['successful'])){
			?>
			<div class="alert alert-success">
				<center><?= $_SESSION['successful']; ?></center>
			</div>
			<?php
			unset($_SESSION['successful']);
		}
	 ?>
	<form class="form-horizontal" action="../control/create.php" method="POST" autocomplete="off">
		<div class="form-group">
		 	<div class="col-md-4 col-md-offset-5">
 				<label for="title">Post Title : </label>
  				<input name="title" placeholder="Enter Post Title" class="form-control input-md" type="text">
  			</div>
    
  		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-5">
  				<label for="Body">Post Body</label>
  
    			<textarea name="body" placeholder="Enter Post Body" class="form-control"></textarea>
    		</div>
  		</div>
		<div class="form-group">
  			<div class="col-md-4 col-md-offset-5">
    			<input type="submit" value="Create A Post" class="form-control" name="submit">
  				
  			</div>
		</div>

	</form>
	</div>	
</div>
<?php
require_once '../inc/scripts.php';
?>