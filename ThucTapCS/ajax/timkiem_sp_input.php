<?php
    $tk = $_GET['tk'];
    include '../connection/connection.php';
    $sql = "SELECT * from sanpham where (ten_sp LIKE '%".$tk."%') limit 0, 7";
    $reslut = $con->query($sql);
    if($tk == ""){
        echo "";
    }else{
        if($reslut->num_rows > 0){
            while($row = $reslut->fetch_assoc()){
                echo "
                <a href='chitietsanpham.php?idsp=".$row['id_sp']."'>
                    <div class='sp'>
                        <img src='img/".$row['img_sp']."' alt='' width=50px height=50px>
                        <div class='noidung'>
                            <h5>".$row['ten_sp']."</h5>
                            <h6>".number_format($row['gia_ban'], 0, '', ',')." Đ</h6>
                        </div>
                    </div>
                </a>
                ";
            }
        }
    }
?>