<?php

class Transaction extends Dbc
{
	#SETTERS
	protected function setProdTransaction($id, $type){
		$sql = "INSERT INTO transaction (tran_product, tran_type, tran_dateAdded)
				VALUES ($id, $type, now())";
		$result = $this->connect()->query($sql);
		return $result;
	}
	protected function setOrdTransaction($id, $type){
		$sql = "INSERT INTO transaction (tran_order, tran_type, tran_dateAdded)
				VALUES ($id, $type, now())";
		$result = $this->connect()->query($sql);
		return $result;
	}

	#GETTERS
	protected function getTransaction($date)
	{
		$sql = "SELECT a.tran_dateAdded,a.tran_type,a.tran_order, b.prod_name, c.type_name
				FROM transaction a LEFT JOIN product b ON a.tran_product = b.prod_id 
				INNER JOIN transaction_type c ON a.tran_type = c.type_id WHERE
				date(tran_dateAdded)='$date' ORDER BY a.tran_dateAdded";
		$result = $this->connect()->query($sql);
		return $result;
	}
}