<?php
    session_start();
	/*xoa bo loc*/
    if(isset($_GET['boloc']) && $_GET['boloc'] == 'all'){
        unset($_SESSION['ma_th']);
        unset($_SESSION['gia']);
        unset($_SESSION['khuyenmai']);
        unset($_SESSION['sosao']);
        unset($_SESSION['sapxep']);
        header("Location: noidung_loaisp.php?lsp=".$_SESSION['lsp']."");

    }
    if(isset($_GET['boloc']) && $_GET['boloc'] == 'th'){
        unset($_SESSION['ma_th']);
        header("Location: loc_sp.php?lsp=".$_SESSION['lsp']."");
    }
    if(isset($_GET['boloc']) && $_GET['boloc'] == 'gia'){
        unset($_SESSION['gia']);
    }
    if(isset($_GET['boloc']) && $_GET['boloc'] == 'khuyenmai'){
        unset($_SESSION['khuyenmai']);
    }
    if(isset($_GET['boloc']) && $_GET['boloc'] == 'sosao'){
        unset($_SESSION['sosao']);
    }    
    if(isset($_GET['boloc']) && $_GET['boloc'] == 'sapxep'){
        unset($_SESSION['sapxep']);
    }


    // header("Location: index.php");
    //header("Location: loc_sp.php?lsp=".$_SESSION['lsp']."");
    header(
        "Location: loc_sp.php?"
            .(isset($_SESSION['lsp']) ? "lsp=".$_SESSION['lsp'] : "")
            .(isset($_SESSION['ma_th']) ? "&ma_th=". $_SESSION['ma_th'] : "") 
            . (isset($_SESSION['gia']) ? "&gia=".$_SESSION['gia'] : "")
            .(isset($_SESSION['khuyenmai']) ? "&khuyenmai=".$_SESSION['khuyenmai'] : "")
            .(isset($_SESSION['sosao']) ? "&sosao=".$_SESSION['sosao'] : "")
            .(isset($_SESSION['sapxep']) ? "&sapxep=".$_SESSION['sapxep'] : "")
        .""
    );
?>

