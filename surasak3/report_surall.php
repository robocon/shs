<?php

set_time_limit(3);
include("connect.inc");
include("memo_sur_in.php");

$month_now1 =sprintf("%02d",$_POST["month1"]);
$month_now2=sprintf("%02d",$_POST["month2"]);
$year_now1 = $_POST["year1"];
$year_now2 = $_POST["year2"];
?>
<style>
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</style>
<div id="no_print" >
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>
<span style="font-size: 16px; font-family: 'MS Sans Serif';"><strong><br />
<br />
ดูรายชื่อผู้ป่วยห้องผ่าตัด</strong></span>
<form method='POST' action='report_surall.php'>
	<TABLE width="523" border='0' id="form_01" style="font-size: 16px; font-family: 'MS Sans Serif';">
	<TR>
	  <TD width="513">ตั้งแต่ วันที่
        <select name="day1" id="mn">
          <?php for($i=1;$i<32;$i++){
	if($i<10) $a="0";
	else $a="";
	?>
          <option value="<?=$a?><?=$i?>" ><?php echo $i;?></option>
          <?php }?>
        </select>
เดือน&nbsp;
<select name="month1">
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
&nbsp;&nbsp;&nbsp;
	พ.ศ.
    <select name="year1" id="yr">
      <?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
      <option value="<?php echo $i;?>" <?php if($i == $year_now1) echo "Selected"; ?> ><?php echo $i;?></option>
      <?php }?>
    </select></TD>
	  </TR>
	<TR>
		<TD>
    ถึงวันที่
    <select name="day2" id="day">
      <?php for($i=1;$i<32;$i++){
	if($i<10) $a="0";
	else $a="";
	?>
      <option value="<?=$a?><?=$i?>" ><?php echo $i;?></option>
      <?php }?>
    </select>
เดือน&nbsp;
<select name="month2">
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
</select>&nbsp;&nbsp;&nbsp;
	พ.ศ.
    <select name="year2" id="year">
      <?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
      <option value="<?php echo $i;?>" <?php if($i == $year_now2) echo "Selected"; ?> ><?php echo $i;?></option>
      <?php }?>
    </select></TD>
	</TR>
	<TR>
		<TD><input type='submit' name="submit" value='     ตกลง     ' ></TD>
      </TR>
</TABLE>
</form>
</div>

<?php
if(isset($_POST['submit'])){


//$sql = "Select hn,date_format(thaidate,'%d/%m/%Y') as dt2, ptname, doctor, diag, opertion, timein, timeout, type_case, type_wounded, type_scar, ptright, doctor, surgery, room  From memo_sur where type_case like '%".$_POST["type_case"]."%' AND type_wounded like '%".$_POST["type_wounded"]."%' AND type_scar like '%".$_POST["type_scar"]."%' AND ptright like '%".$_POST["ptright"]."%' AND doctor like '%".$_POST["doctor"]."%' AND surgery like '%".$_POST["surgery"]."%' AND thaidate between '".$_POST["year1"]."-".$_POST["month1"]."-".$_POST["day1"]." 00:00:00' AND '".$_POST["year2"]."-".$_POST["month2"]."-".$_POST["day2"]." 23:59:59'";
$sql ="SELECT  * FROM  depart WHERE depart LIKE '%SUR%' and diag!='' and date between '".$_POST["year1"]."-".$_POST["month1"]."-".$_POST["day1"]." 00:00:00' AND '".$_POST["year2"]."-".$_POST["month2"]."-".$_POST["day2"]." 23:59:59' group by substr(date,0,10),hn order by date";
$result = mysql_query($sql);
$num = mysql_num_rows($result);
?>
<TABLE border='1' width="100%" bordercolor="#000000" style="font-size: 14px; font-family:AngsanaUPC; BORDER-COLLAPSE: collapse;" cellpadding="2">
<TR align="center" valign="top">
<TD width="3%" valign="top">No.</TD>
<TD width="20%" valign="top">ว/ด/ป</TD>
<TD width="10%" valign="top">HN</TD>
<TD width="25%" valign="top">ชื่อ-สกุล</TD>
<TD width="35%" valign="top">Dx</TD>
</TR>
<?
$i=1;
$k=0;
while($arr = mysql_fetch_assoc($result)){

$thidate = substr($arr["date"],8,2)."-".substr($arr["date"],5,2)."-".substr($arr["date"],0,4)." ".substr($arr["date"],10);
echo "<TR>
				<TD valign='top'>".$i.".</TD>
				<TD valign='top'>".$thidate."</TD>
				<TD valign='top'>".$arr["hn"]."</TD>
				<TD valign='top'>".$arr["ptname"]."</TD>
				<TD valign='top'>".$arr["diag"]."</TD>
			</TR>";
$i++;
$k++;
	if($k==40){
		?>
		</TABLE>
        
        <div style="page-break-after:always;"></div>
        
        <TABLE border='1' width="100%" bordercolor="#000000" style="font-size: 14px; font-family:AngsanaUPC; BORDER-COLLAPSE: collapse;" cellpadding="2">
<TR align="center" valign="top">
<TD width="3%" valign="top">No.</TD>
<TD width="20%" valign="top">ว/ด/ป</TD>
<TD width="10%" valign="top">HN</TD>
<TD width="25%" valign="top">ชื่อ-สกุล</TD>
<TD width="35%" valign="top">Dx</TD>
</TR>
		<?
		$k=0;
	}
	elseif($num==($i-1)){
	?>
	</TABLE>
	<?
	}
}
}

include("unconnect.inc");
?>

