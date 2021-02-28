<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

?>
 

<!DOCTYPE html>
<html>
<head>
	<title>Pending Orders</title>
	<?php	include 'includes/links.inc.php';	?>
	<link rel="stylesheet" href="css/pending.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<!-- Navigation bar -->
	<?php	include 'includes/navbars.inc.php';	?>

	<!-- Content -->
  	<h2>Pending Orders</h2>
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
			<th>APPROVE</th>
			<th>REJECT</th>
			</tr>
		</thead>
		<tbody>
	  	<?php

			include "includes/autoloader.inc.php";
			$orderingObj = new OrderingContr();

			$stat = 1;
			$pedingList = $orderingObj->viewOrders($stat);
			if ($pedingList->num_rows > 0){			
				$data = array();
				$total = 0;
				foreach($pedingList as $row)
				{
					$data[] = $row['o_id'];
					$mdate = date_create($row['o_dateMade']);
					$made = date_format($mdate,'F j, Y h:i a');
					$pdate = date_create($row['o_datePick']);
					$pick = date_format($pdate,'F j, Y h:i a');
					
					echo "<tr><td>".$row['o_id']."</td><td>".$row['c_first']." ".$row['c_last']."</td><td>".$made."</td><td>"
						.$pick."</td><td>".$row['o_total']."</td><td>".$row['o_balance']
						."</td><td>"
						."<a style='color:#a5682a;font-size:17px;' href='details.php?id=".$row['o_id']."'><i class='fas fa-clipboard-list'></i></a>"."</td><td>"
						."<a style='color:#008900;font-size:17px;' href='#'><i class='fas fa-thumbs-up'></i></a>"."</td><td>"
						."<a style='color:#9d0000;font-size:17px;' href='includes/del_order.inc.php?id=".$row['o_id']."'><i class='fas fa-thumbs-down'></i></a>"."</td></tr>";
				}
			} else 
				echo "0 results";
		?>
		</tbody>
	</table>

	<!-- MODAL SECTION -->
	<div class="bg-modal">
		<div class="modal-content">
			<h2><i class="fas fa-file-invoice"></i>&nbsp&nbsp Amount Payment</h2>
			<div class="close">+</div>
			
			<form action="includes/pending_sql.inc.php" method="POST">
				<label class="label" id="lblOrd">Order ID:</label>
				<label class="label" id="lblId">2</label>
				<label class="label" id="lblPay">Payment:</label>
				<input type="number" name="pay" id="txtpay" class="text" step="any" placeholder="amount" min='1' required></input>
				<input type="hidden" name="hid" id='hid'></input>
				<input type="submit" name="sub" value="Approve" class="sub"></input>
	
				<script>
					var data = <?php echo json_encode($data); ?>;
					
					var table = document.getElementById("table"), rIndex ,cIndex;
					
					// table rows
					for(var i = 1; i < table.rows.length; i++)
					{
						table.rows[i].cells[7].onclick = function()
						{
							rIndex = this.parentElement.rowIndex;
							cIndex = this.cellIndex;
							console.log("Row : "+rIndex+" , Cell : "+cIndex);
							
							var index = rIndex-1;
							document.querySelector('.bg-modal').style.display="flex";
							document.querySelector('.close').addEventListener('click',
								function(){
									document.querySelector('.bg-modal').style.display="none";
									document.getElementById('txtpay').value='';
								}
							);
							document.getElementById('hid').value=data[index];
							document.getElementById('lblId').innerHTML=document.getElementById('hid').value;
						};
					}
				</script>
			</form>
			
		</div>
	</div>
  </body>
</html>
<?php 
}else{
     header("Location: admin_login.php");
     exit();
}