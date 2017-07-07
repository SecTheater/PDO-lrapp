<?php
require_once '../inc/navbar.php';
 ?>

 <div class="container">
 	 	<form action="../control/upload.php" method="POST" enctype="multipart/form-data">
 	<div class="form-group">
 	 		<label for="upload">Upload Your Profile Picture</label>
 	 		<input type="file" name="user_image">

 	</div>
 	<div class="form-group">
 		<input type="submit" value="upload" name="submit">
 	</div>
 	 	</form>

 </div>	