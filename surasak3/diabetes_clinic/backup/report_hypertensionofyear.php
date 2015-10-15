<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Clinic hypertension</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script> 
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:20pt;
}
.table_font1{
	font-family:"TH SarabunPSK";
	font-size:18pt;
	font-weight:bold;
	color:#600;	
}
.table_font2{
	font-family:"TH SarabunPSK";
	font-size:18pt;
}
legend{
	
font-family:"TH SarabunPSK";
font-size: 18pt;
font-weight: bold;
color:#600;	
padding:0px 3px;
}
fieldset{
display:inline;
background-color:#FEFDDE;
/*width:300px;*/
border-color:#000;

}
</style>

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
<body>


<div id="no_print">
<div id="menu">
  <ul class="menu">
        <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>โปรแกรมโรงพยาบาล</span></a></li>
         <li><a href="#"><span>ลงทะเบียน</span></a></li>
          <ul>
		 <li class="last"><a href="diabetes.php"><span>ลงทะเบียน DM</span></a></li>
         <li class="last"><a href="hypertension.php"><span>ลงทะเบียน HT</span></a></li>
       	</ul>
     	  <li><a href="diabetes_edit.php"><span>แก้ไขข้อมูล</span></a></li>
           <ul>
		 <li class="last"><a href="diabetes_edit.php"><span>แก้ไขข้อมูล DM</span></a></li>
         <li class="last"><a href="hypertension_edit.php"><span>แก้ไขข้อมูล HT</span></a></li>
       	</ul>
         <li><a href="#"><span>รายชื่อผู้ป่วย DM</span></a></li>
         <ul>
		 <li class="last"><a href="diabetes_list.php"><span>รายชื่อทั้งหมด</span></a></li>
         <li class="last"><a href="diabetes_list_so.php"><span>รายชื่อ ทหาร/ครอบครัว</span></a></li>
       	</ul>
       <li><a href="#"><span>รายชื่อผู้ป่วย HT</span></a></li>
         <ul>
		 <li class="last"><a href="hypertension_list.php"><span>รายชื่อทั้งหมด</span></a></li>
         <li class="last"><a href="hypertension_list_so.php"><span>รายชื่อ ทหาร/ครอบครัว</span></a></li>
       	</ul>
     <li><a href="report_diabetes.php"><span>สถิติ</span></a></li>
 		<ul>
		 <li class="last"><a href="report_diabetes.php"><span>สถิติ DM</span></a></li>
         <li class="last"><a href="report_hypertension.php"><span>สถิติ HT</span></a></li>
       	</ul>
     <li><a href="#"><span>รายงาน</span></a></li>
 		<ul>
		 <li class="last"><a href="report_diabetesofyear.php"><span>รายงาน DM</span></a></li>
         <li class="last"><a href="report_hypertensionofyear.php"><span>รายงาน HT</span></a></li>
       	</ul>        
		<li><a href="history.php"><span>ค้นหาประวัติ</span></a></li>
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
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.forntsarabun1 {	font-family: "TH SarabunPSK";
	font-size: 18px;
}
@media print{
#no_print{display:none;}
}
-->
</style>
<?
include("../connect.php");
$d=date('d');
$m=date('m');
  	$startdate=$_POST["y_start"]."-".$_POST["m_start"]."-".$_POST["d_start"];
	$enddate=$_POST["y_end"]."-".$_POST["m_end"]."-".$_POST["d_end"];
	$showstart=$_POST["d_start"]."/".$_POST["m_start"]."/".$_POST["y_start"];
	$showend=$_POST["d_end"]."/".$_POST["m_end"]."/".$_POST["y_end"];
	$tbsql="SELECT * FROM `hypertension_clinic` WHERE thidate between '2015-07-01' and '2015-09-30' GROUP BY hn ORDER BY joint_disease DESC";
	//echo $tbsql;
	$tbquery=mysql_query($tbsql);
	$tbnum=mysql_num_rows($tbquery);
