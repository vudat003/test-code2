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
                $sql_find_id = "SELECT id_sp FROM sanpham  ORDER BY id_sp DESC  LIMIT 1";
                $result = $con->query($sql_find_id);
                $row_id = $result->fetch_assoc();
                $id_sp_tskt = $row_id['id_sp'];
                foreach($records as $row){
                    $ma_loaisp = isset($row[0]) ? $row[0] : "";
                    $id_th = isset($row[1]) ? $row[1] : "";
                    $ten_sp = isset($row[2]) ? $row[2] : "";
                    $gia_sp = isset($row[3]) ? $row[3] : "";
                    $gia_ban = isset($row[4]) ? $row[4] : "";
                    $img_sp = isset($row[5]) ? './img_sp/'.$row[5] : "";
                    $mausac = isset($row[6]) ? $row[6] : "";
                    $sl_sp = isset($row[7]) ? $row[7] : "";
                    $sosao = isset($row[8]) ? $row[8] : "";
                    $danhgia = isset($row[9]) ? $row[9] : "";
                    $khuyenmai = isset($row[10]) ? $row[10] : "";
                    $giaitrikhuyenmai = isset($row[11]) ? $row[11] : "";
                    $trangthai = isset($row[14]) ? $row[14] : "0";
                    $sql = "INSERT into sanpham value (null, 
                            '".$ma_loaisp."', 
                            '".$id_th."',
                            '".$ten_sp."', 
                            '".$gia_sp."', 
                            '".$gia_ban."', 
                            '$img_sp',
                            '".$mausac."',
                            '".$sl_sp."',
                            '".$sosao."',
                            '".$danhgia."',
                            '".$khuyenmai."',
                            '".$giaitrikhuyenmai."',
                            '',
                            '',
                            '".$trangthai."')";
                    $con->query($sql);
                    // lay id de trong bang thong so ki thuat;
                    $manhinh = isset($row[15]) ? $row[15] : "";
                    $hedieuhanh = isset($row[16]) ? $row[16] : "";
                    $camera_truoc = isset($row[17]) ? $row[17] : "";
                    $camera_sau = isset($row[18]) ? $row[18] : "";
                    $cpu = isset($row[19]) ? $row[19] : "";
                    $ram  = isset($row[20]) ? $row[20] : "";
                    $bonhotrong = isset($row[21]) ? $row[21] : "";
                    $sim = isset($row[22]) ? $row[22] : "";
                    $dungluongpin = isset($row[23]) ? $row[23] : "";
                    $o_cung = isset($row[24]) ? $row[24] : "";
                    $card_manhinh = isset($row[25]) ? $row[25] : "";
                    $congketnoi = isset($row[26]) ? $row[26] : "";
                    $thietke = isset($row[27]) ? $row[27] : "";
                    $kichthuoc = isset($row[28]) ? $row[28] : "";
                    $thoidiemramat = isset($row[29]) ? $row[29] : "";
                    $ketnoimang = isset($row[30]) ? $row[30] : "";
                    $hotrosim = isset($row[31]) ? $row[31] : "";
                    $congnghemanhinh = isset($row[32]) ? $row[32] : "";
                    $kichthuocmanhinh = isset($row[33]) ? $row[33] : "";
                    $thoigiansudungpin = isset($row[34]) ? $row[34] : "";
                    $ketnoivoihedieuhanh = isset($row[35]) ? $row[35] : "";
                    $chatlieumat = isset($row[36]) ? $row[36] : "";
                    $duongkinhhmat = isset($row[37]) ? $row[37] : "";
                    $ketnoi = isset($row[38]) ? $row[38] : "";
                    $ngonngu = isset($row[39]) ? $row[39] : "";
                    $theodoi = isset($row[40]) ? $row[40] : "";
                    //chen du lieu bang thongsokithuat
                    ++ $id_sp_tskt;
                    $sql_tskt = "INSERT into thongsokithuat value (
                        '".$id_sp_tskt."',
                        '".$ma_loaisp."',
                        '".$manhinh."',
                        '".$hedieuhanh."',
                        '".$camera_truoc."',
                        '".$camera_sau."',
                        '".$cpu."',
                        '".$ram."',
                        '".$bonhotrong."',
                        '".$sim."',
                        '".$dungluongpin."',
                        '".$o_cung."',
                        '".$card_manhinh."',
                        '".$congketnoi."',
                        '".$thietke."',
                        '".$kichthuoc."',
                        '".$thoidiemramat."',
                        '".$ketnoimang."',
                        '".$hotrosim."',
                        '".$congnghemanhinh."',
                        '".$kichthuocmanhinh."',
                        '".$thoigiansudungpin."',
                        '".$ketnoivoihedieuhanh."',
                        '".$chatlieumat."',
                        '".$duongkinhhmat."',
                        '".$ketnoi."',
                        '".$ngonngu."',
                        '".$theodoi."')";
                     $con->query($sql_tskt);
                    header("Location: ../danhsach_sp.php");
                }
                
            }
        }
    }
?>