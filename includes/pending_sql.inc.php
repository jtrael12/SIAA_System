<?php
	session_start();
	if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
		include "autoloader.inc.php";
		$orderObj = new OrderingContr();
		$tranObj = new TransactionContr();

		if(isset($_POST['sub'])){
			$pay = $_POST['pay'];
			$id = $_POST['hid'];
			$approve = $orderObj->approveOrder($id,$pay);
			if ($approve===true) {
				#record to transaction. Transaction type for Approving order = 6
				$tran_type = 6;
				$approve_tran = $tranObj->orderTransaction($id,$type);
				header("Location: ../pending.php");
				
			}
		}
	}else{
		header("Location: admin_login.php");
		exit();
	}
?>