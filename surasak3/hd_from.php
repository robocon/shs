<?
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>

<style type="text/css">
.forntsarabun11 {	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.forntsarabun11 {	font-family: "TH SarabunPSK";
	font-size: 22px;
}
</style>
</head>
<style>
	.font_title{
		font-family:"TH SarabunPSK"; 
		font-size:25px;
		}
	.tb_font{
	font-family:"TH SarabunPSK";
	font-size:24px;
	color: #09F;
}
	.tb_font_1{
		font-family:"TH SarabunPSK"; 
		font-size:24px; 
		color:#FFFFFF;
		 font-weight:bold;}
	.tb_col{
		font-family:"TH SarabunPSK"; 
		font-size:24px;
		 background-color:#9FFF9F;
		 }
.tb_font_2 {
	font-family: "TH SarabunPSK";
	color: #B00000;
	font-size: 22px;
	font-weight: bold;
}

.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
	color: #FFF;
}
.forntsarabun1 {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
</style>
<body onload="document.frmMain.Calcium.value*document.frmMain.serum_phose.value ">
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />

<style>
.f1{
	font-family:"Angsana New";
	font-size:16px;	
}
</style>
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date_hd'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('stage_date'));
};



function fncSubmit()
{
		if(document.frmMain.hn.value == "")
	{
		alert('กรุณาระบุ HN');
		document.frmMain.hn.focus();		
		return false;
	}	
			if(document.frmMain.ptname.value == "")
	{
		alert('กรุณาระบุ ชื่อ-สกุล ');
		document.frmMain.ptname.focus();		
		return false;
	}	
		if(document.frmMain.stage.value == "")
	{
		alert('กรุณาเลือก stage');
		document.frmMain.stage.focus();		
		return false;
	}	
	document.frmMain.submit();
}

</script>

   <script>
function select_sub(){
	
	//menubar=no,location=no,directories=no,toolbar=no,status=no,resizable=no

	var id =document.getElementById('hn').value;
	window.open("call_eGFR.php?cHn="+id,"win1","width=300,height=300,scrollbars=yes");
}

function turn_add(id_sub,description){
	//document.syllabus.id_subject.value=id_sub;
	document.getElementById("id_subject").value=id_sub;
	document.getElementById("description").innerHTML=description;
	
//	alert(document.getElementById("id_subject").value);
}
function reset_syllambus(){
	document.getElementById("description").innerHTML="<font color=\"red\">ยังไม่ได้คำนวณ eGFR</font>";
}

</script>     

 <script>
	function calca(a,b){
		//alert(a);

		var ca=a*b;
		document.frmMain.ca_p.value=ca.toFixed(2);
	}
	
	function selectd_stage(){
		
		var gfr=document.getElementById("id_subject").value;
		
		if(gfr >90.00){
			document.getElementById("stage").selectedIndex=1;
		}else if (gfr >=60.00 && gfr <=89.99){
			document.getElementById("stage").selectedIndex=2;
		}else if (gfr >=30.00 && gfr <=59.99){
			document.getElementById("stage").selectedIndex=3;
		}else if (gfr >=15.00 && gfr <=29.99){
			document.getElementById("stage").selectedIndex=4;
		}else if (gfr <15.00){
			document.getElementById("stage").selectedIndex=5;
		}
		
	}
	
	
	</script>
       
  <form action="" method="POST" enctype="multipart/form-data" name="syllabus" id="syllabus">
  <table  border="0" align="center" bordercolor="#393939" bgcolor="#FFFFCE">
  <tr>
    <td align="center" bgcolor="#0000CC" class="forntsarabun">กรอกหมายเลข HN</td>
    </tr>
  <tr>
    <td class="forntsarabun"><input  name="pHn"  type="text" class="forntsarabun1"/></td>
    </tr>
  <tr>
    <td align="center"><input name="button2" type="submit" class="forntsarabun1" id="button2" value="ตกลง" /></td>
    </tr>
  <tr>
    <td align="center"><a  class="forntsarabun1" target="_top" href="../nindex.htm">&lt;&lt;ไปเมนู</a> &nbsp;&nbsp; <a href="hd_list.php" target="_blank" class="forntsarabun1">รายชื่อ opd ไต</a></td>
  </tr>
  </table>
