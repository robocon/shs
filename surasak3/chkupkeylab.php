<?
session_start();
include("connect.inc");

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

?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}

.formstyle #btt {
  font-family:"TH SarabunPSK";
  font-size: 18px;
}
.formstyle select {
  font-family:"TH SarabunPSK";
  font-size: 16px;
}
-->
</style>
<div align="center">
<form action="chkupkeylab.php" method="post"  name="form1" class="formstyle">
<input name="act" type="hidden" value="show" />
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td colspan="3" align="center"><strong>กรุณากรอก HN เพื่อบันทึกผล LAB</strong></td>
    </tr>
  <tr>
    <td width="42%" align="right">ระบุ HN</td>
    <td width="1%">:</td>
    <td width="57%"><input type="text" name="Chkhn" value="<?=$_POST['Chkhn'];?>" class="fontsara" />
      <input type="submit" name="submit" value=" ค้นหา " id="btt"></td>
  </tr>
</table>
<div align="center"><a target=_top  href="../nindex.htm">&lt;&lt; เมนูหลัก</a></div>
</form>
<hr>
<?
if($_POST["act"]=="show" || $_GET["act"]=="show"){
	
$chksql="select * from resulthead where hn='".$_POST['Chkhn']."'";
$chkquery=mysql_query($chksql);
$chknum=mysql_num_rows($chkquery);
if($chknum < 1 ){	
if(empty($_POST['Chkhn'])){
$_POST['Chkhn']=$_GET['Chkhn'];
}
$strsql="SELECT * FROM `opcard` WHERE  hn = '".$_POST['Chkhn']."'";
$query=mysql_query($strsql) or die (mysql_error());
$Row=mysql_num_rows($query);
if($Row ==0){
	echo "<script>alert('!!! ไม่พบ HN  $_POST[Chkhn] ในฐานข้อมูลเวชระเบียน กรุณาติดต่อเจ้าหน้าที่ทะเบียน');window.location='chkupkeylab.php';</script>";
}
$rows=mysql_fetch_array($query);
$ptname=$rows["yot"]." ".$rows["name"]." ".$rows["surname"];
$showage = calcage($rows["dbirth"]);
$showdob=explode("-",$rows["dbirth"]);
list($yy,$mm,$dd)=$showdob;
$yy1=$yy-543;
$showdob="$yy1-$mm-$dd 00:00:00";
$birthday="$dd/$mm/$yy";
if($rows["sex"]=="ช"){
	$sex="ชาย";
	$showsex="M";
}else if($rows["sex"]=="ญ"){
	$sex="หญิง";
	$showsex="F";
}else{
	$sex="ไม่ได้ระบุ";
	$showsex="0";
}



////*runno ตรวจสุขภาพ*/////////
$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
////*runno ตรวจสุขภาพ*/////////



if(empty($_POST['Chkhn'])){
$_POST['Chkhn']=$_GET['Chkhn'];
}
$sql = "Select * From  `dxofyear` where  hn='".$_POST['Chkhn']."' and   yearchk='".$nPrefix."'  ORDER BY row_id DESC limit 0,1 ";
//echo $sql;
$result = mysql_query($sql);
$count = mysql_num_rows($result);

//echo $sql;
if($count > 0){
		$arr_dxofyear1 = mysql_fetch_assoc($result);
}



?>
<p align="center"><strong>ข้อมูลผู้ตรวจสุขภาพ</strong></p>
<form name="form1" action="" method="post" class="formstyle">
<input name="act" type="hidden" id="act" value="add" />
<input type="hidden" name="hn" value="<?=$rows['hn'];?>" />
<input type="hidden" name="ptname" value="<?=$ptname;?>" />
<input type="hidden" name="sex" value="<?=$showsex;?>" />
<input type="hidden" name="dob" value="<?=$showdob;?>" />
<input type="hidden" name="age" value="<?=$showage;?>" />
  <table width="70%" border="0" align="center" cellpadding="2" cellspacing="2" class="fontsara">
  <tr>
    <td width="33%" align="right" valign="top">HN :</td>
    <td width="27%">  <strong>
      <?=$rows['hn'];?>
    </strong></td>
    <td width="40%">ชื่อ-สกุล : 
      <strong>
      <?=$ptname;?>
      </strong></td>
    </tr>
  <tr>
    <td align="right" valign="top">ID CARD :</td>
    <td> <strong>
    <?=$rows['idcard'];?>
    </strong></td>
    <td>สิทธิ์การรักษา :      <strong>
      <?=$rows['ptright'];?>
    </strong></td>
  </tr>
  <tr>
    <td align="right" valign="top">วัน/เดือน/ปีเกิด :</td>
    <td><strong>
      <?=$birthday;?>
    </strong></td>
    <td>เพศ : <strong>
      <?=$sex;?>
    </strong></td>
  </tr>
</table>
<p>&nbsp;</p>
<?
if(empty($_GET["labnumber"])){
?>    
  <p style="background-color:#66CCCC;">
  <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td colspan="10" align="center" bgcolor="#0099CC"><strong>
        <label>        </label>
        บันทึกผล UA</strong></td>
    </tr>




    <tr>
       <td align="right"><strong>PHU : </strong></td>
      <td><input name="phu" type="text" id="phu" size="10"  value="<?php echo $arr_dxofyear1["ua_phu"];?>"></td>
   <td align="right"><strong>SPGR : </strong></td>
      <td><input name="spgr" type="text" id="spgr" size="10" value="<?php echo $arr_dxofyear1["ua_spgr"];?>"></td>
    <td align="right"><strong>PROU : </strong></td>
      <td><input name="prou" type="text" id="prou" size="10" value="<?php if($arr_dxofyear1["ua_prou"]==''){echo 'negative';} else {echo $arr_dxofyear1["ua_prou"];};?>"></td>
    <td align="right"><strong>GLUU : </strong></td>
      <td><input name="gluu" type="text" id="gluu" size="10" value="<?php echo $arr_dxofyear1["ua_gluu"];?>"></td>
 <td align="right"><strong>BILI : </strong></td>
      <td><input name="bili" type="text" id="bili" size="10" value="<?php echo $arr_dxofyear1["ua_bili"];?>"></td>
   
 
 
    </tr>
    <tr>
 <td align="right"><strong>UROBIL : </strong></td>
      <td><input name="urobil" type="text" id="urobil" size="10" value="<?php echo $arr_dxofyear1["ua_urobil"];?>"></td>
   
    <td align="right"><strong>NITRIT : </strong></td>
      <td><input name="nitrit" type="text" id="nitrit" size="10" value="<?php echo $arr_dxofyear1["ua_nitrit"];?>"></td>
     
  <td align="right"><strong>BLOODU : </strong></td>
      <td><input name="bloodu" type="text" id="bloodu" size="10" value="<?php echo $arr_dxofyear1["ua_bloodu"];?>"></td>
   
<td align="right"><strong>KETU : </strong></td>
      <td><input name="ketu" type="text" id="ketu" size="10" value="<?php echo $arr_dxofyear1["ua_ketu"];?>"></td>
    
<td align="right"><strong>AMOPU : </strong></td>
      <td><input name="amopu" type="text" id="amopu" size="10" value="<?php echo $arr_dxofyear1["ua_amopu"];?>"></td>
      

    </tr>
    <tr>
<td align="right"><strong>APPEAR : </strong></td>
      <td><input name="appear" type="text" id="appear" size="10" value="<?php if($arr_dxofyear1["ua_appear"]==''){echo 'C';} else {echo $arr_dxofyear1["ua_appear"];};?>"></td>
      <td align="right"><strong>BACTU : </strong></td>
      <td><input name="bactu" type="text" id="bactu" size="10" value="<?php echo $arr_dxofyear1["ua_bactu"];?>"></td>
  
     <td align="right"><strong>CASTU : </strong></td>
      <td><input name="castu" type="text" id="castu" size="10" value="<?php echo $arr_dxofyear1["ua_castu"];?>"></td>
      <td align="right"><strong>COLOR : </strong></td>
      <td><input name="color" type="text" id="color" size="10" value="<?php if($arr_dxofyear1["ua_color"]==''){echo 'Y';} else {echo $arr_dxofyear1["ua_color"];};?>"></td>
      <td align="right"><strong>CRYSTU : </strong></td>
      <td><input name="crystu" type="text" id="crystu" size="10" value="<?php echo $arr_dxofyear1["ua_crystu"];?>"></td>
     




    </tr>
    <tr>
 <td align="right"><strong>EPIU : </strong></td>
      <td><input name="epiu" type="text" id="epiu" size="10" value="<?php if($arr_dxofyear1["ua_epiu"]==''){echo '0-1';}else {echo $arr_dxofyear1["ua_epiu"];};?>"></td>
   
      <td align="right"><strong>MUCOSU : </strong></td>
      <td><input name="mucosu" type="text" id="mucosu" size="10" value="<?php echo $arr_dxofyear1["ua_mucosu"];?>"></td>
      <td align="right"><strong>OTHERU : </strong></td>
      <td><input name="otheru" type="text" id="otheru" size="10" value="<?php echo $arr_dxofyear1["ua_otheru"];?>"></td>
  
<td align="right"><strong>RBCU : </strong></td>
      <td><input name="rbcu" type="text" id="rbcu" size="10" value="<?php if($arr_dxofyear1["ua_rbcu"]==''){echo '0-1';} else {echo $arr_dxofyear1["ua_rbcu"];};?>"></td>
         <td align="right"><strong>WBCU : </strong></td>
      <td><input name="wbcu" type="text" id="wbcu" size="10" value="<?php if($arr_dxofyear1["ua_wbcu"]==''){echo '0-1';} else {echo $arr_dxofyear1["ua_wbcu"];};?>"></td>
   



    </tr>
    <tr>
      <td align="right"><strong>YEAST : </strong></td>
      <td><input name="yeast" type="text" id="yeast" size="10" value="<?php echo $arr_dxofyear1["ua_yeast"];?>"></td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>







  </table>
</p>  
<p style="background-color:#FFCCCC;">
  <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td colspan="12" align="center" bgcolor="#FF9999"><strong>
        <label>        </label>
        บันทึกผล CBC</strong></td>
      </tr>




 <tr>
       <td align="right"><strong>WBC : </strong></td>
      <td><input name="wbc" type="text" id="wbc" size="10" value="<?php echo $arr_dxofyear1["cbc_wbc"];?>" ></td>
     <td align="right"><strong>NEU : </strong></td>
      <td><input name="neu" type="text" id="neu" size="10" value="<?php echo $arr_dxofyear1["cbc_neu"];?>"></td>
 	<td align="right"><strong>LYMP : </strong></td>
      <td><input name="lymp" type="text" id="lymp" size="10" value="<?php echo $arr_dxofyear1["cbc_lymp"];?>"></td>
     <td align="right"><strong>MONO : </strong></td>
      <td><input name="mono" type="text" id="mono" size="10" value="<?php echo $arr_dxofyear1["cbc_mono"];?>"></td>
      <td align="right"><strong>EOS : </strong></td>
      <td><input name="eos" type="text" id="eos" size="10" value="<?php echo $arr_dxofyear1["cbc_eos"];?>"></td>
  <td align="right"><strong>BASO : </strong></td>
      <td><input name="baso" type="text" id="baso" size="10" value="<?php echo $arr_dxofyear1["cbc_baso"];?>"></td>
     
    </tr>
    <tr>
       <td align="right"><strong>RBC : </strong></td>
      <td><input name="rbc" type="text" id="rbc" size="10" value="<?php echo $arr_dxofyear1["cbc_rbc"];?>"></td>
     <td align="right"><strong>HB : </strong></td>
      <td><input name="hb" type="text" id="hb" size="10" value="<?php echo $arr_dxofyear1["cbc_hb"];?>"></td>
     <td align="right"><strong>HCT : </strong></td>
      <td><input name="hct" type="text" id="hct" size="10" value="<?php echo $arr_dxofyear1["cbc_hct"];?>"></td>
    <td align="right"><strong>MCV : </strong></td>
      <td><input name="mcv" type="text" id="mcv" size="10" value="<?php echo $arr_dxofyear1["cbc_mcv"];?>"></td>
  <td align="right"><strong>MCH : </strong></td>
      <td><input name="mch" type="text" id="mch" size="10" value="<?php echo $arr_dxofyear1["cbc_mch"];?>"></td>
      <td align="right"><strong>MCHC : </strong></td>
      <td><input name="mchc" type="text" id="mchc" size="10" value="<?php echo $arr_dxofyear1["cbc_mchc"];?>"></td>
    

   </tr>
    <tr>

      
     <td align="right"><strong>PLTS : </strong></td>
      <td><input name="plts" type="text" id="plts" size="10" value="<?php echo $arr_dxofyear1["cbc_plts"];?>"></td>
     <td align="right"><strong>PLTC : </strong></td>
      <td><input name="pltc" type="text" id="pltc" size="10" value="<?php echo $arr_dxofyear1["cbc_pltc"];?>"></td>
<td align="right"><strong>RBCMOR : </strong></td>
      <td><input name="rbcmor" type="text" id="rbcmor" size="10" value="<?php echo $arr_dxofyear1["cbc_rbcomr"];?>"></td>
<td align="right"><strong>ATYP : </strong></td>
      <td><input name="atyp" type="text" id="atyp" size="10" value="<?php echo $arr_dxofyear1["cbc_atyp"];?>"></td>
      <td align="right"><strong>BAND : </strong></td>
      <td><input name="band" type="text" id="band" size="10" value="<?php echo $arr_dxofyear1["cbc_band"];?>"></td>
      
      <td align="right"><strong>OTHER : </strong></td>
      <td><input name="other" type="text" id="other" size="10" value="<?php echo $arr_dxofyear1["cbc_other"];?>"></td>
    
 
  </tr>
    <tr>
     


   </tr>




  </table>
</p>
<p style="background-color: #FFCC99;">
 <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td colspan="10" align="center" bgcolor="#FF9966"><strong>
        <label>        </label>
        บันทึกผล Lab อื่นๆ</strong></td>
      </tr>
    <tr>
      <td align="right"><strong>GLU : </strong></td>
      <td><input name="glu" type="text" id="glu" size="10" value="<?php echo $arr_dxofyear1["bs"];?>"></td>
      <td align="right"><strong>BUN : </strong></td>
      <td><input name="bun" type="text" id="bun" size="10" value="<?php echo $arr_dxofyear1["bun"];?>"></td>
      <td align="right"><strong>CREA : </strong></td>
      <td><input name="crea" type="text" id="crea" size="10" value="<?php echo $arr_dxofyear1["cr"];?>"></td>
      <td align="right"><strong>URIC : </strong></td>
      <td><input name="uric" type="text" id="uric" size="10" value="<?php echo $arr_dxofyear1["uric"];?>"></td>
      <td align="right"><strong>CHOL : </strong></td>
      <td><input name="chol" type="text" id="chol" size="10" value="<?php echo $arr_dxofyear1["chol"];?>"></td>
    </tr>
    <tr>
      <td align="right"><strong>TRIG : </strong></td>
      <td><input name="trig" type="text" id="trig" size="10" value="<?php echo $arr_dxofyear1["tg"];?>"></td>
      <td align="right"><strong>AST : </strong></td>
      <td><input name="ast" type="text" id="ast" size="10" value="<?php echo $arr_dxofyear1["sgot"];?>"></td>
      <td align="right"><strong>ALT : </strong></td>
      <td><input name="alt" type="text" id="alt" size="10" value="<?php echo $arr_dxofyear1["sgpt"];?>"></td>
      <td align="right"><strong>ALP : </strong></td>
      <td><input name="alp" type="text" id="alp" size="10" value="<?php echo $arr_dxofyear1["alk"];?>"></td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table> 
</p>
<?
}else if(isset($_GET["labnumber"]) && !empty($_GET["labnumber"])){
$sql="select a.autonumber,a.profilecode,b.labcode,b.labname,b.result,b.unit,b.normalrange from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$_GET["Chkhn"]."' and a.labnumber='".$_GET["labnumber"]."'";
//echo $sql;
$query=mysql_query($sql);
while($arr_dxofyear1=mysql_fetch_array($query)){
	//---------- UA ----------//					
	if($arr_dxofyear1["labcode"]=="3100300"){ 
		$phu=$arr_dxofyear1["result"];
	}
	if($arr_dxofyear1["labcode"]=="3100200"){ 
		$spgr=$arr_dxofyear1["result"];
	}
	if($arr_dxofyear1["labcode"]=="3100500"){ 
		$gluu=$arr_dxofyear1["result"];
	}
	if($arr_dxofyear1["labcode"]=="3100600"){ 
		$bili=$arr_dxofyear1["result"];
	}	
	if($arr_dxofyear1["labcode"]=="3100900"){ 
		$urobil=$arr_dxofyear1["result"];
	}	
	if($arr_dxofyear1["labcode"]=="3100700"){ 
		$ketu=$arr_dxofyear1["result"];
}	
	if($arr_dxofyear1["labcode"]=="3101400"){ 
		$rbcu=$arr_dxofyear1["result"];
}	
	if($arr_dxofyear1["labcode"]=="3101300"){ 
		$wbcu=$arr_dxofyear1["result"];
	}
	//---------- END UA ----------//					
	
	
	//---------- CBC ----------//		
	if($arr_dxofyear1["labcode"]=="3010101"){ 
		$wbc=$arr_dxofyear1["result"];
	}
	if($arr_dxofyear1["labcode"]=="3010120"){ 
		$neu=$arr_dxofyear1["result"];
	}
	if($arr_dxofyear1["labcode"]=="3010121"){ 
		$lymp=$arr_dxofyear1["result"];
	}
	if($arr_dxofyear1["labcode"]=="3010122"){ 
		$mono=$arr_dxofyear1["result"];
	}	
	if($arr_dxofyear1["labcode"]=="3010123"){ 
		$eos=$arr_dxofyear1["result"];
	}	
	if($arr_dxofyear1["labcode"]=="3010124"){ 
		$baso=$arr_dxofyear1["result"];
	}
	if($arr_dxofyear1["labcode"]=="3010102"){ 
		$pbc=$arr_dxofyear1["result"];
	}
	if($arr_dxofyear1["labcode"]=="3010104"){ 
		$hb=$arr_dxofyear1["result"];
	}
	if($arr_dxofyear1["labcode"]=="3010103"){ 
		$hct=$arr_dxofyear1["result"];
	}
	if($arr_dxofyear1["labcode"]=="3010105"){ 
		$mcv=$arr_dxofyear1["result"];
	}	
	if($arr_dxofyear1["labcode"]=="3010106"){ 
		$mch=$arr_dxofyear1["result"];
	}	
	if($arr_dxofyear1["labcode"]=="3010107"){ 
		$mchc=$arr_dxofyear1["result"];
	}	
	if($arr_dxofyear1["labcode"]=="3010109"){ 
		$pltc=$arr_dxofyear1["result"];
	}	
	if($arr_dxofyear1["labcode"]=="3010108"){ 
		$other=$arr_dxofyear1["result"];
	}
	//---------- END CBC ----------//					


	//---------- LAB อื่นๆ ----------//					
	if($arr_dxofyear1["labcode"]=="3220300"){ 
		$glu=$arr_dxofyear1["result"];
	}
	if($arr_dxofyear1["labcode"]=="3220100"){ 
		$bun=$arr_dxofyear1["result"];
	}
	if($arr_dxofyear1["labcode"]=="3220200"){ 
		$crea=$arr_dxofyear1["result"];
	}
	if($arr_dxofyear1["labcode"]=="3220500"){ 
		$uric=$arr_dxofyear1["result"];
	}	
	if($arr_dxofyear1["labcode"]=="3250100"){ 
		$chol=$arr_dxofyear1["result"];
	}	
	if($arr_dxofyear1["labcode"]=="3250200"){ 
		$trig=$arr_dxofyear1["result"];
	}
	if($arr_dxofyear1["labcode"]=="3231000"){ 
		$ast=$arr_dxofyear1["result"];
	}	
	if($arr_dxofyear1["labcode"]=="3231100"){ 
		$alt=$arr_dxofyear1["result"];
	}	
	if($arr_dxofyear1["labcode"]=="3230900"){ 
		$alp=$arr_dxofyear1["result"];
	}	
	//---------- END LAB อื่นๆ ----------//							
}
?>
  <p style="background-color:#66CCCC;">
  <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td colspan="10" align="center" bgcolor="#0099CC"><strong>
        <label>        </label>
        บันทึกผล UA</strong></td>
    </tr>




    <tr>
       <td align="right"><strong>PHU : </strong></td>
      <td><input name="phu" type="text" id="phu" size="10"  value="<?php echo $phu;?>"></td>
   <td align="right"><strong>SPGR : </strong></td>
      <td><input name="spgr" type="text" id="spgr" size="10" value="<?php echo $spgr;?>"></td>
    <td align="right"><strong>PROU : </strong></td>
      <td><input name="prou" type="text" id="prou" size="10" value="<?php echo $prou;?>"></td>
    <td align="right"><strong>GLUU : </strong></td>
      <td><input name="gluu" type="text" id="gluu" size="10" value="<?php echo $gluu;?>"></td>
 <td align="right"><strong>BILI : </strong></td>
      <td><input name="bili" type="text" id="bili" size="10" value="<?php echo $bili;?>"></td>
   
 
 
    </tr>
    <tr>
 <td align="right"><strong>UROBIL : </strong></td>
      <td><input name="urobil" type="text" id="urobil" size="10" value="<?php echo $urobil;?>"></td>
   
    <td align="right"><strong>NITRIT : </strong></td>
      <td><input name="nitrit" type="text" id="nitrit" size="10" value="<?php echo $nitrit;?>"></td>
     
  <td align="right"><strong>BLOODU : </strong></td>
      <td><input name="bloodu" type="text" id="bloodu" size="10" value="<?php echo $bloodu;?>"></td>
   
<td align="right"><strong>KETU : </strong></td>
      <td><input name="ketu" type="text" id="ketu" size="10" value="<?php echo $ketu;?>"></td>
    
<td align="right"><strong>AMOPU : </strong></td>
      <td><input name="amopu" type="text" id="amopu" size="10" value="<?php echo $amopu;?>"></td>
      

    </tr>
    <tr>
<td align="right"><strong>APPEAR : </strong></td>
      <td><input name="appear" type="text" id="appear" size="10" value="<?php echo $appear;?>"></td>
      <td align="right"><strong>BACTU : </strong></td>
      <td><input name="bactu" type="text" id="bactu" size="10" value="<?php echo $bactu;?>"></td>
  
     <td align="right"><strong>CASTU : </strong></td>
      <td><input name="castu" type="text" id="castu" size="10" value="<?php echo $castu;?>"></td>
      <td align="right"><strong>COLOR : </strong></td>
      <td><input name="color" type="text" id="color" size="10" value="<?php echo $color;?>"></td>
      <td align="right"><strong>CRYSTU : </strong></td>
      <td><input name="crystu" type="text" id="crystu" size="10" value="<?php echo $crystu;?>"></td>
     




    </tr>
    <tr>
 <td align="right"><strong>EPIU : </strong></td>
      <td><input name="epiu" type="text" id="epiu" size="10" value="<?php echo $epiu;?>"></td>
   
      <td align="right"><strong>MUCOSU : </strong></td>
      <td><input name="mucosu" type="text" id="mucosu" size="10" value="<?php echo $mucosu;?>"></td>
      <td align="right"><strong>OTHERU : </strong></td>
      <td><input name="otheru" type="text" id="otheru" size="10" value="<?php echo $otheru;?>"></td>
  
<td align="right"><strong>RBCU : </strong></td>
      <td><input name="rbcu" type="text" id="rbcu" size="10" value="<?php echo $rbcu;?>"></td>
         <td align="right"><strong>WBCU : </strong></td>
      <td><input name="wbcu" type="text" id="wbcu" size="10" value="<?php echo $wbcu;?>"></td>
   



    </tr>
    <tr>
      <td align="right"><strong>YEAST : </strong></td>
      <td><input name="yeast" type="text" id="yeast" size="10" value="<?php echo $yeast;?>"></td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>







  </table>
</p>  
<p style="background-color:#FFCCCC;">
  <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td colspan="12" align="center" bgcolor="#FF9999"><strong>
        <label>        </label>
        บันทึกผล CBC</strong></td>
      </tr>




 <tr>
       <td align="right"><strong>WBC : </strong></td>
      <td><input name="wbc" type="text" id="wbc" size="10" value="<?php echo $wbc;?>" ></td>
     <td align="right"><strong>NEU : </strong></td>
      <td><input name="neu" type="text" id="neu" size="10" value="<?php echo $neu;?>"></td>
 	<td align="right"><strong>LYMP : </strong></td>
      <td><input name="lymp" type="text" id="lymp" size="10" value="<?php echo $lymp;?>"></td>
     <td align="right"><strong>MONO : </strong></td>
      <td><input name="mono" type="text" id="mono" size="10" value="<?php echo $mono;?>"></td>
      <td align="right"><strong>EOS : </strong></td>
      <td><input name="eos" type="text" id="eos" size="10" value="<?php echo $eos;?>"></td>
  <td align="right"><strong>BASO : </strong></td>
      <td><input name="baso" type="text" id="baso" size="10" value="<?php echo $baso;?>"></td>
     
    </tr>
    <tr>
       <td align="right"><strong>RBC : </strong></td>
      <td><input name="rbc" type="text" id="rbc" size="10" value="<?php echo $rbc;?>"></td>
     <td align="right"><strong>HB : </strong></td>
      <td><input name="hb" type="text" id="hb" size="10" value="<?php echo $hb;?>"></td>
     <td align="right"><strong>HCT : </strong></td>
      <td><input name="hct" type="text" id="hct" size="10" value="<?php echo $hct;?>"></td>
    <td align="right"><strong>MCV : </strong></td>
      <td><input name="mcv" type="text" id="mcv" size="10" value="<?php echo $mcv;?>"></td>
  <td align="right"><strong>MCH : </strong></td>
      <td><input name="mch" type="text" id="mch" size="10" value="<?php echo $mch;?>"></td>
      <td align="right"><strong>MCHC : </strong></td>
      <td><input name="mchc" type="text" id="mchc" size="10" value="<?php echo $cbc_mchc;?>"></td>
    

   </tr>
    <tr>

      
     <td align="right"><strong>PLTS : </strong></td>
      <td><input name="plts" type="text" id="plts" size="10" value="<?php echo $plts;?>"></td>
     <td align="right"><strong>PLTC : </strong></td>
      <td><input name="pltc" type="text" id="pltc" size="10" value="<?php echo $pltc;?>"></td>
<td align="right"><strong>RBCMOR : </strong></td>
      <td><input name="rbcmor" type="text" id="rbcmor" size="10" value="<?php echo $rbcomr;?>"></td>
<td align="right"><strong>ATYP : </strong></td>
      <td><input name="atyp" type="text" id="atyp" size="10" value="<?php echo $atyp;?>"></td>
      <td align="right"><strong>BAND : </strong></td>
      <td><input name="band" type="text" id="band" size="10" value="<?php echo $band;?>"></td>
      
      <td align="right"><strong>OTHER : </strong></td>
      <td><input name="other" type="text" id="other" size="10" value="<?php echo $other;?>"></td>
    
 
  </tr>
    <tr>
     


   </tr>




  </table>
</p>
<p style="background-color: #FFCC99;">
 <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td colspan="10" align="center" bgcolor="#FF9966"><strong>
        <label>        </label>
        บันทึกผล Lab อื่นๆ</strong></td>
      </tr>
    <tr>
      <td align="right"><strong>GLU : </strong></td>
      <td><input name="glu" type="text" id="glu" size="10" value="<?php echo $glu;?>"></td>
      <td align="right"><strong>BUN : </strong></td>
      <td><input name="bun" type="text" id="bun" size="10" value="<?php echo $bun;?>"></td>
      <td align="right"><strong>CREA : </strong></td>
      <td><input name="crea" type="text" id="crea" size="10" value="<?php echo $crea;?>"></td>
      <td align="right"><strong>URIC : </strong></td>
      <td><input name="uric" type="text" id="uric" size="10" value="<?php echo $uric;?>"></td>
      <td align="right"><strong>CHOL : </strong></td>
      <td><input name="chol" type="text" id="chol" size="10" value="<?php echo $chol;?>"></td>
    </tr>
    <tr>
      <td align="right"><strong>TRIG : </strong></td>
      <td><input name="trig" type="text" id="trig" size="10" value="<?php echo $trig;?>"></td>
      <td align="right"><strong>AST : </strong></td>
      <td><input name="ast" type="text" id="ast" size="10" value="<?php echo $ast;?>"></td>
      <td align="right"><strong>ALT : </strong></td>
      <td><input name="alt" type="text" id="alt" size="10" value="<?php echo $alt;?>"></td>
      <td align="right"><strong>ALP : </strong></td>
      <td><input name="alp" type="text" id="alp" size="10" value="<?php echo $alp;?>"></td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table> 
</p>
<?
}
?>  
<p align="center"><input name="Submit" type="submit" value="บันทึกผล" id="btt" /> 
  &nbsp;&nbsp;
  <input name="btt" type="reset" value="เคลียร์ข้อมูล" id="btt" />
</p>
</form>
<?
	}else{
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0; URL=chkupkeylab.php?act=list&hn=$_POST[Chkhn]'>";
	}
}  //close if show
?>
<?
if($_GET["act"]=="list"){
?>
<div><strong><a href="chkupkeylab.php?act=show&Chkhn=<?=$_GET["hn"];?>">ลงผล LAB ด้วยตนเอง</a></strong></div>
<table width="40%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>#</strong></td>
    <td width="39%" align="center" bgcolor="#66CC99"><strong>orderdate</strong></td>
    <td width="51%" align="center" bgcolor="#66CC99"><strong>labnumber</strong></td>
  </tr>
<?
$sql="select distinct(labnumber) as labnumber, orderdate from resulthead where hn='".$_GET["hn"]."'";
$query=mysql_query($sql);
$i=0;
while(list($labnumber, $orderdate)=mysql_fetch_array($query)){
$i++;
?>  
  <tr>
    <td align="center" bgcolor="#CCFFCC"><?=$i;?></td>
    <td align="center" bgcolor="#CCFFCC"><?=$orderdate;?></td>
    <td align="center" bgcolor="#CCFFCC"><a href="chkupkeylab.php?act=show&Chkhn=<?=$_GET["hn"];?>&labnumber=<?=$labnumber;?>"><?=$labnumber;?></a></td>
  </tr>
<? } ?>  
</table>

<?
}
?>
</div>
<?
if($_POST["act"]=="add"){
$chkhn=$_POST['hn'];
$chkptname=$_POST['ptname'];
$chkage=$_POST['age'];

$today = date("Y-m-d H:i:s");
$thdate = date("d-m-Y");
$d=substr($thdate,0,2);
$m=substr($thdate,3,2);
$ks=substr($thdate,6,4);
$yr=substr($thdate,6,4) +543;
$thdatehn="$ks-$m-$d".$chkhn;

////*runno ตรวจสุขภาพ*/////////
$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
////*runno ตรวจสุขภาพ*/////////

$borow="ตรวจสุขภาพประจำปี$nPrefix";	


$sql = "Select count(row_id) From  `dxofyear` where `hn` = '$chkhn' and yearchk='".$nPrefix."' limit 0,1 ";
echo $sql;
list($count) = mysql_fetch_row(mysql_query($sql));

if($count!='0'){



$sql="select * from opday where hn='$chkhn' and borow='$borow' limit 0,1";
$query=mysql_query($sql);
$num=mysql_num_rows($query);
$rows=mysql_fetch_array($query);
	
	$chkvn=$rows["vn"];
	$thdatevn="$ks-$m-$d".$chkvn;
	$chkcamp=$rows["camp"];
	$organ="ตรวจสุขภาพประจำปี$nPrefix";
	$doctor="MD022 (ไม่ทราบแพทย์)";
	
	$add = "Update `dxofyear` set thidate='$today',
														   thdatehn='$thdatehn',
														   thdatevn='$thdatevn',
														   hn='$chkhn',
														   vn='$chkvn',
														   ptname='$chkptname',
														   age='$chkage',
														   camp='$chkcamp',
														   organ='$organ',
														   doctor='$doctor',
														   ua_color='$_POST[color]',
														   ua_appear='$_POST[appear]',
														   ua_spgr='$_POST[spgr]',
														   ua_phu='$_POST[phu]',
														   ua_bloodu='$_POST[bloodu]',
														   ua_prou='$_POST[prou]',
														   ua_gluu='$_POST[gluu]',
														   ua_ketu='$_POST[ketu]',
														   ua_urobil='$_POST[urobil]',
														   ua_bili='$_POST[bili]',
														   ua_nitrit='$_POST[nitrit]',
														   ua_wbcu='$_POST[wbcu]',
														   ua_rbcu='$_POST[rbcu]',
														   ua_epiu='$_POST[epiu]',
														   ua_bactu='$_POST[bactu]',
														   ua_yeast='$_POST[yeast]',
														   ua_mucosu='$_POST[mucosu]',
														   ua_amopu='$_POST[amopu]',
														   ua_castu='$_POST[castu]',
														   ua_crystu='$_POST[crystu]',
														   ua_otheru='$_POST[otheru]',
														   cbc_wbc='$_POST[wbc]',
														   cbc_rbc='$_POST[rbc]',
														   cbc_hb='$_POST[hb]',
														   cbc_hct='$_POST[hct]',
														   cbc_mcv='$_POST[mcv]',
														   cbc_mch='$_POST[mch]',
														   cbc_mchc='$_POST[mchc]',
														   cbc_pltc='$_POST[pltc]',
														   cbc_plts='$_POST[plts]',
														   cbc_neu='$_POST[neu]',
														   cbc_lymp='$_POST[lymp]',
														   cbc_mono='$_POST[mono]',
														   cbc_eos='$_POST[eos]',
														   cbc_baso='$_POST[baso]',
														   cbc_band='$_POST[band]',
														   cbc_atyp='$_POST[atyp]',
														   cbc_nrbc='$_POST[nrbc]',
														   cbc_rbcmor='$_POST[rbcmor]',
														   cbc_other='$_POST[other]',
														   bs='$_POST[glu]',
														   bun='$_POST[bun]',
														   cr='$_POST[crea]',
														   uric='$_POST[uric]',
														   chol='$_POST[chol]',
														   tg='$_POST[trig]',
														   sgot='$_POST[ast]',
														   sgpt='$_POST[alt]',
														   alk='$_POST[alp]',
														   yearchk='$nPrefix' where `hn` = '$hn' and yearchk='$nPrefix' ";
	//echo $add;
	if(mysql_query($add)){
		echo "<script>alert('update ข้อมูล LAB ของ HN: $chkhn ($chkptname) เรียบร้อยแล้ว');window.location='chkupkeylab.php';</script>";
	}else{
		echo "<script>alert('!!! ผิดพลาดบันทึกข้อมูลไม่สำเร็จ');window.location='chkupkeylab.php';</script>";
	}


}else{

$sql="select * from opday where hn='$chkhn' and borow='$borow' limit 0,1";
$query=mysql_query($sql);
$num=mysql_num_rows($query);
$rows=mysql_fetch_array($query);
	
	$chkvn=$rows["vn"];
	$thdatevn="$ks-$m-$d".$chkvn;
	$chkcamp=$rows["camp"];
	$organ="ตรวจสุขภาพประจำปี$nPrefix";
	$doctor="MD022 (ไม่ทราบแพทย์)";
	
	$add1 = "INSERT INTO dxofyear SET thidate='$today',
														   thdatehn='$thdatehn',
														   thdatevn='$thdatevn',
														   hn='$chkhn',
														   vn='$chkvn',
														   ptname='$chkptname',
														   age='$chkage',
														   camp='$chkcamp',
														   organ='$organ',
														   doctor='$doctor',
														   ua_color='$_POST[color]',
														   ua_appear='$_POST[appear]',
														   ua_spgr='$_POST[spgr]',
														   ua_phu='$_POST[phu]',
														   ua_bloodu='$_POST[bloodu]',
														   ua_prou='$_POST[prou]',
														   ua_gluu='$_POST[gluu]',
														   ua_ketu='$_POST[ketu]',
														   ua_urobil='$_POST[urobil]',
														   ua_bili='$_POST[bili]',
														   ua_nitrit='$_POST[nitrit]',
														   ua_wbcu='$_POST[wbcu]',
														   ua_rbcu='$_POST[rbcu]',
														   ua_epiu='$_POST[epiu]',
														   ua_bactu='$_POST[bactu]',
														   ua_yeast='$_POST[yeast]',
														   ua_mucosu='$_POST[mucosu]',
														   ua_amopu='$_POST[amopu]',
														   ua_castu='$_POST[castu]',
														   ua_crystu='$_POST[crystu]',
														   ua_otheru='$_POST[otheru]',
														   cbc_wbc='$_POST[wbc]',
														   cbc_rbc='$_POST[rbc]',
														   cbc_hb='$_POST[hb]',
														   cbc_hct='$_POST[hct]',
														   cbc_mcv='$_POST[mcv]',
														   cbc_mch='$_POST[mch]',
														   cbc_mchc='$_POST[mchc]',
														   cbc_pltc='$_POST[pltc]',
														   cbc_plts='$_POST[plts]',
														   cbc_neu='$_POST[neu]',
														   cbc_lymp='$_POST[lymp]',
														   cbc_mono='$_POST[mono]',
														   cbc_eos='$_POST[eos]',
														   cbc_baso='$_POST[baso]',
														   cbc_band='$_POST[band]',
														   cbc_atyp='$_POST[atyp]',
														   cbc_nrbc='$_POST[nrbc]',
														   cbc_rbcmor='$_POST[rbcmor]',
														   cbc_other='$_POST[other]',
														   bs='$_POST[glu]',
														   bun='$_POST[bun]',
														   cr='$_POST[crea]',
														   uric='$_POST[uric]',
														   chol='$_POST[chol]',
														   tg='$_POST[trig]',
														   sgot='$_POST[ast]',
														   sgpt='$_POST[alt]',
														   alk='$_POST[alp]',
														   yearchk='$nPrefix';";
	//echo $add1;
	if(mysql_query($add1)){
		echo "<script>alert('บันทึกข้อมูล LAB ของ HN: $chkhn ($chkptname) เรียบร้อยแล้ว');window.location='chkupkeylab.php';</script>";
	}else{
		echo "<script>alert('!!! ผิดพลาดบันทึกข้อมูลไม่สำเร็จ');window.location='chkupkeylab.php';</script>";
	}





}


}  //close if act
?>
<br />
<? 
include("connect.inc");	

