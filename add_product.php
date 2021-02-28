<?php 
session_start();


if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

?>
 

<!DOCTYPE html>
<html>
<head>
	<title>Add New Product</title>
	<?php include 'includes/links.inc.php'; ?>	
	<link rel="stylesheet" href="css/add_new_product.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

	<!-- Navigation Bar -->
	<?php include 'includes/navbars.inc.php'; ?> 
	
	<!-- Content -->
	<form method=POST action=add_product.php>
		<h2><i class="fas fa-shopping-cart"></i>Add New Product</h2>
		  
		<div class="product_title"><i class="fa fa-list-alt"></i></div>
		<input type="text" name=title placeholder="Product title" class="title" required><br>
		  
		<div class="category"><i class="far fa-caret-square-down"></i></div>
		<select name=CATEGORY class="cat">
		<option value='Pork'> Pork
		<option value='Beef'> Beef
		<option value='SeaFood'>SeaFood
		<option value='FrozenGood'>Frozen Good
		<option value='Chicken'> Chicken
		</select>
					
		<div class="uom_i"><i class="far fa-caret-square-down"></i></div>
		<select name=UOM class="uom">
		<option value="Kilogram"> Kilogram
		<option value="Pack"> Pack
		</select>
					
					
		<div class="quantitylogo"><i class="fas fa-cart-plus"></i></div>
		<input type="number" name=QUANTITY placeholder="Product Quantity" class="Quantity" step="any" required><br>
				  
		<div class="OriginalPricelogo"><i class="fas fa-dollar-sign"></i></div>
		<input type="number" name=ORIGINAL placeholder="Buying price" class="origprice" step="any" required><br>
				  
		<div class="Sellinglogo"><i class="fas fa-dollar-sign"></i></div>
		<input type="number" name=SELLING placeholder="Selling price" class="selling" step="any" required>
				  
				  
		<div class="descriptionlogo"><i class="fas fa-pencil-alt"></i></div>
		<textarea input type="text" name=DESCRIPTION class="description" placeholder="DESCRIPTION" ></textarea>
				  
		<input type="submit" name=sub value="Add Product" class="add">  
	  
	</form> 
	 
</body>
</html>
<?php 

include "includes/autoloader.inc.php";


if(isset($_POST['sub'])){
	$title= ucwords(strtolower($_POST['title']));
	$Category=$_POST['CATEGORY']; 
	$Description=$_POST['DESCRIPTION'];
	$Quantity=$_POST['QUANTITY'];
	$OriginalPrice=$_POST['ORIGINAL'];
	$SellingPrice=$_POST['SELLING'];
	$uom = $_POST['UOM'];


	//OBJECT CLASS CREATION:
	//$id, $name, $category, $uom, $categ_id, $uom_id, $quantity, $originalPrice, $sellingPrice, $description
	$prodObj = new ProductContr(null, $title, $Category, $uom, null, null, $Quantity, $OriginalPrice, $SellingPrice, $Description);
	//Transaction object
	#Transaction type for ADDING PRODUCT = 1
	$tranObj = new TransactionContr(null, 1);


	#Get UOM and Category IDs
	$uomCategId = $prodObj->uomCategId();
	foreach($uomCategId as $IDs){
		$uom_id = $IDs['uom_id'];
		$prodObj->setUomID($uom_id);

		$categ_id = $IDs['categ_id'];
		$prodObj->setCategID($categ_id);
	}

	#duplicate product check
	$check = $prodObj->checkDuplicate();
	if ($check->num_rows > 0){
		foreach($check as $duplicate){
			$stat = $duplicate['prod_status'];
			$p_id = $duplicate['prod_id'];
		}
		
		if($stat == 1){
			echo '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Product is already added.
				  </div>';
		}
		else{
			$reactivate = $prodObj->updateProduct();
			if ($reactivate == TRUE) {
				$tranObj->setID($p_id);
				$tranObj->productTransaction();
				echo '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Success!</strong> Product created.
				  </div>';
			}
		}
	}
	else{
		$newProduct = $prodObj->createProduct();
		if($newProduct==TRUE)
		{
			#get the added product
			$newProdID = $prodObj->newProductID();
			foreach($newProdID as $row){
				$prodID = $row["prod_id"];
			}
			$tranObj->setID($prodID);
			$newTransac = $tranObj->productTransaction();
			if($newTransac==true){
				echo '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Success!</strong> Product created.
				  </div>';
			}
		}
		else
		{
			echo '<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Oops!</strong> Unsuccessful transaction please try again.'
				.'</div>';
		}
	}
}

?>

<?php 
}else{
     header("Location: admin_login.php");
     exit();
}