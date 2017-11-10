<?php
    include("../connect.inc");
?>
<style>
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
.font1 {
	font-family: AngsanaUPC;
	font-size:14px;
}
</style>
<div id="no_print" >
<span class="font1">
<font face="Angsana New" size="+2">
<strong>ส่งออกข้อมูล DBF คนไข้ในประจำเดือน Dataset_V4.1_25591017 (อัพเดทโปรแกรม เมื่อวันที่ 29-11-59)</strong></font></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../../nindex.htm"><< ไปเมนู</a>
<?php

$mon = isset($_POST['mon']) ? $_POST['mon'] : '' ;
$year = isset($_POST['year']) ? $_POST['year'] : '' ;
$credit = isset($_POST['credit']) ? $_POST['credit'] : '' ;

$months = array(
	'01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', 
	'07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม', 
);

$credits = array(
	'OFC' => 'จ่ายตรง', 'SSS' => 'ประกันสังคม', 'LGO' => 'อปท', 'UC' => 'UC', 
);
?>
<span class="font1">
<font face="Angsana New">
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
  <table width="450" border="0">
    <tr>
      <td width="26">เดือน :</td>
      <td width="94"> 
	<select name="mon">
		<?php
		foreach($months as $key => $val){
			$select = ($key == $mon) ? 'selected="selected"' : '' ;
			?><option value="<?php echo $key;?>" <?php echo $select;?>><?php echo $val;?></option><?php
		}
		?>
	</select>
	   </td>
			<td width="118">พ.ศ. : &nbsp;&nbsp;
			<?php
			$Y=date("Y")+543;
			$date=date("Y")+543+5;

			$dates=range(2547,$date);
			echo "<select name='year' class='forntsarabun'>";
			foreach($dates as $i){
				?>
				<option value='<?=$i; ?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
				<?php
			}
			echo "<select>";
			?>
			</td>
        
        <td width="32" align="right"><font face="Angsana New">สิทธิ :</font></td>
      <td width="99"><select name="credit" id="credit">
        <option value="000">----ทั้งหมด----</option>
		<?php
		foreach($credits as $key => $val){
			$select = ($key == $credit) ? 'selected="selected"' : '' ;
			?><option value="<?php echo $key;?>" <?php echo $select;?>><?php echo $val;?></option><?php
		}
		?>
      </select>
	  </td>
        
        
        
        
      <td width="46"><input name="BOK" value="ตกลง" type="submit" /></td>
    </tr>
  </table>
</form>
</font>
</span>
<?
if(isset($_POST['BOK'])){
	
	if(!function_exists('dbase_create')){
		echo 'กรุณาติดตั้ง dBase ก่อนการใช้งาน ข้อมูลเพิ่มเติมสามารถอ่านได้จาก <a href="http://stackoverflow.com/questions/11205890/php-5-4-4-unrecognized-enable-dbase" target="_blank">ที่นี่</a>';
		exit;
	}

$year = $_POST['year'];
$newyear = $year-543;
$yy = substr($newyear,2,2);
$mm =$_POST['mon'];

$fullm=$_POST['year']."-".$_POST['mon'];
// ลบไฟล์ก่อน-----------------)
$dbf1 = "INS".$yy.$mm.".dbf";
$dbf2 = "PAT".$yy.$mm.".dbf";
$dbf3 = "OPD".$yy.$mm.".dbf";
$dbf4 = "ORF".$yy.$mm.".dbf";
$dbf5 = "ODX".$yy.$mm.".dbf";
$dbf6 = "OOP".$yy.$mm.".dbf";
$dbf7 = "IPD".$yy.$mm.".dbf";
$dbf8 = "IRF".$yy.$mm.".dbf";
$dbf9 = "IDX".$yy.$mm.".dbf";
$dbf10 = "IOP".$yy.$mm.".dbf";
$dbf11 = "CHT".$yy.$mm.".dbf";
$dbf12 = "CHA".$yy.$mm.".dbf";
$dbf13 = "AER".$yy.$mm.".dbf";
$dbf14 = "ADP".$yy.$mm.".dbf";
$dbf15 = "LVD".$yy.$mm.".dbf";
$dbf16 = "DRU".$yy.$mm.".dbf";


if(file_exists("$dbf1") && file_exists("$dbf2") && file_exists("$dbf3") && file_exists("$dbf4") && file_exists("$dbf5") && file_exists("$dbf6") && file_exists("$dbf7") && file_exists("$dbf8") && file_exists("$dbf9") && file_exists("$dbf10") && file_exists("$dbf11") && file_exists("$dbf12") && file_exists("$dbf13") && file_exists("$dbf14") && file_exists("$dbf15") && file_exists("$dbf16")){
	unlink("$dbf1");
	unlink("$dbf2");
	unlink("$dbf3");
	unlink("$dbf4");
	unlink("$dbf5");
	unlink("$dbf6");		
	unlink("$dbf7");
	unlink("$dbf8");
	unlink("$dbf9");
	unlink("$dbf10");
	unlink("$dbf11");
	unlink("$dbf12");		
	unlink("$dbf13");
	unlink("$dbf14");
	unlink("$dbf15");
	unlink("$dbf16");		
	echo "<p style='color:#FF0000; font-weight:bold;'>ลบไฟล์เดิมเรียบร้อย</p>";				
}
// จบ ลบไฟล์-----------------)


if($_POST['credit']=="OFC"){
	$showptright="เบิกจ่ายตรง";
	$newcredit = "(ptright like '%R02%' OR ptright
LIKE '%R03%'
)";
}else if($_POST['credit']=="SSS"){
	$showptright="ประกันสังคม";
	$newcredit = "ptright like '%R07%' ";
}else if($_POST['credit']=="LGO"){
	$showptright="จ่ายตรง อปท.";
	$newcredit = "(ptright like '%R21%' OR ptright
LIKE '%R33%'
)";
}else if($_POST['credit']=="UC"){
	$showptright="ประกันสุขภาพ";
	$newcredit = "( `ptright` LIKE '%ประกันสุขภาพ%' OR `ptright` LIKE '%R35%' OR `ptright` LIKE '%R17%' OR `ptright` LIKE '%R36%' OR `ptright` LIKE '%R06%')";
}



//--------------------Start DataSet1-------------------------//
$dbname1 = "INS".$yy.$mm.".dbf";
	$def1 = array(
	  array("HN","C", 15),
	  array("INSCL","C",  3),
	  array("SUBTYPE","C",  2),
	  array("CID","C",16),
	  array("DATEIN","D"),
	  array("DATEEXP","D"),
	  array("HOSPMAIN","C",5),
	  array("HOSPSUB","C",5),
	  array("GOVCODE","C",6),
	  array("GOVNAME_ID","C",255),
	  array("PERMITNO","C",30),
	  array("DOCNO","C", 30),
	  array("OWNRPID","C",13),
	  array("OWNNAME","C",255),
	  array("AN","C",15),  // เพิ่มใหม่
	  array("SEQ","C", 15),  // เพิ่มใหม่
	  array("SUBINSCL","C",2),  // เพิ่มใหม่
	  array("RELINSCL","C",1), // เพิ่มใหม่
	  array("HTYPE","C",1)  // ประเภทสถานพยาบาลที่รักษา  SSS/SSI
	);
	
	// creation
	if (!dbase_create($dbname1, $def1)) {
	  echo "Error, can't create the database1\n";
	};
	
		// echo "<pre>";
		$sqlop1 ="
		SELECT `hn`, `dcdate`, `an`, `ptright` 
		FROM `ipcard` 
		WHERE $newcredit 
		AND `dcdate` like '".$_POST['year']."-".$_POST['mon']."%' 
		AND $newcredit
		";	
		
		 //var_dump($sqlop1);
		// exit;
   		$resultop1 = mysql_query($sqlop1) or die("Query INS failed");
		while($rowsop1 = mysql_fetch_array($resultop1)){
			$hnop=$rowsop1["hn"];	
			$annop=$rowsop1["an"];	
			//$datetime=$rowsop1["dcdate"];

			//DATE
			$dateip=$rowsop1["dcdate"];
			$datetimeip=$dateip;
			$dateip = substr($datetimeip,0,10);
			$dateipc=explode("-",$dateip);
			$newdateip=$dateipc[0]-543;
			$newdateipc =$newdateip.$dateipc[1].$dateipc[2]; 
			

			$dateopacc = substr($datetime,0,10);	
		    $ptright=$rowsop1["ptright"];
			$codeptright = substr($ptright,0,3);	
			//  กำหนดตัวแปรของ สิทธิ์การรักษา
			if($codeptright =="R09" 
			|| $codeptright =="R10"  
			|| $codeptright =="R11"
			|| $codeptright =="R12"
			|| $codeptright =="R13"
			|| $codeptright =="R14" 
			|| $codeptright =="R35"
			|| $codeptright =="R17"
			|| $codeptright =="R36"
			|| $codeptright =="R06"){
				$newptright ="UCS";
			}else if($codeptright =="R02"){  // จ่ายตรง
				$newptright ="OFC";
			}else if($codeptright =="R03"){  // จ่ายตรง
				$newptright ="OFC";
			}else if($codeptright =="R07"){
				$newptright ="SSS";
			}else if($codeptright =="R33"){  // จ่ายตรง อปท.
				$newptright ="LGO";
			}else if($codeptright =="R21"){  // จ่ายตรง อปท.
				$newptright ="LGO";				
			}else if($codeptright =="R27"){
				$newptright ="SSI";
			}else{
				$newptright ="";
			}			
		
			$db1 = dbase_open($dbname1, 2);
			if ($db1) {
				dbase_add_record($db1, array(
					$hnop, 
					$newptright, 
					$subtype1, 
					$cid1,
					$datein1, 
					$dateexp1, 
					$hcode1, 
					$hospsub1,
					$govcode1, 
					$govname1, 
					$permitno1, 
					$docno1,		
					$ownprid1, 
					$ownname1,
					$annop,   // เพิ่มใหม่
					$newseq,   // เพิ่มใหม่
					$subinscl1,    // เพิ่มใหม่
					$relinscl1,   // เพิ่มใหม่	
					$HTYPE   // เพิ่มใหม่				  
				));   
				dbase_close($db1);
			}  //if db
		}  //while		
//--------------------End DataSet1-------------------------//
	
