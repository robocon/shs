<?php
include_once dirname(__FILE__).'/bootstrap.php';
if(empty($_SESSION['sOfficer'])){
    include 'pageNotFound.php';
    exit;
}

$hn = $_GET['hn'];
$ddrugrxDate = $_GET['ddrugrx_date'];
$ddrugrxId = $_GET['ddrugrx_id'];
$dphardepId = $_GET['dphardep_id'];
$drugcode = $_GET['drugcode'];

$sql = "SELECT * FROM `drugrx` WHERE `datedr` = '$ddrugrxDate' AND `drugcode` = '$drugcode' ";
$q = $dbi->query($sql);
if($q->num_rows>0){
    $drugrx = $q->fetch_assoc();
    list($drugrxDate, $drugrxTime) = explode(' ', $drugrx['date']);
    list($y,$m,$d) = explode('-', $drugrxDate);
    $slcode = $drugrx['drug_inject_slip'];
    $sqlDrugslip = "SELECT * FROM `drugslip` WHERE `slcode` = '$slcode' ";
    $qSlip = $dbi->query($sqlDrugslip);
    $slip = $qSlip->fetch_assoc();

    $sqlDphardep = "SELECT * FROM `dphardep` WHERE `row_id`='$dphardepId' ";
    $qDphardep = $dbi->query($sqlDphardep);
    $dphardep = $qDphardep->fetch_assoc();
    ?>
    <style>
        *{
            font-family: "Angsana New";
            font-size:16pt;
        }
        p{
            margin: 0;
            padding: 0;
            text-align: center;
        }
    </style>
    <div>
    <p><?= "$d-$m-$y ".$drugrxTime; ?></p>
    <p><?= $dphardep['hn'].' '.$dphardep['ptname']; ?></p>
    <p><?= $drugrx['tradname'].' ('.$drugrx['drugcode'].')' ?></p>
    <?php
    if(!empty($drugrx['drug_inject_amount'])){
        ?>
        <p><?= $drugrx['drug_inject_amount']; ?> <?= $drugrx['drug_inject_unit']; ?></p>
        <?php
    }
    if(!empty($drugrx['drug_inject_amount2'])){
        ?>
        <p><?= $drugrx['drug_inject_amount2']; ?> <?= $drugrx['drug_inject_unit2']; ?></p>
        <?php
    }

    /*
    ?>
    <p><?= $slip['detail1']; ?></p>
    <?php
    if(!empty($slip['detail2'])){
        ?>
        <p><?= $slip['detail2']; ?></p>
        <?php
    }
    if(!empty($slip['detail3'])){
        ?>
        <p><?= $slip['detail3']; ?></p>
        <?php
    }*/
    ?>
    <p>เวลาที่ให้....................น.&nbsp;&nbsp;&nbsp;rate....................ml/hr</p>
    <p>ผู้เตรียม.................... ผู้ให้....................</p>
    </div>
    <script>
        window.onload = function(){
            window.print();
        }
    </script>
    <?php
}else{
    ?>
    <p>ยังไม่ได้ตัด Stock</p>
    <?php
}

