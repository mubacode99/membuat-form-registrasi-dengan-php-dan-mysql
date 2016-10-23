<?php
include 'config.php'; 

if(isset($_SESSION['username'])== 0) { /* Halaman ini tidak dapat diakses jika belum ada yang login */
	header('Location: index.php'); 
}

?>

<h1><p>Selamat Datang <?php echo $_SESSION['username']; ?></p></h1>

<br><a href="logout.php">Logout</a>