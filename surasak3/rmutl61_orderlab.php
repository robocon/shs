<?php

include 'bootstrap.php';
$db = Mysql::load();

?>
<form action="rmutl61_orderlab.php" method="post">
    <p>Order Lab ราชมงคล ปี61</p>
    <div>
        <button type="submit">ทำการ Order</button>
        <input type="hidden" name="action" value="order">
    </div>
</form>
<?php

$action = input_post('action');

if( $action == 'order' ){

    $sql = "SELECT * FROM `opcardchk` WHERE `part` = 'rmutl61' AND `row` >= '11564' ORDER BY `row` ASC ";
    $db->select($sql);
    $items = $db->get_items();


    // $orderdate = date("Y-m-d H:i:s");
    $orderdate = '2018-06-13 20:46:30';
    $patienttype = "OPD";
    $clinicalinfo = "ตรวจสุขภาพราชมงคลลำปาง61";
    $dbirth = "00-00-00 00:00:00";

    foreach ($items as $key => $item) {
        
        $lab_list = array('BG');

        $nLab = $hn = $item['HN'];
        $ptname = $item["name"]." ".$item["surname"];
        // $nLab = '180510'.$item['exam_no'];

        $chkgender = substr($item["name"],0,4);
        if($chkgender == "น.ส."){
            $gender = "F";
        }else{
            $chkgender = substr($item["name"],0,3);
            if($chkgender == "นาง"){
                $gender = "F";
            }else{
                $gender = "M";
            }
        }

        $priority = "R";
        $cliniciancode = '';

        $orderhead_sql = "INSERT INTO `orderhead` ( 
            `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , 
            `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , 
            `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  
        ) VALUES ( 
            NULL, '$orderdate', '$nLab', '$hn', '$patienttype', 
            '$ptname', '$gender', '$dbirth', '', '', 
            '','$cliniciancode', 'MD022 (ไม่ทราบแพทย์)', '$priority', '$clinicalinfo' 
        );";
        dump($orderhead_sql);
        $insert = $db->insert($orderhead_sql);
        dump($insert);

        
        foreach ($lab_list as $lab_key => $lab_code) {
            
            // 
            $sql_detail = "SELECT `code`,`oldcode`,`detail` 
            FROM `labcare` 
            WHERE `code` = '$lab_code' 
            LIMIT 1 ";
            $q = mysql_query($sql_detail) or die( " select labcare : ".mysql_error() ) ;
            list($code, $oldcode, $detail) = mysql_fetch_row($q);   
            
            $orderdetail_sql = "INSERT INTO `orderdetail` ( 
                `labnumber` , `labcode`, `labcode1` , `labname` 
            ) VALUES ( 
                '$nLab', '$code', '$oldcode', '$detail'
            );";
            dump($orderdetail_sql);
            $insert_detail = $db->insert($orderdetail_sql);
            dump($insert_detail);

        }
        

        echo "<hr>";

    }

}