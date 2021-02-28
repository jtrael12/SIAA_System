<?php 
session_start();


if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
	

 ?>
 

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
	<?php include 'includes/links.inc.php'; ?>
	<link rel="stylesheet" href="css/home.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<!-- Navigation Bar -->
	<?php include 'includes/navbars.inc.php'; ?>

	<!-- Content -->
	<div class="cont-pass">
		<form method=POST action="change_pass.php">
			<label>Change Password</label>
			<input type="password" name="old" placeholder="Old Password"></input>
			<input type="password" name="new" placeholder="New Password"></input>
			<input type="submit" name="sub"></input>
		</form>
	</div>
	<div class="cont">
		<div class="items" id="item-critical">
			<label>Products needs to be restock:  
			<?php
				include "db_conn.php";
				
				if(isset($_GET['error']))
					echo "<script>alert('Wrong old password.')</script>";
				else if(isset($_GET['error']))
					echo "<script>alert('Password changed.')</script>";
				
				$sql = "SELECT COUNT(prod_id) AS ctr FROM product WHERE prod_status=1 AND prod_quantity<=5";
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				echo $row['ctr'];
			?>
			</label>
		</div>
		<div class="items" id="item-pending">
			<label>Pending Orders: 
			<?php
				$sql = "SELECT COUNT(o_id) AS ctr FROM orders WHERE o_status=1";
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				echo $row['ctr'];
			?>
			</label>
		</div>
		<div class="items" id="item-pick">
			<label>Tomorrow's Orders To-PickUp: 
			<?php
				$now = date("Y-m-d");
				$current=date_create($now);
				$add = date_add($current,date_interval_create_from_date_string("1 day"));
				$min = date_format($add,"Y-m-d");
				$sql = "SELECT COUNT(o_id) AS ctr FROM orders WHERE o_status=2 AND date(o_datePick)='$min'";
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				echo $row['ctr'];
			?>
			</label>
		</div>
	</div>

	
    
  </body>
</html>

<?php 
}else{
     header("Location: admin_login.php");
     exit();
}
 ?>