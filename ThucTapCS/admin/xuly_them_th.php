<?php
    $maloai = $_POST['maloaisp'];
    $math = $_POST['ma_th'];
    $tenth = $_POST['ten_th'];
    $path_anh = './img_th/'.$_FILES['logo']['name'];
    move_uploaded_file($_FILES['logo']['tmp_name'], "../img/".$path_anh);
    include '../connection/connection.php';
    $sql = "INSERT into thuonghieu (ma_loaisp, ma_th, ten_tenth, img_th) 
    value ('".$maloai."', '".$math."', '".$tenth."','".$path_anh."')";
    $result = $con->query($sql);
    header("Location: them_th.php");
    $con->close();
?>