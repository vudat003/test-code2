<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/menu_trai.css">
    <link rel="stylesheet" href="../css/content_ad.css">
    <link rel="stylesheet" href="../css/danhsach_lsp_th_sp.css">
    <link rel="stylesheet" href="../css/xacnhandonhang.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>
<body>
    <?php
        session_start();
        include 'tieude.php';
    ?>
    <div id="content">
        <?php
            include 'menu_trai.php';
        ?>
        <div id="noidungchinh">
            <?php
                include '../connection/connection.php';
                $sql_hoadon = "SELECT id_hd, id FROM `hoadon` ORDER BY `hoadon`.`id_hd` DESC";
                $result_hoadon = $con->query($sql_hoadon);
                $row_hoadon = $result_hoadon->fetch_assoc();
            ?>
            <h2>Thông tin đơn hàng</h2>
            <div id="thongtinkhachhang">
                <h4>Mã đơn hàng: <?php echo $row_hoadon['id_hd']?></h4>
                <h4>Tên khách hàng: <?php echo $_SESSION['ten_kh']?></h4>
                <h4>Số điện thoại: <?php echo $_SESSION['sdt_kh']?></h4>
            </div>
            <div id="bangsanpham">
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
                            SELECT max(id_hd) as lonnhat FROM hoadon WHERE hoadon.id = '".$row_hoadon['id']."' ) hd
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
                                <td><img src='../img/".$row_hd['img_sp']."' alt='' width=60px height=60px></td>
                                <td>".$row_hd['ten_sp']."</td>
                                <td>".number_format($row_hd['dongia'], 0, '', ',')." Đ</td>
                                <td>".$row_hd['soluong']."</td>";
                                if($row_hd['khuyenmai'] != 0){
                                    echo "<td>".number_format($row_hd['khuyenmai'], 0, '', ',')." Đ</td>";
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
            <div id="inhoadon">
                <a href="inHoaDon.php?id_hd=<?php echo $row_hoadon['id_hd']?>" target="_blank">In hoá đơn</a>
            </div>
        </div>
    </div>
</body>
</html>