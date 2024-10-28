<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thương hiệu</title>
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
            $idth = $_GET['id'];
            $_SESSION['id'] = $idth;
            include '../connection/connection.php';
            $sql = "SELECT * FROM thuonghieu th, loaisp lsp WHERE th.id_th = '$idth' and th.ma_loaisp = lsp.ma_loaisp";
            $result = $con->query($sql);
            $result->num_rows;
            $row = $result->fetch_assoc();
         ?>
        <div id="noidungchinh">
        <h2>Cập nhật Thương hiệu sản phẩm</h2>
            <div id="themloaisp">
                <form action="xuly_sua_th.php" method="POST" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>Tên loại sản phẩm: </td>
                            <td>
                                <select name="maloaisp" id="">
                                <?php echo " <option value='".$row['ma_loaisp']."'>".$row['ten_loaisp']."</option>"; ?>
                                <?php
                                    $sql1 = "SELECT * from loaisp";
                                    $result1 = $con->query($sql1);
                                    if($result1->num_rows > 0){
                                        while($row1 = $result1->fetch_assoc()){
                                            echo " <option value='".$row1['ma_loaisp']."'>".$row1['ten_loaisp']."</option>";
                                        }
                                    }
                                ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Mã thương hiệu SP: </td>
                            <td><input type="text" name="ma_th" placeholder="Mã thương hiệu" value="<?php echo $row['ma_th']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Tên thương hiệu SP: </td>
                            <td><input type="text" name="ten_th" placeholder="Tên thương hiệu" value="<?php echo $row['ten_tenth']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Logo: </td>
                            <td><input type="file" name="logo" placeholder="Logo"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><img src="../img/<?php $_SESSION['img_th']=$row['img_th']; echo $row['img_th'] ?>" alt="anhlogo" width="160px" height="40px"></td>
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
            <h2>Thương hiệu sản phẩm</h2>
                <table border="1">
                    <tr>
                        <th >STT</th>
                        <th >Loại SP</th>
                        <th >Mã hiệu</th>
                        <th >Tên thương hiệu</th>
                        <th >Logo</th>
                    </tr>

            <?php
                    echo "
                        <tr>
                            <td>1</td>
                            <td>".$row['ma_loaisp']."</td>
                            <td>".$row['ma_th']."</td>
                            <td>".$row['ten_tenth']."</td>
                            <td><img src='../img/".$row['img_th']."' alt='123' width=160px height=40px></td>
                        </tr>";
            ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>