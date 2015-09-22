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
	
	table.forntsarabun a{
		color: #1800FF;
	}
	table.forntsarabun a.action-done{
		color: #10AA00;
	}
	
	</style>
	<script language="JavaScript" type="text/JavaScript">
	<!--
	function MM_openBrWindow(theURL,winName,features) { //v2.0
	  window.open(theURL,winName,features);
	}
	//-->
	</script>
<?php

include("connect.inc");
$months = array( 1 => 'ม.ค.','ก.พ.','มี.ค.','เม.ษ.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.',);
?>
	<table>
		<tbody>
			<tr>
				<td>
					<span>เลือกการแสดงผลตามปีที่เขียนรายงาน</span>
					<form action="ncf_listall.php" method="post" id="yearForm" style="display: inline;">
						<?php
						$sql = "SELECT date_format(`nonconf_date`, '%Y') as `years` FROM `ncr2556` GROUP BY `years` ORDER BY `years` DESC";
						$q = mysql_query($sql);
						?>
						<select id="year_select" name="set_year">
							<option value="0" >เลือกปี</option>
							<?php 
							$default_year = isset($_POST['set_year']) ? $_POST['set_year'] : 0;
							$i = 0;
							while($item = mysql_fetch_assoc($q)){
								
								// if($i === 0 && $default_year === null){
									// $default_year = $item['years'];
								// }
								
								$select = $default_year == $item['years'] ? 'selected="selected"' : '' ;
								
								?>
								<option value="<?php echo $item['years'];?>" <?php echo $select;?>><?php echo $item['years'];?></option>
								<?php
							}
							?>
						</select>
						
						<span>เลือกการแสดงผลตามเดือน</span>
						<select id="month_select" name="set_month">
							<option value="0" >เลือกเดือน</option>
							<?php 
							$default_month = isset($_POST['set_month']) ? $_POST['set_month'] : 0 ;
							foreach($months as $key => $month){
								
								$selected = ( $default_month == $key ) ? 'selected="selected"' : '' ;
								
								?>
								<option value="<?php echo $key;?>" <?php echo $selected;?> ><?php echo $month;?></option>
								<?php
							}
							?>
						</select>
						<?php 
							$late = isset($_POST['late']) ? 'checked="checked"' : '' ;
						?>
						<input type="checkbox" id="id_late" name="late" value="1" <?php echo $late;?>> <label for="id_late">แสดงเฉพาะรายงานย้อนหลัง</label>
						<button id="btn_submit" onclick="test_submit(this.form); return false;">แสดงผลรายงาน</button>
					</form>
					<script type="text/javascript">
						
						function test_submit(form){
							var year_selectd = document.getElementById('year_select').value;
							var month_selectd = document.getElementById('month_select').value;
							
							if(year_selectd == 0 || month_selectd == 0){
								
								// alert('กรุณาเลือกปีและเดือนที่ต้องการให้แสดงผล');
								// return false;
								
							}else{
								
								
							}
							
							var form = document.getElementById('yearForm')
								form.submit();
						}
					</script>
				</td>
			</tr>
		</tbody>
	</table>
	<br>
<?php

// $default_year = ( $default_year === 0 ) ? date('Y-m-d')


if($default_year != 0 && $default_month != 0){
	
	if(strlen($default_month) === 1){
		if($default_month == 0){
			$default_month = 1;
		}
		$default_month = "0$default_month";
	}

	$start_nonconf = "$default_year-$default_month-01";
	$convert_start_nonconf = ($default_year-543)."-$default_month-01";

	$lastest_day = date('t',strtotime($convert_start_nonconf));
	$end_nonconf = "$default_year-$default_month-$lastest_day";

}else{
	if($default_year == 0){
		$default_year = date('Y')+543;
	}
	
	$start_nonconf = "$default_year-01-01";
	$end_nonconf = "$default_year-12-31";
}

// แสดงใบรายงานทั้งหมด !!!! ตัวที่ NCR เป็น 000 !!!!
// $sql1="SELECT nonconf_id, ncr, until, date_format(nonconf_date,'%d/%m/') as date1, date_format(nonconf_date,'%Y') as date2, left(nonconf_time,5) as time, nonconf_dategroup, `return`   
// FROM  ncr2556 
// WHERE ncr='000' and ( 
	// ( risk1=1  or risk4=1 or risk5=1 or risk6=1 or risk7=1 or risk8=1 or risk9=1) 
	// and (risk2 !=1 or risk3 !=1) 
	// or (risk1=0 and risk2=0 and risk3=0 and risk4=0 and risk5=0 and risk6=0 and risk7=0 and risk8=0 and risk9=0)
