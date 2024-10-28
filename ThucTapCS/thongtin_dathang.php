<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết hóa đơn</title> 
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/tieude.css">
    <link rel="stylesheet" href="css/noidung.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/giohang.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>

<body>
    <?php
        session_start();
        include '/ThucTapCS/connection/connection.php';
        include 'tieude.php';
        $sql = "SELECT * from thanhvien where id = '".$_SESSION['id']."'";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        $sql_hoadon = "SELECT * FROM `hoadon` where id = '".$_SESSION['id']."' ORDER BY `hoadon`.`id_hd` DESC";
        $result_hoadon = $con->query($sql_hoadon);
        $row_hoadon = $result_hoadon->fetch_assoc();
    ?>
    <!-- Nội dung của trang web -->
    <div id="noidung">
        <div id="dienthoai">
            <h1>Thông tin hóa đơn</h1>
            <div id="thongtin">
                <table>
                    <tr>
                        <td>Mã đơn hàng: </td>
                        <th><?php echo $row_hoadon['id_hd'] ?></th>
                    </tr>
                    <tr>
                        <td>Tên khách hàng: </td>
                        <th><?php echo $row['hoten_tv'] ?></th>
                    </tr>
                    <tr>
                        <td>Số điện thoại: </td>
                        <th><?php echo $row['sdt'] ?></th>
                    </tr>
                    <tr>
                        <td>Địa chỉ giao hàng: </td>
                        <th><?php echo $row['diachi'] ?></th>
                    </tr>
                    <tr>
                        <td>Ghi chú: </td>
                        <th><?php echo $row_hoadon['ghichu'] ?></th>
                    </tr>
                    <tr>
                        <td>Thời gian đặt hàng: </td>
                        <th><?php echo $row_hoadon['ngay_dathang'] ?></th>
                    </tr>
                </table>
            </div>
            <div id="banghoadon">
            <table >
                <tr>
                    <th>STT</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Khuyến mãi</th>
                    <th>Thành tiền</th>
                </tr>
                <?php
                    $sql = "SELECT *, cthd.sl_sp as soluong, cthd.khuyenmai FROM chitiethoadon cthd, sanpham sp,(
                            SELECT max(id_hd) as lonnhat FROM hoadon WHERE hoadon.id = '".$_SESSION['id']."' ) hd
                            WHERE cthd.id_hd = hd.lonnhat and cthd.id_sp = sp.id_sp
                        ";
                    $i = 0;
                    $tt = 0;
                    $result_hd = $con->query($sql);
                    if($result_hd->num_rows > 0){
                        while($row_hd = $result_hd->fetch_assoc()){
                            $tt = $tt + $row_hd['thanhtien'];
                            echo "
                            <tr>
                                <td>".++ $i."</td>
                                <td><img src='./img/".$row_hd['img_sp']."' alt='' width=60px height=60px></td>
                                <td>".$row_hd['ten_sp']."</td>
                                <td>".number_format($row_hd['dongia'], 0, '', ',')." Đ</td>
                                <td>".$row_hd['soluong']."</td>";
                                
                                if($row_hd['khuyenmai'] != 0){
                                    echo "<td>".number_format($row_hd['khuyenmai']*$row_hd['soluong'], 0, '', ',')." Đ</td>";
                                }else{
                                    echo "<td></td>";
                                }
                            echo "
                                <td>".number_format($row_hd['thanhtien'], 0, '', ',')." Đ</td>
                            </tr>
                            ";
                        }
                        echo "
                            <tr>
                                <th colspan='6' id='tt'>Tổng cộng</th>
                                <th>".number_format($tt, 0, '', ',')." Đ</th>
                            </tr>
                        ";
                    }
                ?>
            </table>
            </div>
       </div>
    </div>
    <?php
        include 'footer.php';
    ?>
    <script src="js/timkiemsp.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <script>
    Swal.fire(
      'Thanh toán thành công',
      '',
      'success'
    )
    </script>
</body>
    
</html>