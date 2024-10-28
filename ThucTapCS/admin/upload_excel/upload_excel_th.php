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
                    $ma_loaisp = isset($row[0]) ? $row[0] : "";
                    $ma_th = isset($row[1]) ? $row[1] : "";
                    $ten_th = isset($row[2]) ? $row[2] : "";
                    $img_th = isset($row[3]) ? './img_th/'.$row[3] : "";
                    $sql = "INSERT into thuonghieu (ma_loaisp, ma_th, ten_tenth, img_th)
                        value ('".$ma_loaisp."', '".$ma_th."', '".$ten_th."', '".$img_th."' )
                        ";
                    $con->query($sql);
                    header("Location: ../danhsach_th.php");
                }
                
            }
        }
    }
?>