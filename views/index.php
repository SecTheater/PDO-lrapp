<?php
require_once '../inc/navbar.php';
if(!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin']) ){
	header('refresh:.5; url=login.php');
}
require_once '../inc/connection.php';
$stmt = $pdo->prepare('SELECT active FROM users WHERE username=:username');
$stmt->execute([
	':username' => $_SESSION['username']
]);
if($stmt->rowCount()){
	foreach ($stmt->fetchAll() as  $value) {
		if($value['active'] === 0 ){
			session_unset();
			session_destroy();
			header('refresh:0;url =login.php');
		}
	}
}
 ?>
	
	<div class="container">
		<div class="row">

			
<?php 
	if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
		?>
		<div class="alert alert-danger">
			<center><?= $_SESSION['error'];?></center>
		</div>
		<?php
		unset($_SESSION['error']);
	}elseif(isset($_SESSION['successful']) && !empty($_SESSION['successful'])){
		?>
		<div class="alert alert-success">
			<center><?= $_SESSION['successful'];?></center>
		</div>
		<?php
		unset($_SESSION['successful']);
	}

if( array_key_exists('posts',$_SESSION)){
	if(count($_SESSION['posts']) > 0 && $_SESSION['posts'] !== false){
		?>
			<table class="table">
		<tr>
			<th>ID</th>
			<th>Title</th>
			<th>Body</th>
			<?php 
				if($_SESSION['privil'] >= 1):
			?>
			<th>status</th>
			<th>Edit Post</th>
			<th>Delete Post</th>
			<?php
		endif;
			?>
			
		</tr>
	<?php
	foreach ($_SESSION['posts'] as  $value) {
		
		?>
			<tr>
				<td><?= $value['id'] ?></td>
				<td><?= $value['title']?></td>
				<td><?= $value['body']?></td>
				<?php 
					if($_SESSION['privil'] >= 1 ):
				?>
				<td>
					<?php 
						if($value['approved'] === 1){
							?>	
							<a href="../control/approval.php?action=unapproved&id=<?=$value['id'];?>" class="btn btn-danger">Approved</a>
							<?php
						}elseif($value['approved'] === 0){
							?>
							<a href="../control/approval.php?action=approved&id=<?=$value['id'];?>" class="btn btn-success">Un-Approved</a>
							<?php
						}
					?>
				</td>
				<td><a href="../control/edit.php?id=<?=$value['id']?>" class="btn btn-primary">Edit Post</a></td>
				<td><form action="../control/delete.php" method="POST">
					<input type="hidden" value="<?= $value['id'];?>" name="id">
					<input type="submit" name="delete" value="Delete Post" class="btn btn-danger">
				</form></td>
				<?php 
			endif;
				?>
			</tr>
		<?php
	}
	?>

	
	</table>
	<?php
	}


}else{
	echo 'no Posts To view';
}


?>
		</div>
	</div>

<?php
require_once '../inc/scripts.php';
?>