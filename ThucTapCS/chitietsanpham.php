<?php
    session_start();
    include './connection/connection.php';
    $idsp = $_GET['idsp'];
    $_SESSION['idsp'] = $idsp;
    $sql = "SELECT * from sanpham sp, loaisp lsp where sp.id_sp = '".$idsp."' and sp.ma_loaisp = lsp.ma_loaisp ";
    $sql_ds = "SELECT * from sanpham sp, ds_img ds where sp.id_sp = '".$idsp."' and sp.id_sp = ds.id_sp ";
    $con->query($sql);
    $result = $con->query($sql_ds);
    $result1 = $con->query($sql_ds);
    $row = $con->query($sql)->fetch_assoc();
    $maloaisp = $row['ma_loaisp'];
    $tensp = $row['ten_sp'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['ten_sp']?></title> <link rel = "icon" href =  "img/logo/logo.png" 
    type = "image/x-icon"> 
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/tieude.css">
    <link rel="stylesheet" href="css/noidung.css">
    <link rel="stylesheet" href="css/chitietsp.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <!-- Font Awesome Icon Library -->
    <link rel="stylesheet" href="css/start.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
</head>

<body>
<?php
    include 'tieude.php';
?>
    <div id="noidung">
        <div id="chitietsanpham">
            <div class="img_main">
                <?php
                    if($row['ma_loaisp'] =='ĐT'){
                        $sql_img = "SELECT * from sanpham where ten_sp = '".$row['ten_sp']."'";
                        $result_img = $con->query($sql_img);
                        if($result_img->num_rows > 0){
                            while($row_img = $result_img->fetch_assoc()){
                                ?>
                                    <div class="img_list">
                                        <img src="./img/<?php echo $row_img['img_sp']?>" alt="" style="width:100%">  
                                    </div>
                                <?php
                            }
                        }
                    }else{
                        if($result->num_rows > 0){
                            while($row_ds = $result->fetch_assoc()){
                                ?>
                                    <div class="img_list">
                                        <img src="./img/<?php echo $row_ds['img']?>" alt="" style="width:100%">  
                                    </div>
                                <?php
                            }
                        }else{
                            ?>
                                <div class="img_list">
                                    <img src="./img/<?php echo $row['img_sp']?>" alt="" style="width:100%">  
                                </div>
                            <?php
                        }
                    }
                ?>
                <a class="prev" onclick="plusSlides(-1)">❮</a>
                <a class="next" onclick="plusSlides(1)">❯</a>
                <div class="row">
                    <?php
                        $i = 0;
                        if($row['ma_loaisp'] == 'ĐT'){
                            $sql_img = "SELECT * from sanpham where ten_sp = '".$row['ten_sp']."'";
                            $result_img = $con->query($sql_img);
                            if($result_img->num_rows > 0){
                                while($row_img = $result_img->fetch_assoc()){
                                    ++$i;
                                    ?>
                                        <div class="column">
                                            <img class="demo cursor" src="./img/<?php echo $row_img['img_sp']?>" style="width:100%" onclick="currentSlide(<?php echo $i;?>)" alt="The Woods">
                                            <p><?php echo $row_img['mausac']?></p>
                                        </div>
                                    <?php
                                }
                            }
                        }else{
                            $i = 0;
                            if($result1->num_rows > 0){
                                while($row_ds = $result1->fetch_assoc()){
                                    ++$i;
                                    ?>
                                        <div class="column">
                                            <img class="demo cursor" src="./img/<?php echo $row_ds['img']?>" style="width:100%" onclick="currentSlide(<?php echo $i;?>)" alt="The Woods">
                                            <p><?php echo $row_ds['mau']?></p>
                                        </div>
                                    <?php
                                }
                            }else{
                                echo "";
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="noidungsp">
                <h2><?php echo $row['ten_sp']?></h2>
                <h3>Thông số kỉ thuật</h3>
                <?php
                    $sql_tskt = "SELECT * from thongsokithuat where id_sp = '".$idsp."'";
                    $result_tskt = $con->query($sql_tskt);
                    if($result_tskt->num_rows > 0){
                        while($row_tskt = $result_tskt->fetch_assoc()){
                            if($row_tskt['ma_loaisp'] == 'ĐT'){
                                //Thonh tin ki thuat so Điện thoại
                                ?>
                                    <table>
                                        <tr>
                                            <td>Màn hình:</td>
                                            <td><?php echo $row_tskt['manhinh'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Hệ điều hành:</td>
                                            <td><?php echo $row_tskt['hedieuhanh'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Camera sau:</td>
                                            <td><?php echo $row_tskt['camera_sau'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Camera trước:</td>
                                            <td><?php echo $row_tskt['camera_truoc'];?></td>
                                        </tr>
                                        <tr>
                                            <td>CPU:</td>
                                            <td><?php echo $row_tskt['cpu'];?></td>
                                        </tr>
                                        <tr>
                                            <td>RAM:</td>
                                            <td><?php echo $row_tskt['ram'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Bộ nhớ trong:</td>
                                            <td><?php echo $row_tskt['bonhotrong'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Sim:</td>
                                            <td><?php echo $row_tskt['sim'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Dung lượng pin:</td>
                                            <td><?php echo $row_tskt['dungluongpin'];?></td>
                                        </tr>
                                    </table>
                                <?php
                            }else if($row_tskt['ma_loaisp'] == 'ĐHTM'){
                                //Thonh tin ki thuat so Đồng hồ thông minh
                                ?>
                                    <table>
                                        <tr>
                                            <td>Công nghệ màn hình: </td>
                                            <td><?php echo $row_tskt['congnghemanhinh'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Kích thước màn hình: </td>
                                            <td><?php echo $row_tskt['kichthuocmanhinh'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Thời gian sử dung pin: </td>
                                            <td><?php echo $row_tskt['thoigiansudungpin'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Hệ điều hành:</td>
                                            <td><?php echo $row_tskt['hedieuhanh'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Kết nối với hệ diều hành:</td>
                                            <td><?php echo $row_tskt['ketnoivoihedieuhanh'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Chất liệu mặt:</td>
                                            <td><?php echo $row_tskt['chatlieumat'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Đường kính mặt:</td>
                                            <td><?php echo $row_tskt['duongkinhmat'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Kết nối:</td>
                                            <td><?php echo $row_tskt['ketnoi'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Ngôn ngữ: </td>
                                            <td><?php echo $row_tskt['ngonngu'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Theo dõi sức khỏe: </td>
                                            <td width="300px"><?php echo $row_tskt['theodoisuckhoe'];?></td>
                                        </tr>
                                    </table>
                                <?php

                            }else if($row_tskt['ma_loaisp'] == 'LT'){
                                //Thonh tin ki thuat so Laptop
                                ?>
                                    <table>
                                        <tr>
                                            <td>CPU: </td>
                                            <td><?php echo $row_tskt['cpu'];?></td>
                                        </tr>
                                        <tr>
                                            <td>RAM: </td>
                                            <td><?php echo $row_tskt['ram'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Ổ cứng: </td>
                                            <td><?php echo $row_tskt['o_cung'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Màn hình:</td>
                                            <td><?php echo $row_tskt['manhinh'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Card màn hình:</td>
                                            <td><?php echo $row_tskt['card_manhinh'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Cổng kết nối:</td>
                                            <td><?php echo $row_tskt['congketnoi'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Hệ điều hành:</td>
                                            <td><?php echo $row_tskt['hedieuhanh'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Thiết kế:</td>
                                            <td><?php echo $row_tskt['thietke'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Kích thước: </td>
                                            <td><?php echo $row_tskt['kichthuoc'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Thời điểm ra mắt: </td>
                                            <td><?php echo $row_tskt['thoidiemramat'];?></td>
                                        </tr>
                                    </table>
                                <?php
                            }else if($row_tskt['ma_loaisp'] == 'MTB'){
                                //Thonh tin ki thuat so máy tính bảng
                                ?>
                                    <table>
                                        <tr>
                                            <td>Màn hình:</td>
                                            <td><?php echo $row_tskt['manhinh'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Hệ điều hành: </td>
                                            <td><?php echo $row_tskt['hedieuhanh'];?></td>
                                        </tr>
                                        <tr>
                                            <td>CPU: </td>
                                            <td><?php echo $row_tskt['cpu'];?></td>
                                        </tr>
                                        <tr>
                                            <td>RAM:</td>
                                            <td><?php echo $row_tskt['ram'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Bộ nhớ trong:</td>
                                            <td><?php echo $row_tskt['bonhotrong'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Camera sau:</td>
                                            <td><?php echo $row_tskt['camera_sau'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Camera trước:</td>
                                            <td><?php echo $row_tskt['camera trước'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Kết nối mạng:</td>
                                            <td><?php echo $row_tskt['ketnoimang'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Hộ trợ sim: </td>
                                            <td><?php echo $row_tskt['hotrosim'];?></td>
                                        </tr>
                                    </table>
                                <?php
                            }else{

                            }
                        }
                    }else{
                        echo "";
                    }
                ?>
                <div class="giasp">
                    <h3>Giá:</h3>
                    <h2><?php 
                    $gia_fm = number_format($row['gia_ban'], 0, '', ',');
                    echo $gia_fm?><u>đ</u>
                    </h2>
                    <?php
                        if($row['giatrikhuyenmai'] != 0){
                            ?><span>Giảm giá: -<?php echo  number_format($row['giatrikhuyenmai'], 0, '', ',') ?> đ</span><?php
                        }else if($row['khuyenmai'] == 'Không'){
                        }else if($row['khuyenmai'] == 'Trả góp'){
                            ?><span><?php echo $row['khuyenmai']?>: 0%</span><?php
                        }else{
                            ?><span><?php echo $row['khuyenmai']?></span><?php
                        }
                    ?>
                </div>
                <form action="xuly_giohang.php" method="POST" enctype="multipart/form-data" onsubmit="return ktsession();">
                <div id="mau_dienthoai">
                <?php
                    if($maloaisp == 'ĐT'){
                        $sql_select_mausac = "SELECT * from sanpham where ten_sp = '".$tensp."'";
                        $result_select_mausac = $con->query($sql_select_mausac);
                        if($result_select_mausac->num_rows > 1){
                            while($row_select_mausac = $result_select_mausac->fetch_assoc()){
                                ?>                
                                    <div class="mau">
                                        <input type="radio" value="<?= $row_select_mausac['id_sp']?>" name="mausac">
                                        <p><?= $row_select_mausac['mausac']?></p>
                                    </div>
                                <?php
                            }
                        }
                    }
                ?>
                </div>
                <div class="mua_giohang">
                    <input type="submit" value="Mua Ngay"></input>
                    <input type="submit" value="Thêm vào giỏ hàng"></input>
                </div>
                </form>
            </div>
        </div>
        <?php
            //Tính tổng số đã bình luận trong 1 sản phẩm
            $sql_tongsodanhgia = "SELECT COUNT(id_bl) as tongbl FROM danhgiasp WHERE id_sp = $idsp";
            $result_tongsodanhgia = $con->query($sql_tongsodanhgia);
            $row_tongsodanhgia = $result_tongsodanhgia->fetch_assoc();
            //Tính trung bình số sao đã bình luận trong một sản phẩm
            $sql_trungbinhsosao = "SELECT  round(AVG(sosao),1) as trungbinhsosao FROM danhgiasp WHERE id_sp = $idsp";
            $result_trungbinhsosao = $con->query($sql_trungbinhsosao);
            $row_trungbinhsosao = $result_trungbinhsosao->fetch_assoc();
            //Cập nhật lại số sao trong bình luận
            $sql_capnhatsosao_danhgia = "UPDATE sanpham SET sosao = ". $row_trungbinhsosao['trungbinhsosao'].", danhgia = " . $row_tongsodanhgia['tongbl']
                            ." where id_sp = ". $idsp;
            $con->query($sql_capnhatsosao_danhgia)
        ?>
        <div class="xemdanhgiasanpham">
            <div class="sodanhgia_timdanhgia">
                <div class="sodanhgia">
                    <h3 class="sodanhgia"><?php echo $row_tongsodanhgia['tongbl'] ?> đánh giá cho sản phẩm</h3>
                </div>
                <div class="timdanhgia">
                    <i class="fa fa-search"></i>
                    <input type="text" name="timnoidungdanhgia" placeholder="Tìm nội dung dánh giá">
                </div>
            </div>
            <div class="tonghopdanhgia">
                <div class="phantramsao">
                    <p><?php echo $row_trungbinhsosao['trungbinhsosao'] ?><i class="fas fa-star"></i></p>
                </div>
                <div class="chitietsao">
                <?php
                     //Tính từng số sao trong từng sản phẩm
                    $sql_tinhtungsosao = "SELECT sosao, COUNT(sosao) as solan FROM danhgiasp WHERE id_sp= $idsp  
                                            GROUP BY sosao ORDER BY `danhgiasp`.`sosao`  DESC";
                    $result_tinhtungsosao = $con->query($sql_tinhtungsosao);
                    while($row_tinhtungsosao = $result_tinhtungsosao->fetch_assoc()){
                        ?>  
                            <div class="sosao_thongke_sodanhgia">
                                <div class="sosao">
                                    <p><?php echo $row_tinhtungsosao['sosao']?><i class="fas fa-star"></i></p>
                                </div>
                                <div class="thongke">
                                </div>
                                <div class="sodanhgia">
                                    <a href=""><?php echo $row_tinhtungsosao['solan']?> đánh giá</a>
                                </div>
                            </div>
                        <?php
                    }       
                ?>
                </div>
                <div class="bnt_danhgia">
                    <?php
                        if(isset($_SESSION['user'])){
                            ?>
                                <button onclick="show_danhgia()" >Gửi đánh giá của bạn</button>
                            <?php
                        }
                    ?>
                </div>
            </div>
            <?php
                if(isset($_SESSION['user'])){
                    ?>
                        <div id="khachhang_danhgia">
                            <form action="xuly_danhgiasanpham.php" method="POST" enctype="multipart/form-data" onsubmit="return  danhgiasp()">
                                <div class="danhgiasao">
                                    <h4>Chọn đánh giá của bạn:</h4>
                                    <div class="start">
                                            <input class="star star-5" id="star-5" type="radio" name="star" value="5" />
                                            <label class="star star-5" for="star-5"></label>
                                            <input class="star star-4" id="star-4" type="radio" name="star" value="4" />
                                            <label class="star star-4" for="star-4"></label>
                                            <input class="star star-3" id="star-3" type="radio" name="star" value="3" />
                                            <label class="star star-3" for="star-3"></label>
                                            <input class="star star-2" id="star-2" type="radio" name="star" value="2" />
                                            <label class="star star-2" for="star-2"></label>
                                            <input class="star star-1" id="star-1" type="radio" name="star" value="1" />
                                            <label class="star star-1" for="star-1"></label>
                                    </div>
                                </div>
                                <div class="danhgia_all">
                                    <div class="comment_and_anh">
                                        <textarea name="noidungcmt" id="" cols="70" rows="5" placeholder="Nhập nội dụng đánh giá sản phẩm"></textarea>
                                        <div class="input_anh">
                                            <label for="files" class="btn"><i class="fas fa-camera-retro"></i>Chọn ảnh đánh giá sản phẩm</label>
                                            <input id="files" style="visibility:hidden;" type="file" name="anh_cmt">
                                        </div>
                                    </div>
                                    <div class="tt_khach_comment">
                                        <div class="hoten_sdt">
                                            <input type="text" name="hoten_danhgia" id="hoten" placeholder="Họ tên">
                                            <input type="text" name="sodienthoai_danhgia" id="sdt" placeholder="Số điện thoại">
                                        </div>
                                        <div class="email_bnt">
                                            <input type="text" name="email_danhgia" id="email" placeholder="Email">
                                            <input type="submit" value="Gửi đánh giá">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php
                }
            ?>
        <div id="comment_main">
            <?php
                //Lấy thông tin nội dung ảnh cmt
                $sql_laythongtincmt = "SELECT * FROM danhgiasp WHERE id_sp = $idsp ORDER BY sosao DESC";
                $result_laythongtincmt = $con->query($sql_laythongtincmt);
                while($row_laythongtincmt = $result_laythongtincmt->fetch_assoc()){
                    ?>
                        <div class="comment_item">
                            <div class="name_buyed">
                                <div class="name"><?php echo $row_laythongtincmt['hoten_cmt']?></div>
                                <div class="buyed"><i class="fas fa-check-circle"></i>Đã mua hàng tại T&T_IT.com</div>
                            </div>
                            <div class="start">
                                <?php
                                    for($i = 1; $i <= $row_laythongtincmt['sosao']; $i++){
                                        echo "<i class='fas fa-star'></i>";
                                    }
                                ?>
                            </div>
                            <div class="content_comment">
                                <p><?php echo $row_laythongtincmt['noidungdanhgia']?></p>                
                            </div>
                            <?php
                                if($row_laythongtincmt['img_cmt'] != ""){
                                    ?>
                                        <div class="img_cmt">
                                            <?php
                                                echo "<img src='./img/".$row_laythongtincmt['img_cmt']."' alt=''>";
                                            ?>
                                        </div>
                                    <?php
                                }
                            ?>

                            <div class="time_day">
                                <p><?php echo $row_laythongtincmt['ngaydanhgia']?></p>
                            </div>
                        </div>
                    <?php
                }
            ?>
        </div>
        </div>
        <?php
            $loaisp = "SELECT * from sanpham sp, loaisp lsp 
                        where sp.ma_loaisp = '".$row['ma_loaisp']."' and sp.ma_loaisp = lsp.ma_loaisp
                        order by sp.id_sp DESC limit 0, 10            ";
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
                                echo "<p class='khong'></p>";
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
                echo "  </div>
                </div>
                ";
            }else{
                echo "Không có sản phẩm";
            }
        ?>
    </div>
    <?php
        include 'footer.php';
    ?>
    <script src="js/ktsesstion.js"></script>
    <script src="js/kiemtradanhgiasp.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("img_list");
            var dots = document.getElementsByClassName("demo");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
        }
        function show_danhgia(){
            document.getElementById('khachhang_danhgia').style.display = 'block';
        }
    </script>
</body>

</html>
