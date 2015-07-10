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
	font-size: 16 pt;
}
.fontsara {
	font-family:"TH SarabunPSK";
	font-size: 16 pt;
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
 
  <!--http://10.0.1.4/sm3/nindex.htm-->
        <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>หน้าแรก</span></a></li>
        <li><a href="ncf2.php" class="parent"><span>บันทึกรายงานเหตุการณ์สำคัญ</span></a></li>
		<li><a href="fha_from.php" class="parent"><span>บันทึกรายงานความคลาดเคลื่อนทางยา</span></a></li>
        <li><a href="report_ift.php" class="parent"><span>แบบบันทึกการติดตามภาวะการติดเชื้อ</span></a></li>
        <li><a href="report_accident.php" class="parent"><span>แบบรายงานการได้รับอุบัติเหตุ</span></a></li>
      <?
		if($_SESSION["statusncr"]=='admin'){
	  ?>    
    
    	<li><a href="#"><span>ใบรายงานเหตุการณ์ฯ</span></a></li>
        <ul>
		<li class="last"><a href="ncf_list_clinic.php"><span>ใบรายงานที่ยังไม่ได้บันทึกระดับความรุนแรง</a></span></li>
        <li class="last"><a href="ncf_list_risk.php"><span>ใบรายงานที่ยังไม่ได้บันทึกความเสี่ยง</a></span></li>
        <li class="last"><a href="ncf_list_ic.php"><span>ใบรายงาน เฉพาะ IC และ MR </span></a></li>
    	<li class="last"><a href="ncf_listall.php"><span>ใบรายงานทั้งหมด</span></a></li>
        <li class="last"><a href="ncf_list_riskmore2.php"><span>ตรวจสอบใบรายงาน</span></a></li>
        </ul>
        <li><a href="#"><span>รายงานสรุป</span></a></li>
     	<ul>
        <li class="last"><a href="ncr_report_all.php"><span>รายงานสรุปอุบัติการณ์ รวมทั้งหมด</span></a></li>
	  	<li class="last"><a href="ncr_report_progarm.php"><span>รายงานสรุปอุบัติการณ์จำแนกตามโปรแกรม</span></a></li>
        <li class="last"><a href="ncr_report_event.php"><span>รายงานสรุปอุบัติการณ์จำแนกตามเหตุการณ์</span></a></li>
        <li class="last"><a href="ncf_report_departall.php"><span>รายงานสรุปอุบัติการณ์จำแนกตามแผนก</span></a></li>
        <li class="last"><a href="ncr_report_progarmdepart2.php"><span>รายงานสรุปความเสี่ยงแต่ละแผนก</span></a></li>
        <li class="last"><a href="ncr_report_clinic.php"><span>รายงานสรุประดับความรุนแรง</span></a></li>
	  	<li class="last"><a href="ncf_report_depart.php"><span>หน่วยงานที่รายงานอุบัติการณ์</a></span></li>
        <li class="last"><a href="fha_report_depart.php"><span>รายงานสรุป ความคลาดเคลื่อนทางยา</a></span></li>
        <li class="last"><a href="report_ic_accident.php"><span>รายงานอุบัติการณ์ IC</span></a></li>
        <li class="last"><a href="ic_report_depart.php"><span>สรุปอุบัติการณ์ IC  ประจำปี</span></a></li>
       	</ul>
        <li><a href="#"><span>รายงานความคลาดเคลื่อนทางยา</span></a></li>
     
     <ul>
	  	<li class="last"><a href="fha_data_old.php"><span>ข้อมูลเก่า หลังเดือน ม.ค.2555</span></a></li>
	  	<li class="last"><a href="report_fha.php"><span>ข้อมูลใหม่ ตั้งแต่ ม.ค.2555 ขึ้นไป</a></span></li>
       	</ul>
        <li><a href="ncf_member.php"><span>รายชื่อผู้ใช้ในระบบ</span></a></li>
        <li><a href="logout.php"><span>ออกจากระบบ</span></a></li>
        
       <? } if($_SESSION["statusncr"]=='staff'){?>
       <li><a href="ncf_list_depart.php"><span>ใบรายงานเหตุการณ์ฯ</span></a></li>
        <ul>
	  	<li class="last"><a href="ncf_list_depart.php"><span>ใบรายงานเหตุการณ์ฯ  (โปรแกรมใหม่ 2556)</span></a></li>
	  	<li class="last"><a href="ncf_list_old.php"><span>ใบรายงานเหตุการณ์ฯ (โปรแกรมเก่า < 2556)</a></span></li>
       	</ul>
       <li><a href="#"><span>สถิติ</span></a></li> 
       
       <ul>
	  	<li class="last"><a href="ncr_report_progarmdepart.php"><span>สถิติความเสี่ยงของแผนก</span></a></li> 
	  	<li class="last"><a href="ncr_report_all_depart.php"><span>สถิติอุบัติการณ์ </a></span></li>
       	</ul>
       <li><a href="ncf_member.php"><span>รายชื่อผู้ใช้ในระบบ</span></a></li>
        <li><a href="logout.php"><span>ออกจากระบบ</span></a></li>
        
     <? } if($_SESSION["statusncr"]=='phar'){?>
     
     <li><a href="#"><span>รายงานความคลาดเคลื่อนทางยา</span></a></li>
     
     <ul>
	  	<li class="last"><a href="fha_data_old.php"><span>ข้อมูลเก่า หลังเดือน ม.ค.2555</span></a></li>
	  	<li class="last"><a href="report_fha.php"><span>ข้อมูลใหม่ ตั้งแต่ ม.ค.2555 ขึ้นไป</a></span></li>
       	</ul>
       
        <li><a href="logout.php"><span>ออกจากระบบ</span></a></li>
        <? } if($_SESSION["statusncr"]!='admin' && $_SESSION["statusncr"]!='staff' && $_SESSION["statusncr"]!='phar'  && $_SESSION["Userncr"]!=""){ ?>
        <li><a href="ncf_list_depart.php"><span>ใบรายงานเหตุการณ์ฯ</span></a></li>
        <ul>
	  	<li class="last"><a href="ncf_list_depart.php"><span>ใบรายงานเหตุการณ์ฯ  (โปรแกรมใหม่ 2556)</span></a></li>
	  	<li class="last"><a href="ncf_list_old.php"><span>ใบรายงานเหตุการณ์ฯ (โปรแกรมเก่า < 2556)</a></span></li>
       	</ul>
        <li><a href="#"><span>รายงานสรุป</span></a></li>
     	<ul>
	  	<li class="last"><a href="ncr_report_progarm.php"><span>รายงานสรุปอุบัติการณ์จำแนกตามโปรแกรม</span></a></li>
        <? if($_SESSION["statusncr"]=='IC'){ ?>
        <li class="last"><a href="report_ic_accident.php"><span>รายงานอุบัติการณ์ IC</span></a></li>
        <li class="last"><a href="ic_report_depart.php"><span>สรุปอุบัติการณ์ IC  ประจำปี</span></a></li>
        <? } ?>
	  <!--	<li class="last"><a href="ncf_report_depart.php"><span>หน่วยงานที่รายงานอุบัติการณ์</a></span></li>-->
       	</ul>
        <!--<li><a href="ncf_member.php"><span>สถิติความเสี่ยง</span></a></li>--> 
        <li><a href="ncf_member.php"><span>รายชื่อผู้ใช้ในระบบ</span></a></li>
        <li><a href="logout.php"><span>ออกจากระบบ</span></a></li>
      <?  }   if(!$_SESSION["Userncr"]){?>
        <li class="last"><a href="login.php"><span>เข้าสู่ระบบ</span></a></li>
        <? } ?>
         
	

    </ul>
</div>
<?
if(isset($_SESSION["Userncr"])){
include("connect.inc");

$strSQL = "SELECT * FROM member WHERE  username = '".$_SESSION["Userncr"]."'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
?>
<span class="fontsara">ผู้ใช้งานขณะนี้ ::  <strong><?=$objResult['name']?></strong> &nbsp;&nbsp;<strong><?=$_SESSION["Untilncr"]?></strong></span> <? } ?>
<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">aaa</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
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
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('nonconf_date'));

};

