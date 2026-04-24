<?php
session_start();
require_once dirname(__FILE__).'/includes/config.php';
include_once dirname(__FILE__).'/connect.php';

$bsConn = mysqli_connect(BLOOD_SERVER,BLOOD_USER,BLOOD_PASS,BLOOD_DB);
$bsConn->query("SET NAMES UTF8");

$def_month_th = array('01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค', '04' => 'เม.ษ.', '05' => 'พ.ค.', '06' => 'มิ.ย.', '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.');

$sIdname = $_SESSION['sIdname'];
if (!isset($sIdname)){
	?>
	<p>SESSION การเข้าใช้งานหมดอายุ <a href="../nindex.htm">คลิกที่นี่</a> เพื่อ Login ใหม่อีกครั้ง</p>
	<?php
	exit;
}

$sRowid = urlencode(sprintf("%s", $_SESSION['sRowid']));

?>
<link href="css/style_table.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
<a name="top" id="top"></a>
<style>
.a-button {
	border: 1px solid black;;
	color: #000000;
	padding: 2px 6px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	cursor: pointer;
	border-radius: 4px;
	font-size: 18px;
	font-family: "TH SarabunPSK";
}
.a-button:hover{
	box-shadow: 3px 3px 3px #3e3e3e;
}
.a-green{
	background-color: #198754;
	color: #ffffff!important;
}
</style>
<br />
<?php
	$lbedcode = substr($_GET['code'], 0, 2);
	if ($lbedcode == '42') {
		$wardname = "หอผู้ป่วยรวม";
		$sortname = "รวม";
	} elseif ($lbedcode == '43') {
		$wardname = "หอผู้ป่วยสูติ";
		$sortname = "สูติ";
	} elseif ($lbedcode == '44') {
		$wardname = "หอผู้ป่วยICU";
		$sortname = "ICU";
	} elseif ($lbedcode == '45') {
		$wardname = "หอผู้ป่วยพิเศษ";
		$sortname = "พิเศษ";
	} elseif ($lbedcode == '46') {
		$wardname = "หอผู้ป่วย Cohort Ward";
		$sortname = "cohortward";
	} elseif ($lbedcode == '47') {
		$wardname = "ผู้ป่วย Home Isolation";
		$sortname = "Home Isolation";
	} elseif ($lbedcode == '48') {
		$wardname = "ผู้ป่วย รพ.สนาม";
		$sortname = "รพ.สนาม";
	}
	
	$bbbbcode=$lbedcode;
	include("calroom.php");
	include("alert_booking.php");
	?>
<strong style="font-size:24px"><?=$wardname;?></strong> &nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='ipdcost.php'>รวมเงินทุกเตียง</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href='ipstikerdrug.php'>STICKER</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href='booking_system/booking_confirm.php?code=<?=$lbedcode?>'>ระบบจองเตียง</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank"  href="med_record.php?code=<?=$lbedcode;?>">Med Record</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank"  href="ipptchk.php">รายชื่อผู้ป่วยใน</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank"  href="report_opsihitoday.php">รายงานข้อมูลสถิติผู้ป่วยโควิด</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank"  href="<?=NOTIFY_HOST_CAMERA;?>/testqrcode/show_dataipd.php?sRowid=<?=$sRowid;?>">QR ผู้ป่วยใน</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_self"  href="../nindex.htm">ไปเมนู</a>
<br />
<?
if($lbedcode=='47'){
	$query = "SELECT idcard,bed,date,date_format(date,'%d- %m- %Y'),ptname,an,hn,diagnos,food,doctor,ptright,price,paid,debt,caldate,bedname,bedcode,hn,chgdate,status,age,diag1,days FROM bed WHERE bedcode LIKE '$lbedcode%' ORDER BY row_id ASC ";
}else{
	$query = "SELECT idcard,bed,date,date_format(date,'%d- %m- %Y'),ptname,an,hn,diagnos,food,doctor,ptright,price,paid,debt,caldate,bedname,bedcode,hn,chgdate,status,age,diag1,days FROM bed WHERE bedcode LIKE '$lbedcode%' ORDER BY bedcode ASC ";
}
$result = mysql_query($query)or die("Query failed");

