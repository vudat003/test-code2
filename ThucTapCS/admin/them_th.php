<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
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
            $sql = "SELECT * from loaisp";
            $result = $con->query($sql);
        ?>  
        <div id="noidungchinh">
        <h2>Thêm Thương hiệu sản phẩm</h2>
            <div id="themloaisp">
                <form action="xuly_them_th.php" method="POST" enctype="multipart/form-data" onsubmit="return KiemTra_FormThuongHieu()">
                    <table>
                        <tr>
                            <td>Tên loại sản phẩm: </td>
                            <td>
                                <select name="maloaisp" id="">
                                    <?php
                                        if($result->num_rows > 0){
                                            while($row = $result->fetch_assoc()){
                                                echo " <option value='".$row['ma_loaisp']."'>".$row['ten_loaisp']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Mã thương hiệu SP: </td>
                            <td><input type="text" name="ma_th" id="ma_th" placeholder="Mã thương hiệu"></td>
                        </tr>
                        <tr>
                            <td>Tên thương hiệu SP: </td>
                            <td><input type="text" name="ten_th" id="ten_th" placeholder="Tên thương hiệu"></td>
                        </tr>
                        <tr>
                            <td>Logo: </td>
                            <td><input type="file" name="logo" id="img_th" placeholder="Logo">
                            <br>
                                <span id="error_img_th" style="color: red;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Thêm">
                                <input type="reset" value="Reset">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <hr>
            <div id="danhsach">
            <h2>Danh sách loại sản phẩm</h2>
                <table border="1">
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
                $sql = "SELECT * from thuonghieu";
                $result = $con->query($sql);
                $i = 0;
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                    echo "
                        <tr>
                            <td>".($i = $i + 1)."</td>
                            <td>".$row['ma_loaisp']."</td>
                            <td>".$row['ma_th']."</td>
                            <td>".$row['ten_tenth']."</td>
                            <td><img src='../img/".$row['img_th']."' alt='' width=160px height=40px></td>
                            <td><a href='sua_th.php?id=".$row['id_th']."'><img src='../img/edit.png' alt=''></a></td>
                            <td><a href='xoa_th.php?id=".$row['id_th']."'><img src='../img/delete.png' alt=''></a></td>
                        </tr>";
                    }
                }
            ?>
                </table>
            </div>
        </div>
    </div>
    <script>
        var input_ma_th = document.getElementById('ma_th');
        var input_ten_th = document.getElementById('ten_th');
        var input_img_th = document.getElementById('img_th');
        
        //lay duoi file trong hinh anh
        function getExtension(filename){
            var parts =  filename.split('.');
            return parts[parts.length - 1];
        }

        //kiem tra hinh anh
        function isImage(filename){
            var ext =  getExtension(filename);
            switch (ext.toLowerCase()){
                case 'jpg':
                case 'gif':
                case 'bmp':
                case 'png':
                    return true;
            }
            return false;
        }

        function KiemTra_FormThuongHieu(){

            var stop_server = true;
            //kiem tra ma thuong hieu co trong khong>?
            var ma_th = input_ma_th.value;
            if(ma_th == ''){
                input_ma_th.style.borderColor = 'red';
                stop_server = false;
            }else{
                input_ma_th.style.borderColor = 'blue';
            }
            //Kiem tra ten thuong hieu co trống không ?
            var ten_th = input_ten_th.value;
            if(ten_th == ''){
                input_ten_th.style.borderColor = 'red';
                stop_server = false;
            }else{
                input_ten_th.style.borderColor = 'blue';
            }

            //kiem tra có đÚng với file ảnh hay không ?

            var img_th = input_img_th.value;
            if(img_th == ''){
                input_img_th.style.borderColor = 'red';
                document.getElementById('error_img_th').innerHTML =  'Yêu cầu chọn file ảnh';
                stop_server = false;
            }else{
                if(isImage(img_th)){
                    input_img_th.style.borderColor = 'blue';
                    document.getElementById('error_img_th').style.display = 'block';
                }else{
                    input_img_th.style.borderColor = 'red';
                    document.getElementById('error_img_th').innerHTML =  'Yêu cầu chọn đúng dạng file ảnh';
                    stop_server = false;
                }
            }
            return stop_server;
        }
    </script>
</body>
</html>