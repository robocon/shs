<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.font1 {
	font-family: AngsanaUPC;
	font-size: 18px;
}
.font2 {
	font-size: 24px;
}
-->
</style>
</head>

<body class="font1">
<?
include("connect.inc");
?>
<form id="form1" name="form1" method="post" action="">
  <table width="55%" border="0">
  <tr>
    <td height="34" align="center"><span class="font2">คลินิกฟ้าใส</span></td>
  </tr>
  <tr>
    <td height="34" align="center">เดือน <select name="mon">
    	<option value="01" <? if(date("m")=="01") echo "selected";?>>มกราคม</option>
        <option value="02" <? if(date("m")=="02") echo "selected";?>>กุมภาพันธ์</option>
        <option value="03" <? if(date("m")=="03") echo "selected";?>>มีนาคม</option>
        <option value="04" <? if(date("m")=="04") echo "selected";?>>เมษายน</option>
        <option value="05" <? if(date("m")=="05") echo "selected";?>>พฤษภาคม</option>
        <option value="06" <? if(date("m")=="06") echo "selected";?>>มิถุนายน</option>
        <option value="07" <? if(date("m")=="07") echo "selected";?>>กรกฎาคม</option>
        <option value="08" <? if(date("m")=="08") echo "selected";?>>สิงหาคม</option>
        <option value="09" <? if(date("m")=="09") echo "selected";?>>กันยายน</option>
        <option value="10" <? if(date("m")=="10") echo "selected";?>>ตุลาคม</option>
        <option value="11" <? if(date("m")=="11") echo "selected";?>>พฤศจิกายน</option>
        <option value="12" <? if(date("m")=="12") echo "selected";?>>ธันวาคม</option>
    </select>
   ปี <select name="yr">
    <?
    for($i=(date("Y")+543)-5;$i<=(date("Y")+543)+5;$i++){
	?>
    	<option value="<?=$i?>" <? if((date("Y")+543)==$i) echo "selected";?>><?=$i?></option>
    <?
	}
	?>
    </select>
    </td>
  </tr>
  <tr>
    <td height="48" align="center">
      <input type="submit" name="button" id="button" value=" ค้นหา " />
</td>
  </tr>
</table>
</form>
<?
if(isset($_POST['button'])){
?>
<table width="60%" border="1" cellpadding="0" cellspacing="0">
<tr><td width="7%" align="center">#</td><td width="24%" align="center">วันที่ลงทะเบียน</td><td width="20%" align="center">HN</td><td width="49%" align="center">ชื่อ-สกุล</td></tr>
<?
	$sql = "select * from opd where cigok = '1' and thidate like '%".$_POST['yr']."-".$_POST['mon']."%' ";
	//echo $sql;
	$row = mysql_query($sql);
	while($result = mysql_fetch_array($row)){
		$k++;
		?>
		<tr><td align="center"><?=$k?></td><td align="center"><?=substr($result['thdatehn'],0,10)?></td><td><?=$result['hn']?></td><td><?=$result['ptname']?></td></tr>
		<?
	}
}
?>
</table>
</body>
</html>