<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trung tâm thiết bị công nghệ</title>
    <link rel = "icon" href =  
    "../img/logo/logo_in.png" 
    type = "image/x-icon"> 
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>
<body>
    <?php
        include '../connection/connection.php';
        session_start();
        if(isset($_SESSION['admin'])){
            unset($_SESSION['id_nv']);
        }
        if(isset($_SESSION['id_nv'])){
            unset($_SESSION['admin']);
        }
        if(isset($_SESSION['admin']) || isset($_SESSION['id_nv'])){
            session_start();
            include 'tieude.php';?>
            <div id="content">
                <?php
                    include 'menu_trai.php';
                ?>
            <div id="noidungchinh">
                <div id="noidung">
                    <div class="fa tongsp">
                        <div class="tren">
                            <a href=""><i class="fas fa-book"></i></a>
                            <div>
                                <?php
                                    //Tổng số sản phẩm
                                    //Viết câu truy vấn
                                    $sql_TongSoSanPham = "SELECT count(id_sp) as TongSoSanPham from sanpham";
                                    $result_TongSoSanPham = $con->query($sql_TongSoSanPham);
                                    $row_TongSoSanPham = $result_TongSoSanPham->fetch_assoc();
                                ?>
                                <p>Tổng số sản phẩm:</p>
                                <h2><?php echo $row_TongSoSanPham['TongSoSanPham']?></h2>
                            </div>
                        </div>
                        <div class="duoi">
                            <a href="danhsach_sp.php">Xem chi tiết</a>
                            <a href="danhsach_sp.php"> <i class="fas fa-angle-double-down"></i></a>
                        </div>
                    </div>
                    <div class="fa hethangsp">
                        <div class="tren">
                            <a href=""><i class="fas fa-book"></i></a>
                            <div>
                                <?php
                                    //Tổng số sản phẩm hết hàng
                                    //Viết câu truy vấn
                                    $sql_TongSoSanPhamHetHang = "SELECT count(id_sp) as TongSoSanPhamHetHang from sanpham where sl_sp < 3";
                                    $result_TongSoSanPhamHetHang = $con->query($sql_TongSoSanPhamHetHang);
                                    $row_TongSoSanPhamHetHang = $result_TongSoSanPhamHetHang->fetch_assoc();
                                ?>
                                <p>Sản phẩm sắp hết hàng:</p>
                                <h2><?php echo $row_TongSoSanPhamHetHang['TongSoSanPhamHetHang']?></h2>
                            </div>
                        </div>
                        <div class="duoi">
                            <a href="thongKeDonHangDaHet.php">Xem chi tiết</a>
                            <a href="thongKeDonHangDaHet.php"> <i class="fas fa-angle-double-down"></i></a>
                        </div>
                    </div>
                    <div class="fa giohang">
                        <div class="tren">
                            <a href=""><i class="fas fa-book"></i></a>
                            <div>
                                <?php
                                    //Tổng số có trong giỏ hàng
                                    //Viết câu truy vấn
                                    $sql_TongSoGioHang = "SELECT count(id_gh) as TongSoGioHang from giohang";
                                    $result_TongSoGioHang = $con->query($sql_TongSoGioHang);
                                    $row_TongSoGioHang = $result_TongSoGioHang->fetch_assoc();
                                ?>
                                <p>Tổng số giỏ hàng</p>
                                <h2><?php echo $row_TongSoGioHang['TongSoGioHang']?></h2>
                            </div>
                        </div>
                        <div class="duoi">
                            <a href="danhsach_gh.php">Xem chi tiết</a>
                            <a href="danhsach_gh.php"> <i class="fas fa-angle-double-down"></i></a>
                        </div>
                    </div>
                    <div class="fa tongdonhang">
                        <div class="tren">
                            <a href="donhang.php"><i class="fas fa-book"></i></a>
                            <div>
                                <?php
                                    //Tổng số đơn hàng
                                    //Viết câu truy vấn
                                    $sql_TongSoDonHang = "SELECT count(id_hd) as TongSoDonHang from hoadon";
                                    $result_TongSoDonHang = $con->query($sql_TongSoDonHang);
                                    $row_TongSoDonHang = $result_TongSoDonHang->fetch_assoc();
                                ?>
                                <p>Tổng đơn hàng</p>
                                <h2><?php echo $row_TongSoDonHang['TongSoDonHang']?></h2>
                            </div>
                        </div>
                        <div class="duoi">
                            <a href="donhang.php">Xem chi tiết</a>
                            <a href="donhang.php"> <i class="fas fa-angle-double-down"></i></a>
                        </div>
                    </div>
                    <div class="fa tongdt">
                        <div class="tren">
                            <a href=""><i class="fas fa-book"></i></a>
                            <div>
                                <?php
                                    //Tổng số danh thu
                                    //Viết câu truy vấn
                                    $sql_TongSoDoanhThu = "SELECT sum(thanhtien) as tongtien from chitiethoadon";
                                    $result_TongSoDoanhThu = $con->query($sql_TongSoDoanhThu);
                                    $row_TongSoDoanhThu = $result_TongSoDoanhThu->fetch_assoc();
                                ?>
                                <p>Tổng doanh thu</p>
                                <h2><?php echo number_format($row_TongSoDoanhThu['tongtien'], 0, '', ',') . "VNĐ"?></h2>
                            </div>
                        </div>
                        <div class="duoi">
                            <a href="">Xem chi tiết</a>
                            <a href=""> <i class="fas fa-angle-double-down"></i></a>
                        </div>
                </div>
            </div>
        </div>
        <?php
        }else{
            header("Location: ../../ThucTapCS/index.php");
        }
    ?>
</body>
</html>