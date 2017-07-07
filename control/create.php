<?php 
require_once '../inc/connection.php';
session_start();
if(isset($_POST['submit'],$_POST['body'],$_POST['title']) && !empty($_POST['title']) && !empty($_POST['body']) && !empty($_POST['submit'])){
	if(preg_match('/^[a-z\s]+$/i',$_POST['title'])){
		if(preg_match('/^[a-z0-9-_. ]*$/i',$_POST['body'])){

			$stmt = $pdo->prepare('INSERT INTO posts (`user_id`,`username`,`title`,`body`) VALUES(:user_id,:username,:title,:body)');
			$stmt->execute([
				':user_id' => $_SESSION['id'],
				':username' => $_SESSION['username'],
				':title' => $_POST['title'],
				':body' => $_POST['body']

			]);
			if($stmt->rowCount()){
				$_SESSION['successful'] = 'Post Has been added suessfully';
				header('refresh:.2;url=../views/create.php');
			}
		}else{
			$_SESSION['error'] = 'Body Should only contain of leters, whitespace and - _ . characters';
			header('refresh:.2; url=../views/create.php');
		}
	}else{
		$_SESSION['error'] = ' Title Field Should only contain of letters';
		header('refresh:.2; url=../views/create.php');
	}
}else{
	$_SESSION['error'] = 'Body and Title Field Are Required';
	header('refresh:.2; url=../views/create.php');
}