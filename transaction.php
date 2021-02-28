<?php 
session_start();


if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
 

<!DOCTYPE html>
<html>
<head>
    
	<title>Transaction</title>
	<?php	include 'includes/links.inc.php';	?>
	<link rel="stylesheet" href="css/transaction.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	 
	<h2>Transactions History</h2>

	<!-- Navigation Bar -->
	<?php	include 'includes/navbars.inc.php';	?>

	<!-- Content -->
	<form action="transaction.php" method=POST class="date">
		<label>Pick a date:</label>
		<input type="date" name="date" required></input>
		<input type="submit" name=submit value="View" style="width:70px;color:white;background-color:#063146;" required></input>
	</form>

	<div class="headDate">
		<label id="lbDate" style="color:white;">Date</label>
	</div>
	
	<table class="table">
		<thead>
			<tr>
			<th>TRANSACTION TYPE</th>
			<th>TIME</th>
			</tr>
		</thead>
	<tbody>
	<?php

		include "includes/autoloader.inc.php";
		$tranObj = new TransactionContr();
		
		if(isset($_POST['submit'])){
			$date = $_POST['date'];
			$dateHead = date_create($date);
			$fdate = date_format($dateHead,'F j, Y');
			$tranObj->setDate($date);

			$transaction = $tranObj->viewTransactions();
			$tran_types = array(6,7,9,10);
			if ($transaction->num_rows > 0) 
			{
				foreach($transaction as $trans) 
				{
					$t = date_create($trans['tran_dateAdded']);
					$time = date_format($t,'h:i a');
					
					if(in_array($trans['tran_type'],$tran_types)){
						echo "<tr>";
						echo "<td>".$trans['type_name']." : #".$trans["tran_order"];
						echo "<td>".$time;
					}
					else{
						echo "<tr>";
						echo "<td>".$trans['type_name']." : ".$trans["prod_name"];
						echo "<td>".$time;
					}
				}
			 
			?>
				<script>
					var date = <?php echo json_encode($fdate); ?>;
					document.getElementById('lbDate').innerHTML=date;
					
				</script>
			<?php
			}else {
				echo '<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Oops!</strong> No results, choose a valid date.
				</div>';
			}
		}
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