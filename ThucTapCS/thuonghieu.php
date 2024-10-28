<?php
    include './connection/connection.php';
    $lsp = $_GET['lsp'];
    if(isset($_SESSION['gia'])){
        $gia = "&gia=".$_SESSION['gia']."";
    }else{
        $gia = "";
    }
    if(isset($_SESSION['khuyenmai'])){
        $khuyenmai = "&khuyenmai=".$_SESSION['khuyenmai']."";
    }else{
        $khuyenmai = "";
    }
    if(isset($_SESSION['sosao'])){
        $sosao = "&sosao=".$_SESSION['sosao']."";
    }else{
        $sosao = "";
    }
    if(isset($_SESSION['sapxep'])){
        $sapxep = "&sapxep=".$_SESSION['sapxep']."";
    }else{
        $sapxep = "";
    }
    $sql = "SELECT * FROM thuonghieu th WHERE EXISTS (SELECT sp.id_th FROM sanpham sp WHERE sp.id_th = th.id_th) AND th.ma_loaisp= '".$lsp."'";
    $result = $con->query($sql);
    if($result->num_rows > 0){
        ?>
            <div id="thuonghieu">
        <?php
        while($row = $result->fetch_assoc()){
            echo "
                <a href='loc_sp.php?lsp=".$row['ma_loaisp']
                ."&ma_th=".$row['ma_th']
                .$gia
                .$khuyenmai
                .$sosao
                .$sapxep
                ."
                '><img src='./img/".$row['img_th']."' alt=''></a>
            ";
        }
        ?>
            </div>
        <?php
    }
?>