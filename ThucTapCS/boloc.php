<?php
    //loc du lieu
    if(isset($_GET['lsp'])){
        $lsp = $_GET['lsp'];
        $_SESSION['lsp'] = $lsp;    
    }
    if(isset($_GET['ma_th'])){
        $ma_th = $_GET['ma_th'];
        $_SESSION['ma_th'] = $ma_th;
    }
    if(isset($_GET['gia'])){
        $gia = $_GET['gia'];
        $_SESSION['gia'] = $gia;
    }    
    if(isset($_GET['khuyenmai'])){
        $khuyenmai = $_GET['khuyenmai'];
        $_SESSION['khuyenmai'] = $khuyenmai;
    }
    if(isset($_GET['sosao'])){
        $sosao = $_GET['sosao'];
        $_SESSION['sosao'] = $sosao;
    }
    if(isset($_GET['sapxep'])){
        $sapxep = $_GET['sapxep'];
        $_SESSION['sapxep'] = $sapxep;
    }
    $boloc = "?";
?>


<div class="wrapper">
    <nav class="menu">
        <ul class="clearfix">
            <li>
                <a href="#">Giá tiền  <i class="fas fa-angle-double-right"></i></a>
 
                <ul class="sub-menu">
                    <li><a href="loc_sp.php<?php 
                                    echo $boloc
                                    .(isset($_SESSION['lsp']) ? "lsp=".$lsp : "")
                                    .(isset($_SESSION['ma_th']) ? "&ma_th=".$ma_th : "")
                                    . "&gia=0-2000000"
                                    .(isset($_SESSION['khuyenmai']) ? "&khuyenmai=".$khuyenmai : "")
                                    .(isset($_SESSION['sosao']) ? "&sosao=".$sosao : "")
                                    .(isset($_SESSION['sapxep']) ? "&sapxep=".$sapxep : "")
                                    ;
                                    ?>
                        ">Dưới 2 triệu</a>
                    </li>
                    <li><a href="loc_sp.php<?php 
                                    echo $boloc
                                    .(isset($_SESSION['lsp']) ? "lsp=".$lsp : "")
                                    .(isset($_SESSION['ma_th']) ? "&ma_th=".$ma_th : "")
                                    . "&gia=2000000-4000000"
                                    .(isset($_SESSION['khuyenmai']) ? "&khuyenmai=".$khuyenmai : "")
                                    .(isset($_SESSION['sosao']) ? "&sosao=".$sosao : "")
                                    .(isset($_SESSION['sapxep']) ? "&sapxep=".$sapxep : "")
                                    ;
                                    ?>
                        ">Từ 2 triệu 4</a>
                    </li>
                    <li><a href="loc_sp.php<?php 
                                    echo $boloc
                                    .(isset($_SESSION['lsp']) ? "lsp=".$lsp : "")
                                    .(isset($_SESSION['ma_th']) ? "&ma_th=".$ma_th : "")
                                    . "&gia=4000000-7000000"
                                    .(isset($_SESSION['khuyenmai']) ? "&khuyenmai=".$khuyenmai : "")
                                    .(isset($_SESSION['sosao']) ? "&sosao=".$sosao : "")
                                    .(isset($_SESSION['sapxep']) ? "&sapxep=".$sapxep : "")
                                    ;
                                    ?>
                        ">Từ 4 triệu 7</a>
                    </li>
                    <li><a href="loc_sp.php<?php 
                                    echo $boloc
                                    .(isset($_SESSION['lsp']) ? "lsp=".$lsp : "")
                                    .(isset($_SESSION['ma_th']) ? "&ma_th=".$ma_th : "")
                                    . "&gia=7000000-13000000"
                                    .(isset($_SESSION['khuyenmai']) ? "&khuyenmai=".$khuyenmai : "")
                                    .(isset($_SESSION['sosao']) ? "&sosao=".$sosao : "")
                                    .(isset($_SESSION['sapxep']) ? "&sapxep=".$sapxep : "")
                                    ;
                                    ?>
                        ">Từ 7 triệu 13</a>
                    </li>
                    <li><a href="loc_sp.php<?php 
                                    echo $boloc
                                    .(isset($_SESSION['lsp']) ? "lsp=".$lsp : "")
                                    .(isset($_SESSION['ma_th']) ? "&ma_th=".$ma_th : "")
                                    . "&gia=13000000-0"
                                    .(isset($_SESSION['khuyenmai']) ? "&khuyenmai=".$khuyenmai : "")
                                    .(isset($_SESSION['sosao']) ? "&sosao=".$sosao : "")
                                    .(isset($_SESSION['sapxep']) ? "&sapxep=".$sapxep : "")
                                    ;
                                    ?>
                        ">Trên 13 triệu</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Khuyến mãi  <i class="fas fa-angle-double-right"></i></a>
                <ul class="sub-menu">
                    <li><a href="loc_sp.php<?php
                            echo $boloc .(isset($_SESSION['lsp']) ? "lsp=".$lsp : "")
                            .(isset($_SESSION['ma_th']) ? "&ma_th=".$ma_th : "") 
                            . (isset($_SESSION['gia']) ? "&gia=".$gia : "") 
                            . "&khuyenmai=giamgia"
                            .(isset($_SESSION['sosao']) ? "&sosao=".$sosao : "")
                            .(isset($_SESSION['sapxep']) ? "&sapxep=".$sapxep : "")
                            ;
                            ?>">Giảm giá</a>
                    </li>
                    <li><a href="loc_sp.php<?php
                            echo $boloc .(isset($_SESSION['lsp']) ? "lsp=".$lsp : "")
                            .(isset($_SESSION['ma_th']) ? "&ma_th=".$ma_th : "") 
                            . (isset($_SESSION['gia']) ? "&gia=".$gia : "") 
                            . "&khuyenmai=moiramat"
                            .(isset($_SESSION['sosao']) ? "&sosao=".$sosao : "")
                            .(isset($_SESSION['sapxep']) ? "&sapxep=".$sapxep : "")
                            ;
                            ?>">Mới ra mắt</a>
                    </li>
                    <li><a href="loc_sp.php<?php
                            echo $boloc .(isset($_SESSION['lsp']) ? "lsp=".$lsp : "")
                            .(isset($_SESSION['ma_th']) ? "&ma_th=".$ma_th : "") 
                            . (isset($_SESSION['gia']) ? "&gia=".$gia : "") 
                            . "&khuyenmai=tragop"
                            .(isset($_SESSION['sosao']) ? "&sosao=".$sosao : "")
                            .(isset($_SESSION['sapxep']) ? "&sapxep=".$sapxep : "")
                            ;
                            ?>">Trả góp</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Số lượng sao  <i class="fas fa-angle-double-right"></i></a>
                <ul class="sub-menu">
                    <li><a href="loc_sp.php<?php
                            echo $boloc .(isset($_SESSION['lsp']) ? "lsp=".$lsp : "")
                            .(isset($_SESSION['ma_th']) ? "&ma_th=".$ma_th : "") 
                            . (isset($_SESSION['gia']) ? "&gia=".$gia : "")
                            .(isset($_SESSION['khuyenmai']) ? "&khuyenmai=".$khuyenmai : "")

                            . "&sosao=2"
                            .(isset($_SESSION['sapxep']) ? "&sapxep=".$sapxep : "")
                            ;
                            ?>">Trên 2 sao</a>
                    </li>
                    <li><a href="loc_sp.php<?php
                            echo $boloc .(isset($_SESSION['lsp']) ? "lsp=".$lsp : "")
                            .(isset($_SESSION['ma_th']) ? "&ma_th=".$ma_th : "") 
                            . (isset($_SESSION['gia']) ? "&gia=".$gia : "")
                            .(isset($_SESSION['khuyenmai']) ? "&khuyenmai=".$khuyenmai : "")

                            . "&sosao=3"
                            .(isset($_SESSION['sapxep']) ? "&sapxep=".$sapxep : "")
                            ;
                            ?>">Trên 3 sao</a>
                    </li>
                    <li><a href="loc_sp.php<?php
                            echo $boloc .(isset($_SESSION['lsp']) ? "lsp=".$lsp : "")
                            .(isset($_SESSION['ma_th']) ? "&ma_th=".$ma_th : "") 
                            . (isset($_SESSION['gia']) ? "&gia=".$gia : "")
                            .(isset($_SESSION['khuyenmai']) ? "&khuyenmai=".$khuyenmai : "")

                            . "&sosao=4"
                            .(isset($_SESSION['sapxep']) ? "&sapxep=".$sapxep : "")
                            ;
                            ?>">Trên 4 sao</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Sắp xếp <i class="fas fa-angle-double-right"></i></a>
 
                <ul class="sub-menu">
                    <li>
                        <a href="loc_sp.php<?php
                            echo $boloc .(isset($_SESSION['lsp']) ? "lsp=".$lsp : "")
                            .(isset($_SESSION['ma_th']) ? "&ma_th=".$ma_th : "") 
                            . (isset($_SESSION['gia']) ? "&gia=".$gia : "")
                            .(isset($_SESSION['khuyenmai']) ? "&khuyenmai=".$khuyenmai : "")
                            .(isset($_SESSION['sosao']) ? "&sosao=".$sosao : "")
                            ."&sapxep=giatangdan"
                            ;
                            ?>
                        ">Giá tăng dần</a>
                    </li>
                    <li>
                        <a href="loc_sp.php<?php
                            echo $boloc .(isset($_SESSION['lsp']) ? "lsp=".$lsp : "")
                            .(isset($_SESSION['ma_th']) ? "&ma_th=".$ma_th : "") 
                            . (isset($_SESSION['gia']) ? "&gia=".$gia : "")
                            .(isset($_SESSION['khuyenmai']) ? "&khuyenmai=".$khuyenmai : "")
                            .(isset($_SESSION['sosao']) ? "&sosao=".$sosao : "")
                            ."&sapxep=giagiamdan"
                            ;
                            ?>
                        ">Giá giảm dần</a>
                    </li>
                    <li>
                        <a href="loc_sp.php<?php
                            echo $boloc .(isset($_SESSION['lsp']) ? "lsp=".$lsp : "")
                            .(isset($_SESSION['ma_th']) ? "&ma_th=".$ma_th : "") 
                            . (isset($_SESSION['gia']) ? "&gia=".$gia : "")
                            .(isset($_SESSION['khuyenmai']) ? "&khuyenmai=".$khuyenmai : "")
                            .(isset($_SESSION['sosao']) ? "&sosao=".$sosao : "")
                            ."&sapxep=a-z"
                            ;
                            ?>
                        ">Từ A-Z</a>
                    </li>
                    <li>
                        <a href="loc_sp.php<?php
                            echo $boloc .(isset($_SESSION['lsp']) ? "lsp=".$lsp : "")
                            .(isset($_SESSION['ma_th']) ? "&ma_th=".$ma_th : "") 
                            . (isset($_SESSION['gia']) ? "&gia=".$gia : "")
                            .(isset($_SESSION['khuyenmai']) ? "&khuyenmai=".$khuyenmai : "")
                            .(isset($_SESSION['sosao']) ? "&sosao=".$sosao : "")
                            ."&sapxep=z-a"
                            ;
                            ?>
                        ">Từ Z-A</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
