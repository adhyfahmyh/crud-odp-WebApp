<!DOCTYPE html>
<html>
<head>
	<title>paging</title>
</head>
<body>
	<table border="1">
		<thead>
            <tr>
                <th>ID</th>
				<th>Nama</th>
				<th>Username</th>
				<th>Password</th>
				<th>Email</th>
				<th>No. Telp</th>
				<th>Alamat</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
        </thead>
<?php
		$page = isset($_GET['page'])?$_GET['page']:1;
	    if ($page==""||$page=="1") {
	    	$page1=0;
	    }else{
	    	$page1=($page*5)-5;
	    }
	    include 'db.php';
	    $query = "SELECT * FROM account ORDER BY id_acc limit $page1,5";
	    $result = mysqli_query($conn, $query);
	    while($data = mysqli_fetch_assoc($result)){
    	$id_acc			= $data['id_acc'];
    	$acc_name 		= $data['acc_name'];
    	$acc_username	= $data['acc_username'];
    	$acc_pass 		= $data['acc_pass'];
    	$acc_email 		= $data['acc_email'];
    	$acc_phone 		= $data['acc_phone'];
    	$acc_address 	= $data['acc_address'];
    	$status 		= $data['status'];
    	echo"<tr>";
		echo"<td>$id_acc</td>";
		echo"<td>$acc_name</td>";
		echo"<td>$acc_username</td>";
		echo"<td>$acc_pass</td>";
		echo"<td>$acc_email</td>";
		echo"<td>$acc_phone</td>";
		echo"<td>$acc_address</td>";
		echo"<td>$status</td>";
		echo"</tr>";
		}
	    
	    
	    $query1	= "SELECT * FROM account";
		$result1 = mysqli_query($conn, $query1);
		$count 	= mysqli_num_rows($result1);
		$a 		= $count/5;
		$a 		= ceil($a);
		for ($b=1; $b <=$a ; $b++){ 
			?><a href="coba.php?page=<?php echo $b;?>"><?php echo $b."";?></a><?php
		}
?>
	</table>
</body>
</html>

