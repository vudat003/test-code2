<?php
    //lam viec voi form
    $hoten = $_POST['hoten'];
    $ten = $_POST['tentaikhoan'];
    $tmp_mk = $_POST['matkhau'];
    $matkhau = md5($tmp_mk);
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $path_avata_tv = './img_tv/' . $_FILES['anhdaidien']['name'];
    move_uploaded_file($_FILES['anhdaidien']['tmp_name'],  "./img/".$path_avata_tv);
    //lam viec voi co so du lieu
    include './connection/connection.php';
    $sql = "INSERT INTO thanhvien (hoten_tv, tentaikhoan, matkhau, email, sdt, path_anh_tv) 
        values ('$hoten','$ten', '$matkhau','$email', '$sdt' ,'$path_avata_tv')";
    if($con->query($sql)){
        ?>  
            <h1></h1>
            <script src="js/jquery-3.6.0.min.js"></script>
            <script src="js/sweetalert2.all.min.js"></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Đã đăng ký thành công',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = 'form_dangnhap.php';
                    }
                })
            </script>
        <?php
    }
    $con->close();
    // header("Location: form_dangnhap.php"); 
?> 