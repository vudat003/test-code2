<?php
    include '../connection/connection.php';
    $tk = $_GET['tk'];
    if($tk == ""){
        $sql = "SELECT * from thuonghieu order by ma_loaisp";
    }else{
        $sql = "SELECT * from thuonghieu where (ma_th LIKE '%".$tk."%') or (ten_tenth LIKE '%".$tk."%') order by ma_loaisp";
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
                    <th rowspan="2">Loại SP</th>
                    <th rowspan="2">Mã hiệu</th>
                    <th rowspan="2">Tên thương hiệu</th>
                    <th rowspan="2">Logo</th>
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
                    <th >Loại SP</th>
                    <th >Mã hiệu</th>
                    <th >Tên thương hiệu</th>
                    <th >Logo</th>
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
                <td>".$row['ma_loaisp']."</td>
                <td>".$row['ma_th']."</td>
                <td>".$row['ten_tenth']."</td>
                <td><img src='../img/".$row['img_th']."' alt='' width=160px height=40px></td>";
                if(isset($_SESSION['admin'])){
            echo"
                    <td><a href='../admin/sua_th.php?id=".$row['id_th']."'><img src='../img/edit.png' alt=''></a></td>
                    <td><a href='../admin/xoa_th.php?id=".$row['id_th']."'><img src='../img/delete.png' alt=''></a></td>";
                }
            echo "
            </tr>";
        }
    }else{
        echo "
        <tr>
        <th colspan='7'>Không có loại thương hiệu nào bạn cần tìm kiếm</th>
        </tr>";
    }
?>
</table>