//--------------------Start DataSet2-------------------------//
	$dbname2 = "PAT".$yy.$mm.".dbf";
	$def2 = array(
	  array("HCODE",     "C", 5),
	  array("HN",     "C",  15),
	  array("CHANGWAT",      "C",  2),
	  array("AMPHUR",    "C", 2),
	  array("DOB",     "D"),
	  array("SEX",     "C",  1),
	  array("MARRIAGE",      "C",   1),
	  array("OCCUPA",    "C", 3),
	  array("NATION",     "C",  3),
	  array("PERSON_ID",      "C",   13),
	  array("NAMEPAT",    "C", 36),  //ชื่อ – สกุล ผู้ป่วย โดยใช้รูปแบบ : ชื่อ (เว้นวรรค) นามสกุล , คำนำหน้าชื่อ
	  array("TITLE",     "C", 30),  //คำนำหน้า (เพิ่มเติม)
	  array("FNAME",     "C",  40),  //ชื่อ (เพิ่มเติม)
	  array("LNAME",      "C",   40),  //นามสกุล (เพิ่มเติม)
	  array("IDTYPE",    "C", 1)  //ประเภทบัตร (เพิ่มเติม)
	);
	
	// creation
	if (!dbase_create($dbname2, $def2)) {
	  echo "Error, can't create the database2\n";
	}

		$sqlop2 ="select hn,dcdate,an,ptright from  ipcard  where $newcredit and dcdate like '".$_POST['year']."-".$_POST['mon']."%' and $newcredit ";
		//echo "test-->".$sqlop3."<br>";
   		$resultop2 = mysql_query($sqlop2) or die("Query PAT failed");
		while($rowsop2 = mysql_fetch_array($resultop2)){
			$hn2=$rowsop2["hn"];	
			
			$datetime=$rowsop2["dcdate"];
			$dateopacc = substr($datetime,0,10);	
			
		
//---------------------ใช้ข้อมูลจากตาราง opcard---------------------//
		$sqlop ="select * from opcard where hn ='".$hn2."'";   //  Query เอาข้อมูลจากตาราง opday
		$resultop = mysql_query($sqlop) or die("Query opcard failed");
   		$rowsop = mysql_fetch_array($resultop);
			//$hcode2 ="11486";
			$hcode2 ="11512";
			$personid=$rowsop["idcard"];  //  PERSON_ID ใช้ตัวแปรนี้นำเข้าข้อมูล
			//$changwat2=$rowsop["changwat"];
			//$ampur2=$rowsop["ampur"];
			$dbirth2=$rowsop["dbirth"];
			$sex2=$rowsop["sex"];
			$married2=$rowsop["married"];
			
			//เช็คอาชีพ
			$career2=$rowsop["career"];
			$career = substr($career2,0,2);	
			if($career == "01"){
				$newcareer ="502";
			}else if($career == "02"){
				$newcareer ="403";
			}else if($career == "03"){
				$newcareer ="821";
			}else if($career == "04"){
				$newcareer ="401";
			}else if($career == "05"){
				$newcareer ="201";
			}else if($career == "06"){
				$newcareer ="105";
			}else if($career == "07"){
				$newcareer ="114";
			}else if($career == "08"){
				$newcareer ="136";
			}else if($career == "09"){
				$newcareer ="201";
			}else if($career == "10"){
				$newcareer ="302";
			}else if($career == "11"){
				$newcareer ="902";
			}else if($career == "12"){
				$newcareer ="901";
			}else if($career == "13"){		
				$newcareer ="000";
			}else{
				$newcareer ="000";
			}			
			
			
			// เช็คสัญชาติ
			$nation2=$rowsop["nation"];
			if($nation2 == "ไทย" || $nation2 == "01 ไทย"){
				$newnation ="099";
			}else if($nation2 == "พม่า"){
				$newnation ="048";
			}else if($nation2 == "จีน"){
				$newnation ="044";
			}else if($nation2 == "ลาว"){
				$newnation ="056";
			}else if($nation2 == "กัมพูชา"){
				$newnation ="057";
			}else if($nation2 == "อินเดีย"){
				$newnation ="045";
			}else if($nation2 == "เวียดนาม"){
				$newnation ="046";
			}else{
				$newnation ="999";
			}
			
			$idcard2=$rowsop["idcard"];		
			$yot2=$rowsop["yot"];
			$name2=$rowsop["name"];
			$surname2=$rowsop["surname"];
			$namepat2 =$rowsop["name"]." ".$rowsop["surname"].",".$rowsop["yot"];
			
$birth2 =explode("-",$dbirth2);
$newbirth2=$birth2[0]-543;
$birthday2 =$newbirth2.$birth2[1].$birth2[2];			
		
//  กำหนดตัวแปรของ รหัสเพศ
if($sex2 =="ช"){
	$sex2 ="1";
}else if($sex2=="ญ"){
	$sex2 ="2";
}else{
	$sex2 ="1";
}

//  กำหนดตัวแปรของ รหัสสถานภาพสมรส
if($married2 =="โสด"){
	$married2 ="1";
}else if($married2 =="สมรส" || $married2 =="คู่"){
	$married2 ="2";
}else if($married2 =="หม้าย" || $married2 =="หม้าย/หย"){
	$married2 ="3";
}else if($married2 =="หย่า"){
	$married2 ="4";
}else if($married2 =="แยกกันอยู่" || $married2 =="แยก" ){
	$married2 ="5";
}else if($married2 =="สมณะ"){
	$married2 ="6";
}else{
	$married2 ="9";
}

//  กำหนดตัวแปรของ ประเภทบัตร
if($idcard2 !=""){
	$idtype2 ="1";
}else{
	$idtype2 ="";
}

		$sqlprovince ="select * from province_new where PROVINCE_NAME='".$changwat2."'";
		$resultprovince = mysql_query($sqlprovince) or die("Query province failed");
   		$rowspro = mysql_fetch_array($resultprovince);
		$provinceid = $rowspro["PROVINCE_ID"];
		$provincecode = $rowspro["PROVINCE_CODE"];
		
		$sqlamphur ="select * from amphur_new where AMPHUR_NAME='".$ampur2."'";
		$resultamphur = mysql_query($sqlamphur) or die("Query amphur failed");
   		$rowsamp = mysql_fetch_array($resultamphur);
		$amphurcode = $rowsamp["AMPHUR_CODE"];				
			

	$db2 = dbase_open($dbname2, 2);
		if ($db2) {
			  dbase_add_record($db2, array(
				  $hcode2, 
				  $hn2, 
				  $provincecode, 
				  $amphurcode, 
				  $birthday2,
				  $sex2, 
				  $married2, 
				  $newcareer, 
				  $newnation,
				  $idcard2, 
				  $namepat2, 
				  $yot2, 
				  $name2,		
				  $surname2, 
				  $idtype2));   
					dbase_close($db2);
				}  //if db
		}   //while
//--------------------End DataSet2-------------------------//

//--------------------Start DataSet3-------------------------//
$dbname3 = "OPD".$yy.$mm.".dbf";
	$def3 = array(
	  array("HN","C",15),
	  array("CLINIC","C",4),
	  array("DATEOPD","D"),
	  array("TIMEOPD","C",4),
	  array("SEQ","C",15),
	  array("UUC","C",1)
	);

	// creation
	if (!dbase_create($dbname3, $def3)) {
	  echo "Error, can't create the database OPD\n";
	}

//--------------------End DataSet3-------------------------//


//--------------------Start DataSet4-------------------------//
$dbname4 = "ORF".$yy.$mm.".dbf";
	$def4 = array(
	  array("HN","C",15),
	  array("DATEOPD","D"),
	  array("CLINIC","C",4),	  
	  array("REFER","C",5),
	  array("REFERTYPE","C",1),
	  array("SEQ","C",15)
	);

	// creation
	if (!dbase_create($dbname4, $def4)) {
	  echo "Error, can't create the database4\n";
	}	
//--------------------End DataSet4-------------------------//		

//--------------------Start DataSet5-------------------------//
$dbname5 = "ODX".$yy.$mm.".dbf";
	$def5 = array(
	  array("HN","C",15),
	  array("DATEDX","D"),
	  array("CLINIC","C",4),	  
	  array("DIAG","C",7),
	  array("DXTYPE","C",1),
	  array("DRDX","C",6),
	  array("PERSON_ID","C",13),	  
	  array("SEQ","C",15)
	);

	// creation
	if (!dbase_create($dbname5, $def5)) {
	  echo "Error, can't create the database\n";
	}	

//--------------------End DataSet5-------------------------//

//--------------------Start DataSet6-------------------------//
$dbname6 = "OOP".$yy.$mm.".dbf";
	$def6 = array(
	  array("HN","C",15),
	  array("DATEOPD","D"),
	  array("CLINIC","C", 4),	  
	  array("OPER","C",7),
	  array("DROPID","C",6),
	  array("PERSON_ID","C",13),	  
	  array("SEQ","C",15)
	);

	// creation
	if (!dbase_create($dbname6, $def6)) {
	  echo "Error, can't create the database6\n";
	}
//--------------------End DataSet6-------------------------//


//--------------------Start DataSet7-------------------------//
$dbname7 = "IPD".$yy.$mm.".dbf";
	$def7 = array(
	   array("HN","C",15),
	  array("AN","C",15),
	  array("DATEADM","D"),	  
	  array("TIMEADM","C",4),
	  array("DATEDSC","D"),
	  array("TIMEDSC","C",4),	  
	  array("DISCHS","C",1),
 	  array("DISCHT","C",1),
	  array("WARDDSC","C",4),
	  array("DEPT","C",2),
	  array("ADM_W","C",7),
	  array("UUC","C",1),
	   array("SVCTYPE","C",1)
	);

	// creation
	if (!dbase_create($dbname7, $def7)) {
	  echo "Error, can't create the database7\n";
	};
	
	$sql7 ="select * from ipcard where $newcredit and dcdate like '".$_POST['year']."-".$_POST['mon']."%' ";   //  Query เอาข้อมูลจากตาราง ipcard
	$result7 = mysql_query($sql7) or die("Query IPD Failed");
   	while($rows7 = mysql_fetch_array($result7)){
		$hn7=$rows7["hn"];  //  HN ใช้ตัวแปรนี้นำเข้าข้อมูล
		$an7=$rows7["an"]; //  AN ใช้ตัวแปรนี้นำเข้าข้อมูล
	
		//datetimeADM
		$datetimead=$rows7["date"];
		$datead7 = substr($datetimead,0,10);
		$datead =explode("-",$datead7);
		$newdatead=$datead[0]-543;
		$newdateadm =$newdatead.$datead[1].$datead[2];  //  DATEADMใช้ตัวแปรนี้นำเข้าข้อมูล
		
		$timead = substr($datetimead,11,8);	
		$newtimead =explode(":",$timead);
		$newtimeadm = $newtimead[0].$newtimead[1];  //  TIMEADM ใช้ตัวแปรนี้นำเข้าข้อมูล
		
		//datetimeDSC
		$datetimedc=$rows7["dcdate"];
		$datedc7 = substr($datetimedc,0,10);
		$datedc =explode("-",$datedc7);
		$newdatedc=$datedc[0]-543;
		$newdatedsc =$newdatedc.$datedc[1].$datedc[2];  //  DATEDSCใช้ตัวแปรนี้นำเข้าข้อมูล
		
		$timedc = substr($datetimedc,11,8);	
		$newtimedc =explode(":",$timedc);
		$newtimedsc = $newtimedc[0].$newtimedc[1];  //  TIMEDSC ใช้ตัวแปรนี้นำเข้าข้อมูล
		
		$dischs=substr($rows7["result"],0,1); //  DISCHS ใช้ตัวแปรนี้นำเข้าข้อมูล
		$discht=substr($rows7["dctype"],0,1); //  DISCHT ใช้ตัวแปรนี้นำเข้าข้อมูล			
		
		//$warddsc=substr($rows7["bedcode"],0,2); //  WARDDSC ใช้ตัวแปรนี้นำเข้าข้อมูล				
		//$adm_w=$rows7["adm_w"]; //  ADM_W ใช้ตัวแปรนี้นำเข้าข้อมูล
		$ucc7="1";  //  UCC ใช้ตัวแปรนี้นำเข้าข้อมูล				
		$svctype="I";  //ประเภทบริการ/รักษา  I = IPD, A = Ambulatory Care
		
	$db7 = dbase_open($dbname7, 2);
		if ($db7) {
			  dbase_add_record($db7, array(
				  $hn7, 
				  $an7,		  
				  $newdateadm,
				  $newtimeadm, 		
				  $newdatedsc,
				  $newtimedsc, 						  
				  $dischs, 
				  $discht,
				  $warddsc, 						  
				  $dept, 	
				  $adm_w, 					  			  				  		  
				  $ucc7,
				  $svctype)); 
					dbase_close($db7);
				}  //if db
	}  //while			
