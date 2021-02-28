<?php 
session_start();


if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
 

<!DOCTYPE html>
<html>
<head>
	<title>Pending Orders</title>
	<?php	include 'includes/links.inc.php';	?>
	<link rel="stylesheet" href="css/pickup.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body onload="change('table')">
	<!-- Navigation Bars -->
	<?php	include 'includes/navbars.inc.php';	?>

	<!-- Content -->
	<h2>Orders To-Pickup</h2>

  	<table id="table">
	<thead>
		<tr>
		<th>ID</th>
		<th>NAME</th>
		<th>ORDER MADE</th>	
		<th>PICKUP DATE</th>
		<th>TOTAL</th>		
		<th>BALANCE</th>
		<th>DETAILS</th>
		<th>COMPLETE</th>
		<th>CANCEL</th>
		</tr>
	</thead>
	<tbody>
	  <?php

		include "includes/autoloader.inc.php";
		$orderObj = new OrderingContr();

		$stat = 2;
		$orders = $orderObj->viewOrders($stat);
		if ($orders->num_rows > 0){			
			foreach($orders as $row) {
				
				$mdate = date_create($row['o_dateMade']);
				$made = date_format($mdate,'F j, Y h:i a');
				$pdate = date_create($row['o_datePick']);
				$pick = date_format($pdate,'F j, Y h:i a');
				
				echo "<tr><td>".$row['o_id']."</td><td>".$row['c_first']." ".$row['c_last']."</td><td>".$made."</td><td>"
					.$pick."</td><td>".$row['o_total']."</td><td>".$row['o_balance']
					."</td><td>"
					."<a style='color:#a5682a;font-size:17px;' href='details.php?id=".$row['o_id']."'><i class='fas fa-clipboard-list'></i></a>"
					."</td><td>"
					."<a style='color:#24c700;font-size:17px;' href='includes/pickup_complete.inc.php?id=".$row['o_id']."'><i class='fas fa-check-circle'></i></a>"
					."</td><td>"
					."<a style='color:#ba1d0d;font-size:17px;' href='includes/pickup_cancel.inc.php?id=".$row['o_id']."'><i class='fas fa-times-circle'></i></a>";
			}
		} else 
			echo "0 results";
		?>
	</tbody>
	</table>
  </body>
</html>
<?php 
}else{
     header("Location: admin_login.php");
     exit();
}