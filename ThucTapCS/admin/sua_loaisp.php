<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa loại sản phẩm</title>
    <link rel = "icon" href =  
    "../img/logo/logo_in.png" 
    type = "image/x-icon"> 
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
            <?php
                include '../connection/connection.php';
                $id = $_GET['id'];
                $_SESSION['id_lsp'] = $id;
                $sql1 = "SELECT * from loaisp where ma_loaisp = '".$id."'";
                $result = $con->query($sql1);
                $i = 0;
                $row = $result->fetch_assoc()
            ?>  
        <div id="noidungchinh">
        <h2>Cập nhật loại sản phẩm</h2>
            <div id="themloaisp">
                <form action="xuly_sua_loaisp.php" method="POST" >
                    <table>
                        <tr>
                            <td>Mã loại SP: </td>
                            <td><input type="text" name="ma_loai" placeholder="Mã loại sản phẩm" value="<?php echo $row['ma_loaisp']?>"></td>
                        </tr>
                        <tr>
                            <td>Tên loại SP: </td>
                            <td><input type="text" name="ten_loai" placeholder="Tên loại sản phẩm" value="<?php echo $row['ten_loaisp']?>"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Cập nhật">
                                <input type="reset" value="Reset">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <hr>
            <div id="danhsach">
            <h2>Loại sản phẩm cần cập nhật</h2>
                <table border="1">
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

                    echo "
                        <tr>
                            <td>".($i = $i + 1)."</td>
                            <td>".$row['ma_loaisp']."</td>
                            <td>".$row['ten_loaisp']."</td>
                            <td><a href='sua_loaisp.php?id=".$row['ma_loaisp']."'><img src='../img/edit.png' alt=''></a></td>
                            <td><a href='xoa_loaisp.php?id=".$row['ma_loaisp']."'><img src='../img/delete.png' alt=''></a></td>
                        </tr>";

            ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>