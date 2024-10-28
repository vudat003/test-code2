<?php
    session_start();
    $str =  explode('/',$_GET['tk']);
    $sl = $str[0];
    $idsp = $str[1];
    include '../connection/connection.php';
    // cap nhat so luong trong gio hang
        $sql = "UPDATE giohang set trangthai = '".$sl."' where id_sp = '".$idsp."'";
        $con->query($sql);
    //Tinh tong tien
    $sql = "SELECT * FROM sanpham sp, giohang gh, thanhvien tv
    WHERE sp.id_sp = gh.id_sp and tv.id = gh.id and trangthai = 1 and gh.id = ".$_SESSION['id']."";
    $result_tt = $con->query($sql);
    $i = 0;
    $tt = 0;
    if($result_tt->num_rows > 0 && $_SESSION['id']){
        while($row_tt = $result_tt->fetch_assoc()){
            $tt = $tt + ($row_tt['gia_ban']*$row_tt['soluong'] - $row_tt['soluong']*$row_tt['giatrikhuyenmai']) ;
        }
    }

    echo "Tạm tính: ".number_format($tt, 0, '', ',')." Đ";
?>