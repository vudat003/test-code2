<?php
    include '../connection/connection.php';
    $id = $_GET['id'];
    $sql = "DELETE FROM thuonghieu where ma_loaisp = '".$id."'";
    $con->query($sql);
    $sql1 = "DELETE FROM loaisp where ma_loaisp = '".$id."'";
    $con->query($sql1);
    $con->close();
    header("Location: danhsach_loaisp.php");
?>