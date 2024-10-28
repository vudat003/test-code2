<div id="tieude">
        <div class="trai">
            <a href="admin.php"><i class="fas fa-home"></i></a>
            <?php
                include ('../connection/connection.php');
                if(isset($_SESSION['admin'])){
                    echo "<h2>Xin chào admin T&T_IT</h2>";
                }else if(isset($_SESSION['id_nv'])){
                    $sql_nv  = "SELECT * from nhanvien where id_nv = '".$_SESSION['id_nv']."'";
                    $result_nv = $con->query($sql_nv);
                    if($result_nv->num_rows > 0){
                        while($row_nv = $result_nv->fetch_assoc()){
                        echo "<h2>Xin chào nhân viên ".$row_nv['ten_nv']."</h2>";
                            $tennhanvien = $row_nv['ten_nv'];
                        }
                    }
                }
            ?>
        </div>
        <div class="phai">
            <div class="p">
            <a href=""><i class="fas fa-user"></i></a>
            <i class="fas fa-angle-double-down"></i>
            <?php
                if(isset($_SESSION['admin'])){
                    echo"<a href='../../ThucTapCS/dangxuat.php'>T&T_DD</a>";
                }else{
                    echo"<a href='../../ThucTapCS/dangxuat.php'>NV: ".$tennhanvien."</a>";
                }
            ?>
            </div>
        </div>
</div>