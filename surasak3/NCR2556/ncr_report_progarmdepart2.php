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
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<div id="no_print">
<? include("connect.inc"); ?>

<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td  align="right" bgcolor="#FFFFCC">&nbsp;</td>
    <td bgcolor="#FFFFCC" >ค้นหา</td>
  </tr>
  <tr class="forntsarabun">
    <td width="64"  align="right">เลือกปี</td>
    <td width="387" >
<!--<select name="m_start" class="forntsarabun">
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
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right">แผนก</td>
    <td ><SELECT NAME="until" class="forntsarabun">
      <Option value="">--------------</Option>
      <?php
										$sql="SELECT * FROM `departments` where status='y' ";
										$query=mysql_query($sql);
										
										while($arr=mysql_fetch_array($query)){
											echo "<option value='$arr[code]'>$arr[name]</option> ";
										}
									?>
    </SELECT></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;
    <input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun"></td>
  </tr>
</table>
</form>
</div>
<?

if(isset($_POST['submit'])){
	if($_POST['y_start']!=''){
	$date1=($_POST['y_start']);
	}else{
	$date1=(date("Y")+543);
	}

$sql2="SELECT * FROM `departments` where code='".$_POST['until']."' and status='y' ";
$query2=mysql_query($sql2);
$arr2=mysql_fetch_array($query2);
//echo $sql2;
			
///////////////////////////// Clinical Rick  //////////////////////		

$list01 = array();
$list02 = array();
$list03 = array();
$list04 = array();
$list05 = array();
$list06 = array();
$list07 = array();
$list08 = array();
$list09 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;

		$selectsql = "SELECT COUNT(*)  FROM    ncr2556  WHERE nonconf_date  like '".$date1."-".$m."-%' and 
		risk1='1'  and until ='".$_POST['until']."' ";
		$result = mysql_query($selectsql);
		$arr01 = mysql_fetch_array($result);
		array_push($list01,$arr01[0]);
	
		$selectsql = "SELECT COUNT(*)  FROM    ncr2556  WHERE nonconf_date  like '".$date1."-".$m."-%' and 
		risk2='1' and until ='".$_POST['until']."'";
		$result = mysql_query($selectsql);
		$arr02 = mysql_fetch_array($result);
		array_push($list02,$arr02[0]);
		
		$selectsql = "SELECT COUNT(*)  FROM    ncr2556  WHERE nonconf_date  like '".$date1."-".$m."-%' and 
		risk3='1' and until ='".$_POST['until']."' ";
		$result = mysql_query($selectsql);
		$arr03 = mysql_fetch_array($result);
		array_push($list03,$arr03[0]);
		
		$selectsql = "SELECT COUNT(*)  FROM    ncr2556  WHERE nonconf_date  like '".$date1."-".$m."-%' and 
		risk4='1' and until ='".$_POST['until']."'";
		$result = mysql_query($selectsql);
		$arr04 = mysql_fetch_array($result);
		array_push($list04,$arr04[0]);
		
		$selectsql = "SELECT COUNT(*)  FROM    ncr2556  WHERE nonconf_date  like '".$date1."-".$m."-%' and 
		risk5='1' and until ='".$_POST['until']."'";
		$result = mysql_query($selectsql);
		$arr05 = mysql_fetch_array($result);
		array_push($list05,$arr05[0]);

		$selectsql = "SELECT COUNT(*)  FROM    ncr2556  WHERE nonconf_date  like '".$date1."-".$m."-%' and 
		risk6='1' and until ='".$_POST['until']."'";
		$result = mysql_query($selectsql);
		$arr06 = mysql_fetch_array($result);
		array_push($list06,$arr06[0]);
		
		$selectsql = "SELECT COUNT(*)  FROM    ncr2556  WHERE nonconf_date  like '".$date1."-".$m."-%' and 
		risk7='1' and until ='".$_POST['until']."'";
		$result = mysql_query($selectsql);
		$arr07 = mysql_fetch_array($result);
		array_push($list07,$arr07[0]);
		
		$selectsql = "SELECT COUNT(*)  FROM    ncr2556  WHERE nonconf_date  like '".$date1."-".$m."-%' and 
		risk8='1' and until ='".$_POST['until']."'";
		$result = mysql_query($selectsql);
		$arr08 = mysql_fetch_array($result);
		array_push($list08,$arr08[0]);

		$selectsql = "SELECT COUNT(*)  FROM    ncr2556  WHERE nonconf_date  like '".$date1."-".$m."-%' and 
		risk9='1' and until ='".$_POST['until']."'";
		$result = mysql_query($selectsql);
		$arr09 = mysql_fetch_array($result);
		array_push($list09,$arr09[0]);
		
		
	}

?>

	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
<tr>
  <td rowspan="2" align="center" bgcolor="#00CCFF" class="forntsarabun">
    <p>โปรแกรม</p></td>
<td colspan="12" align="center" bgcolor="#00CCFF" class="forntsarabun">ปี 
  <?=($date1)?> แผนก <strong><?=$arr2['name']?></strong></td>
