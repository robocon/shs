<?php 
session_start();
include 'includes/connect.php';
include 'includes/functions.php';
?>
<style type="text/css">
<!--
.fontm{
	font-family: "TH SarabunPSK";
	font-size:16px;
}
.font1{
	font-family: "TH SarabunPSK";
	font-size:18px;
}
.forntsarabun {	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>

<form method="POST" action="icd10top10.php">
	<p class="forntsarabun">��§ҹ�ӹǹ������ ��ṡ��� ICD 10  </p>
	<table>
		<tr>
			<td>

				<?php
				// ����繷���¹�����Ẻ���
				if( $_SESSION['smenucode'] == 'ADMOPD' ){
					?>
					<span class="forntsarabun">��͹<? $m=date("m")?></span>
					<select name="rptmo" class="forntsarabun" id="rptmo">
						<option value="">������͡��͹</option>
						<option value="01" <? if($m=='01'){ echo "selected"; }?>>���Ҥ�</option>
						<option value="02" <? if($m=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
						<option value="03" <? if($m=='03'){ echo "selected"; }?>>�չҤ�</option>
						<option value="04" <? if($m=='04'){ echo "selected"; }?>>����¹</option>
						<option value="05" <? if($m=='05'){ echo "selected"; }?>>����Ҥ�</option>
						<option value="06" <? if($m=='06'){ echo "selected"; }?>>�Զع�¹</option>
						<option value="07" <? if($m=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
						<option value="08" <? if($m=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
						<option value="09" <? if($m=='09'){ echo "selected"; }?>>�ѹ��¹</option>
						<option value="10" <? if($m=='10'){ echo "selected"; }?>>���Ҥ�</option>
						<option value="11" <? if($m=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
						<option value="12" <? if($m=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
					</select>
					<?php
					$Y = date("Y")+543;
					$date = date("Y")+543+5;
					$dates = range(2547,$date);
					?>
					<select name='thiyr' class='forntsarabun'>
						<?php
						foreach($dates as $i){
							?>
							<option value="<?=$i?>" <?php if($Y==$i){ echo "selected"; }?>>
							<?=$i;?>
							</option>
							<?php
						}
						?>
					<select>
					<?php
				}else{ // Ἱ�����������������
					?>
					<table class="forntsarabun">
						<tr>
							<td>
								<fieldset>
									<legend>�����</legend>
									��͹: 
									<?php
									$default_month = date('m');
									$month_val = input_post('rptmo', $default_month);
									echo getMonthList('rptmo', $month_val, 'forntsarabun');
									?>

									��: 
									<?php
									$default_year = date('Y');
									$year_range = range(2004, $default_year);
									$year_val = input_post('thiyr', $default_year);
									echo getYearList('thiyr', $thai = true, $year_val, $year_range, 'forntsarabun');
									?>
								</fieldset>
							</td>
							<td>
								<fieldset>
									<legend>���֧</legend>
									��͹: 
									<?php
									$month_val = input_post('end_month', $default_month);
									echo getMonthList('end_month', $month_val, 'forntsarabun');
									?>

									��: 
									<?php
									$year_val = input_post('end_year', $default_year);
									echo getYearList('end_year', $thai = true, $year_val, $year_range, 'forntsarabun');
									?>
								</fieldset>
							</td>
						</tr>
					</table>
					<?php
				}
				?>
			</td>
		</tr>
		<tr>
			<td align="center">
				<span class="forntsarabun">
					<input type="submit" value="��ŧ" name="B1" class="forntsarabun" />
					<a target=_self  href='../nindex.htm' class="forntsarabun">&lt;&lt;&nbsp;�����</a>
				</span>
			</td>
		</tr>
	</table>
</form>
<hr>
<br>
<?php
if(isset($_POST['B1'])){

	$thiyr = input_post('thiyr');
	$rptmo = input_post('rptmo');
	$yrmonth = "$thiyr-$rptmo";

	if( $_SESSION['smenucode'] === 'ADMOPD' ){
		print "<font class=\"forntsarabun\"><b>��ª��ͼ����µ�� ICD10 ��Ш���͹</b> $yrmonth";
		echo "<br><a target=_self  href='../nindex.htm'>&lt;&lt;&nbsp;�����</a>";
	}else{
		$yrmonth = ad_to_bc($thiyr)."-$rptmo";

		$end_month = input_post('end_month');
		$end_year = ad_to_bc(input_post('end_year'));
		$end_date = "$end_year-$end_month";

		print "<font class=\"forntsarabun\"><b>��ª��ͼ����µ�� ICD10 ��ǧ��͹</b> $yrmonth <b>�֧</b> $end_date";
	}

	$opday_where = "`thidate` LIKE '$yrmonth%'";
	$ipcard_where = "`dcdate` LIKE '$yrmonth%'";
	if( $_SESSION['smenucode'] !== 'ADMOPD' ){
		$opday_where = "(`thidate` >= '$yrmonth-01' AND `thidate` <= '$end_date-31')";
		$ipcard_where = "(`dcdate` >= '$yrmonth-01' AND `dcdate` <= '$end_date-31')";
	}

	$querydb1 = "CREATE TEMPORARY TABLE `opday1` 
	SELECT * 
	FROM `opday` 
	WHERE $opday_where 
	AND `icd10` !='' 
	AND (`an` ='' OR `an` IS NULL)";
	$resultdb1 = mysql_query($querydb1) or die(mysql_error());

	$querydb2="CREATE TEMPORARY TABLE `ipday1` 
	SELECT * 
	FROM `ipcard` 
	WHERE $ipcard_where 
	AND `icd10` !=''";
	$resultdb2 = mysql_query($querydb2) or die(mysql_error());

	print "<br>�ӹǹ���������� ICD 10 <br><br><br> ";

	////////// ��. �͡ //////

	$query1="SELECT  COUNT(*) as c1 FROM opday1 ";
	$result1 = mysql_query($query1) or die(mysql_error());
	list($c1) = mysql_fetch_row ($result1);

	$query="SELECT  icd10,COUNT(*) AS duplicate 
	FROM opday1 
	GROUP BY icd10 
	HAVING duplicate > 0 
	ORDER BY duplicate DESC ";
	$result = mysql_query($query) or die(mysql_error());
	$n=0;

	////////// ��. � //////

	$query2="SELECT  COUNT(*) as c2 FROM ipday1";
	$result2 = mysql_query($query2) or die(mysql_error());
	list ($c2) = mysql_fetch_row ($result2);

	$query1="SELECT  icd10,COUNT(*) AS duplicate 
	FROM ipday1 
	GROUP BY icd10 
	HAVING duplicate > 0 
	ORDER BY duplicate DESC  ";
	$result1 = mysql_query($query1);
	$n1=0;
	?>
	<table border="1" cellspacing="3" cellpadding="2" bordercolor="#000000" style="border-collapse:collapse;" >
		<tr>
			<td width="25%" align="center" valign="top">
				<table class="forntsarabun" style="border-collapse:collapse;" bordercolor="#000000"  border="1">
					<tr bgcolor="#00CCCC">
						<td colspan="5" align="center">�����¹͡   (<?=$c1;?>)/��</td>
					</tr>
					<tr bgcolor="#00CCCC" class="fontm">
						<td>�ӴѺ</td>
						<td>ICD10</td>
						<td>Diag</td>
						<td>�ӹǹ/��</td>
						<td align="center">%</td>
					</tr>
					<?php
					while (list($icd10,$duplicate) = mysql_fetch_row($result)) {
						$n++;

						$diag = "SELECT detail  FROM `icd10`WHERE 1 AND `code`='$icd10'";
						$querydiag = mysql_query($diag);
						list ($detail) = mysql_fetch_row ($querydiag);

						$num = $duplicate+$num;
						$avg1 = 100 * $duplicate / $c1;
						$avg1 = number_format($avg1,2);

						if( $_SESSION['smenucode'] == 'ADMOPD' ){
							$href = '<a href="icd10_detail.php?do=op&icd10='.$icd10.'&thidate='.$yrmonth.'">'.$icd10.'</a>';
						}else{
							$href = $icd10;
						}

						print (" <tr>".
						"<td>$n</td>".
						"<td>$href</td>".
						"<td>$detail</td>".
						"<td align=\"center\">$duplicate</td>".
						"<td align=\"center\">$avg1</td>".
						" </tr>");
					}
				?>
				</table>
			</td>
			<td width="25%" align="center" valign="top">
				<table class="forntsarabun" style="border-collapse:collapse;" bordercolor="#000000"  border="1">
					<tr bgcolor="#00CCCC">
						<td colspan="5" align="center">�������   (<?=$c2;?>)/��</td>
					</tr>
					<tr bgcolor="#00CCCC" class="fontm">
						<td>�ӴѺ</td>
						<td>ICD10</td>
						<td>Diag</td>
						<td>�ӹǹ/��</td>
						<td align="center">%</td>
					</tr>
					<?php
					while(list ($icd101,$duplicate1) = mysql_fetch_row($result1)) {
						$n1++;

						$diag = "SELECT detail  FROM `icd10`WHERE 1 AND `code`='$icd101'";
						$querydiag = mysql_query($diag);
						list($detail) = mysql_fetch_row ($querydiag);

						$num = $duplicate1+$num;
						$avg2 = 100 * $duplicate1 / $c2;
						$avg2 = number_format($avg2,2);

						if( $_SESSION['smenucode'] == 'ADMOPD' ){
							$href = '<a href="icd10_detail.php?do=ip&icd10='.$icd101.'&thidate='.$yrmonth.'">'.$icd101.'</a>';
						}else{
							$href = $icd101;
						}

						print (" <tr>".
						"<td>$n1</td>".
						"<td>$href</td>".
						"<td>$detail</td>".
						"<td align=\"center\">$duplicate1</td>".
						"<td align=\"center\">$avg2</td>".
						" </tr>");
					}
					?>
				</table>
			</td>
    		<td width="35%" align="center" valign="top">
				<?php
				////////// ��. �  dead//////

				$query3="SELECT  COUNT(*) as c3 FROM ipday1 where dctype like '%Dead%' ";
				$result3 = mysql_query($query3)or die(mysql_error());
				list ($c3) = mysql_fetch_row ($result3);

				$query33="SELECT  icd10,COUNT(*) AS duplicate FROM ipday1 where dctype like '%Dead%' GROUP BY icd10 HAVING duplicate > 0 ORDER BY duplicate DESC ";
				$result33 = mysql_query($query33) or die(mysql_error());
				$n33=0;
				?>
				<table class="forntsarabun" style="border-collapse:collapse;" bordercolor="#000000"  border="1">
					<tr bgcolor="#00CCCC">
						<td colspan="5" align="center">������� (dead) (<?=$c3;?>)/��</td>
					</tr>
					<tr bgcolor="#00CCCC" class="fontm">
						<td>�ӴѺ</td>
						<td>ICD10</td>
						<td>Diag</td>
						<td>�ӹǹ/��</td>
						<td align="center">%</td>
					</tr>
					<?php
					while( list($icd101,$duplicate3) = mysql_fetch_row($result33)) {
						$n33++;

						$diag="SELECT detail  FROM `icd10`WHERE 1 AND `code`='$icd101'";
						$querydiag = mysql_query($diag);
						list ($detail) = mysql_fetch_row ($querydiag);

						$num = $duplicate3+$num;
						$avg3 = 100*$duplicate3/$c3;
						$avg3 = number_format($avg3,2);

						if( $_SESSION['smenucode'] == 'ADMOPD' ){
							$href = '<a href="icd10_detail.php?do=deadip&icd10='.$icd101.'&thidate='.$yrmonth.'">'.$icd101.'</a>';
						}else{
							$href = $icd101;
						}

						print (" <tr>".
						"<td>$n33</td>".
						"<td>$href</td>".
						"<td>$detail</td>".
						"<td align=\"center\">$duplicate3</td>".
						"<td align=\"center\">$avg3</td>".
						" </tr>");
					}
					?>
				</table>
			</td>
		</tr>
	</table>
<?php
} // End $_POST['B1']
?>