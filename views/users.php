<?php
require_once '../inc/navbar.php';
if(!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin']) ){
	header('refresh:.5; url=login.php');
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
if(count($_SESSION['users']) > 0){
	?>
	<form action="../control/user_ban.php" method="POST">
	<div class="form-group">
		<label for="ban_duration">Ban Duration In Hours</label>
		<select name="ban_duration" class="form-control">
			<?php 
				for ($i = 1; $i <= 8 ; $i++) {
					?>
					<option value="<?= $i; ?>"> <?= $i; ?> </option>
					<?php
				}
			?>	
			
		</select>
	</div>
		
	<table class="table">
		<tr>
			<th>ID</th>
			<th>Username</th>
			<th>Nickname</th>
			<th>Joined At</th>
			<th>last Login Date</th>
			<th>Status User</th>
			<th>Duration</th>
			
		</tr>
	<?php
	foreach ($_SESSION['users'] as  $value) {
		
		?>
			<tr>
				<td><?= $value['id'] ?></td>
				<td><?= $value['username']?></td>
				<td><?= $value['nickname']?></td>
				<td><?= $value['created_at']?></td>
				<td><?= $value['last_login']?></td>
				<td>
					<?php 
						if($value['active'] === 1){
							?>
							<input type="hidden" name="id" value="<?= $value['id']?>">
							<input type="submit" name="ban" class="btn btn-danger" value="Ban User">
							<?php
						}elseif($value['active'] === 0){
							?>
								<input type="hidden" name="id" value="<?= $value['id']?>">
							<input type="submit" name="ban" class="btn btn-success" value="Un-Ban User">
							<?php
						}
					?>
				</td>
				<td><?= ($value['ban_duration'] === NULL) ? '' : $value['ban_duration'];?></td>
				
			</tr>
		<?php
	}
	?>

		</form>
	</table>
	<?php
}else{
	echo 'no Users To view';
}


?>
		</div>
	</div>

<?php
require_once '../inc/scripts.php';
?>