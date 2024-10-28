<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm nhân viên</title>
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
        <div id="noidungchinh">
        <h2>Thêm nhân viên</h2>
            <div id="themloaisp">
                <form action="xuly_them_nv.php" method="POST" enctype="multipart/form-data" onsubmit="return KiemTraFormNhanVien()">
                    <table>
                        <tr>
                            <td>Họ tên nhân viên: </td>
                            <td><input type="text" name="ten_nv" id="ten_nv" placeholder="Nhập họ và tên NV"></td>
                        </tr>
                        <tr>
                            <td>Tên tài khoản:</td>
                            <td><input type="text" name="ten_tk_nv" id="ten_tk_nv" placeholder="Nhập tên tài khoản NV">
                                <br>
                                <br>
                                <span id="error_tentaikhoan" style="color: red;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Mật khẩu:</td>
                            <td><input type="password" name="matkhau_nv" id="matkhau" placeholder="Nhập mật khẩu">
                                <br>
                                <br>
                                <span id="error_matkhau" style="color: red;"></span>
                            </td>
                        </tr>
                        <tr>
                        </tr>
                        <tr>
                        <td>Số điện thoại:</td>
                            <td><input type="text" name="sodienthoai" id="sodienthoai" placeholder="Nhập số điện thoại NV"></td>
                        </tr>
                        <tr>
                            <td>Ảnh nhân viên: </td>
                            <td><input type="file" name="img_nv" id="img_nv" placeholder="Ảnh nhân viên">
                                    <br>
                                <span id="error_img_nv" style="color: red;"></span>
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
                $sql = "SELECT * from nhanvien";
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
    <script>
        var input_ten_nv = document.getElementById('ten_nv');
        var input_ten_tk_nv = document.getElementById('ten_tk_nv');
        var input_matkhau = document.getElementById('matkhau');
        var input_sodienthoai = document.getElementById('sodienthoai');
        var input_img_nv = document.getElementById('img_nv');
        
        var cheack_tentaikhoan = /^[A-Za-z][A-Za-z0-9]{5,14}$/;
        var cheak_matkhau = new RegExp("^(?=.*[A-Za-z])(?=.*[0-9])(?=.{5,})");       
        
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

        function  KiemTraFormNhanVien(){
            var stop_server = true;
            
            //kiem tra ten nhan vien
            var ten_nv  = input_ten_nv.value;
            if(ten_nv == ''){
                input_ten_nv.style.borderColor = 'red';
                stop_server =false;
            }else{
                input_ten_nv.style.borderColor = 'blue';
            }

            //ten tai khoan
            var tentaikhoan = input_ten_tk_nv.value;
            if(tentaikhoan == ''){
                input_ten_tk_nv.style.borderColor = 'red';
                stop_server = false;
            }else{
                if(cheack_tentaikhoan.test(tentaikhoan)){
                    input_ten_tk_nv.style.borderColor = 'blue';
                }else{
                    input_ten_tk_nv.style.borderColor = 'red';
                    document.getElementById('error_tentaikhoan').innerHTML = 'Vui lòng nhập trên 6 kí tự'
                    stop_server = false;
                }
            }

            //mat khau
            var matkhau = input_matkhau.value;
            if(matkhau == ''){
                input_matkhau.style.borderColor = 'red';
                stop_server = false;
            }else{
                if(cheak_matkhau.test(matkhau)){
                    input_matkhau.style.borderColor = 'blue';
                }else{
                    input_matkhau.style.borderColor = 'red';
                    document.getElementById('error_matkhau').innerHTML = 'Mật khẩu bắt đầu bằng chữ và phải có số';
                    stop_server = false;
                }
            }

            //so dien thoai
            var sodienthoai = input_sodienthoai.value;
            if(sodienthoai == ''){
                input_sodienthoai.style.borderColor = 'red';
                stop_server = false;
            }else{
                input_sodienthoai.style.borderColor = 'blue';
            }

            //img nhan vien
            var file_img_nv = input_img_nv.value;
            if(file_img_nv == ''){
                input_img_nv.style.borderColor = 'red';
                document.getElementById('error_img_nv').innerHTML = 'Vui lòng up ảnh nhân viên';
                stop_server = false;
            }else{
                if(isImage(file_img_nv)){
                    input_img_nv.style.borderColor = 'blue'; 
                }else{
                    input_img_nv.style.borderColor = 'red';
                    document.getElementById('error_img_nv').innerHTML = 'Vui lòng chọn đúng file ảnh';
                    stop_server = false;
                }
            }
            return stop_server;
        }
    </script>
</body>
</html>