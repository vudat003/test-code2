<!DOCTYPE html>
<html lang="en">

<?php   
        session_start();
        include 'connection/connection.php';
        $ma_loaiSP = $_GET['lsp'];
        $_SESSION['lsp'] = $ma_loaiSP;
        $sql = "SELECT * from loaisp where ma_loaisp = '".$ma_loaiSP."'";
        $con->query($sql);
        $row = $con->query($sql)->fetch_assoc();
?>

<?php
    //lay id th tu URL de loc sp

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

        $echo_lsp = "";
        $echo_ma_th = "";
        $echo_gia = "";
        $echo_khuyenmai = "";
        $echo_sosao = "";
        $echo_sapxep = "";
        //Lay lsp tu ulr de loc sp;
        if(isset($_GET['lsp'])){
            $echo_lsp =  " and  sp.ma_loaisp = '".$_GET['lsp']."' ";
        }
        if(isset($_GET['ma_th'])){
            $ma_th = $_GET['ma_th'];    
            $_SESSION['ma_th'] = $ma_th;
            $sql_find_id_th = "SELECT id_th from thuonghieu where ma_th = '".$ma_th."' and ma_loaisp = '".$ma_loaiSP."'";
            $result_id_th = $con->query($sql_find_id_th);
            $row_id_th = $result_id_th->fetch_assoc();
            $echo_ma_th =  " and sp.id_th = '".$row_id_th['id_th']."' ";
            
        }
        if(isset($_GET['gia'])){
            $echo_daucuoi = explode('-', $_GET['gia']);
            $echo_dau = $echo_daucuoi[0];
            $echo_cuoi = $echo_daucuoi[1];
            if($echo_cuoi === '0'){
                $echo_gia = " and sp.gia_ban > '".$echo_dau."' ";
            }else{
                $echo_gia = " and sp.gia_ban between '".$echo_dau."' and '".$echo_cuoi."' ";
            }
        }else{
            $echo_gia = "";
        }

        if(isset($_GET['khuyenmai'])){
            if($_GET['khuyenmai'] === 'giamgia'){
                $echo_khuyenmai = " and sp.khuyenmai = 'Giảm giá' "; 
            }else if($_GET['khuyenmai'] === 'moiramat'){
                $echo_khuyenmai = " and sp.khuyenmai = 'Mới ra mắt' ";  
            }else if($_GET['khuyenmai'] === 'tragop'){
                $echo_khuyenmai = " and sp.khuyenmai = 'Trả góp' ";  
            }
        }else{
            $echo_khuyenmai = "";
        }

        if(isset($_GET['sosao'])){
            if($_GET['sosao'] === '2'){
                $echo_sosao = " and sp.sosao > 2";
            }else if($_GET['sosao'] === '3'){
                $echo_sosao = " and sp.sosao > 3";
            }else if($_GET['sosao'] === '4'){
                $echo_sosao = " and sp.sosao > 4";
            }
            $echo_sapxep = " order by sp.sosao ";
        }else{
            $echo_sosao = "";
        }

        if(isset($_GET['sapxep'])){
            if($_GET['sapxep'] === 'giatangdan'){
                $echo_sapxep = " order by sp.gia_ban ASC";
            }else if($_GET['sapxep'] === 'giatangdan'){
                $echo_sapxep = " order by sp.gia_ban DESC";
            }else if($_GET['sapxep'] === 'a-z'){
                $echo_sapxep = " order by sp.ten_sp ASC";
            }else if($_GET['sapxep'] === 'z-a'){
                $echo_sapxep = " order by sp.tensp ASC";
            }
        }else{
            $echo_sapxep = "";
        }

        $loaisp = "SELECT * from sanpham sp, loaisp lsp 
                    where sp.ma_loaisp = lsp.ma_loaisp  and sl_sp > 0 "
                    .$echo_lsp
                    .$echo_ma_th
                    .$echo_gia
                    .$echo_khuyenmai
                    .$echo_sosao
                    .$echo_sapxep
                    ;
        $result_lsp = $con->query($loaisp);
        if($result_lsp->num_rows > 0){
            echo "<div id='dienthoai'>
                        <div class='tieude'>
                            <h2><i class='fas fa-angle-double-right'></i>".$row['ten_loaisp']."</h2>
                            <a href='noidung_loaisp.php?lsp=".$row['ma_loaisp']."'>Xem tất cả <i class='fas fa-angle-double-right'></i></a>
                        </div>
                        <div class='danhsachsanpham'>";
            while($row1 = $result_lsp->fetch_assoc()){
                    $gia_goc = number_format($row1['gia_ban'], 0, '', ',');
                    $gia_giam = number_format($row1['gia_ban']-($row1['gia_ban']*0.05), 0, '', ',');
                    echo "
                        <div class='sanpham'>
                            <a href='chitietsanpham.php?idsp=".$row1['id_sp']."'>";
                        if($row1['khuyenmai'] == "Trả góp"){
                            echo "<p class='tragop'>Trả góp ".$row1['giatrikhuyenmai']."</p>";
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
                                        <p class='phantramgiam'>-5%</p>
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
            echo "  </div>
            </div>
            ";
        }else{
            echo "<h1>Không có sản phẩm bạn cần tìm :))</h1>";
        }
    ?>
    </div>
<?php
    include 'footer.php';
?>
    <script src="js/timkiemsp.js"></script>
</body>

</html>