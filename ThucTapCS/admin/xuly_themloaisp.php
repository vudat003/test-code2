<?php
    $maloai = $_POST['ma_loai'];
    $tenloai = $_POST['ten_loai'];
    include '../connection/connection.php';
    $sql = "INSERT into loaisp (ma_loaisp, ten_loaisp) 
    value ('".$maloai."', '".$tenloai."')";
    $result = $con->query($sql);
    header("Location: them_loaisp.php");
    $con->close();
?>