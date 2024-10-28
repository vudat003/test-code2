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
    $slsp = $_POST['sl'];
    $sosao = 0;
    $danhgia = 0;
    $khuyenmai = $_POST['khuyenmai'];
    $giaitrikhuyenmai = $_POST['giatrikhuyenmai'];
    session_start();
    if($anhsp == './img_sp/'){
        $anhsp = $_SESSION['img_sp'];
    }

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
    $idsp = $_SESSION['idsp'];
    include '/ThucTapCS/connection/connection.php';
    $sql= "UPDATE sanpham set
        ma_loaisp = '".$maloaisp."',
        id_th = '".$idth."', 
        ten_sp = '".$tensp."',
        gia_sp = '".$gia."',
        gia_ban = '".$gia_ban."',
        img_sp = '".$anhsp."',
        mausac = '".$mausac."',
        sl_sp = '".$slsp."',
        sosao = '".$sosao."',
        danhgia = '".$danhgia."',
        khuyenmai = '".$khuyenmai."',
        giatrikhuyenmai = '".$giaitrikhuyenmai."',
        ngay_tao = '".$_SESSION['ngay_tao']."',
        ngay_update = null,
        trangthaisp = '1'
        where id_sp = '".$idsp."'
        ";
    $con->query($sql);
    // echo $sql;
    $sql_tskt = "UPDATE thongsokithuat set
        ma_loaisp = '".$maloaisp."',
        manhinh = '".$manhinh."',
        hedieuhanh = '".$hedieuhanh."',
        camera_truoc = '".$camera_truoc."',
        camera_sau = '".$camera_sau."',
        cpu = '".$cpu."',
        ram = '".$ram."',
        bonhotrong = '".$bonhotrong."',
        sim = '".$sim."',
        dungluongpin = '".$dungluongpin."',
        o_cung = '".$o_cung."',
        card_manhinh = '".$card_manhinh."',
        congketnoi = '".$congketnoi."',
        thietke = '".$thietke."',
        kichthuoc = '".$kichthuoc."',
        thoidiemramat = '".$thoidiemramat."',
        ketnoimang = '".$ketnoimang."',
        hotrosim = '".$hotrosim."',
        congnghemanhinh = '".$congnghemanhinh."',
        kichthuocmanhinh = '".$kichthuocmanhinh."',
        thoigiansudungpin = '".$thoigiansudungpin."',
        ketnoivoihedieuhanh = '".$ketnoivoihedieuhanh."',
        chatlieumat = '".$chatlieumat."',
        duongkinhmat = '".$duongkinhhmat."',
        ketnoi = '".$ketnoi."',
        ngonngu = '".$ngonngu."',
        theodoisuckhoe = '".$theodoi."'
        where id_sp = '".$idsp."'
        ";

    echo $sql_tskt;
    $con->query($sql_tskt);

    header("Location: sua_sp.php?id=".$idsp."");
    $con->close();
?>