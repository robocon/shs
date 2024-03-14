<?php 
include("connect.php");
?>
<style type="text/css">
	@media print {
		#print-page {
			page-break-after: always;
		}

		#print-page-no {
			display: none;
		}
	}
	*{font-family: "TH SarabunPSK";}
	.font1 {font-size: 18px;}
	.font2 {font-size: 24px;}
	.font3 {font-size: 22px;}
	.style1 {font-size: 18px;font-weight: bold;}
</style>
<div id="print-page-no">
	<form name="form1" method="post" action="auditchkan.php">
		<input name="act" type="hidden" value="search" />
		<a target=_self href='../nindex.htm'><< ไปเมนู</a>
		<table width="80%" border="0">
			<tr>
				<td height="30" class="font3"><b>เอกสารแสดงค่าใช้จ่ายในการรักษาพยาบาลประเภทผู้ป่วยใน</b></td>
			</tr>
			<tr>
				<td height="44" class="font1">
					<span class="font2">AN :
						<input name="an" type="text" id="an" size="20" class="font3">
					</span><span style="margin-left:10px;"><input type="submit" name="search" id="search" class="font3" value="    ค้นหา    "></span>
				</td>
			</tr>
			<tr>
				<td height="39" class="font1">
					
				</td>
			</tr>
		</table>
	</form>	
</div>
<?php
if($_POST["act"]=="search"){
$an=$_POST["an"];	
$query="CREATE TEMPORARY TABLE tmp_ipacc SELECT * FROM ipacc WHERE an = '$an'";
$result = mysql_query($query) or die("Query failed,tmp_ipacc");

    $query1 = "SELECT * FROM ipcard WHERE an = '$an'";
    $result1 = mysql_query($query1) or die("Query failed1");
    for ($i = mysql_num_rows($result1) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result1, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }
        if(!($row = mysql_fetch_object($result1)))
            continue;
         }
   if(mysql_num_rows($result1)){
            $cPtname = $row->ptname;
            $cHn        = $row->hn;
            $cAn         = $row->an;
            $cBed      = $row->bedcode;
            $cPtright  = $row->ptright;
            $cDate     = $row->date; 
            $cDcdate = $row->dcdate;
			$nDay      =$row->days;
			$cDiag     = $row->diag;
            $cDoctor  = $row->doctor;
			$sDiscdate=$row->dcdate;
			$sMy_food=$row->my_food;
			$sadm_w=$row->adm_w;
			$sDctype=$row->dctype;

    }

	/// ดึงเลขบัตร ปชช. ///
	$sqlid="select * from opcard where hn='".$cHn."' ";
	$queryid=mysql_query($sqlid);
	$arrid=mysql_fetch_array($queryid);
	$idcard=$arrid['idcard'];
	
print "<CENTER><font face='TH SarabunPSK'  size='5'>โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง<br></CENTER>";
 $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
   print "<CENTER><font face='TH SarabunPSK'  size='4'>สรุปค่ารักษาพยาบาลผู้ป่วยใน&nbsp;&nbsp;เมื่อวันที่&nbsp;&nbsp;$Thaidate</CENTER>";
  
  //   print "<font face='TH SarabunPSK'  size='3'><CENTER>&nbsp;&nbsp;เมื่อวันที่&nbsp;&nbsp;$Thaidate</CENTER>";
  
  $indate=explode(' ', $cDate);
  $indate1=explode('-',$indate[0]);
  $indate2=$indate1[2].'-'.$indate1[1].'-'.$indate1[0].' '.$indate[1];
  
  $dcdate=explode(' ', $cDcdate);
  $dcdate1=explode('-',$dcdate[0]);
  $dcdate2=$dcdate1[2].'-'.$dcdate1[1].'-'.$dcdate1[0].' '.$dcdate[1];

   print "<CENTER>&nbsp;&nbsp;&nbsp;<font face='TH SarabunPSK'  size='4'><b>ผู้ป่วยชื่อ $cPtname</b>";
   print "&nbsp;&nbsp;HN: <B>$cHn</B> &nbsp;&nbsp; AN: <B>$cAn</B> <font face='TH SarabunPSK'  size='3'>&nbsp;&nbsp;เตียง $cBed&nbsp;&nbsp; <BR>เลขบัตรประชาชน $idcard&nbsp;&nbsp;แพทย์ : $cDoctor &nbsp;&nbsp;น้ำหนัก&nbsp;&nbsp;..$sadm_w...กก.&nbsp;&nbsp;<br>";
   print "&nbsp;&nbsp;&nbsp;สิทธิ :<B>$cPtright</B>&nbsp;&nbsp;ค่าห้องที่เบิกได้&nbsp;$sMy_food&nbsp;บาท&nbsp;โรค : $cDiag&nbsp;,&nbsp;..........  <br>จำหน่าย&nbsp;	$sDctype";
   print "&nbsp;&nbsp;&nbsp;รับป่วย: $indate2,&nbsp;&nbsp; จำหน่าย: $dcdate2, &nbsp;&nbsp;วันนอน $nDay  วัน <br>";
   print "</CENTER";
