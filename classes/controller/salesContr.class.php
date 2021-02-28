<?php

class SalesContr extends Sales{
    private $id;
    private $quantity;
    private $sold;
    private $origPrice;
    private $sellingPrice;
    private $total;
    private $date;
    private $profit;

    function __construct($id=null, $quantity=null, $sold=null, $origPrice=null, $sellingPrice=null, $profit=null, $total=null, $date=null) {
        $this->id = $id;
        $this->quantity = $quantity;
        $this->sold = $sold;
        $this->origPrice = $origPrice;
        $this->sellingPrice = $sellingPrice;
        $this->total = $total;
        $this->date = $date;
        $this->profit = $profit;
    }

    #Getters
    public function checkDuplicate()
    {
        $data = $this->getDuplicate($this->id, $this->date);
        return $data;
    }
    
    #setters
    public function createSales()
    {
        $data = $this->setNewSales($this->id,$this->quantity,$this->sold,$this->origPrice,$this->sellingPrice,$this->profit,$this->total,$this->date);
        return $data;
    }

    public function setID($id){
        $this->id = $id;
    }
    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }
    public function setSold($sold){
        $this->sold = $sold;
    }
    public function setOrigPrice($origPrice){
        $this->origPrice = $origPrice;
    }
    public function setSellingPrice($sellingPrice){
        $this->sellingPrice = $sellingPrice;
    }
    public function setTotal($total){
        $this->total = $total;
    }
    public function setDate($date){
        $this->date = $date;
    }
}