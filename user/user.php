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
      	<a href="user.php" class="active"><h4><strong>Daftar ODP</strong></h4></a>
        <a href="input.php"><h4><strong>Input ODP</strong></h4></a>
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
		    $query = "SELECT * FROM `dataodp` WHERE CONCAT(`id`, `nik_supplier`, `id_deployer`, `nama_project`,`jumlah_odp`,`status_konstruksi`,`status_golive`) LIKE '%".$valueToSearch."%'";
		    $search_result 	= filterTable($query);
		    $if 		= $valueToSearch;
		    
		}else {
		    $query = "SELECT * FROM dataodp limit $page1,5";
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
						<h2>Tabel Daftar 	<b>ODP</b></h2>
					</div>
					<div class="col-sm-6">
						<form method="post" class="search">
			          		<input type="text" name="valuesearch" placeholder="Search..">
					    	<input type="submit" name="search" value="GO">
			          	</form>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>NIK Supplier</th>
						<th>ID Deployer</th>
						<th>Nama Project</th>
						<th>Jumlah ODP</th>
						<th>Status Konstruksi</th>
						<th>Status GO LIVE</th>
						<th colspan="2">Pilihan</th>
					</tr>
                </thead>
                <tbody>
                	<?php
						while($row = mysqli_fetch_array($search_result)){
							$id 				= $row['id'];
							$nik_supplier		= $row['nik_supplier'];
					    	$id_deployer 		= $row['id_deployer'];
					    	$nama_project		= $row['nama_project'];
					    	$jumlah_odp 		= $row['jumlah_odp'];
					    	$status_konstruksi 	= $row['status_konstruksi'];
					    	$status_golive 		= $row['status_golive'];
				    	echo"<tr>
						<td align='center'>$nik_supplier</td>
						<td align='center'>$id_deployer</td>
						<td align='center'>$nama_project</td>
						<td align='center'>$jumlah_odp</td>
						<td align='center'>$status_konstruksi</td>
						<td align='center'>$status_golive</td>";
						?>
	                    <td style="border-right-style: solid;">
                            <a href="#editEmployeeModal<?php echo $id;?>" data-toggle="modal">Edit</a>
                        </td>
                        <td>
                            <a href="#deleteEmployeeModal<?php echo $id;?>" data-toggle="modal">Hapus</a>
	                   	</td>
	                <div id="editEmployeeModal<?php echo $id;?>" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form method="post" action="config.php">
									<div class="modal-header">						
										<h4 class="modal-title">Edit data ODP</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<input type="hidden" name="idodp" class="form-control" value="<?php echo $id;?>">
									</div>
									<div class="modal-body">	
										<div class="form-group col-sm-6">
											<label>NIK Supplier:</label>
											<input type="text" name="nik_supplier" class="form-control" value="<?php echo $nik_supplier;?>">
										</div>
										<div class="form-group col-sm-6">
											<label>ID Deployer:</label>
											<input type="text" name="id_deployer" class="form-control" value="<?php echo $id_deployer;?>">
										</div>
										<div class="form-group col-sm-6">
											<label>Nama Project</label>
											<input type="text" name="nama_project" class="form-control" value="<?php echo $nama_project;?>">
										</div>
										<div class="form-group col-sm-6">
											<label>Jumlah ODP</label>
											<input type="number" name="jumlah_odp" class="form-control" value="<?php echo $jumlah_odp;?>">
										</div>
										<div class="form-group col-sm-6">
											<label>Status Konstruksi</label><br>
												<input type="radio" name="status_konstruksi" class="" required value="YA" id="status_konstruksi">&nbsp;YA<br>
												<input type="radio" name="status_konstruksi" class="" required value="Tidak" id="status_konstruksi">&nbsp;TIDAK
										</div>
										<div class="form-group col-sm-6">
											<label>Status GO LIVE</label><br>
												<input type="radio" name="status_golive" class="" required value="YA" id="status_konstruksi">&nbsp;YA<br>
												<input type="radio" name="status_golive" class="" required value="Tidak" id="status_konstruksi">&nbsp;TIDAK
										</div>		
									</div>
									<div class="modal-footer">
										<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
										<input type="submit" class="btn btn-info" value="Save" id="save" name="updatedata">
									</div>
								</form>
							</div>
						</div>
					</div>
					<div id="deleteEmployeeModal<?php echo $id;?>" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form method="post" action="config.php">
									<div class="modal-header">						
										<h4 class="modal-title">Delete ODP:</h4>
										<input type="hidden" name="idodp" value="<?php echo $id; ?>">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">					
										<p>NIK Supplier:&nbsp;<?php echo $nik_supplier;?></p>
										<p>ID Deployer:&nbsp;<?php echo $id_deployer;?></p>
									</div>
									<div class="modal-footer">
										<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
										<input type="submit" name="deletedata" class="btn btn-danger" id="del" value="Delete">
									</div>
								</form>
							</div>
						</div>
					</div>
					</tr>
					<?php
					}
						
						?>
                </tbody>
                
            </table>
            <?php
				$query1	= "SELECT * FROM dataodp";
				$result1 = mysqli_query($conn, $query1);
				$count 	= mysqli_num_rows($result1);
				$a 		= $count/5;
				$a 		= ceil($a);
				if (empty($_POST['valuesearch'])) {?>
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