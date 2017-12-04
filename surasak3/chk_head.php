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
<form id="form1" name="form1" method="post" action="chk_head.php">
<table width="34%" border="0" align="center">
  <tr>
    <td align="center">เช็คผลการตรวจ LAB</td>
  </tr>
  <tr>
    <td align="center">
          HN :  <input type="text" name="hn_lab" id="hn_lab" />
    </td>
    </tr>
  <tr>
    <td align="center"><label>
      <input type="submit" name="button" id="button" value="ตกลง" />
    </label></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
</table>
</form>
<?
if(isset($_POST['hn_lab'])&isset($_POST['button'])){
	$query = "select * from resulthead where hn='".$_POST['hn_lab']."' order by autonumber asc";
	$aa = mysql_query($query);
	$result = mysql_fetch_array($aa);
	?>
<form id="form2" name="form2" method="post" action="chk_head.php">
	<table>
    <tr>
    <td width="116">HN : <?=$result['hn']?></td>
    <input name="hn1" type="hidden" value="<?=$result['hn']?>" />
    <td colspan="3">ชื่อ :
      <?=$result['patientname']?></td>
    <td width="159">&nbsp;</td>
    </tr>
    </table>
    <table border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
    <tr>
    <td align="center">Autonumber</td><td width="190" align="center">Orderdate</td><td width="115" align="center">LAB number</td><td width="97" align="center">Profilecode</td><td align="center">Clinicinfo</td>
    </tr>
    <?
	$i=0;
    $aa = mysql_query($query);
    while($result = mysql_fetch_array($aa)){
		$i++;
	?>
    <tr>
      <td align="center"><?=$result['autonumber']?></td>
      <td align="center"><?=$result['orderdate']?></td>
      <td align="center"><?=$result['labnumber']?></td>
      <td align="center"><?=$result['profilecode']?></td>
      <td><select name="clinic<?=$i?>"><option value="<?=$result['clinicalinfo']?>"><?=$result['clinicalinfo']?></option>
      <option value="ตรวจสุขภาพประจำปี55">ตรวจสุขภาพประจำปี55</option></select></td>
    </tr>
	<?
	}  
	?>
    <tr>
      <td colspan="5" align="center">
        <input type="submit" name="change" id="change" value="ตกลง" /></td>
      </tr>
    </table>
</form>
    <?
}
elseif(isset($_POST['change'])&isset($_POST['hn1'])){
	$query1 = "select * from resulthead where hn='".$_POST['hn1']."' order by autonumber asc";
	$aa1 = mysql_query($query1);
	$a=0;
	while($result1 = mysql_fetch_array($aa1)){
		$a++;
		$update1 = "update resulthead SET clinicalinfo = '".$_POST['clinic'.$a]."' where autonumber = '".$result1['autonumber']."'";
		//$row1 = mysql_query($update1);
		echo $update1;
	}
}
?>
</body>
</html>