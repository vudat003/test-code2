<?php
    include "./connection/connection.php";
    // lấy dữ từ người dùng nhập
    session_start();
    $sosao = $_POST['star'];
    $noidungcmt = $_POST['noidungcmt'];
    $path_anhcmt = './img_cmt/' . $_FILES['anh_cmt']['name'];
    if($path_anhcmt != './img_cmt/'){
        move_uploaded_file($_FILES['anh_cmt']['tmp_name'],  "./img/".$path_anhcmt);
    }else{
        $path_anhcmt = "";
    }
    $hoten_cmt = $_POST['hoten_danhgia'];
    $sdt_cmt = $_POST['sodienthoai_danhgia'];
    $email_cmt = $_POST['email_danhgia'];
    $ngaydanhgia = date('Y-m-d') ." ". date('h:i:s');
    // echo $ngaydanhgia;
    $sql_danhgiasp = "INSERT into danhgiasp value(null, ". $_SESSION['idsp'].", '".$hoten_cmt."', '".$sdt_cmt."',
                     '".$email_cmt."', '".$path_anhcmt."', '".$sosao."', '".$noidungcmt."', '".$ngaydanhgia."')";
    // echo $sql_danhgiasp;
    $con->query($sql_danhgiasp);
    $con->close();
    header('Location: chitietsanpham.php?idsp='.$_SESSION['idsp']);
?>