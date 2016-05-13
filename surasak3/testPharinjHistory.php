<?php


include 'bootstrap.php';

function calcage($birth){
	// dump($birth);
	$today = getdate();   
	$nY = $today['year']; 
	$nM = $today['mon'] ;
	$bY = substr($birth,0,4) - 543;
	$bM = substr($birth,5,2);
	$ageY = $nY - $bY;
	$ageM = $nM - $bM;

	if ($ageM < 0) {
		$ageY = $ageY - 1;
		$ageM = 12 + $ageM;
	}

	if ($ageM == 0){
		$pAge = "$ageY ��";
	}else{
		$pAge = "$ageY �� $ageM ��͹";
	}

	return $pAge;
}

$action = input_post('action');

if( empty($action) ){
	
	$date = ( date('Y') + 543 ).date('-m-d');
	?>
	����㺹Ѵ�մ��(���ͧ)
	<form action="testPharinjHistory.php" method="post">
		<div>
			<label for="hn">
				HN: <input type="text" id="hn" name="hn">
			</label>
		</div>
		<div>
			<label for="drugcode">
				����: <input type="text" id="drugcode" name="drugcode">
			</label>
		</div>
		<div>
			<label for="date">
				�ѹ������鹷��մ��: <input type="text" id="date" name="date" value="<?=$date;?>">
			</label>
		</div>
		<div>
			<button type="submit">����㺹Ѵ�մ��</button>
			<input type="hidden" name="action" value="show">
		</div>
	</form>
	<?php
} elseif ( $action === 'show' ) {
	
	$month = array(
		'01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', '05' => '����Ҥ�', '06' => '�Զع�¹', 
		'07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', '09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�'
	);

	$date = input_post('date');
	$hn = input_post('hn');
	$drugcode = strtoupper(input_post('drugcode'));
	
	
	$sql = "SELECT a.`hn`,a.`start_date`, b.`date`, b.`ptname`, b.`doctor`, c.`drugcode`, c.`tradname`
	FROM `pharinj_history` AS a
	LEFT JOIN `dphardep` AS b ON b.`row_id` = a.`dphardep_id` 
	LEFT JOIN `ddrugrx` AS c ON c.`idno` = a.`dphardep_id` 
	WHERE a.`start_date` LIKE '$date%' 
	AND a.`hn` = '$hn' 
	AND c.`drugcode` = '$drugcode'";
	$items = DB::select($sql);
	if( empty($items) ){
		echo "��辺����红����ũմ����͹��ѧ";
		exit;
	}
	
	$itemEtc = $items['0'];
	
	
	$sql = "SELECT * FROM `opcard` WHERE `hn` = '$hn' LIMIT 1";
	$testUser = DB::select($sql, null, true);
	// dump($testUser);
	
	// $testUser = $items['0'];
	
	$dgcode = array(
		'0DT' => 'Tetanus Toxoid',
		'0VERO' => 'VERORAB',
		'0SPEE' => 'SPEEDA',
		'0EB1.0' => 'Engerix-B',
		'0HB1.0' => 'Hepavax',
	);
	
	
	
	$codeSelect = $dgcode[$drugcode];
	
	$sql = "SELECT `vn` FROM `opday` WHERE `thidate` LIKE '$date%' AND `hn` = '$hn' ORDER BY `row_id` DESC LIMIT 1";
	$itVn = DB::select($sql, null, true);
	?>
	<html>
		<head>
			<title> �Ѵ�մ�� </title>
			<style type="text/css">
			*{
				font-family: "Angsana New";
			}
			a:link {color:#FF0000; text-decoration:underline;}
			a:visited {color:#FF0000; text-decoration:underline;}
			a:active {color:#FF0000; text-decoration:underline;}
			a:hover {color:#FF0000; text-decoration:underline;}
			body,td,th {font-size: 16px;}
			.font_title{font-size: 16px;color:#FFFFFF;font-weight: bold;}
			</style>
			<script type="text/javascript">
				window.onload = function(){
					// print();
				}
			</script>
		</head>

		<BODY>
			<BR><BR>
			<TABLE border="1"  bordercolor="#000000" cellspacing="0" cellpadding="0">
				<TR>
					<TD>
						<TABLE border="0">
							<TR>
								<TD valign="top">

									<TABLE border="0" style="font-size: 18px;">
										<TR>
											<TD><B>㺹Ѵ�մ��<BR>þ.��������ѡ��������</B></TD>
											<TD align="center">
												<TABLE border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
													<TR>
														<TD style="font-size: 24px;" align="center">
															<B>&nbsp;&nbsp;<?=$codeSelect;?>&nbsp;&nbsp;</B>
														</TD>
													</TR>
												</TABLE>
											</TD>
										</TR>
										<TR>
											<TD colspan="2">
												<FONT style="font-size: 24px;">����<U>&nbsp;<?=$testUser['yot'].' '.$testUser['name'].' '.$testUser['surname'];?>&nbsp;</U></FONT>
											</TD>
										</TR>
										<TR>
											<TD><FONT style="font-size: 24px;">HN<U>&nbsp;<?php echo $testUser["hn"];?></U></FONT></TD>
											<TD><FONT style="font-size: 24px;">ID<U>&nbsp;<?php echo $testUser["idcard"];?></U></FONT></TD>
										</TR>
										<TR>
											<TD>�Է���&nbsp;:&nbsp;<B><?php echo substr($testUser["ptright"],4);?></TD>
											<TD>����&nbsp;:&nbsp;<?php echo calcage($testUser["dbirth"]);?></TD>
										</TR>
										<TR>
											<TD colspan="2">ᾷ��&nbsp;:&nbsp;<?php echo $itemEtc["doctor"];?></TD>
										</TR>
										<TR>
											<TD colspan="2">
												<TABLE border="1" align="center" width="300" bordercolor="#000000" cellspacing="0" cellpadding="0" style="font-size: 30px;">
													<TR align="center">
														<TD width="30">	<FONT style="font-size: 22px;">���</FONT></TD>
														<TD width="60">	<FONT style="font-size: 22px;">VN</FONT></TD>
														<TD width="90">	<FONT style="font-size: 22px;">�/�/�</FONT></TD>
														<TD width="50">	<FONT style="font-size: 22px;">����</FONT></TD>
														<TD width="50">	<FONT style="font-size: 22px;">���մ</FONT></TD>
													</TR>
													<?php 
													// for($i = 1; $i <= $count; $i++){
													$i = 1;
													foreach( $items as $key => $item ){
														list($date, $time) = explode(' ', $item['date']);
														list($y, $m, $d) = explode('-', $date);
														?>
														<tr>
															<td align="center">
																<font size="4"><?=$i;?></font>
															</td>
															<td>
																<?php
																if( $i === 1 ){
																	echo $itVn['vn'];
																}else{
																	echo '&nbsp;';
																}
																?>
															</td>
															<td align="center">
																<font><?=$d;?> <?=$month[$m];?> <?=$y;?></font>
															</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
														</tr>
														<?php
														$i++;
													}
													?>
												</TABLE>
											</TD>
										</TR>
										<tr>
											<td colspan="2">
												��������´: <?php echo str_replace(array("\n","\n\r"), '<br>', $_POST['detail_etc']); ?>
											</td>
										</tr>
									</TABLE>
								</TD>
								<TD>&nbsp;&nbsp;</TD>
								<TD valign="top">
									<CENTER>
										<B>
										<FONT style="font-size: 22px;">
										��ͤ�û�Ժѵ�����Ѻ������
										</FONT></B><BR>
									</CENTER>

									<FONT style="font-size: 20px;">
										1. ��س��ҵç����ѹ�Ѵ<BR>
										2. <U><B>�ҵç�Ѵ</B></U><BR>
										&nbsp;&nbsp;&nbsp;&nbsp;������㺹Ѵ���Ἱ�����¹�����͡ VN<BR>
										&nbsp;&nbsp;&nbsp;&nbsp;���ǹ�㺹Ѵ��Ѻ�ҷ����ͧ������<BR>
										&nbsp;&nbsp;&nbsp;&nbsp;��������Ѻ�������ҩմ�ҷ����ͧ�ء�Թ<BR>
										3. <B><U>�����ç�Ѵ</U></B>
										&nbsp;&nbsp;&nbsp;&nbsp;�����Ҿ�ᾷ��ء����<BR>
										4.  ����͵�ͧ��éմ�ҷ���ç��Һ����� ����㺹Ѵ���仴���<BR>
										5.  �ջѭ�����͢��ʧ���㹡�éմ�� �Դ��ͧ͡���Ѫ���� <BR>
										&nbsp;&nbsp;&nbsp;&nbsp;�� 054-839305  ��� 1160
										<CENTER>***************************</CENTER>
										<CENTER><B>���ҩմ��</B></CENTER>
									</FONT>
									<FONT style="font-size: 20px;">
										&nbsp;&nbsp;&nbsp;&nbsp;<B>���</B>&nbsp;&nbsp;08.30  - 12.00 
										&nbsp;&nbsp;<B>����</B>&nbsp;&nbsp;13.00  - 16.00 
										&nbsp;&nbsp;<B>���</B>&nbsp;&nbsp;16.30  - 20.00
									</FONT>
								</TD>
							</TR>

						</TABLE>
					</TD>
				</TR>
			</TABLE>
		</body>
	</html>
	<?php
}

?>