//--------------------End DataSet7-------------------------//


//---------------Start Dataset8---------------//
$dbname8 = "IRF".$yy.$mm.".dbf";
	$def8 = array(
	  array("AN","C",15),		  	  
	  array("REFER","C",5),
	  array("REFERTYPE","C",1)
	);
	
	// creation
	if (!dbase_create($dbname8, $def8)) {
	  echo "Error, can't create the database8\n";
	};

//---------------End Dataset8---------------//

//---------------Start Dataset9---------------//
$dbname9 = "IDX".$yy.$mm.".dbf";
	$def9 = array(
	  array("AN","C",15),		  	  
	  array("DIAG","C",7),
	  array("DXTYPE","C",1),	  
	  array("DRDX","C",6)
	);
	
	// creation
	if (!dbase_create($dbname9, $def9)) {
	  echo "Error, can't create the database9\n";
	}	

	$sqlipc ="select * from ipcard where $newcredit and dcdate like '".$_POST['year']."-".$_POST['mon']."%' ";   //  Query เอาข้อมูลจากตาราง ipcard
	$resultipc = mysql_query($sqlipc) or die("Query IDX Failed");
   	while($rowsipc = mysql_fetch_array($resultipc)){
		$anipc=$rowsipc["an"]; //  AN ใช้ตัวแปรนี้นำเข้าข้อมูล
		$dateidx = substr($rows5["date"],0,10);
		

		$sql9 ="select * from diag  where an ='".$anipc."' ";    //  Query เอาข้อมูลจากตาราง opday
		//echo $sql9;
		$result9 = mysql_query($sql9) or die("Query failed9");
		$num9 =mysql_num_rows($result9);
		//echo "จำนวน : $num9";
		if($num9 > 1 ){
			while($rows9 = mysql_fetch_array($result9)){
			$an9=$rows9["an"];   //  AN ใช้ตัวแปรนี้นำเข้าข้อมูล
			$diag9=$rows9["icd10"];  //  DIAG ใช้ตัวแปรนี้นำเข้าข้อมูล
			
			//------------------กำหนดตัวแปรของ ชนิดของโรค
			$dxtype9=$rows9["type"];
			
			//echo $dxtype9;
			
			if($dxtype9=='PRINCIPLE'){		
				$dxtype ="1";
			}else if(dxtype9=='CO-MORBIDITY'){
				$dxtype ="2";
			}else if(dxtype9=='COMPLICATION'){
				$dxtype ="3";
			}else if(dxtype9=='OTHER'){
				$dxtype ="4";
			}else if(dxtype9=='EXTERNAL CAUSE'){
				$dxtype ="5";
			}else{
				$dxtype ="2";
			}	
			
			//---------------------หารหัสและชื่อหมอ-------------------------//
			$doctor_name9=$rowsipc["doctor"];
			$sqldoc ="select doctorcode from doctor where  name like  '%$doctor_name9%' ";   //  Query เอาข้อมูลจากตาราง doctor
			$resultdoc = mysql_query($sqldoc) or die("Query doctor failed");
			$numdoc = mysql_num_rows($resultdoc);
			$rowsdoc = mysql_fetch_array($resultdoc);
			if($numdoc > 0){
					$newdrdx = $rowsdoc["doctorcode"];
			}else{			
			$sqlinp ="select codedoctor from inputm where  name like  '%$doctor_name9%' ";   //  Query เอาข้อมูลจากตาราง inputm
			$resultinp = mysql_query($sqlinp) or die("Query inputm failed");
			$rowsinp = mysql_fetch_array($resultinp);	
					$newdrdx = $rowsinp["codedoctor"];
			}
			
			
			
			
			$db9 = dbase_open($dbname9, 2);
			
				if ($db9) {
					  dbase_add_record($db9, array(
						  $anipc,   
						  $diag9, 		
						  $dxtype, 	
						  $newdrdx));   
							dbase_close($db9);
						}  //if db		
				} //while
		}else{
			$rows9 = mysql_fetch_array($result9);
			$an9=$rows9["an"];   //  AN ใช้ตัวแปรนี้นำเข้าข้อมูล
			$diag9=$rows9["icd10"];  //  DIAG ใช้ตัวแปรนี้นำเข้าข้อมูล
			
			//------------------กำหนดตัวแปรของ ชนิดของโรค
			$dxtype9=$rows9["type"];
			if($dxtype9=="PRINCIPLE"){		
				$dxtype ="1";
			}else if(dxtype9=='CO-MORBIDITY'){
				$dxtype ="2";
			}else if(dxtype9=='COMPLICATION'){
				$dxtype ="3";
			}else if(dxtype9=='OTHER'){
				$dxtype ="4";
			}else if(dxtype9=='EXTERNAL CAUSE'){
				$dxtype ="5";
			}else{
				$dxtype ="4";
			}	
			
			//---------------------หารหัสและชื่อหมอ-------------------------//
			$doctor_name9=$rowsipc["doctor"];
			$sqldoc ="select doctorcode from doctor where  name like  '%$doctor_name9%' ";   //  Query เอาข้อมูลจากตาราง doctor
			$resultdoc = mysql_query($sqldoc) or die("Query doctor failed");
			$numdoc = mysql_num_rows($resultdoc);
			$rowsdoc = mysql_fetch_array($resultdoc);
			if($numdoc > 0){
					$newdrdx = $rowsdoc["doctorcode"];
			}else{			
			$sqlinp ="select codedoctor from inputm where  name like  '%$doctor_name9%' ";   //  Query เอาข้อมูลจากตาราง inputm
			$resultinp = mysql_query($sqlinp) or die("Query inputm failed");
			$rowsinp = mysql_fetch_array($resultinp);	
					$newdrdx = $rowsinp["codedoctor"];
			}
			
			$db9 = dbase_open($dbname9, 2);
				if ($db9) {
					  dbase_add_record($db9, array(
						  $anipc,   
						  $diag9, 		
						  $dxtype, 	
						  $newdrdx));   
							dbase_close($db9);
						}  //if db
		} // if num
	}  //while		
			
//---------------End Dataset9---------------//



//---------------Start Dataset10---------------//
$dbname10 = "IOP".$yy.$mm.".dbf";
	$def10 = array(
	  array("AN","C",15),		  
	  array("OPER","C",7),		  
	  array("OPTYPE","C",1),
	  array("DROPID","C",6),
	  array("DATEIN","D"),	  
 	  array("TIMEIN","C",4),
	  array("DATEOUT","D"),	 
	  array("TIMEOUT","C",4)
	);
	
	// creation
	if (!dbase_create($dbname10, $def10)) {
	  echo "Error, can't create the database10\n";
	}
	
	$sqliop ="select * from ipcard where $newcredit and dcdate like '".$_POST['year']."-".$_POST['mon']."%' ";   //  Query เอาข้อมูลจากตาราง ipcard
	$resultiop = mysql_query($sqliop) or die("Query IOP Failed");
   	while($rowsiop = mysql_fetch_array($resultiop)){
		$aniop=$rowsiop["an"]; //  AN ใช้ตัวแปรนี้นำเข้าข้อมูล
		//$dateidx = substr($rowsiop["dcdate"],0,10);
		

		$sql10 ="select * from ipicd9cm  where an ='".$aniop."' ";    //  Query เอาข้อมูลจากตาราง ipicd9cm
		$result10 = mysql_query($sql10) or die("Query failed10");
		$num10 =mysql_num_rows($result10);
		//echo "จำนวน : $num10";
		if($num10 > 1 ){
			while($rows10 = mysql_fetch_array($result10)){
			$an10=$rows10["an"];
			$oper10=$rows10["icd9cm"];   //  OPER ใช้ตัวแปรนี้นำเข้าข้อมูล 
			$optype ="1";  //  OPTYPE ใช้ตัวแปรนี้นำเข้าข้อมูล 
			
			//------------------กำหนดตัวแปรของ ชนิดของโรค
/*			$dxtype10=$rows10["type"];
			if($dxtype10=="PRINCIPLE"){		
				$dxtype ="1";
			}else if(dxtype9=="CO-MORBIDITY"){
				$dxtype ="2";
			}else if(dxtype9=="OTHER"){
				$dxtype ="3";
			}*/
			
			//---------------------หารหัสและชื่อหมอ-------------------------//
			$doctor_name10=$rowsiop["doctor"];
			$sqldoc ="select doctorcode from doctor where  name like  '%$doctor_name10%' ";   //  Query เอาข้อมูลจากตาราง doctor
			$resultdoc = mysql_query($sqldoc) or die("Query doctor failed");
			$numdoc = mysql_num_rows($resultdoc);
			$rowsdoc = mysql_fetch_array($resultdoc);
			if($numdoc > 0){
					$newdropid = $rowsdoc["doctorcode"];
			}else{			
			$sqlinp ="select codedoctor from inputm where  name like  '%$doctor_name10%' ";   //  Query เอาข้อมูลจากตาราง inputm
			$resultinp = mysql_query($sqlinp) or die("Query inputm failed");
			$rowsinp = mysql_fetch_array($resultinp);	
					$newdropid = $rowsinp["codedoctor"];
			}
			
			//datetime
			$datetime10=$rows10["icddate"];
			$date =explode("/",$datetime10);
			$newdate=$date[2]-543;
			$newdatein =$newdate.$date[1].$date[0];  //  DATEIN ใช้ตัวแปรนี้นำเข้าข้อมูล
			//echo "$datetime10 --> $date --> $newdatein </br>";
			
			$newtimein = "1300";  //  TIMEOPD ใช้ตัวแปรนี้นำเข้าข้อมูล			
			
			$db10 = dbase_open($dbname10, 2);
				if ($db10) {
					  dbase_add_record($db10, array(
						  $aniop, 	
						  $oper10, 	
						  $optype,
						  $newdropid, 		
						  $newdatein, 						  
						  $newtimein, 		
						  $dateout, 							  
						  $timeout));   
							dbase_close($db10);
						}  //if db		
				} //while
		}else{
			$rows10 = mysql_fetch_array($result10);
			$an10=$rows10["an"];
			$oper10=$rows10["icd9cm"];   //  OPER ใช้ตัวแปรนี้นำเข้าข้อมูล 
			$optype ="1";  //  OPTYPE ใช้ตัวแปรนี้นำเข้าข้อมูล 
			
			//------------------กำหนดตัวแปรของ ชนิดของโรค
/*			$dxtype10=$rows10["type"];
			if($dxtype10=="PRINCIPLE"){		
				$dxtype ="1";
			}else if(dxtype9=="CO-MORBIDITY"){
				$dxtype ="2";
			}else if(dxtype9=="OTHER"){
				$dxtype ="3";
			}*/
			
			//---------------------หารหัสและชื่อหมอ-------------------------//
			$doctor_name10=$rowsiop["doctor"];
			$sqldoc ="select doctorcode from doctor where  name like  '%$doctor_name10%' ";   //  Query เอาข้อมูลจากตาราง doctor
			$resultdoc = mysql_query($sqldoc) or die("Query doctor failed");
			$numdoc = mysql_num_rows($resultdoc);
			$rowsdoc = mysql_fetch_array($resultdoc);
			if($numdoc > 0){
					$newdropid = $rowsdoc["doctorcode"];
			}else{			
			$sqlinp ="select codedoctor from inputm where  name like  '%$doctor_name10%' ";   //  Query เอาข้อมูลจากตาราง inputm
			$resultinp = mysql_query($sqlinp) or die("Query inputm failed");
			$rowsinp = mysql_fetch_array($resultinp);	
					$newdropid = $rowsinp["codedoctor"];
			}
			
			//datetime
			$datetime10=$rows10["icddate"];
			$date =explode("/",$datetime10);
			$newdate=$date[2]-543;
			$newdatein =$newdate.$date[1].$date[0];  //  DATEIN ใช้ตัวแปรนี้นำเข้าข้อมูล
			//echo "$datetime10 --> $date --> $newdatein </br>";
			
			$newtimein = "1300";  //  TIMEOPD ใช้ตัวแปรนี้นำเข้าข้อมูล						
			
			$db10 = dbase_open($dbname10, 2);
				if ($db10) {
					  dbase_add_record($db10, array(
						  $aniop, 	
						  $oper10, 	
						  $optype, 
						  $newdropid, 		
						  $newdatein, 						  
						  $newtimein, 		
						  $dateout, 							  
						  $timeout));   
							dbase_close($db10);
						}  //if db		
				} //while	
		}  // if num
