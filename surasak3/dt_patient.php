<SCRIPT LANGUAGE="JavaScript">

function show_tooltip(title,detail,al,l,r){

	tooltip.style.left=document.body.scrollLeft+event.clientX+l;
	tooltip.style.top=document.body.scrollTop+event.clientY+r;
	tooltip.innerHTML="";
	tooltip.innerHTML = tooltip.innerHTML+"<TABLE border=\"1\" bordercolor=\"blue\"><TR bgcolor=\"blue\"><TD align=\"center\"><B><FONT COLOR=\"#FFFFFF\">"+title+"</FONT></B></TD></TR><TR><TD align=\""+al+"\">"+detail+"</TD></TR></TABLE>";
	tooltip.style.display="";
}

function hid_tooltip(){
	tooltip.style.display="none";
	tooltip.innerHTML = "";

}

function handlerMMX(e){
	x = (document.layers) ? e.pageX : document.body.scrollLeft+event.clientX

	return x;
}

function handlerMMY(e){
	y = (document.layers) ? e.pageY : document.body.scrollTop+event.clientY
	return y;
}

</SCRIPT>

<?php

if( !function_exists('dump') ){
	function dump($txt){
		echo "<pre>";
		echo var_dump($txt);
		echo "</pre>";
	}
	
}

$sql = "Select toborow,diag,ptright From opday where thdatevn = '".date("d-m-").(date("Y")+543).$_SESSION["vn_now"]."' ";

list($toborow,$diag,$ptright) = Mysql_fetch_row(Mysql_Query($sql));
$toborow = substr($toborow,4);


$sql1 = "Select cvriskscore,cvriskscore_lab From opd where thdatehn = '".date("d-m-").(date("Y")+543).$_SESSION["hn_now"]."' ";
//echo $sql1;
list($cvriskscore,$cvriskscore_lab) = Mysql_fetch_row(Mysql_Query($sql1));

$sql2 = "Select smoke_amount From opd where thdatehn = '".date("d-m-").(date("Y")+543).$_SESSION["hn_now"]."' ";
//echo $sql1;
list($smoke_amount) = Mysql_fetch_row(Mysql_Query($sql2));
$smoketotal=$smoke_amount*365;
$smokescore=$smoketotal/20;
if($smokescore > 20){
	$smokeshow="<span style='color:red;'>$smokescore</span>";
}else{
	$smokeshow="<span style='color:blue;'>$smokescore</span>";
}	
//echo "==>".$smokescore;


$sql3 = "Select hospcode From opcard where hn = '".$_SESSION["hn_now"]."' ";
list($hospcode) = Mysql_fetch_row(Mysql_Query($sql3));

