<?php
    $id = $_GET['id'];
    include '../connection/connection.php';
    $sql = "
            DELETE from hoadon 
            DELETE from thanhvien where id = '".$id."'
            ";
?>