</script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>


<form name="f1" action="" method="post">
  <table  border="0" cellpadding="3" cellspacing="3">
    <tr class="forntsarabun">
      <td  align="right" bgcolor="#FFFFCC">&nbsp;</td>
      <td bgcolor="#FFFFCC" >ค้นหา</td>
    </tr>
    <tr class="forntsarabun">
      <td width="64"  align="right">เลือกปี</td>
      <td width="387" ><!--      <select name="m_start" class="forntsarabun">
        <option value="">---ไม่เลือกเดือน---</option>
        <option value="01" <?//if($m=='01'){ echo "selected"; }?>>มกราคม</option>
        <option value="02" <?//if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
        <option value="03" <?//if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
        <option value="04" <?//if($m=='04'){ echo "selected"; }?>>เมษายน</option>
        <option value="05" <?//if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
        <option value="06" <?//if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
        <option value="07" <?//if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
        <option value="08" <?//if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
        <option value="09" <?//if($m=='09'){ echo "selected"; }?>>กันยายน</option>
        <option value="10" <?//if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
        <option value="11" <?//if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
        <option value="12" <?//if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
      </select>-->
        <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='forntsarabun'>";
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
    <tr>
      <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>
        &nbsp;&nbsp;
        <input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun"></td>
    </tr>
  </table>
