<?php

include 'bootstrap.php';
$db = Mysql::load();

?>

<form action="late_sso_money" method="post" enctype="multipart/form-data">

    <div>
        <input type="file" name="file" id="">
    </div>
    <div>
        <button type="submit">ลงข้อมูล</button>
        <input type="hidden" name="action" value="upload">
    </div>

</form>
<?php

$action = input_post('action');

if( $action === 'upload' ){

    $file = $_FILES['file'];
    $content = file_get_contents($file['tmp_name']);
    $items = explode("\r\n", $content);
    

    foreach ($items as $key => $item) { 

        if( !empty($item) ){

            list($cHn, $cPtname, $sub_part, $age, $pre_lab_list) = explode(',', $item, 5);

            $lab_list = explode(',', $pre_lab_list);

            $item = 0;
            $Netprice = (float) 0;
            $aSumYprice = (float) 0;
            $aSumNprice = (float) 0;

            foreach ($lab_list as $key => $lab_code) {
                
                if( !empty($lab_code) ){

                    $item++;

                    $sql = "SELECT `price`,`yprice`,`nprice` FROM labcare WHERE `code` LIKE '$lab_code'";
                    $db->select($sql);
                    $lab = $db->get_item();

                    dump($lab_code.':'.$lab['price']);
                    // dump($lab['price']);
                    
                    
                    $Netprice += (float) $lab['price'];
                    $aSumYprice += (float) $lab['yprice'];
                    $aSumNprice += (float) $lab['nprice'];
                }

            }

            dump($cHn);
            dump($cPtname);
            dump($Netprice);
            echo "<hr>";
continue;

            
            $sql = "SELECT `thidate`,`hn`,`vn`,`ptright` 
            FROM `opday` 
            WHERE `hn` = '$cHn' 
            AND ( `thidate` >= '2561-04-23 00:00:00' AND `thidate` <= '2561-04-30 23:59:59' ) ";
            $db->select($sql);
            $opday = $db->get_item();
        
            $error = '';
            $Thidate = $opday['thidate'];
            $cDiag = 'ตรวจสุขภาพ';
            $cPtright = 'R29 ตรวจสุขภาพแบบกลุ่ม';
            $cAn = '';
            $cDoctor = 'MD022 (ไม่ทราบแพทย์)';
            $cDepart = 'PATHO';
            $aDetail = 'ค่าตรวจวิเคราะห์โรค';
            $sOfficer = 'ดวงเพชร  สุรินทร์';
            $cAccno = $_SESSION['cAccno'];
            $tvn = $opday['vn'];
            $cstaf_massage = '';

            $sql = "SELECT `exam_no` FROM `opcardchk` WHERE `HN` = '$cHn' AND `part` = 'ลูกจ้าง61' ";
            $db->select($sql);
            $opcardchk = $db->get_item();

            // ดึงจาก exam_no
            $nLab = $opcardchk['exam_no'];
            
            $db->select("SELECT * FROM `runno` WHERE `title` = 'depart' ");
            $test_run = $db->get_item();
            $nRunno = $test_run['runno'] + 1;
            $db->select("LOCK TALBES `runno` READ");

            $update = $db->update("UPDATE runno SET runno = $nRunno WHERE title='depart'");
            $db->select("UNLOCK TALBES");

            $sql = "INSERT INTO depart(
                chktranx,date,ptname,hn,an,
                doctor,depart,item,detail,price,
                sumyprice,sumnprice,paid, idname,diag,
                accno,tvn,ptright,lab,staf_massage
            )VALUES( 
                '$nRunno','$Thidate','$cPtname','$cHn','$cAn',
                '$cDoctor','$cDepart','$item','$aDetail', '$Netprice',
                '$aSumYprice','$aSumNprice','','$sOfficer','$cDiag',
                '$cAccno','$tvn','$cPtright','$nLab','$cstaf_massage'
            );";

// dump($sql);


            $save = $db->insert($sql);
            if( $save !== true ){
                $error .= errorMsg('save', $save['id']).'<br>';
            }

            $last_id = $db->get_last_id();


            foreach ($_POST['shs_list'] as $key => $shs_code) {

                $sql = "SELECT `detail`,`part`,`price`,`yprice`,`nprice` FROM labcare WHERE `code` LIKE '$shs_code'";
                $db->select($sql);
                $lab = $db->get_item();

                $price = $lab['price'];
                $yprice = $lab['yprice'];
                $nprice = $lab['nprice'];
                $detail = $lab['detail'];
                $part = $lab['part'];

                $sql = "INSERT INTO patdata(
                    date,hn,an,ptname,doctor,
                    item,code,detail,amount,price,
                    yprice,nprice,depart,part,idno,
                    ptright,film_size 
                ) VALUES( 
                    '$Thidate','$cHn','$cAn','$cPtname','$cDoctor',
                    '$item','$shs_code','$detail','1','$price',
                    '$yprice','$nprice','$cDepart','$part','$last_id',
                    '$cPtright',''
                );";
                $save = $db->insert($sql);
                if( $save !== true ){
                    $error .= errorMsg('save', $save['id']).'<br>';
                }

            }

            if( empty($error) ){
                ?>
                <p>บันทึกข้อมูลเสร็จเรียบร้อย</p>
                <?php
            }else{
                echo $error;
            }







            echo "<hr>";
        }
    }
    


}