$i=1;

while (list ($idcard,$bed,$date1,$date,$ptname,$an,$hn,$diagnos,$food,$doctor,$ptright,$price,$paid,$debt,$caldate,$bedname,$bedcode,$hn,$chgdate,$status,$age,$diag1,$daysall) = mysql_fetch_row ($result)) {

if($diag1=='' and $an!=''){ $diag1='ไม่มี'; }
$status2 = substr($status,0,3);

$time=explode(" ",$date1);

switch($status2){
	case "B01" : $color="#66FFCC"; break;
	case "B02" : $color="#FF9999"; break;
	case "B03" : $color="#FFFF99"; break;
}

if($an=='' and $status2=="B01"){
	$color="#FFFFFF";
}

$idcard=$idcard.'.jpg';

if(file_exists("../image_patient/$idcard")){
	$img="../image_patient/$idcard";
}else{
	$img='../image_patient/NoPicture.jpg';
}

$sql = "SELECT hi_type FROM ipcard  WHERE `an` = '".$an."' limit 1 ";
$rows = mysql_query($sql);
list($hi_type) = Mysql_fetch_row($rows);

	if($hi_type=="in"){
		$location="ผู้ป่วย HI รักษาเรือนรับรอง";
	}else 	if($hi_type=="out"){
		$location="ผู้ป่วย HI รักษาที่บ้าน";
	}else{
		$location="";
	}

	$bloodItems = array();
	if(!empty($hn)){
		$sqlTrnBlood = "SELECT * 
		FROM `mst_stock` 
		WHERE `Hn_Reserved` = '$hn' 
		AND `Exp_Date` > CURDATE() 
		AND `Flag_Reserved`='Y' 
		AND `Unit_Number` NOT IN ( SELECT `Unit_Number` FROM `trn_blood` )";
		$qTrn = $bsConn->query($sqlTrnBlood);
		if($qTrn->num_rows>0){
			while ($a = $qTrn->fetch_assoc()) {
				$bloodItems[] = array(
					'bloodGroup'=>$a['Blood_Group'], 
					'expireDate'=>$a['Exp_Date'],
					'unitNumber'=>$a['Unit_Number']
				);
			}
		}
	}
	

$sql1 = "SELECT idguard FROM opcard  WHERE `hn` = '".$hn."' limit 1 ";
$rows1 = mysql_query($sql1);
list($idguard) = Mysql_fetch_row($rows1);


$sql_ipacc="SELECT sum(price),sum(paid),sum(yprice),sum(nprice) FROM `ipacc` WHERE an='$an'";
$row_ipacc = mysql_query($sql_ipacc);
list($sumprice,$sumpaid,$sumyprice,$sumnprice) = Mysql_fetch_row($row_ipacc);
?>
<script type="text/javascript">
$(document).ready(function(){

<? if($color=="#FFFFFF" || $color=="#FF9999" || $color=="#FFFF99"){?>
	$("#div<?=$i;?>").hide();
<? } ?>
	$("#btn2<?=$i;?>").click(function(){
		$("#div<?=$i;?>").hide(1000);
	});

	$("#btn1<?=$i;?>").click(function(){
		$("#div<?=$i;?>").show(1000);
	});

});
</script>
 
<br />เตียง : <?=$bed;?>&nbsp;&nbsp; <?=$status;?>&nbsp;&nbsp; 
<input type="button" id="btn1<?=$i;?>" value="แสดงเตียง">
<input type="button" id="btn2<?=$i;?>" value="ซ่อนเตียง">
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#000000" bgcolor="<?=$color;?>" >
  <tr>
    <td>
    <div id="div<?=$i;?>">
    <table width="100%" border="0">
	  <tr>
        <td width="25%">
		<a name="<?=$bed;?>" id="<?=$bed;?>"></a>
		<font class="bed">
			<?php
			$food = htmlspecialchars($food, ENT_QUOTES);
			$href = "ipbed.php?cBed=$bed&cDate=$date&cPtname=$ptname&cAn=$an&cDiagnos=$diagnos&cFood=$food&cDoctor=$doctor&cPtright=$ptright&cBedcode=$bedcode&cHn=$hn&cChgdate=$chgdate&cbedname=$wardname";
			echo"<a href=\"$href\" class=\"bed\">$bed</a>";
			?>
		</font>&nbsp;&nbsp;&nbsp;
		<? echo "<a target=_blank  href=\"bedstatus.php?cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cstatus=$status\" class='tablefont'>$status</a>"; ?></td>
        <td > 
			<font class="tablefontt1">AN : </font><font class="tablefont"><a href="show_wardlog.php?sAn=<?=$an;?>" target="_blank"><?=$an;?></a></font>&nbsp;&nbsp;&nbsp;<font class="tablefontt1"> HN : </font><font class='tablefont'><?=$hn; ?></font> &nbsp;&nbsp;&nbsp;<font class="tablefontt1">วันที่รับป่วย : </font>
			<font class="tablefont"> <?=$date.' '.$time[1];?></font>&nbsp;&nbsp;&nbsp;<font class="tablefontt1">วันนอนรวม </font>
			<font class="tablefont"> <?=$daysall;?> วัน</font>
			<?php
			if($sumnprice > 0){
			?>	
			<div style="position:relative; float: right; width:380px;">
			<div style="position:absolute; top:0; right:0;">
				<div>
					<span style="background-color: #EC7063; border: 1px solid black; place-items: center; padding:8px;"><a href="ipacc.php?cAn=<?= $an ?>&cAccno=1" target="_blank">ค่าหัตถการ/ตรวจวินิจฉัย</a> เบิกไม่ได้ : <?=$sumnprice;?> บาท</span>
					<img src="images/profile.png" width="32" height="32">
				</div>
			</div>
			<?php } ?>
		</div>
        </td>
        </tr>
      <tr>
        <td colspan="2">
        <table  border="0">
          <tr  style="line-height:22PX;">
            <td  rowspan="5"><img src="<?=$img;?>" width="81" height="101" /></td>
            <td class="tablefontt1">ชื่อ-สกุล</td>
            
            <td class="tablefontt2"> <? echo "<a target=_blank  href=\"ipdata1.php?cBedcode=$bedcode\">$ptname</a>"; ?>&nbsp;&nbsp;&nbsp;</td>
            <td class="tablefontt1">อายุ :</td>
            <td class="tablefont"><?=$age;?>&nbsp;&nbsp;&nbsp;</td>
          
            <td class="tablefontt1">สิทธิการรักษา  :</td>
            <td class="tablefont">
				<?php 
				if(!empty($ptright)){
					echo $ptright;
					$chkptright=substr($ptright,0,3);
					if($chkptright=="R07"){
						echo "<span style='margin-left:20px; font-size:18px; color:red;'>ไม่สามารถเรียกเก็บค่ายา/เวชภัณฑ์ผู้ป่วยได้ ยกเว้นแพทย์มีความจำเป็นต้องใช้ยาที่เกินสิทธิการรักษา</span>";
					}	
				}else{
					?>
					<strong style="color:red;"><u>กรุณาติดต่อทะเบียนเพื่ออัพเดทสิทธิ์การรักษา</u></strong>
					<?php
				}
				?>
			</td>
			
            <td class="tablefontt1">ประเภท  :</td>
            <td class="tablefont"><u><i><?=$idguard;?></i></u></td>			
          </tr>
          <tr style="line-height:22PX;">
            <td colspan="8"  valign="top" >
            <font class='tablefontt1'>โรค : </font><? echo "<a target=_blank  href=\"ipdiag.php?cAn=$an&cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cDiag=$diagnos&cbedname=$wardname\" class='tablefont3'>$diagnos</a>";?>&nbsp;&nbsp;&nbsp;
            <font class='tablefontt1'>แพทย์  : </font> <? echo "<a target=_blank  href=\"ipdr.php?cAn=$an&cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cDoctor=$doctor&cbedname=$wardname\" class='tablefont3' >$doctor</a>"; ?>&nbsp;&nbsp;&nbsp;
            
            <font class='tablefontt1'>โรคประจำตัว  : </font>
           <font class='tablefont'> <? echo "<a target=_blank  href=\"ipdiag1.php?cAn=$an&cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cDiag=$diag1&cbedname=$wardname\">$diag1</a>";?></font>
            </td>
            </tr>
          <tr style="line-height:22PX;">
            <td colspan="8"  valign="top">
            <font class='tablefontt1'>อาหาร : </font><? echo "<a target=_blank  href=\"ipfood.php?cAn=$an&cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cFood=$food&cbedname=$wardname\" class='tablefont3'>$food</a>"; ?><strong style="margin-left:20px; color:#FC0944;"><?php echo $location;?></strong></td>
          </tr>
          <tr style="line-height:25PX;">
            <td colspan="10" valign="top" ><font class='tablefontt1'>หัตถการ  :</font>
			<?php
			$str = "month=".date('m')."&year=".(date('Y')+543)."&date=".date('dmy');
			?>
			<? echo "<a target=_blank  href=\"ipdata.php?cBedcode=$bedcode\" class='tablefont'>บันทึกค่าใช้จ่าย / คืนยา / จำหน่าย</a>"; ?> &nbsp;&nbsp; 
			<? echo "<a target=_blank href=\"wpreappoi.php?an=$an&cBed=$bed&cBedcode=$bedcode&cHn=$hn&cbedname=$wardname\" class='tablefont'>สั่ง LAB</a>"; ?> &nbsp;&nbsp; 
            <? echo "<a target=_blank  href=\"dt_lab_lst_in.php?hn_now=$hn\" class='tablefont'>ดูผล LAB</a>";?>&nbsp;&nbsp; 
            <? echo "<a target=_blank  href=\"dt_xray_film_in.php?hn_now=$hn\" class='tablefont'>ดูฟิลม์ xray</a>";?>&nbsp;&nbsp; 
            <? echo "<a target=_blank  href=\"rp_profile.php?an=$an&$str\" class='tablefont'>Drugprofile</a>";?>&nbsp;&nbsp; 
            <? echo "<a target=_blank  href=\"warddividedrug.php?an=$an&$str\" class='tablefont'>ยาปัจจุบัน</a>";?>&nbsp;&nbsp;  
            <? echo "<a target=_blank  href=\"set_from_ward.php?an=$an&bedcode=$lbedcode\" class='tablefont'>ใบSETผ่าตัด</a>"; ?>
			<?php
			$test_enable = false;
			if($test_enable && $an){
				$bReqText = 'ใบขอเลือด';
				$bReqOnClick = 'onclick="window.open(\'blood_request.php?an='.$an.'&bedcode='.$bedcode.'\',\'bloodRequestWindow\',\'width=800,height=600\');"';
				?><a href="javascript:void(0);" <?= $bReqOnClick; ?> class="a-button a-green tablefont"><?= $bReqText; ?></a><?php
			}
			?>
            </td>
          </tr>
          <tr style="line-height:25PX;">
		  	<?php 
			$ptname_encode = rawurlencode($ptname);
			$sortname_encode = rawurlencode($sortname);
			?>
            <td colspan="10" valign="top" ><font class='tablefontt1'>ฉลาก : </font><? echo "<a target=_blank  href=\"drug1a.php?Ptname=$ptname_encode&cAn=$an&cBed=$bed&cBedcode=$bedcode&cHn=$hn&cbedname=$sortname_encode\" class='tablefont3'>ยา(1 ดวง)</a>";?>&nbsp;&nbsp; <? echo "<a target=_blank  href=\"ipbeddrug.php? cAn=$an &cBed=$bed & cBedcode=$bedcode & cHn=$hn & cPtname=$ptname & cbedname=$wardname\" class='tablefont3'>ยา(A4)</a>"; ?>&nbsp;&nbsp; <? echo "<a target=_blank  href=\"ipbed1.php? cAn=$an &cBed=$bed & cBedcode=$bedcode & cHn=$hn & cbedname=$wardname\"  class='tablefont3'>เอกสาร(A4)</a>";?>&nbsp;&nbsp; <? echo "<a target=_blank  href=\"liststk.php?cAn=$an&cBed=$bed& cBedcode=$bedcode&cHn=$hn&cbedname=$sortname_encode\" class='tablefont3'>เอกสาร(1 ดวง)</a>";?>
			&nbsp;&nbsp; <? echo "<a target=_blank  href=\"anchkstkeye.php?action=print&an=$an&hn=$hn\" class='tablefont3'>สติ๊กเกอร์ผู้ป่วยใน</a>";?>
			&nbsp;&nbsp; <? echo "<a target=_blank  href=\"anchkstkeye_wristband.php?action=print&an=$an&hn=$hn\" class='tablefont3'>ริชแบนด์ผู้ป่วยใน</a>";?></td>
		  </tr>
		  <tr>
			<td colspan="10">
				<div>
					<?php
					if($an){
					?><a href="med_ward.php?fill_an=<?=$an;?>" target="_blank" class="a-button a-green tablefont">📤 อัพโหลดไฟล์ Doctor Order</a><?php
					}
					?>
				<style>
					.bloodContainer{
						display: inline-block;
						margin-right: 0.5em;
						font-family: "TH SarabunPSK";
						font-size: 18px;
						border: 2px solid red;
						border-radius: 6px;
						padding: 4px 6px;
						background-color: pink;
					}
				</style>
				<?php
				if(!empty($bloodItems)){
					foreach ($bloodItems as $blood) {
						list($expY, $expM, $expD) = explode('-', $blood['expireDate']);
						$expDateTh = $expD.' '.$def_month_th[$expM].' '.($expY + 543);
						?>
						<span class="bloodContainer">🩸 ถุงเลือด ( <?= $blood['bloodGroup'] ?> ) <strong>Unit Number</strong>: <?= $blood['unitNumber'] ?> <strong>วันหมดอายุ</strong>: <?= $expDateTh ?></span>
						<?php
					}
				}
				?>
				</div>
			</td>
		  </tr>
        </table></td>
      </tr>
    </table>
    

		<? 
		$sql_bacteria = "SELECT * FROM bacteria_resistant  WHERE `hn` = '".$hn."' AND Alert_Flag = 'Y' ORDER BY Id DESC ";
		$rows_bacteria = mysql_query($sql_bacteria);
		$num_bacteria = mysql_num_rows($rows_bacteria);
		if(!empty($num_bacteria)){
		?>
        	<table border="0" >
        	<?  
        		while($rows = mysql_fetch_array($rows_bacteria)){
        				echo "<td style='background-color: #CD5C5C;'>";
        				echo "<img src='beacteria_img/alert.png' width='20' height='20'> เชื้อที่พบ : <font color=white>".$rows['Bacteria_Name']." <br></font>";	
        				echo "แหล่งกำเนิด : <font color=white>".$rows['Bacteria_Source']." </font> 
        							ชื่อยา : <font color=white>".$rows['Drug_Name']."<br></font>";

        				//---> convert date 2024-05-01 to 01-05-2567
        				$tmp_y = substr($rows['Date_Send'],0,4)+543;
        				$tmp_m = substr($rows['Date_Send'],5,2);
        				$tmp_d = substr($rows['Date_Send'],8,2);
        				$Date_Send_Th = $tmp_d."-".$tmp_m."-".$tmp_y;
        				echo "วันที่ส่งตรวจ : <font color=white>".$Date_Send_Th." <br></font>";
        				echo "Ward : <font color=white>".$rows['Ward']." <br></font>";

        				if($rows['Alert_Status'] != ""){
        					echo "หมายเหตุ : <font color=white>".$rows['Alert_Status']." <br></font>";
        				}//end if Alert_Status

        				echo "</td> ";

        				echo "<td'> </td>";
        		}//end while
        			echo "</tr></table>";
        	} // !empty($num_bacteria)
        	?>

    </div>
    
    </td>
  </tr>
</table>

<a  href="#top" class="tablefont3">^ Back to Top</a>
<? 

$i++;
}
?>