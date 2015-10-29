<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>ระบบรายงานเหตุการณ์สำคัญ/อุบัติการณ์/ความไม่สอดคล้อง</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<body>

<style type="text/css">
* { margin:0;
    padding:0;
}
ody { /*background:rgb(74,81,85); */}
div#menu { margin:5px auto; }
div#copyright {
    font:11px 'Trebuchet MS';
    color:#fff;
    text-indent:30px;
    padding:40px 0 0 0;
}
td,th {
	font-family:"TH SarabunPSK";
	font-size: 20 px;
}
.fontsara {
	font-family:"TH SarabunPSK";
	font-size: 18 px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 

/*div#copyright a { color:#00bfff; }
div#copyright a:hover { color:#fff; }*/
</style>
<div id="no_print">
<div id="menu">
  <ul class="menu">
        <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>โปรแกรมโรงพยาบาล</span></a></li>
        <li><a href="report_massage_diag.php" class="parent"><span>สถิติงานนวดแผนไทย</span></a></li>
     	
         <li><a href="#"><span>รายงานนวดแผนไทย</span></a></li>
     
     <ul>
	  	<li class="last"><a href="report_massage.php"><span>ทั้งหมด</span></a></li>
	  	<li class="last"><a href="report_staf_massage.php"><span>แยกตาม ผู้นวดแต่ละคน</span></a></li>
          	<li class="last"><a href="report_massage_emg.php"><span>เฉพาะ EMG</span></a></li>
            <li class="last"><a href="report_massage_foot.php"><span>นวดผ่าเท้า</span></a></li>
        
       	</ul>
    </ul>
</div>

<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<div id="no_print">
<form id="form1" name="form1" method="post" action="">
  <table  border="0" align="center"  >
    <tr>
      <td colspan="2" align="center" bgcolor="#CCCCCC">สถิติงานนวดแผนไทย</td>
    </tr>
    <tr>
      <td colspan="2" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td>วัน/เดือน/ปี</td>
      <td><select name='d_start' class="font1">
        <option value="" selected="selected">--ไม่เลือก---</option>
        <? 
				//$dd=date("d");
				for($d=1;$d<=31;$d++){
					
					if($d<=9){
						$d="0".$d;	
					}
					//if($dd==$d){
					?>
        <option value="<?=$d;?>"> <?=$d;?></option>
        <?
				//	}else{
				?>
    <!--    <option value="<?//=$d;?>"> <?//=$d;?> </option>-->
        <?
				//}
				}
				
				?>
      </select>
        <? $m=date('m'); ?>
        <select name="m_start" class="font1">
          <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
          <option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
          <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
          <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
          <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
          <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
          <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
          <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
          <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
          <option value="10" <? if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
          <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
          <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
        </select>
        <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='font1'>";
				foreach($dates as $i){
				?>
        <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
          <?=$i;?>
        </option>
        <?
				}
				echo "</select>";
				?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="ตกลง" /></td>
    </tr>
  </table>
</form>
<br />
</div>

<?php
 if(isset($_POST["button"])){
	include("../connect.inc");

switch($_POST['m_start']){
		case "01": $printmonth = "มกราคม"; break;
		case "02": $printmonth = "กุมภาพันธ์"; break;
		case "03": $printmonth = "มีนาคม"; break;
		case "04": $printmonth = "เมษายน"; break;
		case "05": $printmonth = "พฤษภาคม"; break;
		case "06": $printmonth = "มิถุนายน"; break;
		case "07": $printmonth = "กรกฏาคม"; break;
		case "08": $printmonth = "สิงหาคม"; break;
		case "09": $printmonth = "กันยายน"; break;
		case "10": $printmonth = "ตุลาคม"; break;
		case "11": $printmonth = "พฤศจิกายน"; break;
		case "12": $printmonth = "ธันวาคม"; break;
	}

if($_POST['d_start']==''){
	
$today=$_POST['y_start'].'-'.$_POST['m_start'];
$sh="ประจำเดือน";
$shtodate=($_POST['y_start']-543).'-'.$_POST['m_start'];
$dateshow=$printmonth." ".$_POST['y_start'];

}else{
	
$today=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];
$sh="ประจำวันที่ ";	
$dateshow=$_POST['d_start']." ".$printmonth." ".$_POST['y_start'];
	
$shtodate=($_POST['y_start']-543).'-'.$_POST['m_start'].'-'.$_POST['d_start'];
}
	

	$sql = "SELECT count(*)as count FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008')) AND b.date LIKE '".$today."%'  and  a.status='Y' and a.price >0 ";
	$result = Mysql_Query($sql);
	list($sum) = Mysql_fetch_row($result);


print "<div align=\"center\" class=\"forntsarabun\">สถิติงานแพทย์แผนไทย  $sh  $dateshow</div><BR>";
?>

<TABLE class="forntsarabun">
<TR>
	<TD colspan="2" bgcolor="#CCCCCC">จำนวนผู้ป่วยที่มาตรวจ  <?php echo $dateshow;?> ทั้งหมด <?php echo $sum;?> คน</TD>
</TR>
<TR>
	<TD colspan="2" bgcolor="#CCCCCC">จำนวนโรคที่ผู้ป่วยมาตรวจ (ครั้ง)</TD>
</TR>
<?php 
$sql = "SELECT b.diag,count(b.hn) as cc FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008')) AND b.date LIKE '".$today."%'  and  a.status='Y' and a.price >0  Group by b.diag Order by cc DESC";
	
$result = Mysql_Query($sql);
$sum=0;
while(list($diag,$count) = Mysql_fetch_row($result)){
?>
<TR>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $diag;?></TD>
	<TD><?php echo $count; $sum = $sum+$count;?></TD>
</TR>
<?php }?>

<TR>
	<TD bgcolor="#CCCCCC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รวม</TD>
	<TD bgcolor="#CCCCCC"><?php echo $sum;?></TD>
</TR>

</TABLE> 

<?php
}
?>
 <br /> <br />
 <TABLE class="forntsarabun">
