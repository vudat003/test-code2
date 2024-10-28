<?php
    $tk = $_GET['tk'];
    include '/ThucTapCS/connection/connection.php';
    $sql = "SELECT * from sanpham where (ten_sp LIKE '%".$tk."%') limit 0, 7";
    $reslut = $con->query($sql);
    if($tk == ""){
        echo "";
    }else{
        if($reslut->num_rows > 0){
            while($row = $reslut->fetch_assoc()){
                ?>
                    <div class="item_sp">
                        <img src="../img/<?php echo $row['img_sp']?>" alt="" width="40px" height="40px">
                        <div class="thongso">
                            <p class="tensp" id="tensp_<?php echo $row['id_sp']?>"><?php echo $row['ten_sp']?></p>
                            <p class="giasp" id="gia_sp_<?php echo $row['id_sp']?>"><?php echo number_format($row['gia_ban'], 0, '', ',') . " Đ"?></p>
                        </div>
                        <button class="btn_chon" onclick="chonsanpham_thanhtoan(<?php echo $row['id_sp']?>)">Chọn</button>
                    </div>
                <?php
            }
        }
    }
?>