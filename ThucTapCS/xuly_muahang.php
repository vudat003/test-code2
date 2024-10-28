<?php
    include './connection/connection.php';
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    session_start();
    $id = $_SESSION['id'];
    $ten_kh = test_input($_POST['name_cus']);
    $sdt = test_input($_POST['phone']);
    $matinh = $_POST['tinh_tp'];
    $mahuyen = $_POST['quan_huyen'];
    $ma_xaphuong = $_POST['xa_phuong'];
    $diachi = test_input($_POST['sonha']);
    //Hien thị tên tinh thành của việt Nam
    $sql_show_tentinh = "SELECT _name FROM `province` where id = ".$matinh;
    $result_tentinh = $con->query($sql_show_tentinh);
    if($row_tentinh = $result_tentinh->fetch_assoc()){
        $tentinh = $row_tentinh['_name'];
    }
    //Hiện thị quận huyện
    $sql_show_quanhuyen = "SELECT _name, _prefix from district where id = ".$mahuyen;
    $result_quanhuyen = $con->query($sql_show_quanhuyen);
    if($row_quanhuyen =  $result_quanhuyen->fetch_assoc()){
        $ten_quanhuyen = $row_quanhuyen['_name'];
        $prefix = $row_quanhuyen['_prefix'];
    }
    //Hiển thị tên xã phường
    $sql_xaphuong = "SELECT _name, _prefix from ward where id = ".$ma_xaphuong;
    $result_xaphuong = $con->query($sql_xaphuong);
    if($row_xaphuong = $result_xaphuong->fetch_assoc()){
        $tenxaphuong = $row_xaphuong['_name'];
        $prefix_xp = $row_xaphuong['_prefix'];
    }
    //noi chuoi tao thanh dia chi cu the
    $diachi = $diachi .", " . $prefix_xp . " " . $tenxaphuong . ", " . $prefix . " " . $ten_quanhuyen .", " . $tentinh;
    $ghichu = test_input($_POST['ghichu']);
    //them thong tin khach hang trong bang khachhang
    $sql = "UPDATE thanhvien set hoten_tv = '".$ten_kh."', sdt = '".$sdt."', diachi = '".$diachi."' where id = '".$id."'";
    $con->query($sql);
    //insert vao hoa don
    $sql = "INSERT into hoadon(id_hd, id, ngay_dathang, noi_nhanhang, id_nv, ghichu) 
            value (null,'$id', null, '$diachi', null, '$ghichu')";
    $con->query($sql);
    $sql_hd = "SELECT * from hoadon where id = '".$id."'";
    $result_hd = $con->query($sql_hd);
    if($result_hd->num_rows > 0){
        while($row_hd = $result_hd->fetch_assoc()){
            $id_hd = $row_hd['id_hd'];
        }
    }
    //lay du lieu don gia
    $sql = "SELECT * FROM sanpham sp, giohang gh, thanhvien tv
    WHERE sp.id_sp = gh.id_sp and tv.id = gh.id and trangthai = 1 and gh.id = ".$_SESSION['id']."";
    $result_tt = $con->query($sql);
    $i = 0;
    $tt = 0;
    if($result_tt->num_rows > 0){
        while($row_tt = $result_tt->fetch_assoc()){
            $soluong_ban = $row_tt['soluong'];
            $soluong_goc = $row_tt['sl_sp'];
            $idsp = $row_tt['id_sp'];
            $tt = ($row_tt['gia_ban'] - $row_tt['giatrikhuyenmai'])*$row_tt['soluong'];
            $dongia = $row_tt['gia_ban'];
            $khuyenmai =  $row_tt['giatrikhuyenmai'];
            $sql_chitiet = "
                INSERT into chitiethoadon(id_cthd ,id_hd, id_sp, dongia, sl_sp, thanhtien, khuyenmai)
                value (null, '".$id_hd."', '".$row_tt['id_sp']."', '".$dongia."',  '".$row_tt['soluong']."',  $tt, '$khuyenmai')
                ";
            $con->query($sql_chitiet);
            //cap nhat lai so luong san pham
            $sl_capnhat = $soluong_goc - $soluong_ban;
            $sql = "UPDATE sanpham set sl_sp = '".$sl_capnhat."' where id_sp = '".$row_tt['id_sp']."'";
            $con->query($sql);
        }
    }
    //lay du trong gio hang them vao chi tiet hoa don

    //xoa du lieu trong gio hang neu co trang thai bang 1
    $sql = "DELETE from giohang where trangthai = 1 and id = ".$id."";
    $con->query($sql);
    
    header("Location: thongtin_dathang.php");
?>