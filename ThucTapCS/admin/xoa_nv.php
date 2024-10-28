<?php
    include '../connection/connection.php';
    $id_nv = $_GET['id'];
    $sql = "DELETE from nhanvien where id_nv = '".$id_nv."'";
    $con->query($sql);
    header("Location: danhsach_nv.php");
?>