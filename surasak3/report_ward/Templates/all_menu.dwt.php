<? 
session_start();
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- TemplateBeginEditable name="doctitle" -->
    <title>ระบบรายงานเหตุการณ์สำคัญ/อุบัติการณ์/ความไม่สอดคล้อง</title>
    <!-- TemplateEndEditable -->
    <link type="text/css" href="../menu.css" rel="stylesheet" />
    <script type="text/javascript" src="../jquery.js"></script>
    <script type="text/javascript" src="../menu.js"></script>
    <!-- TemplateBeginEditable name="head" -->
    <!-- TemplateEndEditable -->
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
        <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>หน้าแรก</span></a></li>
        <li><a href="gward_report_doctor.php" class="parent"><span>รายงานผู้ป่วยในตามแพทย์</span></a></li>
		<li><a href="report_wardlog.php" class="parent"><span>รายงานการเปลี่ยนข้อมูลผู้ป่วย</span></a></li>

     	
        <li><a href="#"><span>สถิติหอผู้ป่วยประจำเดือน</span></a></li>
     
     <ul>
	  	<li class="last"><a href="report_fward.php"><span>หอผู้ป่วยรวม</span></a></li>
	  	<li class="last"><a href="report_gward.php"><span>หอผู้ป่วยสูติ</span></a></li>
          	<li class="last"><a href="report_icuward.php"><span>หอผู้ป่วยหนัก</span></a></li>
              	<li class="last"><a href="report_vipward.php"><span>หอผู้ป่วยพิเศษ</span></a></li>
       	</ul>
        <li><a href="#"><span>Diagnosis ประจำปี</span></a></li>
     
     <ul>
	  	<li class="last"><a href="report_icd10_ofyear.php?code=42"><span>หอผู้ป่วยรวม</span></a></li>
	  	<li class="last"><a href="report_icd10_ofyear.php?code=43"><span>หอผู้ป่วยสูติ</span></a></li>
          	<li class="last"><a href="report_icd10_ofyear.php?code=44"><span>หอผู้ป่วยหนัก</span></a></li>
              	<li class="last"><a href="report_icd10_ofyear.php?code=45"><span>หอผู้ป่วยพิเศษ</span></a></li>
       	</ul>
        <li><a href="#"><span>Diagnosis Top5 ประจำปี</span></a></li>
     
     <ul>
	  	<li class="last"><a href="report_icd10_top5.php?code=42"><span>หอผู้ป่วยรวม</span></a></li>
	  	<li class="last"><a href="report_icd10_top5.php?code=43"><span>หอผู้ป่วยสูติ</span></a></li>
          	<li class="last"><a href="report_icd10_top5.php?code=44"><span>หอผู้ป่วยหนัก</span></a></li>
              	<li class="last"><a href="report_icd10_top5.php?code=45"><span>หอผู้ป่วยพิเศษ</span></a></li>
       	</ul>
         <li><a href="#"><span>รายงานผู้ป่วยเสียชีวิต</span></a></li>
     
     <ul>
	  	<li class="last"><a href="report_dead.php?code=42"><span>หอผู้ป่วยรวม</span></a></li>
	  	<li class="last"><a href="report_dead.php?code=43"><span>หอผู้ป่วยสูติ</span></a></li>
          	<li class="last"><a href="report_dead.php?code=44"><span>หอผู้ป่วยหนัก</span></a></li>
              	<li class="last"><a href="report_dead.php?code=45"><span>หอผู้ป่วยพิเศษ</span></a></li>
       	</ul>
        <li><a href="report_age15.php" class="parent"><span>รายชื่อเด็กอายุต่ำกว่า 15ปี</span></a></li>
    </ul>
</div>

<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- TemplateBeginEditable name="detail" -->detail<!-- TemplateEndEditable -->

</div>



</body>
</html>