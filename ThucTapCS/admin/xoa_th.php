<?php
    include '../connection/connection.php';
    $id = $_GET['id'];
    $sql = "DELETE from thuonghieu where id_th = '".$id."'";
    $con->query($sql);
    header("Location: danhsach_th.php");
?>