<? 
session_start();
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

<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size:20px;
}
-->
</style>
<script language=Javascript>
function Inint_AJAX() {
   try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
   try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
   try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
   alert("XMLHttpRequest not supported");
   return null;
};

function dochange(src, val) {
     var req = Inint_AJAX();
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
               if (req.status==200) {
                    document.getElementById(src).innerHTML=req.responseText; //รับค่ากลับมา
               } 
          }
     };
     req.open("GET", "locale.php?data="+src+"&val="+val); //สร้าง connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
     req.send(null); //ส่งค่า
}

window.onLoad=dochange('vaccine', -1);     


</script>
<?
@include("Connections/connect.inc.php"); 
@include("Connections/all_function.php"); 

	$id_s=$_GET['id_s'];

	$sql = "select *  from  tb_service Where  id_s = '$id_s' ";
	$result = mysql_query($sql);
	$fetch= mysql_fetch_array($result);
	
	$hn=$fetch['hn'];

	$sql1 = "select *  from opcard Where  hn = '$hn' ";
	$result1 = mysql_query($sql1);
	$numrows1=mysql_num_rows($result1);
	$fetch1= mysql_fetch_array($result1);

	if($numrows1>0){
	$dbirth=$fetch1[dbirth];
	$age = calcage($dbirth);
	
	?>
</p>
<table  border="1" align="center" bordercolor="#0099FF" class="forntsarabun">
  <tr>
    <td ><table  border="0" align="left">
      <tr>
        <td colspan="4" align="center" bgcolor="#E7E7E7">ข้อมูลผู้ป่วย</td>
        </tr>
      <tr>
        <td  align="right" bgcolor="#E7E7E7">HN :</td>
        <td ><?=$fetch1['hn'];?></td>
        <td bgcolor="#E7E7E7" >สิทธิ</td>
        <td ><?=$fetch1['ptright'];?></td>
        </tr>
      <tr>
        <td align="right" bgcolor="#E7E7E7">ชื่อ - สกุล :</td>
        <td><?=$fetch1['yot'].$fetch1['name'].' '.$fetch1['surname'];?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td align="right" bgcolor="#E7E7E7">อายุ:</td>
        <td><?=$age;?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
<p>&nbsp;</p>


<form action="?do=edit" method="post" name="sel" id="sel"  onsubmit="JavaScript:return fncSubmit();">

  <table width="494" border="1" align="center" bordercolor="#0099FF" class="forntsarabun">
    <tr>
      <td width="484" ><table width="100%" border="0" align="left" cellpadding="2" cellspacing="2"  id="mytbl">
        <tr>
          <td colspan="4" align="center" bgcolor="#E4E3E3">กรุณากรอกข้อมูล</td>
          </tr>
        <tr>
          <td align="right">วันที่รับบริการ:</td>
          <td colspan="3"> <input name="date1" type="text" class="forntsarabun" id="datepicker-th-1"  value="<?=$fetch['date_ser'];?>"></td>
          </tr>
        <tr>
          <td align="right">เปลี่ยน Hn</td>
          <td colspan="3"><input name="hn" type="text" class="forntsarabun" id="hn"  value="<?=$fetch['hn'];?>" /></td>
        </tr>
        <tr>
          <td align="right">วัคซีนที่ฉีด :</td>
          <td width="24%"><select name="v1" id="v1" class="forntsarabun" disabled="disabled">
            <?php 
		$sql = "Select * From vaccine Where id_vac ='$fetch[id_vac]' order by id_vac";
		$result = mysql_query($sql);
		$dbarr2= mysql_fetch_array($result);
		echo "<option value='".$dbarr2['id_vac']."'>".$dbarr2['vac_name']."</option>";
		
		?>
          </select></td>
          <td width="13%">เปลี่ยนเป็น</td>
          <td width="45%"><font id="vaccine"  class="forntsarabun"><select class="forntsarabun" ><option value="0" selected="selected">==========</option></select></font></td>
          </tr>
        <tr>
          <td align="right">เข็มที่ :</td>
          <td><select name="v2"" disabled="disabled" class="forntsarabun" id="v2 class="forntsarabun>
            <?php 
		echo "<option value='' >-- กรุณาเลือกเข็ม--</option>";
		$sql = "Select  *  From vaccine_detail where id_vac='$fetch[id_vac]' and syringe_no='$fetch[num]' ";
		$result = mysql_query($sql);
		while($dbarr2= mysql_fetch_array($result)){
			
		echo "<option value='".$dbarr2['syringe_no']."' selected>".$dbarr2['detail']."</option>";	

		}
		?>
          </select></td>
          <td>เปลี่ยนเป็น</td>
          <td><font id="vaccine_detail"  class="forntsarabun"><select class="forntsarabun" ><option value='0'>==========</option></select></font></td>
          </tr>
        <tr>
          <td align="right">LotNo:</td>
          <td colspan="3"><input name="lotno" type="text" id="lotno" size="15" maxlength="10" class="forntsarabun"  value="<?=$fetch['lotno'];?>"/></td>
          </tr>
        <tr>
          <td align="right">วันหมดอายุ</td>
          <td colspan="3"> <input type="text" size="15"  name="date2"  class="forntsarabun" value="<?=$fetch['date_end'];?>"/></td>
        </tr>
        <tr>
          <td align="right" bgcolor="#99FF99">LotNo2:</td>
          <td colspan="3" bgcolor="#99FF99"><input name="lotno2" type="text" id="lotno3" size="15" maxlength="10" class="forntsarabun"  value="<?=$fetch['lotno2'];?>"/>
          * OPV</td>
        </tr>
        <tr>
          <td align="right" bgcolor="#99FF99">วันหมดอายุ</td>
          <td colspan="3" bgcolor="#99FF99"><input type="text" size="15"  name="date3"  class="forntsarabun" value="<?=$fetch['date_end2'];?>"/>
            * OPV</td>
        </tr>
        <tr>
          <td width="18%" align="right">แพทย์</td>
          <td colspan="3"><select name="doctor" id="doctor" class="forntsarabun">
            <?php 
		echo "<option value='' >-- กรุณาเลือกแพทย์ --</option>";
		echo "<option value='ห้องตรวจโรคทั่วไป' >ห้องตรวจโรคทั่วไป</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while($dbarr2= mysql_fetch_array($result)){

		if($fetch['name_doc']==$dbarr2['name']){	
		echo "<option value='".$dbarr2['name']."' selected>".$dbarr2['name']."</option>";	
		}else{
		echo "<option value='".$dbarr2['name']."' >".$dbarr2['name']."</option>";
		}
		
		}
		?>
            </select></td>
        </tr>
        <tr>
          <td colspan="4" align="center"><label>
            <input name="unit" type="hidden" id="unit" value="1" />
            <input name="id_s" type="hidden" id="id_s" value="<?=$fetch['id_s'];?>" />
            <input name="button2" type="submit" class="forntsarabun" id="button2" value="บันทึกข้อมูล" />
            </label></td>
          </tr>
        </table>
      
      </td>
    </tr>
  </table>
