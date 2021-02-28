<?php

class Ordering extends Dbc
{
    #SETTERS
    protected function setOrderStatus($stat,$id){
        $sql = "UPDATE orders SET o_status=$stat WHERE o_id=$id";
        $result = $this->connect()->query($sql);
        return $result;
    }
    protected function setApprove($id,$pay){
        $sql = "UPDATE orders SET o_balance=(o_balance-$pay),o_status=2 WHERE o_id=$id";
        $result = $this->connect()->query($sql);
        return $result;
    }

    #GETTERS
    protected function getOrders($stat)
    {
        $sql = "SELECT a.o_id,a.o_customer,a.o_dateMade,a.o_datePick,a.o_total,a.o_balance,b.c_first,b.c_last
        FROM orders a INNER JOIN customer b ON a.o_customer=b.c_id WHERE a.o_status=$stat ORDER BY a.o_datePick";
        $result = $this->connect()->query($sql);
        return $result;
    }
    protected function getDetails($id)
    {
        $sql = "SELECT a.det_order,a.det_product,a.det_quantity,a.det_total,b.prod_name,b.prod_sellingPrice 
				FROM order_details a INNER JOIN product b ON a.det_product=b.prod_id WHERE det_order=$id";
        $result = $this->connect()->query($sql);
        return $result;
    }
}