// ) 
// order by ncr desc, nonconf_date desc, nonconf_time desc ";
$sql1="SELECT nonconf_id, ncr, until, date_format(nonconf_date,'%d/%m/') AS date1, date_format(nonconf_date,'%Y') AS date2, left(nonconf_time,5) AS time, nonconf_dategroup, `return`,`insert_date`, `date_edit`,`date_print`   
FROM  `ncr2556` 
WHERE ncr = '000' AND ( 
	( risk1=1  OR risk4=1 OR risk5=1 OR risk6=1 OR risk7=1 OR risk8=1 OR risk9=1) 
	AND (risk2 !=1 OR risk3 !=1) 
	OR (risk1=0 AND risk2=0 AND risk3=0 AND risk4=0 AND risk5=0 AND risk6=0 AND risk7=0 AND risk8=0 AND risk9=0)
) 
AND (nonconf_date >= '$start_nonconf' AND nonconf_date <= '$end_nonconf')
ORDER BY until ASC, nonconf_date DESC";

	$query1 = mysql_query($sql1) or die (mysql_error());
	$row=mysql_num_rows($query1);
	
	// แสดงใบรายงานทั้งหมด !!!! ตัวที่ NCR ไม่เป็น 000 !!!!
// $sql2="SELECT nonconf_id, ncr, until, date_format(nonconf_date,'%d/%m/') as date1, date_format(nonconf_date,'%Y') as date2, left(nonconf_time,5) as time, nonconf_dategroup, `return`, b.name 
// FROM ncr2556 AS a LEFT JOIN departments AS b ON (b.code = a.until) 
// WHERE ncr!='000' 
// and ( 
	// ( risk1=1  or risk4=1 or risk5=1 or risk6=1 or risk7=1 or risk8=1 or risk9=1) 
	// and (risk2 !=1 or risk3 !=1) 
	// or (risk1=0 and risk2=0 and risk3=0 and risk4=0 and risk5=0 and risk6=0 and risk7=0 and risk8=0 and risk9=0)
// ) 
// order by ncr desc, nonconf_date desc, nonconf_time desc ";

$and_late_condition = '';
if ( isset($_POST['late']) ) {
	$and_late_condition = "
	AND UNIX_TIMESTAMP( 
		CONCAT( ( date_format( nonconf_date, '%Y' ) -543 ) , date_format( nonconf_date, '-%m-%d' ) )
	) < UNIX_TIMESTAMP( date_format( insert_date, '%Y-%m-01' ) ) 
	";
}


$sql2="SELECT `nonconf_id`, `ncr`, `until`, `nonconf_date`, date_format(nonconf_date,'%d/%m/') AS date1, date_format(nonconf_date,'%Y') AS date2, left(nonconf_time,5) AS time, `nonconf_dategroup`, `return`, b.`name`, a.`insert_date`, a.`date_edit`,a.`date_print`  
FROM `ncr2556` AS a 
LEFT JOIN `departments` AS b ON b.`code` = a.`until` 
WHERE b.`status` = 'y' 
AND `ncr` != '000' 
AND ( 
	( risk1=1 OR risk4=1 OR risk5=1 OR risk6=1 OR risk7=1 OR risk8=1 OR risk9=1 ) 
	AND ( risk2 !=1 OR risk3 !=1 ) 
	OR ( risk1=0 AND risk2=0 AND risk3=0 AND risk4=0 AND risk5=0 AND risk6=0 AND risk7=0 AND risk8=0 AND risk9=0)
) 
AND (nonconf_date >= '$start_nonconf' AND nonconf_date <= '$end_nonconf')
$and_late_condition
ORDER BY until ASC, nonconf_date DESC";
// echo "<pre>";
// var_dump($sql2);
//echo $sql2;
//and ( ( risk1=1  or risk4=1 or risk5=1 or risk6=1 or risk7=1 or risk8=1 or risk9=1) and (risk2 !=1 or risk3 !=1) ) 
	$query2 = mysql_query($sql2) or die (mysql_error());
	$row2=mysql_num_rows($query2);
	
	/*if($row){*/
	
