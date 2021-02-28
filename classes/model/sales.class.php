<?php

class Sales extends Dbc{
    #Getters
    protected function getDuplicate($prod_id, $date)
    {
        $sql = "SELECT * FROM sales WHERE s_product=$prod_id AND date(s_dateAdded)='$date'";
        $result = $this->connect()->query($sql);
        return $result;
    }
    

    #setters
    protected function setNewSales($prod_id,$qty,$sold,$origPrice,$sellingPrice,$profit,$total,$date)
    {
        $sql = "INSERT INTO sales VALUES(null,$prod_id,$qty,$sold,$origPrice,$sellingPrice,$profit,$total,'$date')";
        $result = $this->connect()->query($sql);
        return $result;
    }
}