?>

<div style="font-weight:bold;">01 : ค่าห้อง/ค่าอาหาร</div>	
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="textcash" style="border-collapse:collapse">
<tr>
<td width="5%" align="center" class="textcash"><strong>ลำดับ</strong></td>
<td width="15%" align="center" class="textcash"><strong>วัน/เดือน/ปี</strong></td>
<td width="7%" align="center" class="textcash"><strong>รหัส</strong></td>
<td width="53%" align="center" class="textcash"><strong>รายการ</strong></td>
<td width="10%" align="center" class="textcash"><strong>จำนวน</strong></td>
<td width="10%" align="center" class="textcash"><strong>ราคา</strong></td>
</tr>
<?php
$sql01 = "SELECT * FROM tmp_ipacc WHERE an = '$an' && (part='BFY' || part='BFN') order by row_id";
//echo $sql01;
$query01 = mysql_query($sql01)or die("Query failed sql01");
$num01=mysql_num_rows($query01);
if($num01 < 1){
	echo "<tr><td colspan='6' align='center'>--------------------------- ไม่มีรายการค่ารักษาพยาบาล ---------------------------</td></tr>";
}else{	
$i=0;
$total01=0;
while($result01 = mysql_fetch_array($query01)){
$i++;	
$total01=$total01+$result01["price"];

$sql55="select codex from labcare where code='".$result01["code"]."'";
$query55=mysql_query($sql55);
list($codex)=mysql_fetch_array($query55);
?>
<tr>
<td width="5%" align="center" class="textcash"><?php echo $i;?></td>
<td width="15%" align="center" class="textcash"><?php echo $result01["date"];?></td>
<td width="7%" align="left" class="textcash"><?php echo $result01["code"];?></td>
<td width="53%" class="textcash"><?php echo $result01["detail"];?></td>
<td width="10%" align="center" class="textcash"><?php echo $result01["amount"];?></td>
<td width="10%" align="right" class="textcash"><?php echo number_format($result01["price"],2);?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="5" align="right">รวมทั้งสิ้น</td>
<td align="right"><?php echo number_format($total01,2);?></td>
</tr>
<?php
}
?>
</table>


<div style="font-weight:bold; margin-top:20px;">02 : อวัยวะเทียม/อุปกรณ์ในการบำบัดรักษา</div>	
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="textcash" style="border-collapse:collapse">
<tr>
<td width="5%" align="center" class="textcash"><strong>ลำดับ</strong></td>
<td width="15%" align="center" class="textcash"><strong>วัน/เดือน/ปี</strong></td>
<td width="7%" align="center" class="textcash"><strong>รหัส</strong></td>
<td width="7%" align="center" class="textcash"><strong>DPYCODE</strong></td>
<td width="53%" align="center" class="textcash"><strong>รายการ</strong></td>
<td width="10%" align="center" class="textcash"><strong>จำนวน</strong></td>
<td width="10%" align="center" class="textcash"><strong>ราคา</strong></td>
</tr>
<?php
$sql02 = "SELECT * FROM tmp_ipacc WHERE an = '$an' && (part='DPY' || part='DPN') order by row_id";
//echo $sql02;
$query02 = mysql_query($sql02)or die("Query failed sql02");
$num02=mysql_num_rows($query02);
if($num02 < 1){
	echo "<tr><td colspan='6' align='center'>--------------------------- ไม่มีรายการค่ารักษาพยาบาล ---------------------------</td></tr>";
}else{	
$i=0;
$total02=0;
while($result02 = mysql_fetch_array($query02)){
	$i++;	
	$total02=$total02+$result02["price"];

	// $sql55="select codex from labcare where code='".$result02["code"]."'";
	// $query55=mysql_query($sql55);
	// list($codex)=mysql_fetch_array($query55);

	$qDruglst = mysql_query("SELECT dpy_code FROM druglst WHERE drugcode = '".$result02["code"]."' ");
	$dpyCode = '';
	if(mysql_num_rows($qDruglst)>0){
		$druglst = mysql_fetch_assoc($qDruglst);
		$dpyCode = $druglst['dpy_code'];
	}
	?>
	<tr>
	<td width="5%" align="center" class="textcash"><?php echo $i;?></td>
	<td width="15%" align="center" class="textcash"><?php echo $result02["date"];?></td>
	<td width="7%" align="left" class="textcash"><?php echo $result02["code"];?></td>
	<td width="7%" align="left" class="textcash"><?=$dpyCode;?></td>
	<td width="53%" class="textcash"><?php echo $result02["detail"];?></td>
	<td width="10%" align="center" class="textcash"><?php echo $result02["amount"];?></td>
	<td width="10%" align="right" class="textcash"><?php echo number_format($result02["price"],2);?></td>
	</tr>
	<?php
}
?>
<tr>
<td colspan="5" align="right">รวมทั้งสิ้น</td>
<td align="right"><?php echo number_format($total02,2);?></td>
</tr>
<?php
}
?>
</table>


<div style="font-weight:bold; margin-top:20px;">03 : ยาและสารอาหารทางเส้นเลือดที่ใช้ในโรงพยาบาล</div>	
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="textcash" style="border-collapse:collapse">
<tr>
<td width="5%" align="center" class="textcash"><strong>ลำดับ</strong></td>
<td width="15%" align="center" class="textcash"><strong>วัน/เดือน/ปี</strong></td>
<td width="7%" align="center" class="textcash"><strong>รหัส</strong></td>
<td width="53%" align="center" class="textcash"><strong>รายการ</strong></td>
<td width="10%" align="center" class="textcash"><strong>จำนวน</strong></td>
<td width="10%" align="center" class="textcash"><strong>ราคา</strong></td>
</tr>
<?php
$sql03 = "SELECT * FROM tmp_ipacc WHERE an = '$an' && (part='DDL' || part='DDY' || part='DDN') and status !='จำหน่าย' order by row_id";
//echo $sql03;
$query03 = mysql_query($sql03)or die("Query failed sql03");
$num03=mysql_num_rows($query03);
if($num03 < 1){
	echo "<tr><td colspan='6' align='center'>--------------------------- ไม่มีรายการค่ารักษาพยาบาล ---------------------------</td></tr>";
}else{	
$i=0;
$total03=0;
while($result03 = mysql_fetch_array($query03)){
$i++;	
$total03=$total03+$result03["price"];
?>
<tr>
<td width="5%" align="center" class="textcash"><?php echo $i;?></td>
<td width="15%" align="center" class="textcash"><?php echo $result03["date"];?></td>
<td width="7%" align="left" class="textcash"><?php echo $result03["code"];?></td>
<td width="53%" class="textcash"><?php echo $result03["detail"];?></td>
<td width="10%" align="center" class="textcash"><?php echo $result03["amount"];?></td>
<td width="10%" align="right" class="textcash"><?php echo number_format($result03["price"],2);?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="5" align="right">รวมทั้งสิ้น</td>
<td align="right"><?php echo number_format($total03,2);?></td>
</tr>
<?php
}
?>
</table>

<div style="font-weight:bold; margin-top:20px;">04 : ยาที่นำไปใช้ต่อที่บ้าน</div>	
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="textcash" style="border-collapse:collapse">
<tr>
<td width="5%" align="center" class="textcash"><strong>ลำดับ</strong></td>
<td width="15%" align="center" class="textcash"><strong>วัน/เดือน/ปี</strong></td>
<td width="7%" align="center" class="textcash"><strong>รหัส</strong></td>
<td width="53%" align="center" class="textcash"><strong>รายการ</strong></td>
<td width="10%" align="center" class="textcash"><strong>จำนวน</strong></td>
<td width="10%" align="center" class="textcash"><strong>ราคา</strong></td>
</tr>
<?php
$sql04 = "SELECT * FROM tmp_ipacc WHERE an = '$an' && (part='DDL' || part='DDY' || part='DDN') and status ='จำหน่าย' order by row_id";
//echo $sql04;
$query04 = mysql_query($sql04)or die("Query failed sql04");
$num04=mysql_num_rows($query04);
if($num04 < 1){
	echo "<tr><td colspan='6' align='center'>--------------------------- ไม่มีรายการค่ารักษาพยาบาล ---------------------------</td></tr>";
}else{	
$i=0;
$total04=0;
while($result04 = mysql_fetch_array($query04)){
$i++;	
$total04=$total04+$result04["price"];
?>
<tr>
<td width="5%" align="center" class="textcash"><?php echo $i;?></td>
<td width="15%" align="center" class="textcash"><?php echo $result04["date"];?></td>
<td width="7%" align="left" class="textcash"><?php echo $result04["code"];?></td>
<td width="53%" class="textcash"><?php echo $result04["detail"];?></td>
<td width="10%" align="center" class="textcash"><?php echo $result04["amount"];?></td>
<td width="10%" align="right" class="textcash"><?php echo number_format($result04["price"],2);?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="5" align="right">รวมทั้งสิ้น</td>
<td align="right"><?php echo number_format($total04,2);?></td>
</tr>
<?php
}
?>
</table>


<div style="font-weight:bold; margin-top:20px;">05 :  เวชภัณฑ์ที่ไม่ใช่ยา</div>	
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="textcash" style="border-collapse:collapse">
<tr>
<td width="5%" align="center" class="textcash"><strong>ลำดับ</strong></td>
<td width="15%" align="center" class="textcash"><strong>วัน/เดือน/ปี</strong></td>
<td width="7%" align="center" class="textcash"><strong>รหัส</strong></td>
<td width="53%" align="center" class="textcash"><strong>รายการ</strong></td>
<td width="10%" align="center" class="textcash"><strong>จำนวน</strong></td>
<td width="10%" align="center" class="textcash"><strong>ราคา</strong></td>
</tr>
<?php
$sql05 = "SELECT * FROM tmp_ipacc WHERE an = '$an' && (part='DSY' || part='DSN') order by row_id";
//echo $sql05;
$query05 = mysql_query($sql05)or die("Query failed sql05");
$num05=mysql_num_rows($query05);
if($num05 < 1){
	echo "<tr><td colspan='6' align='center'>--------------------------- ไม่มีรายการค่ารักษาพยาบาล ---------------------------</td></tr>";
}else{	
$i=0;
$total05=0;
while($result05 = mysql_fetch_array($query05)){
$i++;	
$total05=$total05+$result05["price"];


?>
<tr>
<td width="5%" align="center" class="textcash"><?php echo $i;?></td>
<td width="15%" align="center" class="textcash"><?php echo $result05["date"];?></td>
<td width="7%" align="left" class="textcash"><?php echo $result05["code"];?></td>
<td width="53%" class="textcash"><?php echo $result05["detail"];?></td>
<td width="10%" align="center" class="textcash"><?php echo $result05["amount"];?></td>
<td width="10%" align="right" class="textcash"><?php echo number_format($result05["price"],2);?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="5" align="right">รวมทั้งสิ้น</td>
<td align="right"><?php echo number_format($total05,2);?></td>
</tr>
<?php
}
?>
</table>


<div style="font-weight:bold; margin-top:20px;">06 :  ค่าบริการโลหิตและส่วนประกอบของโลหิต</div>	
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="textcash" style="border-collapse:collapse">
<tr>
<td width="5%" align="center" class="textcash"><strong>ลำดับ</strong></td>
<td width="15%" align="center" class="textcash"><strong>วัน/เดือน/ปี</strong></td>
<td width="7%" align="center" class="textcash"><strong>รหัส</strong></td>
<td width="53%" align="center" class="textcash"><strong>รายการ</strong></td>
<td width="10%" align="center" class="textcash"><strong>จำนวน</strong></td>
<td width="10%" align="center" class="textcash"><strong>ราคา</strong></td>
</tr>
<?php
$sql06 = "SELECT * FROM tmp_ipacc WHERE an = '$an' && (part='BLOOD' || part='BLOODY' || part='BLOODN') order by row_id";
//echo $sql06;
$query06 = mysql_query($sql06)or die("Query failed sql06");
$num06=mysql_num_rows($query06);
if($num06 < 1){
	echo "<tr><td colspan='6' align='center'>--------------------------- ไม่มีรายการค่ารักษาพยาบาล ---------------------------</td></tr>";
}else{	
$i=0;
$total06=0;
while($result06 = mysql_fetch_array($query06)){
$i++;	
$total06=$total06+$result06["price"];
?>
<tr>
<td width="5%" align="center" class="textcash"><?php echo $i;?></td>
<td width="15%" align="center" class="textcash"><?php echo $result06["date"];?></td>
<td width="7%" align="left" class="textcash"><?php echo $result06["code"];?></td>
<td width="53%" class="textcash"><?php echo $result06["detail"];?></td>
<td width="10%" align="center" class="textcash"><?php echo $result06["amount"];?></td>
<td width="10%" align="right" class="textcash"><?php echo number_format($result06["price"],2);?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="5" align="right">รวมทั้งสิ้น</td>
<td align="right"><?php echo number_format($total06,2);?></td>
</tr>
<?php
}
?>
</table>


<div style="font-weight:bold; margin-top:20px;">07 :  ค่าตรวจวินิจฉัยทางเทคนิคการแพทย์และพยาธิวิทยา</div>	
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="textcash" style="border-collapse:collapse">
<tr>
<td width="5%" align="center" class="textcash"><strong>ลำดับ</strong></td>
<td width="15%" align="center" class="textcash"><strong>วัน/เดือน/ปี</strong></td>
<td width="7%" align="center" class="textcash"><strong>รหัส</strong></td>
<td width="53%" align="center" class="textcash"><strong>รายการ</strong></td>
<td width="10%" align="center" class="textcash"><strong>จำนวน</strong></td>
<td width="10%" align="center" class="textcash"><strong>ราคา</strong></td>
</tr>
<?php
$sql07 = "SELECT * FROM tmp_ipacc WHERE an = '$an' && (part='LAB' || part='LABY' || part='LABN') order by row_id";
//echo $sql07;
$query07 = mysql_query($sql07)or die("Query failed sql07");
$num07=mysql_num_rows($query07);
if($num07 < 1){
	echo "<tr><td colspan='6' align='center'>--------------------------- ไม่มีรายการค่ารักษาพยาบาล ---------------------------</td></tr>";
}else{	
$i=0;
$total07=0;
while($result07 = mysql_fetch_array($query07)){
$i++;	
$total07=$total07+$result07["price"];
?>
<tr>
<td width="5%" align="center" class="textcash"><?php echo $i;?></td>
<td width="15%" align="center" class="textcash"><?php echo $result07["date"];?></td>
<td width="7%" align="left" class="textcash"><?php echo $result07["code"];?></td>
<td width="53%" class="textcash"><?php echo $result07["detail"];?></td>
<td width="10%" align="center" class="textcash"><?php echo $result07["amount"];?></td>
<td width="10%" align="right" class="textcash"><?php echo number_format($result07["price"],2);?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="5" align="right">รวมทั้งสิ้น</td>
<td align="right"><?php echo number_format($total07,2);?></td>
</tr>
<?php
}
?>
</table>


<div style="font-weight:bold; margin-top:20px;">08 :  ค่าตรวจวินิจฉัยและรักษาทางรังสีวิทยา</div>	
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="textcash" style="border-collapse:collapse">
<tr>
<td width="5%" align="center" class="textcash"><strong>ลำดับ</strong></td>
<td width="15%" align="center" class="textcash"><strong>วัน/เดือน/ปี</strong></td>
<td width="7%" align="center" class="textcash"><strong>รหัส</strong></td>
<td width="53%" align="center" class="textcash"><strong>รายการ</strong></td>
<td width="10%" align="center" class="textcash"><strong>จำนวน</strong></td>
<td width="10%" align="center" class="textcash"><strong>ราคา</strong></td>
</tr>
<?php
$sql08 = "SELECT * FROM tmp_ipacc WHERE an = '$an' && (part='XRAY' || part='XRAYY' || part='XRAYN') order by row_id";
//echo $sql08;
$query08 = mysql_query($sql08)or die("Query failed sql08");
$num08=mysql_num_rows($query08);
if($num08 < 1){
	echo "<tr><td colspan='6' align='center'>--------------------------- ไม่มีรายการค่ารักษาพยาบาล ---------------------------</td></tr>";
}else{	
$i=0;
$total08=0;
while($result08 = mysql_fetch_array($query08)){
$i++;	
$total08=$total08+$result08["price"];
?>
<tr>
<td width="5%" align="center" class="textcash"><?php echo $i;?></td>
<td width="15%" align="center" class="textcash"><?php echo $result08["date"];?></td>
<td width="7%" align="left" class="textcash"><?php echo $result08["code"];?></td>
<td width="53%" class="textcash"><?php echo $result08["detail"];?></td>
<td width="10%" align="center" class="textcash"><?php echo $result08["amount"];?></td>
<td width="10%" align="right" class="textcash"><?php echo number_format($result08["price"],2);?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="5" align="right">รวมทั้งสิ้น</td>
<td align="right"><?php echo number_format($total08,2);?></td>
</tr>
<?php
}
?>
</table>


<div style="font-weight:bold; margin-top:20px;">09 :  ค่าตรวจวินิจฉัยโดยวิธีพิเศษอื่นๆ</div>	
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="textcash" style="border-collapse:collapse">
<tr>
<td width="5%" align="center" class="textcash"><strong>ลำดับ</strong></td>
<td width="15%" align="center" class="textcash"><strong>วัน/เดือน/ปี</strong></td>
<td width="7%" align="center" class="textcash"><strong>รหัส</strong></td>
<td width="53%" align="center" class="textcash"><strong>รายการ</strong></td>
<td width="10%" align="center" class="textcash"><strong>จำนวน</strong></td>
<td width="10%" align="center" class="textcash"><strong>ราคา</strong></td>
</tr>
<?php
$sql09 = "SELECT * FROM tmp_ipacc WHERE an = '$an' && (part='SINV' || part='SINVY' || part='SINVN') order by row_id";
//echo $sql09;
$query09 = mysql_query($sql09)or die("Query failed sql09");
$num09=mysql_num_rows($query09);
if($num09 < 1){
	echo "<tr><td colspan='6' align='center'>--------------------------- ไม่มีรายการค่ารักษาพยาบาล ---------------------------</td></tr>";
}else{	
$i=0;
$total09=0;
while($result09 = mysql_fetch_array($query09)){
$i++;	
$total09=$total09+$result09["price"];
?>
<tr>
<td width="5%" align="center" class="textcash"><?php echo $i;?></td>
<td width="15%" align="center" class="textcash"><?php echo $result09["date"];?></td>
<td width="7%" align="left" class="textcash"><?php echo $result09["code"];?></td>
<td width="53%" class="textcash"><?php echo $result09["detail"];?></td>
<td width="10%" align="center" class="textcash"><?php echo $result09["amount"];?></td>
<td width="10%" align="right" class="textcash"><?php echo number_format($result09["price"],2);?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="5" align="right">รวมทั้งสิ้น</td>
<td align="right"><?php echo number_format($total09,2);?></td>
</tr>
<?php
}
?>
</table>


<div style="font-weight:bold; margin-top:20px;">10 :  ค่าอุปกรณ์ของใช้และเครื่องมือทางการแพทย์</div>	
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="textcash" style="border-collapse:collapse">
<tr>
<td width="5%" align="center" class="textcash"><strong>ลำดับ</strong></td>
<td width="15%" align="center" class="textcash"><strong>วัน/เดือน/ปี</strong></td>
<td width="7%" align="center" class="textcash"><strong>รหัส</strong></td>
<td width="53%" align="center" class="textcash"><strong>รายการ</strong></td>
<td width="10%" align="center" class="textcash"><strong>จำนวน</strong></td>
<td width="10%" align="center" class="textcash"><strong>ราคา</strong></td>
</tr>
<?php
$sql10 = "SELECT * FROM tmp_ipacc WHERE an = '$an' && (part='TOOL' || part='TOOLY' || part='TOOLN') order by row_id";
//echo $sql10;
$query10 = mysql_query($sql10)or die("Query failed sql10");
$num10=mysql_num_rows($query10);
if($num10 < 1){
	echo "<tr><td colspan='6' align='center'>--------------------------- ไม่มีรายการค่ารักษาพยาบาล ---------------------------</td></tr>";
}else{	
$i=0;
$total10=0;
while($result10 = mysql_fetch_array($query10)){
$i++;	
$total10=$total10+$result10["price"];
?>
<tr>
<td width="5%" align="center" class="textcash"><?php echo $i;?></td>
<td width="15%" align="center" class="textcash"><?php echo $result10["date"];?></td>
<td width="7%" align="left" class="textcash"><?php echo $result10["code"];?></td>
<td width="53%" class="textcash"><?php echo $result10["detail"];?></td>
<td width="10%" align="center" class="textcash"><?php echo $result10["amount"];?></td>
<td width="10%" align="right" class="textcash"><?php echo number_format($result10["price"],2);?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="5" align="right">รวมทั้งสิ้น</td>
<td align="right"><?php echo number_format($total10,2);?></td>
</tr>
<?php
}
?>
</table>


<div style="font-weight:bold; margin-top:20px;">11 :  ค่าผ่าตัด ทำคลอด ทำหัตถการและบริการวิสัญญี</div>	
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="textcash" style="border-collapse:collapse">
<tr>
<td width="5%" align="center" class="textcash"><strong>ลำดับ</strong></td>
<td width="15%" align="center" class="textcash"><strong>วัน/เดือน/ปี</strong></td>
<td width="7%" align="center" class="textcash"><strong>รหัส</strong></td>
<td width="53%" align="center" class="textcash"><strong>รายการ</strong></td>
<td width="10%" align="center" class="textcash"><strong>จำนวน</strong></td>
<td width="10%" align="center" class="textcash"><strong>ราคา</strong></td>
</tr>
<?php
$sql11 = "SELECT * FROM tmp_ipacc WHERE an = '$an' && (part='SURG' || part='SURGY' || part='SURGN') order by row_id";
//echo $sql11;
$query11 = mysql_query($sql11)or die("Query failed sql11");
$num11=mysql_num_rows($query11);
if($num11 < 1){
	echo "<tr><td colspan='6' align='center'>--------------------------- ไม่มีรายการค่ารักษาพยาบาล ---------------------------</td></tr>";
}else{	
$i=0;
$total11=0;
while($result11 = mysql_fetch_array($query11)){
$i++;	
$total11=$total11+$result11["price"];
?>
<tr>
<td width="5%" align="center" class="textcash"><?php echo $i;?></td>
<td width="15%" align="center" class="textcash"><?php echo $result11["date"];?></td>
<td width="7%" align="left" class="textcash"><?php echo $result11["code"];?></td>
<td width="53%" class="textcash"><?php echo $result11["detail"];?></td>
<td width="10%" align="center" class="textcash"><?php echo $result11["amount"];?></td>
<td width="10%" align="right" class="textcash"><?php echo number_format($result11["price"],2);?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="5" align="right">รวมทั้งสิ้น</td>
<td align="right"><?php echo number_format($total11,2);?></td>
</tr>
<?php
}
?>
</table>


<div style="font-weight:bold; margin-top:20px;">12 :  ค่าบริการทางการพยาบาลทั่วไป</div>	
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="textcash" style="border-collapse:collapse">
<tr>
<td width="5%" align="center" class="textcash"><strong>ลำดับ</strong></td>
<td width="15%" align="center" class="textcash"><strong>วัน/เดือน/ปี</strong></td>
<td width="7%" align="center" class="textcash"><strong>รหัส</strong></td>
<td width="53%" align="center" class="textcash"><strong>รายการ</strong></td>
<td width="10%" align="center" class="textcash"><strong>จำนวน</strong></td>
<td width="10%" align="center" class="textcash"><strong>ราคา</strong></td>
</tr>
<?php
$sql12 = "SELECT * FROM tmp_ipacc WHERE an = '$an' && (part='NCARE' || part='NCAREY' || part='NCAREN') order by row_id";
//echo $sql12;
$query12 = mysql_query($sql12)or die("Query failed sql12");
$num12=mysql_num_rows($query12);
if($num12 < 1){
	echo "<tr><td colspan='6' align='center'>--------------------------- ไม่มีรายการค่ารักษาพยาบาล ---------------------------</td></tr>";
}else{	
$i=0;
$total12=0;
while($result12 = mysql_fetch_array($query12)){
$i++;	
$total12=$total12+$result12["price"];
?>
<tr>
<td width="5%" align="center" class="textcash"><?php echo $i;?></td>
<td width="15%" align="center" class="textcash"><?php echo $result12["date"];?></td>
<td width="7%" align="left" class="textcash"><?php echo $result12["code"];?></td>
<td width="53%" class="textcash"><?php echo $result12["detail"];?></td>
<td width="10%" align="center" class="textcash"><?php echo $result12["amount"];?></td>
<td width="10%" align="right" class="textcash"><?php echo number_format($result12["price"],2);?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="5" align="right">รวมทั้งสิ้น</td>
<td align="right"><?php echo number_format($total12,2);?></td>
</tr>
<?php
}
?>
</table>


<div style="font-weight:bold; margin-top:20px;">13 :  ค่าบริการทางทันตกรรม</div>	
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="textcash" style="border-collapse:collapse">
<tr>
<td width="5%" align="center" class="textcash"><strong>ลำดับ</strong></td>
<td width="15%" align="center" class="textcash"><strong>วัน/เดือน/ปี</strong></td>
<td width="7%" align="center" class="textcash"><strong>รหัส</strong></td>
<td width="53%" align="center" class="textcash"><strong>รายการ</strong></td>
<td width="10%" align="center" class="textcash"><strong>จำนวน</strong></td>
<td width="10%" align="center" class="textcash"><strong>ราคา</strong></td>
</tr>
<?php
$sql13 = "SELECT * FROM tmp_ipacc WHERE an = '$an' && (part='DENTA' || part='DENTAY' || part='DENTAN') order by row_id";
//echo $sql13;
$query13 = mysql_query($sql13)or die("Query failed sql13");
$num13=mysql_num_rows($query13);
if($num13 < 1){
	echo "<tr><td colspan='6' align='center'>--------------------------- ไม่มีรายการค่ารักษาพยาบาล ---------------------------</td></tr>";
}else{	
$i=0;
$total13=0;
while($result13 = mysql_fetch_array($query13)){
$i++;	
$total13=$total13+$result13["price"];
?>
<tr>
<td width="5%" align="center" class="textcash"><?php echo $i;?></td>
<td width="15%" align="center" class="textcash"><?php echo $result13["date"];?></td>
<td width="7%" align="left" class="textcash"><?php echo $result13["code"];?></td>
<td width="53%" class="textcash"><?php echo $result13["detail"];?></td>
<td width="10%" align="center" class="textcash"><?php echo $result13["amount"];?></td>
<td width="10%" align="right" class="textcash"><?php echo number_format($result13["price"],2);?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="5" align="right">รวมทั้งสิ้น</td>
<td align="right"><?php echo number_format($total13,2);?></td>
</tr>
<?php
}
?>
</table>


<div style="font-weight:bold; margin-top:20px;">14 :  ค่าบริการทางกายภาพบำบัดและเวชกรรมฟื้นฟู</div>	
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="textcash" style="border-collapse:collapse">
<tr>
<td width="5%" align="center" class="textcash"><strong>ลำดับ</strong></td>
<td width="15%" align="center" class="textcash"><strong>วัน/เดือน/ปี</strong></td>
<td width="7%" align="center" class="textcash"><strong>รหัส</strong></td>
<td width="53%" align="center" class="textcash"><strong>รายการ</strong></td>
<td width="10%" align="center" class="textcash"><strong>จำนวน</strong></td>
<td width="10%" align="center" class="textcash"><strong>ราคา</strong></td>
</tr>
<?php
$sql14 = "SELECT * FROM tmp_ipacc WHERE an = '$an' && (part='PT' || part='PTY' || part='PTN') order by row_id";
//echo $sql14;
$query14 = mysql_query($sql14)or die("Query failed sql14");
$num14=mysql_num_rows($query14);
if($num14 < 1){
	echo "<tr><td colspan='6' align='center'>--------------------------- ไม่มีรายการค่ารักษาพยาบาล ---------------------------</td></tr>";
}else{	
$i=0;
$total14=0;
while($result14 = mysql_fetch_array($query14)){
$i++;	
$total14=$total14+$result14["price"];
?>
<tr>
<td width="5%" align="center" class="textcash"><?php echo $i;?></td>
<td width="15%" align="center" class="textcash"><?php echo $result14["date"];?></td>
<td width="7%" align="left" class="textcash"><?php echo $result14["code"];?></td>
<td width="53%" class="textcash"><?php echo $result14["detail"];?></td>
<td width="10%" align="center" class="textcash"><?php echo $result14["amount"];?></td>
<td width="10%" align="right" class="textcash"><?php echo number_format($result14["price"],2);?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="5" align="right">รวมทั้งสิ้น</td>
<td align="right"><?php echo number_format($total14,2);?></td>
</tr>
<?php
}
?>
</table>


<div style="font-weight:bold; margin-top:20px;">15 :  ค่าบริการฝังเข็ม/การบำบัดของผู้ประกอบโรคศิลปะอื่นๆ</div>	
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="textcash" style="border-collapse:collapse">
<tr>
<td width="5%" align="center" class="textcash"><strong>ลำดับ</strong></td>
<td width="15%" align="center" class="textcash"><strong>วัน/เดือน/ปี</strong></td>
<td width="7%" align="center" class="textcash"><strong>รหัส</strong></td>
<td width="53%" align="center" class="textcash"><strong>รายการ</strong></td>
<td width="10%" align="center" class="textcash"><strong>จำนวน</strong></td>
<td width="10%" align="center" class="textcash"><strong>ราคา</strong></td>
</tr>
<?php
$sql15 = "SELECT * FROM tmp_ipacc WHERE an = '$an' && (part='STX' || part='STXY' || part='STXN') order by row_id";
//echo $sql15;
$query15 = mysql_query($sql15)or die("Query failed sql15");
$num15=mysql_num_rows($query15);
if($num15 < 1){
	echo "<tr><td colspan='6' align='center'>--------------------------- ไม่มีรายการค่ารักษาพยาบาล ---------------------------</td></tr>";
}else{	
$i=0;
$total15=0;
while($result15 = mysql_fetch_array($query15)){
$i++;	
$total15=$total15+$result15["price"];
?>
<tr>
<td width="5%" align="center" class="textcash"><?php echo $i;?></td>
<td width="15%" align="center" class="textcash"><?php echo $result15["date"];?></td>
<td width="7%" align="left" class="textcash"><?php echo $result15["code"];?></td>
<td width="53%" class="textcash"><?php echo $result15["detail"];?></td>
<td width="10%" align="center" class="textcash"><?php echo $result15["amount"];?></td>
<td width="10%" align="right" class="textcash"><?php echo number_format($result15["price"],2);?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="5" align="right">รวมทั้งสิ้น</td>
<td align="right"><?php echo number_format($total15,2);?></td>
</tr>
<?php
}
?>
</table>


<div style="font-weight:bold; margin-top:20px;">16 :  ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา</div>	
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="textcash" style="border-collapse:collapse">
<tr>
<td width="5%" align="center" class="textcash"><strong>ลำดับ</strong></td>
<td width="15%" align="center" class="textcash"><strong>วัน/เดือน/ปี</strong></td>
<td width="7%" align="center" class="textcash"><strong>รหัส</strong></td>
<td width="53%" align="center" class="textcash"><strong>รายการ</strong></td>
<td width="10%" align="center" class="textcash"><strong>จำนวน</strong></td>
<td width="10%" align="center" class="textcash"><strong>ราคา</strong></td>
</tr>
<?php
$sql16 = "SELECT * FROM tmp_ipacc WHERE an = '$an' && (part='MC' || part='MCY' || part='MCN') order by row_id";
//echo $sql16;
$query16 = mysql_query($sql16)or die("Query failed sql16");
$num16=mysql_num_rows($query16);
if($num16 < 1){
	echo "<tr><td colspan='6' align='center'>--------------------------- ไม่มีรายการค่ารักษาพยาบาล ---------------------------</td></tr>";
}else{	
$i=0;
$total16=0;
while($result16 = mysql_fetch_array($query16)){
$i++;	
$total16=$total16+$result16["price"];
?>
<tr>
<td width="5%" align="center" class="textcash"><?php echo $i;?></td>
<td width="15%" align="center" class="textcash"><?php echo $result16["date"];?></td>
<td width="7%" align="left" class="textcash"><?php echo $result16["code"];?></td>
<td width="53%" class="textcash"><?php echo $result16["detail"];?></td>
<td width="10%" align="center" class="textcash"><?php echo $result16["amount"];?></td>
<td width="10%" align="right" class="textcash"><?php echo number_format($result16["price"],2);?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="5" align="right">รวมทั้งสิ้น</td>
<td align="right"><?php echo number_format($total16,2);?></td>
</tr>
<?php
}
?>
</table>

<?php	
}	
?>