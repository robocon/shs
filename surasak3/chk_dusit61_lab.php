<?php

include 'bootstrap.php';

$db = Mysql::load();

$action = input_post('action');

if( empty($action) ){

    ?>
    <form action="chk_dusit61_lab.php" method="post">
        <div>
            HN: <input type="text" name="hn" id="">
        </div>
        <div>
            <button type="submit">คิดค่าใช้จ่าย</button>
            <input type="hidden" name="action" value="cal">
        </div>
    </form>
    <?php

}else if( $action === 'cal' ){

    $hn = input_post('hn');
    if( empty($hn) ){
        echo "กรุณาใส่ HN ";
        exit;
    }

    $sql = "SELECT * FROM `opcardchk` WHERE `part` = 'สวนดุสิต61' AND `HN` = '$hn' ORDER BY `exam_no` ASC ";
    $db->select($sql);
    $user = $db->get_item();

    //
    // ออก VN
    //

    // @to
    // opday

    // 
    // 
    // 

    $lab_list = array('UA','CBC','BS','BUN','CR','URIC','CHOL','TRI','HDL','LDL','SGOT','SGPT','ALK');
    if( $user['course'] == '2' ){
        $lab_list = array_merge_recursive($lab_list, array('HBSAB','HBSAG','STOCB','ST'));
        
    }

    $cPtname = $user['ptname'];
    $cHn = $user['HN'];
    $cAn = '';
    $cDoctor = 'MD022 (ไม่ทราบแพทย์)';
    $cDepart = 'PATHO';
    $sOfficer = $_SESSION['sOfficer'];
    $aDetail = 'ค่าตรวจวิเคราะห์โรค';
    $cDiag = 'ตรวจสุขภาพ';
    $nLab = $user['exam_no'];
    
    // 
    // DEPART
    // 
    $Thidate = ( date('Y') + 543 ).date('-m-d H:i:s');
    $item = count($lab_list);
    $Netprice = (float) 0;
    $aSumYprice = (float) 0;
    $aSumNprice = (float) 0;

    foreach ($lab_list as $key => $code) {
        $sql = "SELECT `price`,`yprice`,`nprice` FROM labcare WHERE `code` LIKE '$code'";
        $db->select($sql);
        $lab = $db->get_item();
        
        $Netprice += (float) $lab['price'];
        $aSumYprice += (float) $lab['yprice'];
        $aSumNprice += (float) $lab['nprice'];
    }

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
        accno,tvn,ptright,lab,`status`,staf_massage
    )VALUES( 
        '$nRunno','$Thidate','$cPtname','$cHn','$cAn',
        '$cDoctor','$cDepart','$item','$aDetail', '$Netprice',
        '$aSumYprice','$aSumNprice','','$sOfficer','$cDiag',
        '0','$tvn','$cPtright','$nLab','Y',''
    );";
    dump($sql);
    // $save = $db->insert($sql);
    // if( $save !== true ){
    //     $error .= errorMsg('save', $save['id']).'<br>';
    // }


    exit;

    foreach ($lab_list as $key => $lab_code) {
        
        $sql_lab = "SELECT `code`,`oldcode`,`detail` 
        FROM `labcare` 
        WHERE `code` = '$lab_code' 
        LIMIT 1 ";
        $db->select($sql_lab);
        $lab = $db->get_item();

        dump($lab);

    }
        

}