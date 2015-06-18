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
<strong>ส่งออกข้อมูล DBF คนไข้นอก</strong></font></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../../nindex.htm"><< ไปเมนู</a>
<span class="font1">
<font face="Angsana New">
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
  <table width="563" border="0">
    <tr>
      <td width="33"><font face="Angsana New">วันที่ :</font></td>
      <td width="81"><label>
        <select name="day" id="day">
          <option value="00" selected="selected">--เลือก--</option>
          <option value="01">01</option>
          <option value="02">02</option>
          <option value="03">03</option>
          <option value="04">04</option>
          <option value="05">05</option>
          <option value="06">06</option>
          <option value="07">07</option>
          <option value="08">08</option>
          <option value="09">09</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
        </select>
      </label></td>
      <td width="26">เดือน :</td>
      <td width="94"> 
     <select name="mon">
           <option value="01" >มกราคม</option>
           <option value="02" >กุมภาพันธ์</option>
           <option value="03">มีนาคม</option>
           <option value="04">เมษายน</option>
           <option value="05">พฤษภาคม</option>
           <option value="06">มิถุนายน</option>
           <option value="07">กรกฎาคม</option>
           <option value="08">สิงหาคม</option>
           <option value="09">กันยายน</option>
           <option value="10">ตุลาคม</option>
           <option value="11">พฤศจิกายน</option>
           <option value="12">ธันวาคม</option>
       </select></td>
      <td width="118">พ.ศ. : &nbsp;&nbsp;
		<?
        $Y=date("Y")+543;
        $date=date("Y")+543+5;
                      
        $dates=range(2547,$date);
        echo "<select name='year' class='forntsarabun'>";
        foreach($dates as $i){
        ?>
<option value='<?=$i; ?>' <? if($Y==$i){ echo "selected"; }?>>
            <?=$i;?>
        </option>
        <?
        }
        echo "<select>";
        ?>      </td>
      <td width="32" align="right"><font face="Angsana New">สิทธิ :</font></td>
      <td width="99"><select name="credit" id="credit">
        <option value="000">----ทั้งหมด----</option>
        <option value="OFC">จ่ายตรง</option>
        <option value="SSS">ประกันสังคม</option>
        <option value="LGO">อปท</option>
         <option value="UCS" >UCS</option>
      </select>      </td>
      <td width="46"><input name="BOK" value="ตกลง" type="submit" /></td>
    </tr>
  </table>
</form>
</font>
</span>
<?
if(isset($_POST['BOK'])){

$year = $_POST['year'];
$newyear = $year-543;
$yy = substr($newyear,2,2);
$mm =$_POST['mon'];
$day =$_POST['day'];

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
	echo "เรียบร้อย </br>";				
}
// จบ ลบไฟล์-----------------)

if($_POST['credit']=="OFC"){
	$newcredit = "จ่ายตรง";
}else if($_POST['credit']=="SSS"){
	$newcredit = "ประกันสังคม";
}else if($_POST['credit']=="LGO"){
	$newcredit = "จ่ายตรง อปท.";
}else if($_POST['credit']=="UCS"){
	$newcredit = "30บาท";
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
	  array("RELINSCL","C",1) , // เพิ่มใหม่
	  array("HTYPE","C",1)  // เพิ่มใหม่
	  );
	
	// creation
	if (!dbase_create($dbname1, $def1)) {
	  echo "Error, can't create the database1\n";
	};
	
