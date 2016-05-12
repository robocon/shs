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
}.forntsarabun2 {
	font-family: "TH SarabunPSK";
	font-size: 22PX;
	font-weight:bold;
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
  <table  border="0" align="center">
    <tr class="forntsarabun2">
      <td colspan="2" align="center" bgcolor="#CCCCCC">สถิติงานนวดแผนไทย ผู้นวดแต่ละคน</td>
    </tr>
    <tr>
      <td colspan="2" align="center">&nbsp;</td>
    </tr>
    <tr bordercolor="#666666" class="forntsarabun">
      <td  align="right"><span class="forntsarabun">ตั้งแต่ -วัน/ เดือน/ปี</span></td>
      <td ><input name="d_start1" type="text"  class="forntsarabun" id="d_start1" value="01" size="5"/>
        <? $m=date('m'); ?>
        <select name="m_start1" class="forntsarabun" id="m_start1">
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
				echo "<select name='y_start1' class='forntsarabun'>";
				foreach($dates as $i){
				?>
        <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
          <?=$i;?>
          </option>
        <?
				}
				echo "<select>";
				?></td>
    </tr>
    <tr bordercolor="#666666" class="forntsarabun">
      <td  align="right">ถึง  -วัน/ เดือน/ปี</td>
      <? $calday = cal_days_in_month(CAL_GREGORIAN , date('m'), date("Y")+543);?>
      <td ><input name="d_start2" type="text"  class="forntsarabun" id="d_start2" value="<?=$calday;?>" size="5"/>
        <? $m=date('m'); ?>
        <select name="m_start2" class="forntsarabun" id="m_start2">
          <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
          <option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
          <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
          <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
          <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
          <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
          <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
          <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
          <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
          <option value="10" <? if($m=='10'){ echo "selected"; }?> >ตุลาคม</option>
          <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
          <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
        </select>
        <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start2' class='forntsarabun'>";
				foreach($dates as $i){
				?>
        <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
          <?=$i;?>
          </option>
        <?
				}
				echo "<select>";
				?></td>
    </tr>
    <tr bordercolor="#666666" class="forntsarabun">
      <td  align="right">ผู้นวด</td>
      <td >
        <select name="staf_massage" class="forntsarabun" id="staf_massage">
          <option value="">--เลือก--</option>
          <?
		  include("../connect.inc");
		   $sql_staf="SELECT * FROM `staf_massage` Order by row_id asc";
		  		$query_staf=mysql_query($sql_staf);
				while($arr_staf=mysql_fetch_array($query_staf)){
		  ?>
          <option value="<?=$arr_staf['name'];?>"><?=$arr_staf['name'];?></option>
    <? } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td><a target="_self"  href='../../nindex.htm' class="forntsarabun2">ไปเมนู</a></td>
      <td><input name="button" type="submit" class="forntsarabun2" id="button" value="ตกลง" />
        <span class="forntsarabun">*แนะนำให้ออกรายงานเป็น แนวนอนครับ</span></td>
    </tr>
  </table>
</form>
<br />
</div>

<?
if($_POST['button']){

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

include("../connect.inc");


$y1=$_POST['y_start1'];
$y2=$_POST['y_start2'];
$date1=$y1.'-'.$_POST['m_start1'].'-'.$_POST['d_start1'].' '."00:00:00";
$date2=$y2.'-'.$_POST['m_start2'].'-'.$_POST['d_start2'].' '."23:59:59";
	
$staf_massage=$_POST['staf_massage'];


print "<div align=\"center\" class=\"forntsarabun\">สถิติงานแพทย์แผนไทย   ตั้งแต่  $date1   ถึง  $date2</div>";
print "<div align=\"center\" class=\"forntsarabun\">ผู้นวด $staf_massage</div>";



$query = "SELECT b.date, b.ptname, b.hn, b.an, b.depart, b.detail, b.price, b.paid, b.row_id, b.accno, b.tvn ,b.staf_massage,b.diag,b.ptright FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008','58101','58102','58130','58131','58201','58301','58301a')) AND (b.date between '$date1' and '$date2' ) and  a.status='Y' and a.price >0  and staf_massage='$staf_massage' Group by b.date ,b.hn,a.code";
$result = mysql_query($query) or die("Query failed ".$query."");

//echo $query;
?>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-color:#000;" class="forntsarabun">
  <tr bgcolor="#CCCCCC">
    <td align="center">ลำดับ</td>
    <td align="center">วันที่</td>
    <td align="center">ชื่อ-สกุล ผู้รับบริการ</td>
    <td align="center">เพศ</td>
    <td align="center">HN</td>
    <td align="center">ชื่อ-สกุล พนักงาน</td>
    <td align="center">การวินิจฉัยโรค</td>
    <td align="center">สิทธิการรักษา</td>
    <td align="center">หมายเหตุ</td>
  </tr>
 <?   
 $i=1;
 $r=0;
 while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$tvn,$staf_massage,$diag,$ptright) = mysql_fetch_row ($result)) {
	 
	 $sql = "SELECT sex  FROM `opcard` WHERE  hn='".$hn."' ";
	 $query = mysql_query($sql) or die("Query failed ".$sql."");
	 $arr=mysql_fetch_array($query);
	 
	 if($arr['sex']=='ช' || $arr['sex']=='1'){
		$sex= "ชาย"; 
		
		$nsex++;
	 }else if($arr['sex']=='ญ' || $arr['sex']=='2'){
		$sex= "หญิง"; 
		$nsex2++;
	 }
		 
$r++;
  	  if($r=='21'){
$r=1;


echo "<table width='100%' border='0' class='forntsarabun'>
  <tr>
    <td><b><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้บันทึก</td>
    <td align='center'>&nbsp;</td>
  </tr>
  <tr>
    <td align='center'>( ........................................................................)</td>
    <td align='center'>( ........................................................................)</td>
  </tr>
  <tr>
    <td align='center'>แพทย์แผนไทย</td>
    <td align='center'>หัวหน้าแผนกแพทย์ทางเลือก</td>
  </tr>
  <tr>
    <td align='center'>................/................../................../</td>
    <td align='center'>................/................../................../</td>
  </tr>
</table>";
		echo "</table>";
		
		//echo "<div style='page-break-after: always'> ";
		echo "<div style='page-break-before: always'> ";
		
print "<div align=\"center\" class=\"forntsarabun\">สถิติงานแพทย์แผนไทย   ตั้งแต่  $date1   ถึง  $date2</div>";
print "<div align=\"center\" class=\"forntsarabun\">ผู้นวด $staf_massage</div>";	

		echo "<table width='100%' border='1' align='center' cellpadding='0' cellspacing='0' style='border-collapse:collapse; border-color:#000;' class='forntsarabun'>
  <tr bgcolor='#CCCCCC'>
    <td align='center'>ลำดับ</td>
    <td align='center'>วันที่</td>
    <td align='center'>ชื่อ-สกุล ผู้รับบริการ</td>
    <td align='center'>เพศ</td>
    <td align='center'>HN</td>
    <td align='center'>ชื่อ-สกุล พนักงาน</td>
    <td align='center'>การวินิจฉัยโรค</td>
    <td align='center'>สิทธิการรักษา</td>
    <td align='center'>หมายเหตุ</td>
  </tr>";
?>


<? } ?>


  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$date;?></td>
    <td><?=$ptname;?></td>
    <td><?=$sex?></td>
    <td><?=$hn;?></td>
    <td><?=$staf_massage;?></td>
    <td><?=$diag;?></td>
    <td><?=$ptright;?></td>
    <td>&nbsp;</td>
  </tr>
  <? 	
  $i++;
  }
  echo "</div>";
/*  print "เพศชาย  ".$nsex." คน <BR>"; 
  print "เพศหญิง  ".$nsex2." คน"; */
  ?>
</table>
<BR />
<p>
<table width="100%" border="0" class="forntsarabun">
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้บันทึก</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">( ........................................................................)</td>
    <td align="center">( ........................................................................)</td>
  </tr>
  <tr>
    <td align="center">แพทย์แผนไทย</td>
    <td align="center">หัวหน้างานแพทย์แผนไทย</td>
  </tr>
  <tr>
    <td align="center">................/................../................../</td>
    <td align="center">................/................../................../</td>
  </tr>
</table>

</p>

<? } ?>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>