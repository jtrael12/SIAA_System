<?php 
	session_start();
	if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

		include "autoloader.inc.php";

		if(isset($_POST['sub'])){
			$id = $_POST['hidID'];
			$p_qty = $_POST['hidQty'];
			$restock_1 = $_POST['restock'];
			$prod = $_POST['product'];

			$quan = floatval($p_qty);
			$restock = floatval($restock_1);
			$tranType = 8;

			$new_quan = $quan + $restock;

			//Object Creation
			//$id, $name, $category, $uom, $categ_id, $uom_id, $quantity, $originalPrice, $sellingPrice, $description
			$prodObj = new ProductContr($id);
			$prodObj->setQuantity($new_quan);

			$restock = $prodObj->newProdQuantity();
			if ($restock==true) 
			{
				#record to transaction. Transaction type for restocking 8
				$tranObj = new TransactionContr($id, $tranType);
				$trans = $tranObj->productTransaction();
				if($trans==true){
					header("Location: ../manage_product.php");
				}
				else
					echo $trans->error;
			}
		}
		
	}else{
		header("Location: admin_login.php");
		exit();
	}

?>