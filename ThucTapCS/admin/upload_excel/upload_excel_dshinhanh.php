<?php
    if(isset($_POST['submit'])){
        if(isset($_FILES['uploadFile']['name']) && $_FILES['uploadFile']['name'] != ""){
            $allowdExtention = array('xls','xlsx');
            $ext = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);
            if(in_array($ext, $allowdExtention)){
                //upload File
                $file = './uploads/'.$_FILES['uploadFile']['name'];
                $isUpload = copy($_FILES['uploadFile']['tmp_name'], $file);
                //check upload file
                if($isUpload){
                    include '/NienLuanCS/connection/connection.php';
                    require_once __DIR__ . './vendor/autoload.php';
                    include(__DIR__.'./vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php');
                    try{
                        $objPHPExcel = PHPExcel_IOFactory::load($file);

                    }catch(Exception $e){
                        die("Error laoding file ".pathinfo($file, PATHINFO_BASENAME)."");
                    }
                      
                }
                //chi dinh chi muc trang tinh
                $sheet = $objPHPExcel->getSheet(0);
                $total_row = $sheet->getHighestRow();
                $highestColum = $sheet->getHighestColumn();
                $highestColumIndex = PHPExcel_Cell::columnIndexFromString($highestColum);
                for($row = 2; $row <= $total_row; ++ $row){
                    for($col = 0; $col < $highestColumIndex; ++ $col){
                        $cell = $sheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        $records[$row][$col] = $val;
                    }
                }
                
                foreach($records as $row){
                    $id_sp = isset($row[0]) ? $row[0] : "";
                    $img = isset($row[1]) ? './img_sp/'.$row[1] : "";
                    $mau = isset($row[2]) ? $row[2] : "";
                    $sql = "INSERT into ds_img value (null, '".$id_sp."', '".$img."',
                            '".$mau."')";
                    $con->query($sql);
                    header("Location: ../themdshinhanh.php");
                }
                
            }
        }
    }
?>