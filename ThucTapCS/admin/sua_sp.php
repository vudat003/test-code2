<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm</title>
    <link rel = "icon" href =  
    "../img/logo/logo_in.png" 
    type = "image/x-icon"> 
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/them_lsp_th_sp.css">
    <link rel="stylesheet" href="../css/danhsach_lsp_th_sp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>
<body>
    <?php
        session_start();
        include 'tieude.php';
    ?>
    <div id="content">
        <?php
            include 'menu_trai.php';
        ?>
        <div id="noidungchinh">
        <h2>Chỉnh sửa sản phẩm</h2>
            <div id="themloaisp">
                <form action="xuly_sua_sp.php" method="POST" enctype="multipart/form-data">
                <?php
                    $idsp = $_GET['id'];
                    $_SESSION['idsp'] = $idsp;
                    include '../connection/connection.php';
                    $sql = "SELECT * from sanpham sp, thuonghieu th, loaisp lsp, thongsokithuat tskt
                            WHERE sp.id_sp = ".$idsp."
                            and sp.id_th = th.id_th and sp.ma_loaisp = lsp.ma_loaisp and sp.id_sp = tskt.id_sp";
                    $result = $con->query($sql);
                    $row  = $result->fetch_assoc();
                    $ma_loaisp = $row['ma_loaisp'];
                    $_SESSION['img_sp'] = $row['img_sp'];
                    $_SESSION['ngay_tao'] = $row['ngay_tao'];
                ?>
                    <table>
                        <tr>
                            <td>Tên loại sản phẩm: </td>
                            <td>
                                <select name="maloaisp" onchange="thuonghieu(this.value); showTSKT(this.value);">
                                <?php echo " <option value='".$row['ma_loaisp']."'>".$row['ten_loaisp']."</option>"; ?>
                                    <?php
                                        $sql1 = "SELECT * from loaisp";
                                        $result1 = $con->query($sql1);
                                        if($result1->num_rows > 0){
                                            while($row1 = $result1->fetch_assoc()){
                                                echo " <option value='".$row1['ma_loaisp']."'>".$row1['ten_loaisp']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Tên thương hiệu: </td>
                            <td>
                                <select name="idth" id="showthuonghieu">
                                   <?php echo " <option value='".$row['id_th']."'>".$row['ten_tenth']."</option>"; ?>
                                    <?php
                                        $sql2 = "SELECT * from thuonghieu where ma_loaisp = 'LT'";
                                        $result2 = $con->query($sql2);
                                        if($result2->num_rows > 0){
                                            while($row2 = $result2->fetch_assoc()){
                                                echo " <option value='".$row2['id_th']."'>".$row2['ten_tenth']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </td>                    
                        </tr>
                        <tr>
                            <td>Tên sản phẩm: </td>
                            <td><input type="text" name="tensp" placeholder="Tên sản phẩm" value="<?php echo $row['ten_sp']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Giá sản phẩm: </td>
                            <td><input type="text" name="gia_sp" placeholder="Giá sản phẩm" onkeyup="giasp(this.value)" value="<?php echo $row['gia_sp']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Định dạng giá: </td>
                            <td><p id="gia"><?php echo number_format($row['gia_sp'], 0, '', ','); ?></p></td>
                        </tr>
                        <tr>
                            <td>Giá bán: </td>
                            <td><input type="text" name="gia_ban" id="gia_ban" placeholder="Giá bán" onkeyup="giasp_ban(this.value)"  value="<?php echo $row['gia_ban']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Định dạng giá bán: </td>
                            <td><p id="gia_ban"><?php echo number_format($row['gia_ban'], 0, '', ','); ?></p></td>
                        </tr>
                        <tr>
                            <td>Hình ảnh SP:</td>
                            <td><input type="file" name="logo" placeholder="Logo"></td>
                        </tr>
                        <tr>
                            <td>Số lượng:</td>
                            <td><input type="text" name="sl" placeholder="Nhập số lượng" value="<?php echo $row['sl_sp']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Màu sắc:</td>
                            <td><input type="text" name="mausac" placeholder="" value="<?php echo $row['mausac']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Khuyến mãi:</td>
                            <td>
                                <select name="khuyenmai" id="khuyenmai">
                                    <option value="<?php echo $row['khuyenmai']; ?>"><?php echo $row['khuyenmai']; ?></option>
                                    <option value="Không">Không</option>
                                    <option value="Trả góp">Trả góp</option>
                                    <option value="Giảm giá">Giảm giá</option>
                                    <option value="Mới ra mắt">Mới ra măt</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Giá trị khuyến mãi</td>
                            <td><input type="text" name="giatrikhuyenmai" placeholder="" value="<?php echo $row['giatrikhuyenmai']; ?>"></td>
                        </tr>
                        <!-- <?php
                            if($ma_loaisp == 'ĐT'){
                                ?>
                                    <tbody id="maloaisp">
                                        <tr>
                                            <td>Màn hình:</td>
                                            <td><input type="text" name="DT_manhinh"  value="<?php echo $row['manhinh']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Hệ điều hành:</td>
                                            <td><input type="text" name="DT_hedieuhanh" placeholder="" value="<?php echo $row['hedieuhanh']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Camera sau:</td>
                                            <td><input type="text" name="DT_camerasau" placeholder="" value="<?php echo $row['camera_sau']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Camera trước:</td>
                                            <td><input type="text" name="DT_cameratruoc" placeholder="" value="<?php echo $row['camera_truoc']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>CPU:</td>
                                            <td><input type="text" name="DT_cpu" placeholder="" value="<?php echo $row['cpu']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>RAM:</td>
                                            <td><input type="text" name="DT_ram" placeholder="" value="<?php echo $row['ram']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Bộ nhớ trong:</td>
                                            <td><input type="text" name="DT_bonhotrong" placeholder="" value="<?php echo $row['bonhotrong']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Sim:</td>
                                            <td><input type="text" name="DT_sim" placeholder="" value="<?php echo $row['sim']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Dung lượng pin:</td>
                                            <td><input type="text" name="DT_dungluongpin" placeholder="" value="<?php echo $row['dungluongpin']; ?>"></td>
                                        </tr>
                                    </tbody>
                                <?php
                            }else if($ma_loaisp == 'ĐHTM'){
                                ?>
                                    <tbody  id="maloaisp">
                                        <tr>
                                            <td>Công nghệ màn hình: </td>
                                            <td><input type="text" name="DHTM_congnghemanhinh" value="<?php echo $row['congnghemanhinh']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Kích thước màn hình: </td>
                                            <td><input type="text" name="DHTM_kichthuocmanhinh" value="<?php echo $row['kichthuocmanhinh']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Thời gian sử dung pin: </td>
                                            <td><input type="text" name="DHTM_thoigiansudungpin" value="<?php echo $row['thoigiansudungpin']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Hệ điều hành:</td>
                                            <td><input type="text" name="DHTM_hedieuhanh" value="<?php echo $row['hedieuhanh']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Kết nối với HĐH:</td>
                                            <td><input type="text" name="DHTM_ketnoivoihedieuhanh" value="<?php echo $row['ketnoivoihedieuhanh']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Chất liệu mặt:</td>
                                            <td><input type="text" name="DHTM_chatlieumat" value="<?php echo $row['chatlieumat']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Đường kính mặt:</td>
                                            <td><input type="text" name="DHTM_duongkinhmat" value="<?php echo $row['duongkinhmat']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Kết nối:</td>
                                            <td><input type="text" name="DHTM_ketnoi" value="<?php echo $row['ketnoi']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Ngôn ngữ: </td>
                                            <td><input type="text" name="DHTM_ngonngu" value="<?php echo $row['ngonngu']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Theo dõi sức khỏe: </td>
                                            <td><input type="text" name="DHTM_theodoisuckhoe" value="<?php echo $row['theodoisuckhoe']; ?>"></td>
                                        </tr>
                                    </tbody>
                                <?php
                            }else if($ma_loaisp == 'LT'){
                                ?>
                                    <tbody  id="maloaisp">
                                        <tr>
                                            <td>CPU: </td>
                                            <td><input type="text" name="LT_cpu" placeholder="" value="<?php echo $row['cpu']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>RAM: </td>
                                            <td><input type="text" name="LT_ram" placeholder="" value="<?php echo $row['ram']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Ổ cứng: </td>
                                            <td><input type="text" name="LT_ocung" placeholder="" value="<?php echo $row['o_cung']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Màn hình:</td>
                                            <td><input type="text" name="LT_manhinh" placeholder="" value="<?php echo $row['manhinh']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Card màn hình:</td>
                                            <td><input type="text" name="LT_cardmanhinh" placeholder="" value="<?php echo $row['card_manhinh']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Cổng kết nối:</td>
                                            <td><input type="text" name="LT_congketnoi" placeholder="" value="<?php echo $row['congketnoi']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Hệ điều hành:</td>
                                            <td><input type="text" name="LT_hedieuhanh" placeholder="" value="<?php echo $row['hedieuhanh']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Thiết kế:</td>
                                            <td><input type="text" name="LT_thietke" placeholder="" value="<?php echo $row['thietke']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Kích thước: </td>
                                            <td><input type="text" name="LT_kichthuoc" placeholder="" value="<?php echo $row['kichthuoc']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Thời điểm ra mắt: </td>
                                            <td><input type="text" name="LT_thoidiemramat" placeholder="" value="<?php echo $row['thoidiemramat']; ?>"></td>
                                        </tr>
                                    </tbody>
                                <?php
                            }else if($ma_loaisp == 'MTB'){
                                ?>
                                    <tbody  id="maloaisp">
                                        <tr>
                                            <td>Màn hình:</td>
                                            <td><input type="text" name="MTB_manhinh" placeholder="" value="<?php echo $row['manhinh']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Hệ điều hành: </td>
                                            <td><input type="text" name="MTB_hedieuhanh" placeholder="" value="<?php echo $row['hedieuhanh']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>CPU: </td>
                                            <td><input type="text" name="MTB_cpu" placeholder="" value="<?php echo $row['cpu']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>RAM:</td>
                                            <td><input type="text" name="MTB_ram" placeholder="" value="<?php echo $row['ram']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Bộ nhớ trong:</td>
                                            <td><input type="text" name="MTB_bonhotrong" placeholder="" value="<?php echo $row['bonhotrong']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Camera sau:</td>
                                            <td><input type="text" name="MTB_camerasau" placeholder="" value="<?php echo $row['camera_sau']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Camera trước:</td>
                                            <td><input type="text" name="MTB_cameratruoc" placeholder="" value="<?php echo $row['camera_truoc']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Kết nối mạng:</td>
                                            <td><input type="text" name="MTB_ketnoimang" placeholder="" value="<?php echo $row['ketnoimang']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Hộ trợ sim: </td>
                                            <td><input type="text" name="MTB_hotrosim" placeholder="" value="<?php echo $row['hotrosim']; ?>"></td>
                                        </tr>
                                    </tbody>
                                <?php
                            }
                        ?> -->
                        <tbody id="dienthoai">
                            <tr>
                                <td>Màn hình:</td>
                                <td><input type="text" name="DT_manhinh"  value="<?php echo $row['manhinh']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Hệ điều hành:</td>
                                <td><input type="text" name="DT_hedieuhanh" placeholder="" value="<?php echo $row['hedieuhanh']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Camera sau:</td>
                                <td><input type="text" name="DT_camerasau" placeholder="" value="<?php echo $row['camera_sau']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Camera trước:</td>
                                <td><input type="text" name="DT_cameratruoc" placeholder="" value="<?php echo $row['camera_truoc']; ?>"></td>
                            </tr>
                            <tr>
                                <td>CPU:</td>
                                <td><input type="text" name="DT_cpu" placeholder="" value="<?php echo $row['cpu']; ?>"></td>
                            </tr>
                            <tr>
                                <td>RAM:</td>
                                <td><input type="text" name="DT_ram" placeholder="" value="<?php echo $row['ram']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Bộ nhớ trong:</td>
                                <td><input type="text" name="DT_bonhotrong" placeholder="" value="<?php echo $row['bonhotrong']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Sim:</td>
                                <td><input type="text" name="DT_sim" placeholder="" value="<?php echo $row['sim']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Dung lượng pin:</td>
                                <td><input type="text" name="DT_dungluongpin" placeholder="" value="<?php echo $row['dungluongpin']; ?>"></td>
                            </tr>
                        </tbody>
                        <tbody  id="donghothongminh">
                            <tr>
                                <td>Công nghệ màn hình: </td>
                                <td><input type="text" name="DHTM_congnghemanhinh" value="<?php echo $row['congnghemanhinh']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Kích thước màn hình: </td>
                                <td><input type="text" name="DHTM_kichthuocmanhinh" value="<?php echo $row['kichthuocmanhinh']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Thời gian sử dung pin: </td>
                                <td><input type="text" name="DHTM_thoigiansudungpin" value="<?php echo $row['thoigiansudungpin']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Hệ điều hành:</td>
                                <td><input type="text" name="DHTM_hedieuhanh" value="<?php echo $row['hedieuhanh']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Kết nối với HĐH:</td>
                                <td><input type="text" name="DHTM_ketnoivoihedieuhanh" value="<?php echo $row['ketnoivoihedieuhanh']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Chất liệu mặt:</td>
                                <td><input type="text" name="DHTM_chatlieumat" value="<?php echo $row['chatlieumat']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Đường kính mặt:</td>
                                <td><input type="text" name="DHTM_duongkinhmat" value="<?php echo $row['duongkinhmat']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Kết nối:</td>
                                <td><input type="text" name="DHTM_ketnoi" value="<?php echo $row['ketnoi']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Ngôn ngữ: </td>
                                <td><input type="text" name="DHTM_ngonngu" value="<?php echo $row['ngonngu']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Theo dõi sức khỏe: </td>
                                <td><input type="text" name="DHTM_theodoisuckhoe" value="<?php echo $row['theodoisuckhoe']; ?>"></td>
                            </tr>
                        </tbody>
                        <tbody  id="laptop">
                            <tr>
                                <td>CPU: </td>
                                <td><input type="text" name="LT_cpu" placeholder="" value="<?php echo $row['cpu']; ?>"></td>
                            </tr>
                            <tr>
                                <td>RAM: </td>
                                <td><input type="text" name="LT_ram" placeholder="" value="<?php echo $row['ram']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Ổ cứng: </td>
                                <td><input type="text" name="LT_ocung" placeholder="" value="<?php echo $row['o_cung']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Màn hình:</td>
                                <td><input type="text" name="LT_manhinh" placeholder="" value="<?php echo $row['manhinh']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Card màn hình:</td>
                                <td><input type="text" name="LT_cardmanhinh" placeholder="" value="<?php echo $row['card_manhinh']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Cổng kết nối:</td>
                                <td><input type="text" name="LT_congketnoi" placeholder="" value="<?php echo $row['congketnoi']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Hệ điều hành:</td>
                                <td><input type="text" name="LT_hedieuhanh" placeholder="" value="<?php echo $row['hedieuhanh']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Thiết kế:</td>
                                <td><input type="text" name="LT_thietke" placeholder="" value="<?php echo $row['thietke']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Kích thước: </td>
                                <td><input type="text" name="LT_kichthuoc" placeholder="" value="<?php echo $row['kichthuoc']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Thời điểm ra mắt: </td>
                                <td><input type="text" name="LT_thoidiemramat" placeholder="" value="<?php echo $row['thoidiemramat']; ?>"></td>
                            </tr>
                        </tbody>
                        <tbody  id="maytinhbang">
                            <tr>
                                <td>Màn hình:</td>
                                <td><input type="text" name="MTB_manhinh" placeholder="" value="<?php echo $row['manhinh']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Hệ điều hành: </td>
                                <td><input type="text" name="MTB_hedieuhanh" placeholder="" value="<?php echo $row['hedieuhanh']; ?>"></td>
                            </tr>
                            <tr>
                                <td>CPU: </td>
                                <td><input type="text" name="MTB_cpu" placeholder="" value="<?php echo $row['cpu']; ?>"></td>
                            </tr>
                            <tr>
                                <td>RAM:</td>
                                <td><input type="text" name="MTB_ram" placeholder="" value="<?php echo $row['ram']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Bộ nhớ trong:</td>
                                <td><input type="text" name="MTB_bonhotrong" placeholder="" value="<?php echo $row['bonhotrong']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Camera sau:</td>
                                <td><input type="text" name="MTB_camerasau" placeholder="" value="<?php echo $row['camera_sau']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Camera trước:</td>
                                <td><input type="text" name="MTB_cameratruoc" placeholder="" value="<?php echo $row['camera_truoc']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Kết nối mạng:</td>
                                <td><input type="text" name="MTB_ketnoimang" placeholder="" value="<?php echo $row['ketnoimang']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Hộ trợ sim: </td>
                                <td><input type="text" name="MTB_hotrosim" placeholder="" value="<?php echo $row['hotrosim']; ?>"></td>
                            </tr>
                        </tbody>
                        <tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Sửa">
                                <input type="reset" value="Reset">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <hr>
            <div id="danhsach">
            <h2>Danh sách loại sản phẩm</h2>
                <table border="1">
                <tr>
                    <th rowspan="2">STT</th>
                    <th rowspan="2">id_sp</th>
                    <th rowspan="2" >Tên sản phẩm</th>
                    <th rowspan="2">Ảnh sản phẩm</th>
                    <th rowspan="2">Màu sắc</th>
                    <th rowspan="2">Giá</th>
                    <th rowspan="2">SL</th>
                    <th rowspan="2">Khuyến mãi</th>
                    <th rowspan="2">Giá trị khuyến mãi</th>
                    <th colspan="2">Cập nhật</th>

                </tr>
                <tr>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            <?php
                $sql = "SELECT * from sanpham where id_sp = '".$idsp."'";
                $result = $con->query($sql);
                $i = 0;
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "
                        <tr>
                            <td>".($i = $i + 1)."</td>
                            <td>".$row['id_sp']."</td>
                            <td>".$row['ten_sp']."</td>
                            <td><img src='../img/".$row['img_sp']."' alt='' width=100px height=100px></td>
                            <td>".$row['mausac']."</td>
                            <td>".number_format($row['gia_sp'], 0, '', ',')."</td>
                            <td>".$row['sl_sp']."</td>
                            <td>".$row['khuyenmai']."</td>
                            <td>".number_format($row['giatrikhuyenmai'], 0, '', ',')."</td>";

                        echo "
                            <td><a href='./sua_sp.php?id=".$row['id_sp']."'><img src='../img/edit.png' alt=''></a></td>
                            <td><a href='./xoa_sp.php?id=".$row['id_sp']."'><img src='../img/delete.png' alt=''></a></td>";
                        echo "
                            </tr>
                        ";
                    }
                }
            ?>
                </table>
            </div>
        </div>
    </div>

    <script>
        function thuonghieu(str) {
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    document.getElementById("showthuonghieu").innerHTML=xmlhttp.responseText; 
                } 
            }   
            xmlhttp.open("GET", "/ajax/showthuonghieu.php?id="+str, true);
            xmlhttp.send();
        }

        function giasp(str) {
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    document.getElementById("gia").innerHTML=xmlhttp.responseText; 
                } 
            }   
            xmlhttp.open("GET", "/ajax/fomatGia.php?gia=" + str, true);
            xmlhttp.send();
        }
        function giasp_ban(str) {
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    document.getElementById("gia_ban").innerHTML=xmlhttp.responseText; 
                } 
            }   
            xmlhttp.open("GET", "../ajax/fomatGia.php?gia=" + str, true);
            xmlhttp.send();
        }

        function showTSKT(str){
            var laptop = document.getElementById('laptop');
            var dienthoai = document.getElementById('dienthoai');
            var maytinhbang = document.getElementById('maytinhbang');
            var donghothongminh =  document.getElementById('donghothongminh');
            // document.getElementById('maloaisp').style.display = 'none';
            if(str == 'LT'){
                laptop.style.display = 'contents';
                dienthoai.style.display = 'none';
                maytinhbang.style.display = 'none';
                donghothongminh.style.display = 'none';
            }
            if(str == 'ĐT'){
                laptop.style.display = 'none';
                dienthoai.style.display = 'contents';
                maytinhbang.style.display = 'none';
                donghothongminh.style.display = 'none';
            }
            if(str == 'MTB'){
                laptop.style.display = 'none';
                dienthoai.style.display = 'none';
                maytinhbang.style.display = 'contents';
                donghothongminh.style.display = 'none';
            }
            if(str == 'ĐHTM'){
                laptop.style.display = 'none';
                dienthoai.style.display = 'none';
                maytinhbang.style.display = 'none';
                donghothongminh.style.display = 'contents';
            }
        }
    </script>
</body>
</html>