if($style_menu==2){?>
<TABLE width="90%" align="center" border="1" bordercolor="#F0F000">
<TR>
	<TD>
<TABLE width="100%">
<TR>
	<TD colspan="8" class="tb_head">ข้อมูลผู้ป่วย&nbsp;&nbsp;<strong style="color: #F4D03F; text-shadow: black 0.1em 0.1em 0.2em;"><?php echo $toborow;?></strong></TD>
</TR>
<TR>
	<TD align="right" class="tb_detail">VN : </TD>
	<TD><?php echo $_SESSION["vn_now"];?></TD>
	<TD align="right" class="tb_detail">ชื่อ-สกุล : </TD>
	<TD><?php echo $_SESSION["yot_now"];?> <?php echo $_SESSION["name_now"];?> <?php echo $_SESSION["surname_now"];?></TD>
	<TD align="right" class="tb_detail">อายุ : </TD>
	<TD><?php echo $_SESSION["age_now"];?></TD>
	<TD align="right" class="tb_detail">สิทธิการรักษา : </TD>
	<TD><?php echo $ptright;?></TD>
</TR>
<?php 
if(!empty($hospcode)){
	?>
	<TR>
		<TD align="right" class="tb_detail">รพ.ต้นสังกัด : </TD>
		<TD colspan="6"><?php echo $hospcode;?></TD>
	</TR>
	<?php
}
?>
</TABLE>
</TD>
</TR>
</TABLE>


<?php
}else{
?>
<TABLE width="90%" align="center" border="1" bordercolor="#F0F000">
<TR>
	<TD>
<TABLE width="100%">
<TR>
	<TD colspan="7" class="tb_head">ข้อมูลผู้ป่วย&nbsp;&nbsp;<strong style="color: #F4D03F; text-shadow: black 0.1em 0.1em 0.2em;"><?php echo $toborow;?></strong></TD>
</TR>
<TR>
	<TD align="right" class="tb_detail">VN : </TD>
	<TD><?php echo $_SESSION["vn_now"];?></TD>
	<TD align="right" class="tb_detail">HN : </TD>
	<TD><?php echo $_SESSION["hn_now"];?></TD>
	<TD align="right" class="tb_detail">ชื่อ-สกุล : </TD>
	<TD style="color:#FF0000;font-weight:bold;"><?php echo $_SESSION["yot_now"];?> <?php echo $_SESSION["name_now"];?> <?php echo $_SESSION["surname_now"];?></TD>
</TR>
<TR>
	<TD align="right" class="tb_detail">อายุ : </TD>
	<TD><?php echo $_SESSION["age_now"];?></TD>
	<TD align="right" class="tb_detail">เลขบัตรประชาชน : </TD>
	<TD><?php echo $_SESSION["idcard_now"];?></TD>
	<TD align="right" class="tb_detail">สิทธิการรักษา : </TD>
	<TD><FONT COLOR="#FF0000"><?php echo $ptright;?></FONT></TD>
	<td rowspan="3">
		<?php 
		$imgPath = '../image_patient/'.$_SESSION["idcard_now"].'.jpg';
		if(is_file($imgPath)==false){
			$imgPath = '../image_patient/NoPicture.jpg';
		}
		?>
		<IMG SRC="<?=$imgPath;?>" WIDTH="100" HEIGHT="150" BORDER="0" ALT="">
	</td>
</TR>
<?php 
if(!empty($hospcode)){
	?>
	<TR>
		<TD align="right" class="tb_detail">รพ.ต้นสังกัด : </TD>
		<TD colspan="6"><FONT COLOR="#FF0000"><?php echo $hospcode;?></FONT></TD>
	</TR>
	<?php
}
?>
<TR>
	<TD colspan='6'>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" >
           <tr>
             <td  width="" align="right" bgcolor='#C1FFD6'>T : </td>
             <td  align="left"><?php echo $_SESSION["temperature"];?> 
             C&deg; </td>
             <td  width="" align="right" bgcolor='#C1FFD6'>P : </td>
             <td  align="left"><?php echo $_SESSION["pause"];?> 
             ครั้ง/นาที</td>
             <td  width="" align="right" bgcolor='#C1FFD6'>R : </td>
             <td align="left"><?php echo $_SESSION["rate"];?>  
              ครั้ง/นาที</td>
			  <td  width="" align="right" bgcolor='#C1FFD6'>BP : </td>
             <td align="left"><?php echo $_SESSION["bp"];?> 
             mmHg </td>
			  <td  width="" align="right" bgcolor='#C1FFD6'>นน. : </td>
             <td align="left"><?php echo $_SESSION["weight"];?> 
             กก. </td>
			 <td  width="" align="right" bgcolor='#C1FFD6'>ส่วนสูง. : </td>
             <td align="left"><?php echo $_SESSION["height"];?> 
             ซม. </td>
             
			 <td  width="" align="right" bgcolor='#C1FFD6'>BMI : </td>
			 <td align="left"><?php if($_SESSION["height"] != "" && $_SESSION["height"] > 0){
				 $ht = $_SESSION["height"]/100;
				echo number_format(($_SESSION["weight"]/($ht*$ht)),2);
			 }?></td>

           </tr>
		   <? if($smokescore > 0){ ?>
           <tr>
             <td align="left" colspan="14">จำนวนที่สูบบุหรี่ :  <B><?php echo $smokeshow;?></B> (ซอง/ปี) </td>
           </tr>
		   <? } ?>			   
		   <tr>
             <td align="left" colspan="14">
				<?php 
				if(!empty($cvriskscore)){
					?>CV risk score (ไม่ใช้ผลเลือด) : <B><?php echo $cvriskscore;?></B>, <?php
				}
				if(!empty($cvriskscore_lab)){
					?>CV risk score (ใช้ผลเลือด) : <B><?php echo $cvriskscore_lab;?></B>, <?php
				}
				?>
				Repeat BP : <b><?=$_SESSION['repeat_bp'];?></b> mmHg, สภาพ : <B><?php echo $_SESSION["type"];?></B>, โรคประจำตัว : <B><?php echo $_SESSION["congenital_disease"];?></B>
			&nbsp;&nbsp;&nbsp;&nbsp;, อาการ : <B><?php echo $_SESSION["organ"];?></B>
             </td>
           </tr>
		   <tr>
             <td align="left" colspan="14">เวลารับบัตร : <B><?php echo $_SESSION["time_opday"];?></B>&nbsp;, เวลาซักประวัติ : <B><?php echo $_SESSION["time_opd"];?></B>&nbsp;, เวลาแพทย์ตรวจ : <B><?php echo date("H:i");?></B>
             </td>
           </tr>
		  </table>
	</TD>
	</TD>
</TR>
<?php

if($_SESSION["drugreact"]=='1'){
	$txt_t = "ผู้ป่วยแพ้ยา ";
}else if($_SESSION["drugreact"]=='0'){
	$txt_t = "ผู้ป่วยไม่แพ้ยา ";
}

$sql = "SELECT drugcode, tradname,advreact,asses,genname,sideeffects 
FROM drugreact 
WHERE  hn = '".$_SESSION["hn_now"]."' 
AND advreact != '' 
AND g6pd IS NULL 
GROUP BY `drugcode` ";

$result = Mysql_Query($sql);
$rows = Mysql_num_rows($result);
if($rows > 0){ 
	$txt = "";
	$i=1;
	$txt2 = array();
	
	echo "<tr><td colspan='7'>";
	?>
	<style>
		.patient_drugreact{
			border-collapse: collapse;
			color:red;
		}
		.patient_drugreact tr{
			line-height: 16px;
		}
		.patient_drugreact td{
			font-size: 22px;
		}
	</style>
	<table width="100%">
		<tr>
			<td valign="top">
				<b style="color:red;"><a href="javascript:void(0);" onclick="show_drugreact_hn('<?=$_SESSION['hn_now'];?>')">แพ้ยา</a>:</b>
				<script>
					// เปิด popup หน้าแพ้ยา
					function show_drugreact_hn(hn){
						window.open('show_drugreact_hn.php?hn='+hn, "WindowShowDrugreact","width=800,height=600");
					}
				</script>
				<!-- <table width="100%" class="patient_drugreact"> -->
	<?php
	$test_i = 1;
	$item_per_line = 2;

	while($arr = Mysql_fetch_assoc($result)){
		$txt .= "&nbsp;&nbsp;".$i.".) ".$arr["drugcode"]." : ".$arr["tradname"]." [".$arr["genname"]."]";
		$txt2[$i-1] = $arr["tradname"]." ".$arr["genname"];
		// if($i%3==0) $txt .="<BR>"; else $txt.=",";

		// if($test_i%$item_per_line===1){
		// 	echo "<tr>";
		// }

		$row_span='';
		if($test_i===$rows){
			$row_span='colspan="2"';
		}

		// echo "<td $row_span>".$i.".) <b>".$arr['drugcode']."</b> : <span style='font-size:20px;'>".$arr["tradname"]." [".$arr["genname"]."]</span></td>";
		echo $i.".) <b>".$arr['drugcode']."</b> : <span style='font-size:20px; color: red;'>".$arr["tradname"]." [".$arr["genname"]."]</span>&nbsp;&nbsp;&nbsp;";
		// if($test_i%$item_per_line===0 OR $test_i===$rows){
		// 	echo "</tr>";
		// }

		$i++;
		$test_i++;
	}
	?>
			<!-- </table> -->
			</td>
		</tr>
	</table>
	<?php
	echo "</td></tr>";


	$_SESSION["list_drugreact"] = implode(", ",$txt2);
}else{
	$_SESSION["list_drugreact"] = "";
}

	// echo "<TR><TD colspan='6'><FONT COLOR=\"red\"><B>แพ้ยา : ",$txt_t," ",$txt,"</B></FONT></TD></TR>"; 
	$sqlAdvreact = "SELECT advreact FROM drugreact WHERE hn = '".$_SESSION["hn_now"]."' AND advreact != '' GROUP BY `advreact` ";
	$resultAdv = Mysql_Query($sqlAdvreact);
	if(mysql_num_rows($resultAdv)>0){
		$adv = mysql_fetch_assoc($resultAdv);
		?>
		<tr>
			<td colspan="7"><b>อาการ:</b> <?=$adv['advreact'];?></td>
		</tr>
		<?php
	}



//แพ้ยาตามกลุ่ม
$sql1 = "Select distinct(groupname) as groupname,advreact,asses 
FROM drugreact 
WHERE  hn = '".$_SESSION["hn_now"]."' 
and groupname !='' 
and sideeffects=''";
$result1 = Mysql_Query($sql1);
$rows1 = Mysql_num_rows($result1);
if($rows1 > 0){ 
		$txt1 = "";
		$i=1;
		$txt21 = array();
	while($arr1 = Mysql_fetch_assoc($result1)){ 
		$groupName = $arr1["groupname"];

		$sql = "SELECT * FROM drugreact_group WHERE name = '$groupName' ";
		$q = mysql_query($sql);
		if(mysql_num_rows($q)>0){
			$group = mysql_fetch_assoc($q);
			$id = $group['id'];
		}

		$txt1 .= '&nbsp;&nbsp;'.$i.'.) <a href="javascript:void(0);" onclick="showDrugreactGroup(\''.$id.'\')">'.$groupName.'</a>';
		$txt21[$i-1] = $arr1["groupname"];
		if($i%3==0) $txt1 .="<BR>"; else $txt1.=",";
		$i++;
	}
	$_SESSION["list_drugreact"] = implode(", ",$txt21);

	echo "<TR><TD colspan='7'><FONT COLOR=\"red\"><B>กลุ่มยาที่แพ้ : ",$txt1,"</B></FONT></TD></TR>"; 

}else{
	//echo $sql;
	$_SESSION["list_drugreact"] = "";
}
?>
</TABLE>
<script>
	function showDrugreactGroup(id){
		window.open('show_drugreact_group_list.php?id='+id,'showDrugreactGroup','width=800,height=600,left=100,top=100');
	}
</script>
</TD>
</TR>
</TABLE>
<?php echo "<CENTER>ผู้ซักประวัติ : ".$_SESSION["staff"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<FONT COLOR='#3300FF'>แพทย์ : <B>".$_SESSION["dt_doctor"]."</B> เป็นผู้ทำการตรวจ</FONT>&nbsp;&nbsp;<FONT COLOR='#FF0000'><B>DIAG:&nbsp;$diag</B></FONT></CENTER>";?>
<?php }?>
<div id = "tooltip" style="position:absolute;display:none;background-color:#FFFFFF;" >
</div>

<?php 
if($_SESSION["sIdname"] != "md19921" && $_SESSION["sIdname"] != "monchai"){  //ไม่ให้แสดงรายละเอียดคลินิกเบาหวาน
// ดึงข้อมูลผู้ป่วยคลินิกเบาหวาน
$hn = $_SESSION['hn_now'];
$year = date('Y');

// ถ้ามีข้อมูล Active 3ปีย้อนหลัง
$sql = "SELECT `row_id`,`hn`,`dm_no`,`dateN` 
FROM diabetes_clinic 
WHERE hn = '$hn' 
AND TIMESTAMPDIFF(YEAR,`dateN`,NOW()) < 3";
$query_diabetes = mysql_query($sql);
$row_diabet = mysql_num_rows($query_diabetes);

if($row_diabet > 0){
	$dmUser = mysql_fetch_assoc($query_diabetes);
	$dmNo = $dmUser['dm_no']
	?>
	<style type="text/css">
	#dialog-contain{
		border: 1px solid #333333; 
		width: auto; 
		padding: 1.4em; 
		position: absolute; 
		top: 0.2em; 
		right: 0.2em; 
		background-color: #ffffff;
		z-index: 10;
	}
	#dialog-contain p, 
	#dialog-contain h2{
		margin: 0;
		padding: 0;
	}
	#div-close{
		cursor: pointer; 
		position: absolute; 
		top: -1.2em; 
		right: 0.2em;
		color: red;
	}
	#msg-contain{
		position: relative; 
	}
	.tb-bold{
		font-weight: bold;
	}
	
	#btn-dialog{
		display: inline-block;
		position: absolute;
		top: 0.2em;
		right: 0.2em;
		border: 2px solid red;
		padding: 0.4em;
	}
	#btn-dialog:hover{
		cursor: pointer;
	}

	.chk_table{
    border-collapse: collapse;
	}

	.chk_table, 
	.chk_table th, 
	.chk_table td{
		border: 1px solid black;
		font-size: 16pt;
		padding: 3px;
	}

	</style>
	<?php
	$style = '';
	if(isset($_SESSION['close_popup']) && $_SESSION['close_popup'] == true){
		$style = 'style="display: none;"';
	}
	?>
	<div id="btn-dialog">
		คลินิกเบาหวาน
	</div>
	<div id="dialog-contain" <?php echo $style;?>>
		<div id="msg-contain">
			<div title="ปิดหน้าต่าง" id="div-close">[ ปิดหน้าต่าง ]</div>
			<h2>รายละเอียดผู้ป่วยคลินิกเบาหวาน</h2>
			<div id="msg-contain">

				<?php 
				$dtNow = date('Y-m-d');
				$dtPass = date('Y-m-d', strtotime("-2 years"));

				$tempSQL = "CREATE TEMPORARY TABLE `tmp_diabet_history` 
				SELECT * 
				FROM `diabetes_clinic_history` 
				WHERE `hn` = '$hn' 
				AND ( `dateN` >= '$dtPass 00:00:00' AND `dateN` <= '$dtNow 23:59:59' ) ";
				$qTmp = mysql_query($tempSQL);
				if($qTmp === false){
					echo mysql_error();
				}

				$months = array('01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค.', '04' => 'เม.ย.', '05' => 'พ.ค.', '06' => 'มิ.ย.', '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.');
				
				$sql = "SELECT `row_id`,`dateN`,`foot`,`retinal`,`tooth`,
				SUBSTRING(`foot_date`,1,10) AS `foot_date`,
				SUBSTRING(`retinal_date`,1,10) AS `retinal_date`,
				SUBSTRING(`tooth_date`,1,10) AS `tooth_date`,
				CONCAT((SUBSTRING(`dateN`,1,4)+543),SUBSTRING(`dateN`,5,6)) AS `thaidate`
				FROM `tmp_diabet_history` 
				ORDER BY `row_id` DESC";
				$qDiabetHis = mysql_query($sql);
				if($qTmp === false){
					echo mysql_error();
				}

				// สถานะข้อมูลย้อนหลัง2ปี ถ้าไม่มีให้แจ้งเตือน
				$diabetStatus = false;

				if( mysql_num_rows($qDiabetHis) > 0 ){
					$diabetStatus = true;
					?>
					<table class="chk_table">
						<tr>
							<th>วันที่มารับบริการ</th>
							<th>Foot Exam</th>
							<th>Retinal Exam</th>
							<th>ตรวจสุขภาพฟัน</th>
						</tr>
						<?php 
						while ( $item = mysql_fetch_assoc($qDiabetHis) ) {
							$id = $item['row_id'];
							?>
							<tr>
								<td><?=$item['thaidate'];?></td>
								<td>
									<span id="foot<?=$id;?>"><?=$item['foot'];?></span>
									<span id="date_foot<?=$id;?>">
									<?php 
									if( $item['foot_date']!=='0000-00-00' ){
										echo '('.$item['foot_date'].')';
									}
									?>
									</span>
									<a href="javascript:void(0);" class="editPart" data-id="<?=$id;?>" data-part="foot" ><img src="images/icons/page_white_edit.png" title="คลิกเพื่อแก้ไขข้อมูล" alt="แก้ไข"></a>
								</td>
								<td>
									<span id="retinal<?=$id;?>"><?=$item['retinal'];?></span>
									<span id="date_retinal<?=$id;?>">
									<?php 
									if( $item['retinal_date']!=='0000-00-00' ){
										echo '('.$item['retinal_date'].')';
									}
									?>
									</span>
									<a href="javascript:void(0);" class="editPart" data-id="<?=$id;?>" data-part="retinal" ><img src="images/icons/page_white_edit.png" title="คลิกเพื่อแก้ไขข้อมูล" alt="แก้ไข"></a>
								</td>
								<td>
									<span id="tooth<?=$id;?>">
									<?php 
									if( $item['tooth'] !== '' ){
										if ( $item['tooth'] == 0 ) {
											echo 'ไม่ได้รับการตรวจ';
	
										}elseif( $item['tooth'] == 1 ){
											echo 'ได้รับการตรวจ';
										}
									}
									?>
									</span>
									<span id="date_tooth<?=$id;?>">
									<?php 
									if( $item['tooth_date']!=='0000-00-00' ){
										echo '('.$item['tooth_date'].')';
									}
									?>
									</span>
									<a href="javascript:void(0);" class="editPart" data-id="<?=$id;?>" data-part="tooth"><img src="images/icons/page_white_edit.png" title="แก้ไข" alt="แก้ไข"></a>
								</td>
							</tr>
							<?php
						}
						?>
					</table>
					<br>
					<?php
				}
				
				$sql = "SELECT a.`hn`,a.`ptname`,a.`dm_no`, a.`dummy_no`,b.`labname`,b.`result_lab`,b.`dateY`,
				DATE_FORMAT(b.`dateY`, '%Y') AS `year`,
				DATE_FORMAT(b.`dateY`, '%m') AS `month`,
				DATE_FORMAT(b.`dateY`, '%Y-%m') AS `result_date`
				FROM `tmp_diabet_history` AS a 
				LEFT JOIN ( 
					SELECT * FROM `diabetes_lab` 
					WHERE `dm_no` = '$dmNo' 
					AND ( `dateY` >= '$dtPass 00:00:00' AND `dateY` <= '$dtNow 23:59:59' )
				) AS b ON b.`dm_no` = a.`dm_no` 
				ORDER BY b.`dateY` ASC";
				$qLab = mysql_query($sql);
				if($qLab === false){
					echo mysql_error();
				}

				$labLists = array(); // เก็บค่าผลแลป
				$yearList = array(); // แสดงปีตรงหัวตาราง
				$countYearMonth = array(); // แสดงเดือนตรงหัวตาราง
				
				if( mysql_num_rows($qLab) > 0 ){

					$diabetStatus = true;
				
					// ตัวนับเดือนของแต่ละปี
					while ( $labItem = mysql_fetch_assoc($qLab) ) { 

						$kYear = $labItem['year'];
						$kMonth = $labItem['month'];
						$subKey = $labItem['result_date'];

						$labname = $labItem['labname'];

						$yearList[$kYear][$kMonth] = 1;
						$countYearMonth[$subKey] = $kMonth;
						
						$labLists[$subKey.$labname] = $labItem;

					}

					mysql_query("DROP TEMPORARY TABLE `tmp_diabet_history`;");

					// รายการ Lab ที่จะแสดง
					$labItemsTr = array('BS','HbA1c','LDL','Creatinine','Urine protein','Urine Microalbumin');

					?>
					<table class="chk_table">
						<tr>
							<th rowspan="2">รายการตรวจ</th>
							<?php 
							foreach ($yearList as $key => $y) {
								$Col = count($y);
								?>
								<th colspan="<?=$Col;?>" align="center">ปี <?=$key+543;?></th>
								<?php 
								
							}
							?>
						</tr>
						<tr>
							<?php 
							foreach ($countYearMonth as $m => $mv) {
								?>
								<th align="center"><?=$months[$mv];?></th>
								<?php
							}
							?>
						</tr>
						<?php 
						foreach ($labItemsTr as $trKey => $trVal) {
							?>
							<tr>
								<td><?=$trVal;?></td>
								<?php 
								foreach ($countYearMonth as $m => $mv) { 

									$res = '-';
									if( $labLists[$m.$trVal]['labname'] == $trVal ){
										$res = $labLists[$m.$trVal]['result_lab'];
									}
									?>
									<td align="center"><?=$res;?></td>
									<?php
								}
								?>
							</tr>
							<?php
						}
						?>
					</table>
					<?php 
				}

				if( $diabetStatus == false ){ 
					// $months
					list($yDM,$mDM,$dDM) = explode('-', $dmUser['dateN']);
					echo "ไม่มีข้อมูล2ปีย้อนหลัง ผู้ป่วยมีข้อมูลDMครั้งสุดท้ายเมื่อ $dDM ".$months[$mDM].' '.($yDM+543);
				}
				?>
			</div>
		</div>
	</div>
	<!-- form แก้ไขข้อมูล -->
	<style>
	#formEditPageBackground, #formEditPageContainer{
		display: none;
	}
	#formEditPageBackground{
		width: 100%;
		height: 100%;
		background-color: #8c8c8c;
		position: fixed;
		top: 0;
		left: 0;
		z-index: 11;
	}
	#formEditPageContainer{
		z-index: 12;
		background: #ffffff;
		width: 600px;
		height: 250px;
		position: absolute;
		padding: 8px; 
		border: 6px solid #000000;
		top: 25%;
		left: 50%; 
		margin-left: -25%;
	}
	#epoch_popup_calendar{
		z-index:90!important;
	}
	table.calendar input, table.calendar select {
		font-size: 14px!important;
	}
	table.calendar td, table.calendar th {
		font-size: 14px!important;
	}
	</style>
	<div id="formEditPageBackground" style=""></div>
	<div id="formEditPageContainer" style="">
		<div class="closeFormEditPage" style="float: right; cursor: pointer;"><img src="images/icons/Remove_32x32.png" alt="Close"></div>
		<div id="editPageContent" style="float:left;"></div>
	</div>

	<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
	<script type="text/javascript" src="epoch_classes.js"></script>

	<script src="js/vendor/jquery-1.11.2.min.js"></script>
	<script type="text/javascript">
	$(function(){ 

		$(document).on('click', '.closeFormEditPage', function(){
			$('#formEditPageBackground').hide();
			$('#formEditPageContainer').hide();

			$('#editPageContent').html(''); 
		});

		// โหลดหน้าแก้ไขข้อมูล Foot Exam Retinal Exam ตรวจสุขภาพฟัน
		$(document).on('click', '.editPart', function(){

			$('#formEditPageBackground').show();
			$('#formEditPageContainer').show();

			var part = $(this).attr('data-part');
			var id = $(this).attr('data-id');
			$.ajax({
				url: "dt_diabetes.php",
				method: "post",
				data: {'id':id,'part':part},
				success: function(res){
					$('#editPageContent').html(res); 

					var map1, map2, map3;

					// Load Epoch Calendar
					var map1  = new Epoch('epoch_popup','popup',document.getElementById('foot_date'));
					var map2  = new Epoch('epoch_popup','popup',document.getElementById('retinal_date'));
					var map3  = new Epoch('epoch_popup','popup',document.getElementById('tooth_date'));

				}
			});
		});

		// บันทึกข้อมูล
		$(document).on('click', '#btnSaveEditForm', function(e){
			e.preventDefault();
			var part = $('#editFormPart').val();
			var id = $('#editFormId').val();
			var itemRes = $('.itemEditForm:checked').val();
			var itemDate = $('.itemDateForm').val();
			var date_n = $('#editFormDateN').val();
			var hn = $('#editFormHn').val();
			
			$.ajax({
				url: "dt_diabetes.php",
				method: "post",
				data: {'action':'save','part':part,'id':id,'result':itemRes,'date':itemDate,'date_n':date_n,'hn':hn},
				success: function(res){
					var item = JSON.parse(res);
					if( item.resTxt === true ){ 
						$('#formEditResponse').html(item.msg).show();

						if(part==='tooth'){
							if(itemRes == 0){
								itemRes = 'ไม่ได้รับการตรวจ';
							}else if(itemRes == 1){
								itemRes = 'ได้รับการตรวจ';
							}
						}

						$('#'+part+id).html(itemRes);
						$('#date_'+part+id).html('('+itemDate+')');

					}
				}
			});
		});

		$(document).on('click', '#div-close', function(){
			
			$.ajax({
				url: "ajax_functions.php",
				method: "post",
				data: {'action':'close_popup','do':'true'},
				success: function(res){
					// console.log(res);
				}
			});
			
			$('#dialog-contain').hide();
			$('#btn-dialog').show();
		});
		
		$(document).on('click', '#btn-dialog', function(){
			$('#btn-dialog').hide();
			$('#dialog-contain').show();
			
		});
	});
	</script>
	<?php
	}
}  //close if session
?>
<style>
    #billing-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 5px 15px;
        border-radius: 6px;
        font-family: 'TH SarabunPSK';
        background: #ffffff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        border: 1px solid #e2e8f0;
        border-left: 5px solid #cbd5e0;
        margin: 5px 0;
    }

    .billing-section {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 24px;
    }

    .billing-data {
        white-space: nowrap;
        margin-right: 15px;
    }

    .label-sm {
        color: #718096;
        font-size: 24px;
        margin-right: 4px;
    }

    .value-sm {
        font-weight: bold;
        color: #2d3748;
		font-size: 24px;
    }

    /* สถานะการแสดงผล */
    .bar-danger { border-left-color: #e53e3e; background-color: #fff5f5; color: #c53030; }
    .bar-warning { border-left-color: #dd6b20; background-color: #fffaf0; color: #9c4221; }
    .bar-success { border-left-color: #38a169; background-color: #f0fff4; color: #276749; }
    .bar-skip { border-left-color: #3182ce; background-color: #ebf8ff; color: #2b6cb0; }

    #mini-msg {
        font-weight: bold;
        margin-left: auto;
        padding-left: 15px;
        border-left: 1px solid rgba(0,0,0,0.1);
    }
</style>

<?php
// 1. กำหนดกลุ่มรหัสสิทธิที่ต้องการตรวจสอบไว้ใน Array (แก้ไขง่ายในที่เดียว)
$check_rights = array('R07', 'R09', 'R10', 'R11', 'R12', 'R13', 'R14', 'R17', 'R35', 'R36', 'R43', 'R44', 'R60', 'R61');

// 2. ตัด 3 ตัวแรกของสิทธิปัจจุบันมาเช็ค
$current_right = substr($_SESSION["ptright_now"], 0, 3);

// 3. ตรวจสอบว่าสิทธิปัจจุบันอยู่ในกลุ่มที่กำหนดหรือไม่
if (in_array($current_right, $check_rights)) {
?>

<div id="billing-container" class="bar-skip">
    <div class="billing-section">
        <span id="mini-icon">ℹ️</span>
        <div class="billing-data">
            <span class="value-sm" id="display-ptname">กำลังโหลด...</span>
        </div>
        
        <div class="billing-data">
            <span class="label-sm">สิทธิ:</span>
            <span class="value-sm" id="display-right">-</span>
        </div>

        <div class="billing-data">
            <span class="label-sm">วงเงิน:</span>
            <span class="value-sm" style="color:green;" id="display-limit">-</span>
        </div>

        <div class="billing-data">
            <span class="label-sm">ใช้ไป:</span>
            <span class="value-sm" style="color:blue;" id="display-spent">-</span>
        </div>

        <div class="billing-data">
            <span class="label-sm">คงเหลือ:</span>
            <span class="value-sm" style="color:red;" id="display-remaining">-</span>
        </div>
		
		<div class="billing-data">
		<span class="value-sm" style="color:#000000; margin-left:50px;">⚕️ (ไม่รวมค่า LAB/XRAY/หัตถการ)  🔬☢️</span>
		</div>
    </div>

    <div id="mini-msg">ตรวจสอบข้อมูล...</div>
</div>
<?php } ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    // ดึงค่า VN จากตัวแปร PHP ในหน้าจอนั้นๆ
    var current_vn = "<?php echo $_SESSION["vn_now"]; ?>"; 
    
    // URL ของ API ที่ Server ใหม่ (PHP 7+)
    var api_url = "http://192.168.131.191/JSON/summary_payment_json.php?vn="+current_vn;
	//alert(api_url);
	$.getJSON(api_url, function(data) {
		if(data.status === "success") {
			$("#display-ptname").text(data.patient.name);
			$("#display-right").text(data.patient.right);
			$("#display-spent").text(data.billing.spent_total.toLocaleString());
			
			var container = $("#billing-container").removeClass("bar-danger bar-warning bar-success bar-skip");
			var msg = $("#mini-msg");
			var icon = $("#mini-icon");

			if(data.should_check) {
				$("#display-limit").text(data.billing.limit.toLocaleString());
				$("#display-remaining").text(data.billing.remaining.toLocaleString());

				if(data.flags.alert_level === "danger") {
					container.addClass("bar-danger");
					msg.html("⚠️ เกินวงเงิน!");
					icon.text("🚨");
				} else if(data.flags.alert_level === "warning") {
					container.addClass("bar-warning");
					msg.html("🟡 ใกล้เต็ม");
					icon.text("⚠️");
				} else {
					container.addClass("bar-success");
					msg.html("✅ ปกติ");
					icon.text("🟢");
				}
			} else {
				$("#display-limit").text("ไม่จำกัดวงเงิน");
				$("#display-remaining").text("เบิกได้ตามสิทธิ");
				container.addClass("bar-skip");
				msg.html("สิทธิทั่วไป");
				icon.text("ℹ️");
			}
		}
	});
});
</script>
