<?php 
session_start();


if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
 

<!DOCTYPE html>
<html>
<head>
	<title>Manage Product</title>
	<?php include 'includes/links.inc.php'; ?>
	<link rel="stylesheet" href="css/manage_product.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body onload="change('table')">
	<!-- Navigation Bar -->
	<?php include 'includes/navbars.inc.php'; ?>

	<!-- Content -->
	<h2>Manage Product</h2>
   
  	<table id="table">
	<thead>
		<tr>
		<th>NAME</th>
		<th>DESCRIPTION</th>			
		<th>CATEGORY</th>		
		<th>MEASUREMENT</th>
		<th>QUANTITY</th>
		<th>ORIGINAL PRICE</th>
		<th>SELLING PRICE</th>
		<th>RESTOCK</th>
		<th>EDIT</th>
		<th>DELETE</th>
		</tr>
	</thead>
	<tbody>
	  <?php

		include "includes/autoloader.inc.php";
		$prodObj = new ProductContr();
		$products = $prodObj->viewProducts();
		
		$data = array();$data2 = array();$dataID = array();			
		foreach($products as $product) {
			$data[] = $product['prod_name'];
			$data2[] = $product['prod_quantity'];
			$dataID[] = $product['prod_id'];
			echo "<tr><td><span></span>".$product['prod_name']."</td><td>"
			.$product['prod_description']."</td><td>"
			.$product['categ_name']."</td><td>"
			.$product['uom_name']."</td><td>"
			.$product['prod_quantity']."</td><td>"
			.$product['prod_originalPrice']."</td><td>"
			.$product['prod_sellingPrice']."</td><td>"
			."<a style='color:#005000;font-size:17px;' href='#'><i class='fas fa-cart-plus'></i></a>"."</td><td>"
			."<a style='color:#eaa932;font-size:17px;' href='edit_product.php?id=".$product['prod_id']."'><i class='far fa-edit'></i></a>"."</td><td>"
			."<a style='color:gray;font-size:17px;' href='includes/del_inventory.inc.php?id=".$product['prod_id']."'><i class='fas fa-trash-alt'></i></a>"."</td></tr>";
		}
		
		?>
	</tbody>
	</table>
  <!-- MODAL SECTION -->
	<div class="bg-modal">
		<div class="modal-content">
			<h2><i class="fas fa-file-invoice"></i>&nbsp&nbsp RESTOCK A PRODUCT</h2>
			<div class="close">+</div>
			
			<form action="includes/restock.inc.php" method="POST">
				<label class="label" id="lblProd">Product Name:</label>
				<input name="product" id="txtproduct" class="text" readonly></input>
				<br>
				<label class="label" id="lblQty">Current Quantity:</label>
				<label class="label" id="lblCurrent">A</label>
				<label id="lblrestock">Add Quantity:</label>
				<input type="number" name="restock" id="txtrestock" class="text" step="any" placeholder="enter quantity" min='1' required></input>
				<input type="submit" name="sub" value="Restock" class="sub"></input>
				<input type="hidden" name="hidID" id="hidID">
				<input type="hidden" name="hidQty" id="hidQty">
				<script>
					var data = <?php echo json_encode($data); ?>;
					var data2 = <?php echo json_encode($data2); ?>;
					var dataID = <?php echo json_encode($dataID); ?>;
				</script>
				<script src='js/restock.js'></script>
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