<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách giỏ hàng</title>
    <link rel = "icon" href =  
    "../img/logo/logo_in.png" 
    type = "image/x-icon"> 
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/danhsach_lsp_th_sp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>
<body>
    <?php
        session_start();
        include 'tieude.php';
    ?>
    <div id="content">
        <?php
            include 'menu_trai.php'
        ?>
        <div id="noidungchinh">
            <?php
                include '../connection/connection.php';
                $cout_gh = 0;
                $sql_gh = "SELECT COUNT(id_gh) as count_gh FROM `giohang`";
                $result_gh = $con->query($sql_gh);
                if($result_gh->num_rows > 0){
                    while($row_coutgh = $result_gh->fetch_assoc()){
                        $cout_gh = $row_coutgh['count_gh'];
                    } 
                }
            ?>
            <h2>Danh sách giỏ hàng</h2>
            <div id="chucnang"> 
            </div>
            <div id="danhsach">
                <p class="so_sp">Tổng số giỏ hàng<?php echo $cout_gh?></p>
                <table>
                    <?php
                        if(isset($_SESSION['admin'])){
                            ?>
                                 <tr>
                                    <th >STT</th>
                                    <th >Tên thành viên</th>
                                    <th>Ảnh thành viên</th>
                                    <th >Tên sản phẩm</th>
                                    <th >Ảnh sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th >SL</th>
                                    <th>Thành tiền</th>
                                </tr>
                            <?php
                        }else{
                            ?>
                                <tr>
                                    <th >STT</th>
                                    <th >Tên thành viên</th>
                                    <th>Ảnh thành viên</th>
                                    <th >Tên sản phẩm</th>
                                    <th >Ảnh sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th >SL</th>
                                    <th>Thành tiền</th>
                                </tr>
                            <?php
                        }
                    ?>
            <?php
                $sql = "SELECT sp.ten_sp, sp.img_sp, tv.hoten_tv, tv.path_anh_tv, sp.gia_sp, gh.soluong FROM giohang gh,
                         sanpham sp, thanhvien tv WHERE gh.id_sp = sp.id_sp AND gh.id = tv.id";
                $result = $con->query($sql);
                $i = 0;
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                    echo "
                        <tr>
                            <td>".($i = $i + 1)."</td>
                            <td>".$row['hoten_tv']."</td>
                            <td><img src='../img/".$row['path_anh_tv']."' alt='' width=100px height=100px></td>
                            <td>".$row['ten_sp']."</td>
                            <td><img src='../img/".$row['img_sp']."' alt='' width=100px height=100px></td>
                            <td>".number_format($row['gia_sp'], 0, '', ',')."</td>
                            <td>".$row['soluong']."</td>
                            <td>".number_format($row['gia_sp']*$row['soluong'], 0, '', ',')."</td>";
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
        function timkiem(str) {
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    document.getElementById("danhsach").innerHTML=xmlhttp.responseText; 
                } 
            }   
            xmlhttp.open("GET", "../ajax/timkiem_sp.php?tk="+str, true);
            xmlhttp.send();
        }
    </script>
</body>
</html>