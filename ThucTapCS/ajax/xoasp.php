<?php
    include '/ThucTapCS/connection/connection.php';
    $idsp = $_GET['idsp'];

    //Xoa sản phẩm
    $sql = "DELETE FROM thanhtoan_tam where idsp = ".$idsp."";
    $con->query($sql);


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
                <td>Thành tiền</td>
                <td>Xoá</td>
            </tr>";
        while($row_thanhtoan_tam = $result_thanhtoan_tam->fetch_assoc()){
            $sql_show = "SELECT sp.id_sp, sp.ten_sp, sp.gia_ban, ttt.sl_sp from sanpham sp, thanhtoan_tam ttt where sp.id_sp = ".$row_thanhtoan_tam['idsp']." and sp.id_sp = ttt.idsp";
            $result = $con->query($sql_show);
            $row = $result->fetch_assoc();
            $tongcong = $tongcong + $row['gia_ban']*$row['sl_sp'];
            echo "
                <tr>
                    <td>".$stt++."</td>
                    <td>".$row['id_sp']."</td>
                    <td>".$row['ten_sp']."</td>
                    <td>".$row['sl_sp']."</td>
                    <td>".number_format($row['gia_ban'], 0, '', ',')."</td>
                    <td>".number_format($row['gia_ban']*$row['sl_sp'], 0, '', ',')."</td>
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
                <td>Thành tiền</td>
                <td>Xoá</td>
            </tr>";

    }
    echo   "<tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Tổng cộng   </td>
        <td>".number_format($tongcong, 0, '', ',')."</td>
    </tr>"
?>