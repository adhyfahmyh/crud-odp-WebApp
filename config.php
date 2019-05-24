<?php
    include 'db.php';
    session_start();

    $username 	= $_POST['username'];
	$psw 		= $_POST['password'];
	$op 		= $_GET['op'];

	$username	= mysqli_escape_string($conn,$username);
	$password 	= mysqli_escape_string($conn,$psw);

	if($op=="in"){
		$cek = mysqli_query($conn,"SELECT * FROM account WHERE acc_username='$username' AND acc_pass='$psw'");
		if(mysqli_num_rows($cek)==1){
			$c = mysqli_fetch_array($cek);
			$_SESSION['username'] 	= $c['acc_username'];
			$_SESSION['status'] 	= $c['status'];
			$_SESSION['name']		= $c['acc_name'];
			if($c['status']=="admin"){
				header("location:admin/index.php");
			}else if($c['status']=="user"){
				header("location:user/user.php");
			}
		}else{
				die("password salah <a href=\"javascript:history.back()\">kembali</a>");
		}
	}else if($op=="out"){
			unset($_SESSION['username']);
			unset($_SESSION['status']);
			header("location:index.php");
	}
?>