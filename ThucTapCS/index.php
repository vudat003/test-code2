<?php
    session_start();
    unset($_SESSION['lsp']);
    unset($_SESSION['ma_th']);
    unset($_SESSION['gia']);
    unset($_SESSION['khuyenmai']);
    unset($_SESSION['sosao']);
    unset($_SESSION['sapxep']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T&T Trung tâm thiết bị điện tử</title>
    <link rel = "icon" href =  
    "img/logo/logo_in.png" 
    type = "image/x-icon"> 
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/tieude.css">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="css/noidung.css">
    <link rel="stylesheet" href="css/boloc.css"> 
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/form_dangky.css">
    <link rel="stylesheet" href="css/giohang.css">
    <link rel="stylesheet" href="css/btn_top.css" >

    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
</head>

<body>
    <?php
        session_start();
        include 'tieude.php';
    ?>
    <?php
        include 'slider.php'
    ?>
    <!-- <?php
        include 'boloc.php';
    ?> -->
    <?php
        include 'giamgia.php';
        include 'sanphammoi.php';
        include 'tragop.php';
    ?>
    <?php
        include 'noidung.php';
    ?>
    <div class="footer"> <a class="btn-top" href="javascript:void(0);" title="Top" style="display: inline;"><i class="fas fa-arrow-circle-up"></i></a> </div>
    <?php
        include 'footer.php';
    ?>
    <script src="js/timkiemsp.js"></script>
    <script src="js/banner.js"></script>
    <script type="text/javascript" src="js/btn_top.js"></script>
</body>

</html>