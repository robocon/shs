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
<strong>ส่งออกข้อมูล DBF แฟ้มที่ 11 (CHT)</strong>
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

//---------------Start Dataset11---------------//
$dbname11 = "CHT".$yy.$mm.".dbf";
	$def11 = array(
	  array("HN","C",15),
	  array("AN","C",9),
	  array("DATE","D"),	  
	  array("TOTAL","N",7,0),	  
	  array("PAID","N",7,0),	
	  array("PTTYPE","C",2),	  
 	  array("PERSON_ID","C",13),	 
	  array("SEQ","C",15)
	);
	
	// creation
	if (!dbase_create($dbname11, $def11)) {
	  echo "Error, can't create the database11\n";
	}		
				
		$sql11 ="select *, sum(price) as sumprice from  opacc  where (date between '".$_POST['year']."-".$_POST['mon']."-"."01"." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-"."31"." 23:59:59') and an =' ' group by hn";
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

}  // if check box ปิดสุดท้าย
?>