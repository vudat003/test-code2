<!DOCTYPE html>
<html lang="en">

<?php   
        session_start();
        include 'connection/connection.php';
        $ma_loaiSP = $_GET['lsp'];
        unset($_SESSION['ma_th']);
        unset($_SESSION['gia']);
        unset($_SESSION['khuyenmai']);
        unset($_SESSION['sosao']);
        unset($_SESSION['sapxep']);
        $sql = "SELECT * from loaisp where ma_loaisp = '".$ma_loaiSP."'";
        $con->query($sql);
        $row = $con->query($sql)->fetch_assoc();
        $tenloaisp = $row['ten_loaisp']
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['ten_loaisp']?></title>
    <link rel = "icon" href =  
    "img/logo/logo.png" 
    type = "image/x-icon"> 
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/tieude.css">
    <link rel="stylesheet" href="css/banner_loaisp.css">
    <link rel="stylesheet" href="css/boloc.css">
    <link rel="stylesheet" href="css/thuonghieu.css">
    <link rel="stylesheet" href="css/noidung.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>

<body>
    <?php
        include 'tieude.php';
    ?>
    <?php
        include 'slider_loaisp.php';
    ?>
    <?php
        include 'boloc.php';
    ?>
        <?php
        include 'thuonghieu.php';
    ?>
    <div id="noidung">
    <?php
        $sql_tongso_sp = "SELECT * from sanpham where ma_loaisp = '".$ma_loaiSP."' group by ten_sp";
        $result_tong = $con->query($sql_tongso_sp);
        $tongso_sp = $result_tong->num_rows;
        $tranghientai = !empty($_GET['page']) ? $_GET['page'] : 1;
        $ofsset = ($tranghientai - 1) * 10;
        $loaisp = "SELECT * from sanpham sp, loaisp lsp 
                    where sp.ma_loaisp = '".$ma_loaiSP."' and sp.ma_loaisp = lsp.ma_loaisp and sl_sp > 0 
                    group by sp.ten_sp
                    order by sp.id_sp
                    limit 10 offset ".$ofsset."
        ";
        $tongsotrang = ceil($tongso_sp/10);
        $result_lsp = $con->query($loaisp);
        if($result_lsp->num_rows > 0){
            echo "<div id='dienthoai'>
                        <div class='tieude'>
                            <h2><i class='fas fa-angle-double-right'></i>".$tenloaisp."</h2>
                            <a href='noidung_loaisp.php?lsp=".$ma_loaiSP."'>Xem tất cả <i class='fas fa-angle-double-right'></i></a>
                        </div>
                        <div class='danhsachsanpham'>";
            while($row1 = $result_lsp->fetch_assoc()){
                    $gia_goc = number_format($row1['gia_ban'], 0, '', ',');
                    $gia_giam = number_format($row1['gia_ban']-($row1['giatrikhuyenmai']), 0, '', ',');
                    echo "
                        <div class='sanpham'>
                            <a href='chitietsanpham.php?idsp=".$row1['id_sp']."'>";
                        if($row1['khuyenmai'] == "Trả góp"){
                            echo "<p class='tragop'>Trả góp ".$row1['giatrikhuyenmai']." %</p>";
                        }else if($row1['khuyenmai'] == "Giảm giá"){
                            echo "<p class='gg'>Giảm: -".number_format($row1['giatrikhuyenmai'], 0, '', ',')."</p>";
                        }else if($row1['khuyenmai'] == "Mới ra mắt"){
                            echo "<p class='moi'>Mới ra mắt</p>";
                        }else{
                            echo "<p class='khong'>Không khuyến mãi gì hết</p>";
                        }
                    echo "
                                <img src='./img/".$row1['img_sp']."' alt=''>
                                <div class='ttsp'>
                                    <p class='tensp'>".$row1['ten_sp']."</p>
                                    <div class='giamgia_phantram'>
                                        <p class='giamgia'>".$gia_giam."<u>đ</u></p>
                                        <p class='phantramgiam'></p>
                                    </div>
                                    <p class='giagoc'>".$gia_goc."<u>đ</u></p>
                                    <div class='start'>
                        ";
                            for($i = 1; $i <= $row1['sosao']; ++ $i){
                                echo "<i class='fas fa-star'></i>";
                            }
                    echo"
                                        <p class='danhgia'>".$row1['danhgia']." đánh giá</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    ";
                }
            echo "  </div>";
                ?>
                    <div id="phantrang">
                        <?php
                            if($tranghientai > 2){
                                $trangdau = 1;
                                ?>
                                    <a class="phantrang_item" href="noidung_loaisp.php?lsp=<?=$ma_loaiSP?>&page=<?=$trangdau?>">Đầu trang</a>
                                <?php
                            }
                            if($tranghientai > 1){
                                $trangtruoc = $tranghientai - 1;
                                ?>
                                    <a class="phantrang_item" href="noidung_loaisp.php?lsp=<?=$ma_loaiSP?>&page=<?=$trangtruoc?>"><<</a>
                                <?php
                            }
                            for($i = 1; $i <= $tongsotrang; $i++){
                                if($i != $tranghientai){
                                    if($i > $tranghientai - 2 && $i < $tranghientai + 2){
                                        ?>
                                            <a class="phantrang_item" href="noidung_loaisp.php?lsp=<?=$ma_loaiSP?>&page=<?=$i?>"><?=$i?></a>
                                        <?php
                                    }
                                }else{
                                    ?>
                                    <a class="phantrang_item tranghientai" href="noidung_loaisp.php?lsp=<?=$ma_loaiSP?>&page=<?=$i?>"><?=$i?></a>
                                    <?php
                                }
                            }
                            if($tranghientai < $tongsotrang - 1){
                                $trangtieptheo = $tranghientai+1;
                                ?>
                                    <a class="phantrang_item" href="noidung_loaisp.php?lsp=<?=$ma_loaiSP?>&page=<?=$trangtieptheo?>">>></a>
                                <?php
                            }
                            if($tranghientai < $tongsotrang - 2){
                                $trangcuoi = $tongsotrang;
                                ?>
                                    <a class="phantrang_item" href="noidung_loaisp.php?lsp=<?=$ma_loaiSP?>&page=<?=$trangcuoi?>">Cuối trang</a>
                                <?php
                            }
                        ?>
                    </div>
                <?php
            echo"
            </div>
            ";
        }else{
            echo "<h1>Hệ Thống Chưa Cập Nhật</h1>";
        }   
    ?>
    </div>
<?php
    include 'footer.php';
?>
    <script src="js/timkiemsp.js"></script>
</body>

</html>