</form>
<? } 

if($_REQUEST['do']=="edit"){
	
	$y=date('Y')+543;
	$m=date('m');
	$d=date('d');
	$datetime=$d.'/'.$m.'/'.$y.' '.date('H:i:s');
	
	if($_POST['vaccine']=='0' || $_POST['vaccine_detail']=='0'){
	
	$strSQL = "UPDATE tb_service  SET ";
	$strSQL .="date_ser = '".$_POST["date1"]."' ";
	$strSQL .=",hn = '".$_POST["hn"]."' ";
	$strSQL .=",unit	 = '".$_POST["unit"]."' ";
	$strSQL .=",name_doc = '".$_POST["doctor"]."' ";
	$strSQL .=",lotno = '".$_POST["lotno"]."' ";
	$strSQL .=",date_end= '".$_POST["date2"]."' ";
	$strSQL .=",lotno2 = '".$_POST["lotno2"]."' ";
	$strSQL .=",date_end2 = '".$_POST["date3"]."' ";
	$strSQL .=",date_insert = '".$datetime."' ";
	$strSQL .="WHERE id_s = '".$_POST["id_s"]."' ";
	
	}else{
		
	$strSQL = "UPDATE tb_service  SET ";
	$strSQL .="date_ser = '".$_POST["date1"]."' ";
	$strSQL .=",hn = '".$_POST["hn"]."' ";
	$strSQL .=",id_vac = '".$_POST["vaccine"]."' ";
	$strSQL .=",num = '".$_POST["vaccine_detail"]."' ";
	$strSQL .=",unit	 = '".$_POST["unit"]."' ";
	$strSQL .=",name_doc = '".$_POST["doctor"]."' ";
	$strSQL .=",lotno = '".$_POST["lotno"]."' ";
	$strSQL .=",date_end= '".$_POST["date2"]."' ";
	$strSQL .=",lotno2 = '".$_POST["lotno2"]."' ";
	$strSQL .=",date_end2 = '".$_POST["date3"]."' ";
	$strSQL .=",date_insert = '".$datetime."' ";
	$strSQL .="WHERE id_s = '".$_POST["id_s"]."' ";
	}
	$objQuery = mysql_query($strSQL);
	if($objQuery){ 
	echo "<H3 class='forntsarabun'>แก้ไขข้อมูลเรียบร้อยแล้ว</H3>";
	echo "<meta http-equiv=refresh content=1;URL=show_edit.php>";
	}else{	
	echo "<H3 class='forntsarabun'>ไม่สามารถแก้ไขได้</H3>";
	echo "<meta http-equiv=refresh content=1;URL=show_edit.php>";
	}

}
?>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>