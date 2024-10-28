<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin nhân viên</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/them_lsp_th_sp.css">
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
        <h2>Chỉnh sửa thông tin nhân viên</h2>
            <div id="themloaisp">
                <?php
                    $id_nv = $_GET['id'];
                    include '../connection/connection.php';
                    $sql = "SELECT * from nhanvien where id_nv = '".$id_nv."'";
                    $result = $con->query($sql);
                    $i = 0;
                    $row_value_nv = $result->fetch_assoc();
                    $_SESSION['img_nv'] = $row_value_nv['img_nv'];
                    $_SESSION['id_nhanvien'] = $row_value_nv['id_nv'];
                ?>
                <form action="xuly_sua_nv.php" method="POST" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>Họ tên nhân viên: </td>
                            <td><input type="text" name="ten_nv" value="<?php echo $row_value_nv['ten_nv'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Tên tài khoản:</td>
                            <td><input type="text" name="ten_tk_nv"value="<?php echo $row_value_nv['tentaikhoan_nv'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Mật khẩu:</td>
                            <td><input type="password" name="matkhau_nv" value="<?php echo $row_value_nv['matkhau_nv'] ?>"></td>
                        </tr>
                        <tr>
                        <td>Số điện thoại:</td>
                            <td><input type="text" name="sodienthoai" value="<?php echo $row_value_nv['sdt_nv'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Ảnh nhân viên: </td>
                            <td><input type="file" name="img_nv" placeholder="Ảnh nhân viên"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Sửa">
                                <input type="reset" value="Reset">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <hr>
            <div id="danhsach">
            <h2>Danh sách nhân viên</h2>
                <table border="1">
                    <tr>
                        <th rowspan="2">STT</th>
                        <th rowspan="2">Họ và tên nhân viên</th>
                        <th rowspan="2">Tên tài khoản nhân viên</th>
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
                include '../connection/connection.php';
                $sql = "SELECT * from nhanvien where id_nv = '".$id_nv."'";
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
</body>
</html>