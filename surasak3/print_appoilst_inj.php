<?php
session_start();
include("connect.inc");

$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
$Thidate2 = (date("Y")+543).date("-m-d"); 

$aEssd=array();
$aNessdy=array();
$aNessdn=array();
$aDPY=array();
$aDPN=array();
$aDSY=array(); 
$aDSN=array();

// แก้ไขให้รองรับการเปลี่ยนวันที่นัดฉีดยาได้
// Override list_date กับ list_date2 ตัวเดิม
$rows = count($_POST['day']);
$i = 0;
$month = array(
	'01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', 
	'07' => 'กรกฏาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม'
);

$new_listdate = array();
$new_listdate2 = array();
for($i; $i<$rows; $i++){
	$m = $_POST['month'][$i];
	
	$new_listdate[] = $_POST['year'][$i].'-'.$_POST['month'][$i].'-'.$_POST['day'][$i];
	$new_listdate2[] = $_POST['day'][$i].' '.$month[$m].' '.$_POST['year'][$i];
}
unset($_POST['day']);
unset($_POST['month']);
unset($_POST['year']);

$_POST['list_date'] = $new_listdate;
$_POST['list_date2'] = $new_listdate2;

// จบ Override list_date กับ list_date2

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

 if(substr($_POST["drug_inj"],0,-2) == "VERORAB" || substr($_POST["drug_inj"],0,-2) == "VERO RABIES" || substr($_POST["drug_inj"],0,-2) == "SPEEDA"){
	$_POST["drug_inj"] = substr($_POST["drug_inj"],0,-2);
 }
 
//******************************* บันทึกข้อมูล **************************************************************

if($_POST["drug_inj"] == "Tetanus Toxoid"){
	$dgcode = "0DT";
}else if($_POST["drug_inj"] == "Adsorbed Td"){
	$dgcode = "0DT-N";
}else if($_POST["drug_inj"] == "VERORAB"){
	$dgcode = "0VERO";
}else if($_POST["drug_inj"] == "VERO RABIES"){
	$dgcode = "0VERO-C";	
}else if($_POST["drug_inj"] == "SPEEDA"){
	$dgcode = "0SPEE";	
}else if($_POST["drug_inj"] == "Engerix-B"){
	$dgcode = "0EB1.0";
}else if($_POST["drug_inj"] == "Hepavax"){
	$dgcode = "0HB1.0";
}else if($_POST["drug_inj"] == "(30HBV)Euvax B"){
	$dgcode = "30HBV";
}else if($_POST["drug_inj"] == "Euvax 3"){
	$dgcode = "0EB1.0";
}

//$sql = "Select inputm.name From inputm where mdcode = '".substr($_POST["doctor"],0,5)."' limit 1 ";
//list($name_doctor) = mysql_fetch_row(mysql_query($sql));

// ถ้า status ไม่ใช่ y จะออกใบนัดไม่ได้
$sql = "Select idno From drugrx where hn = '".$_POST['hn']."' AND date like '".$Thidate2."%' AND drugcode = '".$dgcode."' AND status = 'Y' limit 1";
//echo $sql;
$result = mysql_query($sql);
$rows_drugrx = mysql_num_rows($result);
if($rows_drugrx==0){
	echo "ไม่สามารถออกใบนัดได้ เนื่องจากยังไม่มีการตัดยาในวันนี้ <br>กรุณาตัดยาก่อนการออกใบนัด";
}
//$rows_drugrx = 1;

