<div id="tieude">
    <div id="tieude_cangiua">
        <div class="logo">
            <h2><a href="index.php"><img src="img/logo/logo.png" alt="" width="120px" height="50px" style="margin-top: 5px; margin-right: 20px;"></a></h2>
            <div id="danhsachhotrotuvan">
                <ul class="danhsach">
                    <li><a href=""><i class="fas fa-exclamation-triangle"></i>Giới thiệu</a></li>
                    <li><a href=""><i class="fas fa-wrench"></i>Bảo hàng</a></li>
                    <li><a href=""><i class="fas fa-phone-alt"></i>Liên hệ</a></li>
                </ul>
            </div>
        </div>
        <div class="timkiem">
        <input type="text" placeholder="Search.." name="search" onkeyup="timkiemsp(this.value)">
        <i class="fa fa-search"></i>
        <div id="find">
        </div>
        </div>
        <div class="taikhoan">
        <?php
            if(isset($_SESSION['user'])){
                include './connection/connection.php';
                $demsp = "SELECT COUNT(id_sp) as soluong FROM `giohang` WHERE id = '".$_SESSION['id']."' GROUP BY id";
                $result_sp = $con->query($demsp);
                $row_sp = $result_sp->fetch_assoc();
                echo "
                    <span>
                        <a href='giohang.php'>
                            <i class='fas fa-cart-plus'></i>
                            ";
                        if($result_sp->num_rows > 0){
                            echo "<p id='slgh'>".$row_sp['soluong']."</p>";
                        }
                    echo "</a>
                    </span>
                    <span><a href='dangxuat.php'>Đăng xuất</a></span>
                    <span><a href='thongtin_thanhvien.php'><img  src='img/".$_SESSION['path_anh_tv']."' alt='' width='30px' height='30px' style=' border-radius: 50%;'></a></span>
                    <span><a href='thongtin_thanhvien.php'>".$_SESSION['user']."</a></span>
                ";
            }else{
                echo "
                    <span><a href='form_dangnhap.php'>Đăng nhập</a></span>
                    <span><a href='form_dangky.php' id ='dangky'>Đăng ký</a></span>
                ";
            }
        ?>
        </div>
    </div>
    <!-- Menu của trang web -->
    <div id="menu">
        <ul>
            <ul>
                <?php
                    include './connection/connection.php';
                    $sql_showdanhmucsanpham = "SELECT * from loaisp";
                    $result_showdanhmucsanpham = $con->query($sql_showdanhmucsanpham);
                    while($row_showdanhmucsanpham = $result_showdanhmucsanpham->fetch_assoc()){
                        ?>
                            <li><a href="noidung_loaisp.php?lsp=<?php echo $row_showdanhmucsanpham['ma_loaisp']?>"><?php echo $row_showdanhmucsanpham['ten_loaisp']?></a></li>
                        <?php
                    }
                ?>
                <!-- <li><a href="noidung_loaisp.php?lsp=ĐT"><i class="fas fa-mobile-alt"></i>Điện Thoại</a></li>
                <li><a href="noidung_loaisp.php?lsp=LT"><i class="fas fa-laptop"></i>Laptop</a></li>
                <li><a href="noidung_loaisp.php?lsp=TB"><i class="fas fa-mobile-alt"></i></i>Tablet</a></li>
                <li><a href="noidung_loaisp.php?lsp=PK"><i class="fas fa-headphones"></i>Phụ Kiện</a></li>
                <li><a href="noidung_loaisp.php?lsp=ĐHTT"><i class="fas fa-mobile-alt"></i>Đồng hồ thời trang</a></li>
                <li><a href="noidung_loaisp.php?lsp=ĐHTM"><i class="fas fa-mobile-alt"></i>Đồng hồ thông minh</a></li> -->
            </ul>
        </ul>
    </div>
</div>
<script>
    function timkiemsp(str) {
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("find").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajax/timkiem_sp_input.php?tk=" + str, true);
    xmlhttp.send();
}
</script>