exit;
if($_POST["Drugcode"] != "INJ" && isset($_SESSION["druglot_new"]) ){
				
	if($dlot_new == false){
		$_SESSION["druglot_new"] .= "<div style=\"page-break-before: always;\"></div>";
	}else{
		$dlot_new = false;
	}

	$_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='2'><center><b>".$_POST["Ptname"]."</b><br></font>";

	$_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='1'>".$Thaidate."&nbsp;(AN:".$_POST["An"].")&nbsp;HN:".$_POST["Hn"].".&nbsp;&nbsp;NO.".$j."/".$total_item." <br></font>";
	
	$Trade = substr($_POST["Tradname"][$i],0,22);

	$_SESSION["druglot_new"] .= "<font  style='line-height:14px;' face='Angsana New' size='2'><b>$Trade</b>&nbsp;&nbsp;(".$_POST["Drugcode"][$i].")&nbsp;=<B>&nbsp;".$_POST["Amount"][$i]."</B><br></font>";


		$sql = "Select drugname,drugnote,drug_nature,drug_properties From druglst  where drugcode = '".$_POST["Drugcode"][$i]."' limit 0,1 " ;
		$result = Mysql_Query($sql);
		list($drugname,$drugnote,$drug_nature,$drug_properties) = Mysql_fetch_row($result);
		$chkdrugname=trim($drugname);
		$lendrugname=strlen($chkdrugname);
	$_SESSION["druglot_new"] .= "<font style='line-height:16px;' face='Angsana New' size='2'><b>".$detail1."</b></font><br>";
	$_SESSION["druglot_new"] .= "<font style='line-height:16px;' face='Angsana New' size='2'><b>".$detail2."</b></font><br>";
	
	if($j == $total_item){
		if($detail3 !="")
			$_SESSION["druglot_new"] .= "<font style='line-height:16px;' face='Angsana New' size='2'><b>".$detail3."</b></font><br>";
		if($drug_properties !="")  //ถ้ามีสรรพคุณ
			$_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='1'><b><u>".$drug_properties."</u></b></font><br>";
		
		if($drugnote !="")  //ถ้ามีคำเตือน
			$_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='1'><b>".$drugnote."</b></font>";
		
	}else{
			if($detail3 !="")
			$_SESSION["druglot_new"] .= "<font style='line-height:16px;' face='Angsana New' size='2'><b>".$detail3."</b></font><br>";  //br 2 อัน
		if($drug_properties !="")  //ถ้ามีสรรพคุณ
			$_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='1'><b><u>".$drug_properties."</u></b></font><br>";														
		if($drugnote !="")  //ถ้ามีคำเตือน
			$_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='1'><b>".$drugnote."</b></font>";  
	}
	//$_SESSION["druglot_new"] .= "<font face='Angsana New' >".$detail4."<br><br><BR></font>";
}






for($i=0;$i<$item;$i++){
	
	$drugcode2 = $_POST["Drugcode"][$i];
	if(($drugcode2[0] == "0" || $drugcode2[0] == "2") && !(ord($drugcode2[1])  >= 48 && ord($drugcode2[1]) <= 57 )){
		
		$drugslipHTML = '';
		$sql = "SELECT `detail1`,`detail2`,`detail3` FROM `drugslip` WHERE `slcode` = '".$_POST["Slipcode"][$i]."'  ";
		$result = Mysql_Query($sql);
		if(mysql_num_rows($result) > 0){
			list($lotnew_detail1,$lotnew_detail2,$lognew_detail3) = Mysql_fetch_row($result);

			if(!empty($lotnew_detail1)){
				$drugslipHTML .= "<font style='line-height:16px; font-size:13px;' face='Angsana New'><b>".$lotnew_detail1."</b></font><br>";
			}
			if(!empty($lotnew_detail2)){
				$drugslipHTML .= "<font style='line-height:16px; font-size:13px;' face='Angsana New'><b>".$lotnew_detail2."</b></font><br>";
			}
			if(!empty($lognew_detail3)){
				$drugslipHTML .= "<font style='line-height:14px; font-size:13px;' face='Angsana New'><b>".$lognew_detail3."</b></font><br>";
			}
			
		}

		for($j=0;$j<$_POST["stiker"][$i];$j++){
			if($j%2 == 0){
				$_SESSION["druglot_new"] .= "<div style=\"page-break-before: always;\"></div>";
			}else{
				$_SESSION["druglot_new"] .= "<hr>";
			}
			$_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='2'><B>".$Thaidate."<BR>".$_POST["Hn"]."  ".$_POST["Ptname"]." เตียง".$_POST["Bed"]."  <br>".$_POST["Tradname"][$i]."&nbsp;&nbsp;(".$_POST["Drugcode"][$i].")</B></font>";
			$_SESSION["druglot_new"] .= "<br>";

			if(!empty($drugslipHTML)){
				$_SESSION["druglot_new"] .= $drugslipHTML;
			}

			$_SESSION["druglot_new"] .= "<div style=\"text-align:center;\">
				<div style=\"font-size: 13px; font-family:'Angsana New'; line-height:14px;\">เวลาที่ให้....................น.&nbsp;&nbsp;&nbsp;rate....................ml/hr</div>
				<div style=\"font-size: 13px; font-family:'Angsana New'; line-height:14px;\">ผู้เตรียม.................... ผู้ให้....................</div>
			</div>";
			
			// $_SESSION["druglot_new"] .= '<table style="font-size: 13px;font-family:Angsana New;border-collapse: collapse;">
			// <tr><td style="line-height: 14px;">เวลาที่ให้....................น.</td><td style="line-height: 14px;">rate....................ml/hr</td></tr>
			// <tr><td style="line-height: 14px;">ผู้เตรียม....................</td><td style="line-height: 14px;">ผู้ให้....................</td></tr>
			// </table>';
		}
	}
}