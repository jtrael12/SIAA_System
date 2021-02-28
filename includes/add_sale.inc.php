<?php

include 'autoloader.inc.php';

if (isset($_POST['sub'])) {
    $name = $_POST['product'];
    $sold = $_POST['sold'];
    $date = $_POST['date'];
    $dateTime = $date . " " . date("H:i:s");

    #get prod_id
    $prodObj = new ProductContr(null, $name);
    $product = $prodObj->prodByName();
    foreach ($product as $row) {
        $prod_id = $row['prod_id'];
        $origPrice = $row['prod_originalPrice'];
        $sellingPrice = $row['prod_sellingPrice'];
        $qty = $row['prod_quantity'];
    }

    #computation
    $new_quan = $qty - $sold;
    $profit = $sellingPrice - $origPrice;
    $total = $profit * $sold;

    //Sales Object Creation
    $saleObj = new SalesContr($prod_id, $qty, $sold, $origPrice, $sellingPrice, $profit, $total, $date);
    //DUPLICATION CHECK
    $check = $saleObj->checkDuplicate();
    if ($check->num_rows == 0) {
        #insert to sales
        $saleObj->setDate($dateTime);
        $newSales = $saleObj->createSales();

        if ($newSales === TRUE) {
            if ($date == date('Y-m-d')) {
                $prodObj->setID($prod_id);
                $prodObj->setQuantity($new_quan);
                $update = $prodObj->newProdQuantity();
            }
            #record to transaction. Transaction type for ADDING Sales = 4
            $tran_type = 4;
            $tranObj = new TransactionContr($prod_id, $tran_type);
            $trans = $tranObj->productTransaction();
            if($trans == true)
                header("Location: ../add_sale.php?result='success'");
            else
                header("Location: ../add_sale.php?result='error'");
        }
    }
            
}