// print "<div><font class='forntsarabun' >สถิติผู้ป่วยในจำแนกตาม แพทย์ $_POST[doctor]  $ประจำ$day  $dateshow </font></div><br>";
	?>
   <table width="100%" border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td width="5%" align="center">ลำดับ</td>
    <td width="35%" align="center">หน่วยงาน/ทีม</td>
    <td align="center">วันที่เขียนรายงาน</td>
    <?php /* ?><td align="center">วันที่รายงานจริง</td><?php */ ?>
    <td align="center">เวลา</td>
    <td align="center">NCR </td>
    <td align="center">สถานะส่งกลับ</td>
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
	//for($n=1;$n<=$sumrow;$n++){	
		
		$sql="SELECT * FROM `departments` where code='".$arr1['until']."' and status='y' ";
		$query=mysql_query($sql)or die (mysql_error());
		$arr=mysql_fetch_array($query);
		
	$i++;
	if($i%2==0){
		$bg = "#CCCCCC";
	}else{
		$bg = "#FFFFFF";
	}

	$dategroup=explode("-",$arr1['nonconf_dategroup']);

	if($arr1['return']==1){
		$arr1['return']="ศูนย์คุณภาพ";
	}else{
		$arr1['return']="";
	}
	
	?>
    <tr bgcolor="<?=$bg;?>">
      <td align="center"><?=$i?></td>
      <td><?=$arr['name']?></td>
      <td><?=$arr1['date1'].($arr1['date2'])?></td>
      <?php /* ?><td><?=$dategroup[1].'-'.$dategroup[0]?></td><?php */ ?>
      <td><?=$arr1['time']?></td>
      <td><?=$arr1['ncr']?></td>
      <td><?=$arr1['return']?></td>
      <?
	 if($_SESSION["statusncr"]=='admin'){
		 
		 $color_edit = !empty($arr1['date_edit']) ? 'class="action-done"' : '' ;
		 $color_print = !empty($arr1['date_print']) ? 'class="action-done"' : '' ;
		 
	?>
      <td align="center"><a href="ncf2_edit.php?nonconf_id=<?=$arr1['nonconf_id'];?>" target="_blank" <?php echo $color_edit;?>>แก้ไข</a></td>
      <td align="center"><a href="javascript:if(confirm('ยืนยันการลบ NCR : <?=$arr1['nonconf_id']?>')==true){MM_openBrWindow('ncf_del.php?id=<?=$arr1['nonconf_id']?>','','width=400,height=500')}">ลบ</a></td>
      <?  } ?>
      <td align="center"><a  href="ncf_print.php?ncr_id=<?=$arr1['nonconf_id'];?>" target="_blank" <?php echo $color_print;?>>พิมพ์</a></td>
     </tr>
    <?
	}  // End while
	
	$i+1;
	$ii=0;
	while($arr2=mysql_fetch_array($query2)){
	//for($n=1;$n<=$sumrow;$n++){	
		
		// $sql="SELECT * FROM `departments` where code='".$arr2['until']."' and status='y' ";
		// $query=mysql_query($sql)or die (mysql_error());
		// $arr=mysql_fetch_array($query);
		
		$ii++;
		$i++;
		if($ii%2==0){
			$bg = "#CCCCCC";
		}else{
			$bg = "#FFFFFF";
		}

		$dategroup=explode("-",$arr2['nonconf_dategroup']);
		if($arr2['return']==1){
			$arr2['return']="ศูนย์คุณภาพ";
		}else{
			$arr2['return']="";
		}
		
		// ตรวจสอบการส่งงานว่าล่าช้าหรือไม่
		$check_nonconf = null;
		$convert_insert_date = strtotime($arr2['insert_date']);
		if($convert_insert_date != false){
			
			$first_of_month = strtotime(date('Y', $convert_insert_date).date('-m-01', $convert_insert_date));
			
			list($y, $m, $d) = explode('-', $arr2['nonconf_date']);
			$nonconf_ad = strtotime(($y-543)."-$m-$d");
			
			if($nonconf_ad < $first_of_month){
				$check_nonconf = 'style="color: #FFFFFF; background-color: #FF6E6E; font-weight: bold;"';
			}
		}
		
	?>
    <tr bgcolor="<?=$bg;?>" <?=$check_nonconf;?>>
      <td align="center"><?=$i?></td>
      <td><?=$arr2['name']?></td>
      <td><?=$arr2['date1'].($arr2['date2'])?></td>
      <?php /* ?><td><?=$dategroup[1].'-'.$dategroup[0]?></td><?php */ ?>
      <td><?=$arr2['time']?></td>
      <td><?=$arr2['ncr']?></td>
      <td><?=$arr2['return']?></td>
      <?
	 if($_SESSION["statusncr"]=='admin'){
		 $color_edit = !empty($arr2['date_edit']) ? 'class="action-done"' : '' ;
		 $color_print = !empty($arr2['date_print']) ? 'class="action-done"' : '' ;
	?>
      <td align="center"><a  href="ncf2_edit.php?nonconf_id=<?=$arr2['nonconf_id'];?>" target="_blank" <?php echo $color_edit;?>>แก้ไข</a></td>
      <td align="center"><a href="javascript:if(confirm('ยืนยันการลบ NCR : <?=$arr2['nonconf_id']?>')==true){MM_openBrWindow('ncf_del.php?id=<?=$arr2['nonconf_id']?>','','width=400,height=500')}">ลบ</a></td>
      <?  } ?>
      <td align="center"><a  href="ncf_print.php?ncr_id=<?=$arr2['nonconf_id'];?>" target="_blank" <?php echo $color_print;?>>พิมพ์</a></td>
     </tr>
    <?
	}  
	?>
    </table>
<?

/*}else{
	echo "<font class=\"forntsarabun\">ไม่มีข้อมูลของ $_POST[doctor]  $day  $dateshow</font>";
}*/
?><!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>