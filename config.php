<?php 

session_start(); // Digunakan untuk memulai session

$host = "localhost"; // nama host anda
$user = "root"; // username dari host anda
$pass = ""; //password dari host anda
$db   = "formlogin"; // nama database yang anda miliki

try {
	$connect = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo $e->getMessage();
}

?>