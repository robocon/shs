<?php
 session_start();
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>บันทึกข้อมูลวันหยุดประจำปี</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
<script language="javascript">
////// เช็คค่าว่าง
function fncSubmit()
{
	
	var fn = document.f1;
	if(fn.detail.value=="")
	{
		alert('กรุณากรอกข้อมูลวันหยุด');
		fn.detail.focus();
		return false;
	}
	fn.submit();
}

</script>
</head>
<?
if($_POST["act"]=="add"){
$d_start=$_POST["d_start"];
$m_start=$_POST["m_start"];
$y_start=$_POST["y_start"];
$newdate="$y_start-$m_start-$d_start";
$detail=$_POST["detail"];
$datetime=date("Y-m-d H:i:s");


	$add="insert into holiday set date_holiday='$newdate', detail='$detail', userkey='$sOfficer', datekey='$datetime'";
	//echo $add;
	if(mysql_query($add)){
		echo "<script>alert('บันทึกข้อมูลเรียบร้อย');</script>";
	}else{
		echo "<script>alert('ผิดพลาด บันทึกข้อมูลไม่สำเร็จ');</script>";
	}
}
?>
<body>
<form method="POST" action="holiday_add.php" name="f1" id="f1">
<input name="act" type="hidden" value="add" />
<table width="60%" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#66CC99">
  <tr>
    <td colspan="3" align="center" bgcolor="#66CC99"><strong>บันทึกข้อมูลวันหยุดประจำปี</strong><br />
     <a  class="forntsarabun" target="_top" href="../nindex.htm">&lt;&lt; กลับเมนูหลัก &gt;&gt;</a>
    </td>
    </tr>
  <tr>
    <td width="39%" align="right" bgcolor="#CCFFCC"><strong>วัน/เดือน/ปี</strong></td>
    <td width="2%" align="center" bgcolor="#CCFFCC"><strong>:</strong></td>
    <td width="59%" bgcolor="#CCFFCC"><label>          
      <select name="d_start" class="forntsarabun" id="d_start">
      <?
	  $date1=date("d");
	  for($i=0;$i<=31;$i++){
	  $date=sprintf("%02d",$i);
	  ?>
      <option value="<?=$date?>" <? if($date==$date1){ echo "selected"; }?>><?=$date?></option>
      <?
	  }
	  ?>
      </select>
      <? $m=date('m'); ?>
          <select name="m_start" class="forntsarabun">
            <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
            <option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
            <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
            <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
            <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
            <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
            <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
            <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
            <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
            <option value="10" <? if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
            <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
            <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
          </select>
<? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){
				?>
          
          <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
          <?
				}
				echo "<select>";
				?>          
      </label></td>
  </tr>
  <tr>
    <td align="right" valign="top" bgcolor="#CCFFCC"><strong>วันหยุด</strong></td>
    <td align="center" valign="top" bgcolor="#CCFFCC"><strong>:</strong></td>
    <td valign="top" bgcolor="#CCFFCC"><label>
      <textarea name="detail" cols="45" rows="5" class="forntsarabun" id="detail"></textarea>
    </label></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99"><label>
      <input name="button" type="submit" class="forntsarabun" id="button" value="บันทึกข้อมูล" onClick="JavaScript:return fncSubmit()" />
    </label></td>
  </tr>
</table>
</form>
<p>
<hr />
</p>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="20%" height="30" align="center" bgcolor="#66CC99"><strong>วัน/เดือน/ปี</strong></td>
    <td width="53%" height="30" align="center" bgcolor="#66CC99"><strong>วันหยุดประจำปี</strong></td>
    <td width="27%" align="center" bgcolor="#66CC99"><strong>เพิ่มข้อมูลโดย</strong></td>
  </tr>
<?
$sql="select * from holiday order by date_holiday desc limit 0,43";
$query=mysql_query($sql);
while($rows=mysql_fetch_array($query)){
?>  
  <tr>
    <td height="30" align="center"><?=$rows["date_holiday"];?></td>
    <td height="30"><?=$rows["detail"];?></td>
    <td><? if(!empty($rows["userkey"])){ echo $rows["userkey"];}else{ echo "ผู้ดูแลระบบ";}?></td>
  </tr>
<?
}
?>  
</table>

</body>
</html>
