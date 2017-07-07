<?php
session_start();
require_once '../inc/connection.php';

$stmt = $pdo->prepare('SELECT * FROM posts');
$stmt->execute();

$_SESSION['posts'] = $stmt->fetchAll();
header('refresh:0;url=../views/index.php');