</form>
<HR>
<?php

include("connect.inc");

	if($_POST['y_start']!=''){
	$date1=($_POST['y_start']);
	}else{
	$date1=(date("Y")+543);
	}

$sql1="SELECT nonconf_id, ncr, until, date_format(nonconf_date,'%d/%m/')as date1,date_format(nonconf_date,'%Y')as date2,  left(nonconf_time,5) as time ,risk1, risk2, risk3, risk4, risk5, risk6, risk7, risk8, risk9,nonconf_dategroup ,`return`,clinic FROM  ncr2556  	WHERE  `nonconf_date` 
LIKE  '$date1%' AND ( `risk1`  =1 OR  `risk2`  =1 OR  `risk3`  =1 OR  `risk4`  =1 OR  `risk5`  =1 OR  `risk6`  =1 OR  `risk7`  =1 OR  `risk8`  =1 OR  `risk9`  =1 ) order by ncr desc";	

	//echo $sql1;
	$query1 = mysql_query($sql1)or die (mysql_error());
	$row=mysql_num_rows($query1);
	
	

	/*if($row){*/

	// print "<div><font class='forntsarabun' >สถิติผู้ป่วยในจำแนกตาม แพทย์ $_POST[doctor]  $ประจำ$day  $dateshow </font></div><br>";
	?>
  <h1 class="forntsarabun" align="center">ใบรายงานเหตุการณ์ที่มีการระบุความเสี่ยงมากกว่า1ข้อ <font color="#FF0000"> ปี 
  <?=($date1)?></font></h1>
   <table width="100%" border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td width="5%" align="center">ลำดับ</td>
    <td width="35%" align="center">หน่วยงาน/ทีม</td>
    <td align="center">วันที่เขียนรายงาน</td>
    <td align="center">วันที่รายงานจริง</td>
    <td align="center">เวลา</td>
    <td align="center">NCR </td>
    <td align="center">สถานะส่งกลับ</td>
    <td align="center">ความรุนแรง</td>
    <td align="center">ความเสี่ยง</td>
    <?
	 if($_SESSION["statusncr"]=='admin'){
	?>
    <td width="5%" align="center">แก้ไข</td>
    <td width="5%" align="center">ลบ</td>
    <? } ?>
    <td width="5%" align="center">พิมพ์</td>
    </tr>
    <?
	$i=0;
	while($arr1=mysql_fetch_array($query1)){
	
	$sum=$arr1['risk1']+$arr1['risk2']+$arr1['risk3']+$arr1['risk4']+$arr1['risk5']+$arr1['risk6']+$arr1['risk7']+$arr1['risk8']+$arr1['risk9'];
	
	if($sum>1){
	
		
		$sql="SELECT * FROM `departments` where code='".$arr1['until']."' and status='y' ";
		$query=mysql_query($sql)or die (mysql_error());
		$arr=mysql_fetch_array($query);
		
$i++;
if($i%2==0)
{
$bg = "#CCCCCC";
}
else
{
$bg = "#FFFFFF";
}

if($arr1['risk2']=='1'){
	$risk="IC";
	$riskCount1++;
}else if ($arr1['risk3']=='1'){
	$risk="MR";
	$riskCount2++;
}else if ($arr1['risk2']=='1' and $arr1['risk3']=='1'){
	$risk="IC,MR";
	$riskCount3++;	
}else{
	$risk="";
}
$dategroup=explode("-",$arr1['nonconf_dategroup']);

if($arr1['return']==1){
	$arr1['return']="ศูนย์คุณภาพ";
}else{
	$arr1['return']="";
}



if($arr1['risk1']=="1"){	
		$showrisk1="1.Clinical Risk , ";
		}else{
		$showrisk1="";
		}
		if($arr1['risk2']=="1"){
		$showrisk2="2.Infection control Risk , ";	
		}else{
		$showrisk2="";
		}
		if($arr1['risk3']=="1"){
		$showrisk3="3.Medication Risk , ";
		}else{
		$showrisk3="";
		}
		if($arr1['risk4']=="1"){
		$showrisk4="4.Medical Equipment Risk , ";
		}else{
		$showrisk4="";
		}
		if($arr1['risk5']=="1"){
		$showrisk5="5.Safety and Environment Risk , ";	
		}else{
		$showrisk5="";
		}
		if($arr1['risk6']=="1"){
		$showrisk6="6.Customer Complaint Risk , ";	
		}else{
		$showrisk6="";
		}
		if($arr1['risk7']=="1"){
		$showrisk7="7.Financial Risk ,";	
		}else{
		$showrisk7="";
		}
		if($arr1['risk8']=="1"){
		$showrisk8="8.Utilization Management Risk , ";
		}else{
		$showrisk8="";
		}
		if($arr1['risk9']=="1"){
		$showrisk9="9.Information Risk ";	
		}else{
		$showrisk9="";
		}
	?>
    <tr bgcolor="<?=$bg;?>">
      <td align="center"><?=$i?></td>
      <td><?=$arr['name']?></td>
      <td><?=$arr1['date1'].($arr1['date2'])?></td>
      <td><?=$dategroup[1].'-'.$dategroup[0]?></td>
      <td><?=$arr1['time']?></td>
      <td><?=$arr1['ncr']?></td>
      <td><?=$arr1['return']?></td>
      <td align="center"><?=$arr1['clinic']?>&nbsp;</td>
      <td><?=$showrisk1.$showrisk2.$showrisk3.$showrisk4.$showrisk5.$showrisk6.$showrisk7.$showrisk8.$showrisk9?></td>
      <?
	 if($_SESSION["statusncr"]=='admin'){
	?>
      <td align="center"><a  href="ncf2_edit.php?nonconf_id=<?=$arr1['nonconf_id'];?>" target="_blank">แก้ไข</a></td>
      <td align="center"><a href="javascript:if(confirm('ยืนยันการลบ NCR : <?=$arr1['nonconf_id']?>')==true){MM_openBrWindow('ncf_del.php?id=<?=$arr1['nonconf_id']?>','','width=400,height=500')}">ลบ</a></td>
      <?  } ?>
      <td align="center"><a  href="ncf_print.php?ncr_id=<?=$arr1['nonconf_id'];?>" target="_blank">พิมพ์</a></td>
     </tr>
    <?
	}  
	
	}
	?>
    </table>
    
    <BR>
    
    <? 	
	$sql2="SELECT nonconf_id, ncr, until, date_format(nonconf_date,'%d/%m/')as date1,date_format(nonconf_date,'%Y')as date2,  left(nonconf_time,5) as time ,risk1, risk2, risk3, risk4, risk5, risk6, risk7, risk8, risk9,nonconf_dategroup ,`return`,clinic FROM  ncr2556  	WHERE  `nonconf_date` 