if($_POST['credit']	=="000"){	
		$sqlop1 ="select hn, txdate from  opacc  where date like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%' group by substring(date,1,10), hn";
}else{
		$sqlop1 ="select hn, txdate from  opacc  where credit like '$newcredit%' and date like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%' group by substring(date,1,10), hn";
}	
//echo 	$sqlop1 ;
		//echo "test-->".$sqlop3."<br>";
   		$resultop1 = mysql_query($sqlop1) or die("Query failed3");
		while($rowsop1 = mysql_fetch_array($resultop1)){
			$hnop=$rowsop1["hn"];	
			
			$datetime=$rowsop1["txdate"];
			$dateopacc = substr($datetime,0,10);	
	
		$sql1 ="select * from opday where hn ='".$hnop."' and thidate like '$dateopacc%'";   //  Query เอาข้อมูลจากตาราง opday
		$result1 = mysql_query($sql1) or die("Query failed1");
   		$rows1 = mysql_fetch_array($result1);
		$hcode1 ="11512";
		$hn1=$rows1["hn"];
		$an1=$rows1["an"];
		$vn1=$rows1["vn"];
		$rowid=$rows1["row_id"];
		$newrowid = substr($rowid,3,4);		
	
		//datetime
		$datetime1=$rows1["thidate"];
		$date1 = substr($datetime1,0,10);
		$date =explode("-",$date1);
		$newdate=$date[0]-543;
		$newdateopd =$newdate.$date[1].$date[2]; 
			
		//SEQ
		$lenvn=strlen($vn1);
		if($lenvn=="1"){
			$newvn="00".$vn1;
		}else if($lenvn=="2"){
			$newvn="0".$vn1;
		}else if($lenvn=="3"){
			$newvn=$vn1;
		}
		$newseq=$newdateopd.$newvn.$newrowid;  //  SEQ ใช้ตัวแปรนี้นำเข้าข้อมูล	
				
		
		
		if($_POST['credit']	=="000"){
			$ptright=$rows1["ptright"];
			$codeptright = substr($ptright,0,3);	
			//  กำหนดตัวแปรของ สิทธิ์การรักษา
			if($codeptright =="R06"){
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
		}else{
			$newptright=$_POST['credit'];
		}
		


		$db1 = dbase_open($dbname1, 2);
		if ($db1) {
			  dbase_add_record($db1, array(
				  $hn1, 
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
				  $an1,    // เพิ่มใหม่
				  $newseq,   // เพิ่มใหม่
				  $subinscl1,    // เพิ่มใหม่
				  $relinscl1,  // เพิ่มใหม่
				  $htype 
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
	  array("NAMEPAT",    "C", 36),
	  array("TITLE",     "C", 30),
	  array("FNAME",     "C",  40),
	  array("LNAME",      "C",   40),
	  array("IDTYPE",    "C", 1)
	);
	
	// creation
	if (!dbase_create($dbname2, $def2)) {
	  echo "Error, can't create the database2\n";
	}

		$sqlop2 ="select hn, txdate from  opacc  where credit like '$newcredit%' and date like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%' group by substring(date,1,10), hn";
		//echo "test-->".$sqlop3."<br>";
   		$resultop2 = mysql_query($sqlop2) or die("Query failed3");
		while($rowsop2 = mysql_fetch_array($resultop2)){
			$hnop=$rowsop2["hn"];	
			
			$datetime=$rowsop2["txdate"];
			$dateopacc = substr($datetime,0,10);	
			
		
	$sql2 ="select hn from opday where hn ='".$hnop."' and thidate like '$dateopacc%'";   //  Query เอาข้อมูลจากตาราง opday
		$result2 = mysql_query($sql2) or die("Query PAT Failed");
   		$rows2 = mysql_fetch_array($result2);
		$hn2=$rows2["hn"];


//---------------------ใช้ข้อมูลจากตาราง opcard---------------------//
		$sqlop ="select * from opcard where hn ='".$hn2."'";   //  Query เอาข้อมูลจากตาราง opday
		$resultop = mysql_query($sqlop) or die("Query opcard failed");
   		$rowsop = mysql_fetch_array($resultop);
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
if($_POST['credit']	=="000"){
	if($day=="00"){
		$sqlop3 ="select hn, txdate from  opacc  where  ddate like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%' group by substring(date,1,10), hn";
		//echo "สิทธิทั้งหมดไม่ใส่วันที่ : ".$sqlop3."<br>";
	}else{
		$sqlop3 ="select hn, txdate from  opacc  where date like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%' group by substring(date,1,10), hn";
		
		
		//echo "สิทธิทั้งหมดใส่วันที่ : ".$sqlop3."<br>";
	}
}else{
	if($day=="00"){
		$sqlop3 ="select hn, txdate from  opacc  where credit like '$newcredit%' and (date between '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']." 23:59:59') group by substring(date,1,10), hn";
		//echo "เลือกสิทธิไม่ใส่วันที่ : ".$sqlop3."<br>";
	}else{
		$sqlop3 ="select hn, txdate from  opacc  where credit like '$newcredit%' and (date between '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']." 23:59:59') group by substring(date,1,10), hn";
		//echo "เลือกสิทธิใส่วันที่ : ".$sqlop3."<br>";
	}
} 
  
		$resultop3 = mysql_query($sqlop3) or die("Query failed3");
		while($rowsop3 = mysql_fetch_array($resultop3)){
			$hnop=$rowsop3["hn"];	
			
			$datetime=$rowsop3["txdate"];
			$dateopacc = substr($datetime,0,10);	
			
		
		
		$sql3 ="select * from opday where hn ='".$hnop."' and thidate like '$dateopacc%'";   //  Query เอาข้อมูลจากตาราง opday
		//echo "วันที่ $datetime ==>".$sql3."<br>";
		$result3 = mysql_query($sql3) or die("Query opday failed");
   		$rows3 = mysql_fetch_array($result3);
		$rowid=$rows3["row_id"];
		$newrowid = substr($rowid,3,4);
		
		$hn3=$rows3["hn"];  //  HN ใช้ตัวแปรนี้นำเข้าข้อมูล
		$vn3=$rows3["vn"]; 
		
		//datetime
		$datetime3=$rows3["thidate"];
		$date3 = substr($datetime3,0,10);
		$date =explode("-",$date3);
		$newdate=$date[0]-543;
		$newdateopd =$newdate.$date[1].$date[2];  //  DATEOPD ใช้ตัวแปรนี้นำเข้าข้อมูล
		
		$time3 = substr($datetime3,11,8);	
		$newtime =explode(":",$time3);
		$newtimeopd = $newtime[0].$newtime[1];  //  TIMEOPD ใช้ตัวแปรนี้นำเข้าข้อมูล

		//clinic
		$clinic3=$rows3["clinic"];
		$clinic1=0;
		$clinic2=1;
   		$clinic=substr($clinic3,0,2);
		if($clinic==''){$clinic="00";} ;
		$newclinic=$clinic1.$clinic.$clinic2;  //  CLINIC ใช้ตัวแปรนี้นำเข้าข้อมูล
		
		//SEQ
		$lenvn=strlen($vn3);
		if($lenvn=="1"){
			$newvn="00".$vn3;
		}else if($lenvn=="2"){
			$newvn="0".$vn3;
		}else if($lenvn=="3"){
			$newvn=$vn3;
		}
		$newseq=$newdateopd.$newvn.$newrowid;  //  SEQ ใช้ตัวแปรนี้นำเข้าข้อมูล

		$ucc3="1";  //  UCC ใช้ตัวแปรนี้นำเข้าข้อมูล

	$db3 = dbase_open($dbname3, 2);
		if ($db3) {
			  dbase_add_record($db3, array(
				  $hn3, 
				  $newclinic,		  
				  $newdateopd,
				  $newtimeopd, 		
				  $newseq, 				  		  
				  $ucc3));   
					dbase_close($db3);
				}  //if db
	}  //while
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
		$sql5 ="select * from diag  where svdate like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%'";
		$result5 = mysql_query($sql5) or die("Query failed5");
   		while($rows5 = mysql_fetch_array($result5)){
		$doctor_name=$rows5["office"];
		$hn5=$rows5["hn"];   //  HN ใช้ตัวแปรนี้นำเข้าข้อมูล
		
		
		//DATEDX
		$datedx5=$rows5["svdate"];
		$date5 = substr($datedx5,0,10);
		$date =explode("-",$date5);
		$newdate=$date[0]-543;
		$newdatedx =$newdate.$date[1].$date[2];  //  DATEDX ใช้ตัวแปรนี้นำเข้าข้อมูล
				
		$diag5=$rows5["icd10"];  //  DIAG ใช้ตัวแปรนี้นำเข้าข้อมูล
		
		//------------------กำหนดตัวแปรของ ชนิดของโรค
		$dxtype5=$rows5["type"];
		if($dxtype5=="PRINCIPLE"){		
			$dxtype ="1";
		}else if(dxtype5=="CO-MORBIDITY"){
			$dxtype ="2";
		}else if(dxtype5=="COMPLICATION"){
			$dxtype ="3";
		}else if(dxtype5=="OTHER"){
			$dxtype ="4";
		}else if(dxtype5=="EXTERNAL CAUSE"){
			$dxtype ="5";
		}else{
			$dxtype ="2";
		}


//---------------------ใช้ข้อมูลจากตาราง opday---------------------//
		$sqlop ="select * from opday where hn ='".$hn5."' and thidate like '$date5%'";   //  Query เอาข้อมูลจากตาราง opday
		$resultop = mysql_query($sqlop) or die("Query opday failed");
   		$rowsop = mysql_fetch_array($resultop);
			$hn=$rowsop["hn"]; 
			$personid=$rowsop["idcard"];  //  PERSON_ID ใช้ตัวแปรนี้นำเข้าข้อมูล
			
				
				//---------------------หารหัสและชื่อหมอ-------------------------//
				$sqldoc ="select doctorcode from doctor where  name like  '%$doctor_name%' ";   //  Query เอาข้อมูลจากตาราง doctor
				$resultdoc = mysql_query($sqldoc) or die("Query doctor failed");
				$numdoc = mysql_num_rows($resultdoc);
				$rowsdoc = mysql_fetch_array($resultdoc);
					if($numdoc > 0){
							$newdrdx = $rowsdoc["doctorcode"];
					}else{			
					$sqlinp ="select codedoctor from inputm where  name like  '%$doctor_name%' ";   //  Query เอาข้อมูลจากตาราง inputm
					$resultinp = mysql_query($sqlinp) or die("Query inputm failed");
					$rowsinp = mysql_fetch_array($resultinp);	
						$newdrdx = $rowsinp["codedoctor"];
					}
				

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
			$lenvn=strlen($vn);
			if($lenvn=="1"){
				$newvn="00".$vn;
			}else if($lenvn=="2"){
				$newvn="0".$vn;
			}else if($lenvn=="3"){
				$newvn=$vn;
			}
			$newseq=$newdatedx.$newvn.$newrowid;  //  SEQ ใช้ตัวแปรนี้นำเข้าข้อมูล	
			
			//DRDX

	$db5 = dbase_open($dbname5, 2);
		if ($db5) {
			  dbase_add_record($db5, array(
				  $hn5, 
				  $newdatedx,
				  $newclinic, 				  
				  $diag5, 		
				  $dxtype, 	
				  $newdrdx, 		
				  $personid, 					  			  		  
				  $newseq));   
					dbase_close($db5);
				}  //if db
		}  //while
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

		$sql6 ="select * from opicd9cm  where svdate like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%' order by row_id";
		//echo $sql6."</br>";
		$result6 = mysql_query($sql6) or die("Query failed6");
		$num6 = mysql_num_rows($result6);
		//echo $num6."</br>";
   		while($rows6 = mysql_fetch_array($result6)){
		$hn6=$rows6["hn"];   //  HN ใช้ตัวแปรนี้นำเข้าข้อมูล
		$oper6=$rows6["icd9cm"];   //  OPER ใช้ตัวแปรนี้นำเข้าข้อมูล
		
		//DATEOPD
		$dateopd6=$rows6["svdate"];
		$date6 = substr($dateopd6,0,10);
		$date =explode("-",$date6);
		$newdate=$date[0]-543;
		$newdateopd =$newdate.$date[1].$date[2];  //  DATEOPD ใช้ตัวแปรนี้นำเข้าข้อมูล		
		
		
//---------------------ใช้ข้อมูลจากตาราง opday---------------------//
		$sqlop ="select * from opday where hn ='".$hn6."' and  thidate  like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%'  order by row_id";   //  Query เอาข้อมูลจากตาราง opday
		$resultop = mysql_query($sqlop) or die("Query opday failed");
   		$rowsop = mysql_fetch_array($resultop);
			$personid=$rowsop["idcard"];  //  PERSON_ID ใช้ตัวแปรนี้นำเข้าข้อมูล
			
				// DROPID
				//---------------------หารหัสและชื่อหมอ-------------------------//
				$doctor_name=$rowsop["doctor"]; 
				$sqldoc ="select doctorcode from doctor where  name like  '%$doctor_name%' ";   //  Query เอาข้อมูลจากตาราง doctor
				$resultdoc = mysql_query($sqldoc) or die("Query doctor failed");
				$numdoc = mysql_num_rows($resultdoc);
				$rowsdoc = mysql_fetch_array($resultdoc);
					if($numdoc > 0){
							$newdropid = $rowsdoc["doctorcode"];
					}else{			
						$sqlinp ="select codedoctor from inputm where  name like  '%$doctor_name%' ";   //  Query เอาข้อมูลจากตาราง inputm
						$resultinp = mysql_query($sqlinp) or die("Query inputm failed");
						$rowsinp = mysql_fetch_array($resultinp);	
							$newdropid = $rowsinp["codedoctor"];
					}			

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
			$lenvn=strlen($vn);
			if($lenvn=="1"){
				$newvn="00".$vn;
			}else if($lenvn=="2"){
				$newvn="0".$vn;
			}else if($lenvn=="3"){
				$newvn=$vn;
			}
			$newseq=$newdateopd.$newvn.$newrowid;  //  SEQ ใช้ตัวแปรนี้นำเข้าข้อมูล	
			
				
		$db6 = dbase_open($dbname6, 2);
		if ($db6) {
			  dbase_add_record($db6, array(
				  $hn6, 
				  $newdateopd, 
 				  $newclinic, 
				  $oper6,
				  $newdropid,
				  $personid, 
				  $newseq));     
					dbase_close($db6);
				}  //if db
		}  //while
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
		
			$db9 = dbase_open($dbname9, 2);
				if ($db9) {
					  dbase_add_record($db9, array(
						  $anipc,   
						  $diag9, 		
						  $dxtype, 	
						  $newdrdx));   
							dbase_close($db9);
						}  //if db			
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
						
//---------------End Dataset10---------------//


//---------------Start Dataset11---------------//
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
				
		$sql11 ="select *, sum(paidcscd) as sumprice from  opacc  where credit like '$newcredit%' and date like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%' and an =' ' group by hn";
		$result11 = mysql_query($sql11) or die("Query failed11");
		$num11 = mysql_num_rows($result11);	
		while($rows11 = mysql_fetch_array($result11)){
			$hn11=$rows11["hn"];  //  HN ใช้ตัวแปรนี้นำเข้าข้อมูล
			$an11=$rows11["an"]; //  AN ใช้ตัวแปรนี้นำเข้าข้อมูล				
			$sumprice=$rows11["sumprice"];  //  HN ใช้ตัวแปรนี้นำเข้าข้อมูล
			//DATE
			$date11=$rows11["date"];
			$datetimech=$date11;
			$datech = substr($datetimech,0,10);
			$datecht =explode("-",$datech);
			$newdatech=$datecht[0]-543;
			$newdatecht =$newdatech.$datecht[1].$datecht[2];  //  DATE ใช้ตัวแปรนี้นำเข้าข้อมูล		
				
			
//---------------------ใช้ข้อมูลจากตาราง opday---------------------//	
		$sqlop ="select * from opday where hn='".$hn11."' and thidate like '$datech%'";   //  Query เอาข้อมูลจากตาราง opday
		$resultop = mysql_query($sqlop) or die("Query opday failed");
   		$rowsop = mysql_fetch_array($resultop);
			//$hn=$rowsop["hn"]; 
			$personid=$rowsop["idcard"]; //  PERSON_ID ใช้ตัวแปรนี้นำเข้าข้อมูล	
			
			//SEQ
			$rowidop=$rowsop["row_id"];
			$newrowid = substr($rowidop,3,4);			
			
/*			$datetimeop=$rowsop["thidate"];
			$dateop = substr($datetimeop,0,10);
			$dateopday =explode("-",$dateop);
			$newdateopday=$dateopday[0]-543;
			$newdateopd =$newdateopday.$dateopday[1].$dateopday[2];	  */
			
			$vn=$rowsop["vn"];
			$lenvn=strlen($vn);
			if($lenvn=="1"){
				$newvn="00".$vn;
			}else if($lenvn=="2"){
				$newvn="0".$vn;
			}else if($lenvn=="3"){
				$newvn=$vn;
			}
			$newseq=$newdatecht.$newvn.$newrowid;  //  SEQ ใช้ตัวแปรนี้นำเข้าข้อมูล	
			
			$paid11="0";
			//$pttype11="10";
						
			$db11 = dbase_open($dbname11, 2);
			if ($db11) {
				  dbase_add_record($db11, array(
					  $hn11, 
					  $an11, 
					  $newdatecht, 
					  $sumprice,
					  $paid11,
					  $pttype11, 
					  $personid, 				  				  
					  $newseq));     
						dbase_close($db11);
					}  //if db
	}  // while				
//---------------End Dataset11---------------//


//---------------Start Dataset12---------------//
$dbname12 = "CHA".$yy.$mm.".dbf";
	$def12 = array(
	  array("HN","C",15),
	  array("AN","C",15),
	  array("DATE","D"),	  
	  array("CHRGITEM","C",2), 
	  array("AMOUNT","N",12,0),		  
 	  array("PERSON_ID","C",13),	 
	  array("SEQ","C",15)
	);
	
	// creation
	if (!dbase_create($dbname12, $def12)) {
	  echo "Error, can't create the database11\n";
	}	
	
	
	
		//--------------------------------- ค่าใช้จ่ายผู้ป่วยนอก	---------------------------------//	
		$sql12 ="select * from  opacc  where credit like '$newcredit%' and date like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%'  ";
		$result12 = mysql_query($sql12) or die("Query failed12");
		//echo $sql12;
		
   		while($rows12 = mysql_fetch_array($result12)){	
			$hnopacc=$rows12["hn"];  //  HN ใช้ตัวแปรนี้นำเข้าข้อมูล
			$anopacc=$rows12["an"]; //  AN ใช้ตัวแปรนี้นำเข้าข้อมูล
			$chrgitem =$rows12["depart"];
			
			
			
			
			
		
		if($chrgitem=="OTHER" || $chrgitem=="EMER" || $chrgitem=="WARD"){
			
			$sql121 ="select sum(paidcscd ) as sumcscd from  opacc  where credit like '$newcredit%' and date like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%'  and depart='OTHER' and an=' ' and  hn='$hnopacc' ";
			
		//	echo $sql121;
		$result121 = mysql_query($sql121) or die("Query failed121");
		list($paidcscd1) = Mysql_fetch_row($result121);
		
	
		
					$sql122 ="select sum(paidcscd) from  opacc  where credit like '$newcredit%' and date like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%' and depart='EMER' and  hn='$hnopacc' and an=' '";
					
					//echo $sql121;
		$result122 = mysql_query($sql122) or die("Query failed122");
		list($paidcscd2) = Mysql_fetch_row($result122);
		
							$sql123 ="select sum(paidcscd) from  opacc  where credit like '$newcredit%' and date like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%'  and depart='WARD' and  hn='$hnopacc' and an=' '";
							
							//echo $sql123;
		$result123 = mysql_query($sql123) or die("Query failed123");
		list($paidcscd3) = Mysql_fetch_row($result123);
			
		//	echo $paidcscd1;	echo $paidcscd2;	echo $paidcscd3 ;	
			
			$amountopacc=$paidcscd1+$paidcscd2+$paidcscd3;
			
			$date12=$rows12["txdate"];
			$datetimech=$date12;
			$datech = substr($datetimech,0,10);
			$datecha =explode("-",$datech);
			$newdatech=$datecha[0]-543;
			$newdatecha =$newdatech.$datecha[1].$datecha[2];  //  DATE ใช้ตัวแปรนี้นำเข้าข้อมูล
			
			$chrgitem12 ="C1";
			
			
			
			
		}
			
			elseif($chrgitem=="PHAR"){
				
				$sql123 ="select sum(paidcscd) from  opacc  where credit like '$newcredit%' and date like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%'  and depart='PHAR' and  hn='$hnopacc' and an=' '";
		$result123 = mysql_query($sql123) or die("Query failed123");
		list($amountopacc) = Mysql_fetch_row($result123);
				
				
				
				//$amountopacc=$rows12["paidcscd"];
			
			$date12=$rows12["txdate"];
			$datetimech=$date12;
			$datech = substr($datetimech,0,10);
			$datecha =explode("-",$datech);
			$newdatech=$datecha[0]-543;
			$newdatecha =$newdatech.$datecha[1].$datecha[2];  //  DATE ใช้ตัวแปรนี้นำเข้าข้อมูล
				$chrgitem12 ="41";
				
				
			}elseif($chrgitem=="PATHO"){
				
								$sql123 ="select sum(paidcscd) from  opacc  where credit like '$newcredit%' and date like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%'  and depart='PATHO' and  hn='$hnopacc' ";
		$result123 = mysql_query($sql123) or die("Query failed123");
		list($amountopacc) = Mysql_fetch_row($result123);
				
			
				//$amountopacc=$rows12["paidcscd"];
			
			$date12=$rows12["txdate"];
			$datetimech=$date12;
			$datech = substr($datetimech,0,10);
			$datecha =explode("-",$datech);
			$newdatech=$datecha[0]-543;
			$newdatecha =$newdatech.$datecha[1].$datecha[2];  //  DATE ใช้ตัวแปรนี้นำเข้าข้อมูล
				$chrgitem12 ="71";
				
				
			}elseif($chrgitem=="XRAY"){
				
					$sql123 ="select sum(paidcscd) from  opacc  where credit like '$newcredit%' and date like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%'  and depart='XRAY' and  hn='$hnopacc' and an=' '";
		$result123 = mysql_query($sql123) or die("Query failed123");
		list($amountopacc) = Mysql_fetch_row($result123);
				
				//$amountopacc=$rows12["paidcscd"];
			
			$date12=$rows12["txdate"];
			$datetimech=$date12;
			$datech = substr($datetimech,0,10);
			$datecha =explode("-",$datech);
			$newdatech=$datecha[0]-543;
			$newdatecha =$newdatech.$datecha[1].$datecha[2];  //  DATE ใช้ตัวแปรนี้นำเข้าข้อมูล
				$chrgitem12 ="81";
				
				
			}elseif( $chrgitem=="HEMO"){
				
					$sql123 ="select sum(paidcscd) from  opacc  where credit like '$newcredit%' and date like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%'  and depart='HEMO' and  hn='$hnopacc' and an=' '";
		$result123 = mysql_query($sql123) or die("Query failed123");
		list($amountopacc) = Mysql_fetch_row($result123);
			//	$amountopacc=$rows12["paidcscd"];
			
			$date12=$rows12["txdate"];
			$datetimech=$date12;
			$datech = substr($datetimech,0,10);
			$datecha =explode("-",$datech);
			$newdatech=$datecha[0]-543;
			$newdatecha =$newdatech.$datecha[1].$datecha[2];  //  DATE ใช้ตัวแปรนี้นำเข้าข้อมูล
				$chrgitem12 ="91";
				
			}elseif($chrgitem=="SURG"){
				
					$sql123 ="select sum(paidcscd) from  opacc  where credit like '$newcredit%' and date like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%'  and depart='SURG' and  hn='$hnopacc' and an=' '";
		$result123 = mysql_query($sql123) or die("Query failed123");
		list($amountopacc) = Mysql_fetch_row($result123);
				//$amountopacc=$rows12["paidcscd"];
			
			$date12=$rows12["txdate"];
			$datetimech=$date12;
			$datech = substr($datetimech,0,10);
			$datecha =explode("-",$datech);
			$newdatech=$datecha[0]-543;
			$newdatecha =$newdatech.$datecha[1].$datecha[2];  //  DATE ใช้ตัวแปรนี้นำเข้าข้อมูล
				$chrgitem12 ="B1";
			}elseif($chrgitem=="DENTA"){
				
					$sql123 ="select sum(paidcscd) from  opacc  where credit like '$newcredit%' and date like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%'  and depart='DENTA' and  hn='$hnopacc' and an=' '";
		$result123 = mysql_query($sql123) or die("Query failed123");
		list($amountopacc) = Mysql_fetch_row($result123);
				//$amountopacc=$rows12["paidcscd"];
			
			$date12=$rows12["txdate"];
			$datetimech=$date12;
			$datech = substr($datetimech,0,10);
			$datecha =explode("-",$datech);
			$newdatech=$datecha[0]-543;
			$newdatecha =$newdatech.$datecha[1].$datecha[2];  //  DATE ใช้ตัวแปรนี้นำเข้าข้อมูล
				$chrgitem12 ="D1";
			}elseif($chrgitem=="PHYSI"){ 
				$sql123 ="select sum(paidcscd) from  opacc  where credit like '$newcredit%' and date like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%'  and depart='PHYSI' and  hn='$hnopacc' ";
		$result123 = mysql_query($sql123) or die("Query failed123");
		list($amountopacc) = Mysql_fetch_row($result123);
		
		//	$amountopacc=$rows12["paidcscd"];
			
			$date12=$rows12["txdate"];
			$datetimech=$date12;
			$datech = substr($datetimech,0,10);
			$datecha =explode("-",$datech);
			$newdatech=$datecha[0]-543;
			$newdatecha =$newdatech.$datecha[1].$datecha[2];  //  DATE ใช้ตัวแปรนี้นำเข้าข้อมูล
				$chrgitem12 ="E1";
			}elseif($chrgitem=="NID"){
					$sql123 ="select sum(paidcscd) from  opacc  where credit like '$newcredit%' and date like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%'  and depart='NID' and  hn='$hnopacc'  ";
		$result123 = mysql_query($sql123) or die("Query failed123");
		list($amountopacc) = Mysql_fetch_row($result123);
		
			//	$amountopacc=$rows12["paidcscd"];
			
			$date12=$rows12["txdate"];
			$datetimech=$date12;
			$datech = substr($datetimech,0,10);
			$datecha =explode("-",$datech);
			$newdatech=$datecha[0]-543;
			$newdatecha =$newdatech.$datecha[1].$datecha[2];  //  DATE ใช้ตัวแปรนี้นำเข้าข้อมูล
				$chrgitem12 ="F1";
			}elseif($chrgitem=="EYE"){
				
					$sql123 ="select sum(paidcscd) from  opacc  where credit like '$newcredit%' and date like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%'  and depart='EYE' and  hn='$hnopacc' ";
					//echo $sql123;
		$result123 = mysql_query($sql123) or die("Query failed123");
		list($amountopacc) = Mysql_fetch_row($result123);
				$amountopacc=$amountopacc;
			
			$date12=$rows12["txdate"];
			$datetimech=$date12;
			$datech = substr($datetimech,0,10);
			$datecha =explode("-",$datech);
			$newdatech=$datecha[0]-543;
			$newdatecha =$newdatech.$datecha[1].$datecha[2];  //  DATE ใช้ตัวแปรนี้นำเข้าข้อมูล
				$chrgitem12 ="B1";
			}
	
			
		
				
			
				//---------------------ใช้ข้อมูลจากตาราง opday---------------------//	 	
				$sqlop ="select * from opday where hn ='".$hnopacc."' and thidate like '$datech%'";   //  Query เอาข้อมูลจากตาราง opday
				$resultop = mysql_query($sqlop) or die("Query opday failed");
				$rowsop = mysql_fetch_array($resultop);
					$personid=$rowsop["idcard"]; //  PERSON_ID ใช้ตัวแปรนี้นำเข้าข้อมูล	
		
					//SEQ
					$rowidop=$rowsop["row_id"];
					$newrowid = substr($rowidop,3,4);		
					
					$vn=$rowsop["vn"];
					$lenvn=strlen($vn);
					if($lenvn=="1"){
						$newvn="00".$vn;
					}else if($lenvn=="2"){
						$newvn="0".$vn;
					}else if($lenvn=="3"){
						$newvn=$vn;
					}
					$newseq=$newdatecha.$newvn.$newrowid;  //  SEQ ใช้ตัวแปรนี้นำเข้าข้อมูล		
			
					$db12 = dbase_open($dbname12, 2);
						if ($db12) {
							dbase_add_record($db12, array(
								$hnopacc, 
								$anopacc, 
								$newdatecha, 
								$chrgitem12,
								$amountopacc, 
								$personid, 				  				  
								$newseq));     
								dbase_close($db12);
							}  //if db		
				}  //while
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
	};
//---------------End Dataset13---------------//



//---------------Start Dataset14---------------//
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
	}	;

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
;
//---------------End Dataset15---------------//


//---------------Start Dataset16---------------//
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
	   array("TOTAL","N",12,2)	  //เพิ่มใหม่  
	);
	
	// creation
	if (!dbase_create($dbname16, $def16)) {
	  echo "Error, can't create the database16\n";
	}
	
		$sql161 ="select * from  drugrx  where date like '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']."%' and  (an is null or an = '')  group by hn";
		
		
		
		
		//echo $sql161;
		$result161 = mysql_query($sql161) or die("Query failed16");
		$num161= mysql_num_rows($result161);
   		while($rows161 = mysql_fetch_array($result161)){	
		$chkhn = $rows161["hn"];
		$chkdate = substr($rows161["date"],0,10);		
		
$newreason='';
		//$sql16 ="select *,sum(amount) as sumamount from  drugrx  where hn='$chkhn' and date like '$chkdate%'  and (an is null or an = '') and (part != 'DSY' or part != 'DSN' or part != 'DPN') and drugcode !='5VIAT ' group by drugcode";
		$sql16 ="select *,sum(amount) as sumamount from  drugrx  where hn='$chkhn' and date like '$chkdate%'  and (an is null or an = '') and (part != 'DSY' or part != 'DSN' or part != 'DPN') group by drugcode";
		//echo $sql16;
		
		$result16 = mysql_query($sql16) or die("Query failed16");
		$num16= mysql_num_rows($result16);
   		while($rows16 = mysql_fetch_array($result16)){	
			$hcode16 ="11512";
			$hn16=$rows16["hn"];  //  HN ใช้ตัวแปรนี้นำเข้าข้อมูล	
			$an16=$rows16["an"]; //  AN ใช้ตัวแปรนี้นำเข้าข้อมูล
			$drugcode16=$rows16["drugcode"];  //  DID ใช้ตัวแปรนี้นำเข้าข้อมูล
			$drugname16=$rows16["tradname"];  //  DIDNAME ใช้ตัวแปรนี้นำเข้าข้อมูล
			$amount16=$rows16["sumamount"];  //  AMOUNT ใช้ตัวแปรนี้นำเข้าข้อมูล
			$price=$rows16["price"]; 
			$amount=$rows16["amount"]; 
			$saleprice = $price/$amount;   //  DRUGPRICE(ราคาขาย) ใช้ตัวแปรนี้นำเข้าข้อมูล
			
			
			$datetimedrg=$rows16["date"];
			$datedrg = substr($datetimedrg,0,10);
			$datedrug =explode("-",$datedrg);
			$newdatedrug=$datedrug[0]-543;
			$newdateserv =$newdatedrug.$datedrug[1].$datedrug[2];  		  //  DATE_SERV ใช้ตัวแปรนี้นำเข้าข้อมูล						
			
			// ระบุรหัสเหตุผล EA, EB, EC, ED, EE, EF
			$reason16=$rows16["reason"]; 
			$reason=substr($reason16,0,1);
			$reasondefault ="00";
			

//---------------------ใช้ข้อมูลยาจากตาราง druglst---------------------//					
			$sqldrx= "SELECT * FROM  druglst WHERE drugcode ='".$drugcode16."' ";
			$resultdrx = mysql_query($sqldrx) or die("Query druglst failed");
			$rowsdrx=mysql_fetch_array($resultdrx);
				$code24=$rowsdrx["code24"];    //  DIDSTD ใช้ตัวแปรนี้นำเข้าข้อมูล
				//$saleprice=$rowsdrx["salepri"];    //  DRUGPRICE(ราคาขาย) ใช้ตัวแปรนี้นำเข้าข้อมูล
				$unitprice=$rowsdrx["unitpri"];    //  DRUGCOST(ราคาทุน) ใช้ตัวแปรนี้นำเข้าข้อมูล
				$unit=$rowsdrx["unit"];    //  DIDSTD ใช้ตัวแปรนี้นำเข้าข้อมูล
				$packing=$rowsdrx["packing"];    //  UNIT_PACK ใช้ตัวแปรนี้นำเข้าข้อมูล
						
	
				// หา drugtype=2 ระบุรหัสเหตุผล EA, EB, EC, ED, EE, EF, PA
				

//---------------------ใช้ข้อมูลการรับบริการจากตาราง opday---------------------//					
		$sqlop ="select * from opday where hn ='".$hn16."' and thidate like '$datedrg%'";   //  Query เอาข้อมูลจากตาราง opday
		$resultop = mysql_query($sqlop) or die("Query opday failed");
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
			$lenvn=strlen($vn);
			if($lenvn=="1"){
				$newvn="00".$vn;
			}else if($lenvn=="2"){
				$newvn="0".$vn;
			}else if($lenvn=="3"){
				$newvn=$vn;
			}
			$newseq=$newdateserv.$newvn.$newrowid;  //  SEQ ใช้ตัวแปรนี้นำเข้าข้อมูล		
			
									
			$newreason='';
			if(($reason =="A" || $reason =="B" || $reason =="C" || $reason =="D" || $reason =="E" || $reason =="F") && $reason !=" "){
			$newreason ="E".$reason;} else {$newreason =='';};
			
			
			$db16 = dbase_open($dbname16, 2);
				if ($db16) {
					dbase_add_record($db16, array(
						$hcode16, 
						$hn16, 
						$an16, 
						$newclinic,
						$personid, 
						$newdateserv,
						$drugcode16,  // drugcode
						$drugname16, 
						$amount16, 
						$saleprice,
						$unitprice, 
						$code24, 	
						$unit, 	
						$packing, 	
						$newseq, 	
						$newreason, 																																		  				  
						$pano,
						$totcopay,  //เพิ่มใหม่
						$use_status,
						$total  //เพิ่มใหม่
						));     
						dbase_close($db16);
					}  //if db		
			
	}  // while
}  // while
	//---------------End Dataset16---------------//
	
	
	

	$dbfname =$day."-".$mm."-".$newyear;
	$ZipName = "opd/$dbfname.zip";
	require_once("dZip.inc.php"); // include Class
	$zip = new dZip($ZipName); // New Class
	$zip->addFile($dbname1, $dbname1); // Source,Destination	
	$zip->addFile($dbname2, $dbname2); // Source,Destination	
	$zip->addFile($dbname3, $dbname3); // Source,Destination
	$zip->addFile($dbname4, $dbname4); // Source,Destination	
	$zip->addFile($dbname5, $dbname5); // Source,Destination	
	$zip->addFile($dbname6, $dbname6); // Source,Destination	
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
	
	echo "ดาวน์โหลดข้อมูล DBF ผู้ป่วยนอก... <a href=$ZipName>คลิกที่นี่</a>";	
}  // if check box ปิดสุดท้าย
?>