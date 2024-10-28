<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel = "icon" href =  
    "img/logo/logo.png" 
    type = "image/x-icon"> 
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/tieude.css">
    <link rel="stylesheet" href="css/noidung.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/form_dangky.css">
    <link rel="stylesheet" href="css/giohang.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>

<body>
    <?php
        session_start();
        include 'tieude.php';
    ?>
    <!-- Nội dung của trang web -->
    <div id="noidung">
        <div id="dienthoai">
            <div id="bang">
            <?php
                if(isset($_SESSION['id'])){
                    include 'connection/connection.php';
                    $sql = "SELECT * FROM sanpham sp, giohang gh, thanhvien tv
                    WHERE sp.id_sp = gh.id_sp and tv.id = gh.id and gh.id = ".$_SESSION['id']."";
                    $result_gh = $con->query($sql);
                    $i = 0;
                    if($result_gh->num_rows > 0 && $_SESSION['id']){
                        echo "<form action='xuly_muahang.php' method='POST' enctype='multipart/form-data' onsubmit='return thanhtoan()' >
                        <div id='bang_sp'>
                            <h1>Wellcome to carts</h1>";
                        echo "<table border='1'>";
                        while($row_gh = $result_gh->fetch_assoc()){
                                echo "
                                <tr>
                                    <td rowspan='2'>".++ $i."</td>
                                    <td rowspan='2'><img src='./img/".$row_gh['img_sp']."' alt='' width='120px' height='90px'></td>
                                    <td colspan='6' class='tensp'>".$row_gh['ten_sp']."</td>
                                </tr>
                                <tr>
                                    <td class='giasp'>ĐG: ".number_format($row_gh['gia_ban'], 0, '', ',')." Đ</td>
                                    <td>
                                        <div class='buttons_added'>
                                            <input class='minus is-form' type='button' value='-' onclick='congtru(-1, ".$row_gh['id_sp']."); soluonggiohang(".$row_gh['id_sp'].")'>
                                            <input type='number'  id='".$row_gh['id_sp']."' class='input-qty' min='1' max='20' value='".$row_gh['soluong']."'>
                                            <input class='plus is-form' type='button' value='+' onclick='congtru(1, ".$row_gh['id_sp']."); soluonggiohang(".$row_gh['id_sp'].")'>
                                        </div>
                                    </td>";
                                    ?>
                                        <td width="230px">KM: <?php echo number_format($row_gh['giatrikhuyenmai']*$row_gh['soluong'], 0, '', ',')?> Đ</td>
                                    <?php
                                    echo "
                                    <td class='giasp'>".number_format(($row_gh['gia_ban']*$row_gh['soluong']) - ($row_gh['giatrikhuyenmai']*$row_gh['soluong']), 0, '', ',')." Đ</td>";
                                    if($row_gh['trangthai'] == 1){
                                        echo "<td><input id='".$row_gh['id_sp']."_mua' type='checkbox' value='1' onclick='checkmua(".$row_gh['id_sp'].")' checked></td>";
                                    }else{
                                        echo "<td><input id='".$row_gh['id_sp']."_mua' type='checkbox' value='0' onclick='checkmua(".$row_gh['id_sp'].")'></td>";
                                    }
                                    echo "
                                    <td><a href='xoa_sp_giohang.php?id=".$row_gh['id_gh']."'><img src='img/delete.png' alt='' width='20px' height='20px'></a></td>
                                </tr>
                                ";
                        }
                        $sql = "SELECT SUM(sp.gia_ban*gh.soluong - (gh.soluong*sp.giatrikhuyenmai)) as TT FROM sanpham sp, giohang gh, thanhvien tv
                            WHERE sp.id_sp = gh.id_sp and tv.id = gh.id and gh.id = ".$_SESSION['id']."";
                        $result_tt = $con->query($sql);
                        if($result_tt->num_rows > 0){
                            while($rowtt = $result_tt->fetch_assoc()){
                                echo "
                                    <tr id='tongtien'>
                                        <td colspan='4'></td>
                                        <td>Tổng tiền:</td>
                                        <td>".number_format($rowtt['TT'], 0, '', ',').' Đ'."</td>
                                    </tr>
                                ";
                            }
                        }

                        $sql = "SELECT * FROM sanpham sp, giohang gh, thanhvien tv
                        WHERE sp.id_sp = gh.id_sp and tv.id = gh.id and trangthai = 1 and gh.id = ".$_SESSION['id']."";
                        $result_tt = $con->query($sql);
                        $i = 0;
                        $tt = 0;
                        if($result_tt->num_rows > 0 && $_SESSION['id']){
                            while($row_tt = $result_tt->fetch_assoc()){
                                $tt = $tt + ($row_tt['gia_ban']*$row_tt['soluong'] - $row_tt['soluong']*$row_tt['giatrikhuyenmai']);
                            }
                        }
                        $_SESSION['tongtien'] = $tt;
                        echo " </table>";
            echo "</div>";
            $sql_kh ="SELECT * from thanhvien where id = ".$_SESSION['id']."";
            $result_kh = $con->query($sql_kh);
            if($result_kh->num_rows){
                while($row_kh = $result_kh->fetch_assoc()){
                    echo "<div id='ttkh'>
                            <h3>Thông tin khách hàng</h3>
                            <span>Họ Tên:</span><br>
                            <input type='text' name='name_cus' value='".$row_kh['hoten_tv']."'><br>
                            <span>Số ĐT:</span><br>
                            <input type='text' name='phone' value='".$row_kh['sdt']."'><br>";
                    ?>
                            <h5 class="diachigiao">Địa chỉ giao hàng</h5>
                            <label>Tỉnh/TP</label>
                            <select name="tinh_tp" id="" onchange="show_quanhuyen(this.value);">
                                <?php
                                    $sql_tinhtp = "SELECT * FROM `province`";
                                    $result_tinhtp = $con->query($sql_tinhtp);
                                    if($result_tinhtp->num_rows > 0){
                                        while($row_tinhtp = $result_tinhtp->fetch_assoc()){
                                            ?><option value="<?php echo $row_tinhtp['id'] ?>"><?php echo $row_tinhtp['_name'] ?></option><?php          
                                        }
                                    }
                                ?>
                            </select>
                            <label>Quận/Huyện</label>
                            <select name="quan_huyen" id="quan_huyen" onchange="show_xaphuong(this.value);">
                                <?php
                                    $sql_quanhuyen = "SELECT * FROM `district`";
                                    $result_quanhuyen = $con->query($sql_quanhuyen);
                                    if($result_quanhuyen->num_rows > 0){
                                        while($row_quanhuyen = $result_quanhuyen->fetch_assoc()){
                                            ?><option value="<?php echo $row_quanhuyen['id'] ?>"><?php echo $row_quanhuyen['_name'] ?></option><?php          
                                        }
                                    }
                                ?>
                            </select>
                            <label>Xã/Phường</label>
                            <select name="xa_phuong" id="xa_phuong">
                                <?php
                                    $sql_xaphuong = "SELECT * FROM `ward`";
                                    $result_xaphuong = $con->query($sql_xaphuong);
                                    if($result_xaphuong->num_rows > 0){
                                        while($row_xaphuong = $result_xaphuong->fetch_assoc()){
                                            ?><option value="<?php echo $row_xaphuong['id'] ?>"><?php echo $row_xaphuong['_name'] ?></option><?php          
                                        }
                                    }
                                ?>
                            </select>
                            <span>Số nhà - đường</span><br>
                            <textarea name='sonha' id='' cols='25' rows='5'></textarea>
                    <?php
                    echo "   <span>Ghi chú:</span><br>
                            <textarea name='ghichu' id='' cols='25' rows='10'></textarea>
                            <p id='tamtinh'>Tạm tính: ".number_format($tt, 0, '', ',')." Đ</p>
                            <input type='submit' value='Thanh Toán'>
                        </div>";   
                }
            }else{
                echo "<div id='ttkh'>
                    <h3>Thông tin khách hàng</h3>
                    <span>Họ Tên:</span><br>
                    <input type='text' name='name_cus'><br>
                    <span>Số ĐT:</span><br>
                    <input type='text' name='phone'><br>
                    <span>Địa chỉ giao:</span><br>
                    <textarea name='diachi' id='' cols='25' rows='10'></textarea>
                    <span>Ghi chứ:</span><br>
                    <textarea name='ghichu' id='' cols='25' rows='10'></textarea>
                    <p id='tamtinh'>Tạm tính: ".number_format($tt, 0, '', ',')." Đ</p>
                    <input type='submit' value='Thanh Toán'>
                </div>";
            }
                echo "</form>";
                    }else{
                        echo "<h1>Bạn chưa có sản phẩm nào trong giỏ Tiếp tục mua sắm!</h1>";
                    }
                }else{
                    echo "<h1>Bạn chưa có sản phẩm nào trong giỏ Tiếp tục mua sắm!</h1>";
                }
            ?>
            </div>
        </div>
    </div>
    <?php
        include 'footer.php';
    ?>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <script src="js/button_soluong.js"></script>
    <script src="js/kt_sl_sp.js"></script>
    
    <script>
        function soluonggiohang(idsp) {
            var so = document.getElementById(idsp).value;
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("bang").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "ajax/soluonggiohang.php?tk=" + so + "/" + idsp, true);
            xmlhttp.send();
        }

        function checkmua(idsp) {
            var so = document.getElementById(idsp + "_mua").value;
            if (so == 0) {
                so = 1;
            } else {
                so = 0;
            }
            document.getElementById(idsp + "_mua").value = so;

            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("tamtinh").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "ajax/checksp.php?tk=" + so + "/" + idsp, true);
            xmlhttp.send();
        }
        function show_quanhuyen(id_tinh) {
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("quan_huyen").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "ajax/show_quanhuyen.php?id="+id_tinh, true);
            xmlhttp.send();
        }
        function show_xaphuong(id_huyen) {
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("xa_phuong").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "ajax/show_xaphuong.php?id="+id_huyen, true);
            xmlhttp.send();
        }
    </script>
</body>
    
</html>