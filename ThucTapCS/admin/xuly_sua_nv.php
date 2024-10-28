<?php
    session_start();
    include("../connection/connection.php");
    $id_nv = $_SESSION['id_nhanvien'];
    $hoten = $_POST['ten_nv'];
    $tentaikhoan = $_POST['ten_tk_nv'];
    $matkhau = $_POST['matkhau_nv'];
    $sodienthoai = $_POST['sodienthoai'];
    $path_anh = './img_nv/'.$_FILES['img_nv']['name'];
    move_uploaded_file($_FILES['img_nv']['tmp_name'], "../img/".$path_anh);
    if($path_anh == './img_nv/'){
        $path_anh = $_SESSION['img_nv'];
    }
    $sql = "
        UPDATE `nhanvien` SET `ten_nv` = '".$hoten."',
                            `tentaikhoan_nv` = '".$tentaikhoan."',
                            `matkhau_nv` = '".$matkhau."',
                            `sdt_nv` = '$sodienthoai',
                            `img_nv` = '".$path_anh."'
        WHERE `nhanvien`.`id_nv` = '".$id_nv."';
    ";
    echo  $sql;
    $con->query($sql);
    header("Location: sua_nv.php?id=".$_SESSION['id_nhanvien']."");
?>