LIKE  '$date1%' AND ( `risk1`  =0 and `risk2`  =0 and  `risk3`  =0 and  `risk4`  =0 and `risk5`  =0 and  `risk6`  =0 and `risk7` =0 and  `risk8`  =0 and  `risk9`  =0 ) order by ncr desc";	

	$query2 = mysql_query($sql2)or die (mysql_error());
	$row2=mysql_num_rows($query2);
	
	?>
  <h1 class="forntsarabun" align="center">ใบรายงานเหตุการณ์ที่ยังไม่ได้ระบุความเสี่ยง <font color="#FF0000"> ปี 
  <?=($date1)?></font></h1>
   <table width="100%" border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td width="5%" align="center">ลำดับ</td>
    <td width="35%" align="center">หน่วยงาน/ทีม</td>
    <td align="center">วันที่เขียนรายงาน</td>
    <td align="center">วันที่รายงานจริง</td>
    <td align="center">เวลา</td>
    <td align="center">NCR </td>
    <td align="center">สถานะส่งกลับ</td>
    <td align="center">ความรุนแรง</td>
    <td align="center">ความเสี่ยง</td>
    <?
	 if($_SESSION["statusncr"]=='admin'){
	?>
    <td width="5%" align="center">แก้ไข</td>
    <td width="5%" align="center">ลบ</td>
    <? } ?>
    <td width="5%" align="center">พิมพ์</td>
    </tr>
    <?
	$i=0;
	while($arr2=mysql_fetch_array($query2)){
	
	//$sum=$arr1['risk1']+$arr1['risk2']+$arr1['risk3']+$arr1['risk4']+$arr1['risk5']+$arr1['risk6']+$arr1['risk7']+$arr1['risk8']+$arr1['risk9'];
	
	//if($sum>1){
	
		
		$sql="SELECT * FROM `departments` where code='".$arr2['until']."' and status='y' ";
		$query=mysql_query($sql)or die (mysql_error());
		$arr=mysql_fetch_array($query);
		
$i++;
if($i%2==0)
{
$bg = "#CCCCCC";
}
else
{
$bg = "#FFFFFF";
}

if($arr2['risk2']=='1'){
	$risk="IC";
	$riskCount1++;
}else if ($arr2['risk3']=='1'){
	$risk="MR";
	$riskCount2++;
}else if ($arr2['risk2']=='1' and $arr2['risk3']=='1'){
	$risk="IC,MR";
	$riskCount3++;	
}else{
	$risk="";
}
$dategroup=explode("-",$arr2['nonconf_dategroup']);

if($arr2['return']==1){
	$arr2['return']="ศูนย์คุณภาพ";
}else{
	$arr2['return']="";
}

if($arr2['risk1']=="1"){	
		$showrisk1="1.Clinical Risk , ";
		}else{
		$showrisk1="";
		}
		if($arr2['risk2']=="1"){
		$showrisk2="2.Infection control Risk , ";	
		}else{
		$showrisk2="";
		}
		if($arr2['risk3']=="1"){
		$showrisk3="3.Medication Risk , ";
		}else{
		$showrisk3="";
		}
		if($arr2['risk4']=="1"){
		$showrisk4="4.Medical Equipment Risk , ";
		}else{
		$showrisk4="";
		}
		if($arr2['risk5']=="1"){
		$showrisk5="5.Safety and Environment Risk , ";	
		}else{
		$showrisk5="";
		}
		if($arr2['risk6']=="1"){
		$showrisk6="6.Customer Complaint Risk , ";	
		}else{
		$showrisk6="";
		}
		if($arr2['risk7']=="1"){
		$showrisk7="7.Financial Risk ,";	
		}else{
		$showrisk7="";
		}
		if($arr2['risk8']=="1"){
		$showrisk8="8.Utilization Management Risk , ";
		}else{
		$showrisk8="";
		}
		if($arr2['risk9']=="1"){
		$showrisk9="9.Information Risk ";	
		}else{
		$showrisk9="";
		}
	?>
    <tr bgcolor="<?=$bg;?>">
      <td align="center"><?=$i?></td>
      <td><?=$arr['name']?></td>
      <td><?=$arr2['date1'].($arr2['date2'])?></td>
      <td><?=$dategroup[1].'-'.$dategroup[0]?></td>
      <td><?=$arr2['time']?></td>
      <td><?=$arr2['ncr']?></td>
      <td><?=$arr2['return']?></td>
      <td align="center"><?=$arr2['clinic']?></td>
      <td><?=$showrisk1.$showrisk2.$showrisk3.$showrisk4.$showrisk5.$showrisk6.$showrisk7.$showrisk8.$showrisk9?></td>
      <?
	 if($_SESSION["statusncr"]=='admin'){
	?>
      <td align="center"><a  href="ncf2_edit.php?nonconf_id=<?=$arr2['nonconf_id'];?>" target="_blank">แก้ไข</a></td>
      <td align="center"><a href="javascript:if(confirm('ยืนยันการลบ NCR : <?=$arr2['nonconf_id']?>')==true){MM_openBrWindow('ncf_del.php?id=<?=$arr2['nonconf_id']?>','','width=400,height=500')}">ลบ</a></td>
      <?  } ?>
      <td align="center"><a  href="ncf_print.php?ncr_id=<?=$arr2['nonconf_id'];?>" target="_blank">พิมพ์</a></td>
     </tr>
    <?
	}  
	
	//}
	?>
  </table>
