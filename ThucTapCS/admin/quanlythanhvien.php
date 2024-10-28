<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên</title>
    <link rel = "icon" href =  
    "../img/logo/logo_in.png" 
    type = "image/x-icon"> 
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/menu_trai.css">
    <link rel="stylesheet" href="../css/content_ad.css">
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
            include 'menu_trai.php';
        ?>
        <div id="noidungchinh">
            <?php
                include '../connection/connection.php';
                $cout_tv = 0;
                $sql_tv = "SELECT COUNT(id) as count_tv FROM `thanhvien` WHERE 1";
                $result_tv = $con->query($sql_tv);
                if($result_tv->num_rows > 0){
                    while($row_couttv = $result_tv->fetch_assoc()){
                        $cout_tv = $row_couttv['count_tv'];
                    } 
                }
            ?>
            <h2>Danh sách khách hàng</h2>
            <div id="chucnang">
                <div id="hienthi">
                </div>
                <div id="timkiem">
                    <label>Tìm kiếm</label>
                    <input type="text" onkeyup="timkiem(this.value)">
                </div>
            </div>
            <div id="danhsach">
                <p class="so_sp">Tổng số khách hàng: <?php echo $cout_tv?></p>
                <table>
                    <?php
                        if(isset($_SESSION['admin'])){
                            ?>
                            <tr>
                                    <th rowspan="2">STT</th>
                                    <th rowspan="2">Ảnh đại diện</th>
                                    <th rowspan="2">Họ tên</th>
                                    <th rowspan="2">Email</th>
                                    <th rowspan="2">Số điện thoại</th>
                                    <th colspan="1">Khoá tài khoản</th>
                                </tr>
                            <tr>
                                <th>Xóa</th>
                            </tr>
                            <?php
                        }else{
                            ?>
                            <tr>
                                <th >STT</th>
                                <th >Ảnh đại diện</th>
                                <th >Họ tên</th>
                                <th >Email</th>
                                <th >Số điện thoại</th>
                            </tr>
                            <?php
                        }
                    ?>
            <?php
               include '../connection/connection.php';
               $sql = "SELECT * from thanhvien";
               $result = $con->query($sql);
               $i = 0;
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        if($row['email'] == null){
                                echo "
                                <tr>
                                    <td>".($i = $i + 1)."</td>
                                    <td></td>
                                    <td>".$row['hoten_tv']."</td>
                                    <td></td>
                                    <td>".$row['sdt']."</td>";
                                if(isset($_SESSION['admin'])){
                            echo "
                                    <td><a href='xoa_tv.php?id=".$row['id']."'><img src='../img/delete.png' alt=''></a></td>";
                                }
                            echo "</tr";
                        }else{
                                echo "
                                <tr>
                                    <td>".($i = $i + 1)."</td>
                                    <td><img src='../img/".$row['path_anh_tv']."' alt='' width=100px height=100px></td>
                                    <td>".$row['hoten_tv']."</td>
                                    <td>".$row['email']."</td>
                                    <td>".$row['sdt']."</td>";
                                if(isset($_SESSION['admin'])){
                            echo "
                                    <td><a href='xoa_tv.php?id=".$row['id']."'><img src='../img/delete.png' alt=''></a></td>";
                                }
                            echo "</tr";
                            }
                        }
                }else{
                        echo "
                            <tr>
                                <td colspan='7'>Chưa có thành viên</td>
                            </tr>";
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
            xmlhttp.open("GET", "../ajax/timkiem_tv.php?tk="+str, true);
            xmlhttp.send();
        }
    </script>
</body>
</html>