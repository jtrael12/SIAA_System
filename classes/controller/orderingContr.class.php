<?php

class OrderingContr extends Ordering
{
    #SELECT
    public function viewOrders($stat)
    {
        $result = $this->getOrders($stat);
        return $result;
    }
    public function orderDetails($id)
    {
        $result = $this->getDetails($id);
        return $result;
    }


    #UPDATE
    public function changeOrderStatus($stat,$id)
    {
        $result = $this->setOrderStatus($stat,$id);
        return $result;
    }
    public function approveOrder($id,$pay)
    {
        $result = $this->setApprove($id,$pay);
        return $result;
    }
    
}