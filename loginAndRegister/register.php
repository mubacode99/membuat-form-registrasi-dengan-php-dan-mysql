<?php 

error_reporting(0);
include 'config.php';

if(!isset($_SESSION['username'] )== 0) { /* Halaman ini tidak dapat diakses jika belum ada yang login */
	header('Location: home.php'); 
}

$username 		 = $_POST['username'];
$email 			 = $_POST['email'];
$password 		 = md5($_POST['password']."ALS52KAO09");
$confirmPassword = md5($_POST['confirmPassword']."ALS52KAO09");

if(isset($username, $email, $password, $confirmPassword)) { 
	if(strstr($email, "@")) {
		if($password == $confirmPassword) {
			try {
				$sql = "SELECT * FROM users WHERE username = :username OR email = :email";
				$stmt = $connect->prepare($sql);
				$stmt->bindParam(':username', $username);
				$stmt->bindParam(':email', $email);
				$stmt->execute();
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}

			$count = $stmt->rowCount();
			if($count == 0) {
				try {
					$sql = "INSERT INTO users SET username = :username, email = :email, password = :password";
					$stmt = $connect->prepare($sql);
					$stmt->bindParam(':username', $username);
					$stmt->bindParam(':email', $email);
					$stmt->bindParam(':password', $password);
					$stmt->execute();
				}
				catch(PDOException $e) {
					echo $e->getMessage();
				}
				if($stmt) {
					echo "Selamat Anda berhasil Register, anda dapat Login";
				}
			}else{
				echo "Username dan Email sudah pernah digunakan";
			}
		}else{
			echo "Password tidak sama";
		}
	}else{
		echo "Email Tidak Valid";
	}
}

?>

<!-- FORM UNTUK REGISTRASI -->	
<form action="" method="post">
	<table>
		<tr>
			<td>Username</td>
			<td><input type="text" name="username"></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="text" name="email"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr>
			<td>Confirm Password</td>
			<td><input type="password" name="confirmPassword"></td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="register" value="Register">
				<input type="reset" name="reset" value="Reset">
			</td>
		</tr>
	</table>
</form>