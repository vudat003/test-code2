<div id="noidung">
    <?php
        include 'connection/connection.php';
        $sql = "SELECT * from sanpham sp, loaisp lsp 
            where sp.ma_loaisp = lsp.ma_loaisp
        group by sp.ma_loaisp";
        $result = $con->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $loaisp = "SELECT * from sanpham sp, loaisp lsp 
                            where sp.ma_loaisp = '".$row['ma_loaisp']."' and sp.ma_loaisp = lsp.ma_loaisp and sl_sp > 0 
                            GROUP by sp.ten_sp
                            order by sp.id_sp
                            limit 0, 10
                        ";
                $result_lsp = $con->query($loaisp);
                if($result_lsp->num_rows > 0){
                    echo "<div id='dienthoai'>
                                <div class='tieude'>
                                    <h2><i class='fas fa-angle-double-right'></i>".$row['ten_loaisp']."</h2>
                                    <a href='noidung_loaisp.php?lsp=".$row['ma_loaisp']."'>Xem tất cả <i class='fas fa-angle-double-right'></i></a>
                                </div>
                                <div class='danhsachsanpham'>";
                    while($row1 = $result_lsp->fetch_assoc()){
                            $gia_goc = number_format($row1['gia_ban'], 0, '', ',');
                            $gia_giam = number_format($row1['gia_ban']- $row1['giatrikhuyenmai'], 0, '', ',');
                            echo "
                                <div class='sanpham'>
                                    <a href='chitietsanpham.php?idsp=".$row1['id_sp']."'>";
                                if($row1['khuyenmai'] == "Trả góp"){
                                    echo "<p class='tragop'>Trả góp ".$row1['giatrikhuyenmai']." %</p>";
                                }else if($row1['khuyenmai'] == "Giảm giá"){
                                    echo "<p class='gg'>Giảm: -".number_format($row1['giatrikhuyenmai'], 0, '', ',')."</p>";
                                }else if($row1['khuyenmai'] == "Mới ra mắt"){
                                    echo "<p class='moi'>Mới ra mắt</p>";
                                }else{
                                    echo "<p class='khong'></p>";
                                }
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
                    echo "Không có sản phẩm";
                }
            }
        }else{

        }
    ?>
</div>