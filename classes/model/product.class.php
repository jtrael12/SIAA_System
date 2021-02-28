<?php

class Product extends Dbc{
	
	#G E T T E R S
	protected function getProducts()
	{
		$sql = "SELECT a.prod_id, a.prod_name, a.prod_quantity, a.prod_originalPrice, a.prod_sellingPrice,
				a.prod_description, a.prod_dateAdded, b.categ_name, c.uom_name 
				FROM product a INNER JOIN category b ON a.prod_category = b.categ_id INNER JOIN uom c 
				ON a.prod_uom = c.uom_id WHERE a.prod_status=1 ORDER BY b.categ_name";
				
		$result = $this->connect()->query($sql);
		return $result;
	}
	protected function getProduct($id)
	{
		$sql = "SELECT a.prod_id, a.prod_name, a.prod_quantity, a.prod_originalPrice, a.prod_sellingPrice,
				a.prod_description, a.prod_dateAdded, b.categ_name, c.uom_name 
				FROM product a INNER JOIN category b ON a.prod_category = b.categ_id INNER JOIN uom c 
				ON a.prod_uom = c.uom_id WHERE a.prod_id=$id";
				
		$result = $this->connect()->query($sql);
		return $result;
		
	}
	protected function getProdPerCateg($category){
		$sql = "SELECT a.prod_name, a.prod_quantity, a.prod_originalPrice, a.prod_sellingPrice,
					a.prod_description, b.categ_name, c.uom_name 
					FROM product a INNER JOIN category b ON a.prod_category = b.categ_id INNER JOIN uom c 
					ON a.prod_uom = c.uom_id WHERE b.categ_name LIKE '$category' AND a.prod_status=1
					ORDER BY a.prod_name";
		$result = $this->connect()->query($sql);
		return $result;
	}
	protected function getProdByName($name){
		$sql = "SELECT * FROM product WHERE prod_name LIKE '$name'";
		$result = $this->connect()->query($sql);
		return $result;
	}
	protected function getCategory()
	{
		$sql = "SELECT categ_name FROM category";
		$result = $this->connect()->query($sql);
		return $result;
	}
	protected function getUOM()
	{
		$sql = "SELECT uom_name FROM uom";
		$result = $this->connect()->query($sql);
		return $result;
	}
	protected function getUOMCategId($uom, $Category)
	{
		$sql = "SELECT uom_id, categ_id FROM UOM, category WHERE uom_name LIKE '$uom' AND categ_name LIKE '$Category'"; 
		$result = $this->connect()->query($sql);
		return $result;
	}
	protected function getDuplicate($title,$categ_id)
	{
		$sql = "SELECT prod_id,prod_name,prod_status FROM product WHERE prod_name LIKE '$title' AND prod_category=$categ_id";
		$result = $this->connect()->query($sql);
		return $result;
	}
	protected function getNewProdID()
	{
		$sql = "SELECT prod_id FROM product ORDER BY prod_id DESC LIMIT 1";
		$result = $this->connect()->query($sql);
		return $result;
	}
	
	
	#S E T T E R S
	protected function setNewProduct($categ_id,$uom_id,$title,$Quantity,$OriginalPrice,$SellingPrice,$Description)
	{
		$sql="Insert into product(prod_category,prod_uom,prod_name,prod_quantity,prod_originalPrice,prod_sellingPrice
			,prod_description,prod_dateAdded,prod_status)VALUES($categ_id,$uom_id,'$title',$Quantity,$OriginalPrice,$SellingPrice,'$Description',NOW(),1)";
		$result = $this->connect()->query($sql);
		return $result;
	}
	protected function setProduct($title, $categ_id, $uom_id, $Quantity, $OriginalPrice,$SellingPrice,$Description,$id)
	{
		$sql = "UPDATE product SET prod_name='$title', prod_category=$categ_id, prod_uom=$uom_id,
			prod_quantity=$Quantity, prod_originalPrice=$OriginalPrice, prod_sellingPrice=$SellingPrice,
			prod_description='$Description',prod_status=1 WHERE prod_id=$id";
			
		$result = $this->connect()->query($sql);
		return $result;
	}
	protected function setStock($new, $p_id)
	{
		$sql = "UPDATE product SET prod_quantity=$new WHERE prod_id=$p_id";
		$result = $this->connect()->query($sql);
		return $result;
	}
	protected function setDeletion($id)
	{
		$sql = "UPDATE product SET prod_status=2 WHERE prod_id=$id";
		$result = $this->connect()->query($sql);
		return $result;
	}
	
}