//---------------End Dataset10---------------//


//---------------Start Dataset11---------------//
//แฟ้มข้อมูลที่ 11 มาตรฐานแฟ้มข้อมูลการเงิน (แบบสรุป) (CHT)
$dbname11 = "CHT".$yy.$mm.".dbf";
	$def11 = array(
	    array("HN","C",15),
	  array("AN","C",9),
	  array("DATE","D"),	  
	  array("TOTAL","N",12,0),	  
	  array("PAID","N",12,0),	
	  array("PTTYPE","C",2),	  
 	  array("PERSON_ID","C",13),	 
	  array("SEQ","C",15)
	);
	
	// creation
	if (!dbase_create($dbname11, $def11)) {
	  echo "Error, can't create the database11\n";
	}		
		

		//--------------------------------- ค่าใช้จ่ายผู้ป่วยใน	---------------------------------//	
		$sqlipc ="select * from  ipcard  where $newcredit and dcdate like '".$_POST['year']."-".$_POST['mon']."%' ";
		$resultipc = mysql_query($sqlipc) or die("Query ipcard failed");
		$numipc= mysql_num_rows($resultipc);
		while($rowsipc = mysql_fetch_array($resultipc)){
			$anipcard=$rowsipc["an"];  //  AN ใช้ตัวแปรนี้นำเข้าข้อมูล
			$hnipcard=$rowsipc["hn"];   //  HN ใช้ตัวแปรนี้นำเข้าข้อมูล
		
			//DATE
			$dateip=$rowsipc["dcdate"];
			$datetimeip=$dateip;
			$dateip = substr($datetimeip,0,10);
			$dateipc=explode("-",$dateip);
			$newdateip=$dateipc[0]-543;
			$newdateipc =$newdateip.$dateipc[1].$dateipc[2];  //  DATE ใช้ตัวแปรนี้นำเข้าข้อมูล			
		
		
			$sqlip ="select *, sum(price) as sumprice from  ipacc  where an='$anipcard'";
			$resultip = mysql_query($sqlip) or die("Query ipacc failed");
			$numip= mysql_num_rows($resultip);	
			$rowsip = mysql_fetch_array($resultip);
				$anipacc=$rowsip["an"];
				$totalprice=$rowsip["sumprice"];  //  HN ใช้ตัวแปรนี้นำเข้าข้อมูล
				
			
//---------------------ใช้ข้อมูลจากตาราง opday---------------------//	
		$sqlop1 ="select * from opday where an='".$anipacc."'";   //  Query เอาข้อมูลจากตาราง opday
		$resultop1 = mysql_query($sqlop1) or die("Query opday failed");
   		$rowsop1 = mysql_fetch_array($resultop1);
			$personid=$rowsop1["idcard"]; //  PERSON_ID ใช้ตัวแปรนี้นำเข้าข้อมูล	
			
			//SEQ
			$rowidop1=$rowsop1["row_id"];
			$newrowid1 = substr($rowidop1,3,4);			
			
			$vn1=$rowsop1["vn"];
			$lenvn1=strlen($vn1);
			if($lenvn1=="1"){
				$newvn1="00".$vn1;
			}else if($lenvn1=="2"){
				$newvn1="0".$vn1;
			}else if($lenvn1=="3"){
				$newvn1=$vn1;
			}
			$newseq=$newdateipc.$newvn1.$newrowid1;  //  SEQ ใช้ตัวแปรนี้นำเข้าข้อมูล	
			
			$paid11="0";
			//$pttype11="10";
			$db11 = dbase_open($dbname11, 2);
				if ($db11) {
					  dbase_add_record($db11, array(
						  $hnipcard, 
						  $anipcard, 
						  $newdateipc, 
						  $totalprice,
						  $paid11,
						  $pttype11, 
						  $personid, 				  				  
						  $newseq));     
							dbase_close($db11);
						}  //if db
	}  // while		
	
//---------------End Dataset11---------------//


