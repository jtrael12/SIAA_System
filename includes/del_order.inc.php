<?php

include 'autoloader.inc.php';
$tranObj = new TransactionContr();
$orderingObj = new OrderingContr();

$id = $_GET ['id'];
$tranType = 7;
//4 for disapproved
$order_status = 4;
$reject = $orderingObj->changeOrderStatus($order_status,$id);
if ($reject === TRUE) 
{
	#record to transaction. Transaction type for Rejecting order = 7
	$tranReject = $tranObj->orderTransaction($id,$tranType);
	header("Location: ../pending.php");
 }