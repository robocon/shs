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
  <div class="font_title">ผลการตรวจสุขภาพช่องปาก</div></center>

<form action="dx_ofyear_mouth.php" method="post">
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
<FORM METHOD=POST ACTION="dx_ofyear_save_mouth.php">



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
      <td class="pdxpro"><strong>ผลการตรวจสุขภาพช่องปาก</strong></td>
      </tr>
    <tr>
      <td class="pdx"><table width="459">
        <tr>
          <td width="74" align="center" valign="top"><input type="checkbox" name="mouth1" value="ฟันผุ" /></td>
          <td width="88" valign="top">ฟันผุ</td>
          <td width="281" valign="top"><strong>คำแนะนำ</strong><br />
            <input type="checkbox" name="advice1" value="ถอนฟัน" />
            ถอนฟัน
            <br />
            <input type="checkbox" name="advice2" value="อุดฟัน" />
            อุดฟัน</td>
          </tr>
        <tr>
          <td align="center" valign="top"><input type="checkbox" name="mouth2" value="ฟันสึก" /></td>
          <td valign="top">ฟันสึก</td>
          <td valign="top"><strong>คำแนะนำ</strong><br />
            <input type="checkbox" name="advice3" value="อุดฟัน" id="advice3" />
อุดฟัน <br />
<input type="checkbox" name="advice4" value="ครอบฟัน" id="advice4" />
ครอบฟัน</td>
          </tr>
        <tr>
          <td align="center" valign="top"><input type="checkbox" name="mouth3" value="เหงือกอักเสบ" /></td>
          <td valign="top">เหงือกอักเสบ</td>
          <td valign="top"><strong>คำแนะนำ</strong><br />
            <input type="checkbox" name="advice5" value="ขูดหินปูน" id="advice5" />
            ขูดหินปูน
            <br />
<input type="checkbox" name="advice6" value="ถอนฟัน" id="advice6" />
ถอนฟัน</td>
          </tr>
        <tr>
          <td align="center" valign="top"><input type="checkbox" name="mouth4" value="อื่นๆ" /></td>
          <td valign="top">อื่นๆ</td>
          <td valign="top"><strong>คำแนะนำ</strong><br />
            <input type="checkbox" name="advice7" value="รักษารากฟัน" id="advice7" />
            รักษารากฟัน
            <br />
<input type="checkbox" name="advice8" value="ผ่าฟันคุด" id="advice8" /> 
ผ่าฟันคุด<br />
<input type="checkbox" name="advice9" value="ใส่ฟัน" id="advice9" /> 
ใส่ฟัน
<br />
<input type="checkbox" name="advice10" value="ปรึกษาทันตแพทย์เฉพาะทาง" id="advice10" /> 
ปรึกษาทันตแพทย์เฉพาะทาง
<br /></td>
          </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td class="pdx">&nbsp;</td>
      </tr>
    </table>
</td>
</TR>
</TABLE>
<BR>


<center>
<input name="submit" type="submit" value=" ตกลง "  />&nbsp;&nbsp;
<!--<input name="submit2" type="submit" value="ตกลง&amp;สติกเกอร์ OPD" />-->
</center>
<INPUT TYPE="hidden" value="<?php echo $query1['yot']." ".$query1['name']." ".$query1['surname'];?>" name="ptname" />
<input name="age" type="hidden" id="age"  value="<?php echo $age1;?>" />
<INPUT TYPE="hidden" value="<?php echo $query1['hn'];?>" name="hn" />
</FORM>
<?php
}elseif(isset($_GET['del'])){
	$sql3 = "delete from chk_mouth where row_id='".$_GET['del']."' ";
	$result3= mysql_query($sql3);
	if($result3){
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=dx_ofyear_mouth.php\">";
	}
}else{
	$sql2 = "select * from chk_mouth where yearchk='2556' ";
	$rows2 = mysql_query($sql2);
	?>
<br /><br />
	<table width="90%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse; font-family: AngsanaUPC; font-size: 18px;">
    	<tr><td width="57" align="center" bgcolor="#FF9966">#</td><td width="110" align="center" bgcolor="#FF9966">HN</td><td width="168" align="center" bgcolor="#FF9966">ชื่อ-สกุล</td>
    	  <td width="278" align="center" bgcolor="#FF9966">ผลการตรวจ</td>
    	  <td width="32" align="center" bgcolor="#FF9966">ลบ</td>
   	    </tr>
	<?
	while($result=mysql_fetch_array($rows2)){
		$i++;
	?>
    	<tr><td align="center"><?=$i?></td>
        <td><?=$result['hn']?></td>
        <td><?=$result['ptname']?></td>
    	<td><? 
		if($result['stat']!=""){echo $result['stat']." คำแนะนำ ".$result['advice1']." ".$result['advice2']."<br>";}
		if($result['stat2']!=""){echo $result['stat2']." คำแนะนำ ".$result['advice3']." ".$result['advice4']."<br>";}
		if($result['stat3']!=""){echo $result['stat3']." คำแนะนำ ".$result['advice5']." ".$result['advice6']."<br>";}
		if($result['stat4']!=""){echo $result['stat4']." คำแนะนำ ".$result['advice7']." ".$result['advice8']." ".$result['advice9']." ".$result['advice10'];}?></td>
    	<td width="32" align="center"><a href="dx_ofyear_mouth.php?del=<?=$result['row_id']?>" onclick="return confirm('ยืนยันการลบ?')">ลบ</a></td>
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
