<?php

class ProductContr extends Product{
	private $id;
	private $name;
	private $category;
	private $uom;
	private $categ_id;
	private $uom_id; 
	private $quantity;
	private $originalPrice;
	private $sellingPrice;
	private $description;
	function __construct($id=null, $name=null, $category=null, $uom=null, $categ_id=null, $uom_id=null, $quantity=null, $originalPrice=null, $sellingPrice=null, $description=null)
	{
		$this->id = $id;
		$this->name = $name;
		$this->category = $category;
		$this->uom = $uom;
		$this->categ_id = $categ_id;
		$this->uom_id = $uom_id;
		$this->quantity = $quantity;
		$this->originalPrice = $originalPrice;
		$this->sellingPrice = $sellingPrice;
		$this->description = $description;
	}
	#SELECT
	public function viewProducts(){
		$data = $this->getProducts();
		return $data;
	}
	public function viewProduct(){
		$data = $this->getProduct($this->id);
		return $data;
	}
	public function	prodByName()
	{
		$data = $this->getProdByName($this->name);
		return $data;
	}
	public function allCategory(){
		$data = $this->getCategory();
		return $data;
	}
	public function allUOM(){
		$data = $this->getUOM();
		return $data;
	}
	public function uomCategId(){
		$data = $this->getUOMCategId($this->uom, $this->category);
		return $data;
	}
	public function checkDuplicate(){
		$data = $this->getDuplicate($this->name, $this->categ_id);
		return $data;
	}
	public function newProductID(){
		$data = $this->getNewProdID();
		return $data;
	}
	public function categProducts()
	{
		$data = $this->getProdPerCateg($this->category);
		return $data;
	}
	
	#UPDATE
	public function updateProduct(){
		$data = $this->setProduct($this->name, $this->categ_id, $this->uom_id, $this->quantity, $this->originalPrice, $this->sellingPrice, $this->description, $this->id);
		return $data;
	}
	public function newProdQuantity()
	{
		$data = $this->setStock($this->quantity,$this->id);
		return $data;
	}
	public function deleteProduct()
	{
		$data = $this->setDeletion($this->id);
		return $data;
	}
	
	
	#INSERT
	public function createProduct(){
		$data = $this->setNewProduct($this->categ_id,$this->uom_id,$this->name,$this->quantity,$this->originalPrice,$this->sellingPrice,$this->description);
		return $data;
	}




	#SETTERS
	public function setID($id){
		$this->id = $id;
	}
	public function setName($name){
		$this->name = $name;
	}
	public function setCategory($category){
		$this->category = $category;
	}
	public function setUom($uom){
		$this->uom = $uom;
	}
	public function setCategID($categ_id){
		$this->categ_id = $categ_id;
	}
	public function setUomID($uom_id){
		$this->uom_id = $uom_id;
	}
	public function setQuantity($quantity){
		$this->quantity = $quantity;
	}
}