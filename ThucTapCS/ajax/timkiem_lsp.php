<?php
    include '/ThucTapCS/connection/connection.php';
    $tk = $_GET['tk'];
    if($tk == ""){
        $sql = "SELECT * from loaisp";
    }else{
        $sql = "SELECT * from loaisp where (ma_loaisp LIKE '%".$tk."%') or (ten_loaisp LIKE '%".$tk."%')";
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
                    <th rowspan="2">Mã Loại</th>
                    <th rowspan="2">Tên Loại</th>
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
                <th>STT</th>
                <th>Mã Loại</th>
                <th>Tên Loại</th>
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
                <td>".$row['ten_loaisp']."</td>";
            if(isset($_SESSION['admin'])){
        echo "
            <td><a href='../admin/capnhat/sua_loaisp.php?id=".$row['ma_loaisp']."'><img src='../img/edit.png' alt=''></a></td>
            <td><a href='../admin/capnhat/xoa_loaisp.php?id=".$row['ma_loaisp']."'><img src='../img/delete.png' alt=''></a></td>
        ";   
            }
        echo"
            </tr>";
        }
    }else{
        echo "
        <tr>
        <th colspan='5'>Không có loại sản phẩm nào bạn tìm kiếm</th>
        </tr>";
    }
?>
</table>