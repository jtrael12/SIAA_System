<?php 
session_start();


if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit	Product</title>
	<?php include 'includes/links.inc.php'; ?>
	<link rel="stylesheet" href="css/edit_product.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<!-- Navigation Bar -->
	<?php include 'includes/navbars.inc.php'; ?>
	
	<!-- Content -->
	<?php 
		include "includes/autoloader.inc.php";
		$id = $_GET['id'];

		//Object Product for Viewing
		$prodView = new ProductContr($id);		
		$products = $prodView->viewProduct();
		$p_categ = $prodView->allCategory();
		$p_uom = $prodView->allUOM();
		
		foreach($products as $product) {
			$id = $product['prod_id'];
			$title=$product['prod_name'];
			$Category=$product['categ_name']; 
			$uom = $product['uom_name'];
			$Description=$product['prod_description'];
			$Quantity=$product['prod_quantity'];
			$OriginalPrice=$product['prod_originalPrice'];
			$SellingPrice=$product['prod_sellingPrice'];
		}
	?>

	<form method=POST action="edit_product.php?id=<?php echo $id; ?>">
	<h2><i class="fas fa-shopping-cart"></i>Edit Product</h2>
  
	<div class="product_title"><i class="fa fa-list-alt"></i></div>
	<input name=title type="text" class="title" value="<?php echo $title;?>" required><br>
	<div class="category"><i class="far fa-caret-square-down"></i></div>
	<select name=Category class="cat">
	<?php 
		foreach($p_categ as $categ){
			$cat_op = "".$categ['categ_name'];
			if($cat_op == $Category)
				echo "<option value='$cat_op' selected>". $cat_op. "</option>";
			else
				echo "<option value='$cat_op'>". $cat_op. "</option>";
		} 
	?>
	</select>
	<div class="uom_i"><i class="far fa-caret-square-down"></i></div>
		<select name=UOM class="uom">
		<?php 
			foreach($p_uom as $UOMs){
				$uom_op = "".$UOMs['uom_name'];
				if($uom_op == $uom)
					echo "<option value='$uom_op' selected>". $uom_op. "</option>";
				else
					echo "<option value='$uom_op'>". $uom_op. "</option>";
			}
		?>
		</select>
			
		<div class="quantitylogo"><i class="fas fa-cart-plus"></i></div>
		
			<input name=Quantity type="number" class="Quantity" value="<?php echo $Quantity;?>" step="any" required><br>
		  
		<div class="OriginalPricelogo"><i class="fas fa-dollar-sign"></i></div>
		
		  <input name=OriginalPrice type="number" class="origprice" value="<?php echo $OriginalPrice;?>" step="any" required><br>
		  
		<div class="Sellinglogo"><i class="fas fa-dollar-sign"></i></div>
		
		  <input name=SellingPrice type="number" class="selling" value="<?php echo $SellingPrice;?>" step="any" required>
	
		<div class="descriptionlogo"><i class="fas fa-pencil-alt"></i></div>
		
	     <input name=Description input type="textarea" class="description" value="<?php echo $Description;?>">
		  
		<input type="hidden" name=id value="<?php echo $id; ?>">
		<input type="submit" name=sub value="Update Product" class="add">  
	
<?php

if(isset($_POST['sub'])){
	$id = $_POST['id'];
	$title= ucwords(strtolower($_POST['title']));
	$Category=$_POST['Category']; 
	$uom=$_POST['UOM']; 
	$Quantity=$_POST['Quantity'];
	$OriginalPrice=$_POST['OriginalPrice'];
	$SellingPrice=$_POST['SellingPrice'];
	$Description=$_POST['Description'];


	//MAIN OBJECT CLASS CREATION
	//$id, $name, $category, $uom, $categ_id, $uom_id, $quantity, $originalPrice, $sellingPrice, $description
	$prodObj = new ProductContr($id, $title, $Category, $uom, null, null, $Quantity, $OriginalPrice, $SellingPrice, $Description);
	
	#Get UOM and Category IDs
	$uomCategId = $prodObj->uomCategId();
	foreach($uomCategId as $IDs){
		$uom_id = $IDs['uom_id'];
		$prodObj->setUomID($uom_id);

		$categ_id = $IDs['categ_id'];
		$prodObj->setCategID($categ_id);
	}
	
	#update process
	$update = $prodObj->updateProduct();
	if($update==true){
		#transaction process
		$tran_type = 2;
		$tranObj = new TransactionContr($id,$tran_type);
		$newTransac = $tranObj->productTransaction();
		if($newTransac==true){
			echo '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Success!</strong> Product updated.
				  </div>';
			header("refresh:1.5");
			
		}else{
			echo '<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Oops!</strong> Transaction recording error.
				</div>';
		}
	}else{
		echo '<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Oops!</strong> Update unsuccessful please try again.
				</div>';
	}
	
}
?>
		
		
  
	</form> 
  
</body>
</html>
<?php 
}else{
     header("Location: admin_login.php");
     exit();
}

