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
    
    $db = Mysql::load($shs_configs);
    $hn = input_post('hn');

    $sql = "SELECT * 
    FROM ( 
        SELECT * FROM `opcard` WHERE `hn` = '$hn' LIMIT 1 
    ) AS a 
    LEFT JOIN ( 
        SELECT `hn`,`vn` FROM `opday` WHERE `hn` = '$hn' ORDER BY `row_id` DESC LIMIT 1 
    ) AS b ON b.`hn` = a.`hn`";
    $db->select($sql);

    $item = $db->get_item();

    ?>
    <div>
        <div> <b>ชื่อ-สกุล:</b> <?=$item['yot'].$item['name'].' '.$item['surname'];?> </div>
        <div> <b>อายุ:</b> <?=calcage($item['dbirth']);?> </div>
        <div> <b>HN:</b> <?=$item['hn'];?> <b>VN:</b> <?=$item['vn'];?> </div>
        <div> <b>สิทธิ:</b> <?=$item['ptright'];?> </div>
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