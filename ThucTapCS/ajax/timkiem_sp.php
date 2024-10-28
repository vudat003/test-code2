<?php
    include '/ThucTapCS/connection/connection.php';
    $tk = $_GET['tk'];
    if($tk == ""){
        $sql = "SELECT * from sanpham";
    }else{
        $sql = "SELECT * from sanpham where (ten_sp LIKE '%".$tk."%')";
    }
    $result = $con->query($sql);
?>
<table>

    <?php
        session_start();
        if(isset($_SESSION['admin'])){
            ?>
                <tr>
                    <th rowspan="2">STT</th>
                    <th rowspan="2">id_sp</th>
                    <th rowspan="2"  style="width: 212px; ">Tên sản phẩm</th>
                    <th rowspan="2">Ảnh sản phẩm</th>
                    <th rowspan="2">Màu sắc</th>
                    <th rowspan="2">Giá</th>
                    <th rowspan="2">SL</th>
                    <th rowspan="2">Khuyến mãi</th>
                    <th rowspan="2"  style="width: 100px; ">Giá trị khuyến mãi</th>
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
                <th  >STT</th>
                <th >id_sp</th>
                <th >Tên sản phẩm</th>
                <th >Ảnh sản phẩm</th>
                <th >Màu sắc</th>
                <th >Giá</th>
                <th >SL</th>
                <th >Khuyến mãi</th>
                <th >Giá trị khuyến mãi</th>
            </tr>
        <?php      
        }
    ?>
<?php
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
            if(isset($_SESSION['admin'])){
        echo "
                <td><a href='./sua_sp.php?id=".$row['id_sp']."'><img src='../img/edit.png' alt=''></a></td>
                <td><a href='./xoa_sp.php?id=".$row['id_sp']."'><img src='../img/delete.png' alt=''></a></td>";
            }
        echo "</tr>";
    }
   }else{
       echo '
       <tr>
            <th colspan="12">Không có sản phẩm mà bạn cần tìm kiếm</th>
       </tr>
       ';
   }
?>
</table>
