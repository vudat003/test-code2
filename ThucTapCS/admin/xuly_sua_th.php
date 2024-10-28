<?php
    session_start();
    $maloai = $_POST['maloaisp'];
    $math = $_POST['ma_th'];
    $tenth = $_POST['ten_th'];
    $path_anh = './img_th/'.$_FILES['logo']['name'];
    move_uploaded_file($_FILES['logo']['tmp_name'], "../img/".$path_anh);
    if($path_anh == "./img_th/"){
        $path_anh =  $_SESSION['img_th'];
    }
    if($maloai == "" || $math == "" || $tenth == "" || $path_anh == ""){
        header("Location: sua_th.php?id=".$_SESSION['id']."");
    }else{
        include '../connection/connection.php';
        $sql = "UPDATE thuonghieu set 
                ma_loaisp = '".$maloai."', ma_th = '".$math."', ten_tenth = '".$tenth."', img_th = '".$path_anh."'
                where id_th = '".$_SESSION['id']."'";
        $result = $con->query($sql);
        header("Location: sua_th.php?id=".$_SESSION['id']."");
        $con->close();
    }
?>