<?php
session_start();


if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

	if(isset($_GET['result'])){
		$result = $_GET['result'];
		if ($result == 'success') {
		?>
			<script>
				document.querySelector('#success').style.display = "block";
			</script>
		<?php
		}else if ($result == 'error') {
		?>
			<script>
				document.querySelector('#error').style.display = "block";
			</script>
		<?php 
		} 
	}

?>


<!DOCTYPE html>
<html>

<head>
	<title>Add Sales</title>
	<?php include 'includes/links.inc.php';	?>
	<link rel="stylesheet" href='css/add_sale.css'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
	<!-- Navigation Bar -->
	<?php include 'includes/navbars.inc.php';	?>

	<!-- Content -->
	<div class="container">
		<form method=POST action=add_sale.php class="frm">
			<label id="lblCateg">[CATEGORIES]:</label> &nbsp&nbsp
			<input type="radio" name="category" value="Beef">Beef</input>&nbsp&nbsp&nbsp
			<input type="radio" name="category" value="Pork">Pork</input>&nbsp&nbsp&nbsp
			<input type="radio" name="category" value="Chicken">Chicken</input>&nbsp&nbsp&nbsp
			<input type="radio" name="category" value="SeaFood">SeaFood</input>&nbsp&nbsp&nbsp
			<input type="radio" name="category" value="FrozenGood">FrozenGood</input>&nbsp&nbsp&nbsp
			<input type="submit" name="submit" value="S E L E C T" id="submit"></input>
		</form>
		<br><br>

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
					<th>ADD SALES</th>
				</tr>
			</thead>
			<tbody>
			<?php
				include "includes/autoloader.inc.php";

				//PRODUCT OBJECT CREATION
				$prodObj = new ProductContr();


				if (isset($_POST['submit'])) {
					if (isset($_POST['category'])) {
						$category = $_POST['category'];
						$prodObj->setCategory($category);
						$prods = $prodObj->categProducts();
						if ($prods->num_rows > 0) {
							$data = array();
							$data_qty = array();

							foreach ($prods as $row) {
								$data[] = $row['prod_name'];
								$data_qty[] = $row['prod_quantity'];
								echo "<tr>";
								echo "<td>" . $row['prod_name'];
								echo "<td>" . $row['prod_description'];
								echo "<td>" . $row['categ_name'];
								echo "<td>" . $row['uom_name'];
								echo "<td>" . $row['prod_quantity'];
								echo "<td>" . $row['prod_originalPrice'];
								echo "<td>" . $row['prod_sellingPrice'];
								echo "<td style='color:#91602f;font-size:19px;'><i class='fas fa-folder-plus'></i>";
							}
						}
					}else {
						echo "<div id='warning' class='alert alert-warning' alert-dismissible>
						<strong>Missing Data!</strong> Please select a category.
						<button type='button' class='close' data-dismiss='alert'>&times;</button>
						</div>";
					}
				}

			?>
			</tbody>
		</table>
	</div>
	<!-- ALERTS -->
	<div id="success" class="alert alert-success" alert-dismissible>
		<strong>Success!</strong> Product added to sales.
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
	<div id="error" class="alert alert-danger" alert-dismissible>
		<strong>Error!</strong> Product is already added to sales.
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
	<!-- MODAL SECTION -->
	<div class="bg-modal">
		<div class="modal-content">
			<script>
				var data = <?php echo json_encode($data); ?>;
				var data_qty = <?php echo json_encode($data_qty); ?>;
			</script>
			<script src="js/add_sale.js"></script>
			
			<div class="form-cont">
			<h2><i class="fas fa-file-invoice"></i>&nbsp&nbsp ADD NEW SALES</h2>
			<div class="mClose">+</div>
			<form action='includes/add_sale.inc.php' method="POST">
				
					<div class="form-cont1">
						<label class="label" id="lblProd">Product Name:</label>
						<input name="product" id="txtproduct" class="text" readonly></input>
						<label class="label" id="lblSold">Quantity Sold:</label>
						<input id="txsold" type="number" name="sold" step="any" class="text" required></input>
						<label class="label" id="lbldate">Date:</label>
						<input id="date" type="date" name="date" value="<?php echo date('Y-m-d'); ?>"></input>
						<input type="submit" name="sub" value="Add Sales" class="sub"></input>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- end of modal-->

</body>
</html>

<?php
} else {
	header("Location: admin_login.php");
	exit();
}
?>