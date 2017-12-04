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
  <div class="font_title">ผลการตรวจสมรรถภาพการได้ยิน</div></center>

<form action="dx_ofyear_hear.php" method="post">
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
<FORM METHOD=POST ACTION="dx_ofyear_save_hear.php">



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
      <td class="pdxpro"><strong>ผลการตรวจสมรรถภาพการได้ยิน</strong></td>
      </tr>
    <tr>
      <td class="pdx"><table width="719"><tr><td colspan="3" align="center">ความถี่เสียงพูดคุยทั่วไป</td><td colspan="3" align="center">ความถี่เสียงสูง</td></tr>
        <tr>
          <td width="71" align="center">ความถี่เสียง</td>
          <td width="139" align="center">ขวา</td>
          <td width="134" align="center">ซ้าย</td>
          <td width="79" align="center">ความถี่เสียง</td>
          <td width="134" align="center">ขวา</td>
          <td width="134" align="center">ซ้าย</td>
        </tr>
        <tr>
          <td align="center">500</td>
          <td align="center"><input type="text" name="right1" id="left1" size="10" tabindex="1" /></td>
          <td align="center"><input type="text" name="left1" id="right1" size="10" tabindex="10" /></td>
          <td align="center">3000</td>
          <td align="center"><input type="text" name="right4" id="left4" size="10" tabindex="5" /></td>
          <td align="center"><input type="text" name="left4" id="right4" size="10" tabindex="14" /></td>
        </tr>
        <tr>
          <td align="center">1000</td>
          <td align="center"><input type="text" name="right2" id="left2" size="10" tabindex="2" /></td>
          <td align="center"><input type="text" name="left2" id="right2" size="10" tabindex="11" /></td>
          <td align="center">4000</td>
          <td align="center"><input type="text" name="right5" id="left5" size="10" tabindex="6" /></td>
          <td align="center"><input type="text" name="left5" id="right5" size="10" tabindex="15" /></td>
        </tr>
        <tr>
          <td align="center">2000</td>
          <td align="center"><input type="text" name="right3" id="left3" size="10" tabindex="3" /></td>
          <td align="center"><input type="text" name="left3" id="right3" size="10" tabindex="12" /></td>
          <td align="center">6000</td>
          <td align="center"><input type="text" name="right6" id="left6" size="10" tabindex="7" /></td>
          <td align="center"><input type="text" name="left6" id="right6" size="10" tabindex="16" /></td>
        </tr>
        <tr>
          <td align="center">PTA</td>
          <td align="center"><input type="text" name="pta1" id="pta1" size="10" tabindex="4" /></td>
          <td align="center"><input type="text" name="pta2" id="pta2" size="10" tabindex="13" /></td>
          <td align="center">8000</td>
          <td align="center"><input type="text" name="right7" id="left7" size="10" tabindex="8" /></td>
          <td align="center"><input type="text" name="left7" id="right7" size="10" tabindex="17" /></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">PTA</td>
          <td align="center"><input type="text" name="pta3" id="pta3" size="10" tabindex="9" /></td>
          <td align="center"><input type="text" name="pta4" id="pta4" size="10" tabindex="18" /></td>
        </tr>
        <tr>
          <td align="center">LOW TONE</td>
          <td align="center">
          <select name="tone1" id="tone1">
          <option value="">- เลือก - </option>
              <option value="ปกติ" <? if($query3['LowRight']=="ปกติ") echo "selected";?>>ปกติ</option>
              <option value="ผิดปกติเล็กน้อย" >ผิดปกติเล็กน้อย</option>
              <option value="ผิดปกติปานกลาง" >ผิดปกติปานกลาง</option>
              <option value="ผิดปกติมาก" >ผิดปกติมาก</option>
              <option value="ผิดปกติรุนแรง" >ผิดปกติรุนแรง</option>
              <option value="ผิดปกติรุนแรงมาก" >ผิดปกติรุนแรงมาก</option>
              <option value="ส่งตรวจ audiogram" >ส่งตรวจ audiogram</option>
              <option value="ปกติ (หูอักเสบ)" >ปกติ (หูอักเสบ)</option>
          </select></td>
          <td align="center">
          <select name="tone2" id="tone2">
          <option value="">- เลือก - </option>
              <option value="ปกติ" >ปกติ</option>
              <option value="ผิดปกติเล็กน้อย" >ผิดปกติเล็กน้อย</option>
              <option value="ผิดปกติปานกลาง" >ผิดปกติปานกลาง</option>
              <option value="ผิดปกติมาก" >ผิดปกติมาก</option>
              <option value="ผิดปกติรุนแรง" >ผิดปกติรุนแรง</option>
              <option value="ผิดปกติรุนแรงมาก" >ผิดปกติรุนแรงมาก</option>
              <option value="ส่งตรวจ audiogram" >ส่งตรวจ audiogram</option>
              <option value="ปกติ (หูอักเสบ)" >ปกติ (หูอักเสบ)</option>
          </select></td>
          <td align="center">HIGH TONE</td>
          <td align="center">
          <select name="tone3" id="tone3">
          <option value="">- เลือก - </option>
              <option value="ปกติ" >ปกติ</option>
              <option value="ผิดปกติเล็กน้อย" >ผิดปกติเล็กน้อย</option>
              <option value="ผิดปกติปานกลาง" >ผิดปกติปานกลาง</option>
              <option value="ผิดปกติมาก" >ผิดปกติมาก</option>
              <option value="ผิดปกติรุนแรง" >ผิดปกติรุนแรง</option>
              <option value="ผิดปกติรุนแรงมาก" >ผิดปกติรุนแรงมาก</option>
              <option value="ส่งตรวจ audiogram" >ส่งตรวจ audiogram</option>
              <option value="ปกติ (หูอักเสบ)" >ปกติ (หูอักเสบ)</option>
          </select></td>
          <td align="center">
          <select name="tone4" id="tone4">
          <option value="">- เลือก - </option>
              <option value="ปกติ" >ปกติ</option>
              <option value="ผิดปกติเล็กน้อย" >ผิดปกติเล็กน้อย</option>
              <option value="ผิดปกติปานกลาง" >ผิดปกติปานกลาง</option>
              <option value="ผิดปกติมาก" >ผิดปกติมาก</option>
              <option value="ผิดปกติรุนแรง" >ผิดปกติรุนแรง</option>
              <option value="ผิดปกติรุนแรงมาก" >ผิดปกติรุนแรงมาก</option>
              <option value="ส่งตรวจ audiogram" >ส่งตรวจ audiogram</option>
              <option value="ปกติ (หูอักเสบ)" >ปกติ (หูอักเสบ)</option>
          </select></td>
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
	$sql3 = "delete from chk_hear where row_id='".$_GET['del']."' ";
	$result3= mysql_query($sql3);
	if($result3){
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=dx_ofyear_hear.php\">";
	}
}else{
	$sql2 = "select * from chk_hear where yearchk='2556' ";
	$rows2 = mysql_query($sql2);
	?>
<br /><br />
	<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse; font-family: AngsanaUPC; font-size: 18px;">
    	<tr>
    	  <td width="17" rowspan="3" align="center" bgcolor="#FF9966">#</td>
    	  <td width="35" rowspan="3" align="center" bgcolor="#FF9966">HN</td>
    	  <td width="69" rowspan="3" align="center" bgcolor="#FF9966">ชื่อ-สกุล</td>
    	  <td colspan="14" align="center" bgcolor="#FF9966">ความถี่เสียง</td>
    	  <td colspan="2" rowspan="2" align="center" bgcolor="#FF9966">PTA Low</td>
    	  <td colspan="2" rowspan="2" align="center" bgcolor="#FF9966">PTA High</td>
    	  <td colspan="2" rowspan="2" align="center" bgcolor="#FF9966">LOW TONE</td>
    	  <td colspan="2" rowspan="2" align="center" bgcolor="#FF9966">HIGH TONE</td>
    	  <td width="21" rowspan="3" align="center" bgcolor="#FF9966">ลบ</td>
  	  </tr>
    	<tr>
    	  <td colspan="2" align="center" bgcolor="#FF9966">500</td>
    	  <td colspan="2" align="center" bgcolor="#FF9966">1000</td>
    	  <td colspan="2" align="center" bgcolor="#FF9966">2000</td>
    	  <td colspan="2" align="center" bgcolor="#FF9966">3000</td>
    	  <td colspan="2" align="center" bgcolor="#FF9966">4000</td>
    	  <td colspan="2" align="center" bgcolor="#FF9966">6000</td>
          <td colspan="2" align="center" bgcolor="#FF9966">8000</td>
   	    </tr>
    	<tr>
    	  <td width="24" align="center" bgcolor="#FF9966">ซ้าย</td>
    	  <td width="24" align="center" bgcolor="#FF9966">ขวา</td>
    	  <td width="24" align="center" bgcolor="#FF9966">ซ้าย</td>
    	  <td width="24" align="center" bgcolor="#FF9966">ขวา</td>
    	  <td width="24" align="center" bgcolor="#FF9966">ซ้าย</td>
    	  <td width="24" align="center" bgcolor="#FF9966">ขวา</td>
    	  <td width="24" align="center" bgcolor="#FF9966">ซ้าย</td>
    	  <td width="24" align="center" bgcolor="#FF9966">ขวา</td>
    	  <td width="24" align="center" bgcolor="#FF9966">ซ้าย</td>
    	  <td width="24" align="center" bgcolor="#FF9966">ขวา</td>
    	  <td width="27" align="center" bgcolor="#FF9966">ซ้าย</td>
    	  <td width="23" align="center" bgcolor="#FF9966">ขวา</td>
    	  <td width="28" align="center" bgcolor="#FF9966">ซ้าย</td>
    	  <td width="23" align="center" bgcolor="#FF9966">ขวา</td>
    	  <td width="24" align="center" bgcolor="#FF9966">ซ้าย</td>
    	  
    	  <td width="20" align="center" bgcolor="#FF9966">ขวา</td>
          <td width="21" align="center" bgcolor="#FF9966">ซ้าย</td>
    	  <td width="24" align="center" bgcolor="#FF9966">ขวา</td>
    	  <td width="28" align="center" bgcolor="#FF9966">ซ้าย</td>
    	  <td width="22" align="center" bgcolor="#FF9966">ขวา</td>
    	  <td width="25" align="center" bgcolor="#FF9966">ซ้าย</td>
    	  <td width="29" align="center" bgcolor="#FF9966">ขวา</td>
      </tr>
	<?
	while($result=mysql_fetch_array($rows2)){
		$i++;
	?>
    	<tr><td align="center"><?=$i?></td>
        <td><?=$result['hn']?></td>
        <td><?=$result['ptname']?></td>
    	<td align="center"><?=$result['hear500L']?></td>
    	<td align="center"><?=$result['hear500R']?></td>
    	<td align="center"><?=$result['hear1000L']?></td>
    	<td align="center"><?=$result['hear1000R']?></td>
    	<td align="center"><?=$result['hear2000L']?></td>
    	<td align="center"><?=$result['hear2000R']?></td>
    	<td align="center"><?=$result['hear3000L']?></td>
    	<td align="center"><?=$result['hear3000R']?></td>
    	<td align="center"><?=$result['hear4000L']?></td>
    	<td align="center"><?=$result['hear4000R']?></td>
    	<td align="center"><?=$result['hear6000L']?></td>
    	<td align="center"><?=$result['hear6000R']?></td>
        <td align="center"><?=$result['hear8000L']?></td>
        <td align="center"><?=$result['hear8000R']?></td>
        <td width="24" align="center"><?=$result['ptaleft1']?></td>

        <td width="20" align="center"><?=$result['ptaright1']?></td>
        <td width="21" align="center"><?=$result['ptaleft2']?></td>
        <td width="24" align="center"><?=$result['ptaright2']?></td>
        <td width="28" align="center"><?=$result['Lowleft']?></td>
        <td width="22" align="center"><?=$result['Lowright']?></td>
        <td width="25" align="center"><?=$result['Highleft']?></td>
        <td width="29" align="center"><?=$result['Highright']?></td>
        <td width="21" align="center"><a href="dx_ofyear_hear.php?del=<?=$result['row_id']?>" onclick="return confirm('ยืนยันการลบ?')">ลบ</a></td>
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
