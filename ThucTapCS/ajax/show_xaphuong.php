<?php
    include '/ThucTapCS/connection/connection.php';
    $id_xaphuong = $_GET['id'];
    $sql_xaphuong = "SELECT * FROM `ward` where _district_id = ".$id_xaphuong;
    $result_xaphuong = $con->query($sql_xaphuong);
    if($result_xaphuong->num_rows > 0){
        while($row_xaphuong = $result_xaphuong->fetch_assoc()){
            echo "<option value='".$row_xaphuong['id']."'>".$row_xaphuong['_name']."</option>";         
        }
    }
?>