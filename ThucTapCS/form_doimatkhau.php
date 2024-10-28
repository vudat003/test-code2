<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu</title>
    <link rel = "icon" href =  
    "img/logo/logo.png" 
    type = "image/x-icon"> 
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/tieude.css">
    <link rel="stylesheet" href="css/noidung.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/form_dangky.css">
    <link rel="stylesheet" href="css/giohang.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>

<body>
<?php
    include 'tieude.php';
?>
<div class="dangky">
    <form action="xuly_doimatkhau.php" method="POST" enctype="multipart/form-data">
        <h2>Cập nhật lại mật khẩu</h2>
        <p>Tên đăng nhập:</p>
        <input type="text" name="tentaikhoan" id="tentaikhoan" placeholder="Nhập tên tài khoản">
        <p>Mật khẩu:</p>
        <input type="password" name="matkhau" id="matkhau" placeholder="Nhập mật khẩu">
        <p>Nhập lại mật khẩu:</p>
        <input type="password" name="nhaplai_matkhau" id="nhaplai_matkhau" placeholder="Nhập lại mật khẩu">
        <div id="dangkytk">
            <input type="submit" name="" value="Cập nhật mật khẩu"><br>
            <span><a href="form_dangky.php">Chưa có tài khoản?</a></span><br>
            <span><a href="form_dangnhap.php">Đăng nhập tài khoản</a></span>
        </div>
    </form>
</div>
<?php
    include 'footer.php';
?>
<script src="js/timkiemsp.js"></script>
</body>
</html>