//---------------Start Dataset12---------------//
//แฟ้มข้อมูลที่ 12 มาตรฐานแฟ้มข้อมูลการเงิน (แบบรายละเอียด) (CHA)
$dbname12 = "CHA".$yy.$mm.".dbf";
	$def12 = array(
	   array("HN","C",15),
	  array("AN","C",15),
	  array("DATE","D"),	  
	  array("CHRGITEM","C",2),   //ชนิดของบริการที่คิดค่ารักษา ตามรหัสที่กำหนด
	  array("AMOUNT","N",12,0),		  
 	  array("PERSON_ID","C",13),	 
	  array("SEQ","C",15)
	);
	
	// creation
	if (!dbase_create($dbname12, $def12)) {
	  echo "Error, can't create the database11\n";
	}	
	
	
	
		//--------------------------------- ค่าใช้จ่ายผู้ป่วยใน	---------------------------------//	
					$dbsql ="select an from  ipcard  where $newcredit and dcdate like '".$_POST['year']."-".$_POST['mon']."%' group by an";
					//echo "1=>".$dbsql."</br>";
					$dbresult = mysql_query($dbsql) or die("Query ipcard failed2");
					while($rowsdb = mysql_fetch_array($dbresult)){
						$andb=$rowsdb["an"];
						
										
					$sqlip ="select *,sum(price) as totalprice from  ipacc  where an='".$andb."'  group by part";
					//echo "2=>".$sqlip."</br>";
					$resultip = mysql_query($sqlip) or die("Query ipcard failed1");
					$dd1=0;$dd2=0;$bl1=0;$bl2=0;$la1=0;$la2=0;$xr1=0;$xr2=0;$si1=0;$si2=0;$to1=0;$to2=0;$su1=0;$su2=0;$nc1=0;$nc2=0;					
					while($rowsip = mysql_fetch_array($resultip)){
/*						$rowidop1=$rowsip["row_id"];
						$newrowidop1 = substr($rowidop1,3,4);		*/
										
						$anipacc=$rowsip["an"];
						
						$amountipacc=$rowsip["totalprice"];
						
						$dateip=$rowsip["date"];
						$datetimeip=$dateip;
						$dateip = substr($datetimeip,0,10);
						$dateipa =explode("-",$dateip);
						$newdateip=$dateipa[0]-543;
						$newdateipa =$newdateip.$dateipa[1].$dateipa[2];  //  DATE ใช้ตัวแปรนี้นำเข้าข้อมูล						

						$chrgitem1 =$rowsip["part"];
						if($chrgitem1=="BFY"){  //ค่าห้องเบิกได้
							$chrgitemip ="11";
						}elseif($chrgitem1=="BFN"){  //ค่าห้องเบิกไม่ได้
							$chrgitemip ="12";
						}elseif($chrgitem1=="DPY"){  //อุปกรณ์เบิกได้
							$chrgitemip ="21";
						}elseif($chrgitem1=="DPN"){  //อุปกรณ์เบิกไม่ได้
							$chrgitemip ="22";		
						}elseif($chrgitem1=="DDL"){  //ยาเบิกได้
							$chrgitemip ="31";
							$dd1=1;
						}elseif($chrgitem1=="DDY"){  //ยาเบิกได้
							$chrgitemip ="31";
							$dd2=1;											
						}elseif($chrgitem1=="DDN"){  //ยาเบิกไม่ได้
							$chrgitemip ="32";														
						}elseif($chrgitem1=="DSY"){  //เวชภัณฑ์เบิกได้
							$chrgitemip ="51";
						}elseif($chrgitem1=="DSN"){  //เวชภัณฑ์เบิกไม่ได้
							$chrgitemip ="52";
						}elseif($chrgitem1=="BLOOD"){  //บริการโลหิตและส่วนประกอบของโลหิตเบิกได้
							$chrgitemip ="61";
							$bl1=1;
						}elseif($chrgitem1=="BLOODY"){  //บริการโลหิตและส่วนประกอบของโลหิตเบิกได้
							$chrgitemip ="61";
							$bl2=1;					
						}elseif($chrgitem1=="LAB"){  //ตรวจวินิจฉัยทางเทคนิคการแพทย์และพยาธิวิทยาเบิกได้
							$chrgitemip ="71";
							$la1=1;
						}elseif($chrgitem1=="LABY"){  //ตรวจวินิจฉัยทางเทคนิคการแพทย์และพยาธิวิทยาเบิกได้
							$chrgitemip ="71";		
							$la2=1;					
						}elseif($chrgitem1=="LABN"){  //ตรวจวินิจฉัยทางเทคนิคการแพทย์และพยาธิวิทยาเบิกไม่ได้
							$chrgitemip ="72";
						}elseif($chrgitem1=="XRAY"){  //ตรวจวินิจฉัยและรักษาทางรังสีวิทยาเบิกได้
							$chrgitemip ="81";
							$xr1=1;
						}elseif($chrgitem1=="XRAYY"){  //ตรวจวินิจฉัยและรักษาทางรังสีวิทยาเบิกได้
							$chrgitemip ="81";
							$xr2=1;
						}elseif($chrgitem1=="XRAYN"){  //ตรวจวินิจฉัยและรักษาทางรังสีวิทยาเบิกไม่ได้
							$chrgitemip ="82";							
						}elseif($chrgitem1=="SINV"){  //ตรวจวินิจฉัยโดยวิธีพิเศษอื่น ๆ เบิกได้
							$chrgitemip ="91";	
							$si1=1;
						}elseif($chrgitem1=="SINVY"){  //ตรวจวินิจฉัยโดยวิธีพิเศษอื่น ๆ เบิกได้
							$chrgitemip ="91";	
							$si2=1;																		
						}elseif($chrgitem1=="TOOL"){  //อุปกรณ์ของใช้และเครื่องมือทางการแพทย์เบิกได้
							$chrgitemip ="A1";
							$to1=1;
						}elseif($chrgitem1=="TOOLY"){  //อุปกรณ์ของใช้และเครื่องมือทางการแพทย์เบิกได้
							$chrgitemip ="A1";	
							$to2=1;						
						}elseif($chrgitem1=="SURG"){  //ทำหัตถการ และบริการวิสัญญีเบิกได้
							$chrgitemip ="B1";
							$su1=1;
						}elseif($chrgitem1=="SURGY"){  //ทำหัตถการ และบริการวิสัญญีเบิกได้
							$chrgitemip ="B1";	
							$su2=1;
						}elseif($chrgitem1=="SURGN"){  //ทำหัตถการ และบริการวิสัญญีเบิกไม่ได้   ***เพิ่ม 1-8-59***
							$chrgitemip ="B2";	
							$su2=1;													
						}elseif($chrgitem1=="NCARE"){  //ค่าบริการทางการพยาบาลเบิกได้
							$chrgitemip ="C1";
							$nc1=1;
						}elseif($chrgitem1=="NCAREY"){  //ค่าบริการทางการพยาบาลเบิกได้
							$chrgitemip ="C1";
							$nc2=1;	
						}elseif($chrgitem1=="NCAREN"){  //ค่าบริการทางการพยาบาลเบิกไม่ได้
							$chrgitemip ="C2";				
						}elseif($chrgitem1=="DENTA"){  //บริการทางทันตกรรมเบิกได้
							$chrgitemip ="D1";
						}elseif($chrgitem1=="DENTAY"){  //บริการทางทันตกรรมเบิกได้  ***เพิ่ม 1-8-59***
							$chrgitemip ="D1";	
						}elseif($chrgitem1=="PT"){  //บริการทางกายภาพบำบัด และเวชกรรมฟื้นฟูเบิกได้
							$chrgitemip ="E1";
						}elseif($chrgitem1=="PTY"){  //บริการทางกายภาพบำบัด และเวชกรรมฟื้นฟูเบิกได้
							$chrgitemip ="E1";							
						}elseif($chrgitem1=="PTN"){  //บริการทางกายภาพบำบัด และเวชกรรมฟื้นฟูเบิกไม่ได้
							$chrgitemip ="E2";
						}elseif($chrgitem1=="STX"){  //บริการฝังเข็ม/การบาบัดของผู้ประกอบโรคศิลปะอื่น ๆเบิกได้
							$chrgitemip ="F1";
						}elseif($chrgitem1=="STXY"){  //บริการฝังเข็ม/การบาบัดของผู้ประกอบโรคศิลปะอื่น ๆเบิกได้
							$chrgitemip ="F1";							
						}elseif($chrgitem1=="STXN"){  //บริการฝังเข็ม/การบาบัดของผู้ประกอบโรคศิลปะอื่น ๆเบิกไม่ได้
							$chrgitemip ="F2";								
						}elseif($chrgitem1=="MC" || $chrgitem1=="MCY" || $chrgitem1=="MCN"){  //บริการอื่น ๆ ที่ยังไม่จัดหมวด เบิกไม่ได้
							$chrgitemip ="J2";						
						}	elseif($chrgitem1=="EYE"){  //ทำหัตถการ และบริการวิสัญญี (ค่าตรวจตา)
							$chrgitemip ="B1";
						}											
					
					//---------------------ใช้ข้อมูลจากตาราง ipcard---------------------//	 	
					$sqlipc ="select * from  ipcard  where an ='".$anipacc."'"; 
					$resultipc = mysql_query($sqlipc) or die("Query ipcard failed");
					$numipc= mysql_num_rows($resultipc);
					$rowsipc = mysql_fetch_array($resultipc);
						
					//DCDATE
					$dateip=$rowsipc["dcdate"];
					$datetimeip=$dateip;
					$dateip = substr($datetimeip,0,10);
					$dateipc=explode("-",$dateip);
					$newdateip=$dateipc[0]-543;
					$newdateipc =$newdateip.$dateipc[1].$dateipc[2]; 
						
					
					//---------------------ใช้ข้อมูลจากตาราง opday---------------------//	 	
					$sqlop1 ="select * from opday where an ='".$anipacc."'";   //  Query เอาข้อมูลจากตาราง opday
					$resultop1 = mysql_query($sqlop1) or die("Query opday failed");
					$rowsop1 = mysql_fetch_array($resultop1);
						$hnopday=$rowsop1["hn"];  //  HN ใช้ตัวแปรนี้นำเข้าข้อมูล
						$rowidop1=$rowsop1["row_id"];
						$newrowidop1 = substr($rowidop1,3,4);	
													
						if($hnopday ==""){
								$sqlop2 ="select * from ipcard where an='".$anipacc."'";   //  Query เอาข้อมูลจากตาราง opday
								$resultop2 = mysql_query($sqlop2) or die("Query opday failed");
								$rowsop2 = mysql_fetch_array($resultop2);
								$hnopday=$rowsop2["hn"];   //  HN ใช้ตัวแปรนี้นำเข้าข้อมูล					
						}						
						$personidopday=$rowsop1["idcard"]; //  PERSON_ID ใช้ตัวแปรนี้นำเข้าข้อมูล	

					//SEQ					
					$vnop1=$rowsop1["vn"];
					$lenvnop1=strlen($vnop1);
					if($lenvnop1=="1"){
						$newvnop1="00".$vnop1;
					}else if($lenvnop1=="2"){
						$newvnop1="0".$vnop1;
					}else if($lenvnop1=="3"){
						$newvnop1=$vnop1;
					}
					$newseqopday=$newdateipc.$newvnop1.$newrowidop1;  //  SEQ ใช้ตัวแปรนี้นำเข้าข้อมูล	
					

					if($chrgitem1=="BFY"){
							$sqldd ="select *,sum(price) as sumprice11 from  ipacc  where an='".$anipacc."' and (part='BFY')";
							//echo $sqldd."</br>";
							$resultdd = mysql_query($sqldd) or die("Query ipacc failed");		
							while($rowsdd = mysql_fetch_array($resultdd)){
							$sumpricedd = $rowsdd["sumprice11"];
							$db12 = dbase_open($dbname12, 2);
								if ($db12) {
									dbase_add_record($db12, array(
										$hnopday, 
										$anipacc, 
										$newdateipc, 
										$chrgitemip,
										$sumpricedd, 
										$personidopday, 				  				  
										$newseqopday));     
										dbase_close($db12);
									}  //if db	
							}  // while
					}elseif($chrgitem1=="DDL" || $chrgitem1=="DDY"){
						
						
							$sqldd ="select *,sum(price) as sumprice11 from  ipacc  where an='".$anipacc."' and (part='DDL' || part='DDY') and  status !='จำหน่าย' ";
							//echo $sqldd."</br>";
							$resultdd = mysql_query($sqldd) or die("Query ipacc failed");		
							while($rowsdd = mysql_fetch_array($resultdd)){
							$sumpricedd = $rowsdd["sumprice11"];
							$db12 = dbase_open($dbname12, 2);
								if ($db12) {
									dbase_add_record($db12, array(
										$hnopday, 
										$anipacc, 
										$newdateipc, 
										$chrgitemip,
										$sumpricedd, 
										$personidopday, 				  				  
										$newseqopday));     
										dbase_close($db12);
									}  //if db	
							}  // while
							
					$sqldd ="select *,sum(price) as sumprice11 from  ipacc  where an='".$anipacc."' and (part='DDL' || part='DDY') and status !='จำหน่าย' ";
							//echo $sqldd."</br>";
							$resultdd = mysql_query($sqldd) or die("Query ipacc failed");		
							while($rowsdd = mysql_fetch_array($resultdd)){
							$sumpricedd = $rowsdd["sumprice11"];
							$db12 = dbase_open($dbname12, 2);
							$chrgitemip1='31';
								if ($db12) {
									dbase_add_record($db12, array(
										$hnopday, 
										$anipacc, 
										$newdateipc, 
										$chrgitemip1,
										$sumpricedd, 
										$personidopday, 				  				  
										$newseqopday));     
										dbase_close($db12);
									}  //if db	
							}  // while
							
					
					}elseif($chrgitem1=="DSY"){
							$sqldd ="select *,sum(price) as sumprice11 from  ipacc  where an='".$anipacc."' and part='DSY' ";
							//echo $sqldd."</br>";
							$resultdd = mysql_query($sqldd) or die("Query ipacc failed");		
							while($rowsdd = mysql_fetch_array($resultdd)){
							$sumpricedd = $rowsdd["sumprice11"];
							$db12 = dbase_open($dbname12, 2);
								if ($db12) {
									dbase_add_record($db12, array(
										$hnopday, 
										$anipacc, 
										$newdateipc, 
										$chrgitemip,
										$sumpricedd, 
										$personidopday, 				  				  
										$newseqopday));     
										dbase_close($db12);
									}  //if db	
							}  // while
					}else if($chrgitem1=="BLOOD" || $chrgitem1=="BLOODY"){
							$sqlbl ="select *,sum(price) as sumprice21 from  ipacc  where an='".$anipacc."' and (part='BLOOD' || part='BLOODY')";
							//echo $sqlbl."</br>";
							$resultbl = mysql_query($sqlbl) or die("Query ipacc failed");		
							while($rowsbl = mysql_fetch_array($resultbl)){
							$sumpricebl = $rowsbl["sumprice21"];
							$db12 = dbase_open($dbname12, 2);
								if ($db12) {
									dbase_add_record($db12, array(
										$hnopday, 
										$anipacc, 
										$newdateipc, 
										$chrgitemip,
										$sumpricebl, 
										$personidopday, 				  				  
										$newseqopday));     
										dbase_close($db12);
									}  //if db								
						}	 // while	
					}else if($chrgitem1=="LAB" || $chrgitem1=="LABY"){
							$sqlla ="select *,sum(price) as sumprice31 from  ipacc  where an='".$anipacc."' and (part='LAB' || part='LABY')";
							//echo $sqlbl."</br>";
							$resultla = mysql_query($sqlla) or die("Query ipacc failed");		
							while($rowsla = mysql_fetch_array($resultla)){
							$sumpricela = $rowsla["sumprice31"];
							$db12 = dbase_open($dbname12, 2);
								if ($db12) {
									dbase_add_record($db12, array(
										$hnopday, 
										$anipacc, 
										$newdateipc, 
										$chrgitemip,
										$sumpricela, 
										$personidopday, 				  				  
										$newseqopday));     
										dbase_close($db12);
									}  //if db								
						}	 // while							
					}else if($chrgitem1=="XRAY" || $chrgitem1=="XRAYY"){
							$sqlxr ="select *,sum(price) as sumprice41 from  ipacc  where an='".$anipacc."' and (part='XRAY' || part='XRAYY')";
							//echo $sqlbl."</br>";
							$resultxr = mysql_query($sqlxr) or die("Query ipacc failed");		
							while($rowsxr = mysql_fetch_array($resultxr)){
							$sumpricexr = $rowsxr["sumprice41"];
							$db12 = dbase_open($dbname12, 2);
								if ($db12) {
									dbase_add_record($db12, array(
										$hnopday, 
										$anipacc, 
										$newdateipc, 
										$chrgitemip,
										$sumpricexr, 
										$personidopday, 				  				  
										$newseqopday));     
										dbase_close($db12);
									}  //if db								
						}	 // while	
					}else if($chrgitem1=="SINV" || $chrgitem1=="SINVY"){
							$sqlsi ="select *,sum(price) as sumprice51 from  ipacc  where an='".$anipacc."' and (part='SINV' || part='SINVY')";
							//echo $sqlbl."</br>";
							$resultsi = mysql_query($sqlsi) or die("Query ipacc failed");		
							while($rowssi = mysql_fetch_array($resultsi)){
							$sumpricesi = $rowssi["sumprice51"];
							$db12 = dbase_open($dbname12, 2);
								if ($db12) {
									dbase_add_record($db12, array(
										$hnopday, 
										$anipacc, 
										$newdateipc, 
										$chrgitemip,
										$sumpricesi, 
										$personidopday, 				  				  
										$newseqopday));     
										dbase_close($db12);
									}  //if db								
						}	 // while														
					}else if($chrgitem1=="TOOL" || $chrgitem1=="TOOLY"){
							$sqlxr ="select *,sum(price) as sumprice81 from  ipacc  where an='".$anipacc."' and (part='TOOL' || part='TOOLY')";
							//echo $sqlbl."</br>";
							$resultto = mysql_query($sqlxr) or die("Query ipacc failed");		
							while($rowsto = mysql_fetch_array($resultto)){
							$sumpriceto = $rowsto["sumprice81"];
							$db12 = dbase_open($dbname12, 2);
								if ($db12) {
									dbase_add_record($db12, array(
										$hnopday, 
										$anipacc, 
										$newdateipc, 
										$chrgitemip,
										$sumpriceto, 
										$personidopday, 				  				  
										$newseqopday));     
										dbase_close($db12);
									}  //if db								
						}	 // while																	
					}else if($chrgitem1=="SURG" || $chrgitem1=="SURGY"){
							$sqlsu ="select *,sum(price) as sumprice91 from  ipacc  where an='".$anipacc."' and (part='SURG' || part='SURGY')";
							//echo $sqlbl."</br>";
							$resultsu = mysql_query($sqlsu) or die("Query ipacc failed");		
							while($rowssu = mysql_fetch_array($resultsu)){
							$sumpricesu = $rowssu["sumprice91"];
							$db12 = dbase_open($dbname12, 2);
								if ($db12) {
									dbase_add_record($db12, array(
										$hnopday, 
										$anipacc, 
										$newdateipc, 
										$chrgitemip,
										$sumpricesu, 
										$personidopday, 		  				  
										$newseqopday));
										dbase_close($db12);
									}  //if db								
						}	 // while										
					}else if($chrgitem1=="NCAREY" || $chrgitem1=="NCARE"){
							$sqlnc ="select *,sum(price) as sumpricec1 from  ipacc  where an='".$anipacc."' and (part='NCAREY' || part='NCARE')";
							//echo "1)$sqlnc----->$chrgitemip</br>";
							//echo "3=>".$sqlnc."</br>";
							$resultnc = mysql_query($sqlnc) or die("Query ipacc failed");		
							while($rowsnc = mysql_fetch_array($resultnc)){
							$sumpricenc = $rowsnc["sumpricec1"];
							
							$db12 = dbase_open($dbname12, 2);
								if ($db12) {
									dbase_add_record($db12, array(
										$hnopday, 
										$anipacc, 
										$newdateipc, 
										$chrgitemip,
										$sumpricenc, 
										$personidopday, 				  				  
										$newseqopday));     
										dbase_close($db12);
									}  //if db		
									
								}  //while	
					}else if($chrgitem1=="PT" || $chrgitem1=="PTY"){
							$sqlnc ="select *,sum(price) as sumpricec1 from  ipacc   where an='".$anipacc."' and (part='PT' || part='PTY')";
							//echo "2)$sqlnc----->$chrgitemip</br>";
							//echo "3=>".$sqlnc."</br>";
							$resultnc = mysql_query($sqlnc) or die("Query ipacc failed");		
							while($rowsnc = mysql_fetch_array($resultnc)){
							$sumpricenc = $rowsnc["sumpricec1"];
							
							$db12 = dbase_open($dbname12, 2);
								if ($db12) {
									dbase_add_record($db12, array(
										$hnopday, 
										$anipacc, 
										$newdateipc, 
										$chrgitemip,
										$sumpricenc, 
										$personidopday, 				  				  
										$newseqopday));     
										dbase_close($db12);
									}  //if db		
									
								}  //while	
					}else if($chrgitem1=="STX" || $chrgitem1=="STXY"){
							$sqlnc ="select *,sum(price) as sumpricec1 from  ipacc   where an='".$anipacc."' and (part='STX' || part='STXY')";
							//echo "2)$sqlnc----->$chrgitemip</br>";
							//echo "3=>".$sqlnc."</br>";
							$resultnc = mysql_query($sqlnc) or die("Query ipacc failed");		
							while($rowsnc = mysql_fetch_array($resultnc)){
							$sumpricenc = $rowsnc["sumpricec1"];
							
							$db12 = dbase_open($dbname12, 2);
								if ($db12) {
									dbase_add_record($db12, array(
										$hnopday, 
										$anipacc, 
										$newdateipc, 
										$chrgitemip,
										$sumpricenc, 
										$personidopday, 				  				  
										$newseqopday));     
										dbase_close($db12);
									}  //if db		
									
								}  //while									
												
					}else if($chrgitem1=="EYE"){
							$sqlnc ="select *,sum(price) as sumpricec1 from  ipacc  where an='".$anipacc."' and part='EYE' ";
							//echo "$sqlnc----->$chrgitemip</br>";
							//echo "3=>".$sqlnc."</br>";
							$resultnc = mysql_query($sqlnc) or die("Query ipacc failed");		
							while($rowsnc = mysql_fetch_array($resultnc)){
							$sumpricenc = $rowsnc["sumpricec1"];
							
							$db12 = dbase_open($dbname12, 2);
								if ($db12) {
									dbase_add_record($db12, array(
										$hnopday, 
										$anipacc, 
										$newdateipc, 
										$chrgitemip,
										$sumpricenc, 
										$personidopday, 				  				  
										$newseqopday));     
										dbase_close($db12);
									}  //if db		
									
								}  //while	
												
					}else{
					//echo "ปกติ-->$anipacc --> $chrgitem1</br>";
					$db12 = dbase_open($dbname12, 2);
						if ($db12) {
							dbase_add_record($db12, array(
								$hnopday, 
								$anipacc, 
								$newdateipc, 
								$chrgitemip,
								$amountipacc, 
								$personidopday, 				  				  
								$newseqopday));     
								dbase_close($db12);
							}  //if db		
						}  // if chk part
				}  //while
		}  // while
		
