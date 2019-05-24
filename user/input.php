<?php
	session_start();
	include '../db.php';
    if(!isset($_SESSION['username'])){
    	die("<script>alert('Anda belum login!');window.location.href='../logout.php';</script>");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>User Page</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-1.11.3.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/homepage2.css">
</head>
<body>
	<div class="topnav">
		<a href="user.php"><img src="images/icons/favicon.ico" alt="home" height= "39" style="-webkit-filter: invert(100%);filter: invert(100%);"></a>
      	<a href="user.php"><h4><strong>Daftar ODP</strong></h4></a>
        <a href="input.php" class="active"><h4><strong>Input ODP</strong></h4></a>
      	<div class="logout">
          	<a href="../logout.php" onclick="return confirm('Apakah anda yakin?')"><h4><strong>Sign Out</strong></h4></a>
      	</div>
    </div>
    <div class="container">
    	<div class="">
    		<div class="modal-dialog">
				<div class="modal-content" id="input">
					<form action="config.php" method="post">
						<div class="modal-header">						
							<h3 class="modal-title" style="text-align: center;"><strong>Input ODP</strong></h3>
						</div>
						<div class="modal-body" id="body">					
							<div class="form-group col-sm-6">
								<label>NIK Supplier:</label>
								<input type="number" name="nik_supplier" class="form-control" required>
							</div>
							<div class="form-group col-sm-6">
								<label>ID Deployer:</label>
								<input type="text" name="id_deployer" class="form-control" required>
							</div>
							<div class="form-group col-sm-6">
								<label>Nama Project:</label>
								<input type="text" name="nama_project" class="form-control" required>
							</div>
							<div class="form-group col-sm-6">
								<label>Jumlah ODP:</label>
								<input type="number" name="jumlah_odp" class="form-control" required>
							</div>
							<div class="form-group col-sm-6">
								<label>Status Konstruksi:</label><br>
									<input type="radio" name="status_konstruksi" class="" required value="YA" id="status_konstruksi">&nbsp;YA<br>
									<input type="radio" name="status_konstruksi" class="" required value="Tidak" id="status_konstruksi">&nbsp;TIDAK
							</div>
							<div class="form-group col-sm-6">
								<label>Status GO LIVE:</label><br>
									<input type="radio" name="status_golive" class="" required value="YA" >&nbsp;YA<br>
									<input type="radio" name="status_golive" class="" required value="Tidak" >&nbsp;TIDAK
							</div>		
						</div>
						<div class="modal-footer" id="footer">
							<input type="button" class="btn btn-default" onclick="location.href='user.php';" value="Cancel" name="cancel">
							<input type="submit" class="btn btn-success" value="Input" name="add">
						</div>
						
					</form>
				</div>
			</div>
    	</div>
    </div>
</body>

</html>                                		                            