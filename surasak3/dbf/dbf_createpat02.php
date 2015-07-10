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
<strong>ส่งออกข้อมูล DBF แฟ้มที่ 02 (PAT)</strong></font></span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../../nindex.htm"><< ไปเมนู</a>

<span class="font1">
<font face="Angsana New">
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
  <table width="302" border="0">
    <tr>
      <td width="26">เดือน :</td>
      <td width="94"> 
     <select name="mon">
           <option value="01" selected="selected">มกราคม</option>
           <option value="02">กุมภาพันธ์</option>
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

		$sqlop2 ="select hn, txdate from  opacc  where credit like '$newcredit%' and (date between '".$_POST['year']."-".$_POST['mon']."-"."01"." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-"."31"." 23:59:59') group by substring(date,1,10), hn";
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
		} ; //while
//--------------------End DataSet2-------------------------//

}  // if check box ปิดสุดท้าย
?>