//---------------End Dataset12---------------//


//---------------Start Dataset13---------------//
$dbname13 = "AER".$yy.$mm.".dbf";
	$def13 = array(
	array("HN","C",15),
	  array("AN","C",15),
	  array("DATEOPD","D"),	  
	  array("AUTHAE","C",2), 
	  array("AEDATE","D"),	 
	  array("AETIME","C",4),
	  array("AETYPE","C",1),
	  array("REFER_NO","C",20),
	  array("REFMAINI","C",5),
	  array("IREFTYPE","C",4),
	  array("REFMAINO","C",5),
	  array("OREFTYPE","C",4),
	  array("UCAE","C",1),
	  array("EMTYPE","C",1),	 
	  array("SEQ","C",15),
	  array("AESTATUS","C",1),
	  array("DALERT","D",8),
	  array("TALERA","C",4)
	);
	
	// creation
	if (!dbase_create($dbname13, $def13)) {
	  echo "Error, can't create the database13\n";
	}
//---------------End Dataset13---------------//



//---------------Start Dataset14---------------//
//แฟ้มข้อมูลที่ 14 มาตรฐานแฟ้มข้อมูลค่าใช้จ่ายเพิ่ม และบริการที่ยังไม่ได้จัดหมวด (ADP)
$dbname14 = "ADP".$yy.$mm.".dbf";
	$def14 = array(
	  array("HN","C",15),
	  array("AN","C",15),
	  array("DATEOPD","D"),	  
	  array("TYPE","C",2), 
	  array("CODE","C",11),	 
	  array("QTY","N",4,0),
	  array("RATE","N",12,2),
	  array("SEQ","C",15),
	  array("CAGCODE","C",10),
	  array("DOSE","C",10),
	  array("CA_TYPE","C",1),
	  array("SERIALNO","C",24),  //เพิ่มใหม่
	  array("TOTCOPAY","N",12,2),  //เพิ่มใหม่
	  array("USE_STATUS","C",1),
	  array("TOTAL","N",12,2),
	  array("QTYDAY","N",3,0)  //เพิ่มใหม่  
	);
	
	// creation
	if (!dbase_create($dbname14, $def14)) {
	  echo "Error, can't create the database14\n";
	}

