<?php
    session_start();
    $id = $_SESSION['id'];
    // $idsp = $_SESSION['idsp'];
    if(isset($_POST['mausac'])){
        $idsp = $_POST['mausac'];
    }else{
        $idsp = $_SESSION['idsp'];
    }
    include './connection/connection.php';
    //Kiem tra san pham co trong gio hang hay chưa ?
    $check = "SELECT * from giohang where id = '".$id."' and  id_sp = '".$idsp."'";
    $result = $con->query($check);
    echo "<h1></h1>";
    if($result->num_rows == 0){
        ?> 
            <script src="js/jquery-3.6.0.min.js"></script>
            <script src="js/sweetalert2.all.min.js"></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sản phẩm đã được thêm thành công',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = 'giohang.php';
                    }
                })
            </script>
        <?php
        $sql = "INSERT INTO `giohang`(`id_gh`, `id`, `id_sp`, `soluong`, `trangthai`) VALUES (null,'$id','$idsp',1, 0)";
        $con->query($sql);
        $con->close();  
    }else{
        ?>  
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/sweetalert2.all.min.js"></script>
        <script>
            Swal.fire({
                    icon: 'error',
                    title: 'Sản phẩm đã có trong giỏ hàng'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = 'chitietsanpham.php?idsp=<?=$idsp?>';
                    }
                })
        </script>
        <?php
    }
    // header("Location: chitietsanpham.php?idsp=".$idsp."")
?>