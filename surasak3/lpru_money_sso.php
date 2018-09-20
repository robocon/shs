<?php 

include("connect.inc"); 

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

?>

<form action="lpru_money_sso.php" method="post">

    <div>
        <button type="submit">บันทึก</button>
        <input type="hidden" name="action" value="save">
    </div>

</form>

<?php

$action = $_POST['action'];

if( $action == 'save' ){

    // $hn = $_POST['hn'];
    $Thidate = (date("Y")+543)."-".date("m-d H:i:s");
    
    // $where = "AND ( `HN` = '53-11177' OR `HN` = '61-6050' OR `HN` = '61-6046' )";

    $sql = "SELECT * 
    FROM `opcardchk` 
    WHERE `part` = 'ราชภัฎ61' 
    ORDER BY `row` ASC";
    $q_pretest = mysql_query($sql) or die( mysql_error() );
    
    while ( $user = mysql_fetch_assoc($q_pretest) ) {
        
        
        ##################################
        ## เตรียมข้อมูลลง depart
        ##################################
        // $Thidate = $opday['thidate'];
        $cPtname = $user['name'].' '.$user['surname'];
        $cHn = $user['HN'];
        $cAn = '';
        $cDoctor = 'MD022 (ไม่ทราบแพทย์)';
        $cDepart = 'PATHO';
        $aDetail = 'ค่าตรวจวิเคราะห์โรค';
        $sOfficer = 'สมยศ แสงสุข';
        $cDiag = 'ตรวจสุขภาพประกันสังคม';
        $cAccno = 0;
        $tvn = '';
        $cPtright = 'R07 ประกันสังคม';
        $cstaf_massage = '';
        $nLab = $user['exam_no'];


        
        ##################################
        ## ตรวจตามสิทธิประกันสังคม
        ##################################
        $user_course = str_replace('|X-RAY', '', $user['course']);
        $sso_list = explode('|', $user_course);

        $item_count = count($sso_list);
        $net_price = (float) 0;
        $sum_y_price = (float) 0;
        $sum_n_price = (float) 0;

        foreach ($sso_list as $key => $sso_item) {
            
            $sql_labcare = "SELECT `code`,`price`,`yprice`,`nprice` FROM `labcare` WHERE `code` LIKE '$sso_item-sso'";
            $q_labcare = mysql_query($sql_labcare) or die( mysql_error() );
            $lab = mysql_fetch_assoc($q_labcare);
            
            // sum สำหรับ depart
            $net_price += (float) $lab['price'];
            $sum_y_price += (float) $lab['yprice'];
            $sum_n_price += (float) $lab['nprice'];

        }

        $net_price = number_format($net_price, 2,'.','');
        $sum_y_price = number_format($sum_y_price, 2,'.','');
        $sum_n_price = number_format($sum_n_price, 2,'.','');

        ##################################
        ## อ่านและเซ็ตเลข runno 
        ##################################
        mysql_query("LOCK TABLES `runno` READ") or die( mysql_error() );
        $q_runno = mysql_query("SELECT * FROM `runno` WHERE `title` = 'depart' ") or die( mysql_error() );
        $test_run = mysql_fetch_assoc($q_runno);
        mysql_query("UNLOCK TABLES") or die( mysql_error() );

        $nRunno = $test_run['runno'] + 1;
        mysql_query("LOCK TABLES `runno` WRITE") or die( mysql_error() );
        mysql_query("UPDATE runno SET runno = $nRunno WHERE title='depart'") or die( mysql_error() );
        mysql_query("UNLOCK TABLES") or die( mysql_error() );
        // อ่านและเซ็ตเลข runno

        $sql_depart = "INSERT INTO `depart` (
            `chktranx`,`date`,`ptname`,`hn`,`an`,
            `doctor`,`depart`,`item`,`detail`,`price`,
            `sumyprice`,`sumnprice`,`paid`,`idname`,`diag`,
            `accno`,`tvn`,`ptright`,`lab`,`cashok`,`staf_massage` 
        )VALUES( 
            '$nRunno','$Thidate','$cPtname','$cHn','$cAn',
            '$cDoctor','$cDepart','$item_count','$aDetail', '$net_price',
            '$sum_y_price','$sum_n_price','','$sOfficer','$cDiag',
            '$cAccno','$tvn','$cPtright','$nLab','SSOCHECKUP61','$cstaf_massage'
        );";
        dump($sql_depart);
        $res_depart = mysql_query($sql_depart);
        dump($res_depart);
        $last_id = mysql_insert_id();

        $price = 0;
        $yprice = 0;
        $nprice = 0;

        foreach ($sso_list as $key => $sso_item) { 

            $sql_labcare = "SELECT `code`,`detail`,`part`,`price`,`yprice`,`nprice` FROM `labcare` WHERE `code` LIKE '$sso_item-sso'";
            $q_labcare = mysql_query($sql_labcare) or die( mysql_error() );
            $lab = mysql_fetch_assoc($q_labcare);

            $price = number_format($lab['price'], 2,'.','');
            $yprice = number_format($lab['yprice'], 2,'.','');
            $nprice = number_format($lab['nprice'], 2,'.','');
            $detail = $lab['detail'];
            $part = $lab['part'];
            $lab_code = $lab['code'];
        
            $sql_patdata = "INSERT INTO `patdata` (
                `date`,`hn`,`an`,`ptname`,`doctor`,
                `item`,`code`,`detail`,`amount`,`price`,
                `yprice`,`nprice`,`depart`,`part`,`idno`,
                `ptright`,`film_size`  
            ) VALUES( 
                '$Thidate','$cHn','$cAn','$cPtname','$cDoctor',
                '$item_count','$lab_code','$detail','1','$price',
                '$yprice','$nprice','$cDepart','$part','$last_id',
                '$cPtright',''
            );";
            dump($sql_patdata);
            $res_patdata = mysql_query($sql_patdata) or die( mysql_error() );
            dump($res_patdata);

        }
        







        $user['branch'] = trim($user['branch']);

        if( $user['branch'] == '-' ){
            continue;
        }

        echo "<hr>";
        ##################################
        ## ตรวจตามรายการของ ม.ราชภัฏ
        ##################################

        $pre_lpcu = explode('|', $user['branch']);
        
        $lpcu_lists = array();
        foreach ($pre_lpcu as $key => $lpItem) {
            if($lpItem == '@STOOL'){
                $sql_at = "SELECT `code` FROM `labsuit` WHERE `suitcode` LIKE '@STOOL'";
                $q_at = mysql_query($sql_at);
                while ( $atItem = mysql_fetch_assoc($q_at) ) {
                    $lpcu_lists[] = $atItem['code'];
                }
                
            }else {
                $lpcu_lists[] = $lpItem;
            }

            
        }

        // dump($lpcu_lists);

        // exit;




        $cDiag = 'ตรวจสุขภาพ';

        $item_count = count($lpcu_lists);
        $net_price = (float) 0;
        $sum_y_price = (float) 0;
        $sum_n_price = (float) 0;

        foreach ($lpcu_lists as $key => $shs_item) {
            
            $sql_labcare = "SELECT `code`,`price`,`yprice`,`nprice` FROM `labcare` WHERE `code` LIKE '$shs_item'";
            $q_labcare = mysql_query($sql_labcare) or die( mysql_error() );
            $lab = mysql_fetch_assoc($q_labcare);
            
            // sum สำหรับ depart
            $net_price += (float) $lab['price'];
            $sum_y_price += (float) $lab['yprice'];
            $sum_n_price += (float) $lab['nprice'];

        }

        $net_price = number_format($net_price, 2,'.','');
        $sum_y_price = number_format($sum_y_price, 2,'.','');
        $sum_n_price = number_format($sum_n_price, 2,'.','');

        // อ่านและเซ็ตเลข runno 
        mysql_query("LOCK TABLES `runno` READ") or die( mysql_error() );
        $q_runno = mysql_query("SELECT * FROM `runno` WHERE `title` = 'depart' ") or die( mysql_error() );
        $test_run = mysql_fetch_assoc($q_runno);
        mysql_query("UNLOCK TABLES") or die( mysql_error() );

        $nRunno = $test_run['runno'] + 1;
        mysql_query("LOCK TABLES `runno` WRITE") or die( mysql_error() );
        mysql_query("UPDATE runno SET runno = $nRunno WHERE title='depart'") or die( mysql_error() );
        mysql_query("UNLOCK TABLES") or die( mysql_error() );
        // อ่านและเซ็ตเลข runno

        $sql_depart = "INSERT INTO `depart` (
            `chktranx`,`date`,`ptname`,`hn`,`an`,
            `doctor`,`depart`,`item`,`detail`,`price`,
            `sumyprice`,`sumnprice`,`paid`,`idname`,`diag`,
            `accno`,`tvn`,`ptright`,`lab`,`cashok`,`staf_massage` 
        )VALUES( 
            '$nRunno','$Thidate','$cPtname','$cHn','$cAn',
            '$cDoctor','$cDepart','$item_count','$aDetail', '$net_price',
            '$sum_y_price','$sum_n_price','','$sOfficer','$cDiag',
            '$cAccno','$tvn','$cPtright','$nLab','SSOCHKUP61','$cstaf_massage'
        );";
        dump($sql_depart);
        $res_depart = mysql_query($sql_depart);
        dump($res_depart);
        $last_id = mysql_insert_id();

        $price = 0;
        $yprice = 0;
        $nprice = 0;

        foreach ($lpcu_lists as $key => $shs_item) { 

            $sql_labcare = "SELECT `code`,`detail`,`part`,`price`,`yprice`,`nprice` FROM `labcare` WHERE `code` LIKE '$shs_item'";
            $q_labcare = mysql_query($sql_labcare) or die( mysql_error() );
            $lab = mysql_fetch_assoc($q_labcare);

            $price = number_format($lab['price'], 2,'.','');
            $yprice = number_format($lab['yprice'], 2,'.','');
            $nprice = number_format($lab['nprice'], 2,'.','');
            $detail = $lab['detail'];
            $part = $lab['part'];
            $lab_code = $lab['code'];
        
            $sql_patdata = "INSERT INTO `patdata` (
                `date`,`hn`,`an`,`ptname`,`doctor`,
                `item`,`code`,`detail`,`amount`,`price`,
                `yprice`,`nprice`,`depart`,`part`,`idno`,
                `ptright`,`film_size`  
            ) VALUES( 
                '$Thidate','$cHn','$cAn','$cPtname','$cDoctor',
                '$item_count','$lab_code','$detail','1','$price',
                '$yprice','$nprice','$cDepart','$part','$last_id',
                '$cPtright',''
            );";
            dump($sql_patdata);
            $res_patdata = mysql_query($sql_patdata) or die( mysql_error() );
            dump($res_patdata);

        }

        




    } // End loop User


}