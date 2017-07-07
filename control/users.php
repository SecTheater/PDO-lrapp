<?php 

session_start();
require_once '../inc/connection.php';

$stmt = $pdo->prepare('SELECT * FROM users WHERE activated = :activated');
$stmt->execute([
	':activated' => 1
]);
if($stmt->rowCount()){
	$_SESSION['users'] = $stmt->fetchAll();

}
header('refresh:0;url=../views/users.php');
