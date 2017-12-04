<?php
    include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.inputtext {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style></head>

<body>
<p align="center"><strong>กรุณาเลือกรหัสยาและปีที่ต้องการตั้งต้นข้อมูล</strong></p>
<form name="form1" action="<? $_SERVER['PHP_SELF']?>" method="post">
<input name="act" type="hidden" value="search" />
<p style="margin-left: 510px;"><label>รหัสยา : </label>
<input name="drugcode" type="text" class="inputtext" />
</p>
<p style="margin-left: 510px;">
  <label>ปี พ.ศ. : </label>
<?
$Y=date("Y")+543;
$date=date("Y")+543+5;
			  
$dates=range(2547,$date);
echo "<select name='year' class='inputtext'>";
foreach($dates as $i){
?>
	<option value='<?=$i-543; ?>' <? if($Y==$i){ echo "selected"; }?>>
	<?=$i;?>
	</option>
<?
}
echo "<select>";
?> 
 </p>
 <p style="margin-left:560px;"><input name="submit" type="submit" class="inputtext" value="ค้นหา" />
 </p>
</form>
<?
if($_POST["act"]=="search"){
			$drugcode=$_POST["drugcode"];
			$mount=$_POST['mon'];
			$year=$_POST['year'];
			
			$datechk=$year-1;
			$datestart="$year-01-01";
			$dateend="$year-12-31";
	if(empty($drugcode)){
		echo "<script>alert('ผิดพลาด กรุณาระบุรหัสยา');</script>";
	}else{
		$sql="select * from stktranx where drugcode='$_POST[drugcode]' and getdate like '$datechk%' order by getdate desc limit 1";
		//echo $sql;
		$query=mysql_query($sql);
		$num=mysql_num_rows($query);
			$rows=mysql_fetch_array($query);
			$showyear=$year+543;
			$getdateshow="01/01/$showyear";
			$price=$rows["unitpri"]*$rows["mainstk"];
?>
<hr />
<form action="rphos5dg_addstartdata.php" method="post" name="form1">
<input name="act" type="hidden" value="add" />
<input name="detail" type="hidden" value="ยอดยกมา" />
<input name="getdate" type="hidden" value="<?=$datestart;?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td align="right"><strong>วัน/เดือน/ปี : </strong></td>
    <td>&nbsp;</td>
    <td><?=$rows["getdate"];?></td>
  </tr>
  <tr>
    <td align="right"><strong>รหัสยา :</strong></td>
    <td>&nbsp;</td>
    <td><label>
      <input name="drugcode" type="text" class="inputtext" id="drugcode" value="<?=$rows["drugcode"];?>" />
    </label></td>
  </tr>
  <tr>
    <td width="42%" align="right"><strong>ชื่อยา : </strong></td>
    <td width="1%">&nbsp;</td>
    <td width="57%"><label>
      <input name="tradname" type="text" class="inputtext" id="tradname" value="<?=$rows["tradname"];?>" size="40"  />
    </label></td>
  </tr>
  <tr>
    <td align="right"><strong>ราคา/หน่วย : </strong></td>
    <td>&nbsp;</td>
    <td><label>
      <input name="unitprice" type="text" class="inputtext" id="unitprice" value="<?=$rows["unitpri"];?>"  />
    </label></td>
  </tr>
  <tr>
    <td align="right"><strong>จำนวน : </strong></td>
    <td>&nbsp;</td>
    <td><label>
      <input name="num" type="text" class="inputtext" id="num" value="<?=$rows["mainstk"];?>"  />
    </label></td>
  </tr>
  <tr>
    <td align="right"><strong>ราคารวม :</strong></td>
    <td>&nbsp;</td>
    <td><label>
      <input name="price" type="text" class="inputtext" id="price" value="<?=$price;?>"  />
    </label></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td><label>
      <input name="button" type="submit" class="inputtext" id="button" value="ตั้งต้นข้อมูล" />
    </label></td>
  </tr>
</table>
</form>
<?
	}
}
?>
<?
if($_POST["act"]=="add"){
$getdate=$_POST["getdate"];
$drugcode=$_POST["drugcode"];
$sql1="select row_id from drugstartrp5 where drugcode='$drugcode' and getdate = '$getdate'";
//echo $sql1;
$query1=mysql_query($sql1);
$num1=mysql_num_rows($query1);
	if($num1 < 1){
		$add="insert into drugstartrp5 set getdate='$_POST[getdate]',
															 drugcode='$_POST[drugcode]',
															 tradname='$_POST[tradname]',
															 detail='$_POST[detail]',
															 rest_unitprice='$_POST[unitprice]',
															 rest_num='$_POST[num]',
															 rest_price='$_POST[price]'";
		if(mysql_query($add)){ 
			echo "<script>alert('ตั้งต้นข้อมูลรหัสยา : $drugcode เสร็จแล้ว');window.location='rphos5dg_datayear.php';</script>";
		}
	}else{
	list($rowid)=mysql_fetch_array($query1);
		$edit="update drugstartrp5 set getdate='$_POST[getdate]',
															 drugcode='$_POST[drugcode]',
															 tradname='$_POST[tradname]',
															 detail='$_POST[detail]',
															 rest_unitprice='$_POST[unitprice]',
															 rest_num='$_POST[num]',
															 rest_price='$_POST[price]' where row_id='$rowid'";
		if(mysql_query($edit)){ 
			echo "<script>alert('ปรับปรุงการตั้งต้นข้อมูลรหัสยา : $drugcode เสร็จแล้ว');window.location='rphos5dg_datayear.php';</script>";
		}		
	}
}
?>
</body>
</html>
