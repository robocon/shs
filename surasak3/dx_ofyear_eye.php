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
  <div class="font_title">ผลการตรวจสมรรถภาพการมองเห็น</div></center>

<form action="dx_ofyear_eye.php" method="post">
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="center" bgcolor="#0000CC" class="tb_font_1">กรอกหมายเลข HN</TD>
	</TR>
	<TR>
		<TD class="tb_font"><input type="text" name="p_hn"  value="<?php echo $_POST["p_hn"]?>"/> <input type="submit" name="Submit1" value="ตกลง" /></TD>
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
<FORM METHOD=POST ACTION="dx_ofyear_save_eye.php">



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
      <td class="pdxpro"><strong>ผลการตรวจสมรรถภาพการมองเห็น</strong></td>
      </tr>
    <tr>
      <td class="pdx"><table width="100%">
        <tr>
          <td width="5%" align="center"><input type="radio" name="eye1" value="ปกติ" /></td>
          <td width="20%">สายตาปกติ</td>
          <td width="">&nbsp;</td>
          </tr>
        <tr>
          <td align="center"><input type="radio" name="eye1" value="สายตาสั้น" /></td>
          <td>สายตาสั้น</td>
          <td>คำแนะนำ ตัดแว่น</td>
          </tr>
        <tr>
          <td align="center"><input type="radio" name="eye1" value="สายตายาว" /></td>
          <td>สายตายาว</td>
          <td>คำแนะนำ ตัดแว่น</td>
          </tr>
        <tr>
          <td align="center"><input type="radio" name="eye1" value="สายตาผิดปกติอื่น" /></td>
          <td>สายตาผิดปกติอื่น</td>
          <td>คำแนะนำ ต้องพบแพทย์หรือรักษา <input type="text" name="eye1_ext" width="30%"></td>
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
<input name="submit" type="submit" value=" บันทึกข้อมูล "  />&nbsp;&nbsp;
<!--<input name="submit2" type="submit" value="ตกลง&amp;สติกเกอร์ OPD" />-->
</center>
<INPUT TYPE="hidden" value="<?php echo $query1['yot']." ".$query1['name']." ".$query1['surname'];?>" name="ptname" />
<input name="age" type="hidden" id="age"  value="<?php echo $age1;?>" />
<INPUT TYPE="hidden" value="<?php echo $query1['hn'];?>" name="hn" />
</FORM>
<br>
<?php
}
elseif(isset($_GET['del'])){
	$sql3 = "delete from chk_eye where row_id='".$_GET['del']."' ";
	$result3= mysql_query($sql3);
	if($result3){
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=dx_ofyear_eye.php\">";
	}
}else{
	$next_year = ( date('Y') + 543 ) + 1 ;
	$year_list = range(2557, $next_year);

	$def_year = ( isset($_POST['year']) ) ? $_POST['year'] : ( date('Y') + 543 ) ;
	?>
	<br />
	<form action="dx_ofyear_eye.php" method="post">
	เลือกปีในการแสดงผล: 
	<select name="year" id="">
		<?php
		foreach( $year_list AS $key => $year ){
			$selected = ( $year == $def_year ) ? 'selected' : '' ;
			?><option value="<?=$year;?>" <?=$selected;?>><?=$year;?></option><?php
		}
		?>
	</select>
	<button type="submit">แสดงผล</button>
	</form>
	

	<?php
	
	$sql2 = "select * from chk_eye where yearchk='$def_year' ";
	$rows2 = mysql_query($sql2);
	?>
<br />
	<table width="80%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse; font-family: AngsanaUPC; font-size: 18px;">
    	<tr><td width="29" align="center" bgcolor="#FF9966">#</td><td width="86" align="center" bgcolor="#FF9966">HN</td><td width="146" align="center" bgcolor="#FF9966">ชื่อ-สกุล</td>
    	  <td width="124" align="center" bgcolor="#FF9966">ผลการตรวจ</td>
    	  <td width="124" align="center" bgcolor="#FF9966">คำแนะนำ</td>
		  <td width="124" align="center" bgcolor="#FF9966">คำแนะนำอื่นๆ</td>
    	  <td width="61" align="center" bgcolor="#FF9966">ลบ</td>
   	    </tr>
	<?
	while($result=mysql_fetch_array($rows2)){
		$i++;
	?>
    	<tr><td align="center"><?=$i?></td>
          
        <td><?=$result['hn']?></td>
        <td><?=$result['ptname']?></td>
    	<td><?=$result['stat_eye']?></td>
        
    	<td><? if($result['stat_eye']=="สายตาสั้น"){echo "ตัดแว่น";}elseif($result['stat_eye']=="สายตายาว"){echo "ตัดแว่น";}elseif($result['stat_eye']=="สายตาผิดปกติอื่น"){echo "ต้องพบแพทย์หรือรักษา";}?></td>
    	<td><?=( !empty($result['eye1_ext']) ? $result['eye1_ext'] : '' )?></td>
		<td align="center"><a href="dx_ofyear_eye.php?del=<?=$result['row_id']?>" onclick="return confirm('ยืนยันการลบ?')">ลบ</a></td>
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