if($rows_drugrx > 0){
	list($idno) = mysql_fetch_row($result);

	$sql = "Select a.row_id, a.diag, a.ptright, a.doctor From phardep as a  where row_id = '$idno'  limit 1";
	list($row_id_phardep, $diag, $ptright, $name_doctor) = mysql_fetch_row(mysql_query($sql));


	$sql_ddrugrx = "INSERT INTO ddrugrx(date,hn,drugcode,tradname,amount,price,item,slcode,part,idno, salepri, freepri, drug_inject_amount, drug_inject_slip, drug_inject_type, drug_inject_etc,reason,injno) VALUES";
	
	if($_POST["drug_inj"] == "Tetanus Toxoid"){
		$dgcode = "0DT";//0TT
	}else if($_POST["drug_inj"] == "Adsorbed Td"){
		$dgcode = "0DT-N";
	}else if($_POST["drug_inj"] == "VERORAB"){
		$dgcode = "0VERO";
	}else if($_POST["drug_inj"] == "VERO RABIES"){
		$dgcode = "0VERO-C";		
	}else if($_POST["drug_inj"] == "SPEEDA"){
		$dgcode = "0SPEE";		
	}else if($_POST["drug_inj"] == "Engerix-B"){
		$dgcode = "0EB1.0";
	}else if($_POST["drug_inj"] == "Hepavax"){
		$dgcode = "0HB1.0";
	}else if($_POST["drug_inj"] == "(30HBV)Euvax B"){
		$dgcode = "30HBV";
	}else if($_POST["drug_inj"] == "Euvax 3"){
		$dgcode = "0EB1.0";
	}

	$sql = "Select drugcode, tradname, part, salepri, freepri From druglst where drugcode = '".$dgcode."'  ";
	//OR drugcode = 'inj'

	$result = mysql_query($sql);
	$item = 0;
	$x = 0;
	$Netprice = 0;
	$commar = '';
	while(list($drugcode, $tradname, $part, $money, $freepri) = mysql_fetch_row($result)){
		$item++;
	
		$Free = $freepri;
		$Pay = $money - $freepri;
	
		$aEssd[$x]=0;
		$aNessdy[$x]=0;
		$aNessdn[$x]=0;
		$aDPY[$x]=0;
		$aDPN[$x]=0;
		$aDSY[$x]=0; 
		$aDSN[$x]=0;
	
		if (substr($part,0,3)=="DDL"){
			$aEssd[$x]=$money;
		}else if (substr($part,0,3)=="DDY"){
			$aNessdy[$x]=$money;
		}else  if (substr($part,0,3)=="DDN"){
			$aNessdn[$x]=$money;
		}else if (substr($part,0,3)=="DPY"){
			$aDPY[$x]=$Free;  
			$aDPN[$x]=$Pay;  
		}else if (substr($part,0,3)=="DPN"){
			$aDPN[$x]=$money;  
		}else if (substr($part,0,3)=="DSY"){
			$aDSY[$x]=$Free;  
			$aDSN[$x]=$Pay;  
		}else if(substr($part,0,3)=="DSN"){
			$aDSN[$x]=$money;  
		}
		
		$Netprice = $Netprice+$money;
		
		$sql = "
		Select slcode, drug_inject_amount, drug_inject_slip, drug_inject_type, drug_inject_etc, reason 
		From drugrx 
		where idno = '".$row_id_phardep."' 
		AND drugcode = '".$drugcode."' limit 1
		";
		list($drugslip, $drug_inject_amount, $drug_inject_slip, $drug_inject_type, $drug_inject_etc, $reason) = mysql_fetch_row(mysql_query($sql));
		
		// วิธีใช้ยาจากตัวแปร $_SESSION["list_drugslip"][$i] หาไม่เจอ
		$list_drugslip = ( !empty($_SESSION["list_drugslip"][$i]) ) ? $_SESSION["list_drugslip"][$i] : 'b';
		$drug_slcode = ( empty($drugslip) ) ? $list_drugslip : $drugslip ;

		// ต่อ string จาก $sql_ddrugrx
		$sql_ddrugrx .= "$commar ('[Thidate]','".$_POST['hn']."','".$drugcode."','".$tradname."', '1','".( 1 * $money)."','2','".$drug_slcode."','".$part."','[idno]','".$money."','".$freepri."','".$drug_inject_amount."','".$drug_inject_slip."','".$drug_inject_type."','".$drug_inject_etc."','".$reason."','[INJNO]')";
		$commar = ",";
		$x++;
	
	} // end while

	$Essd   = array_sum($aEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $Nessdy = array_sum($aNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $Nessdn = array_sum($aNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
    $DSY    = array_sum($aDSY);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกได้
    $DSN    = array_sum($aDSN);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้  
    $DPY    = array_sum($aDPY);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกได้
    $DPN    = array_sum($aDPN);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกไม่ได้  



$sql_dphardep = "INSERT INTO dphardep(chktranx,date,ptname,hn,price,doctor,item,idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,tvn,ptright,whokey,kew)VALUES('[idno]','[Thidate]','".$_POST['fullname']."','".$_POST['hn']."','".$Netprice."','".$name_doctor."','".$item."','".$_SESSION["sOfficer"]."','".$diag."','".$Essd."','".$Nessdy."','".$Nessdn."','".$DPY."','".$DPN."','".$DSY."','".$DSN."','','".$ptright."','DR','".$kew."');";

//////////////////////// เก็บค่าการนัดฉีดยา ////////////////////////
// เอา idno จาก ddrugrx ตัวล่าสุด
$hn = $_POST['hn'];
$sql = "SELECT `date`,`idno` 
FROM `ddrugrx` 
WHERE `date` LIKE '$Thidate2%' 
AND `hn` = '$hn' 
AND `drugcode` = '$dgcode' LIMIT 1";
$query = mysql_query($sql) or die( mysql_error() );
$item = mysql_fetch_assoc($query);
	
// เพิ่มข้อมูลใน history
$sql = "INSERT INTO `pharinj_history` (`id` ,`hn` ,`dphardep_id`, `start_date`)
VALUES (
NULL ,  '$hn',  '".$item['idno']."', '".$item['date']."'
);";
mysql_query($sql) or die( mysql_error() );
//////////////////////// เก็บค่าการนัดฉีดยา ////////////////////////

$count = count($_POST["list_date"]);

for($i=0;$i<$count;$i++){

	//******************************* บันทึกข้อมูล  การนัด**************************************************************
	$sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room,detail,detail2,advice,patho,xray,other,depcode,injno,detail_etc)VALUES
	('$Thidate','$sOfficer','".$_POST['hn']."','".$_POST['fullname']."','".calcage($_POST["dbirth"])."','".$_POST['doctor']."','".$_POST["list_date"][$i]."','08:00 น. - 11.00 น.','แผนกทะเบียน','FU22 นัดฉีดยา','นัดฉีดยา ".$_POST["drug_inj"]."','','','','นัดฉีดยา ".$_POST["drug_inj"]."','U22 ห้องจ่ายยา','เข็มที่ ".($i+1)."','".$_POST['detail_etc']."');";
	
	$result = Mysql_Query($sql);
	
	if($i > 0){
		$query = "SELECT runno FROM runno WHERE title = 'phardep' limit 0,1";
		$result2 = mysql_query($query) or die("Query failed");
		list($runno) = mysql_fetch_row($result2);
		$runno++;
			
		$query ="UPDATE runno SET runno = ".$runno." WHERE title='phardep' limit 1 ";
		$result2 = mysql_query($query) or die("Query failed");

		$xx = array("[idno]", "[Thidate]");
		$yy = array($runno, $_POST["list_date"][$i]." 00:00:00");
		$sql_dphardep2 = str_replace($xx,$yy,$sql_dphardep);

		if($rows_drugrx > 0){
			
			$result = Mysql_Query($sql_dphardep2) or die(mysql_error());
			$idno = mysql_insert_id();

			$yy = array($idno, $_POST["list_date"][$i]." 00:00:00");
			$sql_ddrugrx2 = str_replace($xx,$yy,$sql_ddrugrx);
			$k=$i+2;
			
			// เพิ่มข้อมูลใน history เพื่อเรียกดูข้อมูลนัดฉีดยาย้อนหลัง
			$sql = "INSERT INTO `pharinj_history` (`id` ,`hn` ,`dphardep_id`, `start_date`)
			VALUES (
			NULL ,  '$hn',  '$idno', '".$item['date']."'
			);";
			mysql_query($sql) or die( mysql_error() );
			
			$qq = array("[INJNO]");
			$zz = array("เข็มที่ $k");
			$sql_ddrugrx2 = str_replace($qq,$zz,$sql_ddrugrx2);
			$result = Mysql_Query($sql_ddrugrx2) or die(mysql_error());
		}
	}
} // End for
?>

<HTML>
<HEAD>
<TITLE> นัดฉีดยา </TITLE>

<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>

<SCRIPT LANGUAGE="JavaScript">

		window.onload = function(){
			print();
		}

</SCRIPT>

</HEAD>

<BODY >
<BR><BR>
<TABLE border="1"  bordercolor="#000000" cellspacing="0" cellpadding="0">
<TR>
	<TD>
<TABLE border="0">
<TR>
	<TD valign="top">
	
	<TABLE border="0" style="font-family: Angsana New; font-size: 18px;">
	<TR>
		<TD><B>ใบนัดฉีดยา<BR>รพ.ค่ายสุรศักดิ์มนตรี</B></TD>
		<TD align="center">
			<TABLE border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
			<TR>
				<TD style="font-family: Angsana New; font-size: 24px;" align="center">
				<B>&nbsp;&nbsp;<?php echo $_POST["drug_inj"];?>&nbsp;&nbsp;</B>
				</TD>
			</TR>
			</TABLE>
		</TD>
	</TR>
	<TR>
		<TD colspan="2"><FONT style="font-family: Angsana New; font-size: 24px;">ชื่อ<U>&nbsp;<?php echo $_POST["fullname"];?>&nbsp;</U></FONT></TD>
	</TR>
	<TR>
		<TD><FONT style="font-family: Angsana New; font-size: 24px;">HN<U>&nbsp;<?php echo $_POST["hn"];?></U></FONT></TD>
		<TD><FONT style="font-family: Angsana New; font-size: 24px;">ID<U>&nbsp;<?php echo $_POST["idcard"];?></U></FONT></TD>
	</TR>
	<TR>
		<TD>สิทธิ์&nbsp;:&nbsp;<B><?php echo substr($_POST["ptright"],4);?></TD>
		<TD>อายุ&nbsp;:&nbsp;<?php echo calcage($_POST["dbirth"]);?></TD>
	</TR>
	<TR>
		<TD colspan="2">แพทย์&nbsp;:&nbsp;<?php echo $_POST["doctor"];?></TD>
	</TR>
	<TR>
		<TD colspan="2">
		
<TABLE border="1" align="center" width="300" bordercolor="#000000" cellspacing="0" cellpadding="0" style="font-family: Angsana New; font-size: 30px;">
<TR align="center">
	<TD width="30">	<FONT style="font-family: Angsana New; font-size: 22px;">เข็ม</FONT></TD>
	<TD width="60">	<FONT style="font-family: Angsana New; font-size: 22px;">VN</FONT></TD>
	<TD width="90">	<FONT style="font-family: Angsana New; font-size: 22px;">ว/ด/ป</FONT></TD>
	<TD width="50">	<FONT style="font-family: Angsana New; font-size: 22px;">เวลา</FONT></TD>
	<TD width="50">	<FONT style="font-family: Angsana New; font-size: 22px;">ผู้ฉีด</FONT></TD>
</TR>
<?php 

for($i=0;$i<$count;$i++)
	echo "<TR>
		<TD align=\"center\" ><FONT SIZE='4' >".($i+1)."</TD>
		<TD>&nbsp;</TD>
					<TD align='center' ><FONT style=\" font-size: 14px; \" >",$_POST["list_date2"][$i],"</FONT></TD>
					<TD>&nbsp;</TD>
					<TD>&nbsp;</TD>
				</TR>";
	?>
</TABLE>

		</TD>
	</TR>
	<tr>
		<td colspan="2">
			รายละเอียด: <?php echo str_replace(array("\n","\n\r"), '<br>', $_POST['detail_etc']); ?>
		</td>
	</tr>
	</TABLE>
	
	
	</TD>
	<TD>&nbsp;&nbsp;</TD>
	<TD valign="top">
	
	
	<CENTER>
	<B>
	<FONT style="font-family: Angsana New; font-size: 22px;">
	ข้อควรปฏิบัติสำหรับผู้ป่วย
	</FONT></B><BR>
	</CENTER>

	<FONT style="font-family: Angsana New; font-size: 20px;">
	1. กรุณามาตรงตามวันนัด<BR>
	2. <U><B>มาตรงนัด</B></U><BR>
	&nbsp;&nbsp;&nbsp;&nbsp;ให้ยื่นใบนัดที่แผนกทะเบียนเพื่อออก VN<BR>
	&nbsp;&nbsp;&nbsp;&nbsp;แล้วนำใบนัดไปรับยาที่ห้องจ่ายยา<BR>
	&nbsp;&nbsp;&nbsp;&nbsp;เมื่อได้รับยาให้นำมาฉีดยาที่ห้องฉุกเฉิน<BR>
	3. <B><U>มาไม่ตรงนัด</U></B>
	&nbsp;&nbsp;&nbsp;&nbsp;ให้เข้าพบแพทย์ทุกครั้ง<BR>
	4.  เมื่อต้องการฉีดยาที่โรงพยาบาลอื่น ให้นำใบนัดนี้ไปด้วย<BR>
	5.  มีปัญหาหรือข้อสงสัยในการฉีดยา ติดต่อกองเภสัชกรรม <BR>
	&nbsp;&nbsp;&nbsp;&nbsp;โทร 054-839305  ต่อ 1160
	<CENTER>***************************</CENTER>
	<CENTER><B>เวลาฉีดยา</B></CENTER>
	</FONT>
	<div align="center"><FONT style="font-family: Angsana New; font-size: 20px;" >
	<B>เช้า</B>&nbsp;&nbsp;08.00  - 11.30 
	&nbsp;&nbsp;<B>บ่าย</B>&nbsp;&nbsp;13.00  - 15.30</FONT></div>
	</TD>
</TR>

</TABLE>
</TD>
</TR>
</TABLE>

<?
} // End $rows_drugrx
?>
</BODY>
</HTML>