<?php
    include './connection/connection.php';
    session_start();
    $maloai = $_POST['ma_loai'];
    $tenloai = $_POST['ten_loai'];
    if($maloai == "" || $tenloai == ""){
        header("Location: sua_loaisp.php?id=".$_SESSION['id_lsp']."");
    }else{
        $sql = "UPDATE loaisp set ma_loaisp = '".$maloai."', ten_loaisp = '".$tenloai."'
        Where ma_loaisp = '".$_SESSION['id_lsp']."'";
        $result = $con->query($sql);
        header("Location: sua_loaisp.php?id=".$_SESSION['id_lsp']."");
        $con->close();
    }
?>