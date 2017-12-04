<?php
    include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<body>
<p><a target="_top"  href="../nindex.htm">กลับสู่เมนูหลัก</a></p>
<p align="center"><strong>รายงาน รพ.5 ประจำเดือน</strong></p>
<form name="form1" action="<? $_SERVER['PHP_SELF']?>" method="post">
<input name="act" type="hidden" value="search" />
<p style="margin-left: 480px;"><label>รหัสยา : </label>
<input name="drugcode" type="text" />
</p>
<p style="margin-left: 480px;"><label>เดือน : </label><span style="margin-left:10px">
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
 </select>
<?
$Y=date("Y")+543;
$date=date("Y")+543+5;
			  
$dates=range(2547,$date);
echo "<select name='year' class='forntsarabun'>";
foreach($dates as $i){
?>
	<option value='<?=$i-543; ?>' <? if($Y==$i){ echo "selected"; }?>>
	<?=$i;?>
	</option>
<?
}
echo "<select>";
?>
</span> 
 </p>
 <p style="margin-left:540px;"><input name="submit" type="submit" value="ตกลง" />
 </p>
</form>
<?
if($_POST["act"]=="search"){
	if(empty($_POST["drugcode"])){
		echo "<script>alert('ผิดพลาด กรุณาระบุรหัสยา');</script>";
	}else{
		$sql="select drugcode from druglst where drugcode='$_POST[drugcode]'";
		//echo $sql;
		$query=mysql_query($sql);
		$num=mysql_num_rows($query);
		if($num < 1){
			echo "<script>alert('ผิดพลาด รหัสยาไม่ถูกต้อง');</script>";
		}else{
			$drugcode=$_POST["drugcode"];
			$mount=$_POST['mon'];
			$year=$_POST['year'];
			$datedel="$year-$mount";
			$datechk="$year-$mount-01";
			$datestart="$year-$mount-01 00:00:00";
			$dateend="$year-$mount-31 23:59:59";
			
			$result=mysql_query("delete from drugrp5 where drugcode='$drugcode' and getdate like '$datedel%'");
			
			$sql1="select * from stktranx where drugcode='$drugcode' and getdate < '$datechk' ORDER BY getdate DESC Limit 1";
			$query1=mysql_query($sql1);
			$num1=mysql_num_rows($query1);
			$rows1=mysql_fetch_array($query1);
			if($num == 1){
				$detail="ยอดยกมา";
				$restprice=$rows1["unitpri"]*$rows1["netlotno"];
				$add1="insert into drugrp5 set getdate='$datechk',
																drugcode='$rows1[drugcode]',
																tradname='$rows1[tradname]',
																detail='$detail',
																rest_unitprice='$rows1[unitpri]',
																rest_num='$rows1[netlotno]',
																rest_price='$restprice'";
				if(mysql_query($add1)){  //บันทึกยอดยกมา
					/*echo "<script>alert('บันทึกข้อมูลเสร็จแล้ว');</script>";*/
					$lastid=mysql_insert_id();
					$sql2="select * from stktranx where drugcode='$drugcode' and (getdate between '$datestart' and '$dateend') order by getdate asc";
					//echo $sql2;
					$query2=mysql_query($sql2);
					$num2=mysql_num_rows($query2);
					if($num2 > 0){
						while($rows2=mysql_fetch_array($query2)){
						$result1 = "select stkno from combill where billno = '$rows2[billno]'";
						$row1 = mysql_query($result1);
						list($stkno)=mysql_fetch_array($row1);	
												
						if($rows2["stkcut"]==0){
						$sql3="select rest_num from drugrp5 where row_id='$lastid'";
						//echo $sql3;
						$query3=mysql_query($sql3);
						list($rest_num)=mysql_fetch_array($query3);
						
						$restnum=$rows2["amount"]+$rest_num;
						$drugprice=$rows2["unitpri"]*$rows2["amount"];
						$restprice=$rows2["unitpri"]*$restnum;
						$add2="insert into drugrp5 set getdate='$rows2[getdate]',
																		drugcode='$rows2[drugcode]',
																		tradname='$rows2[tradname]',
																		billno='$rows2[billno]',
																		detail='$rows2[department]',
																		stkno='$stkno',
																		drug_unitprice='$rows2[unitpri]',
																		drug_num='$rows2[amount]',
																		drug_price='$drugprice',
																		rest_unitprice='$rows2[unitpri]',
																		rest_num='$restnum',
																		rest_price='$restprice'";		
							mysql_query($add2);  //บันทึกรับยา	
							$lastid=mysql_insert_id();																
						}else{
						$lastid=mysql_insert_id();
						$sql3="select rest_num from drugrp5 where row_id='$lastid'";
						//echo $sql3;
						$query3=mysql_query($sql3);
						list($rest_num)=mysql_fetch_array($query3);
						
						$restnum=$rest_num-$rows2["stkcut"];				
						$payprice=$rows2["unitpri"]*$rows2["stkcut"];
						$restprice=$rows2["unitpri"]*$restnum;
						$add2="insert into drugrp5 set getdate='$rows2[getdate]',
																		drugcode='$rows2[drugcode]',
																		tradname='$rows2[tradname]',
																		billno='$rows2[billno]',
																		detail='$rows2[department]',
																		stkno='$stkno',
																		pay_unitprice='$rows2[unitpri]',
																		pay_num='$rows2[stkcut]',
																		pay_price='$payprice',
																		rest_unitprice='$rows2[unitpri]',
																		rest_num='$restnum',
																		rest_price='$restprice'";
							mysql_query($add2);  //บันทึกจ่ายยา	
							$lastid=mysql_insert_id();			
						}																		
						}  //close while				
					}  //close if num
				}															
			}
		}
	}
}
?>
</body>

</html>