////*runno ตรวจสุขภาพ*/////////
$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
////*runno ตรวจสุขภาพ*/////////
$num='0';		

$sql1="SELECT * FROM  dxofyear where yearchk='$nPrefix' and (cbc_wbc != '' or ua_color != '') ORDER BY row_id DESC limit 5";
$query1=mysql_query($sql1)or die (mysql_error());





?>
<h1 class="pdx" align="center">รายชื่อผู้ตรวจสุขภาพที่ลงผล LABแล้ว</h1>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="pdxpro">
  <tr>
 <td  bgcolor="#CCCCCC">NO</td>
    <td  bgcolor="#CCCCCC">HN</td>
    <td  bgcolor="#CCCCCC">ชื่อ-สกุล</td>
 <td  bgcolor="#CCCCCC">อายุ</td>
 <td  bgcolor="#CCCCCC">สังกัด</td>
    <td  bgcolor="#CCCCCC">cbc</td>
    <td  bgcolor="#CCCCCC">ua</td>
    <td  bgcolor="#CCCCCC">bs</td>
    <td  bgcolor="#CCCCCC">bun</td>
    <td  bgcolor="#CCCCCC">cr</td>
    <td  bgcolor="#CCCCCC">uric</td>
    <td  bgcolor="#CCCCCC">chol</td>
    <td  bgcolor="#CCCCCC">tg</td>
    <td  bgcolor="#CCCCCC">sgot</td>
   <td  bgcolor="#CCCCCC">sgpt</td>
   <td  bgcolor="#CCCCCC">alk</td>


 														 





  </tr>
  <? while($arr1=mysql_fetch_array($query1)){  $num++; ?>

  <tr>
<td><? echo $num;?></td>
    <td><?=$arr1['hn'];?></td>
    <td><?=$arr1['ptname'];?></td>
   <td><?=$arr1['age'];?></td>
   <td><?=$arr1['camp'];?></td>
    <td><?=$arr1['cbc_wbc'];?></td>
 <td><?=$arr1['ua_color'];?></td>
 <td><?=$arr1['bs'];?></td>
 <td><?=$arr1['bun'];?></td>
 <td><?=$arr1['cr'];?></td>
 <td><?=$arr1['uric'];?></td>
 <td><?=$arr1['chol'];?></td>
 <td><?=$arr1['tg'];?></td>
 <td><?=$arr1['sgot'];?></td>
 <td><?=$arr1['sgpt'];?></td>
 <td><?=$arr1['alk'];?></td>
  </tr>
  <? } ?>
</table>

<br>
<?php
    include("connect.inc");
$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
////*runno ตรวจสุขภาพ*/////////
		
   $query="SELECT  camp,COUNT(*) AS duplicate FROM dxofyear where yearchk='$nPrefix' and cbc_wbc != '' and ua_phu != ''  GROUP BY camp HAVING duplicate > 0 ORDER BY camp";
   $result = mysql_query($query);
     $n=0;
 while (list ($camp,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;

list($doctor) = mysql_fetch_row(mysql_query("Select name From doctor where name like '{$codedoctor}%' limit 1 "));
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp&nbsp;&nbsp;</a></td>\n".
 
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวน&nbsp; = &nbsp;<a target=_BLANK href=\"chkallchkupoklab.php? camp=$camp\">$duplicate </a>&nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }



 print "จำนวนทั้งหมด.... $num..คน</a><br> ";
   include("unconnect.inc");
?>
</body>
</html>