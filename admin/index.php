<?php
	session_start();
	include '../db.php';
    if(!isset($_SESSION['username'])){
    	die("<script>alert('Anda belum login!');window.location.href='../logout.php';</script>");
    }

    if($_SESSION['status']!="admin"){
    	die("<script>alert('Anda tidak memiliki hak akses!');window.location.href='../logout.php';</script>");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Page</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-1.11.3.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/homepage.css">
</head>
<body>
	<div class="topnav">
		<a href="index.php"><img src="images/icons/favicon.ico" alt="home" height= "30" style="-webkit-filter: invert(100%);filter: invert(100%);"></a>
      	<a href="index.php"><h4><strong>SELAMAT DATANG, <?php echo $_SESSION['name'];?> </strong></h4></a>
      	<div class="logout">
          	<a href="../logout.php" onclick="return confirm('Apakah anda yakin?')"><h4><strong>Sign Out</strong></h4></a>
          	
      	</div>
    </div>
    <?php
    	include '../db.php';
        $page = isset($_GET['page'])?$_GET['page']:1;
	    if ($page==""||$page=="1") {
	    	$page1=0;
	    }else{
	    	$page1=($page*5)-5;
	    }

		if(isset($_POST['search'])){
		    $valueToSearch = $_POST['valuesearch'];
		    $query = "SELECT * FROM `account` WHERE CONCAT(`id_acc`, `acc_name`, `acc_username`, `acc_pass`,`acc_email`,`acc_phone`,`acc_address`,`status`) LIKE '%".$valueToSearch."%' LIMIT $page1, 5";
		    $search_result 	= filterTable($query);
		    $if 		= $valueToSearch;
		    
		}else {
		    $query = "SELECT * FROM account limit $page1,5";
		    $search_result = filterTable($query);
		    $if 		= $search_result;
		}

		// function to connect and execute the query
		function filterTable($query)
		{
		    include '../db.php';
		    $filter_Result 	= mysqli_query($conn, $query);
		    
		    return $filter_Result;
		}

		?>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Daftar <b>Pengguna</b></h2>
					</div>
					<div class="col-sm-6">
						<form method="post" class="search">
			          		<input type="text" name="valuesearch" placeholder="Search..">
					    	<input type="submit" name="search" value="GO">
			          	</form>
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Tambah</span></a>	
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
						<th>Nama</th>
						<th>Username/NIK</th>
						<th>Password</th>
						<th>Email</th>
						<th>No. Telp</th>
						<th>Alamat</th>
						<th>Status</th>
						<th>Pilihan</th>
					</tr>
                </thead>
                <tbody>
                	<?php
						while($row = mysqli_fetch_array($search_result)){
							$id_acc			= $row['id_acc'];
					    	$acc_name 		= $row['acc_name'];
					    	$acc_username	= $row['acc_username'];
					    	$acc_pass 		= $row['acc_pass'];
					    	$acc_email 		= $row['acc_email'];
					    	$acc_phone 		= $row['acc_phone'];
					    	$acc_address 	= $row['acc_address'];
					    	$status 		= $row['status'];
				    	echo"<tr>
						<td>$id_acc</td>
						<td>$acc_name</td>
						<td>$acc_username</td>
						<td>$acc_pass</td>
						<td>$acc_email</td>
						<td>$acc_phone</td>
						<td>$acc_address</td>
						<td>$status</td>";
						?>
	                    <td>
                            <a href="#editEmployeeModal<?php echo $id_acc;?>"  class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">border_color</i></a>
                            <a href="#deleteEmployeeModal<?php echo $id_acc;?>" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
	                   	</td>
	                <div id="editEmployeeModal<?php echo $id_acc;?>" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form method="post">
									<div class="modal-header">						
										<h4 class="modal-title">Edit Employee</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<p><strong>Account ID:</strong></p>
											<input style="text-align: center; border: none;" name="id_acc" readonly value="<?php echo $id_acc?>" class="form-control">
										</div>					
										<div class="form-group">
											<label>Name:</label>
											<input name="acc_name" type="text" class="form-control" value="<?php echo $acc_name;?>">
										</div>
										<div class="form-group">
											<label>Username:</label>
											<input name="acc_username" type="text" class="form-control" value="<?php echo $acc_username;?>">
										</div>
										<div class="form-group">
											<label>Password:</label>
											<input name="acc_pass" type="password" class="form-control" value="<?php echo $acc_pass;?>">
										</div>
										<div class="form-group">
											<label>Email:</label>
											<input name="acc_email" type="email" class="form-control" value="<?php echo $acc_email;?>">
										</div>
										<div class="form-group">
											<label>No. Telp:</label>
											<input name="acc_phone" type="text" class="form-control" value="<?php echo $acc_phone;?>">
										</div>
										<div class="form-group">
											<label>Alamat</label>
											<textarea name="acc_address" type="text" class="form-control" value="<?php echo $acc_address;?>"><?php echo $acc_address;?></textarea>
										</div>
										<div class="form-group">
											<label>Status:</label>
											<select class="form-control" name="status">
												<option selected hidden value="<?php echo $status;?>"><?php echo $status;?></option>
												<option value="admin">Admin</option>
												<option value="user">User</option>
											</select>
										</div>					
									</div>
									<div class="modal-footer">
										<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
										<input type="submit" class="btn btn-info" value="Save" name="updatedata">
									</div>
								</form>
							</div>
						</div>
					</div>
					<div id="deleteEmployeeModal<?php echo $id_acc;?>" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form method="post">
									<div class="modal-header">						
										<h4 class="modal-title">Delete Employee: <?php echo $acc_name;?></h4>
										<input type="hidden" name="id_acc" value="<?php echo $id_acc; ?>">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">					
										<p>Are you sure you want to delete these Records?</p>
										<p class="text-warning"><small>This action cannot be undone.</small></p>
									</div>
									<div class="modal-footer">
										<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
										<input type="submit" name="deletedata" class="btn btn-danger" value="Delete">
									</div>
								</form>
							</div>
						</div>
					</div>
					</tr>
				<div id="addEmployeeModal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<form action="" method="post">
								<div class="modal-header">						
									<h4 class="modal-title">Add Employee</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">					
									<div class="form-group">
										<label>Nama</label>
										
										<input type="text" name="acc_name" class="form-control" required>
										
									</div>
									<div class="form-group">
										<label>Username/NIK</label>
										<input type="text" name="acc_username" class="form-control" required>
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type="password" name="acc_pass" class="form-control" required>
									</div>
									<div class="form-group">
										<label>Email</label>
										<input type="email" name="acc_email" class="form-control" required>
									</div>
									<div class="form-group">
										<label>No.Telp</label>
										<input type="text" name="acc_phone" class="form-control" required>
									</div>
									<div class="form-group">
										<label>Alamat</label>
										<textarea class="form-control" name="acc_address" required></textarea>
									</div>
									<div class="form-group">
										<label>Status</label>
										<select class="form-control" name="status" required>
											<option selected hidden value="">Hak Akses</option>
											<option value="admin">Admin</option>
											<option value="user">User</option>
										</select>
									</div>					
								</div>
								<div class="modal-footer">
									<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
									<input type="submit" class="btn btn-success" value="Add" name="add">
								</div>
								
							</form>
						</div>
					</div>
				</div>
					<?php
					}
						if (isset($_POST['updatedata'])) {
							$id_acc			= $_POST['id_acc'];
							$acc_name 		= $_POST['acc_name'];
							$acc_username	= $_POST['acc_username'];
							$acc_pass		= $_POST['acc_pass'];
							$acc_email 		= $_POST['acc_email'];
							$acc_phone 		= $_POST['acc_phone'];
							$acc_address	= $_POST['acc_address'];
							$status 		= $_POST['status'];
							$sql 			= "UPDATE account SET
												acc_name 		= '$acc_name',
												acc_username	= '$acc_username',
												acc_pass 		= '$acc_pass', 
												acc_email 		= '$acc_email',
												acc_phone		= '$acc_phone',
												acc_address 	= '$acc_address',
												status 			= '$status'
												WHERE id_acc='$id_acc' ";
							if ($conn->query($sql) ===TRUE) {
								echo'<script>alert("Update Berhasil!");window.location.href="index.php";</script>';
							}else{
								echo "Error: " . $sql . "<br>" . $conn->error;
							}
						}							
							if (isset($_POST['add'])) {
								$acc_name 	= $_POST['acc_name'];
							    $username 	= $_POST['acc_username'];
								$acc_pass	= $_POST['acc_pass'];
								$acc_email	= $_POST['acc_email'];
								$acc_phone 	= $_POST['acc_phone'];
								$acc_address = $_POST['acc_address'];
								$status 	= $_POST['status'];
								$sql_u 		= "SELECT * FROM account WHERE acc_username='$username'";
								$sql_e 		= "SELECT * FROM account WHERE acc_email='$acc_email'";
								$res_u 		= mysqli_query($conn, $sql_u);
								$res_e 		= mysqli_query($conn, $sql_e);
								if (mysqli_num_rows($res_u) > 0) {
							  		echo'<script>alert("Username sudah ada!");window.location.href="index.php";</script>'; 	
							  	}elseif (mysqli_num_rows($res_e) > 0) {
							  		echo'<script>alert("Email sudah ada!");window.location.href="index.php";</script>'; 	
							  	}else{

								$query 		= "INSERT INTO account(`id_acc`, `acc_name`, `acc_username`, `acc_pass`, `acc_email`, `acc_phone`, `acc_address`, `status`) VALUES ('','$acc_name','$username','$acc_pass','$acc_email','$acc_phone','$acc_address','$status')";
									if($conn->query($query) ===TRUE){
										echo'<script>alert("Berhasil menambahkan data!");window.location.href="index.php";</script>';
										
									}else{
										echo "Error: " . $query . "<br>" . $conn->error;
									}
								}
							}
							if (isset($_POST['deletedata'])) {
								$delete_id = $_POST['id_acc'];
	                            $sql = "DELETE FROM account WHERE id_acc='$delete_id' ";
	                            if ($conn->query($sql) === TRUE) {
	                            	echo'<script>window.location.href="index.php";</script>';
	                            } else {
	                                echo "Error deleting record: " . $conn->error;
	                            }
	                        }
						?>
                </tbody>
                
            </table>
            <?php
				$query1	= "SELECT * FROM account";
				$result1 = mysqli_query($conn, $query1);
				$count 	= mysqli_num_rows($result1);
				$a 		= $count/5;
				$a 		= ceil($a);
				if ($if=$search_result || !$_POST('valueToSearch')) {?>
					<div class="clearfix">
			            <div class="hint-text">Menampilkan <b><?php echo $page;?></b>, dari <b><?php echo $a;?></b> halaman</div>
			            <ul class="pagination">
			        <?php 
			        for ($b=1; $b <=$a ; $b++){ ?>
					        <li class="page-item"><a href="index.php?page=<?php echo $b;?>"
					        <?php 
							    if ($page == $b) {
							        echo 'class="active"';
							    }?>
					        	><strong><?php echo $b."";?></strong></a></li>
							<?php
					}
				}
				?>
				</ul>
			</div>	
        </div>
    </div>
</body>

</html>                                		                            