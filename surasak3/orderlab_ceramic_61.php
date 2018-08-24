<?php 
include 'bootstrap.php';

$db = Mysql::load();
?>

<form action="orderlab_ceramic_61.php" method="post">
    <div>สั่งLab ควอลิตี้61</div>
    <div>
        <button type="submit">Order Lab</button>
        <input type="hidden" name="action" value="orderlab">
    </div>
</form>
<?php

$action = input_post('action');
if( $action == 'orderlab' ){

    $sql = "SELECT * FROM `opcardchk` 
    WHERE part = 'ควอลิตี้61' 
    ORDER BY `row` ASC";
    $db->select($sql);
    $items = $db->get_items();

    $start_latest_id = 1312;

    $orderdate = date("Y-m-d H:i:s");
    $patienttype = "OPD";
    $clinicalinfo = "ตรวจสุขภาพประจำปี61";
    $dbirth = "0000-00-00 00:00:00";

    foreach( $items as $key => $arr ){ 
        
        $hn = $arr["HN"];
        $ptname = $arr["name"].' '.$arr["surname"];
        $exam_no = $arr['exam_no'];

        if( $exam_no < 1301 ){
            continue;
        }

        $chkgender = substr($ptname,0,4);
        if($chkgender == "น.ส."){
            $gender = "F";
        }else{
            $chkgender = substr($ptname,0,3);
            if($chkgender == "นาง"){
                $gender = "F";
            }else{
                $gender = "M";
            }
        }

        $priority = "R";
        $cliniciancode = '';

        
        if( preg_match('/โปรแกรมอายุ<35ปี/', $arr['course']) > 0 ){
            
            /**
             * CBC
             * CR
             * SGPT
             */
            $lab_list = array('CBC', 'CR', 'SGPT');

            $nLab = '180823'.$exam_no;

        }

        $is_bs = false;
        if( preg_match('/โปรแกรมอายุ>35ปี/', $arr['course']) > 0 ){
            
            /**
             * CBC
             * CR
             * SGPT
             * LIPID
             */
            $lab_list = array('CBC', 'CR', 'SGPT', 'LIPID');
            $nLab = '180823'.$exam_no;

            // เลข BS
            $is_bs = true;

        }
        
        // OUT LAB ไซลีน
        if( preg_match('/ไซลีน/', $arr['course']) > 0 ){

            $lab_list = array_merge_recursive($lab_list, array('10379'));
            
        }

        $orderhead_sql = "INSERT INTO `orderhead` ( 
            `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , 
            `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , 
            `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  
        ) VALUES ( 
            NULL, '$orderdate', '$nLab', '$hn', '$patienttype', 
            '$ptname', '$gender', '$dbirth', '', '', 
            '','$cliniciancode', 'MD022 (ไม่ทราบแพทย์)', '$priority', '$clinicalinfo' 
        );";
        $db->insert($orderhead_sql);

        // orderdetail
        foreach ($lab_list as $key => $lab) {

            list($code,$oldcode,$detail) = mysql_fetch_row(mysql_query("Select code,oldcode,detail From labcare where code = '$lab' limit 0,1 "));   
   
            $sql_detail = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) VALUES ('$nLab', '$code', '$oldcode', '$detail');";
            $db->insert($sql_detail);
            dump($sql_detail);
        }


        if( $is_bs === true ){
            ++$start_latest_id;
            $bs_number = "180823".$start_latest_id;

            $bs_sql = "INSERT INTO `orderhead` ( 
                `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , 
                `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , 
                `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  
            ) VALUES ( 
                NULL, '$orderdate', '$bs_number', '$hn', '$patienttype', 
                '$ptname', '$gender', '$dbirth', '', '', 
                '','$cliniciancode', 'MD022 (ไม่ทราบแพทย์)', '$priority', '$clinicalinfo' 
            );";
            $db->insert($bs_sql);

            // orderdetail สำหรับ BS 
            list($code,$oldcode,$detail) = mysql_fetch_row(mysql_query("Select code,oldcode,detail From labcare where code = 'BS' limit 0,1 "));   
   
            $bs_detail = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) VALUES ('$bs_number', '$code', '$oldcode', '$detail');";
            $db->insert($bs_detail);
            dump($bs_detail);
        }

        echo "<hr>";

    }

}
?>