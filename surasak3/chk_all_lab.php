<?php

include 'bootstrap.php';
$db = Mysql::load();

$part = input_get('part'); 


$sql = "SELECT * FROM `out_result_chkup` WHERE `part` = '$part' ";
$db->select($sql);
$items = $db->get_items();

// เอาปีงบ
$db->select($sql." LIMIT 1 ORDER BY `row_id`");
$get_year = $db->get_item();
$test_year_chk = $get_year['year_chk'];

// เอา labcode ของ lab อื่นๆ ที่ไม่ใช่ UA กับ CBC
$sql = "SELECT e.`labcode`,e.`labname`  
FROM ( 
    SELECT MAX(b.`autonumber`) AS `latest_id`, b.`profilecode` 
    FROM ( 

        SELECT * FROM `opcardchk` WHERE `part` = '$part' 

    ) AS a 
    LEFT JOIN `resulthead` AS b 
        ON b.`hn` = a.`hn` 
    WHERE b.`clinicalinfo` = 'ตรวจสุขภาพประจำปี$test_year_chk' 
    AND ( b.`profilecode` != 'UA' AND b.`profilecode` != 'CBC' ) 
    GROUP BY b.`profilecode`
) AS c 
LEFT JOIN `resulthead` AS d ON d.`autonumber` = c.`latest_id` 
LEFT JOIN `resultdetail` AS e ON e.`autonumber` = c.`latest_id` 
ORDER BY e.`labcode` ASC";

$db->select($sql);
$get_headers = $db->get_items();

?>

<style>
*{
    font-family: TH SarabunPSK;
    font-size: 12pt;
}

.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
</style>

<table class="chk_table" style="width: 300%">
    <tr>
        <th>HN</th>
        <th>ชื่อ-สกุล</th>
        <th>อายุ</th>
        <th>น้ำหนัก</th>
        <th>ส่วนสูง</th>
        <th>BMI</th>
        <th>SYS</th>
        <th>DIA</th>
        <th>T</th>
        <th>P</th>
        <th>R</th>
        <th>ผลตรวจ</th>

        <th>WBC Result</th>
        <th>WBC Range</th>
        <th>WBC สรุป</th>

        <th>NEU Result</th>
        <th>NEU Range</th>
        <th>NEU สรุป</th>

        <th>LYMP Result</th>
        <th>LYMP Range</th>
        <th>LYMP สรุป</th>

        <th>EO Result</th>
        <th>EO Range</th>
        <th>EO สรุป</th>

        <th>HCT Result</th>
        <th>HCT Range</th>
        <th>HCT สรุป</th>

        <th>PLTC Result</th>
        <th>PLTC Range</th>
        <th>PLTC สรุป</th>

        <th>SPGR Result</th>
        <th>SPGR Range</th>
        <th>SPGR สรุป</th>

        <th>PRO Result</th>
        <th>PRO Range</th>
        <th>PRO สรุป</th>

        <th>GLU Result</th>
        <th>GLU Range</th>
        <th>GLU สรุป</th>

        <th>WBC Result</th>
        <th>WBC Range</th>
        <th>WBC สรุป</th>

        <th>RBC Result</th>
        <th>RBC Range</th>
        <th>RBC สรุป</th>

        <?php 
        $etc_where_txt = array();
        $etc_all_labcode = array();
        foreach ($get_headers as $key => $head) { 
            $etc_where_txt[] = "c.`labcode` = '".$head['labcode']."'";
            $etc_all_labcode[] = $head['labcode'];

            ?>
            <th><?=$head['labcode'].' ('.$head['labname'].')';?> Result</th>
            <th><?=$head['labcode'].' ('.$head['labname'].')';?> Range</th>
            <th><?=$head['labcode'].' ('.$head['labname'].')';?> สรุป</th>
            <?php
        }
        ?>
    </tr>

<?php