?> 
<p align="center"><strong>รายงานผู้ป่วย HT ห้วงระยะเวลาตั้งแต่วันที่ 1 เดือน กรกฎาคม พ.ศ. 2558 ถึงวันที่ 30 เดือน กันยายน พ.ศ. 2558 </strong></p>
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="16%" align="center" bgcolor="#66CC99"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="15%" align="center" bgcolor="#66CC99"><strong>สิทธิการรักษา</strong></td>
    <td width="18%" align="center" bgcolor="#66CC99"><strong>ประเภท</strong></td>
    <td width="18%" align="center" bgcolor="#66CC99"><strong>โรคร่วม HT </strong></td>
    <td width="14%" align="center" bgcolor="#66CC99"><strong>
    <div>มีโรคร่วม</div>
    <div>ความดันโลหิต 3 ครั้งสุดท้ายติดต่อกัน &lt; 130/80 mmHg.</div>
    </strong></td>
    <td width="14%" align="center" bgcolor="#66CC99"><strong>
    <div>ไม่มีโรคร่วม</div>
    <div>ความดันโลหิต 3 ครั้งสุดท้ายติดต่อกัน &lt; 140/90 mmHg.</div>
    </strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>ผป.มาตรวจตามนัด</strong></td>
  </tr>
  <?
	if($tbnum < 1){
		echo "<tr><td colspan='8' align='center' style='color:red;'>------------------------ ไม่มีข้อมูล ------------------------</td></tr>";
	}else{
		$i=0;
		while($tbrows=mysql_fetch_array($tbquery)){
		$i++;
		$sql=mysql_query("select idguard, camp from opcard where hn='".$tbrows["hn"]."'");
		list($idguard, $camp)=mysql_fetch_array($sql);
/*		if($camp=="M01 พลเรือน" && $idguard !="MX01 ทหาร/ครอบครัว"){
			$idguard="MX00 บุคคลทั่วไป";
		}*/
?>
  <tr>
    <td align="center" bgcolor="#CCFFCC"><?=$i;?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["hn"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["ptname"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["ptright"];?></td>  
    <td align="left" bgcolor="#CCFFCC"><?=$idguard;?></td>
    <td align="left" bgcolor="#CCFFCC">
	<?
	if($tbrows["joint_disease_dm"]=="Y" || $tbrows["joint_disease_nephritic"]=="Y" || $tbrows["joint_disease_myocardial"]=="Y" || $tbrows["joint_disease_paralysis"]=="Y"){
		echo "มีโรคร่วม (";
		if($tbrows["joint_disease_dm"]=="Y"){
			echo "เบาหวาน, ";
		}
		if($tbrows["joint_disease_nephritic"]=="Y"){
			echo "ไตเรื้อรัง, ";
		}
		if($tbrows["joint_disease_myocardial"]=="Y"){
			echo "กล้ามเนื้อหัวใจตาย, ";
		}
		if($tbrows["joint_disease_paralysis"]=="Y"){
			echo "อัมพฤกษ์อัมพาต";
		}				
		echo ")";
	}else{
		echo "ไม่มีโรคร่วม";
	}
	?>    </td>
    <td align="center" bgcolor="#CCFFCC">
	<?
	if($tbrows["joint_disease_dm"]=="Y" || $tbrows["joint_disease_nephritic"]=="Y" || $tbrows["joint_disease_myocardial"]=="Y" || $tbrows["joint_disease_paralysis"]=="Y"){
		$sql="SELECT thidate, bp1, bp2 FROM opd WHERE hn = '".$tbrows["hn"]."' AND (bp1 !='' OR bp2 !='') AND thidate between '2558-07-01 00:00:00' and '2558-09-30 23:59:59' ORDER  BY thidate DESC LIMIT 3";
		//echo $sql;
		$query=mysql_query($sql);
	    $rownum=mysql_num_rows($query);
	    if($rownum < 3){
	  	   if($rownum < 1){
		 	  	echo "ไม่ได้ตรวจ";
	  	 	}else{
		 		echo "ตรวจไม่ถึง 3 ครั้ง";
			}
	    }else{		
			$num=0;
			while($rows=mysql_fetch_array($query)){
				if($rows["bp1"] < 130 && $rows["bp2"] < 80){
					$code="y";
					$num++;
				}else{
					$code="n";
				}	
			}  //close while
			if($num==3){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
	?>    </td>
    <td align="center" bgcolor="#CCFFCC">
	<?
	if($tbrows["joint_disease_dm"]=="" && $tbrows["joint_disease_nephritic"]=="" && $tbrows["joint_disease_myocardial"]=="" && $tbrows["joint_disease_paralysis"]==""){
		$sql="SELECT thidate, bp1, bp2 FROM opd WHERE hn = '".$tbrows["hn"]."' AND (bp1 !='' OR bp2 !='') AND thidate between '2558-07-01 00:00:00' and '2558-09-30 23:59:59' ORDER  BY thidate DESC LIMIT 3";
		$query=mysql_query($sql);
	    $rownum=mysql_num_rows($query);
	    if($rownum < 3){
	  	   if($rownum < 1){
		 	  	echo "ไม่ได้ตรวจ";
	  	 	}else{
		 		echo "ตรวจไม่ถึง 3 ครั้ง";
			}
	    }else{			
			$num=0;
			while($rows=mysql_fetch_array($query)){
				if($rows["bp1"] < 140 && $rows["bp2"] < 90){
					$code="y";
					$num++;
				}else{
					$code="n";
				}
			}  //close while
			if($num==3){
				echo "1";
			}else{
				echo "0";
			}
		}		
	}
	?>    </td>
    <td align="center" bgcolor="#CCFFCC">
    <?
		$sql="SELECT thidate, bp1, bp2, organ FROM opd WHERE hn = '".$tbrows["hn"]."' AND (bp1 !='' OR bp2 !='') AND organ like '%ตรวจตามนัด%'   AND thidate between '2558-07-01 00:00:00' and '2558-09-30 23:59:59' ORDER  BY thidate DESC LIMIT 3";
		$query=mysql_query($sql);
		$recode=mysql_num_rows($query);
		if(!empty($recode)){
			echo "1";
		}else{
			echo "0";
		}
	?>    </td>
  </tr>
  <?
	  	}
	}
  ?>
</table>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>