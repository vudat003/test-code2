<!DOCTYPE html>
<html lang="en">
<?php
        session_start();
        if(isset($_SESSION['user'])){
            include './connection/connection.php';
            $sql = "SELECT * from thanhvien where tentaikhoan = '".$_SESSION['user']."'";
            $result = $con->query($sql);
            $row = $result->fetch_assoc();
        }else{
            header("Location: index.php");
        }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['hoten_tv']?></title>
    <link rel = "icon" href =  
    "img/logo/logo.png" 
    type = "image/x-icon"> 
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/tieude.css">
    <link rel="stylesheet" href="css/noidung.css">
    <link rel="stylesheet" href="css/tt_thanhvien.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>
<body>
    <?php
        include 'tieude.php';
    ?>
    <div id="introduction">
        <div id="bg">
            <h1>Hello <?php echo $row['tentaikhoan']?></h1>
        </div>
        <div id="content">
            <div id="story">
                <h2>Lời chúc khách hàng</h2>
                <p>Chúng tôi thực sự biết ơn vì bạn đã ghi nhớ, ưu tiên sử dụng các sản phẩm, 
                    dịch vụ của chúng tôi khi có nhu cầu. Chúng tôi không thể có sự thành công như hôm nay nếu không có bạn.
                    Chúc mừng tháng mới thịnh vượng,
                    những người khách hàng thân thiết của chúng tôi!
                </p>
            </div>
            <div id="image">
                <?php
                    echo "<img src='img/".$row['path_anh_tv']."' alt=''>";
                ?>
            </div>
            <div id="infor_main">
                <h2>Thông tin khách hàng</h2>
                <table>
                    <tr>
                        <td>Tên tài khoản: </td>
                        <td>
                            <?php
                                echo $row['tentaikhoan'];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Họ và tên: </td>
                        <td>
                            <?php
                                echo $row['hoten_tv'];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Số điện thoại: </td>
                        <td>
                            <?php
                                echo $row['sdt'];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td>
                            <?php
                                echo $row['email'];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Địa chỉ: </td>
                        <td>
                            <?php
                                echo $row['diachi'];
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="bnt">
        <div class="bnt_left">
            <button onclick="kiemTraDonHang(0)" id='chuaduyet'>Đơn hàng chưa duyệt</button>
        </div>
        <div class="bnt_right">
            <button onclick="kiemTraDonHang(1)" id='daduyet'>Đơn hàng đã duyệt</button>
        </div>
    </div>
    <div id="hoadonChuaDuyet">
        <?php
            include("/ThucTapCS/connection/connection.php");
            $sql_id_hoadon = "SELECT * from hoadon where id = '".$_SESSION['id']."' and trangthai = '0' ORDER BY `hoadon`.`ngay_dathang` DESC";
            $result_id_hoadon = $con->query($sql_id_hoadon);
            if($result_id_hoadon->num_rows > 0){
                while($row_id_hoadon = $result_id_hoadon->fetch_assoc()){
                ?>
                <div class="gach">
                    <h3>Mã đơn hàng: <?php echo $row_id_hoadon['id_hd'];?></h3>
                    <div class="lichsumuahang">
                        <table>
                            <tr class="time">
                                <th colspan="8">Đơn hàng ngày: <?php echo $row_id_hoadon['ngay_dathang'];?></th>
                            </tr>
                            <tr class="th_mucchinh">
                                <th>STT</th>
                                <th>Sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Giảm giá</th>
                                <th>Thành tiền</th>
                                <th>Trạng thái</th>
                            </tr>
                            <?php
                                $sql_cthd = "SELECT sp.ten_sp, sp.img_sp, cthd.dongia, cthd.sl_sp, sp.giatrikhuyenmai from chitiethoadon cthd, sanpham sp
                                            WHERE cthd.id_sp = sp.id_sp and cthd.id_hd = '".$row_id_hoadon['id_hd']."'" ;
                                $result_cthd = $con->query($sql_cthd);
                                $stt = 0;
                                $tongtien_cd = 0;
                                while($row_cthd = $result_cthd->fetch_assoc()){
                                    $tongtien_cd += ($row_cthd['dongia']-($row_cthd['giatrikhuyenmai']))*$row_cthd['sl_sp'];
                                ?> 
                                    <tr class="ttsp">
                                        <td><?php echo ++ $stt; ?></td>
                                        <td><?php echo $row_cthd['ten_sp'];?></td>
                                        <?php echo "<td><img src='img/".$row_cthd['img_sp']."' alt='' width=100px height=100px></td>";?>
                                        <td><?php echo number_format($row_cthd['dongia'], 0, '', ',');?> VNĐ</td>
                                        <td><?php echo $row_cthd['sl_sp'];?></td>
                                        <td><?php echo number_format($row_cthd['giatrikhuyenmai']*$row_cthd['sl_sp'], 0, '', ',');?> VNĐ</td>
                                        <td><?php echo number_format(($row_cthd['dongia']-($row_cthd['giatrikhuyenmai']))*$row_cthd['sl_sp'], 0, '', ',');?> VNĐ</td>

                                        <td></td>
                                    </tr>
                                <?php
                                }
                            ?>
                            <tr class="tt">
                                <th colspan="6">Tổng tiền</th>
                                <th><?= number_format($tongtien_cd, 0, '', ',')?></th>
                                <th>Chưa xử lý</th>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php
                }
            }else{
                echo"";
            }
        ?>
    </div>
    <div id="hoadonDaDuyet">
        <?php
            include("/ThucTapCS/connection/connection.php");
            $sql_id_hoadon = "SELECT * from hoadon where id = '".$_SESSION['id']."' and trangthai = 1 ORDER BY `hoadon`.`ngay_dathang` DESC";
            $result_id_hoadon = $con->query($sql_id_hoadon);
            if($result_id_hoadon->num_rows > 0){
                while($row_id_hoadon = $result_id_hoadon->fetch_assoc()){
                ?>
                <div class="gach">
                    <h3>Mã đơn hàng: <?php echo $row_id_hoadon['id_hd'];?></h3>
                    <div class="lichsumuahang">
                        <table>
                            <tr class="time">
                                <th colspan="8">Đơn hàng ngày: <?php echo $row_id_hoadon['ngay_dathang'];?></th>
                            </tr>
                            <tr class="th_mucchinh">
                                <th>STT</th>
                                <th>Sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Giảm giá</th>
                                <th>Thành tiền</th>
                                <th>Trạng thái</th>
                            </tr>
                            <?php
                                $sql_cthd = "SELECT sp.ten_sp, sp.img_sp, cthd.dongia, cthd.sl_sp, sp.giatrikhuyenmai from chitiethoadon cthd, sanpham sp
                                            WHERE cthd.id_sp = sp.id_sp and cthd.id_hd = '".$row_id_hoadon['id_hd']."'" ;
                                $result_cthd = $con->query($sql_cthd);
                                $stt = 0;
                                $tongtien = 0;
                                while($row_cthd = $result_cthd->fetch_assoc()){
                                    $tongtien += $row_cthd['dongia']*$row_cthd['sl_sp'];
                                ?> 
                                    <tr class="ttsp">
                                        <td><?php echo ++ $stt; ?></td>
                                        <td><?php echo $row_cthd['ten_sp'];?></td>
                                        <?php echo "<td><img src='img/".$row_cthd['img_sp']."' alt='' width=100px height=100px></td>";?>
                                        <td><?php echo number_format($row_cthd['dongia'], 0, '', ',');?></td>
                                        <td><?php echo $row_cthd['sl_sp'];?></td>
                                        <td><?php echo number_format($row_cthd['giatrikhuyenmai']*$row_cthd['sl_sp'], 0, '', ',');?> VNĐ</td>
                                        <td><?php echo number_format(($row_cthd['dongia']-($row_cthd['giatrikhuyenmai']))*$row_cthd['sl_sp'], 0, '', ',');?></td>
                                        <td></td>
                                    </tr>
                                <?php
                                }
                            ?>
                            <tr class="tt">
                                <th colspan="6">Tổng tiền</th>
                                <th><?= number_format($tongtien, 0, '', ',')?></th>
                                <th>Đã xử lý</th>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php
                }
            }else{
                echo"";
            }
        ?>
    </div>
    <?php
        include 'footer.php';
    ?>
    <script src="js/timkiemsp.js"></script>
    <script src="js/kiemTraDonHang.js"></script>
</body>
</html>