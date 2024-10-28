<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link rel = "icon" href =  
    "../img/logo/logo_in.png" 
    type = "image/x-icon"> 
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/them_lsp_th_sp.css">
    <link rel="stylesheet" href="../css/danhsach_lsp_th_sp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>
<style>
    #giatrikhuyenmai{
        display: none;
    }
</style>
<body>
    <?php
        session_start();
        include 'tieude.php';
    ?>
    <div id="content">x
        <?php
            include 'menu_trai.php';
        ?>
        <div id="noidungchinh">
        <h2>Thêm sản phẩm</h2>
            <div id="themloaisp">
                <form action="xuly_them_sp.php" method="POST" enctype="multipart/form-data" onsubmit="return KiemtraForm_ThemSP()">
                    <table>
                        <tr>
                            <td>Tên loại sản phẩm: </td>
                            <td>
                                <select name="maloaisp" onchange="thuonghieu(this.value); showTSKT(this.value);">
                                    <?php
                                        include '../connection/connection.php';
                                        $sql = "SELECT * from loaisp";
                                        $result = $con->query($sql);
                                        if($result->num_rows > 0){
                                            while($row = $result->fetch_assoc()){
                                                $ma_loaisp = $row['ma_loaisp'];
                                                echo " <option value='".$row['ma_loaisp']."'>".$row['ten_loaisp']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Tên thương hiệu: </td>
                            <td>
                                <select name="idth" id="showthuonghieu">
                                    <?php
                                        $sql = "SELECT * from thuonghieu where ma_loaisp = '".$ma_loaisp."'";
                                        $result = $con->query($sql);
                                        if($result->num_rows > 0){
                                            while($row = $result->fetch_assoc()){
                                                echo " <option value='".$row['id_th']."'>".$row['ten_tenth']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </td>                    
                        </tr>
                        <tr>
                            <td>Tên sản phẩm: </td>
                            <td><input type="text" name="tensp" id="tensp" placeholder="Tên thương hiệu"></td>
                        </tr>
                        <tr>
                            <td>Giá sản phẩm: </td>
                            <td><input type="text" name="gia_sp" id="gia_sp" placeholder="Giá sản phẩm" onkeyup="giasp(this.value)"></td>
                        </tr>
                        <tr>
                            <td>Định dạng giá: </td>
                            <td><p id="gia">0 VND</p></td>
                        </tr>
                        <tr>
                            <td>Giá bán: </td>
                            <td><input type="text" name="gia_ban" id="gia_ban" placeholder="Giá bán" onkeyup="giasp_ban(this.value)"></td>
                        </tr>
                        <tr>
                            <td>Định dạng giá bán: </td>
                            <td><p id="gia_ban">0 VND</p></td>
                        </tr>
                        <tr>
                            <td>Hình ảnh SP:</td>
                            <td><input type="file" name="logo" id="img_sp" placeholder="Logo">
                                <br>
                                <span id="error_img_sp" style="color: red;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Số lượng:</td>
                            <td><input type="text" name="sl" id="sl_sp" placeholder="Nhập số lượng"></td>
                        </tr>
                        <tr>
                            <td>Màu sắc:</td>
                            <td><input type="text" name="mausac" id="mausac" placeholder=""></td>
                        </tr>
                        <tr>
                            <td>Khuyến mãi:</td>
                            <td>
                                <select name="khuyenmai" id="khuyenmai" onclick="giamgia(this.value)">
                                    <option value="Không">Không</option>
                                    <option value="Trả góp">Trả góp</option>
                                    <option value="Giảm giá">Giảm giá</option>
                                    <option value="Mới ra mắt">Mới ra măt</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Giá trị khuyến mãi</td>
                            <td><input type="text" name="giatrikhuyenmai" id="giatrikhuyenmai" placeholder=""></td>
                        </tr>
                        <tbody id="dienthoai">
                            <tr>
                                <td>Màn hình:</td>
                                <td><input type="text" name="DT_manhinh" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Hệ điều hành:</td>
                                <td><input type="text" name="DT_hedieuhanh" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Camera sau:</td>
                                <td><input type="text" name="DT_camerasau" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Camera trước:</td>
                                <td><input type="text" name="DT_cameratruoc" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>CPU:</td>
                                <td><input type="text" name="DT_cpu" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>RAM:</td>
                                <td><input type="text" name="DT_ram" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Bộ nhớ trong:</td>
                                <td><input type="text" name="DT_bonhotrong" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Sim:</td>
                                <td><input type="text" name="DT_sim" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Dung lượng pin:</td>
                                <td><input type="text" name="DT_dungluongpin" placeholder=""></td>
                            </tr>
                        </tbody>
                        <tbody id="donghothongminh">
                            <tr>
                                <td>Công nghệ màn hình: </td>
                                <td><input type="text" name="DHTM_congnghemanhinh"></td>
                            </tr>
                            <tr>
                                <td>Kích thước màn hình: </td>
                                <td><input type="text" name="DHTM_kichthuocmanhinh"></td>
                            </tr>
                            <tr>
                                <td>Thời gian sử dung pin: </td>
                                <td><input type="text" name="DHTM_thoigiansudungpin"></td>
                            </tr>
                            <tr>
                                <td>Hệ điều hành:</td>
                                <td><input type="text" name="DHTM_hedieuhanh"></td>
                            </tr>
                            <tr>
                                <td>Kết nối với HĐH:</td>
                                <td><input type="text" name="DHTM_ketnoivoihedieuhanh"></td>
                            </tr>
                            <tr>
                                <td>Chất liệu mặt:</td>
                                <td><input type="text" name="DHTM_chatlieumat"></td>
                            </tr>
                            <tr>
                                <td>Đường kính mặt:</td>
                                <td><input type="text" name="DHTM_duongkinhmat"></td>
                            </tr>
                            <tr>
                                <td>Kết nối:</td>
                                <td><input type="text" name="DHTM_ketnoi"></td>
                            </tr>
                            <tr>
                                <td>Ngôn ngữ: </td>
                                <td><input type="text" name="DHTM_ngonngu"></td>
                            </tr>
                            <tr>
                                <td>Theo dõi sức khỏe: </td>
                                <td><input type="text" name="DHTM_theodoisuckhoe"></td>
                            </tr>
                        </tbody>
                        <tbody id="laptop">
                            <tr>
                                <td>CPU: </td>
                                <td><input type="text" name="LT_cpu" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>RAM: </td>
                                <td><input type="text" name="LT_ram" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Ổ cứng: </td>
                                <td><input type="text" name="LT_ocung" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Màn hình:</td>
                                <td><input type="text" name="LT_manhinh" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Card màn hình:</td>
                                <td><input type="text" name="LT_cardmanhinh" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Cổng kết nối:</td>
                                <td><input type="text" name="LT_congketnoi" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Hệ điều hành:</td>
                                <td><input type="text" name="LT_hedieuhanh" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Thiết kế:</td>
                                <td><input type="text" name="LT_thietke" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Kích thước: </td>
                                <td><input type="text" name="LT_kichthuoc" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Thời điểm ra mắt: </td>
                                <td><input type="text" name="LT_thoidiemramat" placeholder=""></td>
                            </tr>
                        </tbody>
                        <tbody id="maytinhbang">
                            <tr>
                                <td>Màn hình:</td>
                                <td><input type="text" name="MTB_manhinh" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Hệ điều hành: </td>
                                <td><input type="text" name="MTB_hedieuhanh" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>CPU: </td>
                                <td><input type="text" name="MTB_cpu" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>RAM:</td>
                                <td><input type="text" name="MTB_ram" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Bộ nhớ trong:</td>
                                <td><input type="text" name="MTB_bonhotrong" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Camera sau:</td>
                                <td><input type="text" name="MTB_camerasau" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Camera trước:</td>
                                <td><input type="text" name="MTB_cameratruoc" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Kết nối mạng:</td>
                                <td><input type="text" name="MTB_ketnoimang" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Hộ trợ sim: </td>
                                <td><input type="text" name="MTB_hotrosim" placeholder=""></td>
                            </tr>
                        </tbody>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Thêm">
                                <input type="reset" value="Reset">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <hr>
            <div id="danhsach">
            <h2>Danh sách loại sản phẩm</h2>
                <table border="1">
                <tr>
                    <th rowspan="2">STT</th>
                    <th rowspan="2">id_sp</th>
                    <th rowspan="2" >Tên sản phẩm</th>
                    <th rowspan="2">Ảnh sản phẩm</th>
                    <th rowspan="2">Màu sắc</th>
                    <th rowspan="2">Giá</th>
                    <th rowspan="2">SL</th>
                    <th rowspan="2">Khuyến mãi</th>
                    <th rowspan="2">Giá trị khuyến mãi</th>
                    <th colspan="2">Cập nhật</th>

                </tr>
                <tr>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            <?php

                $sql = "SELECT * FROM sanpham  ORDER BY id_sp DESC  LIMIT 1";
                $result = $con->query($sql);
                $i = 0;
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "
                        <tr>
                            <td>".($i = $i + 1)."</td>
                            <td>".$row['id_sp']."</td>
                            <td>".$row['ten_sp']."</td>
                            <td><img src='../img/".$row['img_sp']."' alt='' width=100px height=100px></td>
                            <td>".$row['mausac']."</td>
                            <td>".number_format($row['gia_sp'], 0, '', ',')."</td>
                            <td>".$row['sl_sp']."</td>
                            <td>".$row['khuyenmai']."</td>
                            <td>".number_format($row['giatrikhuyenmai'], 0, '', ',')."</td>";

                        echo "
                            <td><a href='./sua_sp.php?id=".$row['id_sp']."'><img src='../img/edit.png' alt=''></a></td>
                            <td><a href='./xoa_sp.php?id=".$row['id_sp']."'><img src='../img/delete.png' alt=''></a></td>";
                        echo "
                            </tr>
                        ";
                    }
                }
            ?>
                </table>
            </div>
        </div>
    </div>

    <script>
        function thuonghieu(str) {
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    document.getElementById("showthuonghieu").innerHTML=xmlhttp.responseText; 
                } 
            }   
            xmlhttp.open("GET", "../ajax/showthuonghieu.php?id="+str, true);
            xmlhttp.send();
        }

        function giasp(str) {
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    document.getElementById("gia").innerHTML=xmlhttp.responseText; 
                } 
            }   
            xmlhttp.open("GET", "../ajax/fomatGia.php?gia=" + str, true);
            xmlhttp.send();
        }
        function giasp_ban(str) {
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    document.getElementById("gia_ban").innerHTML=xmlhttp.responseText; 
                } 
            }   
            xmlhttp.open("GET", "../ajax/fomatGia.php?gia=" + str, true);
            xmlhttp.send();
        }

        function showTSKT(str){
            var laptop = document.getElementById('laptop');
            var dienthoai = document.getElementById('dienthoai');
            var maytinhbang = document.getElementById('maytinhbang');
            var donghothongminh =  document.getElementById('donghothongminh');
            if(str == 'LT'){
                laptop.style.display = 'contents';
                dienthoai.style.display = 'none';
                maytinhbang.style.display = 'none';
                donghothongminh.style.display = 'none';
            }
            if(str == 'ĐT'){
                laptop.style.display = 'none';
                dienthoai.style.display = 'contents';
                maytinhbang.style.display = 'none';
                donghothongminh.style.display = 'none';
            }
            if(str == 'MTB'){
                laptop.style.display = 'none';
                dienthoai.style.display = 'none';
                maytinhbang.style.display = 'contents';
                donghothongminh.style.display = 'none';
            }
            if(str == 'ĐHTM'){
                laptop.style.display = 'none';
                dienthoai.style.display = 'none';
                maytinhbang.style.display = 'none';
                donghothongminh.style.display = 'contents';
            }
        }

        //kiem tra input trong form them san pham
        var input_tensp = document.getElementById('tensp');
        var input_giasp = document.getElementById('gia_sp');
        var input_giaban = document.getElementById('gia_ban');
        var input_img_sp = document.getElementById('img_sp');
        var input_khuyenmai= document.getElementById('khuyenmai');
        var input_giatrikhuyenmai= document.getElementById('giatrikhuyenmai');
        var input_soluongsp = document.getElementById('sl_sp');
        
        //lay duoi file trong hinh anh
        function getExtension(filename){
            var parts =  filename.split('.');
            return parts[parts.length - 1];
        }

        //kiem tra hinh anh
        function isImage(filename){
            var ext =  getExtension(filename);
            switch (ext.toLowerCase()){
                case 'jpg':
                case 'gif':
                case 'bmp':
                case 'png':
                    return true;
            }
            return false;
        }
        function giamgia(giatri){
            if(giatri === 'Giảm giá'){
                document.getElementById('giatrikhuyenmai').style.display = 'block';
            }
        }

        function KiemtraForm_ThemSP(){
            var stop_server = true;

            //kiem tra ten sp
            var ten_sp = input_tensp.value;
            if(ten_sp == ''){
                input_tensp.style.borderColor = 'red';
                stop_server = false;
            }else{
                input_tensp.style.borderColor = 'blue';
            }

            //kiem tra gia sp
            var gia_sp = input_giasp.value;
            if(gia_sp == ''){
                input_giasp.style.borderColor = 'red';
                stop_server = false;
            }else{
                input_giasp.style.borderColor = 'blue';
            }

            // kiem tra gia ban
            var gia_ban = input_giaban.value;
            if(gia_ban == ''){
                input_giaban.style.borderColor = 'red';
                stop_server = false;
            }else{
                input_giaban.style.borderColor = 'blue';
            }

            //kiem tra hinh anh
            var file_img = input_img_sp.value;
            if(file_img == ''){
                input_img_sp.style.borderColor = 'red';
                document.getElementById('error_img_sp').innerHTML = 'Chọn ảnh sản phẩm';
                stop_server = false;
            }else{
                if(isImage(file_img)){
                    input_img_sp.style.borderColor = 'blue';
                    document.getElementById('error_img_sp').innerHTML = '';
                }else{
                    input_img_sp.style.borderColor = 'red';
                    document.getElementById('error_img_sp').innerHTML = 'Chọn đúng dạng file ảnh';
                    stop_server = false;
                }
            }

            //kiem tra khuyen mai
            var khuyenmai = input_khuyenmai.value;
            if(khuyenmai == ''){
                input_khuyenmai.style.borderColor = 'red';
                stop_server = false;
            }else{
                input_khuyenmai.style.borderColor = 'blue';
            }

            //kiem tra gia tri khuyen mai
            var giatrikhuyenmai = input_giatrikhuyenmai.value;
            if(giatrikhuyenmai == ''){
                input_giatrikhuyenmai.style.borderColor = 'red';
                stop_server = false;
            }else{
                input_giatrikhuyenmai.style.borderColor = 'blue';
            }


            //kiem tra so luong sp
            var soluongsp = input_soluongsp.value;
            if(soluongsp == ''){
                input_soluongsp.style.borderColor = 'red';
                stop_server = false;
            }else{
                input_soluongsp.style.borderColor = 'blue';
            }

            return stop_server;
        }
    </script>
</body>
</html>