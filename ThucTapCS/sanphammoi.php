<div id="noidung">
    <?php  
        include './connection/connection.php';
        $sql = "SELECT * from sanpham where khuyenmai = 'Mới ra mắt' and sl_sp > 0 
                group by ten_sp
                 limit 0, 5";
        $result = $con->query($sql);
        if($result->num_rows > 0){
            echo "<div id='dienthoai'>
                        <div class='tieude moiramat'>
                            <h2><i class='fas fa-angle-double-right'></i>Mới ra mắt</h2>
                        </div>
                        <div class='danhsachsanpham'>";
            while($row1 = $result->fetch_assoc()){
                    $gia_goc = number_format($row1['gia_ban'], 0, '', ',');
                    $gia_giam = number_format($row1['gia_ban']-($row1['giatrikhuyenmai']), 0, '', ',');
                    echo "
                        <div class='sanpham'>
                            <a href='chitietsanpham.php?idsp=".$row1['id_sp']."'>";
                            echo "<p class='moi'>Mới ra mắt</p>";
                    echo "
                                <img src='./img/".$row1['img_sp']."' alt=''>
                                <div class='ttsp'>
                                    <p class='tensp'>".$row1['ten_sp']."</p>
                                    <div class='giamgia_phantram'>
                                        <p class='giamgia'>".$gia_giam."<u>đ</u></p>
                                        <p class='phantramgiam'></p>
                                    </div>
                                    <p class='giagoc'>".$gia_goc."<u>đ</u></p>
                                    <div class='start'>
                        ";
                            for($i = 1; $i <= $row1['sosao']; ++ $i){
                                echo "<i class='fas fa-star'></i>";
                            }
                    echo"
                                        <p class='danhgia'>".$row1['danhgia']." đánh giá</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    ";
                }
            echo "  </div>
            </div>
            ";
        }else{
            echo "";
        }
    ?>
</div>