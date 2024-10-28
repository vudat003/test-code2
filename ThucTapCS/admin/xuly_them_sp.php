<?php
    $maloaisp = $_POST['maloaisp'];
    $idth = $_POST['idth'];
    $tensp = $_POST['tensp'];
    $gia = $_POST['gia_sp'];
    $gia_ban = $_POST['gia_ban'];
    $anhsp = './img_sp/'.$_FILES['logo']['name'];
    move_uploaded_file($_FILES['logo']['tmp_name'], "../img/".$anhsp);
    $mausac = $_POST['mausac'];
    $slsp = $_POST['sl'];
    $sosao = 0;
    $danhgia = 0;
    $khuyenmai = $_POST['khuyenmai'];
    $giaitrikhuyenmai = $_POST['giatrikhuyenmai'];
    // $cpu = $_POST['cpu'];
    // $ram = $_POST['ram'];
    // $o_cung = $_POST['ocung'];
    // $manhinh = $_POST['manhinh'];
    // $card_manhinh = $_POST['cardmanhinh'];
    // $congketnoi = $_POST['congketnoi'];
    // $hedieuhanh = $_POST['hedieuhanh'];
    // $thietke = $_POST['thietke'];
    // $kichthuoc = $_POST['kichthuoc'];
    // $thoidiemramat = $_POST['thoidiemramat'];
    // $bonhotrong = $_POST['bonhotrong'];
    // $camera_sau = $_POST['camerasau'];
    // $camera_truoc = $_POST['cameratruoc'];
    // $ketnoimang = $_POST['ketnoimang'];
    // $hotrosim = $_POST['hotrosim'];
    // $congnghemanhinh = $_POST['congnghemanhinh'];
    // $kichthuocmanhinh = $_POST['kichthuocmanhinh'];
    // $thoigiansudungpin = $_POST['thoigiansudungpin'];
    // $ketnoivoihedieuhanh = $_POST['ketnoivoihedieuhanh'];
    // $chatlieumat = $_POST['chatlieumat'];
    // $duongkinhhmat = $_POST['duongkinhmat'];
    // $ketnoi = $_POST['ketnoi'];
    // $ngonngu = $_POST['ngonngu'];
    // $theodoi = $_POST['theodoisuckhoe'];
    // $sim = $_POST['sim'];
    // $dungluongpin = $_POST['dungluongpin'];
    $cpu = "";
    $ram = "";
    $o_cung = "";
    $manhinh = "";
    $card_manhinh = "";
    $congketnoi = "";
    $hedieuhanh = "";
    $thietke = "";
    $kichthuoc = "";
    $thoidiemramat = "";
    $bonhotrong = "";
    $camera_sau = "";
    $camera_truoc = "";
    $ketnoimang = "";
    $hotrosim = "";
    $congnghemanhinh = "";
    $kichthuocmanhinh = "";
    $thoigiansudungpin = "";
    $ketnoivoihedieuhanh = "";
    $chatlieumat = "";
    $duongkinhhmat = "";
    $ketnoi = "";
    $ngonngu = "";
    $theodoi = "";
    $sim = "";
    $dungluongpin = "";
    if($maloaisp == 'ĐT'){
        $manhinh = $_POST['DT_manhinh'];
        $hedieuhanh = $_POST['DT_hedieuhanh'];
        $camera_truoc = $_POST['DT_cameratruoc'];
        $camera_sau = $_POST['DT_camerasau'];
        $cpu = $_POST['DT_cpu'];
        $ram = $_POST['DT_ram'];
        $bonhotrong = $_POST['DT_bonhotrong'];
        $sim = $_POST['DT_sim'];
        $dungluongpin = $_POST['DT_dungluongpin'];
    }else if($maloaisp == 'ĐHTM'){
        $congnghemanhinh = $_POST['DHTM_congnghemanhinh'];
        $kichthuocmanhinh = $_POST['DHTM_kichthuocmanhinh'];
        $thoigiansudungpin = $_POST['DHTM_thoigiansudungpin'];
        $hedieuhanh = $_POST['DHTM_hedieuhanh'];
        $ketnoivoihedieuhanh = $_POST['DHTM_ketnoivoihedieuhanh'];
        $chatlieumat = $_POST['DHTM_chatlieumat'];
        $duongkinhhmat = $_POST['DHTM_duongkinhmat'];
        $ketnoi = $_POST['DHTM_ketnoi'];
        $ngonngu = $_POST['DHTM_ngonngu'];
        $theodoi = $_POST['DHTM_theodoisuckhoe'];
    }else if($maloaisp == 'MTB'){
        $manhinh = $_POST['MTB_manhinh'];
        $hedieuhanh = $_POST['MTB_hedieuhanh'];
        $cpu = $_POST['MTB_cpu'];
        $ram = $_POST['MTB_ram'];
        $bonhotrong = $_POST['MTB_bonhotrong'];
        $camera_truoc = $_POST['MTB_cameratruoc'];
        $camera_sau = $_POST['MTB_camerasau'];
        $ketnoimang = $_POST['MTB_ketnoimang'];
        $hotrosim = $_POST['MTB_hotrosim'];
    }else if($maloaisp == 'LT'){
        $cpu = $_POST['LT_cpu'];
        $ram = $_POST['LT_ram'];
        $o_cung = $_POST['LT_ocung'];
        $manhinh = $_POST['LT_manhinh'];
        $card_manhinh = $_POST['LT_cardmanhinh'];
        $congketnoi = $_POST['LT_congketnoi'];
        $hedieuhanh = $_POST['LT_hedieuhanh'];
        $thietke = $_POST['LT_thietke'];
        $kichthuoc = $_POST['LT_kichthuoc'];
        $thoidiemramat = $_POST['LT_thoidiemramat'];
    }

    //ket noi database
    include '../connection/connection.php';
    $sql = "INSERT into sanpham value (null, 
        '".$maloaisp."', 
        '".$idth."',
        '".$tensp."', 
        '".$gia."', 
        '".$gia_ban."', 
        '".$anhsp."',
        '".$mausac."',
        '".$slsp."',
        '".$sosao."',
        '".$danhgia."',
        '".$khuyenmai."',
        '".$giaitrikhuyenmai."',
         null, null, '1')";
    $con->query($sql);
    //Tim id lon nhat là id sau cùng để cập nhật id trong thông số kỉ thuật
    $sql_find_id = "SELECT id_sp FROM sanpham  ORDER BY id_sp DESC  LIMIT 1";
    $result = $con->query($sql_find_id);
    $row_id = $result->fetch_assoc();
    $id_sp_tskt = $row_id['id_sp'];
    $sql_tskt = "INSERT into thongsokithuat value (
        '".$id_sp_tskt."',
        '".$maloaisp."',
        '".$manhinh."',
        '".$hedieuhanh."',
        '".$camera_truoc."',
        '".$camera_sau."',
        '".$cpu."',
        '".$ram."',
        '".$bonhotrong."',
        '".$sim."',
        '".$dungluongpin."',
        '".$o_cung."',
        '".$card_manhinh."',
        '".$congketnoi."',
        '".$thietke."',
        '".$kichthuoc."',
        '".$thoidiemramat."',
        '".$ketnoimang."',
        '".$hotrosim."',
        '".$congnghemanhinh."',
        '".$kichthuocmanhinh."',
        '".$thoigiansudungpin."',
        '".$ketnoivoihedieuhanh."',
        '".$chatlieumat."',
        '".$duongkinhhmat."',
        '".$ketnoi."',
        '".$ngonngu."',
        '".$theodoi."')";
    $con->query($sql_tskt);
    header("Location: them_sp.php");
    $con->close();
?>