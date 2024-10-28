<?php
    session_start();
    include '../connection/connection.php';
    $tenkh = $_POST['tenkhachhang'];
    $sdt = $_POST['sodienthoai'];

    $_SESSION['ten_kh'] = $tenkh;
    $_SESSION['sdt_kh'] = $sdt;
    //Insert thong tin khach hang
    $sql_themthanhvien = "INSERT INTO `thanhvien` (`id`, `hoten_tv`, `tentaikhoan`, `matkhau`, `email`, `sdt`, `path_anh_tv`, `diachi`) VALUES (NULL, '$tenkh', '', '', '', '$sdt', '', '')";
    $con->query($sql_themthanhvien);

    //Lấy id thanh viên cuối cùng
    $sql_idthanhvien = "SELECT id from thanhvien order by id DESC limit 1";
    $result_idthanhvien = $con->query($sql_idthanhvien);
    $row_idthanhvien = $result_idthanhvien->fetch_assoc();
    $idthanhvien = $row_idthanhvien['id'];
    if(isset($_SESSION['id_nv'])){
        //insert vao hoa don đối với nhân viên
        $sql = "INSERT into hoadon(id_hd, id, ngay_dathang, noi_nhanhang, id_nv, ghichu, trangthai) 
        value (null,'$idthanhvien', null, '', '".$_SESSION['id_nv']."', '', '1')";
        $con->query($sql);
    }else if(isset($_SESSION['admin'])){
        //insert vao hoa don đối với admin
        $sql = "INSERT into hoadon(id_hd, id, ngay_dathang, noi_nhanhang, id_nv, ghichu, trangthai) 
        value (null,'$idthanhvien', null, '', null, '', '1')";
        $con->query($sql);
    }
    
    //Lấy id hoá đơn cuối cùng
    $sql_idhd = "SELECT id_hd from hoadon order by id_hd  DESC limit 1";
    $result_idhd = $con->query($sql_idhd);
    $row_idhd = $result_idhd->fetch_assoc();
    $idhd = $row_idhd['id_hd'];
    //Đỗ dữ liệu từ bảng thanh toán tạm vào chitiethoadon
    $sql_getdata_thanhtoantt = "SELECT * from thanhtoan_tam";
    $result_getdata_thanhtoantt = $con->query($sql_getdata_thanhtoantt);
    if($result_getdata_thanhtoantt->num_rows > 0){
        while($row_getdata_thanhtoantt = $result_getdata_thanhtoantt->fetch_assoc()){
            //Lấy từng dòng dữ liệu đưa vao chi tiết hoa đon
            $tt = ($row_getdata_thanhtoantt['dongia_sp'] - $row_getdata_thanhtoantt['khuyenmai'])*$row_getdata_thanhtoantt['sl_sp'];
            $sql_setchitiethd = "INSERT into chitiethoadon(id_cthd ,id_hd, id_sp, dongia, sl_sp, thanhtien, khuyenmai)
            value (null, '".$idhd."', '".$row_getdata_thanhtoantt['idsp']."', '".$row_getdata_thanhtoantt['dongia_sp']."',  '".$row_getdata_thanhtoantt['sl_sp']."',  $tt, '".$row_getdata_thanhtoantt['khuyenmai']."')";
            $con->query($sql_setchitiethd);
        }
    }
    $sql_thanhtoan_tam = "SELECT * from thanhtoan_tam";
    $result_thanhtoan_tam = $con->query($sql_thanhtoan_tam);
    while($row_thanhtoan_tam = $result_thanhtoan_tam->fetch_assoc()){
        //Get so luong goc
        $sql_soluonggoc = "SELECT sl_sp from sanpham where id_sp = ".$row_thanhtoan_tam['idsp']."";
        $result_soluonggoc = $con->query($sql_soluonggoc);
        $row_soluonggoc = $result_soluonggoc->fetch_assoc();
        //Cập nhật lại số lượng sản phẩm trong kho
        $sl_capnhat = $row_soluonggoc['sl_sp'] - $row_thanhtoan_tam['sl_sp'];
        // echo  $row_thanhtoan_tam['idsp']."- ". $row_soluonggoc['sl_sp'] . " - " . $row_thanhtoan_tam['sl_sp'] ." = ". $sl_capnhat."<br>";
        $sql_capnhat = "UPDATE sanpham set sl_sp = '".$sl_capnhat."' where id_sp = '".$row_thanhtoan_tam['idsp']."'";
        $con->query($sql_capnhat);
    }
        //xoa du lieu trong gio hang neu co trang thai bang 1
        $sql_delete = "DELETE from thanhtoan_tam";
        $con->query($sql_delete);
        header("Location: xacnhandonhang.php");
?>