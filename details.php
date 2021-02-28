<?php 
session_start();


if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
 

<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
	<?php include 'includes/links.inc.php';	?>
	<link rel="stylesheet" href='css/details.css'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<!-- Navigation Bars -->
	<?php	include 'includes/navbars.inc.php';	?>

	<!-- Content -->
	<div class="container">
		<strong><p>ORDER DETAILS:</p></strong>
		<?php
			include "includes/autoloader.inc.php";
			$orderObj = new OrderingContr();

			
			$id = $_GET['id'];
			$total =0;

			$ordDet = $orderObj->orderDetails($id);
			if ($ordDet->num_rows > 0){	
				echo "<br><Strong>PRICES:</Strong><br>";
				foreach($ordDet as $row) {
					echo $row['prod_name']." - ".$row['prod_sellingPrice']."php<br>";
				}
				echo "<br><Strong>ORDERS:</Strong><br>";
				foreach($ordDet as $row) {
					if($row['det_quantity']>1)
						$pcs = "pieces";
					else
						$pcs = "piece";
					$total += $row['det_total'];
					echo $row['prod_name']." (".$row['det_quantity']." $pcs) = ".$row['det_total']."php<br>";
				}
				echo "<br><br><Strong>TOTAL: </Strong> $total"."php<br>";
				
			}
		?>
	</div>
    
</body>
</html>

<?php 
}else{
     header("Location: admin_login.php");
     exit();
}
 ?>