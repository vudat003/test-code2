<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
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
                $cout_sp = 0;
                $sql_sp = "SELECT COUNT(id_sp) as count_sp FROM `sanpham` WHERE 1";
                $result_sp = $con->query($sql_sp);
                if($result_sp->num_rows > 0){
                    while($row_coutsp = $result_sp->fetch_assoc()){
                        $cout_sp = $row_coutsp['count_sp'];
                    } 
                }
            ?>
            <h2>Danh sách sản phẩm</h2>
            <div id="chucnang">
                <div id="upload">
            <?php
                if(isset($_SESSION['admin'])){
                    ?>

                        <form method="POST" action="./upload_excel/upload_excel_sp.php" enctype="multipart/form-data">
                                <input type="file" name="uploadFile" class="form-control" />
                                <button type="submit" name="submit" class="btn btn-success">Upload</button>
                        </form>
     
                    <?php
                }
            ?>
                </div>     
                <div id="timkiem">
                    <label>Tìm kiếm</label>
                    <input type="text" onkeyup="timkiem(this.value)">
                </div>
            </div>
            <div id="danhsach">
                <p class="so_sp">Tổng số sản phẩm: <?php echo $cout_sp?></p>
                <table>
                    <?php
                        if(isset($_SESSION['admin'])){
                            ?>
                                 <tr>
                                    <th rowspan="2">STT</th>
                                    <th rowspan="2">id_sp</th>
                                    <th rowspan="2"  style="width: 212px; ">Tên sản phẩm</th>
                                    <th rowspan="2">Ảnh sản phẩm</th>
                                    <th rowspan="2">Màu sắc</th>
                                    <th rowspan="2">Giá bán</th>
                                    <th rowspan="2">SL</th>
                                    <th rowspan="2">Khuyến mãi</th>
                                    <th rowspan="2"  style="width: 100px;">Giá trị khuyến mãi</th>
                                    <th colspan="2">Cập nhật</th>

                                </tr>
                                <tr>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            <?php
                        }else{
                            ?>
                                 <tr>
                                    <th >STT</th>
                                    <th >id_sp</th>
                                    <th >Tên sản phẩm</th>
                                    <th >Ảnh sản phẩm</th>
                                    <th >Màu sắc</th>
                                    <th >Giá bán</th>
                                    <th >SL</th>
                                    <th >Khuyến mãi</th>
                                    <th >Giá trị khuyến mãi</th>
                                </tr>
                            <?php
                        }
                    ?>
            <?php
                $sql = "SELECT * from sanpham";
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
                            <td>".number_format($row['gia_ban'], 0, '', ',')."</td>
                            <td>".$row['sl_sp']."</td>
                            <td>".$row['khuyenmai']."</td>
                            <td>".number_format($row['giatrikhuyenmai'], 0, '', ',')."</td>";
                        if(isset($_SESSION['admin'])){
                        echo "
                            <td><a href='./sua_sp.php?id=".$row['id_sp']."'><img src='../img/edit.png' alt=''></a></td>
                            <td><a href='./xoa_sp.php?id=".$row['id_sp']."'><img src='../img/delete.png' alt=''></a></td>";
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
            xmlhttp.open("GET", "../ajax/timkiem_sp.php?tk="+str, true);
            xmlhttp.send();
        }
    </script>
</body>
</html>