//--------------------------------- ค่าใช้จ่ายผู้ป่วยใน	---------------------------------//	
$dbsql ="select * from  ipcard  where $newcredit and dcdate like '".$_POST['year']."-".$_POST['mon']."%' ";
//echo $dbsql;
$dbresult = mysql_query($dbsql) or die("Query ipcard failed14");
while($rowsdb = mysql_fetch_array($dbresult)){
	$hn14=$rowsdb["hn"];  //  HN ใช้ตัวแปรนี้นำเข้าข้อมูล	
	$an14=$rowsdb["an"]; //  AN ใช้ตัวแปรนี้นำเข้าข้อมูล
					
	$newdatetime = substr($rowsdb["dcdate"],0,10);
	$datedc =explode("-",$newdatetime);
	$newdatedc=$datedc[0]-543;
	$newdcdate =$newdatedc.$datedc[1].$datedc[2];  //  DATE_SERV ใช้ตัวแปรนี้นำเข้าข้อมูล	

	//---------------------ใช้ข้อมูลจากตาราง opday---------------------//	 	
	$sqlop ="select * from opday where an ='".$an14."' ";   //  Query เอาข้อมูล VN จากตาราง opday
	$resultop = mysql_query($sqlop) or die("Query opday failed");
	$rowsop = mysql_fetch_array($resultop);
	$vn=$rowsop["vn"];
	$newvn=sprintf('%03d',$vn);




		// 10 = ค่าห้อง/ค่าอาหาร				
		$sqlip ="select * from  ipacc  where an='".$an14."' and part='BFY' group by code ";  // เอาข้อมูลมาตามเงื่อนไข โดยไม่สนวันที่
		//echo $sqlip."</br>"; 
		$resultip = mysql_query($sqlip) or die("Query ipcard failed14");
		$numip = mysql_num_rows($resultip);
		//echo "$numip </br>";
		while($rowsip = mysql_fetch_array($resultip)){			
			$part =$rowsip["part"];
			
			if($part=="BFY"){
						$sqldf ="select *, sum(amount) as dfamount, sum(price) as sumprice from  ipacc  where an='".$an14."' && price <=400  && part='$part'";
						
						//echo $sqldf;
						$resultdf = mysql_query($sqldf) or die("Query ipacc failed");
						$numdf = mysql_num_rows($resultdf);			
						while($rowsdf = mysql_fetch_array($resultdf)){
						$an300=$rowsdf["an"];
						//SEQ	
						$rowidop=$rowsdf["row_id"];
						$newrowid = substr($rowidop,3,4);	
						$newseq=$newdcdate.$newvn.$newrowid;  //  SEQ ใช้ตัวแปรนี้นำเข้าข้อมูล									
						$qty = $rowsdf["dfamount"];	
						$sumprice = $rowsdf["sumprice"];
						
						//echo $sumprice;
						if($rowsdf["price"] =="0.00"){
						$price = $sumprice;
						}else{
						$price = $rowsdf["price"];
						}
						
						
						$chrgitemip ="10";
						$code = "21101";		
										
	//echo $an300; echo  $price;
						if($an300 != "" && $price != 0){		
						//echo "ค่าห้อง <= 300--->$an300/$qty/$price/$newseq </br>";									
						$db14 = dbase_open($dbname14, 2);
							if ($db14) {
								dbase_add_record($db14, array(
									$hn14, //
									$an14, //
									$newdcdate,  //
									$chrgitemip,  //
									$code,
									$qty,
									$price,
									$newseq,
									$cagcode, 	
									$dose, 																																
									$catype,
									$serialno,
									$totcopay,  //
									$use_status,
									$TOTAL,
									$QTYDAY
									));     
									dbase_close($db14);
								}  //if db			
							}  // if num				
						}  // while



					
						$sqldf1 ="select *,sum(amount) as dfamount1 from  ipacc  where an='".$an14."' && price >=401 && part='$part' ";
						//echo "$sqldf1 </br>";
						$resultdf1 = mysql_query($sqldf1) or die("Query ipacc failed");
						$numdf1 = mysql_num_rows($resultdf1);
						while($rowsdf1 = mysql_fetch_array($resultdf1)){
						//SEQ	
						$an600=$rowsdf1["an"];
						
						$rowidop1=$rowsdf1["row_id"];
						$newrowid1 = substr($rowidop1,3,4);	
						$newseq1=$newdcdate.$newvn.$newrowid1;  //  SEQ ใช้ตัวแปรนี้นำเข้าข้อมูล											
						$qty1 = $rowsdf1["dfamount1"];	
						$rate1 = $rowsdf1["price"];
						$chrgitemip1 ="10";
						$code1 = "21201";											
						
						if($an600 != "" && $rate1 != 0){	
						//echo "ค่าห้อง >= 600--->$an600/$qty1/$rate1/$newseq1 </br>";	
						$db14 = dbase_open($dbname14, 2);
							if ($db14) {
								dbase_add_record($db14, array(
									$hn14, //
									$an14, //
									$newdcdate,  //
									$chrgitemip1,  //
									$code1,
									$qty1,
									$rate1,
									$newseq1,
									$cagcode, 	
									$dose, 																																
									$catype,
									$serialno,
									$totcopay,
									$use_status,
									$TOTAL,
									$QTYDAY));     
									dbase_close($db14);
								}  //if db		
							}  // if num					
						}  // while	
					} // if part			
			}  //while
			
			
		
		// 2 = Instrument
		$sqlip2 ="select * from  ipacc  where an='".$an14."' and part='DPY' group by part";  // เอาข้อมูลมาตามเงื่อนไข โดยไม่สนวันที่
		//echo $sqlip."</br>";
		$resultip2 = mysql_query($sqlip2) or die("Query ipcard failed14");
		$numip2 = mysql_num_rows($resultip2);
		//echo "$numip </br>";
		while($rowsip2 = mysql_fetch_array($resultip2)){			
			$part2 =$rowsip2["part"];
			
			if($part2=="DPY"){
						$sqldp ="select *, sum( amount ) as dpamount, sum(price) as dpprice from  ipacc  where an='".$an14."' and part='$part2' group by code";
						//echo $sqldp."</br>";
						$resultdp = mysql_query($sqldp) or die("Query ipacc failed");
						while($rowsdp = mysql_fetch_array($resultdp)){
						$andp=$rowsdp["an"];
						//SEQ	
						$rowidop=$rowsdp["row_id"];
						$newrowid = substr($rowidop,3,4);	
						$newseq=$newdcdate.$newvn.$newrowid;  //  SEQ ใช้ตัวแปรนี้นำเข้าข้อมูล
						$qty = $rowsdp["dpamount"];	
						$rate =$rowsdp["dpprice"];
						$code14 = $rowsdp["code"];
						$chrgitemip ="2";	
			$detail= 	$rowsdp["detail"];	
						//echo 	$code14;
						if($code14 =="SURG"){
							
							$code = substr($detail,0,4);
							//echo $code;
						}else{
							$sqldrx= "SELECT dpy_code FROM  druglst WHERE drugcode ='".$code14."' ";
							//echo $sqldrx."</br>";
							$resultdrx = mysql_query($sqldrx) or die("Query druglst failed");
							$rowsdrx=mysql_fetch_array($resultdrx);	
							$code = substr($rowsdrx["dpy_code"],0,4);													
						}									



						if($andp !="" && $rate != 0){
						//echo "DPY--->$andp/$qty/$rate/$newseq </br>";				
						$db14 = dbase_open($dbname14, 2);
							if ($db14) {
								dbase_add_record($db14, array(
									$hn14, //
									$an14, //
									$newdcdate,  //
									$chrgitemip,  //
									$code,
									$qty,
									$rate,
									$newseq,
									$cagcode, 	
									$dose, 																																  				  
									$catype,
									$serialno,
									$totcopay,
									$use_status,
									$TOTAL,
									$QTYDAY));     
									dbase_close($db14);
								}  //if db		
							} // if check an					
						}  // while
					} // if part			
			}  //while				
			
			
		
		
			
		// 11 = เวชภัณฑ์ที่ไม่ใช่ยา	
		$sqlip3 ="select * from  ipacc  where an='".$an14."' and part='DSY' group by part ";  // เอาข้อมูลมาตามเงื่อนไข โดยไม่สนวันที่
		//echo $sqlip3."</br>";
		$resultip3 = mysql_query($sqlip3) or die("Query ipcard failed14");
		$numip3 = mysql_num_rows($resultip3);
		//echo "$numip3 </br>";
		while($rowsip3 = mysql_fetch_array($resultip3)){			
			$part3 =$rowsip3["part"];
			
			if($part3=="DSY"){
						$sqlds ="select *,sum(price) as dsprice from  ipacc  where an='".$an14."' and part='$part3'";
						//echo $sqlds."</br>";
						$resultds = mysql_query($sqlds) or die("Query ipacc failed");
						while($rowsds = mysql_fetch_array($resultds)){
						$ands=$rowsds["an"];						
						//SEQ	
						$rowidop=$rowsds["row_id"];
						$newrowid = substr($rowidop,3,4);	
						$newseq=$newdcdate.$newvn.$newrowid;  //  SEQ ใช้ตัวแปรนี้นำเข้าข้อมูล
					//	$qty = $rowsds["amount"];
						$qty = '1';
						$rate =$rowsds["dsprice"];
						$chrgitemip ="11";
						$code ="XXXXXX";
						$use_status='1';						
						if($ands !="" && $rate != 0){
						//echo "DSY--->$ands/$qty/$rate/$newseq </br>";								
						$db14 = dbase_open($dbname14, 2);
							if ($db14) {
								dbase_add_record($db14, array(
									$hn14, //
									$an14, //
									$newdcdate,  //
									$chrgitemip,  //
									$code,
									$qty,
									$rate,
									$newseq,
									$cagcode, 	
									$dose, 																															
									$catype,
									$serialno,
									$totcopay,
									$use_status,
									$TOTAL,
									$QTYDAY));     
									dbase_close($db14);
								}  //if db			
							}   //if check an				
						}  // while
					} // if part			
			}  //while						


		// 12 = ค่าบริการทันตกรรม	
		$sqlip4 ="select * from  ipacc  where an='".$an14."' and (part='DENTA' || part='DENTAY')  group by part ";  // เอาข้อมูลมาตามเงื่อนไข โดยไม่สนวันที่
		//echo $sqlip3."</br>";
		$resultip4 = mysql_query($sqlip4) or die("Query ipcard failed14");
		$numip4 = mysql_num_rows($resultip4);
		//echo "$numip3 </br>";
		while($rowsip4 = mysql_fetch_array($resultip4)){			
			$part4 =$rowsip4["part"];
			
			if($part4=="DENTA" || $part4=="DENTAY"){
						$sqlds ="select *,sum(price) as dsprice from  ipacc  where an='".$an14."' and part='$part3'";
						//echo $sqlds."</br>";
						$resultds = mysql_query($sqlds) or die("Query ipacc failed");
						while($rowsds = mysql_fetch_array($resultds)){
						$ands=$rowsds["an"];						
						//SEQ	
						$rowidop=$rowsds["row_id"];
						$newrowid = substr($rowidop,3,4);	
						$newseq=$newdcdate.$newvn.$newrowid;  //  SEQ ใช้ตัวแปรนี้นำเข้าข้อมูล
					//	$qty = $rowsds["amount"];
						$qty = '1';
						$rate =$rowsds["dsprice"];
						$chrgitemip ="12";
						$code =$rowsds["code"];
						$use_status='1';						
						if($ands !="" && $rate != 0){
						//echo "DENTA--->$ands/$qty/$rate/$newseq </br>";								
						$db14 = dbase_open($dbname14, 2);
							if ($db14) {
								dbase_add_record($db14, array(
									$hn14, //
									$an14, //
									$newdcdate,  //
									$chrgitemip,  //
									$code,
									$qty,
									$rate,
									$newseq,
									$cagcode, 	
									$dose, 																															
									$catype,
									$serialno,
									$totcopay,
									$use_status,
									$TOTAL,
									$QTYDAY));     
									dbase_close($db14);
								}  //if db			
							}   //if check an				
						}  // while
					} // if part			
			}  //while	
			
			
			
		// 13 = ค่าบริการฝังเข็ม	
		$sqlip5 ="select * from  ipacc  where an='".$an14."' and (part='STX' || part='STXY')   group by part ";  // เอาข้อมูลมาตามเงื่อนไข โดยไม่สนวันที่
		//echo $sqlip3."</br>";
		$resultip5 = mysql_query($sqlip5) or die("Query ipcard failed14");
		$numip5 = mysql_num_rows($resultip5);
		//echo "$numip3 </br>";
		while($rowsip5 = mysql_fetch_array($resultip5)){			
			$part5 =$rowsip5["part"];
			
			if($part5=="STX" || $part5=="STXY"){
						$sqlds ="select *,sum(price) as dsprice from  ipacc  where an='".$an14."' and part='$part3'";
						//echo $sqlds."</br>";
						$resultds = mysql_query($sqlds) or die("Query ipacc failed");
						while($rowsds = mysql_fetch_array($resultds)){
						$ands=$rowsds["an"];						
						//SEQ	
						$rowidop=$rowsds["row_id"];
						$newrowid = substr($rowidop,3,4);	
						$newseq=$newdcdate.$newvn.$newrowid;  //  SEQ ใช้ตัวแปรนี้นำเข้าข้อมูล
					//	$qty = $rowsds["amount"];
						$qty = '1';
						$rate =$rowsds["dsprice"];
						$chrgitemip ="13";
						$code =$rowsds["code"];
						$use_status='1';						
						if($ands !="" && $rate != 0){
						//echo "DENTA--->$ands/$qty/$rate/$newseq </br>";								
						$db14 = dbase_open($dbname14, 2);
							if ($db14) {
								dbase_add_record($db14, array(
									$hn14, //
									$an14, //
									$newdcdate,  //
									$chrgitemip,  //
									$code,
									$qty,
									$rate,
									$newseq,
									$cagcode, 	
									$dose, 																															
									$catype,
									$serialno,
									$totcopay,
									$use_status,
									$TOTAL,
									$QTYDAY));     
									dbase_close($db14);
								}  //if db			
							}   //if check an				
						}  // while
					} // if part			
			}  //while									

					
}  //while

//---------------End Dataset14---------------//


//---------------Start Dataset15---------------//

$dbname15 = "LVD".$yy.$mm.".dbf";
	$def15 = array(
	  array("SEQLVD","C",3),
	  array("AN","C",15),
	  array("DATEOUT","D"),	  
	  array("TIMEOUT","C",4), 
	  array("DATEIN","D"),	 
	  array("TIMEIN","C",4),
	  array("QTYDAY","C",3)
	);
	
	// creation
	if (!dbase_create($dbname15, $def15)) {
	  echo "Error, can't create the database15\n";
	}	