foreach ($items as $key => $item) {

    $hn = $item['hn'];
    $year_chk = $item['year_chk'];

    // ตรวจร่างกายทั่วไป //
    // ดัชนีมวลกาย
    $ht = $item['height']/100;
	$bmi = number_format($item['weight'] /($ht*$ht),2);
    $bmi_txt = false;
    if($bmi == '0.00' ){
        $bmi_txt = "ไม่ได้รับการตรวจ";
    } else if($bmi >= 18.5 && $bmi <= 22.99){
        $bmi_txt = "มีน้ำหนักตามเกณฑ์";
    }else{
        if($bmi < 18.5){ $bmi_txt = "มีน้ำหนักต่ำกว่าเกณฑ์";}
        if($bmi >= 23 && $bmi <= 24.99){ $bmi_txt = "เริ่มมีน้ำหนักเกินเกณฑ์";}
        if($bmi >= 25 && $bmi <= 29.99){ $bmi_txt = "มีน้ำหนักเกินเกณฑ์";}
        if($bmi >= 30 && $bmi <= 34.99){ $bmi_txt = "มีภาวะอ้วนค่อนข้างมาก";}
        if($bmi >= 35){ $bmi_txt = "มีภาวะอ้วนมาก";}
    }

    // ความดันโลหิต
    $bp1 = ( empty($item['bp3']) ) ? $item['bp1'] : $item['bp3'];
    $bp2 = ( empty($item['bp4']) ) ? $item['bp2'] : $item['bp4'];
    $bp_txt = false;
    if($bp1 =='NO'){
        $bp_txt = "ไม่ได้รับการตรวจ";
    }else  if($bp1 <= 130){
        $bp_txt = "ปกติ";
    }else{
        if($bp1 >=140){ 
            $bp_txt = "มีความดันโลหิตสูง ควรออกกำลังอย่างสม่ำเสมอ ลดอาหารที่มีรสเค็ม หรือพบแพทย์เพื่อทำการรักษา";
        }else if($bp1 >=131 && $bp1 < 140){
            $bp_txt = "เริ่มมีภาวะความดันโลหิตสูง ควรออกกำลังกายอย่างสม่ำเสมอ";
        }
    }

    $body_res = 'ดัชนีมวลกาย '.$bmi_txt.' / ความดันโลหิต '.$bp_txt;
    // ตรวจร่างกายทั่วไป //


    // CBC // 
    $sql = " SELECT c.* 
    FROM ( 
        SELECT *, MAX(`autonumber`) AS `latest_id`  
        FROM `resulthead` 
        WHERE `profilecode` = 'CBC' 
        AND `hn` = '$hn' 
        AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี$year_chk' 
        GROUP BY `profilecode` 
        ORDER BY `autonumber` ASC 
    ) AS a 
    LEFT JOIN `resulthead` AS b ON b.`autonumber` = a.`latest_id` 
    LEFT JOIN `resultdetail` AS c ON c.`autonumber` = a.`latest_id` 
    WHERE ( 
		c.labcode = 'WBC' 
		|| c.labcode ='EOS' 
		|| c.labcode ='HCT' 
		|| c.labcode ='PLTC' 
		|| c.labcode ='NEU' 
		|| c.labcode ='LYMP' 
	) 
    ORDER BY a.`autonumber` ASC, c.`seq` ASC";
    $cbc_query = mysql_query($sql) or die( mysql_error() );
    
    
    // UA // 
    $sql = " SELECT c.* 
    FROM ( 
        SELECT *, MAX(`autonumber`) AS `latest_id`  
        FROM `resulthead` 
        WHERE `profilecode` = 'UA' 
        AND `hn` = '$hn' 
        AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี$year_chk' 
        GROUP BY `profilecode` 
        ORDER BY `autonumber` ASC 
    ) AS a 
    LEFT JOIN `resulthead` AS b ON b.`autonumber` = a.`latest_id` 
    LEFT JOIN `resultdetail` AS c ON c.`autonumber` = a.`latest_id` 
    WHERE ( 
		c.labcode ='SPGR' 
		|| c.labcode ='PHU' 
		|| c.labcode ='GLUU' 
		|| c.labcode ='PROU' 
		|| c.labcode ='WBCU' 
		|| c.labcode ='RBCU' 
	) 
    ORDER BY a.`autonumber` ASC, c.`seq` ASC";
    $ua_query = mysql_query($sql) or die( mysql_error() );

    
    // Lab อื่นๆ ที่อยู่นอกเหนือจาก CBC และ UA
    $etc_where = 'WHERE ( '.implode(' || ', $etc_where_txt).' )';
    
    $sql = "SELECT c.* 
    FROM ( 

        SELECT *, MAX(`autonumber`) AS `latest_id`  
        FROM `resulthead` 
        WHERE `hn` = '$hn' 
        AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี$year_chk' 
        AND ( `profilecode` != 'UA' AND `profilecode` != 'CBC' )
        GROUP BY `profilecode` 
        ORDER BY `autonumber` ASC 

    ) AS a 
    LEFT JOIN `resulthead` AS b ON b.`autonumber` = a.`latest_id` 
    LEFT JOIN `resultdetail` AS c ON c.`autonumber` = a.`latest_id` 
    $etc_where 
    ORDER BY c.`labcode` ASC";
    $db->select($sql);
    $etc_lab = $db->get_items();

    $etc_all_result = array();
    foreach ($etc_lab as $key => $value) {
        $key = $value['labcode'];

        $etc_all_result[$key] = array(
            'result' => $value['result'], 
            'normalrange' => $value['normalrange'], 
            'flag' => $value['flag']
        );
    }
    
        
    ?>
    <tr>

        <td><?=$item['hn'];?></td>
        <td><?=$item['ptname'];?></td>
        <td><?=$item['age'];?></td>
        <td><?=$item['weight'];?></td>
        <td><?=$item['height'];?></td>
        <td><?=$bmi;?></td>
        <td><?=$bp1;?></td>
        <td><?=$bp2;?></td>
        <td><?=$item['temp'];?></td>
        <td><?=$item['p'];?></td>
        <td><?=$item['rate'];?></td>
        <td><?=$body_res;?></td>
        
        <?php
        while( $cbc = mysql_fetch_assoc($cbc_query) ) {

            $flag = 'ปกติ';
            if( $cbc['flag'] != 'N' ){
                $flag = 'ผิดปกติ';
            }

            ?>
            <td><?=$cbc['result'];?></td>
            <td><?=$cbc['normalrange'];?></td>
            <td><?=$flag;?></td>
            <?php
        }
        ?>

        <?php
        while( $ua = mysql_fetch_assoc($ua_query) ) {

            $flag = 'ปกติ';
            if( $ua['flag'] != 'N' ){
                $flag = 'ผิดปกติ';
            }

            ?>
            <td><?=$ua['result'];?></td>
            <td><?=$ua['normalrange'];?></td>
            <td><?=$flag;?></td>
            <?php
        }
        ?>

        <?php
        
        foreach( $etc_all_labcode AS $key => $etc_item ){
            
            // dump($key);

            $etc = $etc_all_result[$etc_item];
            $app = '';

            if( $etc_item == 'GLU'){
                if( $etc["result"] >= 74 && $etc["result"] <= 106 ){
                    $app="ระดับน้ำตาลในเลือดมีค่าอยู่ในเกณฑ์ปกติ";
                }else if( $etc["result"] > 106 && $etc["result"] <= 125 ){
                    $app="ระดับน้ำตาลในเลือดมีค่าสูงผิดปกติ";
                }else if( $etc["result"] > 125 ){
                    $app="ระดับน้ำตาลในเลือดมีค่าสูงมากผิดปกติ";	
                }else if( $etc["result"] < 74 ){
                    $app="ระดับน้ำตาลในเลือดมีค่าต่ำผิดปกติ";	
                }
            }

            if($etc_item == 'BUN'){
                if($etc["result"]>18){
                    $app="ผิดปกติ ควรควบคุมอาหารที่มีโซเดียมสูง และแคลเซียมสูง เช่น นม ถั่วลิสง ของเค็มทุกชนิด";	
                }else if($etc["result"]>=7 && $etc["result"]<=18){
                    $app="การทำงานของไตมีค่าอยู่ในเกณฑ์ปกติ";	
                }else if($etc["result"]<7 ){
                    $app="ผิดปกติ การทำงานของไตต่ำกว่าปกติ";	
                }
                
            }

            if($etc_item == 'CREA'){
                if($etc["result"]>1.3){
                    $app="ผิดปกติ ควรควบคุมอาหารที่มีโซเดียมสูง และแคลเซียมสูง เช่น นม ถั่วลิสง ของเค็มทุกชนิด";	
                }else if($etc["result"]>=0.6 && $etc["result"]<=1.3){
                    $app="การทำงานของไตมีค่าอยู่ในเกณฑ์ปกติ";	
                }else if($etc["result"]<0.6){
                    $app="ผิดปกติ การทำงานของไตต่ำกว่าปกติ";	
                }
            }

            if($etc_item == 'URIC'){
                if($etc["result"]>7.2){
                    $app="ผิดปกติ ควรงดเครื่องดื่มที่มีแอลกอฮอล์ เครื่องในสัตว์ สัตว์ปีก";	
                }else if($etc["result"] >=2.6 && $etc["result"] <=7.2){
                    $app="ระดับกรดยูริคมีค่าอยู่ในเกณฑ์ปกติ";	
                }else if($etc["result"] > 0 && $etc["result"]<2.6){
                    $app="ผิดปกติ ระดับกรดยูริคต่ำกว่าปกติ";	
                }
            }


            if($etc_item == 'CHOL'){
                if($etc["result"]<=200){
                    $app="ระดับไขมันในเลือดมีค่าอยู่ในเกณฑ์ปกติ";	
                }else	if($etc["result"]>200){
                    $app="ผิดปกติ ควรปรับพฤติกรรมการรับประทานอาหาร และออกกำลังกายอย่างสม่ำเสมอ";	
                }else	if($etc["result"]>300){
                    $app="ผิดปกติ ระดับไขมันในเลือดสูงมากผิดปกติ ควรปรึกษาแพทย์";	
                }
            }

            if($etc_item == 'HDL'){
                if($etc["result"]>=40 && $etc["result"]<=60){
                    $app="ระดับไขมันในเลือดมีค่าอยู่ในเกณฑ์ปกติ";	
                }else	if($etc["result"]>60){  //สูงดี
                    $app="การมีระดับ HDL สูง จะทำให้ลดภาวะเสี่ยงต่อโรคเส้นเลือดหัวใจตีบ";	
                }else	if($etc["result"]<40){  //ต่ำไม่ดี
                    $app="ผิดปกติ ควรปรับพฤติกรรมการรับประทานอาหาร และออกกำลังกายอย่างสม่ำเสมอ";	
                }
            }

            if($etc_item == 'TRIG'){
                if($etc["result"]<=150){
                    $app="ระดับไขมันในเลือดมีค่าอยู่ในเกณฑ์ปกติ";	
                }else	if($etc["result"]>150 && $etc["result"]<250){
                    $app="ผิดปกติ ควรปรับพฤติกรรมการรับประทานอาหาร และออกกำลังกายอย่างสม่ำเสมอ";	
                }else	if($etc["result"]>250){
                    $app="ผิดปกติ ระดับไขมันในเลือดสูงมากผิดปกติ ควรปรึกษาแพทย์";	
                }
            }

            if($etc_item == '10001'){
                if($etc["result"]>=0 && $etc["result"]<=100){
                    $app="ระดับไขมันในเลือดมีค่าอยู่ในเกณฑ์ปกติ";	
                }else	if($etc["result"]>100){
                    $app="ผิดปกติ ควรปรับพฤติกรรมการรับประทานอาหาร และออกกำลังกายอย่างสม่ำเสมอ";	
                }
            }

            if($etc_item == 'LDL'){
                if($etc["result"]>=0 && $etc["result"]<=100){
                    $app="ระดับไขมันในเลือดมีค่าอยู่ในเกณฑ์ปกติ";	
                }else	if($etc["result"]>100){
                    $app="ผิดปกติ ควรปรับพฤติกรรมการรับประทานอาหาร และออกกำลังกายอย่างสม่ำเสมอ";	
                }
            }

            if($etc_item == 'LDLC'){
                if($etc["result"]>=0 && $etc["result"]<=100){
                    $app="ระดับไขมันในเลือดมีค่าอยู่ในเกณฑ์ปกติ";	
                }else	if($etc["result"]>100){
                    $app="ผิดปกติ ควรปรับพฤติกรรมการรับประทานอาหาร และออกกำลังกายอย่างสม่ำเสมอ";	
                }
            }

            if($etc_item == 'AST'){  //SGOT
                if($etc["result"]>=15 && $etc["result"]<=37){
                    $app="การทำงานของตับปกติ";	
                }else	if($etc["result"]>37){
                    $app="การทำงานของตับผิดปกติ";	
                }else	if($etc["result"]<15){
                    $app="การทำงานของตับผิดปกติ";	
                }
            }
            if($etc_item == 'ALT'){  //SGPT
                if($etc["result"]>=0 && $etc["result"]<=50){
                    $app="การทำงานของตับปกติ";		
                }else{
                    $app="การทำงานของตับผิดปกติ";	
                }
            }

            if($etc_item == 'ALP'){  //ALK
                if($etc["result"]>=46 && $etc["result"]<=116){
                    $app="การทำงานของตับปกติ";	
                }else	if($etc["result"]>116){
                    $app="การทำงานของตับผิดปกติ";	
                }else	if($etc["result"]<46){
                    $app="การทำงานของตับผิดปกติ";	
                }
            }

            if($etc_item == 'HBSAG'){  //HBSAG
                if($etc["result"]=="Negative"){
                    $app="ปกติ";	
                }else if($etc["result"]=="Positive"){
                    $app="ตรวจพบการติดเชื้อไวรัสตับอักเสบชนิด";	
                }
            }

            if($etc_item == 'ANTIHB'){  //HBSAB
                if($etc["result"]=="Negative"){
                    $app="ปกติ";	
                }else if($etc["result"]=="Positive"){
                    $app="ผิดปกติ";	
                }
            }

            if($etc_item == 'OCCULT'){  //STOCB
                if($etc["result"]=="Negative"){
                    $app="ปกติ";	
                }else if($etc["result"]=="Positive"){
                    $app="ผิดปกติ";	
                }
            }

            if($etc_item == 'METAMP'){  //METAMP
                if($etc["result"]=="Negative"){
                    $app="ปกติ";	
                }else if($etc["result"]=="Positive"){
                    $app="ผิดปกติ";	
                }
            }
            

            ?>
            <td><?=$etc['result'];?></td>
            <td><?=$etc['normalrange'];?></td>
            <td><?=$app;?></td>
            <?php
        }
        ?>

    </tr>
    <?php

    // echo "<hr>";
}
?>
</table>
