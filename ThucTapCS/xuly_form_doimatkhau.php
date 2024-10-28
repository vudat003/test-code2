<?php
    session_start();
    $ten = $_POST['tentaikhoan'];
    $temp = $_POST['matkhau'];
    $temp1 = $_POST['nhaplai_matkhau'];
    $matkhau = md5($temp);
    $nhaplai_matkhau = md5($temp1);
    include './connection.php';
    $sql = "SELECT * FROM thanhvien WHERE tentaikhoan='".$ten."'AND matkhau='".$matkhau."'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    if($result->num_rows > 0){
        $sql_setpass = "UPDATE thanhvien set matkhau = '".$nhaplai_matkhau."'";
        $result1 = $con->query($sql_setpass);
        header("Location: f_doimatkhau.php");
    }else{
        header("Location: f_doimatkhau.php");
    }
?>