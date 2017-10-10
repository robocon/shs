<?php


include 'bootstrap.php';
$db = Mysql::load();

// YYMMDD
$checkup_date_code = '171010';
$part = 'postdeploy61';
$title_part = 'postdeploy61';
$thai_date = (date("Y")+543)."-".date("m-d H:i:s");
$en_date = date("Y-m-d H:i:s");

$pt_prefix = '61.';

$action = input('action');

if ( $action === false ) {
    ?>
    <form action="postdeploy61.php" method="post" enctype="multipart/form-data">
		<div>
			ไฟล์นำเข้า : <input type="file" name="file">
			<div><span style="color: red; font-size: 14px;">รองรับไฟล์ .csv</span></div>
		</div>
		<div>
			<button type="submit">นำเข้า</button>
			<input type="hidden" name="action" value="import">
		</div>
	</form>
    <ul>
        <li><a href="postdeploy61.php?action=print_lab">Print ใบสติ๊กเกอร์</a></li>
        <li><a href="postdeploy61.php?action=import_lab">นำเข้า Lab</a></li>
        <li><a href="postdeploy61.php?action=print_list">พิมพ์รายชื่อ</a></li>
    </ul>
    <?php
}else if ( $action === 'import' ) {
    
    exit;
    
    $file = $_FILES['file'];
	$content = file_get_contents($file['tmp_name']);
	if( $content !== false ){
	
        $items = explode("\r\n", $content);

        $sql = "SELECT MAX(`row`) AS `lastrow` FROM `opcardchk` LIMIT 1";
		$db->select($sql);
		$chk = $db->get_item();
		$last_id = (int) $chk['lastrow'];

        $i = 0;
        foreach ($items as $key => $item) {

            ++$i;
            ++$last_id;

            list($nubmer, $exam_no, $yot, $name, $surname, $branch) = explode(',', $item);

            if( !empty($exam_no) ){

                $first_name = $yot.$name;
                $hn = $pt_prefix.$exam_no;
    
                $sql = "INSERT INTO `opcardchk`
                (`HN`,
                `row`,
                `exam_no`,
                `pid`,
                `idcard`,
                `name`,
                `surname`,
                `dbirth`,
                `agey`,
                `part`,
                `branch`,
                `datechkup`)
                VALUES (
                '$hn',
                '$last_id',
                '$exam_no',
                '$i',
                NULL,
                '$first_name',
                '$surname',
                NULL,
                NULL,
                '$part',
                '$branch',
                '10 ตุลาคม 2560');
                ";
                // dump($sql);
                $insert = $db->insert($sql);
                dump($insert);

            }
            
            // if( $i === 1 ){ exit; }
        }

        
    }

} else if ( $action === 'print_lab' ) {
    

    $sql = "SELECT a.*
	FROM `opcardchk` AS a 
	WHERE a.`part` = '$part' 
    AND a.`datechkup` = '10 ตุลาคม 2560' 
	ORDER BY a.`row` ASC";
    $db->select($sql);
    $items = $db->get_items();
    
    $ii = 0;
    foreach ($items as $key => $item) {
        
        ++$ii;

        $exam_no = $item['exam_no'];
        $lab_chem = $checkup_date_code.$exam_no."02";
        $ptname = $item['name'].' '.$item['surname'];
        $hn = $item['HN'];
        
        // ปริ้นเผื่อมาสัก 3 ใบ พี่สมยศบอก
        for ($i=0; $i < 3; $i++) { 
            ?>
            
            <font style='line-height:25px;' face='Angsana New' size='8'><center><b><?=$exam_no;?></b></center></font>
            <font style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$ptname;?></b></center></font>
            <font style='line-height:23px;' face='Angsana New' size='6'><center><b>HN: <?=$hn;?></b></center></font>
            
            <!--<font style='line-height:10px;' face='Angsana New' size='3'><center><b><?=$lab_chem;?></b></center></font>
            <center><span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$lab_chem;?>"></span></center>-->
            <div style="page-break-before: always;"></div>
            <?php
        }

        // if( $ii == 5 ){ exit; }
        
    }

    


}else if ( $action === 'import_lab' ) {

    exit;

    $sql = "SELECT a.*
	FROM `opcardchk` AS a 
	WHERE a.`part` = '$part' 
    AND a.`datechkup` = '10 ตุลาคม 2560' 
	ORDER BY a.`row` ASC";
    $db->select($sql);
    $items = $db->get_items();

    $clinicalinfo = "ตรวจสุขภาพประจำปี61";


    $db->select("SELECT * FROM labcare WHERE code = 'MF' OR code = 'MP' OR code = 'LEPA' OR code = '10574'");
    $lab_list = $db->get_items();

    foreach ($items as $key => $item) {


        $last_labnumber = $exam_no = $item['exam_no'];
		$labnumber = $checkup_date_code.$exam_no;
        $hn = $pt_prefix.$exam_no;
        $ptname = $item['name'].' '.$item['surname'];

        // $gender = ( $item['sex'] === 'ช' ) ? 'M' : 'F' ;
        $gender = 'M';

        $orderhead_sql = "INSERT INTO `orderhead` ( 
            `autonumber`, 
            `orderdate`, 
            `labnumber`, 
            `hn`, 
            `patienttype`, 
            `patientname`, 
            `sex`, 
            `dob`, 
            `sourcecode`, 
            `sourcename`, 
            `room`, 
            `cliniciancode`, 
            `clinicianname`, 
            `priority`, 
            `clinicalinfo` 
        ) VALUES (
            '', 
            '$en_date', 
            '$labnumber', 
            '$hn', 
            'OPD', 
            '$ptname', 
            '$gender', 
            '', 
            '', 
            '', 
            '', 
            '', 
            'MD022 (ไม่ทราบแพทย์)', 
            'R', 
            '$clinicalinfo'
        );";
        // dump($orderhead_sql);
        $orderhead = $db->insert($orderhead_sql);
        dump($orderhead);
        

        foreach ($lab_list as $key => $lab) {

            $code = $lab['code'];
            $oldcode = $lab['oldcode'];
            $detail = $lab['detail'];

            $orderdetail_sql = "INSERT INTO `orderdetail` ( 
                `labnumber`,`labcode`,`labcode1`,`labname` 
            ) VALUES (
                '$labnumber', '$code', '$oldcode', '$detail'
            );";
            // dump($orderdetail_sql);
            $orderdetail = $db->insert($orderdetail_sql);
            dump($orderdetail);
        }

        echo "<hr>";
        // exit;

    }
    
    


}else if( $action === 'print_list' ){

    $sql = "SELECT a.*
	FROM `opcardchk` AS a 
	WHERE a.`part` = '$part' 
    AND a.`datechkup` = '10 ตุลาคม 2560' 
	ORDER BY a.`row` ASC";
    $db->select($sql);
    $items = $db->get_items();

    ?>
    <table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
        <tr>
            <td>ลำดับ</td>
            <td>HN</td>
            <td>รหัสLab</td>
            <td>ชื่อ-สกุล</td>
            <td>หมายเหตุ</td>
        </tr>
    
    <?php
    foreach ($items as $key => $item) {
        $exam_no = $item['exam_no'];
        $lab_chem = $checkup_date_code.$exam_no."02";
        ?>
        <tr>
            <td><?=$item['pid'];?></td>
            <td><?=$pt_prefix.$item['exam_no'];?></td>
            <td><?=$lab_chem;?></td>
            <td><?=$item['name'].' '.$item['surname'];?></td>
            <td></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php

}





