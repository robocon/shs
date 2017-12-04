<?
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.font1 {	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.font1 {
	font-family: AngsanaUPC;
}
-->
</style>
</head>

<body>

<?
if(!isset($_POST['search'])){
?>
<a target=_self  href='../nindex.htm' class='forntsarabun'><------ ไปเมนู</a>
<form action="<? $_SERVER['PHP_SELF']?>" name="f1" method="post" target="_blank">
<table width="291">
	<tr><td align="center" class="font1">รายงานประจำเดือน</td>
	</tr>
    <tr>
      <td align="center" class="font1">เดือน
          <select name="m">
            <?
	$month = array('0','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
	for($a=1;$a<13;$a++){
		if($a<10) $ss = "0";
		else $ss='';
	?>
            <option value="<?=$ss?><?=$a?>" <? if($m==$a) echo "selected='selected'"?>>
              <?=$month[$a]?>
            </option>
            <?
	}
	?>
          </select>
      ปี
          <select name="yr">
            <?
	$year = date("Y")+543;
	for($a=($year-5);$a<($year+5);$a++){
	?>
            <option value="<?=$ss?><?=$a?>" <? if($year==$a) echo "selected='selected'"?>>
            <?=$a?>
            </option>
            <?
	}
	?>
          </select>
      </td>
    </tr>
      <tr>
  <td align="center" class="font1">
    <input name="search" type="submit" value="  ตกลง  "/>
  </td>
</tr> 
</table>

</form>
<?
}
if(isset($_POST['search'])){
	$month = array('0','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
	$sql = "select * from com_support where dateend like '".$_POST['yr']."-".$_POST['m']."%' and dateend != '0000-00-00 00:00:00'";
	$row = mysql_query($sql);
?>
<center>
  <span class="font1">รายงานประจำเดือน 
  <?=$month[$_POST['m']+0]?> ปี <?=$_POST['yr']?>
  </span>
</center>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse; font-size: 14px;">
<tr><td width="3%" align="center" valign="top" class="font1">ลำดับ</td>
  <td width="7%" align="center" valign="top" class="font1">วันที่</td>
  <td width="7%" align="center" valign="top" class="font1">แผนก</td>
  <td width="10%" align="center" valign="top" class="font1">ผู้ร้องขอ</td>
  <td width="10%" align="center" valign="top" class="font1">หัวข้อ</td>
  <td width="28%" align="center" valign="top" class="font1">รายละเอียด</td>
  <td width="20%" align="center" valign="top" class="font1">ผลการดำเนินการ</td>
  <td width="6%" align="center" valign="top" class="font1">ผู้รับผิดชอบ</td>
  <td width="7%" align="center" valign="top" class="font1">วันเวลาที่ดำเนินการ</td>
</tr>
<?
	while($result = mysql_fetch_array($row)){
		$i++;
?>
		<tr><td align="center" valign="top" class="font1">
	    <?=$i?>
		</td>
		  <td valign="top" class="font1">
	      <?=$result['date']?>
		  </td>
		  <td valign="top" class="font1">
	      <?=$result['depart']?>
		  </td>
		  <td valign="top" class="font1">
	      <?=$result['user']?>
		  </td>
		  <td valign="top" class="font1">
	      <?=$result['head']?>
		  </td>
		  <td valign="top" class="font1">
	      <?=nl2br($result['detail'])?>
		  </td>
		  <td valign="top" class="font1">
	      <?=$result['p_edit']?>
		  </td>
		  <td valign="top" class="font1">
	      <?=$result['programmer']?>
		  </td>
		  <td valign="top" class="font1">
	      <?=$result['dateend']?>
		  </td>
		</tr>
<?
	}
?>

</table>
<?
}
?>
</body>
</html>