<div class="boloc">
    <?php
        if(isset($_SESSION['ma_th']) || isset($_SESSION['gia']) || isset($_SESSION['khuyenmai']) 
            || isset($_SESSION['sosao']) || isset($_SESSION['sapxep'])){
            ?>
                <div class="boloc_block boloc_main">
                    <a href="xoaboloc.php?boloc=all">Xóa bộ lọc <i class="far fa-times-circle"></i></a>
                </div>
                <?php
                    if(isset($_SESSION['ma_th'])){
                        ?>
                            <div class="boloc_block">
                                <a href="xoaboloc.php?boloc=th">Thương hiệu <i class="far fa-times-circle"></i></a>
                            </div>
                        <?php
                    }
                    if(isset($_SESSION['gia'])){
                        ?>
                            <div class="boloc_block">
                                <a href="xoaboloc.php?boloc=gia">Giá tiền<i class="far fa-times-circle"></i></a>
                            </div>
                        <?php
                    }
                    if(isset($_SESSION['khuyenmai'])){
                        ?>
                            <div class="boloc_block">
                                <a href="xoaboloc.php?boloc=khuyenmai">Khuyến mãi <i class="far fa-times-circle"></i></a>
                            </div>
                        <?php
                    }
                    if(isset($_SESSION['sosao'])){
                        ?>
                            <div class="boloc_block">
                                <a href="xoaboloc.php?boloc=sosao">Số sao <i class="far fa-times-circle"></i></a>
                            </div>
                        <?php
                    }
                    if(isset($_SESSION['sapxep'])){
                        ?>
                            <div class="boloc_block">
                                <a href="xoaboloc.php?boloc=sapxep">Sắp xếp<i class="far fa-times-circle"></i></a>
                            </div>
                        <?php
                    }
                ?>
            <?php
        }   
    ?>
</div>

<!-- <div></div> -->