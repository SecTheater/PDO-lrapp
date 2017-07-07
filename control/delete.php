<?php 
session_start();
require_once '../inc/connection.php';
if(isset($_POST['id'],$_POST['delete']) && !empty($_POST['id']) && !empty($_POST['delete'])){
	if(preg_match('/^[0-9]*$/',$_POST['id'])){
		$stmt = $pdo->prepare('SELECT * FROM posts WHERE id =:id');
		$stmt->execute([
			':id' => $_POST['id']
		]);
		if($stmt->rowCount()){
			foreach($stmt->fetchAll() as $value){
				if($value['user_id'] === $_SESSION['id'] || $_SESSION['privil'] === 2){
					$stmt = $pdo->prepare('DELETE FROM posts WHERE id=:id');
					$stmt->execute([
						':id' => $_POST['id']
					]);
					if($stmt->rowCount()){
						$_SESSION['successful'] = 'Post Has been Deleted Successfully';
						header('refresh:0;url=index.php');
					}
				}else{
					$_SESSION['error'] = 'You Are not Authorized To Delete This Post';
					header('refresh:0;url=../views/index.php');
				}
			}
		}else{
			$_SESSION['error'] = 'Post Does not Exist';
			header('refresh:0;url=../views/index.php');
		}
	}
}