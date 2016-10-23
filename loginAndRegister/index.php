<?php 
//error_reporting(0);
include 'config.php';

if(!isset($_SESSION['username'] )== 0) {
	header('Location: home.php');
}

if(isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']."ALS52KAO09");

	try {
		$sql = "SELECT * FROM users WHERE username = :username AND password = :password";
		$stmt = $connect->prepare($sql);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->execute();

		$count = $stmt->rowCount();
		if($count == 1) {
			$_SESSION['username'] = $username;
			header("Location: home.php");
			return;
		}else{
			echo "Anda tidak dapat login";
		}
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}

?>

<!-- FORM LOGIN -->

<form action="" method="post">
	<table>
		<tr>
			<td>Username</td>
			<td><input type="text" name="username"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="login" value="Login">
				<input type="reset" name="reset" value="Reset">
			</td>
		</tr>
	</table>
</form>

<br><a href="register.php">Register</a>