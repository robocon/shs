<?php
session_start();
include("connect.inc");

$date_now = date("Y-m-d H:i:s");

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}

$thaidate = (date("Y")+543).date("-m-d");



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style>
	.font_title{font-family:"Angsana New"; font-size:36px}
	.tb_font{font-family:"Angsana New"; font-size:24px;}
	.tb_font_1{font-family:"Angsana New"; font-size:24px; color:#FFFFFF; font-weight:bold;}
	.tb_col{font-family:"Angsana New"; font-size:24px; background-color:#9FFF9F}

.tb_font_2 {
	color: #B00000;
	font-weight: bold;
}
.style5 { font-weight: bold; }

.pdxhead {
	font-family: "TH SarabunPSK";
	font-size: 24px;
}
.pdxpro {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.pdx {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.stricker {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}
.stricker1 {
	font-family: "TH SarabunPSK";
	font-size: 14px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</style>
<script>
function togglediv1(divid){ 
	if(document.getElementById(divid).style.display == 'none'){ 
		document.getElementById(divid).style.display = 'block'; 
	}else{
		//sss
	}
}
function togglediv2(divid){ 
	if(document.getElementById(divid).style.display == 'block'){ 
		document.getElementById(divid).style.display = 'none'; 
	}else{
		//sss
	}
}
</script>
</head>

<body>
<a href ="../nindex.htm" >&lt;&lt; เมนู</a>
<center>
  <div class="font_title">ผลการตรวจเลือด (HB Profile)</div></center>

<form action="dx_ofyear_hb.php" method="post">
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="center" bgcolor="#0000CC" class="tb_font_1">กรอกหมายเลข HN</TD>
	</TR>
	<TR>
		<TD class="tb_font"><input type="text" name="p_hn"  value="<?php echo $_POST["p_hn"]?>"/><input type="submit" name="Submit1" value="ตกลง" /></TD>
</TR>
	<TR>
		<TD></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
<input name="post_vn" type="hidden" value="1" />
</form>

<?php 
if(isset($_POST['Submit1'])){
?>

<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<FORM METHOD=POST ACTION="dx_ofyear_save_hb.php">



<?

$sql1 = "select * from opcard where hn='".$_POST['p_hn']."' ";
$row1 = mysql_query($sql1);
$query1 = mysql_fetch_array($row1);

?>
<br />
<TABLE width="90%" border="1" cellpadding="0" cellspacing="0">
<TR>
	<td>
      <table>
    <tr>
      <td width="718" class="pdxpro">HN :
        <strong>
        <?=$query1['hn']?>
        </strong>       ชื่อ-สกุล : 
      <strong><?=$query1['yot']." ".$query1['name']." ".$query1['surname'];?></strong>
      <? $age1 = calcage($query1['dbirth']);?>
      อายุ <?=$age1?> เลขบัตรปชช : <?=$query1['idcard']?></td>
      <input name="age" type="hidden" value="<?=$age1?>"/>
      <input name="camp" type="hidden" value="<?=$query1['camp']?>"/>
      </tr>
      </table>
      </td></tr>
    </table>
<table width="857">
    <tr>
      <td class="pdxpro"><strong>ผลการตรวจเลือด (HB Profile)</strong></td>
      </tr>
    <tr>
      <td class="pdx">HbsAg :
        <select name="hb1" id="hb1">
          <option value="">- เลือก - </option>
          <option value="+VE">+VE</option>
          <option value="-VE">-VE</option>
      </select></td>
    </tr>
    <tr>
      <td class="pdx">HbsAb
        : 
        <select name="hb2" id="hb2">
          <option value="">- เลือก - </option>
          <option value="+VE">+VE</option>
          <option value="-VE">-VE</option>
      </select></td>
    </tr>
    <tr>
      <td class="pdx">HbcAb
        : 
        <select name="hb3" id="hb3">
          <option value="">- เลือก - </option>
          <option value="+VE">+VE</option>
          <option value="-VE">-VE</option>
      </select></td>
    </tr>
    <tr>
      <td class="pdx">Lead Level : 
        <input type="text" name="lead" id="lead" size="10" /></td>
    </tr>
    <tr>
      <td class="pdx"><input name="submit" type="submit" value=" ตกลง "  /></td>
    </tr>
    </table>
</td>
</TR>
</TABLE>
<BR>


<center>&nbsp;&nbsp;
<!--<input name="submit2" type="submit" value="ตกลง&amp;สติกเกอร์ OPD" />-->
</center>
<INPUT TYPE="hidden" value="<?php echo $query1['yot']." ".$query1['name']." ".$query1['surname'];?>" name="ptname" />
<input name="age" type="hidden" id="age"  value="<?php echo $age1;?>" />
<INPUT TYPE="hidden" value="<?php echo $query1['hn'];?>" name="hn" />
</FORM>
<?php
}elseif(isset($_GET['del'])){
	$sql3 = "delete from chk_hb where row_id='".$_GET['del']."' ";
	$result3= mysql_query($sql3);
	if($result3){
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=dx_ofyear_hb.php\">";
	}
}else{
	$sql2 = "select * from chk_hb where yearchk='2556' order by row_id asc";
	$rows2 = mysql_query($sql2);
	?>
<br /><br />
	<table width="80%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse; font-family: AngsanaUPC; font-size: 18px;">
    	<tr><td width="29" align="center" bgcolor="#FF9966">#</td><td width="86" align="center" bgcolor="#FF9966">HN</td><td width="146" align="center" bgcolor="#FF9966">ชื่อ-สกุล</td>
    	  <td width="62" align="center" bgcolor="#FF9966">HbsAg</td>
    	  <td width="62" align="center" bgcolor="#FF9966">HbsAb</td>
    	  <td width="62" align="center" bgcolor="#FF9966">HbcAb</td>
    	  <td width="62" align="center" bgcolor="#FF9966">LeadLevel</td>
    	  <td width="61" align="center" bgcolor="#FF9966">ลบ</td>
   	    </tr>
	<?
	while($result=mysql_fetch_array($rows2)){
		$i++;
	?>
    	<tr><td align="center"><?=$i?></td>
        <td><?=$result['hn']?></td>
        <td><?=$result['ptname']?></td>
    	<td><? if($result['hbsag']=="+VE"){?><font color="#FF0000"><? }?><?=$result['hbsag']?></td>
    	<td><? if($result['hbsab']=="+VE"){?><font color="#FF0000"><? }?><?=$result['hbsab']?></td>
    	<td><? if($result['hbcab']=="+VE"){?><font color="#FF0000"><? }?><?=$result['hbcab']?></td>
    	<td><?=$result['leadlevel']?></td>
    	<td width="61" align="center"><a href="dx_ofyear_hb.php?del=<?=$result['row_id']?>" onclick="return confirm('ยืนยันการลบ?')">ลบ</a></td>
   	    </tr>
	<?
	}
	?>
	</table>
	<?
}
include("unconnect.inc");
?>
</body>


</html>
