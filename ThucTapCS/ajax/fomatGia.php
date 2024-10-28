<?php
    //$price = 1000000;
    //echo number_format($price, 0, '', ','); // 1,000,000
    $gia = $_GET['gia'];
    if($gia == ""){
        $gia_fm = "0 VND";   
    }else{
        $gia_fm = number_format($gia, 0, '', ',');
        echo $gia_fm . " VND";
    }
?>