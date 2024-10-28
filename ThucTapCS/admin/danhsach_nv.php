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
            <h2>Danh sách nhân viên</h2>
            <div id="chucnang">
                <div id="hienthi">
                </div>
                <div id="timkiem">
                    <label>Tìm kiếm</label>
                    <input type="text" onkeyup="timkiem(this.value)">
                </div>
            </div>
            <?php
                include '../connection/connection.php';
                $cout_th = 0;
                $sql_th = "SELECT COUNT(id_nv) as count_nv FROM `nhanvien`";
                $result_th = $con->query($sql_th);
                if($result_th->num_rows > 0){
                    while($row_coutth = $result_th->fetch_assoc()){
                        $cout_nv = $row_coutth['count_nv'];
                    } 
                }
            ?>
            <div id="danhsach">
            <p class="so_th">Tổng số nhân viên: <?php echo $cout_nv?></p>
                <table>
                <tr>
                        <th rowspan="2">STT</th>
                        <th rowspan="2">Họ và tên</th>
                        <th rowspan="2">Tên tài khoản</th>
                        <th rowspan="2">Mật khẩu</th>
                        <th rowspan="2">Số điện thoại</th>
                        <th rowspan="2">Ảnh nhân viên</th>
                        <th colspan="2">Cập nhật</th>
                    </tr>
                <tr>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            <?php
               $sql = "SELECT * from nhanvien";
               $result = $con->query($sql);
               $i = 0;
               if($result->num_rows > 0){
                   while($row = $result->fetch_assoc()){
                   echo "
                       <tr>
                           <td>".($i = $i + 1)."</td>
                           <td>".$row['ten_nv']."</td>
                           <td>".$row['tentaikhoan_nv']."</td>
                           <td>".$row['matkhau_nv']."</td>
                           <td>".$row['sdt_nv']."</td>
                           <td><img src='../img/".$row['img_nv']."' alt='' width=60px height=60px></td>
                           <td><a href='sua_nv.php?id=".$row['id_nv']."'><img src='../img/edit.png' alt=''></a></td>
                           <td><a href='xoa_nv.php?id=".$row['id_nv']."'><img src='../img/delete.png' alt=''></a></td>
                       </tr>";
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
            xmlhttp.open("GET", "../ajax/timkiem_nv.php?tk="+str, true);
            xmlhttp.send();
        }
    </script>
</body>
</html>