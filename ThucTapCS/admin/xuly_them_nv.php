<?php
    $hoten = $_POST['ten_nv'];
    $tentaikhoan = $_POST['ten_tk_nv'];
    $matkhau = $_POST['matkhau_nv'];
    $sodienthoai = $_POST['sodienthoai'];
    $path_anh = './img_nv/'.$_FILES['img_nv']['name'];
    move_uploaded_file($_FILES['img_nv']['tmp_name'], "../img/".$path_anh);
    if($hoten == "" || $tentaikhoan == "" || $matkhau == "" || $sodienthoai == ""){
        header("Location: them_nv.php");
    }else{
        include '../connection/connection.php';
        $sql = "INSERT into nhanvien (ten_nv, tentaikhoan_nv, matkhau_nv, sdt_nv, img_nv) 
        value ('".$hoten."', '".$tentaikhoan."', '".$matkhau."','".$sodienthoai."', '".$path_anh."')";
        $result = $con->query($sql);
        header("Location: them_nv.php");
        $con->close();
    }
?>