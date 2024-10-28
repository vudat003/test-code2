<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đánh giá sản phẩm</title>
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
        
            <h2>Quản lý danh sách sản phẩm</h2>
            <div id="danhsach">
                <table>
                    <?php
                        if(isset($_SESSION['admin'])){
                            ?>
                                <tr>
                                    <th width='20px'>STT</th>
                                    <th width='20px'>id_sp</th>
                                    <th style="width: 212px; ">Tên sản phẩm</th>
                                    <th width='100px'>Ảnh sản phẩm</th>
                                    <th style="width: 140px; " >Số sao</th>
                                    <th width='100px'>Ảnh bình luận</th>
                                    <th>Nội dung bình luận</th>
                                    <th>Xóa</th>
                                </tr>
                            <?php
                        }else{
                            ?>
                                <tr>
                                    <th>STT</th>
                                    <th>id_sp</th>
                                    <th  style="width: 212px; ">Tên sản phẩm</th>
                                    <th width='100px'>Ảnh sản phẩm</th>
                                    <th style="width: 140px; ">Số sao</th>
                                    <th width='100px'>Ảnh bình luận</th>
                                    <th>Nội dung bình luận</th>
                                    <th>Xóa</th>

                                </tr>
                            <?php
                        }
                    ?>
            <?php
            include '../connection/connection.php';
                $sql = "SELECT dgsp.id_bl, sp.id_sp, sp.ten_sp, sp.img_sp, dgsp.hoten_cmt, dgsp.img_cmt, dgsp.sosao, dgsp.noidungdanhgia from sanpham sp, danhgiasp dgsp where sp.id_sp = dgsp.id_sp";
                $result = $con->query($sql);
                $i = 0;
                
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                    echo "
                        <tr>
                            <td>".($i = $i + 1)."</td>
                            <td>".$row['id_sp']."</td>
                            <td>".$row['ten_sp']."</td>";
                    echo "
                            <td><img src='../img/".$row['img_sp']."'  width=100px height=100px></td>
                            <td>";
                                for($i = 1; $i <= $row['sosao']; ++ $i){
                                    echo "<i class='fas fa-star' style='color: #a2a21f;'></i>";
                                }

                            
                        echo "    
                            </td>";
                                if($row['img_cmt'] != ""){
                                    echo "
                                    <td><img src='../img/".$row['img_cmt']."' alt='Không có ảnh' width=100px height=100px></td>";
                                }else{
                                    echo "
                                    <td></td>";
                                }
                        echo "
                            <td>".$row['noidungdanhgia']."</td>
                            ";
                        if(isset($_SESSION['admin'])){
                        echo "
                            <td><a href='./xoa_danhgiasp.php?id_cmt=".$row['id_bl']."&&idsp=".$row['id_sp']."'><img src='../img/delete.png' alt=''></a></td>";
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