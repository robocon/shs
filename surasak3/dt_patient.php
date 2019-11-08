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

	

$sql = "Select toborow,diag From opday where thdatevn = '".date("d-m-").(date("Y")+543).$_SESSION["vn_now"]."' ";

list($toborow,$diag) = Mysql_fetch_row(Mysql_Query($sql));
$toborow = substr($toborow,4);

if($style_menu==2){?>
<TABLE align="center" border="1" bordercolor="#F0F000">
<TR>
	<TD>
<TABLE width="900">
<TR>
	<TD colspan="8" class="tb_head">ข้อมูลผู้ป่วย&nbsp;&nbsp;<strong style="color: #FF9900;"><?php echo $toborow;?></strong></TD>
</TR>
<TR>
	<TD align="right" class="tb_detail">VN : </TD>
	<TD><?php echo $_SESSION["vn_now"];?></TD>
	<TD align="right" class="tb_detail">ชื่อ-สกุล : </TD>
	<TD><?php echo $_SESSION["yot_now"];?> <?php echo $_SESSION["name_now"];?> <?php echo $_SESSION["surname_now"];?></TD>
	<TD align="right" class="tb_detail">อายุ : </TD>
	<TD><?php echo $_SESSION["age_now"];?></TD>
	<TD align="right" class="tb_detail">สิทธิการรักษา : </TD>
	<TD><?php echo $_SESSION["ptright_now"];?></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>


<?php
}else{
?>
<TABLE align="center" border="1" bordercolor="#F0F000">
<TR>
	<TD>
<TABLE width="900">
<TR>
	<TD colspan="7" class="tb_head">ข้อมูลผู้ป่วย&nbsp;&nbsp;<strong style="color: #FF9900;"><?php echo $toborow;?></strong></TD>
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
	<TD><FONT COLOR="#FF0000"><?php echo $_SESSION["ptright_now"];?></FONT></TD>
	<td rowspan="6">
		<IMG SRC="../image_patient/<?php echo $_SESSION["idcard_now"];?>.jpg" WIDTH="100" HEIGHT="150" BORDER="0" ALT="">
		</td>
</TR>
<TR>
	<TD colspan='6'>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" >
           <tr>
             <td  width="8" align="right" bgcolor='#C1FFD6'>T : </td>
             <td  align="left"><?php echo $_SESSION["temperature"];?> 
             C&deg; </td>
             <td  width="8" align="right" bgcolor='#C1FFD6'>P : </td>
             <td  align="left"><?php echo $_SESSION["pause"];?> 
             ครั้ง/นาที</td>
             <td  width="8" align="right" bgcolor='#C1FFD6'>R : </td>
             <td align="left"><?php echo $_SESSION["rate"];?>  
              ครั้ง/นาที</td>
			  <td  width="8" align="right" bgcolor='#C1FFD6'>BP : </td>
             <td align="left"><?php echo $_SESSION["bp"];?> 
             mmHg </td>
			  <td  width="35" align="right" bgcolor='#C1FFD6'>นน. : </td>
             <td align="left"><?php echo $_SESSION["weight"];?> 
             กก. </td>
			 <td  width="60" align="right" bgcolor='#C1FFD6'>ส่วนสูง. : </td>
             <td align="left"><?php echo $_SESSION["height"];?> 
             ซม. </td>
             
			 <td  width="8" align="right" bgcolor='#C1FFD6'>BMI : </td>
			 <td align="left"><?php if($_SESSION["height"] != "" && $_SESSION["height"] > 0){
				 $ht = $_SESSION["height"]/100;
				echo number_format(($_SESSION["weight"]/($ht*$ht)),2);
			 }?></td>

           </tr>
           <tr>
             <td align="left" colspan="14">Repeat BP : <?=$_SESSION['repeat_bp'];?> mmHg, สภาพ : <B><?php echo $_SESSION["type"];?></B> , โรคประจำตัว : <B><?php echo $_SESSION["congenital_disease"];?></B>
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

$sql = "Select drugcode, tradname,advreact,asses FROM drugreact WHERE  hn = '".$_SESSION["hn_now"]."' and groupname =''";

$result = Mysql_Query($sql);
$rows = Mysql_num_rows($result);
if($rows > 0){ 
		$txt = "";
		$i=1;
		$txt2 = array();
	while($arr = Mysql_fetch_assoc($result)){
		$txt .= "&nbsp;&nbsp;".$i.". ".$arr["drugcode"]." : ".$arr["tradname"];
		$txt2[$i-1] = $arr["tradname"];
		if($i%3==0) $txt .="<BR>"; else $txt.=",";
		$i++;
	}
	$_SESSION["list_drugreact"] = implode(", ",$txt2);
}else{
	$_SESSION["list_drugreact"] = "";
}

	echo "<TR><TD colspan='6'><FONT COLOR=\"red\"><B>",$txt_t," ",$txt,"</B></FONT></TD></TR>"; 




//แพ้ยาตามกลุ่ม
$sql = "Select distinct(groupname) as groupname,advreact,asses FROM drugreact WHERE  hn = '".$_SESSION["hn_now"]."' and groupname !=''";

$result = Mysql_Query($sql);
$rows = Mysql_num_rows($result);
if($rows > 0){ 
		$txt = "";
		$i=1;
		$txt2 = array();
	while($arr = Mysql_fetch_assoc($result)){
		$txt .= "&nbsp;&nbsp;".$i.". ".$arr["groupname"];
		$txt2[$i-1] = $arr["groupname"];
		if($i%3==0) $txt .="<BR>"; else $txt.=",";
		$i++;
	}
	$_SESSION["list_drugreact"] = implode(", ",$txt2);
}else{
	$_SESSION["list_drugreact"] = "";
}

	echo "<TR><TD colspan='6'><FONT COLOR=\"red\"><B>",$txt_t," ",$txt,"</B></FONT></TD></TR>"; 

?>
</TABLE>
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
$sql = "SELECT * FROM diabetes_clinic WHERE hn = '$hn' AND `dateN` LIKE '$year-%'";
$query_diabetes = mysql_query($sql);
$row = mysql_num_rows($query_diabetes);

if($row > 0){
	
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
	</style>
	<?php
	$style = '';
	if(isset($_SESSION['close_popup']) && $_SESSION['close_popup'] == true){
		$style = 'style="display: none;"';
	}
	?>
	<div id="btn-dialog">
		เปิดดูข้อมูลผู้ป่วยคลินิกเบาหวาน
	</div>
	<div id="dialog-contain" <?php echo $style;?>>
		<div id="msg-contain">
			<div title="ปิดหน้าต่าง" id="div-close">[ ปิดหน้าต่าง ]</div>
			<h2>รายละเอียดผู้ป่วยคลินิกเบาหวาน</h2>
			<div id="msg-contain">
				<table border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#ffffff">
					<tr>
						<td>Retinal Exam</td>
						<td colspan="12">
							<?php 
							$item = mysql_fetch_assoc($query_diabetes);
							if($item['retinal'] != ''){
								
								echo $item['retinal'];
								
								if($item['retinal_date'] != '0000-00-00 00:00:00'){
									list($retinal_date, $time) = explode(' ', $item['retinal_date']);
									echo '&nbsp;'.$retinal_date;
								}
							}else{
								echo '-';
							}
							?>
						</td>
					</tr>
					<tr>
						<td>Foot Exam</td>
						<td colspan="12">
							<?php 
							if($item['foot'] != ''){
								echo $item['foot'];
								
								if($item['foot_date'] != '0000-00-00 00:00:00'){
									list($foot_date, $time) = explode(' ', $item['foot_date']);
									echo '&nbsp;'.$foot_date;
								}
							}else{
								echo '-';
							}
							?>
						</td>
					</tr>
					<?php 

					$year = date('Y');
					$year_th = $year + 543;
					$prev_ymd = ($year - 1).date('-m-d');
					$current_ymd = date('Y-m-d');
					$months = array('01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค.', '04' => 'เม.ย.', '05' => 'พ.ค.', '06' => 'มิ.ย.', '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.');
					
					$sql = "SELECT a.hn,a.ptname,a.dm_no, a.dummy_no,b.labname,b.result_lab,b.dateY,DATE_FORMAT(b.dateY, '%Y-%m') AS `result_date`
					FROM ( 
						SELECT * FROM diabetes_clinic_history 
						WHERE hn = '$hn' 
						AND ( dateN > '$prev_ymd 00:00:00' AND dateN <= '$current_ymd 23:59:59' )
					) AS a 
					LEFT JOIN diabetes_lab AS b ON b.dm_no = a.dm_no 
					WHERE b.dummy_no = a.dummy_no 
					ORDER BY b.dateY ASC";
					$qLab = mysql_query($sql);
					
					$labLists = array();
					while ( $labItem = mysql_fetch_assoc($qLab) ) { 

						$key = $labItem['labname'];
						$subKey = $labItem['result_date'];
						$labLists[$key][$subKey] = $labItem;
					}

					?>
					<tr>
						<td class="tb-bold">พ.ศ. <?php echo $year_th; ?></td>
						<?php
						foreach($months as $mnum => $mname){
							?>
							<td class="tb-bold"><?php echo $mname;?></td>
							<?php
						}
						?>
					</tr>
					<tr>
						<td>BS (mg%)</td>
						<?php
						foreach($months as $mnum => $mname){
							$find_key = "$year-$mnum";
							
							$val = '-';
							if(isset($labLists['BS'][$find_key])){
								$val = $labLists['BS'][$find_key]['result_lab'];
							}
							
							?>
							<td align="center"><?php echo $val;?></td>
							<?php
						}
						?>
					</tr>
					<tr>
						<td>HbA1c (%)</td>
						<?php
						
						foreach($months as $mnum => $mname){
							$find_key = "$year-$mnum";
							
							$val = '-';
							if(isset($labLists['HbA1c'][$find_key])){
								$val = $labLists['HbA1c'][$find_key]['result_lab'];
							}
							?>
							<td align="center"><?php echo $val;?></td>
							<?php
						}
						?>
					</tr>
					<tr>
						<td>LDL (mg/dl)</td>
						<?php
						
						foreach($months as $mnum => $mname){
							$find_key = "$year-$mnum";
							
							$val = '-';
							if(isset($labLists['LDL'][$find_key])){
								$val = $labLists['LDL'][$find_key]['result_lab'];
							}
							?>
							<td align="center"><?php echo $val;?></td>
							<?php
						}
						?>
					</tr>
					<tr>
						<td>Creatinine (mg/dl)</td>
						<?php
						
						foreach($months as $mnum => $mname){
							$find_key = "$year-$mnum";
							
							$val = '-';
							if(isset($labLists['Creatinine'][$find_key])){
								$val = $labLists['Creatinine'][$find_key]['result_lab'];
							}
							?>
							<td align="center"><?php echo $val;?></td>
							<?php
						}
						?>
					</tr>
					<tr>
						<td>Urine protein (mg/dl)</td>
						<?php
						foreach($months as $mnum => $mname){
							$find_key = "$year-$mnum";
							
							$val = '-';
							if(isset($labLists['Urine protein'][$find_key])){
								$val = $labLists['Urine protein'][$find_key]['result_lab'];
							}
							?>
							<td align="center"><?php echo $val;?></td>
							<?php
						}
						?>
					</tr>
					<tr>
						<td>Microalbuminuria</td>
						<?php
						foreach($months as $mnum => $mname){
							$find_key = "$year-$mnum";
							
							$val = '-';
							if(isset($labLists['Urine Microalbumin'][$find_key])){
								$val = $labLists['Urine Microalbumin'][$find_key]['result_lab'];
							}
							?>
							<td align="center"><?php echo $val;?></td>
							<?php
						}
						?>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<script src="js/vendor/jquery-1.11.2.min.js"></script>
	<script type="text/javascript">
	$(function(){
		$(document).on('click', '#div-close', function(){
			
			$.ajax({
				url: "ajax_functions.php",
				method: "post",
				data: {'action':'close_popup','do':'true'},
				success: function(res){
					console.log(res);
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