</tr>
<tr>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">ม.ค.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">ก.พ.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">มี.ค.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">เม.ย.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">พ.ค.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">มิ.ย.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">ก.ค.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">ส.ค.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">ก.ย.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">ต.ค.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">พ.ย.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">ธ.ค.</td>
</tr>
<tr>
<td class="forntsarabun">1.Clinical Rick </td>
<? for($ar=0;$ar <=11;$ar++){  
	
	$mon=$ar+1;
	if($mon<10){
			$mon = "0".$mon;
		}
 ?>
<? if ($list01[$ar]!=0){?>
  <td align="center" class="forntsarabun"><a href="detail_report_progarm.php?y=<?=$date1;?>&m=<?=$mon;?>&until=<?=$_POST['until']?>&risk=risk1" target="_blank"><?=$list01[$ar];?></a></td>
 <? 
	}else{
?>
<td align="center" class="forntsarabun"><?=$list01[$ar];?></td>
<?
  }
}
  ?>
  </tr>
<tr>
  <td class="forntsarabun">2. Infection control Rick </td>
  <? for($ar=0;$ar <=11;$ar++){  
	
	$mon=$ar+1;
	if($mon<10){
			$mon = "0".$mon;
		}
 ?>
	<? if ($list02[$ar]!=0){?>
  <td align="center" class="forntsarabun"><a href="detail_report_progarm.php?y=<?=$date1;?>&m=<?=$mon;?>&until=<?=$_POST['until']?>&risk=risk2" target="_blank"><?=$list02[$ar];?></a></td>
 <? 
	}else{
?>
<td align="center" class="forntsarabun"><?=$list02[$ar];?></td>
<?
  }
}
  ?>
  </tr>
<tr>
  <td class="forntsarabun">3.Medication Rick</td>
  <? for($ar=0;$ar <=11;$ar++){  
	
	$mon=$ar+1;
	if($mon<10){
			$mon = "0".$mon;
		}
 ?>
	<? if ($list03[$ar]!=0){?>
  <td align="center" class="forntsarabun"><a href="detail_report_progarm.php?y=<?=$date1;?>&m=<?=$mon;?>&until=<?=$_POST['until']?>&risk=risk3" target="_blank"><?=$list03[$ar];?></a></td>
 <? 
	}else{
?>
<td align="center" class="forntsarabun"><?=$list03[$ar];?></td>
<?
  }
}
  ?>
  </tr>
<tr>
  <td class="forntsarabun">4.Medical Equipment Rick</td>
   <? for($ar=0;$ar <=11;$ar++){  
	
	$mon=$ar+1;
	if($mon<10){
			$mon = "0".$mon;
		}
 ?>
	<? if ($list04[$ar]!=0){?>
  <td align="center" class="forntsarabun"><a href="detail_report_progarm.php?y=<?=$date1;?>&m=<?=$mon;?>&until=<?=$_POST['until']?>&risk=risk4" target="_blank"><?=$list04[$ar];?></a></td>
 <? 
	}else{
?>
<td align="center" class="forntsarabun"><?=$list04[$ar];?></td>
<?
  }
}
  ?>
  </tr>
<tr>
  <td class="forntsarabun">5.Safety and Environment Rick</td>
   <? for($ar=0;$ar <=11;$ar++){  
	
	$mon=$ar+1;
	if($mon<10){
			$mon = "0".$mon;
		}
 ?>
	<? if ($list05[$ar]!=0){?>
  <td align="center" class="forntsarabun"><a href="detail_report_progarm.php?y=<?=$date1;?>&m=<?=$mon;?>&until=<?=$_POST['until']?>&risk=risk5" target="_blank"><?=$list05[$ar];?></a></td>
 <? 
	}else{
?>
<td align="center" class="forntsarabun"><?=$list05[$ar];?></td>
<?
  }
}
  ?>
  </tr>
<tr>
  <td class="forntsarabun">6.Customer Complaint Rick</td>
   <? for($ar=0;$ar <=11;$ar++){  
	
	$mon=$ar+1;
	if($mon<10){
			$mon = "0".$mon;
		}
 ?>
	<? if ($list06[$ar]!=0){?>
  <td align="center" class="forntsarabun"><a href="detail_report_progarm.php?y=<?=$date1;?>&m=<?=$mon;?>&until=<?=$_POST['until']?>&risk=risk6" target="_blank"><?=$list06[$ar];?></a></td>
 <? 
	}else{
?>
<td align="center" class="forntsarabun"><?=$list06[$ar];?></td>
<?
  }
}
  ?>
  </tr>
<tr>
  <td class="forntsarabun">7.Financial Rick</td>
   <? for($ar=0;$ar <=11;$ar++){  
	
	$mon=$ar+1;
	if($mon<10){
			$mon = "0".$mon;
		}
 ?>
	<? if ($list07[$ar]!=0){?>
  <td align="center" class="forntsarabun"><a href="detail_report_progarm.php?y=<?=$date1;?>&m=<?=$mon;?>&until=<?=$_POST['until']?>&risk=risk7" target="_blank"><?=$list07[$ar];?></a></td>
 <? 
	}else{
?>
<td align="center" class="forntsarabun"><?=$list07[$ar];?></td>
<?
  }
}
  ?>
  </tr>
