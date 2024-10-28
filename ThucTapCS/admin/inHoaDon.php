<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/inHoaDon.css">
    <title>In hoá đơn</title>
    <link rel = "icon" href =  
    "../img/logo/logo_in.png" 
    type = "image/x-icon"> 
</head>
<body onload="window.print();">
<div id="page" class="page">
    <div class="header">
        <div class="logo"><img src="../img/logo/logo_in.PNG" width="180px" height="50px"/></div>
        <div class="company">TT thiết bị công nghệ T&T_IT</div>
    </div>
  <br/>
    <div class="title">
            HÓA ĐƠN THANH TOÁN
            <br/>
            -------oOo-------
    </div>
    <br/>
    <br/>
    <table class="TableData">
        <tr>
        <th>STT</th>
        <th>Tên sản phẩm</th>
        <th>Đơn giá</th>
        <th>Số lượng</th>
        <th>Khuyến mãi</th>
        <th>Thành tiền</th>
        </tr>
        <?php
            session_start();
            include('../connection/connection.php');
            $id_hoadon = $_GET['id_hd'];
            $sql_ttsp_trongHD = "
                SELECT sp.ten_sp, SP_HD.sl_sp, SP_HD.dongia, SP_HD.khuyenmai 
                FROM ( SELECT cthd.id_sp, cthd.sl_sp, cthd.dongia, cthd.khuyenmai FROM chitiethoadon cthd WHERE cthd.id_hd = '".$id_hoadon."' ) SP_HD, sanpham sp
                WHERE SP_HD.id_sp = sp.id_sp
            ";

            $result_hd = $con->query($sql_ttsp_trongHD);
            $tongsotien = 0;
            $pos = 0;
            if($result_hd ->num_rows > 0){
                while($row = $result_hd->fetch_assoc()){
                    $tongsotien += $row['sl_sp'] * ($row['dongia'] - $row['khuyenmai']);
                    echo "<tr>";
                    echo "<td class=\"cotSTT\">".$pos++."</td>";
                    echo "<td class=\"cotTenSanPham\">".$row['ten_sp']."</td>";
                    echo "<td class=\"cotGia\">".number_format($row['dongia'],0,",",".")."</td>";
                    echo "<td class=\"cotSoLuong\" align='center'>".$row['sl_sp']."</td>";
                    echo "<td class=\"cotGia\">".number_format($row['khuyenmai']*$row['sl_sp'],0,",",".")."</td>";
                    echo "<td class=\"cotSo\">".number_format(($row['sl_sp']*($row['dongia']-$row['khuyenmai'])),0,",",".")."</td>";
                    echo "</tr>";

                }
            }
    ?>
        <tr>
        <td colspan="5" class="tong">Tổng cộng</td>
        <td class="cotSo"><?php echo number_format(($tongsotien),0,",",".")?></td>
        </tr>
    </table>
    <?php
        $date_array = getdate();
        $formated_date  = "Cần thơ, ngày ";
        $formated_date .= $date_array['mday'] . " tháng ";
        $formated_date .= $date_array['mon'] . " năm ";
        $formated_date .= $date_array['year'];
        //Lay id nhan vien và id cua thanh viên mua hàng
        $sql = "SELECT * from hoadon where id_hd = '".$id_hoadon."'";
        $result = $con->query($sql);
        if($row = $result->fetch_assoc()){
            $id_nv = $row['id_nv'];
            $id_tv = $row['id'];
        }
        //Lay ten khach hang
        $sql_ten_tv = "SELECT hoten_tv from thanhvien where id = '".$id_tv."'";
        $result_ten_tv = $con->query($sql_ten_tv);
        if($result_ten_tv->num_rows > 0){
            while($row_ten_tv = $result_ten_tv->fetch_assoc()){
                echo "<div class='footer-left'><br/>
                Khách hàng
                    <br>
                    <br>
                    <br>
                ".$row_ten_tv['hoten_tv']."</div>";
            }
        }
        //Lay ten nhan vien
        $sql_ten_nv = "SELECT ten_nv from nhanvien where id_nv = '".$id_nv."'";
        $result_ten_nv = $con->query($sql_ten_nv);
        if($result_ten_nv->num_rows > 0){
            while($row_ten_nv = $result_ten_nv->fetch_assoc()){
                echo "<div class='footer-left'>".$formated_date."<br/>
                Nhân viên
                    <br>
                    <br>
                    <br>
                ".$row_ten_nv['ten_nv']."</div>";
            }
        }
    ?>
    </body>
</html>