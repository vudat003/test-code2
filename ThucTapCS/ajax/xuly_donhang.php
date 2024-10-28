<?php
    session_start();
    include('../connection/connection.php');
    $id_hd = $_GET['id_hd'];
    if(isset($_SESSION['admin'])){
        $sql = "UPDATE hoadon set trangthai = '1' where id_hd ='".$id_hd."'";
    }else{
        $sql = "UPDATE hoadon set id_nv = '".$_SESSION['id_nv']."', trangthai = '1' where id_hd ='".$id_hd."'";
    }
    echo "Đã duyệt";
    $con->query($sql);
?>      