</form>  

<hr />
<? if($_POST['pHn'] && $_POST['pHn']!=''){
	include("connect.inc");	
	
	$sqlchk="SELECT * FROM `opd_hd` WHERE hn = '".$_POST['pHn']."' ";
	$querychk=mysql_query($sqlchk)or die ("Error Query [".$sqlchk."]");
	$rowchk=mysql_num_rows($querychk);
	$arr=mysql_fetch_assoc($querychk);
	if($rowchk >0){
		
		
		echo "<div align='center' class='forntsarabun1'>HN : ".$_POST['pHn']." &nbsp;มีแล้วในระบบทะเบียนผู้ป่วยโรคไต<br>";
		?>
<a href="javascript:MM_openBrWindow('hd_from_edit.php?row_id=<?=$arr['row_id'];?>&cHn=<?=$arr['hn'];?>&frm1=1','','toolbar=no,location=no,status=n o,menubar=no,scrollbars=yes,resizable=yes,width=950, height=800')">ต้องการแก้ไขข้อมูล</a>
        <?
		//echo "ต้องการแก้ไขข้อมูล  <a href='hd_from_edit.php?cHn=$_POST[pHn]' target='_blank'>คลิ๊ก</a> </div>";
		
	
	}else{
	
	$year=date("Y");
	
	$strSQL = "SELECT  hn,ptname,bp1,bp2,cigarette  FROM opd  WHERE hn = '".$_POST['pHn']."'  ORDER BY `row_id` DESC limit 1 ";
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	$objResult = mysql_fetch_array($objQuery);	
	
	
	$strSQL1 = "SELECT  hn,dbirth   FROM opcard  WHERE hn = '".$_POST["pHn"]."' ";
	$objQuery1 = mysql_query($strSQL1) or die ("Error Query [".$strSQL1."]");
	$objResult1 = mysql_fetch_array($objQuery1);
	
	
//// BS /////
//	and b.orderdate like '$year%'
	 $laball="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$objResult["hn"]."' and  a.labcode='GLU'   Order by b.orderdate desc limit 1";
	  $result_laball=mysql_query($laball);
	  $dall=mysql_fetch_array($result_laball);
	  
	  
	  ////HBA1C ///
	  
	  $laball1="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$objResult["hn"]."' and  a.labcode='HBA1C'  Order by b.orderdate desc limit 1";
	  $result_laball1=mysql_query($laball1);
	  $dall1=mysql_fetch_array($result_laball1);
	  
	  
	  /// LDL 
	  $laball2="Select  result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$objResult["hn"]."' and  a.labcode='LDL'  Order by b.orderdate desc limit 1";
	  $result_laball2=mysql_query($laball2);
	  $dall2=mysql_fetch_array($result_laball2);
	  
	  	  /// HCT 
	  $laball3="Select  result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$objResult["hn"]."' and  a.labcode='HCT'  Order by b.orderdate desc limit 1";
	  $result_laball3=mysql_query($laball3);
	  $dall3=mysql_fetch_array($result_laball3);
	  
	  
	  	  	  /// HB 
	  $laball4="Select  result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$objResult["hn"]."' and  a.labcode='HB'  Order by b.orderdate desc limit 1";
	  $result_laball4=mysql_query($laball4);
	  $dall4=mysql_fetch_array($result_laball4);
	  
	  
	  	  	  	  /// PTH 
	  $laball5="Select  result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$objResult["hn"]."' and  a.labcode='PTH'  Order by b.orderdate desc limit 1";
	  $result_laball5=mysql_query($laball5);
	  $dall5=mysql_fetch_array($result_laball5);
	  
	  
	   	  	  /// CO2  biocarbonate 
	  $laball6="Select  result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$objResult["hn"]."' and  a.labcode='CO2'  Order by b.orderdate desc limit 1";
	  $result_laball6=mysql_query($laball6);
	  $dall6=mysql_fetch_array($result_laball6);
	  
	  
	  $laball7="Select  result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$objResult["hn"]."' and  a.labcode='CA'  Order by b.orderdate desc limit 1";
	  $result_laball7=mysql_query($laball7);
	  $dall7=mysql_fetch_array($result_laball7);
	  
	  $laball8="Select  result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$objResult["hn"]."' and  a.labcode='P'  Order by b.orderdate desc limit 1";
	  $result_laball8=mysql_query($laball8);
	  $dall8=mysql_fetch_array($result_laball8);
	  
	  
	  ///////////// คำนวณอายุ /////////////////
	  
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

$cAge=calcage($objResult1['dbirth']);
	  
?>   


       
<form action="" method="POST" name="frmMain"  onSubmit="JavaScript:return fncSubmit();">
<table  border="0" align="center" bgcolor="#FFFFCE" class="forntsarabun1">
  <tr>
    <td colspan="4" bgcolor="#0000CC"><span class="forntsarabun">ข้อมูลผู้ป่วย</span></td>
    </tr>
  <tr>
    <td  class="tb_font_2">hn</td>
    <td ><!--OnChange="JavaScript:doCallAjax('hn','ptname','bp1','bp2','cigarette1','cigarette2','stage');"-->
      <?=$objResult['hn'];?><input name="hn" type="hidden" class="forntsarabun1" id="hn"  value="<?=$objResult['hn'];?>" /></td>
    <td ><span class="tb_font_2">ชื่อ-สกุล</span></td>
    <td><?=$objResult['ptname'];?><input name="ptname" type="hidden" class="forntsarabun1" id="ptname" value="<?=$objResult['ptname'];?>"/></td>
  </tr>
  <tr>
    <td class="tb_font_2"><span class="tb_font_21">วันที่</span></td>
    <td><input name="date_hd" type="text" class="forntsarabun1" id="date_hd"  value="<?=date("Y-m-d");?>"/></td>
    <td class="tb_font_2">อายุ</td>
    <td><?=$cAge;?></td>
  </tr>
  <tr>
    <td class="tb_font_2"><span class="tb_font_21">eGFR</span></td><!--onclick="select_sub()"-->
    <td><input name="id_subject" class="forntsarabun1"  id="id_subject"  style="background-color:#DBDBDB"  size="20"  onclick="select_sub()" onblur="selectd_stage()"/>
      <span class="forntsarabun1">ml/min</span>
      <!--	  <a href="javascript:select_sub()" class="sh">คำนวณ </a>-->
      <div id="description" style="display:none;"></div></td>
    <td><span class="tb_font_2">stage</span></td>
    <td><? 
 $sql1="SELECT * FROM `opd_hd` WHERE hn='".$objResult['hn']."' ORDER BY `row_id` DESC limit 1";
 $query1=mysql_query($sql1) or die (mysql_error());
 $arr=mysql_fetch_array($query1);

			?>
      <select name="stage" class="forntsarabun1" id="stage">
        <option value="" selected>--กรุณาเลือก stage--</option>
        <option value="stage1">stage1</option>
        <option value="stage2">stage2</option>
        <option value="stage3">stage3</option>
        <option value="stage4">stage4</option>
        <option value="stage5">stage5</option>
        <option value="ESRD">ESRD</option>
      </select><span class="tb_font_2">
      วันที่เปลี่ยน stage</span>
      <input name="stage_date" type="text" class="forntsarabun1" id="stage_date"  value="<?=date("Y-m-d");?>"/></td>
  </tr>
  <tr>
    <td class="tb_font_2">bp</td>
    <td><input name="bp1" type="text" class="forntsarabun11" id="bp1"  value="<?=$objResult['bp1'];?>" size="10" />
/
  <input name="bp2" type="text" class="forntsarabun11" id="bp2" value="<?=$objResult['bp2'];?>" size="10" /></td>
    <td><span class="tb_font_2">bs</span></td>
    <td class="forntsarabun1"><input name="bs" type="text" class="forntsarabun1" id="bs" value="<?=$dall['result'];?>" />
      <span class="forntsarabun1">mg%</span></td>
  </tr>
  <tr>
    <td class="tb_font_2">HbA1C</td>
    <td><span class="tb_font_2">
      <input name="hba1c" type="text" class="forntsarabun1" id="hba1c" value="<?=$dall1['result'];?>"/>
    </span><span class="forntsarabun1">%</span></td>
    <td><span class="tb_font_2">LDL</span></td>
    <td class="forntsarabun1"><span class="tb_font_2">
      <input name="ldl" type="text" class="forntsarabun1" id="ldl"  value="<?=$dall2['result'];?>"/>
</span>mg%</td>
  </tr>
  <tr>
    <td class="tb_font_2">Calcium</td>
    <td><span class="tb_font_2">
      <input name="Calcium" type="text" class="forntsarabun1" id="Calcium" value="<?=$dall7['result'];?>"  onBlur="calca(this.value,document.frmMain.serum_phose.value)"/>
    </span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="tb_font_2">Hb</td>
    <td><input name="hb" type="text" class="forntsarabun1" id="hb" value="<?=$dall4['result'];?>" />
g/dl</td>
    <td><span class="tb_font_2">Hct</span></td>
    <td><span class="tb_font_2">
      <input name="hct" type="text" class="forntsarabun1" id="hct" value="<?=$dall3['result'];?>" />
    </span><span class="forntsarabun1">mg/dl</span></td>
  </tr>
  <tr>
    <td class="tb_font_2">serum phosephate</td>
    <td class="forntsarabun1"><input name="serum_phose" type="text" class="forntsarabun1" id="serum_phose"  value="<?=$dall8['result'];?>" onBlur="calca(document.frmMain.Calcium.value,this.value)"/>
mg/dl</td>
    <td class="forntsarabun1"><span class="tb_font_2">ca x p</span></td>
    <td class="forntsarabun1"><span class="tb_font_2">
      <input name="ca_p" type="text" class="forntsarabun1" id="ca_p"  value=""/>
    </span></td>
  </tr>
  <tr>
    <td class="tb_font_2">serum bicarbonate</td>
    <td class="forntsarabun1"><span class="tb_font_2">
      <input name="serum_bio" type="text" class="forntsarabun1" id="serum_bio"  value="<?=$dall6['result'];?>" />
    </span>meq/L</td>
    <td class="tb_font_2">&nbsp;</td>
    <td class="forntsarabun1">&nbsp;</td>
  </tr>
  <tr>
    <td class="tb_font_2">PTH</td>
    <td class="forntsarabun1"><input name="pth" type="text" class="forntsarabun1" id="pth" value="<?=$dall5['result'];?>" />
pg/dl</td>
    <td class="tb_font_2">&nbsp;</td>
    <td class="tb_font_2">&nbsp;</td>
  </tr>
  <tr>
    <td class="tb_font_2">Vascular Access</td>
    <td class="forntsarabun1"><span class="tb_font_2">
      <select name="vascular" class="forntsarabun1" id="vascular">
        <option value="" selected="selected">--กรุณาเลือก --</option>
        <option value="avf">AVF</option>
        <option value="avg">AVG</option>
        <option value="catheter">Catheter</option>
        <option value="no">ยังไม่ได้ทำ</option>
        </select>
      </span></td>
    <td class="tb_font_2">&nbsp;</td>
    <td class="tb_font_2">&nbsp;</td>
  </tr>
  <tr>
    <td class="tb_font_2">การฉีดวัคซีนตับอักเสบบี <br />
      และไข้หวัดใหญ่</td>
    <td><input type="radio" name="hepatitis" id="hepatitis1" value="1" <? if($objResult["hepatitis"]==1) { echo "checked" ; } ?>/>
      ฉีด
      <input type="radio" name="hepatitis" id="hepatitis2" value="0"  <? if($objResult["hepatitis"]==0) { echo "checked" ; } ?>/>
      ไม่ได้ฉีด
      </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="tb_font_2">บุหรี่</td>
    <td><input type="radio" name="cigarette" id="cigarette1" value="1" <? if($objResult["cigarette"]==1) { echo "checked" ; } ?>/>
      สูบ
      <input type="radio" name="cigarette" id="cigarette2" value="0"  <? if($objResult["cigarette"]==0) { echo "checked" ; } ?>/>
      ไม่สูบ</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="tb_font_2">โภชนาการ</td>
    <td><input type="radio" name="diet" id="diet" value="1" />
      ให้คำแนะนำ 
       
          <input type="radio" name="diet" id="diet" value="0" /> 
          ไม่ได้ให้คำแนะนำ
</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="tb_font_2">นักกายภาพ</td>
    <td><input type="radio" name="physical" id="physical" value="1" />
ให้คำแนะนำ
  
    <input type="radio" name="physical" id="physical" value="0" />
    ไม่ได้ให้คำแนะนำ</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="tb_font_2">การบำบัดทดแทนไต </td>
    <td><input type="radio" name="guid_hd" id="physical" value="1" />
      ให้คำแนะนำ
      <input type="radio" name="guid_hd" id="physical" value="0" />
      ไม่ได้ให้คำแนะนำ
  </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td valign="top" class="tb_font_2">หมายเหตุ</td>
    <td colspan="3">
      <textarea name="comment" cols="45" rows="5" class="forntsarabun1" id="comment"></textarea></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="button" type="submit" class="forntsarabun1" id="button" value="บันทึกข้อมูล" />  </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<br />
<br />
<hr />
<br />


<?
}// end if row--- opd_hd

}

