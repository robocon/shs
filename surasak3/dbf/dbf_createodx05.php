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
<strong>ส่งออกข้อมูล DBF</strong>
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
		$sql5 ="select * from diag  where (svdate between '".$_POST['year']."-".$_POST['mon']."-"."01"." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-"."31"." 23:59:59')";
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
			$dxtype ="4";
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
			
/*			$datetimeop=$rowsop["thidate"];
			$dateop = substr($datetimeop,0,10);
			$dateopday =explode("-",$dateop);
			$newdateopday=$dateopday[0]-543;
			$newdateopd =$newdateopday.$dateopday[1].$dateopday[2];	*/		
			
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

}  // if check box ปิดสุดท้าย
?>