<tr>
  <td class="forntsarabun">8.Utilization Management Rick</td>
  <? for($ar=0;$ar <=11;$ar++){  
	
	$mon=$ar+1;
	if($mon<10){
			$mon = "0".$mon;
		}
 ?>
	<? if ($list08[$ar]!=0){?>
  <td align="center" class="forntsarabun"><a href="detail_report_progarm.php?y=<?=$date1;?>&m=<?=$mon;?>&until=<?=$_POST['until']?>&risk=risk8" target="_blank"><?=$list08[$ar];?></a></td>
 <? 
	}else{
?>
<td align="center" class="forntsarabun"><?=$list08[$ar];?></td>
<?
  }
}
  ?>
  </tr>
<tr>
  <td class="forntsarabun">9.Information Rick</td>
   <? for($ar=0;$ar <=11;$ar++){  
	
	$mon=$ar+1;
	if($mon<10){
			$mon = "0".$mon;
		}
 ?>
	<? if ($list09[$ar]!=0){?>
  <td align="center" class="forntsarabun"><a href="detail_report_progarm.php?y=<?=$date1;?>&m=<?=$mon;?>&until=<?=$_POST['until']?>&risk=risk9" target="_blank"><?=$list09[$ar];?></a></td>
 <? 
	}else{
?>
<td align="center" class="forntsarabun"><?=$list09[$ar];?></td>
<?
  }
}
  ?>
</tr>

<tr>
<td align="center" bgcolor="#FFFFCC" class="forntsarabun">รวม</td>
 
 <?
	$sum1=$list01[0]+$list02[0]+$list03[0]+$list04[0]+$list05[0]+$list06[0]+$list07[0]+$list08[0]+$list09[0];
	$sum2=$list01[1]+$list02[1]+$list03[1]+$list04[1]+$list05[1]+$list06[1]+$list07[1]+$list08[1]+$list09[1];
	$sum3=$list01[2]+$list02[2]+$list03[2]+$list04[2]+$list05[2]+$list06[2]+$list07[2]+$list08[2]+$list09[2];
	$sum4=$list01[3]+$list02[3]+$list03[3]+$list04[3]+$list05[3]+$list06[3]+$list07[3]+$list08[3]+$list09[3];
 	$sum5=$list01[4]+$list02[4]+$list03[4]+$list04[4]+$list05[4]+$list06[4]+$list07[4]+$list08[4]+$list09[4];
	$sum6=$list01[5]+$list02[5]+$list03[5]+$list04[5]+$list05[5]+$list06[5]+$list07[5]+$list08[5]+$list09[5];
	$sum7=$list01[6]+$list02[6]+$list03[6]+$list04[6]+$list05[6]+$list06[6]+$list07[6]+$list08[6]+$list09[6];
	$sum8=$list01[7]+$list02[7]+$list03[7]+$list04[7]+$list05[7]+$list06[7]+$list07[7]+$list08[7]+$list09[7];
	$sum9=$list01[8]+$list02[8]+$list03[8]+$list04[8]+$list05[8]+$list06[8]+$list07[8]+$list08[8]+$list09[8]; 
	$sum10=$list01[9]+$list02[9]+$list03[9]+$list04[9]+$list05[9]+$list06[9]+$list07[9]+$list08[9]+$list09[9];
	$sum11=$list01[10]+$list02[10]+$list03[10]+$list04[10]+$list05[10]+$list06[10]+$list07[10]+$list08[10]+$list09[10];
	$sum12=$list01[11]+$list02[11]+$list03[11]+$list04[11]+$list05[11]+$list06[11]+$list07[11]+$list08[11]+$list09[11];
 ?>
 
 
 
  <td align="center" bgcolor="#FFFFCC" class="forntsarabun"><?=$sum1;?></td>
  <td align="center" bgcolor="#FFFFCC" class="forntsarabun"><?=$sum2;?></td>
  <td align="center" bgcolor="#FFFFCC" class="forntsarabun"><?=$sum3;?></td>
  <td align="center" bgcolor="#FFFFCC" class="forntsarabun"><?=$sum4;?></td>
  <td align="center" bgcolor="#FFFFCC" class="forntsarabun"><?=$sum5;?></td>
  <td align="center" bgcolor="#FFFFCC" class="forntsarabun"><?=$sum6;?></td>
  <td align="center" bgcolor="#FFFFCC" class="forntsarabun"><?=$sum7;?></td>
  <td align="center" bgcolor="#FFFFCC" class="forntsarabun"><?=$sum8;?></td>
  <td align="center" bgcolor="#FFFFCC" class="forntsarabun"><?=$sum9;?></td>
  <td align="center" bgcolor="#FFFFCC" class="forntsarabun"><?=$sum10;?></td>
  <td align="center" bgcolor="#FFFFCC" class="forntsarabun"><?=$sum11;?></td>
  <td align="center" bgcolor="#FFFFCC" class="forntsarabun"><?=$sum12;?></td>
</tr>
</table>
<? } ?>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>