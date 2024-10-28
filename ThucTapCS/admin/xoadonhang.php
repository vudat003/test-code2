<?php
    include '../connection/connection.php';
    $id_donhang = $_GET['id'];
    $sql = "DELETE from chitiethoadon where id_hd = '".$id_donhang."'";
    $con->query($sql);
    $sql = "DELETE from hoadon where id_hd = '".$id_donhang."'";
    $con->query($sql);
    header('Location: donhang_chuaduyet.php');
?>