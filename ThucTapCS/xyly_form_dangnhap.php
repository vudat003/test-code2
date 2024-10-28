<?php
    session_start();
    $ten = $_POST['tentaikhoan'];
    $temp = $_POST['matkhau'];
    $matkhau = md5($temp);
    include './connection/connection.php';
    //dang nhap doi voi khach hang
    $sql = "SELECT * FROM thanhvien WHERE tentaikhoan='".$ten."'AND matkhau='".$matkhau."'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    if($result->num_rows > 0){
        $_SESSION['id'] = $row['id'];
        $_SESSION['user'] = $row['tentaikhoan'];
        $_SESSION['path_anh_tv'] = $row['path_anh_tv'];
        ?>  
            <h1></h1>
            <script src="js/jquery-3.6.0.min.js"></script>
            <script src="js/sweetalert2.all.min.js"></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Đăng nhập thành công',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = 'index.php';
                    }
                })
            </script>
        <?php
        // header("Location: index.php");
    }else{
        //Dang nhap doi voi admin
        $sql_ad = "SELECT * FROM `admin` WHERE username='".$ten."'AND pass='".$temp."'";
        $result_ad = $con->query($sql_ad);
        if($result_ad->num_rows > 0){
            while($row_ad = $result_ad->fetch_assoc()){
                $_SESSION['admin'] = $row_ad['id_ad'];
                ?>  
                    <h1></h1>
                    <script src="js/jquery-3.6.0.min.js"></script>
                    <script src="js/sweetalert2.all.min.js"></script>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Xin chào admin',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = 'admin/admin.php';
                            }
                        })
                    </script>
                <?php
                // header("Location: admin/admin.php");
            }
        }else{
            //Dang nhap doi voi nhan vien
            $sql_nv = "SELECT * FROM nhanvien WHERE tentaikhoan_nv='".$ten."' AND matkhau_nv='".$temp."'";
            $result_nv = $con->query($sql_nv);
            if($result_nv->num_rows > 0){
                while($row_nv = $result_nv->fetch_assoc()){
                    $_SESSION['id_nv'] = $row_nv['id_nv'];
                    ?>  
                        <h1></h1>
                        <script src="js/jquery-3.6.0.min.js"></script>
                        <script src="js/sweetalert2.all.min.js"></script>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Xin chào nhân viên',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = 'admin/admin.php';
                                }
                            })
                        </script>
                    <?php
                    // header("Location: admin/admin.php");
                }
            }else{
                ?>  
                    <h1></h1>
                    <script src="js/jquery-3.6.0.min.js"></script>
                    <script src="js/sweetalert2.all.min.js"></script>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Sai mật khẩu yêu cầu đăng nhập lại',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = 'form_dangnhap.php';
                            }
                        })
                    </script>
                <?php
                // header("Location: index.php");       
            }
        }
    }
?>