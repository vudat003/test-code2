<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách loại sản phẩm</title>
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
            <h2>Danh sách loại sản phẩm</h2>
            <div id="chucnang">
                <div id="upload">
                    <?php
                        if(isset($_SESSION['admin'])){
                            echo "
                            <form method='POST' action='./upload_excel/upload_excel_loaisp.php' enctype='multipart/form-data'>
                                <input type='file' name='uploadFile' class='form-control' />
                                <button type='submit' name='submit' class='btn btn-success'>Upload</button>
	                        </form>";
                        }
                    ?>
                </div>
                <div id="timkiem">
                    <label>Tìm kiếm</label>
                    <input type="text" onkeyup="timkiem(this.value)">
                </div>
            </div>
            <?php
                include '../connection/connection.php';
                $sql = "SELECT * from loaisp";
                $result = $con->query($sql);
                $cout_loaisp = 0;
                $sql_dem_loaisp = "SELECT COUNT(ma_loaisp) as count_loaisp FROM `loaisp` WHERE 1";
                $result_demloaisp = $con->query($sql_dem_loaisp);
                if($result_demloaisp->num_rows > 0){
                    while($row_coutlsp = $result_demloaisp->fetch_assoc()){
                        $cout_loaisp = $row_coutlsp['count_loaisp'];
                    } 
                }
            ?>
            <div id="danhsach">
                <p class="so_loaisp">Tổng số loại sản phẩm: <?php echo $cout_loaisp?></p>
                <table>
            <?php
                if(isset($_SESSION['admin'])){
                    echo "
                    <tr>
                        <th rowspan='2'>STT</th>
                        <th rowspan='2'>Mã Loại</th>
                        <th rowspan='2'>Tên Loại</th>
                        <th colspan='2'>Cập nhật</th>
                    </tr>
                    <tr>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                    ";
                }else{
                    echo "
                    <tr>
                        <th>STT</th>
                        <th>Mã Loại</th>
                        <th>Tên Loại</th>

                    </tr>
                    ";
                }
            ?>
            <?php
                $i = 0;
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){ 
                    echo "
                        <tr>
                            <td>".($i = $i + 1)."</td>
                            <td>".$row['ma_loaisp']."</td>
                            <td>".$row['ten_loaisp']."</td>";
                        if(isset($_SESSION['admin'])){
                            echo "
                                <td><a href='./sua_loaisp.php?id=".$row['ma_loaisp']."'><img src='../img/edit.png' alt=''></a></td>
                                <td><a href='./xoa_loaisp.php?id=".$row['ma_loaisp']."'><img src='../img/delete.png' alt=''></a></td>";
                        }
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
            xmlhttp.open("GET", "../ajax/timkiem_lsp.php?tk="+str, true);
            xmlhttp.send();
        }
    </script>
</body>
</html>