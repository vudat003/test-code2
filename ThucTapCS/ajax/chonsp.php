<?php
    include '/ThucTapCS/connection/connection.php';
    $idsp = $_GET['idsp'];

    //kiem tra có tồn tại sản phẩm đó hay chưa
    $sql_check_contain = "SELECT * from thanhtoan_tam where idsp like '%".$idsp."%'";
    $result_check_contain = $con->query($sql_check_contain);
    if($result_check_contain->num_rows > 0){
        $row_check_contain = $result_check_contain->fetch_assoc();
        $sl_sp_capnhat = $row_check_contain['sl_sp'] + 1;
        $sql_update_soluong = "UPDATE thanhtoan_tam set sl_sp = ".$sl_sp_capnhat." where idsp = ".$idsp."";
        $con->query($sql_update_soluong);
    }else{
        $sl_sp = 1;
        //lay gia ban cua san pham
        $sql_getgiaban = "SELECT gia_ban, giatrikhuyenmai from sanpham where id_sp = ".$idsp."";
        $result_getgiaban = $con->query($sql_getgiaban);
        $row_getgiaban = $result_getgiaban->fetch_assoc();
        $sql = "INSERT INTO `thanhtoan_tam` (`idsp`, `sl_sp`, `dongia_sp`, `khuyenmai`) VALUES ('$idsp', '$sl_sp', '".$row_getgiaban['gia_ban']."', '".$row_getgiaban['giatrikhuyenmai']."')";
        $con->query($sql);
    }

    $stt = 1;
    $tongcong = 0;
    $sql_thanhtoan_tam = "SELECT * from thanhtoan_tam";
    $result_thanhtoan_tam  = $con->query($sql_thanhtoan_tam);
    if($result_thanhtoan_tam->num_rows > 0){
        echo "
            <tr>
                <td>STT</td>
                <td>Mã SP</td>
                <td>Tên sản phẩm</td>
                <td>số lượng</td>
                <td>Đơn giá</td>
                <td>Khuyến mãi</td>
                <td>Thành tiền</td>
                <td>Xoá</td>
            </tr>";
        while($row_thanhtoan_tam = $result_thanhtoan_tam->fetch_assoc()){
            $sql_show = "SELECT sp.id_sp, sp.ten_sp, ttt.dongia_sp, ttt.sl_sp, sp.giatrikhuyenmai from sanpham sp, thanhtoan_tam ttt where sp.id_sp = ".$row_thanhtoan_tam['idsp']." and sp.id_sp = ttt.idsp";
            $result = $con->query($sql_show);
            $row = $result->fetch_assoc();
            $tongcong = $tongcong + $row['dongia_sp']*$row['sl_sp'];
            echo "
                <tr>
                    <td>".$stt++."</td>
                    <td>".$row['id_sp']."</td>
                    <td>".$row['ten_sp']."</td>
                    <td>".$row['sl_sp']."</td>";
                echo "
                    <td width='100px'>".number_format($row['dongia_sp'], 0, '', ',')." Đ</td>";
                    if($row['giatrikhuyenmai'] != 0){
                        echo"<td td width='100px'>".number_format($row['giatrikhuyenmai'], 0, '', ',')." Đ</td>";
                    }else{
                        echo"<td></td>";
                    }
                echo "
                    <td td width='120px'>".number_format(($row['dongia_sp']-$row['giatrikhuyenmai'])*$row['sl_sp'], 0, '', ',')." Đ</td>
                    <td><button onclick='xoasanpham_thanhtoan(".$row['id_sp'].")'><img src='../img/delete.png'  width='20px' height='20px'><button></td>
                </tr>
            ";
        }
    }else{
        echo "
            <tr>
                <td>STT</td>
                <td>Mã SP</td>
                <td>Tên sản phẩm</td>
                <td>số lượng</td>
                <td>Đơn giá</td>
                <td>Khuyến mãi</td>
                <td>Thành tiền</td>
                <td>Xoá</td>
            </tr>";

    }
    echo   "<tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Tổng cộng   </td>
        <td>".number_format($tongcong, 0, '', ',')." Đ</td>
    </tr>"
?>