<?
/*echo "<BR>IC =".$riskCount1;
echo "<BR>MR=".$riskCount2;

echo "<BR>รวม =".$a=$riskCount1+$riskCount2;*/
/*}else{
	echo "<font class=\"forntsarabun\">ไม่มีข้อมูลของ $_POST[doctor]  $day  $dateshow</font>";
}*/
?>
 <BR>
    
    <? 	
	$sql2="SELECT nonconf_id, ncr, until, date_format(nonconf_date,'%d/%m/')as date1,date_format(nonconf_date,'%Y')as date2,  left(nonconf_time,5) as time ,nonconf_dategroup ,risk1, risk2, risk3, risk4, risk5, risk6, risk7, risk8, risk9,nonconf_dategroup ,`return`,clinic FROM  ncr2556  	WHERE  `nonconf_date` 
LIKE  '$date1%' and clinic ='' order by ncr desc";	

	$query2 = mysql_query($sql2)or die (mysql_error());
	$row2=mysql_num_rows($query2);

	?>
  <h1 class="forntsarabun" align="center">ใบรายงานเหตุการณ์ที่ยังไม่ได้ระบุความรุนแรง <font color="#FF0000"> ปี 
  <?=($date1)?></font></h1>
   <table width="100%" border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td width="5%" align="center">ลำดับ</td>
    <td width="35%" align="center">หน่วยงาน/ทีม</td>
    <td align="center">วันที่เขียนรายงาน</td>
    <td align="center">วันที่รายงานจริง</td>
    <td align="center">เวลา</td>
    <td align="center">NCR </td>
    <td align="center">สถานะส่งกลับ</td>
    <td align="center">ความรุนแรง</td>
    <td align="center">ความเสี่ยง</td>
    <?
	 if($_SESSION["statusncr"]=='admin'){
	?>
    <td width="5%" align="center">แก้ไข</td>
    <td width="5%" align="center">ลบ</td>
    <? } ?>
    <td width="5%" align="center">พิมพ์</td>
    </tr>
    <?
	$i=0;
	while($arr2=mysql_fetch_array($query2)){
	
	//$sum=$arr1['risk1']+$arr1['risk2']+$arr1['risk3']+$arr1['risk4']+$arr1['risk5']+$arr1['risk6']+$arr1['risk7']+$arr1['risk8']+$arr1['risk9'];
	
	//if($sum>1){
	
		
		$sql="SELECT * FROM `departments` where code='".$arr2['until']."' and status='y' ";
		$query=mysql_query($sql)or die (mysql_error());
		$arr=mysql_fetch_array($query);
		
$i++;
if($i%2==0)
{
$bg = "#CCCCCC";
}
else
{
$bg = "#FFFFFF";
}

if($arr2['risk2']=='1'){
	$risk="IC";
	$riskCount1++;
}else if ($arr2['risk3']=='1'){
	$risk="MR";
	$riskCount2++;
}else if ($arr2['risk2']=='1' and $arr2['risk3']=='1'){
	$risk="IC,MR";
	$riskCount3++;	
}else{
	$risk="";
}
$dategroup=explode("-",$arr2['nonconf_dategroup']);

if($arr2['return']==1){
	$arr2['return']="ศูนย์คุณภาพ";
}else{
	$arr2['return']="";
}

if($arr2['risk1']=="1"){	
		$showrisk1="1.Clinical Risk , ";
		}else{
		$showrisk1="";
		}
		if($arr2['risk2']=="1"){
		$showrisk2="2.Infection control Risk , ";	
		}else{
		$showrisk2="";
		}
		if($arr2['risk3']=="1"){
		$showrisk3="3.Medication Risk , ";
		}else{
		$showrisk3="";
		}
		if($arr2['risk4']=="1"){
		$showrisk4="4.Medical Equipment Risk , ";
		}else{
		$showrisk4="";
		}
		if($arr2['risk5']=="1"){
		$showrisk5="5.Safety and Environment Risk , ";	
		}else{
		$showrisk5="";
		}
		if($arr2['risk6']=="1"){
		$showrisk6="6.Customer Complaint Risk , ";	
		}else{
		$showrisk6="";
		}
		if($arr2['risk7']=="1"){
		$showrisk7="7.Financial Risk ,";	
		}else{
		$showrisk7="";
		}
		if($arr2['risk8']=="1"){
		$showrisk8="8.Utilization Management Risk , ";
		}else{
		$showrisk8="";
		}
		if($arr2['risk9']=="1"){
		$showrisk9="9.Information Risk ";	
		}else{
		$showrisk9="";
		}
	?>
    <tr bgcolor="<?=$bg;?>">
      <td align="center"><?=$i?></td>
      <td><?=$arr['name']?></td>
      <td><?=$arr2['date1'].($arr2['date2'])?></td>
      <td><?=$dategroup[1].'-'.$dategroup[0]?></td>
      <td><?=$arr2['time']?></td>
      <td><?=$arr2['ncr']?></td>
      <td><?=$arr2['return']?></td>
      <td align="center"><?=$arr1['clinic']?></td>
      <td><?=$showrisk1.$showrisk2.$showrisk3.$showrisk4.$showrisk5.$showrisk6.$showrisk7.$showrisk8.$showrisk9?></td>
      <?
	 if($_SESSION["statusncr"]=='admin'){
	?>
      <td align="center"><a  href="ncf2_edit.php?nonconf_id=<?=$arr2['nonconf_id'];?>" target="_blank">แก้ไข</a></td>
      <td align="center"><a href="javascript:if(confirm('ยืนยันการลบ NCR : <?=$arr2['nonconf_id']?>')==true){MM_openBrWindow('ncf_del.php?id=<?=$arr2['nonconf_id']?>','','width=400,height=500')}">ลบ</a></td>
      <?  } ?>
      <td align="center"><a  href="ncf_print.php?ncr_id=<?=$arr2['nonconf_id'];?>" target="_blank">พิมพ์</a></td>
     </tr>
    <?
	}  
	
	//}
	?>
  </table>
