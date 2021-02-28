<?php

include "autoloader.inc.php";
 
$id = $_GET ['id'];
//$id, $name, $category, $uom, $categ_id, $uom_id, $quantity, $originalPrice, $sellingPrice, $description
$prodObj = new ProductContr($id);

$delete = $prodObj->deleteProduct();
if ($delete === TRUE) 
{
	#record to transaction. Transaction type for DELETING PRODUCT = 3
	$tran_type = 3;
	$tranObj = new TransactionContr($id, $tran_type);
	
	$tranDelete = $tranObj->productTransaction();
	if($tranDelete===true)
	{
		header("Location: ../manage_product.php");
	}
	else
		echo $tranDelete->error;
 }