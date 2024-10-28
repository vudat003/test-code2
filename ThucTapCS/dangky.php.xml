<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký thành viên</title>
    <link rel = "icon" href =  
    "img/logo/logo.png" 
    type = "image/x-icon"> 
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/tieude.css">
    <link rel="stylesheet" href="css/noidung.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/dangky.css">
    <link rel="stylesheet" href="css/giohang.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>

<body>
    <?php
        session_start();
        include 'tieude.php';
    ?>
<div class="dangky">
    <form action="xuly_form_dangky.php" method="POST" enctype="multipart/form-data" onsubmit="return kiemTraFormDangKy()">
        <h2>Đăng ký tài khoản</h2>
        <div id="fromdangky">
            <div id="fromdangky_trai">
                <p>Họ và tên:</p>
                <input type="text" name="hoten" id="hoten" placeholder="Nhập họ và tên ...">
                <span id="error_hoten" class="error"></span>
                <p>Tên tài khoản:</p>
                <input type="text" name="tentaikhoan" id="tentaikhoan" placeholder="Nhập tên tài khoản ...">
                <span id="error_tentaikhoan" class="error" ></span>
                <p>Mật khẩu:</p>
                <input type="password" name="matkhau" id="matkhau" placeholder="Nhập mật khẩu ...">
                <span id="error_matkhau" class="error"></span>
                <p>Nhập lại mật khẩu:</p>
                <input type="password" name="nhaplai_matkhau" id="nhaplai_matkhau" placeholder="Nhập lại mật khẩu ...">
                <span id="error_nhaplaimatkhau" class="error"></span>
            </div>
            <div id="fromdangky_phai">
                <p>Nhập địa chỉ email:</p>
                <input type="text" name="email" id="email" placeholder="Nhập emali ...">
                <span id="error_email" class="error"></span>
                <p>Nhập số điện thoại:</p>
                <input type="text" name="sdt" id="sdt" placeholder="Nhập số điện thoại ...">
                <span id="error_sdt" class="error"></span>
                <p>Ảnh đại diện:</p>
                <input type="file" name="anhdaidien" id="anhdaidien">
                <span id="error_fileanh" class="error"></span>
            </div>
        </div>
        <div id="dangkytk">
        <input type="submit" value="Đăng ký" id="btn_dangky"><br>
            <span><a href="form_doimatkhau.php">Quên mật khẩu?</a></span><br>
            <span><a href="form_dangky.php">Chưa có tài khoản?</a></span>
        </div>
    </form>
</div>
<?php
    include 'footer.php';
?>
    <script src="js/timkiemsp.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <script src="js/kiemtra_fromdangky.js"></script>
</body>
</html>