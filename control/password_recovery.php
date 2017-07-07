<?php 

require_once '../inc/connection.php';
if(isset($_GET['email'],$_GET['reset_token']) && !empty($_GET['reset_token']) && !empty($_GET['email'])){
	//check email and token 
	$stmt = $pdo->prepare('SELECT * FROM users WHERE email=:email AND reset_token =:reset_token');
	$stmt->execute([
		':reset_token' => $_GET['reset_token'],
		':email' => $_GET['email']
	]);
	if($stmt->rowCount()){
		?>
		<form class="form-horizontal" action="" method="POST">

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password">New Password</label>
  <div class="col-md-5">
    <input id="password" name="new_password" placeholder="Enter your Password" class="form-control input-md" required="" type="text">
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="username">Repeat Password</label>  
  <div class="col-md-5">
  <input id="username" name="password_confirm" placeholder="Repeat Your Password" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Password input-->

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-default">Reset Passwod</button><br />
    
  </div>
</div>


</form>
		<?php
			if(isset($_POST['new_password'],$_POST['password_confirm']) && !empty($_POST['new_password']) && !empty($_POST['password_confirm'])){
				if($_POST['password_confirm'] === $_POST['new_password']){

					$stmt = $pdo->prepare('UPDATE users SET password=:password WHERE reset_token =:reset_token AND email=:email');
					$stmt->execute([
						':password' => password_hash($_POST['new_password'],PASSWORD_DEFAULT,['cost'=>11]),
						':reset_token' => $_GET['reset_token'],
						':email' => $_GET['email']
					]);
					if($stmt->rowCount()){
						$stmt = $pdo->prepare('UPDATE users SET reset_token =:reset_token WHERE email=:email');
						$stmt->execute([
							':reset_token' => NULL,
							':email' => $_GET['email'] 
						]);
						if($stmt->rowCount()){
							die('Password Has been changed successfully');
						}
					}
					
				}else{
					echo 'passwords dont match';
				}

			}else{
				echo 'please fill up your form';
			}
	}else{
		die('Invalid Token');
	}
}