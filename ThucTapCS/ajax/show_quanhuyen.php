<?php
    include '/ThucTapCS/connection/connection.php';
    $id_tinh = $_GET['id'];
    $sql = "SELECT * FROM `district` where _province_id = ".$id_tinh;
    $result = $con->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "<option value='".$row['id']."'>".$row['_name']."</option>";
        }
    }
?>