<TR>
	<TD colspan="2" bgcolor="#CCCCCC">สิทธิการรักษา</TD>
</TR>
<?php 
$sql2 = "SELECT b.ptright,count(b.hn) as cc FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008')) AND b.date LIKE '".$today."%'  and  a.status='Y' and a.price >0 Group by substring(b.ptright,1,3) Order by cc DESC";
	
$result2 = Mysql_Query($sql2);
$sum2=0;
while(list($ptright,$count2) = Mysql_fetch_row($result2)){
?>
<TR>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ptright;?></TD>
	<TD><?php echo $count2;?></TD>
</TR>
<?php 
$sum2+=$count2;
}

?>

<TR>
	<TD bgcolor="#CCCCCC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รวม</TD>
	<TD bgcolor="#CCCCCC"><?php echo $sum2;?></TD>
</TR>

</TABLE> 
<br />
<br />
<TABLE class="forntsarabun">
<TR>
	<TD colspan="2" align="center" bgcolor="#CCCCCC">เพศ</TD>
</TR>
<?php 
$sql2 = "SELECT  distinct(b.hn) FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008')) AND b.date LIKE '".$today."%'  and  a.status='Y' and a.price >0";
	
$result2 = Mysql_Query($sql2);
$sum2=0;
while(list($hn) = Mysql_fetch_row($result2)){
	
	$sqlsex = "SELECT sex  FROM `opcard` WHERE  hn='".$hn."' ";
	 $querysex = mysql_query($sqlsex) or die("Query failed ".$sqlsex."");
	 $arrsex=mysql_fetch_array($querysex);
	 
	 if($arrsex['sex']=='ช' || $arrsex['sex']=='1'){
		$sex= "ชาย"; 
		$nsex++;
	 }else if($arrsex['sex']=='ญ' || $arrsex['sex']=='2'){
		$sex= "หญิง"; 
		$nsex2++;
	 }
	 
}
?>
<TR>
	<TD>เพศชาย</TD>
	<TD><?php echo $nsex;?></TD>
</TR>
<TR>
  <TD>เพศหญิง</TD>
  <TD><?php echo $nsex2;?></TD>
</TR>
<?php 
$sum3=$nsex+$nsex2;


?>

<TR>
	<TD bgcolor="#CCCCCC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รวม</TD>
	<TD bgcolor="#CCCCCC"><?php echo $sum3;?></TD>
</TR>

