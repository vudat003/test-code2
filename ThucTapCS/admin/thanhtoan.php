<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán đơn hàng</title>
    <link rel = "icon" href =  
    "../img/logo/logo_in.png" 
    type = "image/x-icon"> 
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/them_lsp_th_sp.css">
    <link rel="stylesheet" href="../css/danhsach_lsp_th_sp.css">
    <link rel="stylesheet" href="../css/thanhtoan.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>
<body>
    
    <?php
        session_start();
        
        include 'tieude.php';
    ?>
    <div id="content">
        <?php
        include '../connection/connection.php';
            include 'menu_trai.php';
        ?>
        <div id="noidungthanhtoan">
            <div id="thanhtoan">
                <div id="sanphamdachon">
                    <h4>Sản phẩm khách hàng mua</h4>
                    <div id="sanpham_khchon">
                        <table id="sanphamkhchon">
                            <tr>
                                <td>STT</td>
                                <td>Mã SP</td>
                                <td>Tên sản phẩm</td>
                                <td>số lượng</td>
                                <td>Đơn giá</td>
                                <td>Khuyến mãi</td>
                                <td>Thành tiền</td>
                                <td>Xoá </td>
                            </tr>
                        </table>
                        <div id="thanhtoandonhang">
                            <form action="thanhtoan_hoadon.php" method="POST">
                                <label for="">Tên KH:</label>
                                <input type="text" name="tenkhachhang" placeholder="Nhập tên khách hàng">
                                <label for="">SĐT:</label>
                                <input type="text" name="sodienthoai" placeholder="Nhập số điện thoại">
                                <input type="submit" value="Thanh toán">
                            </form>
                        </div>
                    </div>
                </div>
                <div id="sanphamcanchon">
                        <h4>Tìm kiếm sản phẩm</h4>
                        <input type="text" onkeyup="timkiemsanphamthanhtoan(this.value)">
                        <div id="showsanpham">
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function timkiemsanphamthanhtoan(str) {
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            

            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    document.getElementById("showsanpham").innerHTML=xmlhttp.responseText; 
                } 
            }   
            xmlhttp.open("GET", "../ajax/timkiem_sp_thanhtoan.php?tk="+str, true);
            xmlhttp.send();
        }
        
        function chonsanpham_thanhtoan(idsp){
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    document.getElementById("sanphamkhchon").innerHTML=xmlhttp.responseText; 
                } 
            }   
            xmlhttp.open("GET", "../ajax/chonsp.php?idsp="+idsp, true);
            xmlhttp.send();
        }

        function xoasanpham_thanhtoan(idsp){
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    document.getElementById("sanphamkhchon").innerHTML=xmlhttp.responseText; 
                } 
            }   
            xmlhttp.open("GET", "../ajax/xoasp.php?idsp="+idsp, true);
            xmlhttp.send();
        }
    </script>
</body>
</html>