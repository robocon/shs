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
  <div class="font_title">ผลการตรวจสมรรถภาพปอด</div></center>

<form action="dx_ofyear_chest.php" method="post">
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
<FORM METHOD=POST ACTION="dx_ofyear_save_chest.php">



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
      <td class="pdxpro"><strong>ผลการตรวจสมรรถภาพปอด</strong></td>
      </tr>
    <tr>
      <td class="pdx">%FVC :
        <input type="text" name="FVC" id="FVC" size="10"/></td>
    </tr>
    <tr>
      <td class="pdx">%FEV1 :
        <input type="text" name="FEV" id="FEV" size="10" /></td>
    </tr>
    <tr>
      <td class="pdx">%FVC/FEV1 :
        <input type="text" name="FFV" id="FFV" size="10" /></td>
    </tr>
    <tr>
      <td class="pdx">ผลการตรวจ
        <select name="reason">
          <option value="">- เลือก - </option>
          <option value="Normal Spirometry" >Normal Spirometry</option>
          <option value="Mild Obstruction" >Mild Obstruction</option>
          <option value="Moderate Obstruction" >Moderate Obstruction</option>
          <option value="Moderate Severe Obstruction" >Moderate Severe Obstruction</option>
          <option value="Severe Obstruction" >Severe Obstruction</option>
          <option value="Very Severe Obstruction" >Very Severe Obstruction</option>
          <option value="Mild Restriction" >Mild Restriction</option>
          <option value="Moderate Restriction" >Moderate Restriction</option>
          <option value="Moderate Severe Restriction" >Moderate Severe Restriction</option>
          <option value="Severe Restriction" >Severe Restriction</option>
           <option value="Very Severe Restriction" >Very Severe Restriction</option>
            <option value="Not Valid (ข้อมูลไม่เพียงพอ)" >Not Valid (ข้อมูลไม่เพียงพอ)</option>
        </select></td>
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
	$sql3 = "delete from chk_chest where row_id='".$_GET['del']."' ";
	$result3= mysql_query($sql3);
	if($result3){
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=dx_ofyear_chest.php\">";
	}
}else{
	$sql2 = "select * from chk_chest where yearchk='2556' ";
	$rows2 = mysql_query($sql2);
	?>
<br /><br />
	<table width="80%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse; font-family: AngsanaUPC; font-size: 18px;">
    	<tr><td width="27" align="center" bgcolor="#FF9966">#</td><td width="74" align="center" bgcolor="#FF9966">HN</td><td width="113" align="center" bgcolor="#FF9966">ชื่อ-สกุล</td>
    	  <td width="42" align="center" bgcolor="#FF9966">FVC</td>
    	  <td width="48" align="center" bgcolor="#FF9966">FEV1</td>
    	  <td width="48" align="center" bgcolor="#FF9966">FVC/FEV1</td>
    	  <td width="108" align="center" bgcolor="#FF9966">ผลการตรวจ</td>
    	  <td width="58" align="center" bgcolor="#FF9966">ลบ</td>
   	    </tr>
	<?
	while($result=mysql_fetch_array($rows2)){
		$i++;
	?>
    	<tr><td align="center"><?=$i?></td>
        <td><?=$result['hn']?></td>
        <td><?=$result['ptname']?></td>
    	<td align="center"><?=$result['FVC']?></td>
    	<td align="center"><?=$result['FEV']?></td>
    	<td align="center"><?=$result['FFV']?></td>
    	<td><?=$result['reason']?></td>
    	<td width="58" align="center"><a href="dx_ofyear_chest.php?del=<?=$result['row_id']?>" onclick="return confirm('ยืนยันการลบ?')">ลบ</a></td>
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
