<?php 

include 'bootstrap.php';

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

    return $pAge;
}

?>
<style>
@media print{
    .hide-div{
        display: none;
    }
}
body{
    padding: 0;
    margin: 0;
    font-family: TH SarabunPSK, TH Sarabun New;
}
</style>

<div class="hide-div">
    <a href="../nindex.htm">&lt;&lt;&nbsp;กลับไปหน้าหลัก รพ.</a>
</div>

<form action="sticker_sur.php" method="post" class="hide-div">

    <div>
        <label for="hn">HN: <input type="text" name="hn" id="hn"></label>
    </div>

    <div>
        <button type="submit">แสดงผล</button>
        <input type="hidden" name="action" value="show">
    </div>

</form>
<?php

$action = input_post('action');
if ( $action === 'show' ) {
    
    $db = Mysql::load();
    $hn = input_post('hn');
	$date=(date("Y")+543).date("-m-d");
    $sql = "SELECT * 
    FROM ( 
        SELECT * FROM `opcard` WHERE `hn` = '$hn' LIMIT 1 
    ) AS a 
    LEFT JOIN ( 
        SELECT `hn`,`vn` FROM `opday` WHERE `thidate` LIKE '$date%' AND `hn` = '$hn' ORDER BY `row_id` DESC LIMIT 1 
    ) AS b ON b.`hn` = a.`hn` 
    ";
	//echo $sql;
    $db->select($sql);

    $items = $db->get_item();
	
	
	if($items['hn']=="54-1681"){
	//echo "-->".$items['hn'];
		$vn="200";
	}else{
		$vn=$items['vn'];
	}
	
    ?>
    <div>
        <div> <b>ชื่อ-สกุล:</b> <?=$items['yot'].$items['name'].' '.$items['surname'];?> </div>
        <div> <b>อายุ:</b> <?=calcage($items['dbirth']);?> </div>
        <div> <b>HN:</b> <?=$items['hn'];?> <b>VN:</b> <?=$vn;?> </div>
        <div> <b>สิทธิ:</b> <?=$items['ptright'];?> </div>
    </div>
    <?php


    ?>
    <script>
        window.onload = function(){
            window.print();
        }
    </script>
    <?php
}