<?
/*echo "<BR>IC =".$riskCount1;
echo "<BR>MR=".$riskCount2;

echo "<BR>รวม =".$a=$riskCount1+$riskCount2;*/
/*}else{
	echo "<font class=\"forntsarabun\">ไม่มีข้อมูลของ $_POST[doctor]  $day  $dateshow</font>";
}*/
?>
<BR>
 <? 	
	$sql2="SELECT nonconf_id, ncr, until, date_format(nonconf_date,'%d/%m/')as date1,date_format(nonconf_date,'%Y')as date2,  left(nonconf_time,5) as time ,nonconf_dategroup ,risk1, risk2, risk3, risk4, risk5, risk6, risk7, risk8, risk9,nonconf_dategroup ,`return`,clinic FROM  ncr2556  	WHERE  `nonconf_date` 
LIKE  '$date1%' and (( pro_f =''  and  pro_b ='' and pro_i ='' and pro_t='' and pro_s='')  or  ( pro_f is null and  pro_b is null and pro_i is null and pro_t is null and pro_s is null))order by ncr desc";	

	$query2 = mysql_query($sql2)or die (mysql_error());
	$row2=mysql_num_rows($query2);

	?>
  <h1 class="forntsarabun" align="center">ใบรายงานเหตุการณ์ที่ยังไม่ได้ระบุ  F B I T S<font color="#FF0000"> ปี 
  <?=($date1)?></font></h1>
   <table width="100%" border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td width="5%" align="center">ลำดับ</td>
    <td width="35%" align="center">หน่วยงาน/ทีม</td>
    <td align="center">วันที่เขียนรายงาน</td>
    <td align="center">วันที่รายงานจริง</td>
    <td align="center">เวลา</td>
    <td align="center">NCR </td>
    <td align="center">สถานะส่งกลับ</td>
    <td align="center">ความรุนแรง</td>
    <td align="center">ความเสี่ยง</td>
    <?
	 if($_SESSION["statusncr"]=='admin'){
	?>
    <td width="5%" align="center">แก้ไข</td>
    <td width="5%" align="center">ลบ</td>
    <? } ?>
    <td width="5%" align="center">พิมพ์</td>
    </tr>
    <?
	$i=0;
	while($arr2=mysql_fetch_array($query2)){
	
	//$sum=$arr1['risk1']+$arr1['risk2']+$arr1['risk3']+$arr1['risk4']+$arr1['risk5']+$arr1['risk6']+$arr1['risk7']+$arr1['risk8']+$arr1['risk9'];
	
	//if($sum>1){
	
		
		$sql="SELECT * FROM `departments` where code='".$arr2['until']."' and status='y' ";
		$query=mysql_query($sql)or die (mysql_error());
		$arr=mysql_fetch_array($query);
		
$i++;
if($i%2==0)
{
$bg = "#CCCCCC";
}
else
{
$bg = "#FFFFFF";
}

if($arr2['risk2']=='1'){
	$risk="IC";
	$riskCount1++;
}else if ($arr2['risk3']=='1'){
	$risk="MR";
	$riskCount2++;
}else if ($arr2['risk2']=='1' and $arr2['risk3']=='1'){
	$risk="IC,MR";
	$riskCount3++;	
}else{
	$risk="";
}
$dategroup=explode("-",$arr2['nonconf_dategroup']);

if($arr2['return']==1){
	$arr2['return']="ศูนย์คุณภาพ";
}else{
	$arr2['return']="";
}

if($arr2['risk1']=="1"){	
		$showrisk1="1.Clinical Risk , ";
		}else{
		$showrisk1="";
		}
		if($arr2['risk2']=="1"){
		$showrisk2="2.Infection control Risk , ";	
		}else{
		$showrisk2="";
		}
		if($arr2['risk3']=="1"){
		$showrisk3="3.Medication Risk , ";
		}else{
		$showrisk3="";
		}
		if($arr2['risk4']=="1"){
		$showrisk4="4.Medical Equipment Risk , ";
		}else{
		$showrisk4="";
		}
		if($arr2['risk5']=="1"){
		$showrisk5="5.Safety and Environment Risk , ";	
		}else{
		$showrisk5="";
		}
		if($arr2['risk6']=="1"){
		$showrisk6="6.Customer Complaint Risk , ";	
		}else{
		$showrisk6="";
		}
		if($arr2['risk7']=="1"){
		$showrisk7="7.Financial Risk ,";	
		}else{
		$showrisk7="";
		}
		if($arr2['risk8']=="1"){
		$showrisk8="8.Utilization Management Risk , ";
		}else{
		$showrisk8="";
		}
		if($arr2['risk9']=="1"){
		$showrisk9="9.Information Risk ";	
		}else{
		$showrisk9="";
		}
	?>
    <tr bgcolor="<?=$bg;?>">
      <td align="center"><?=$i?></td>
      <td><?=$arr['name']?></td>
      <td><?=$arr2['date1'].($arr2['date2'])?></td>
      <td><?=$dategroup[1].'-'.$dategroup[0]?></td>
      <td><?=$arr2['time']?></td>
      <td><?=$arr2['ncr']?></td>
      <td><?=$arr2['return']?></td>
      <td align="center"><?=$arr1['clinic']?></td>
      <td><?=$showrisk1.$showrisk2.$showrisk3.$showrisk4.$showrisk5.$showrisk6.$showrisk7.$showrisk8.$showrisk9?></td>
      <?
	 if($_SESSION["statusncr"]=='admin'){
	?>
      <td align="center"><a  href="ncf2_edit.php?nonconf_id=<?=$arr2['nonconf_id'];?>" target="_blank">แก้ไข</a></td>
      <td align="center"><a href="javascript:if(confirm('ยืนยันการลบ NCR : <?=$arr2['nonconf_id']?>')==true){MM_openBrWindow('ncf_del.php?id=<?=$arr2['nonconf_id']?>','','width=400,height=500')}">ลบ</a></td>
      <?  } ?>
      <td align="center"><a  href="ncf_print.php?ncr_id=<?=$arr2['nonconf_id'];?>" target="_blank">พิมพ์</a></td>
     </tr>
    <?
	}  
	
	//}
	?>
  </table>
<?
/*echo "<BR>IC =".$riskCount1;
echo "<BR>MR=".$riskCount2;

echo "<BR>รวม =".$a=$riskCount1+$riskCount2;*/
/*}else{
	echo "<font class=\"forntsarabun\">ไม่มีข้อมูลของ $_POST[doctor]  $day  $dateshow</font>";
}*/
?>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>