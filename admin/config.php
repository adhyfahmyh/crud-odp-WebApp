<?php
    include '../db.php';

    $acc_name 	= $_POST['acc_name'];
    $username 	= $_POST['acc_username'];
	$acc_pass	= $_POST['acc_pass'];
	$acc_email	= $_POST['acc_email'];
	$acc_phone 	= $_POST['acc_phone'];
	$acc_address = $_POST['acc_address'];
	$status 	= $_POST['status'];
	if ($_POST['submit']) {
		$query 		= mysqli_query($conn,"INSERT INTO account VALUES ('$acc_name','$username','$acc_pass','$acc_email','$acc_phone','$acc_address','$status')");
		header('test.php');	
	}
?>