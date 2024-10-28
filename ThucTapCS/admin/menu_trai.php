<?php
    // session_start();
    if(isset($_SESSION['admin'])){
    ?>
        <div id="menu_left">
            <ul>
                <li><a href="">Loại sản phẩm </a><i class="fas fa-angle-double-right"></i>
                    <ul class="sub">
                        <li><a href="danhsach_loaisp.php">Danh sách loại sản phẩm</a></li>
                        <li><a href="them_loaisp.php">Thêm loại sản phẩm</a></li>
                    </ul>
                </li>
                <li><a href="">Thương hiệu sản phẩm</a> <i class="fas fa-angle-double-right"></i>
                    <ul  class="sub">
                        <li><a href="danhsach_th.php">Danh sách thương hiệu</a></li>
                        <li><a href="them_th.php">Thêm thương hiệu</a></li>
                    </ul>
                </li>
                <li><a href="">Quản lý sản phẩm</a> <i class="fas fa-angle-double-right"></i>
                    <ul  class="sub">
                        <li><a href="danhsach_sp.php">Danh sách sản phẩm</a></li>
                        <li><a href="them_sp.php">Thêm sản phẩm</a></li>
                    </ul>
                </li>
                <li><a href="quanlythanhvien.php">Quản lý khách hàng</a></li>
                <li><a href="">Quản lý nhân viên</a>  <i class="fas fa-angle-double-right"></i>
                <ul  class="sub">
                        <li><a href="danhsach_nv.php">Danh sách nhân viên</a></li>
                        <li><a href="them_nv.php">Thêm nhân viên</a></li>
                    </ul>
                </li>
                <li><a href="">Quản lý đơn hàng</a>  <i class="fas fa-angle-double-right"></i>
                    <ul  class="sub">
                        <li><a href="donhang.php">Đơn hàng chưa duyệt</a></li>
                    </ul>
                </li>
                <li><a href="quanlydanhgiasp.php">Quản lý đánh giá sản phẩm</a></li>
                <li><a href="thanhtoan.php">Thanh toán</a></li>
                <li><a href="thongKeDonHangDaHet.php">Thông kê hàng đã sắp hết</a></li>
                <li><a href="admin.php">Tổng quát</a></li>
            </ul>
        </div>
    <?php
    }else if(isset($_SESSION['id_nv'])){
    ?>
        <div id="menu_left">
            <ul>
                <li><a href="">Loại sản phẩm </a><i class="fas fa-angle-double-right"></i>
                    <ul class="sub">
                        <li><a href="danhsach_loaisp.php">Danh sách loại sản phẩm</a></li>
                        <!-- <li><a href="them_loaisp.php">Thêm loại sản phẩm</a></li> -->
                    </ul>
                </li>
                <li><a href="">Thương hiệu sản phẩm</a> <i class="fas fa-angle-double-right"></i>
                    <ul  class="sub">
                        <li><a href="danhsach_th.php">Danh sách thương hiệu</a></li>
                        <!-- <li><a href="them_th.php">Thêm thương hiệu</a></li> -->
                    </ul>
                </li>
                <li><a href="">Quản lý sản phẩm</a> <i class="fas fa-angle-double-right"></i>
                    <ul  class="sub">
                        <li><a href="danhsach_sp.php">Danh sách sản phẩm</a></li>
                        <!-- <li><a href="them_sp.php">Thêm sản phẩm</a></li> -->
                        <!-- <li><a href="themdshinhanh.php">Cập nhập danh sách ảnh</a></li> -->
                    </ul>
                </li>
                <li><a href="quanlythanhvien.php">Quản lý khách hàng</a></li>
                <!-- <li><a href="">Quản lý nhân viên</a>  <i class="fas fa-angle-double-right"></i>
                <ul  class="sub">
                        <li><a href="danhsach_nv.php">Danh sách nhân viên</a></li>
                        <li><a href="them_nv.php">Thêm nhân viên</a></li>
                    </ul>
                </li> -->
                <li><a href="">Quản lý đơn hàng</a>  <i class="fas fa-angle-double-right"></i>
                    <ul  class="sub">
                        <li><a href="donhang.php">Đơn hàng chưa duyệt</a></li>
                    </ul>
                </li>
                <li><a href="thanhtoan.php">Thanh toán</a></li>
                <li><a href="">Thông kê hàng tồn kho</a></li>
                <li><a href="">Tổng quát</a></li>
            </ul>
        </div>
    <?php
    }
?>
