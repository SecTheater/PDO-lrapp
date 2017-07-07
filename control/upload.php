<?php 
session_start();
require_once '../inc/connection.php';
if(isset($_FILES['user_image'])){
	/*
		1- check extension 
		2- size
		3- unique 
	*/
	$file = $_FILES['user_image'];
	$file_name = $file['name'];
	$file_size= $file['size'];
	$file_tmp= $file['tmp_name'];
	$file_error= $file['error'];
	$allowedExts  = ['gif','jpeg','png','jpg'];
	// index.txt.Png
	$extension = explode('.',$file_name);
	$extension = strtolower(end($extension));
	if(in_array($extension,$allowedExts)){
		if($file_error === 0){
			if($file_size <= 2*1024*1024){
				$file_name_new = sha1(uniqid('',true)) . '.' . $extension;
				$file_destination  = "../images/" . $file_name_new;
				if(move_uploaded_file($file_tmp,$file_destination)){
					$stmt = $pdo->prepare('UPDATE users SET imagePath = :imagePath WHERE username=:username');
					$stmt->execute([
						':imagePath' => $file_destination,
						':username' => $_SESSION['username']
					]);
					if($stmt->rowCount()){
						echo 'File Has been uploaded sucessfully';
					}
				}
			}
		}
	}
}