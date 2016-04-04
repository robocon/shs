<? 
session_start();

include("Connections/connect.inc.php"); 
include("Connections/all_function.php"); 
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>สมุดทะเบียนการรับบริการวัคซีนเด็ก</title>
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
        <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>หน้าหลัก</span></a></li>
        <li><a href="service.php"><span>สมุดทะเบียนวัคซีนเด็ก</span></a></li>
        <li><a href="clinic_well_baby.php"><span>คลินิก Well baby</span></a></li>
     	<li><a href="#"><span>รายงานการรับบริการวัคซีนเด็ก</span></a></li>
  	<ul>
	  	<li><a href="Report_m.php"><span>รายงานการรับบริการประจำเดือน</span></a></li>
        <li><a href="Report_vac.php"><span>รายงานการรับบริการตามวัคซีน</span></a></li>
        <li><a href="Report_all.php"><span>รายงานการรับบริการทั้งหมด</span></a></li>
        
    </ul>
    <li><a href="Report_clinic_wellbaby.php"><span>รายงาน คลินิก Well baby</span></a></li>
    <li><a href="show_edit.php"><span>แก้ไขข้อมูลวัคซีน</span></a></li>
     <li><a href="add_vac.php"><span>จัดการข้อมูลวัคซีน</span></a></li>
    </ul>
</div>

<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date1'));

};

</script>

<form action="" method="post" name="form1" id="form1" onSubmit="JavaScript:return ch_null();">
  <table width="200" border="1" align="center" bordercolor="#0099FF">
    <tr>
      <td><table width="285" border="0" align="center" >
        <tr>
          <td colspan="3" class="forntsarabun"><h2 align="center">คลินิก Well Baby</h2></td>
          </tr>
        <tr>
          <td width="96" align="right" class="forntsarabun"><span class="table_font1">ระบุ HN</span> :</td>
          <td width="173" colspan="2" align="left"><label>
            <input name="hn" type="text" class="table_font2" id="hn" />
            </label></td>
          </tr>
        <tr>
          <td colspan="3" align="center"><label>
            <input name="button" type="submit" class="table_font1" id="button" value="ตกลง" />
            </label></td>
          </tr>
        </table></td>
      </tr>
    </table>

</form>

