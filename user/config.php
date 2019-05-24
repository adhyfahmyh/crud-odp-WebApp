<?php
	include '../db.php';
	if (isset($_POST['updatedata'])) {
		$id 			= $_POST['idodp'];
		$nik_supplier 	= $_POST['nik_supplier'];
	    $id_deployer 	= $_POST['id_deployer'];
		$nama_project	= $_POST['nama_project'];
		$jumlah_odp		= $_POST['jumlah_odp'];
		$status_konstruksi 	= $_POST['status_konstruksi'];
		$status_golive 	= $_POST['status_golive'];
		$sql 			= "UPDATE dataodp SET
							nik_supplier 		= '$nik_supplier',
							id_deployer			= '$id_deployer',
							nama_project 		= '$nama_project', 
							jumlah_odp 			= '$jumlah_odp',
							status_konstruksi	= '$status_konstruksi',
							status_golive 		= '$status_golive'
							WHERE id ='$id' ";
		if ($conn->query($sql) ===TRUE) {
			echo'<script>alert("Update Berhasil!");window.location.href="user.php";</script>';
		}else{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}							
		if (isset($_POST['add'])) {
			$nik_supplier 	= $_POST['nik_supplier'];
		    $id_deployer 	= $_POST['id_deployer'];
			$nama_project	= $_POST['nama_project'];
			$jumlah_odp		= $_POST['jumlah_odp'];
			$status_konstruksi 	= $_POST['status_konstruksi'];
			$status_golive 	= $_POST['status_golive'];

			$query 		= "INSERT INTO dataodp VALUES ('','$nik_supplier','$id_deployer','$nama_project','$jumlah_odp','$status_konstruksi','$status_golive')";
				if($conn->query($query) ===TRUE){
					echo'<script>alert("Berhasil menambahkan data!");window.location.href="user.php";</script>';
					
				}else{
					echo "Error: " . $query . "<br>" . $conn->error;
				}
		}
		
		if (isset($_POST['deletedata'])) {
			$delete_id = $_POST['idodp'];
            $sql = "DELETE FROM dataodp WHERE id='$delete_id' ";
            if ($conn->query($sql) === TRUE) {
            	echo'<script>window.location.href="user.php";</script>';
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        }
        if (isset($_POST['cancel'])) {
        	# code...
        	header('Location: http://www.google.com/');
        }
	?>