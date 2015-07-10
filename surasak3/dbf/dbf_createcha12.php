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
.style1 {
font-family: AngsanaUPC;
font-size: 14px;
}
.style2 {
	font-family: AngsanaUPC;
	font-size: 14px;
}
</style>
<div id="no_print" >
<span class="font1">
<font face="Angsana New" size="+2">
<strong>ส่งออกข้อมูล DBF แฟ้มที่ 12 (CHA)</strong>
</font>
</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../../nindex.htm"><< ไปเมนู</a>
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
<span class="font1">
<font face="Angsana New">
เดือน 
</font>
</span>
 <select name="mon">
   <option value="01">มกราคม</option>
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
 </select>
<span class="font1">
<font face="Angsana New">
</font>
</span>
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
?>
<input name="BOK" value="ตกลง" type="submit" />
  </span>
</form>
</div>

<?
if(isset($_POST['BOK'])){

$year = $_POST['year'];
$newyear = $year-543;
$yy = substr($newyear,2,2);
$mm =$_POST['mon'];

//---------------Start Dataset12---------------//
$dbname12 = "CHA".$yy.$mm.".dbf";
	$def12 = array(
	  array("HN","C",15),
	  array("AN","C",15),
	  array("DATE","D"),	  
	  array("CHRGITEM","C",2), 
	  array("AMOUNT","N",7,0),		  
 	  array("PERSON_ID","C",13),	 
	  array("SEQ","C",15)
	);
	
	// creation
	if (!dbase_create($dbname12, $def12)) {
	  echo "Error, can't create the database11\n";
	}	
	
	
	
		//--------------------------------- ค่าใช้จ่ายผู้ป่วยนอก	---------------------------------//	
		$sql12 ="select * from  opacc  where (date between '".$_POST['year']."-".$_POST['mon']."-"."01"." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-"."31"." 23:59:59') and an=' '";
		$result12 = mysql_query($sql12) or die("Query failed12");
   		while($rows12 = mysql_fetch_array($result12)){	
			$hnopacc=$rows12["hn"];  //  HN ใช้ตัวแปรนี้นำเข้าข้อมูล
			$anopacc=$rows12["an"]; //  AN ใช้ตัวแปรนี้นำเข้าข้อมูล
			$chrgitem =$rows12["depart"];
			if($chrgitem=="PHAR"){
				$chrgitem12 ="41";
			}elseif($chrgitem=="PATHO"){
				$chrgitem12 ="71";
			}elseif($chrgitem=="XRAY"){
				$chrgitem12 ="81";
			}elseif($chrgitem=="OTHER" || $chrgitem=="HEMO"){
				$chrgitem12 ="91";
			}elseif($chrgitem=="SURG"){
				$chrgitem12 ="B1";
			}elseif($chrgitem=="EMER" || $chrgitem=="WARD"){
				$chrgitem12 ="C1";
			}elseif($chrgitem=="DENTA"){
				$chrgitem12 ="D1";
			}elseif($chrgitem=="PHYSI"){
				$chrgitem12 ="E1";
			}elseif($chrgitem=="NID"){
				$chrgitem12 ="E1";
			}

			$amountopacc=$rows12["price"];
			
			$date12=$rows12["txdate"];
			$datetimech=$date12;
			$datech = substr($datetimech,0,10);
			$datecha =explode("-",$datech);
			$newdatech=$datecha[0]-543;
			$newdatecha =$newdatech.$datecha[1].$datecha[2];  //  DATE ใช้ตัวแปรนี้นำเข้าข้อมูล
			
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

}  // if check box ปิดสุดท้าย
?>