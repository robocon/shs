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

$sql = "Select toborow,diag From opday where thdatevn = '".date("d-m-").(date("Y")+543).$_SESSION["vn_now"]."' ";

list($toborow,$diag) = Mysql_fetch_row(Mysql_Query($sql));
$toborow = substr($toborow,4);

if($style_menu==2){?>
<TABLE align="center" border="1" bordercolor="#F0F000">
<TR>
	<TD>
<TABLE width="900">
<TR>
	<TD colspan="8" class="tb_head">�����ż�����&nbsp;&nbsp;<strong style="color: #FF9900;"><?php echo $toborow;?></strong></TD>
</TR>
<TR>
	<TD align="right" class="tb_detail">VN : </TD>
	<TD><?php echo $_SESSION["vn_now"];?></TD>
	<TD align="right" class="tb_detail">����-ʡ�� : </TD>
	<TD><?php echo $_SESSION["yot_now"];?> <?php echo $_SESSION["name_now"];?> <?php echo $_SESSION["surname_now"];?></TD>
	<TD align="right" class="tb_detail">���� : </TD>
	<TD><?php echo $_SESSION["age_now"];?></TD>
	<TD align="right" class="tb_detail">�Է�ԡ���ѡ�� : </TD>
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
	<TD colspan="7" class="tb_head">�����ż�����&nbsp;&nbsp;<strong style="color: #FF9900;"><?php echo $toborow;?></strong></TD>
</TR>
<TR>
	<TD align="right" class="tb_detail">VN : </TD>
	<TD><?php echo $_SESSION["vn_now"];?></TD>
	<TD align="right" class="tb_detail">HN : </TD>
	<TD><?php echo $_SESSION["hn_now"];?></TD>
	<TD align="right" class="tb_detail">����-ʡ�� : </TD>
	<TD style="color:#FF0000;font-weight:bold;"><?php echo $_SESSION["yot_now"];?> <?php echo $_SESSION["name_now"];?> <?php echo $_SESSION["surname_now"];?></TD>
</TR>
<TR>
	<TD align="right" class="tb_detail">���� : </TD>
	<TD><?php echo $_SESSION["age_now"];?></TD>
	<TD align="right" class="tb_detail">�Ţ�ѵû�ЪҪ� : </TD>
	<TD><?php echo $_SESSION["idcard_now"];?></TD>
	<TD align="right" class="tb_detail">�Է�ԡ���ѡ�� : </TD>
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
             ����/�ҷ�</td>
             <td  width="8" align="right" bgcolor='#C1FFD6'>R : </td>
             <td align="left"><?php echo $_SESSION["rate"];?>  
              ����/�ҷ�</td>
			  <td  width="8" align="right" bgcolor='#C1FFD6'>BP : </td>
             <td align="left"><?php echo $_SESSION["bp"];?> 
             mmHg </td>
			  <td  width="35" align="right" bgcolor='#C1FFD6'>��. : </td>
             <td align="left"><?php echo $_SESSION["weight"];?> 
             ��. </td>
			 <td  width="60" align="right" bgcolor='#C1FFD6'>��ǹ�٧. : </td>
             <td align="left"><?php echo $_SESSION["height"];?> 
             ��. </td>
             
			 <td  width="8" align="right" bgcolor='#C1FFD6'>BMI : </td>
			 <td align="left"><?php if($_SESSION["height"] != "" && $_SESSION["height"] > 0){
				 $ht = $_SESSION["height"]/100;
				echo number_format(($_SESSION["weight"]/($ht*$ht)),2);
			 }?></td>

           </tr>
           <tr>
             <td align="left" colspan="14">Repeat BP : <?=$_SESSION['repeat_bp'];?> mmHg, ��Ҿ : <B><?php echo $_SESSION["type"];?></B> , �ä��Шӵ�� : <B><?php echo $_SESSION["congenital_disease"];?></B>
			&nbsp;&nbsp;&nbsp;&nbsp;, �ҡ�� : <B><?php echo $_SESSION["organ"];?></B>
             </td>
           </tr>
		   <tr>
             <td align="left" colspan="14">�����Ѻ�ѵ� : <B><?php echo $_SESSION["time_opday"];?></B>&nbsp;, ���ҫѡ����ѵ� : <B><?php echo $_SESSION["time_opd"];?></B>&nbsp;, ����ᾷ���Ǩ : <B><?php echo date("H:i");?></B>
             </td>
           </tr>
		  </table>
	</TD>
	</TD>
</TR>
<?php

if($_SESSION["drugreact"]=='1'){
	$txt_t = "���������� ";
}else if($_SESSION["drugreact"]=='0'){
	$txt_t = "������������� ";
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




//���ҵ�������
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
<?php echo "<CENTER>���ѡ����ѵ� : ".$_SESSION["staff"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<FONT COLOR='#3300FF'>ᾷ�� : <B>".$_SESSION["dt_doctor"]."</B> �繼��ӡ�õ�Ǩ</FONT>&nbsp;&nbsp;<FONT COLOR='#FF0000'><B>DIAG:&nbsp;$diag</B></FONT></CENTER>";?>
<?php }?>
<div id = "tooltip" style="position:absolute;display:none;background-color:#FFFFFF;" >
</div>

<?php 
if($_SESSION["sIdname"] != "md19921" && $_SESSION["sIdname"] != "monchai"){  //�������ʴ���������´��Թԡ����ҹ
// �֧�����ż����¤�Թԡ����ҹ
$hn = $_SESSION['hn_now'];
$year = date('Y');

// ����բ����� Active 3����͹��ѧ
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
		�Դ�٢����ż����¤�Թԡ����ҹ
	</div>
	<div id="dialog-contain" <?php echo $style;?>>
		<div id="msg-contain">
			<div title="�Դ˹�ҵ�ҧ" id="div-close">[ �Դ˹�ҵ�ҧ ]</div>
			<h2>��������´�����¤�Թԡ����ҹ</h2>
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

				$months = array('01' => '�.�.', '02' => '�.�.', '03' => '��.�.', '04' => '��.�.', '05' => '�.�.', '06' => '��.�.', '07' => '�.�.', '08' => '�.�.', '09' => '�.�.', '10' => '�.�.', '11' => '�.�.', '12' => '�.�.');
				
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

				// ʶҹТ�������͹��ѧ2�� ���������������͹
				$diabetStatus = false;

				if( mysql_num_rows($qDiabetHis) > 0 ){
					$diabetStatus = true;
					?>
					<table class="chk_table">
						<tr>
							<th>�ѹ������Ѻ��ԡ��</th>
							<th>Foot Exam</th>
							<th>Retinal Exam</th>
							<th>��Ǩ�آ�Ҿ�ѹ</th>
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
									<a href="javascript:void(0);" class="editPart" data-id="<?=$id;?>" data-part="foot" ><img src="images/icons/page_white_edit.png" title="���" alt="���"></a>
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
									<a href="javascript:void(0);" class="editPart" data-id="<?=$id;?>" data-part="retinal" ><img src="images/icons/page_white_edit.png" title="���" alt="���"></a>
								</td>
								<td>
									<span id="tooth<?=$id;?>">
									<?php 
									if( $item['tooth'] !== '' ){
										if ( $item['tooth'] == 0 ) {
											echo '������Ѻ��õ�Ǩ';
	
										}elseif( $item['tooth'] == 1 ){
											echo '���Ѻ��õ�Ǩ';
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
									<a href="javascript:void(0);" class="editPart" data-id="<?=$id;?>" data-part="tooth"><img src="images/icons/page_white_edit.png" title="���" alt="���"></a>
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

				$labLists = array(); // �纤�Ҽ��Ż
				$yearList = array(); // �ʴ��յç��ǵ��ҧ
				$countYearMonth = array(); // �ʴ���͹�ç��ǵ��ҧ
				
				if( mysql_num_rows($qLab) > 0 ){

					$diabetStatus = true;
				
					// ��ǹѺ��͹�ͧ���л�
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

					// ��¡�� Lab �����ʴ�
					$labItemsTr = array('BS','HbA1c','LDL','Creatinine','Urine protein','Urine Microalbumin');

					?>
					<table class="chk_table">
						<tr>
							<th rowspan="2">��¡�õ�Ǩ</th>
							<?php 
							foreach ($yearList as $key => $y) {
								$Col = count($y);
								?>
								<th colspan="<?=$Col;?>" align="center">�� <?=$key+543;?></th>
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
					echo "����բ�����2����͹��ѧ �������բ�����DM�����ش��������� $dDM ".$months[$mDM].' '.($yDM+543);
				}
				?>
			</div>
		</div>
	</div>
	<!-- form ��䢢����� -->
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

		// ��Ŵ˹����䢢����� Foot Exam Retinal Exam ��Ǩ�آ�Ҿ�ѹ
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

		// �ѹ�֡������
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
								itemRes = '������Ѻ��õ�Ǩ';
							}else if(itemRes == 1){
								itemRes = '���Ѻ��õ�Ǩ';
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

	<script type="text/javascript">

		
	</script>
	<?php
	}
}  //close if session
?>