</TABLE>
<br>
<div class="forntsarabun">*** จำนวน icd10 และ icd9cm *******</div><br>

<table width="50%" border="0">
  <tr>
    <td width="34%" valign="top"> <TABLE class="forntsarabun">
<TR>
	<TD colspan="2" align="center" bgcolor="#CCCCCC">ICD10</TD>
</TR>
<?php 
$sql2 = "SELECT  b.hn,b.date FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008')) AND b.date LIKE '".$today."%'  and  a.status='Y' and a.price >0";
	
 // echo $sql2;
$result2 = Mysql_Query($sql2);
$sum2=0;
$arricd10=array();
while(list($hn,$bdate) = Mysql_fetch_row($result2)){
	
$subdate=substr($bdate,0,10);
/*	$sqlicd10 = "SELECT count(icd10) ,icd10 FROM `opday` WHERE  hn='".$hn."' and icd10 !='' Group by icd10 ";
	$queryicd10 = mysql_query($sqlicd10) or die("Query failed ".$sqlicd10."");
	$arricd10=mysql_fetch_array($queryicd10);*/
	
$sqlicd="SELECT count(icd10)as counticd,icd10,icd9cm FROM `opday` WHERE thidate like '$subdate%' and hn='".$hn."'  ";
$objqueryicd  = mysql_query($sqlicd);
//echo $sqlicd;

//$arricd10=array();
	while (list($counticd,$icd10,$icd9cm) = mysql_fetch_row($objqueryicd)){
		array_push($arricd10,$icd10);
	}
}
//$sum33+=$counticd;
$ans = array_count_values($arricd10);
while(list($x,$xvalue) = each($ans)){
	//echo $x." ".$xvalue."<br>";

?>
<TR>
	<TD width="33"><?php echo $x;?></TD>
	<TD width="50" align="right"><?php echo $xvalue;?></TD>
</TR>
<? 
$sum33+=$xvalue;
}?>
<TR>
	<TD width="33" bgcolor="#CCCCCC">รวม</TD>
	<TD width="50" align="right" bgcolor="#CCCCCC"><?php echo $sum33;?></TD>
</TR>
</TABLE></td>
    <td width="66%" valign="top"><TABLE class="forntsarabun">
      <TR>
        <TD colspan="2" align="center" bgcolor="#CCCCCC">ICD9CM</TD>
      </TR>
      <?php 
$sql2 = "SELECT  b.hn,b.date FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008')) AND b.date LIKE '".$today."%'  and  a.status='Y' and a.price >0";
	
 // echo $sql2;
$result2 = Mysql_Query($sql2);
$sum2=0;
$arricd10=array();
while(list($hn,$bdate) = Mysql_fetch_row($result2)){
	
$subdate=substr($bdate,0,10);
/*	$sqlicd10 = "SELECT count(icd10) ,icd10 FROM `opday` WHERE  hn='".$hn."' and icd10 !='' Group by icd10 ";
	$queryicd10 = mysql_query($sqlicd10) or die("Query failed ".$sqlicd10."");
	$arricd10=mysql_fetch_array($queryicd10);*/
	
$sqlicd="SELECT count(icd10)as counticd,icd10,icd9cm FROM `opday` WHERE thidate like '$subdate%' and hn='".$hn."'  ";
$objqueryicd  = mysql_query($sqlicd);
//echo $sqlicd;

//$arricd10=array();
	while (list($counticd,$icd10,$icd9cm) = mysql_fetch_row($objqueryicd)){
		array_push($arricd10,$icd9cm);
	}
}
//$sum33+=$counticd;
$ans2 = array_count_values($arricd10);
while(list($x2,$xvalue2) = each($ans2)){
	//echo $x." ".$xvalue."<br>";

?>
      <TR>
        <TD width="33"><?php echo $x2;?></TD>
        <TD width="50" align="right"><?php echo $xvalue2;?></TD>
      </TR>
      <? 
$sum44+=$xvalue2;
}?>
      <TR>
        <TD width="33" bgcolor="#CCCCCC">รวม</TD>
        <TD width="50" align="right" bgcolor="#CCCCCC"><?php echo $sum44;?></TD>
      </TR>
    </TABLE>
    * ช่องว่าง=ไม่มีการลงรหัส</td>
  </tr>
</table>


<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>