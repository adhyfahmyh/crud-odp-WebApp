<?php
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db='p_001';
	$conn=mysqli_connect($host,$user,$pass,$db);
	if (!$conn) {
		echo "Terjadi kesalahan dalam koneksi database";
	}
?>