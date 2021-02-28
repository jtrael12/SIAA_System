<?php
	session_start();
	if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
		include "autoloader.inc.php";
		$orderingObj = new OrderingContr();
		$tranObj = new TransactionContr();

		$id = $_GET['id'];
		$order_status = 3; //Status = 3 for COMPLETED ORDERS

		$cancel = $orderingObj->changeOrderStatus($order_status, $id);
		if ($cancel===true) {
			#record to transaction. Transaction type for Completed Order = 9
			$tran_type = 9;
			$tran_cancelled = $tranObj->orderTransaction($id, $tran_type);
			header("Location: ../pickup.php");
		}
		
	}else{
		header("Location: admin_login.php");
		exit();
	}
?>