<?php 

session_start();
require_once '../inc/connection.php';

if(count($_GET) > 0){
		
	if(isset($_GET['id']) && !empty($_GET['id'])){
		if(preg_match('/^[0-9]*$/',$_GET['id'])){
				$stmt = $pdo->prepare('SELECT * FROM posts WHERE id=:id');
				$stmt->execute([
					':id' => $_GET['id']
				]);
				
				if($stmt->rowCount()){
					foreach ($stmt->fetchAll() as $value) {
					
						if($_SESSION['id'] === $value['user_id'] || $_SESSION['privil'] === 2){
							$_SESSION['post'] = $value;
							header('refresh:0;url=../views/edit.php');
						}else{
							$_SESSION['error'] = 'You are not authorized to edit this post';
							header('refresh:0;url=../views/index.php');
						}

					}
				
				}
		}else{
			$_SESSION['error'] = 'Post ID Should only contain of numbers';
			header('refresh:0;url=../views/index.php');
		}

	}else{
		$_SESSION['error'] = 'Post ID Can not be empty';
		header('refresh:0;url=../views/index.php');
	}	
}elseif(count($_POST) > 0){
	$stmt = $pdo->prepare('SELECT * FROM users WHERE username=:username ');
	$stmt->execute([
		':username' =>  $_SESSION['username'],

	]);
	if($stmt->rowCount()){
		foreach ($stmt->fetchAll() as  $value) {
			if(password_verify($_POST['password'],$value['password'])){
				try {
					$pdo->beginTransaction();
					$stmt = $pdo->prepare('SELECT * FROM posts WHERE id=:id');
					$stmt->execute([
						':id' => $_POST['id']
					]);
					if($stmt->rowCount()){
						$stmt = $pdo->prepare('UPDATE posts SET user_id =:user_id, username=:username,title=:title,updated_at=:updated_at,body=:body WHERE id=:id');
						$stmt->execute([
							':user_id' => $_SESSION['id'],
							':username' => $_SESSION['username'],
							':title' => $_POST['title'],
							':updated_at' => date('Y-m-d H:i'),
							':body' => $_POST['body'],
							':id' => $_POST['id']
						]);
						if($stmt->rowCount()){
							$_SESSION['successful'] = 'Post Has been updated Successfully';
							header('refresh:0;url=../control/index.php');
						}
					}
					$pdo->commit();
				} catch (PDOException $e) {
					$pdo->rollBack();
					$_SESSION['error'] = 'Post Title Already Exists';
					header('refresh:0;url=../views/index.php');

				}
			}else{
				$_SESSION['error'] = 'password is incorrect';
				header('refresh:0;url=../views/index.php');
			}
		}
	}
	
	
}
