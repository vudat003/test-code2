<?php
    session_start();
    include '../connection/connection.php';
    $id_sp = $_GET['id'];
    $sql_delete_tskt = "DELETE from thongsokithuat where id_sp = '".$id_sp."'";
    $sql = "DELETE FROM sanpham where id_sp = '".$id_sp."'";
    $con->query($sql_delete_tskt);
    $result = $con->query($sql);
    header("Location: danhsach_sp.php");
    $con->close();
?>