<?php

class TransactionContr extends Transaction
{
	private $id;
	private $type;
	private $date;

	function __construct($id=null, $type=null, $date=null)
	{
		$this->id = $id;
		$this->type = $type;
		$this->date = $date;
	}

	#INSERT
	public function productTransaction(){
		$result = $this->setProdTransaction($this->id, $this->type);
		return $result;
	}
	public function orderTransaction(){
		$result = $this->setOrdTransaction($this->id, $this->type);
		return $result;
	}


	#SELECT
	public function viewTransactions()
	{
		$result = $this->getTransaction($this->date);
		return $result;
	}


	#SETTERS
	public function setID($id)
	{
		$this->id = $id;
	}
	public function setDate($date){
		$this->date = $date;
	}
}