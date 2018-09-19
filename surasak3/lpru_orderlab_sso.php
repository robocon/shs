<?php 
include 'bootstrap.php';

$db = Mysql::load();
$sql = "SELECT * FROM `opcardchk` 
WHERE `part` = 'ÃÒªÀÑ®61' 
ORDER BY `row` ASC";

$db->select($sql);
$items = $db->get_items();

$start_latest_id = 154;
$lab_header = "610919";


$orderdate = date("Y-m-d H:i:s");
$patienttype = "OPD";
$clinicalinfo = "µÃÇ¨ÊØ¢ÀÒ¾»ÃĞ¨Ó»Õ61";
$dbirth = "00-00-00 00:00:00";

foreach( $items as $key => $item ){ 
    

    $course_list = explode('|', $item['course']);
    $course_list2 = explode('|', $item['branch']);
    $lab_list = array_merge_recursive($course_list, $course_list2);


    $row = $item['pid'];

    $hn = $item['HN'];
    $ptname = $item["name"]." ".$item["surname"];
    $nLab = $lab_header.$item['exam_no'];
    $dbirth = $item['dbirth'];
    $priority = "R";
    $cliniciancode = '';


    $chkgender = substr($item["name"],0,4);
    if($chkgender == "¹.Ê."){
        $gender = "F";
    }else{
        $chkgender = substr($item["name"],0,3);
        if($chkgender == "¹Ò§"){
            $gender = "F";
        }else{
            $gender = "M";
        }
    }

    $orderhead_sql = "INSERT INTO `orderhead` ( 
        `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , 
        `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , 
        `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  
    ) VALUES ( 
        NULL, '$orderdate', '$nLab', '$hn', '$patienttype', 
        '$ptname', '$gender', '$dbirth', '', '', 
        '','$cliniciancode', 'MD022 (äÁè·ÃÒºá¾·Âì)', '$priority', '$clinicalinfo' 
    );";

    dump($orderhead_sql);
    $insert_head = $db->insert($orderhead_sql);
    dump($insert_head);

    /**
     * @stool µÍ¹¤Ô´¤èÒãªé¨èÒÂ ¡çáÂ¡ àËÁ×Í¹¡Ñ¹
     */

    foreach ($lab_list as $lab_key => $lab_code) {
            
        

        if( $lab_code == '@STOOL' ){

            // dump($lab_code);

            $sql_at = "SELECT `code` FROM `labsuit` WHERE `suitcode` LIKE '$lab_code'";
            $db->select($sql_at);
            $suit_list = $db->get_items();

            foreach ($suit_list as $key => $suit_item) {
                

                // dump($suit_item);

                $sql_detail = "SELECT `code`,`oldcode`,`detail` 
                FROM `labcare` 
                WHERE `code` = '".$suit_item['code']."' 
                LIMIT 1 ";
                $q = mysql_query($sql_detail) or die( " select labcare : ".mysql_error() ) ;
                $test_row = mysql_num_rows($q);
                if ( $test_row > 0 ) {
                    
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
                

            }

        }else{

            // 
            $sql_detail = "SELECT `code`,`oldcode`,`detail` 
            FROM `labcare` 
            WHERE `code` = '$lab_code' 
            LIMIT 1 ";
            $q = mysql_query($sql_detail) or die( " select labcare : ".mysql_error() ) ;

            $test_row = mysql_num_rows($q);
            if ( $test_row > 0 ) {
                
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
        
        }

        

        

    }

    echo "<hr>";
    
}
?>