<? 
if($_POST['button']!=''){
	


	$sql1 = "select *  from opcard Where  hn = '".$_POST['hn']."' ";
	$result1 = mysql_query($sql1);
	$numrows=mysql_num_rows($result1);
	$fetch= mysql_fetch_array($result1);
	
	$dbirth=$fetch['dbirth'];
	$age = calcage($dbirth);
	
	$age2= calcage2($dbirth);
	
	$calage=explode('/',$age2);
	
	
?>
<div align="center">
<script>

function fncSubmit()
{
	if(document.form2.weight.value=="")
	{
		alert('กรุณาระบุน้ำหนักด้วยครับ');
		document.form2.weight.focus();
		return false;
	}
	if(document.form2.develop_age.value==""){
		alert("กรุณาระบุข้อมูล พัฒนาการสมวัย ด้านร่างกายและอารมณ์") ;
		document.form2.develop_age.focus() ;
		return false ;
	}		

	if(document.form2.growth_0.checked == false && document.form2.growth_1.checked == false && document.form2.growth_2.checked == false)
	{
		alert('กรุณาเลือก การเจริญเติบโตตามมารตรฐานอายุและน้ำหนัก');
		
		return false;
	}	
	
if(document.form2.age1.value<=0 && document.form2.age2.value<=6){	
	if(document.form2.breastmilk_0.checked == false && document.form2.breastmilk_1.checked == false && document.form2.breastmilk_2.checked == false)
	{
		alert('กรุณาเลือก นมแม่ในเด็ก 2-6 เดือน');
		
		return false;
	}	
	
}
	
	document.form2.submit();
}

</script>

<fieldset><legend style="margin:0px 20px">ข้อมูลผู้ป่วย</legend>
  <form name="form2" method="post" action="" onSubmit="JavaScript:return fncSubmit();">
    <table width="50%" border="0" align="center" >
      <tr>
        <td ><span class="table_font1">HN :</span><span class="table_font2">
          <?=$fetch['hn'];?>
          </span> <input name="phn" type="hidden" value="<?=$fetch['hn'];?>"><span class="table_font1">ชื่อ-สกุล :</span><span class="table_font2">
            <?=$fetch['yot'].$fetch['name'].' '.$fetch['surname'];?>
          </span></td>
      </tr>
      <tr>
        <td ><span class="table_font1">สิทธิการรักษา :</span><span class="table_font2">
          <?=$fetch['ptright'];?>
        </span></td>
      </tr>
      <tr>
        <td ><span class="table_font1">อายุ :</span><span class="table_font2">
          <?=$age;?>
        </span><input name="age" type="hidden" value="<?=$age;?>">
        <input name="age1" id="age1" type="hidden" value="<?=$calage[0];?>">
        <input name="age2" id="age2" type="hidden" value="<?=$calage[1];?>"></td>
      </tr>
      <tr>
        <td ><span class="table_font1">วันที่ : 
          <input name="date1" type="text" class="table_font2" id="date1" value="<?=date("d/m/Y");?>">
        *เลือกวันที่จากปฎิทิน</span></td>
      </tr>
      <tr>
        <td class="table_font1">น้ำหนัก : 
          <label for="weight"></label>
          <input name="weight" type="text" class="table_font2" id="weight" size="10">
          ก.ก.</td>
        </tr>
      <tr>
        <td class="table_font1">พัฒนาการสมวัย ด้านร่างกายและอารมณ์</td>
        </tr>
      <tr>
        <td class="table_font1"><input name="develop_age" type="text" class="table_font2" id="develop_age" size="70"></td>
      </tr>
      <tr>
        <td class="table_font1">การเจริญเติบโตตามมารตรฐานอายุและน้ำหนัก</td>
      </tr>
      <tr>
        <td ><p>
           <label class="table_font2">
            <input type="radio" name="growth" value="N" id="growth_0">
            ตามเกณฑ์</label>
           <label class="table_font2">
            <input type="radio" name="growth" value="L" id="growth_1">
            ต่ำกว่าเกณฑ์</label>
           <label class="table_font2">
            <input type="radio" name="growth" value="M" id="growth_2">
            เกินกว่าเกณฑ์</label>
          <br>
        </p></td>
      </tr>
        <? if($calage[0]<=0 && $calage[1]<=6 ){	?>
      <tr>
	
        <td class="table_font1">
        นมแม่ในเด็ก 2-6 เดือน
	</td>
      </tr>
      <tr>
        <td>
        <label class="table_font2">
            <input type="radio" name="breastmilk" value="นมแม่" id="breastmilk_0">
            นมแม่</label>
           <label class="table_font2">
            <input type="radio" name="breastmilk" value="นมแม่+นมผสม" id="breastmilk_1">
            นมแม่+นมผสม</label>
           <label class="table_font2">
            <input type="radio" name="breastmilk" value="นมผสม" id="breastmilk_2">
            นมผสม</label></td>
      </tr>
       <?  } ?>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><input name="button2" type="submit" class="table_font1" id="button2" value="บันทึกข้อมูล"></td>
      </tr>
	 
    </table>
  </form>
</fieldset>

<? 
}
if($_POST['button2']){

$register=date("Y-m-d H:i:s");

$thidate=explode('/',$_POST['date1']);

$thidate2=$thidate[2].'-'.$thidate[1].'-'.$thidate[0];

$sql="INSERT INTO `well_baby` (thidate,`hn` , `age` , `weight` , `develop_age` , `growth` , `breastmilk` , `register` )
VALUES ('".$thidate2."','".$_POST['phn']."', '".$_POST['age']."', '".$_POST['weight']."', '".$_POST['develop_age']."', '".$_POST['growth']."', '".$_POST['breastmilk']."','".$register."');";

$query=mysql_query($sql)or die (mysql_error());
		 
		 
			 if($query){
			echo"<h1 align=center>บันทึกข้อมูลเรียบร้อยแล้ว </h1>";
			echo "<meta http-equiv='refresh' content='2; url=clinic_well_baby.php'>" ;
	
			}else {
			echo "<h1 align=center>ไม่สามารถเพิ่มข้อมูลได้</h1>";
			echo "<meta http-equiv='refresh' content='2; url=clinic_well_baby.php'>" ;
			}	
			
			
}
?>
</div>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>