if(isset($_POST['button']) && $_POST['button']!=''){
include("connect.inc");	
	
	$regis=date("Y-m-d H:i:s");
	
$sql="INSERT INTO `opd_hd` ( `date_hd` , `hn` , `ptname` , `stage`, `start_date` , `bp1` , `bp2`  , `bs` , `hba1c` , `ldl` ,`Calcium` ,`ca_p` , `hct` , `hb` , `serum_phose` , `serum_bio` , `pth` , `hepatitis` , `vascular` , `guid_hd` , `gfr` ,`cigarette` , `diet` , `physical` , `comment`,register )
VALUES ( '".$_POST['date_hd']."', '".$_POST['hn']."', '".$_POST['ptname']."', '".$_POST['stage']."','".$_POST['stage_date']."', '".$_POST['bp1']."', '".$_POST['bp2']."' , '".$_POST['bs']."', '".$_POST['hba1c']."' , '".$_POST['ldl']."' , '".$_POST['Calcium']."', '".$_POST['ca_p']."', '".$_POST['hct']."' , '".$_POST['hb']."' , '".$_POST['serum_phose']."', '".$_POST['serum_bio']."', '".$_POST['pth']."',  '".$_POST['hepatitis']."', '".$_POST['vascular']."', '".$_POST['guid_hd']."', '".$_POST['id_subject']."','".$_POST['cigarette']."', '".$_POST['diet']."', '".$_POST['physical']."', '".$_POST['comment']."','".$regis."');";

$query=mysql_query($sql) or die (mysql_error());


$sqlstage="INSERT INTO `opd_hd_stage` (`hn` ,gfr, `stage` , `start_date` )VALUES ('".$_POST['hn']."' ,'".$_POST['id_subject']."' , '".$_POST['stage']."', '".$_POST['stage_date']."');";
$querystage=mysql_query($sqlstage) or die (mysql_error());


if($query){
echo "บันทึกข้อมูลเรียบร้อยแล้ว";
echo"<meta http-equiv='refresh' content='1;url=hd_from.php'>";
}
}

//include('hd_list.php');
?>
</body>
</html>