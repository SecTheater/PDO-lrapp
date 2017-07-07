<?php 

/* 
	1- password_reset.html
		form (action => password_reset.php)
		email_address , submit 
	2- password_reset.php
		check email exists or not ? 
		token , hash . hash 
		link (password_Recovery.php?email,token)
		email ()
	3- password_Recovery.php 
		check email,token 
		email,token select database
		update password , email,token 
		delete token 

*/

require_once '../inc/connection.php';
//check if user is logged in


	if(isset($_POST['email'],$_POST['submit']) && !empty($_POST['email'])){
		if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
			$stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
			$stmt->execute([
				':email'  => $_POST['email']
			]);
			if($stmt->rowCount()){
				// update token , generate link
				$stmt = $pdo->prepare('UPDATE users SET reset_token = :reset_token WHERE email =:email');
				$stmt->execute([
					':email' => $_POST['email'],
					':reset_token' => sha1(uniqid('',true)) . sha1(date('Y-m-d H:i'))
				]);
				if($stmt->rowCount()){
					$stmt = $pdo->prepare('SELECT email,reset_token FROM users WHERE email =:email ');
					$stmt->execute([
						':email' => $_POST['email'],
						
					]);
					if($stmt->rowCount()){
						foreach ($stmt->fetchAll() as  $value) {
							
							?>
							<a href="password_recovery.php?email=<?=$value['email'];?>&reset_token=<?=$value['reset_token'];?>">Click Here To reset your password</a>
							<?php
						}
					}
				}
			}else{
				echo 'email does not exist';
			}
		}else{
			echo 'please provide us a valid email';
		}
	}else{
		echo 'please fill up your form';
	}
