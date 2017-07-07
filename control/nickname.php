<?php 


session_start();
require_once '../inc/connection.php';

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
	
	if(isset($_POST['password'],$_POST['submit']) && !empty($_POST['nickname']) && !empty($_POST['password']) && !empty($_POST['nickname'])){
		if(preg_match('/^[a-z\s]/i',$_POST['nickname'])){
			if(strlen($_POST['password']) >= 8 && strlen($_POST['password']) <= 32){
				$stmt = $pdo->prepare('SELECT * FROM users WHERE email =:email');
				$stmt->execute([
					':email' => $_SESSION['email']
				]);
				
				if($stmt->rowCount()){
					foreach ($stmt->fetchAll() as $value) {
						if(password_verify($_POST['password'],$value['password'])){
							$stmt = $pdo->prepare('UPDATE users SET nickname=:nickname WHERE email =:email');
							$stmt->execute([
								':nickname' => $_POST['nickname'],
								':email' => $_SESSION['email']
							]);
							if($stmt->rowCount()){
								echo 'Hello' . $_POST['nickname'];
							}
						}else{
							echo 'incorrect password';
						}
					}
				}else{
					echo'Invalid email';
				}
			}else{
				echo 'please provide us a valid password';
			}
		}else{
			echo 'Letters and whitespaces are only allowed';
		}

	}
}else{
	die('you have to login');
}
