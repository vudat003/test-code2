<?php
    include '/ThucTapCS/connection/connection.php';
    $tk = $_GET['tk'];
    if($tk == ""){
        $sql = "SELECT * from thanhvien";
    }else{
        $sql = "SELECT * from thanhvien where (hoten_tv LIKE '%".$tk."%')";
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
                <th rowspan="2">Ảnh đại diện</th>
                <th rowspan="2">Họ tên</th>
                <th rowspan="2">Email</th>
                <th rowspan="2">Số điện thoại</th>
                <th rowspan="2">Xem chi tiết</th>
                <th colspan="1">Cập nhật</th>
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
    $i = 0;
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "
                 <tr>
                     <td>".($i = $i + 1)."</td>
                     <td><img src='../img/".$row['path_anh_tv']."' alt='' width=100px height=100px></td>
                     <td>".$row['hoten_tv']."</td>
                     <td>".$row['email']."</td>
                     <td>".$row['sdt']."</td>";
                 if(isset($_SESSION['admin'])){
             echo "
                     <td><a href='chitiet_kh.php'>Xem chi tiết</a></td>
                     <td><a href='xoa_tv.php?id=".$row['id']."'><img src='../img/delete.png' alt=''></a></td>";
                 }
             echo "</tr";
            }
    }else{
         echo "
             <tr>
                 <td colspan='7'>Không có thành viên mà bạn cần tìm</td>
             </tr>";
    }
?>
</table>