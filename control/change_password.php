<?php
// current password , username, email 
// sELECT usernmae , password = current_password 
// update new password
session_start();
require_once '../inc/connection.php';
// email , password , session
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
  if(isset($_POST['current_password'],$_POST['new_password'],$_POST['password_confirm']) && !empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['password_confirm'])){
    // one upper case , one lower case , one special character , 8 minimum , 32 maximum , numeric , reptitive characters 
    if(strlen($_POST['current_password']) >= 8 && strlen($_POST['current_password']) <= 32){
      if(strlen($_POST['new_password']) >= 8 && strlen($_POST['new_password']) <= 32){
        if($_POST['new_password'] === $_POST['password_confirm']){
          $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username OR email = :email');
          $stmt->execute([
            ':username' => $_SESSION['username'],
            ':email' => $_SESSION['email']
          ]);
          if($stmt->rowCount()){
            foreach ($stmt->fetchAll() as  $value) {
              if(password_verify($_POST['current_password'], $value['password'])){
                $stmt = $pdo->prepare('UPDATE users SET password = :password WHERE username = :username');
                $stmt->execute([
                  ':password' => password_hash($_POST['new_password'],PASSWORD_DEFAULT), 
                  ':username' => $_SESSION['username']
                ]);
                if($stmt->rowCount()){
                   echo 'password has been changed';
                }else{
                  echo 'an error has occured';
                }
              }else{
                echo 'incorrect password';
              }
            }
          }
        }else{
          echo 'passwords don\'t match ';
        }
      }

      
    }else{
      echo 'password is weak';
    }

  }else{
    echo 'please fill up your form';
  }
}else{
  die('you have to login');
} 