//---------------End Dataset15---------------//


//---------------Start Dataset16---------------//
//แฟ้มข้อมูลที่ 16 มาตรฐานแฟ้มข้อมูลการใช้ยา (DRU)
$dbname16 = "DRU".$yy.$mm.".dbf";
	$def16 = array(
	   array("HCODE","C",5),
	  array("HN","C",15),
	  array("AN","C",9),
	  array("CLINIC","C",4),
	  array("PERSON_ID","C",13),	  
	  array("DATE_SERV","D"),	  
	  array("DID","C",30), 
	  array("DIDNAME","C",255),	 
	  array("AMOUNT","C",12),
	  array("DRUGPRIC","C",14),
	  array("DRUGCOST","C",14),
	  array("DIDSTD","C",24), 
	  array("UNIT","C",20),	 
	  array("UNIT_PACK","C",20),
	  array("SEQ","C",15),
	  array("DRUGREMARK","C",2),	  
	  array("PA_NO","C",9),
	  array("TOTCOPAY","N",7,0),	//เพิ่มใหม่  
	  array("USE_STATUS","C",1),
	  array("TOTAL","N",12,2),	  //เพิ่มใหม่  
	  array("SIGCODE","C",50),
	  array("SIGTEXT","C",255)
	);
	
	// creation
	if (!dbase_create($dbname16, $def16)) {
	  echo "Error, can't create the database16\n";
	}
	
			//--------------------------------- ค่าใช้จ่ายผู้ป่วยใน	---------------------------------//	
			$dbsql ="select * from  ipcard  where $newcredit and dcdate like '".$_POST['year']."-".$_POST['mon']."%'  ";
			$dbresult = mysql_query($dbsql) or die("Query ipcard failed16");
			while($rowsdb = mysql_fetch_array($dbresult)){
					//$hcode16 ="11486";
					$hcode2 ="11512";
					$hn16=$rowsdb["hn"];  //  HN ใช้ตัวแปรนี้นำเข้าข้อมูล	
					$an16=$rowsdb["an"]; //  AN ใช้ตัวแปรนี้นำเข้าข้อมูล
					
					$newdatetime = substr($rowsdb["dcdate"],0,10);
					$datedc =explode("-",$newdatetime);
					$newdatedc=$datedc[0]-543;
					$newdcdate =$newdatedc.$datedc[1].$datedc[2];  //  DATE_SERV ใช้ตัวแปรนี้นำเข้าข้อมูล							
					
				$sqlip ="select *, sum(price) as sumprice, sum(amount) as sumamount from  ipacc  where an='".$an16."' AND depart='PHAR' AND (part ='DDL' || part ='DDY') group by code";
				//echo $sqlip."==>";
				$resultip = mysql_query($sqlip) or die("Query ipcard failed16");
					$i=0;
					while($rowsip = mysql_fetch_array($resultip)){
					$i++;
						$dateip=$rowsip["date"];
						$newdateip = substr($dateip,0,10);
						//echo "$i===>$an16===>".$rowsip["code"];
						$sqldrglist="select drugcode from druglst where drugcode='".$rowsip["code"]."'";
						//echo $sqldrglist."</br>";
						$querydrglist=mysql_query($sqldrglist);
						list($drugcode16)=mysql_fetch_array($querydrglist);
						
									
						//$drugcode16=$rowsip["code"];		
						$drugname16=$rowsip["detail"];	
						$amount16=$rowsip["sumamount"];  //  AMOUNT จำนวนยา
						$saleprice=$rowsip["price"]/$rowsip["amount"];	//ราคา/หน่วย	DRUGPRICE(ราคาขาย)
						//$total=$saleprice*$rowsip["sumamount"];  //TOTAL ราคารวมยาที่ขอเบิก เก่า
						$total=$rowsip["sumprice"];  //TOTAL ราคารวมยาที่ขอเบิก ใหม่
						
						//echo "===>รหัสยา:$drugcode16 ===>ราคา:$saleprice==>จำนวน:$amount16 ===>รวม:$total<br>";
					
						//---------------------ใช้ข้อมูลจากตาราง opday---------------------//	 	
						$sqlop ="select * from opday where an ='".$an16."' ";   //  Query เอาข้อมูลจากตาราง opday
						$resultop = mysql_query($sqlop) or die("Query opcard failed");
						$rowsop = mysql_fetch_array($resultop);
							$personid=$rowsop["idcard"]; //  PERSON_ID ใช้ตัวแปรนี้นำเข้าข้อมูล	
							
							//CLINIC
							$clinic3=$rowsop["clinic"];
							$clinic1=0;
							$clinic2=1;
							$clinic=substr($clinic3,0,2);
							if($clinic==''){$clinic="00";} ;
							$newclinic=$clinic1.$clinic.$clinic2;  //  CLINIC ใช้ตัวแปรนี้นำเข้าข้อมูล								

							//SEQ
							$rowidop=$rowsop["row_id"];
							$newrowid = substr($rowidop,3,4);		
							
							$vn=$rowsop["vn"];
							$newvn=sprintf('%03d',$vn);
							$newseq=$newdcdate.$newvn.$newrowid;  //  SEQ ใช้ตัวแปรนี้นำเข้าข้อมูล		
							
							
					//---------------------ใช้ข้อมูลยาจากตาราง druglst---------------------//					
					$sqldrx= "SELECT * FROM  druglst WHERE drugcode ='".$drugcode16."' ";
					$resultdrx = mysql_query($sqldrx) or die("Query druglst failed");
					$rowsdrx=mysql_fetch_array($resultdrx);
						$code24=$rowsdrx["code24"];    //  DIDSTD ใช้ตัวแปรนี้นำเข้าข้อมูล
						//$saleprice=$rowsdrx["salepri"];    //  DRUGPRICE(ราคาขาย) ใช้ตัวแปรนี้นำเข้าข้อมูล
						$unitprice=$rowsdrx["unitpri"];    //  DRUGCOST(ราคาทุน) ใช้ตัวแปรนี้นำเข้าข้อมูล
						$unit=$rowsdrx["unit"];    //  DIDSTD ใช้ตัวแปรนี้นำเข้าข้อมูล
						$packing=$rowsdrx["packing"];    //  UNIT_PACK ใช้ตัวแปรนี้นำเข้าข้อมูล	
								
						

					$sql161 ="select * from  drugrx  where an='".$an16."' and drugcode ='".$drugcode16."' ";
					//echo $sql161."</br>";
					$result161 = mysql_query($sql161) or die("Query failed16");
					$num161= mysql_num_rows($result161);
					$rows161 = mysql_fetch_array($result161);	
					
					$sigcode=$rows161["slcode"];  //รหัสวิธีใช้ยา
					
					$sqlslcode=mysql_query("select * from drugslip where slcode='".$rows161["slcode"]."'");
					$resultslcode=mysql_fetch_array($sqlslcode);
					
					$sigtext=$resultslcode["detail1"]." ".$resultslcode["detail2"]." ".$resultslcode["detail3"]." ".$resultslcode["detail4"];  //วิธีใช้ยา
	
						
								// ระบุรหัสเหตุผล EA, EB, EC, ED, EE, EF
								$reason161=$rows161["reason"]; 
								$reason1=substr($reason161,0,1);
								$reasondefault1 ="00";													
					
						if(($reason1 =="A" || $reason1 =="B" || $reason1 =="C" || $reason1 =="D" || $reason1 =="E" || $reason1 =="F") && $reason1 !=" "){
						$newreason1 ="E".$reason1;
						$db16 = dbase_open($dbname16, 2);
						if ($db16) {
							dbase_add_record($db16, array(
								$hcode2, //
								$hn16, //
								$an16, //
								$newclinic,  //
								$personid, //
								$newdcdate, //
								$drugcode16,  // drugcode
								$drugname16,   //
								$amount16,  //
								$saleprice,  //
								$unitprice,  //
								$code24, 	 //
								$unit, 	 //
								$packing, 	  //
								$newseq, 	 //
								$newreason1, 		//																															
								$pano,
								$totcopay,  //จำนวนเงินรวม หน่วยเป็นบาท ในส่วนที่เบิกไม่ได้
								$use_status ,  //หมวดรายการยา
								$total,  //จำนวนเงินรวมที่ขอเบิกของรายการนั้น
								$sigcode,  //รหัสวิธีใช้ยา (ถ้ามี)
								$sigtext		//วิธีใช้ยา (ถ้ามี)								
								));     
								dbase_close($db16);
							}  //if db		
						}else{
							$db16 = dbase_open($dbname16, 2);
								if ($db16) {
									dbase_add_record($db16, array(
										$hcode2, //
										$hn16, //
										$an16, //
										$newclinic,  //
										$personid,  //
										$newdcdate, //
										$drugcode16,  // drugcode
										$drugname16,   //
										$amount16,  //
										$saleprice,  //
										$unitprice,  //
										$code24, 	 //
										$unit, 	 //
										$packing, 	  //
										$newseq, 	 //
										$reasondefault1, //																											
										$pano,
										$totcopay,  //จำนวนเงินรวม หน่วยเป็นบาท ในส่วนที่เบิกไม่ได้
										$use_status ,  //หมวดรายการยา
										$total,  //จำนวนเงินรวมที่ขอเบิกของรายการนั้น
										$sigcode,  //รหัสวิธีใช้ยา (ถ้ามี)
										$sigtext		//วิธีใช้ยา (ถ้ามี)								
										));     
										dbase_close($db16);
									}  //if db						
						}  // if $reason			
					}  // while
			}  // while	
	
//---------------End Dataset16---------------//


	$dbfname =$mm."-".$newyear;
	$ZipName = "ipd/$dbfname.zip";
	require_once("dZip.inc.php"); // include Class
	$zip = new dZip($ZipName); // New Class
	$zip->addFile($dbname1, $dbname1); // Source,Destination	
	$zip->addFile($dbname2, $dbname2); // Source,Destination	
	$zip->addFile($dbname3, $dbname3); // Source,Destination
	$zip->addFile($dbname4, $dbname4); // Source,Destination	
	$zip->addFile($dbname5, $dbname5); // Source,Destination	
	$zip->addFile($dbname5, $dbname6); // Source,Destination	
	$zip->addFile($dbname7, $dbname7); // Source,Destination
	$zip->addFile($dbname8, $dbname8); // Source,Destination
	$zip->addFile($dbname9, $dbname9); // Source,Destination	
	$zip->addFile($dbname10, $dbname10); // Source,Destination	
	$zip->addFile($dbname11, $dbname11); // Source,Destination
	$zip->addFile($dbname12, $dbname12); // Source,Destination
	$zip->addFile($dbname13, $dbname13); // Source,Destination	
	$zip->addFile($dbname14, $dbname14); // Source,Destination	
	$zip->addFile($dbname15, $dbname15); // Source,Destination
	$zip->addFile($dbname16, $dbname16); // Source,Destination	
	$zip->save();
	
	echo "ดาวน์โหลดข้อมูล DBF ผู้ป่วยในเพื่อนำเข้าโปรแกรม E-Claim...สิทธิ $showptright...ประจำเดือน $fullm <a href=$ZipName>คลิกที่นี่ดาวน์โหลด</a>";	
	
	/*echo "<strong style='color:red;'>อยู่ระหว่างปรับปรุงโครงสร้างใหม่ หากต้องการดึงข้อมูลจริง กรุณาติดต่อ....แอมป์ โทร.6203 ครับ</strong>";*/
}  // if check box ปิดสุดท้าย
?>