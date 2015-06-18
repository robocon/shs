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
<strong>ส่งออกข้อมูล DBF แฟ้มที่ 14 (ADP)</strong>
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

//---------------Start Dataset14---------------//
$dbname14 = "ADP".$yy.$mm.".dbf";
	$def14 = array(
	  array("HN","C",15),
	  array("AN","C",15),
	  array("DATEOPD","D"),	  
	  array("TYPE","C",2), 
	  array("CODE","C",11),	 
	  array("QTY","N",3,0),
	  array("RATE","N",7, 0),
	  array("SEQ","C",15),
	  array("CAGCODE","C",10),
	  array("DOSE","C",10),
	  array("CA_TYPE","C",1)
	);
	
	// creation
	if (!dbase_create($dbname14, $def14)) {
	  echo "Error, can't create the database14\n";
	}
	





//--------------------------------- ค่าใช้จ่ายผู้ป่วยใน	---------------------------------//	
$dbsql ="select * from  ipcard  where dcdate between '".$_POST['year']."-".$_POST['mon']."-"."01"." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-"."31"." 23:59:59'";
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




						
		$sqlip ="select * from  ipacc  where an='".$an14."' and part='BFY' group by code ";  // เอาข้อมูลมาตามเงื่อนไข โดยไม่สนวันที่
		//echo $sqlip."</br>";
		$resultip = mysql_query($sqlip) or die("Query ipcard failed14");
		$numip = mysql_num_rows($resultip);
		//echo "$numip </br>";
		while($rowsip = mysql_fetch_array($resultip)){			
			$part =$rowsip["part"];
			
			if($part=="BFY"){
						$sqldf ="select *, sum(amount) as dfamount from  ipacc  where an='".$an14."' && price <=300  && part='$part'";
						$resultdf = mysql_query($sqldf) or die("Query ipacc failed");
						$numdf = mysql_num_rows($resultdf);			
						while($rowsdf = mysql_fetch_array($resultdf)){
						$an300=$rowsdf["an"];
						//SEQ	
						$rowidop=$rowsdf["row_id"];
						$newrowid = substr($rowidop,3,4);	
						$newseq=$newdcdate.$newvn.$newrowid;  //  SEQ ใช้ตัวแปรนี้นำเข้าข้อมูล									
						$qty = $rowsdf["dfamount"];	
						$price = $rowsdf["price"];
						$chrgitemip ="10";
						$code = "21101";		
										
	
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
									$catype));     
									dbase_close($db14);
								}  //if db			
							}  // if num				
						}  // while



					
						$sqldf1 ="select *,sum(amount) as dfamount1 from  ipacc  where an='".$an14."' && price >=600 && part='$part' ";
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
									$catype));     
									dbase_close($db14);
								}  //if db		
							}  // if num					
						}  // while	
					} // if part			
			}  //while
			
			
		
			
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
						if($code14 =="SURG"){
							$sqldrx= "SELECT distinct(detail) FROM  ipacc WHERE an='".$an14."' and code ='".$code14."' ";
							$resultdrx = mysql_query($sqldrx) or die("Query ipacc failed");
							$rowsdrx=mysql_fetch_array($resultdrx);
							$code = substr($rowsdrx["detail"],0,4);
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
									$catype));     
									dbase_close($db14);
								}  //if db		
							} // if check an					
						}  // while
					} // if part			
			}  //while				
			
			
		
		
			
			
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
						$qty = $rowsds["amount"];	
						$rate =$rowsds["dsprice"];
						$chrgitemip ="11";
						$code ="XXXXXX";
												
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
									$catype));     
									dbase_close($db14);
								}  //if db			
							}   //if check an				
						}  // while
					} // if part			
			}  //while						
					
}  //while

//---------------End Dataset14---------------//

}  // if check box ปิดสุดท้าย
?>