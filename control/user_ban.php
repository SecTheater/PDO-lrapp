<?php
session_start();

require_once '../inc/connection.php';

if(isset($_POST['id'],$_POST['ban']) && !empty($_POST['id']) && !empty($_POST['ban'])){
	switch ($_POST['ban']) {
		case ($_POST['ban'] === 'Ban User' && isset($_POST['ban_duration']) && !empty($_POST['ban_duration'])):
			$stmt = $pdo->prepare('SELECT * FROM users WHERE id=:id');
			$stmt->execute([
				':id' => $_POST['id']
			]);
			if($stmt->rowCount()){
				$date = new DateTime(strtotime(time()));
				$date->modify('+' . $_POST['ban_duration'] . 'Hours');

				$stmt = $pdo->prepare('UPDATE users SET active =:active,ban_duration =:ban_duration,ban_time=:ban_time WHERE id =:id');
				$stmt->execute([
					':active' => 0,
					':ban_duration' => $_POST['ban_duration'] . ' Hours',
					':ban_time'  => $date->format('Y-m-d H:i:s'),
					':id' => $_POST['id']
				]);
				if($stmt->rowCount()){
					$_SESSION['successful'] = 'User Has been Banned Successfully For '. $_POST['ban_duration']. ' Hours';
					header('refresh:0;url=users.php');
				}
			}
			break;
		
		case($_POST['ban'] === 'Un-Ban User'):
			$stmt = $pdo->prepare('SELECT * FROM users WHERE id=:id');
			$stmt->execute([
				':id' => $_POST['id']
			]);
			if($stmt->rowCount()){
				

				$stmt = $pdo->prepare('UPDATE users SET active =:active,ban_duration =:ban_duration,ban_time=:ban_time WHERE id =:id');
				$stmt->execute([
					':active' => 1,
					':ban_duration' => NULL,
					':ban_time'  => NULL,
					':id' => $_POST['id']
				]);
				if($stmt->rowCount()){
					$_SESSION['successful'] = 'User Has been Un-Banned Successfully';
					header('refresh:0;url=users.php');
				}
			}
			break;
	}
}