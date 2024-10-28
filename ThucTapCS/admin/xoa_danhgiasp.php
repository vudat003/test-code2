<?php
    include '../connection/connection.php';
    $id_cmt = $_GET['id_cmt'];
    $idsp = $_GET['idsp'];

    $sql_xoacmt = "DELETE from danhgiasp where id_bl = '$id_cmt'";
    $con->query($sql_xoacmt);


    $tongsosao = 0;
    $tongso_danhgia = 0;
    $sql = "SELECT * from danhgiasp where id_bl = $id_cmt";
    $result = $con->query($sql);
    if($result->num_rows > 0){
        while($result->fetch_assoc()){
            $tongsosao = $tongsosao + $row['sosao'];
            $tongso_danhgia = $tongso_danhgia + 1;
        }
    }


    $sql_update = "UPDATE sanpham set sosao = '".$tongsosao."', danhgia = '".$tongso_danhgia."' where id_sp = '".$idsp."'";
    $con->query($sql_update);

    header("Location: quanlydanhgiasp.php");
?>