<?php
    include '/ThucTapCS/connection/connection.php';
    $id = $_GET['id'];
    $sql = "SELECT * from thuonghieu where ma_loaisp = '".$id."'";
    $result = $con->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo " <option value='".$row['id_th']."'>".$row['ten_tenth']."</option>";
        }
    }
?>