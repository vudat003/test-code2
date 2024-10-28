<?php
    include '../connection/connection.php';
    $tk = $_GET['tk'];
    if($tk == ""){
        $sql = "SELECT * from nhanvien";
    }else{
        $sql = "SELECT * from nhanvien where (ten_nv LIKE '%".$tk."%')";
    }
    $result = $con->query($sql);
?>
   <table >
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
                <td><a href='delete_kh.php?id=".$row['id_nv']."'><img src='../img/delete.png' alt=''></a></td>
            </tr>";
        }
    }else{
         echo "
             <tr>
                 <td colspan='7'>Không có nhân viên mà bạn cần tìm</td>
             </tr>";
    }
?>
</table>