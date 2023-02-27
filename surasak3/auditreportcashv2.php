<?php 
require_once 'bootstrap.php';

include("connect.php");
?>
<style type="text/css">
	.textcash {
		font-family: "TH SarabunPSK";
		font-size: 18px;
	}

	.textcash1 {
		font-family: "TH SarabunPSK";
		font-size: 22px;
	}
</style>
<div id="print-page">
<?php 
// function dump($txt){
// 	echo "<pre>";
// 	var_dump($txt);
// 	echo "</pre>";
// }

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$hn = sprintf("%s", $_GET['hn']);
$sqlopcard = "SELECT *,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$hn' LIMIT 1";
$rows = mysql_query($sqlopcard);
$results = mysql_fetch_array($rows);
$yy = substr($date, 0, 4);
$mm = substr($date, 5, 2);
$dd = substr($date, 8, 2);
$payyes = 0;
$payno = 0;
$total = 0;
$thdatehn = $dd . '-' . $mm . '-' . $yy . $hn;
$ptname = $results['ptname'];

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" class="textcash" style="border-collapse:collapse">
	<tr>
		<td class="textcash"><b>HN</b></td>
		<td class="textcash"><b>ชื่อ-สกุล ผู้ป่วย</b></td>
		<td class="textcash"><b>วันที่</b></td>
		<td class="textcash"><b>รายการค่าใช้จ่าย</b></td>
		<td class="textcash"><b>จำนวน</b></td>
		<td class="textcash"><b>ราคา</b></td>
		<td class="textcash"><b>รวมเงิน</b></td>
		<td class="textcash"><b>เบิกไม่ได้</b></td>
	</tr>
<?php
$sql3 = "SELECT `vn`,`thidate`,SUBSTRING(`thidate`,1,10) AS `date`, 
CONCAT(SUBSTRING(`thidate`,9,2),'/',SUBSTRING(`thidate`,6,2),'/',(SUBSTRING(`thidate`,1,4)-543)) AS `endate` 
FROM `opday` 
WHERE ( `thidate` >= '2565-10-01 00:00:00' AND `thidate` <= '2566-09-30 23:59:59' ) 
AND `hn` = '$hn' ";
$result3 = $dbi->query($sql3);
while($row3 = $result3->fetch_assoc()){

	$thidate = $row3['thidate'];
	$date = $row3['date'];
	$vn = $row3['vn'];
	$endate = $row3['endate'];

	$query13 = "SELECT b.`tradname`,b.`amount`,b.`price`,b.`part`,b.`DPY`,b.`DPN` 
	FROM ( SELECT `row_id` FROM `phardep` WHERE `date` LIKE '$date%' AND `hn` = '$hn' AND `price` > 0 ) AS a 
	LEFT JOIN `drugrx` AS b ON b.`idno` = a.`row_id` 
	WHERE b.`amount` > 0";
	$result13 = mysql_query($query13) or die("Query failed ".mysql_error());
	if(mysql_num_rows($result13)>0){

		while(list($tradname, $amount, $price, $part, $dpy, $dpn) = mysql_fetch_row($result13)){
			$sum = (int) $price;
			$unit = $price / $amount;

			if($dpn>0){
				$dpn = number_format($dpn, 2, ',');
				$sum = $dpy;
			}else{
				$dpn = '';
			}

			?>
			<tr>
				<td><?=$hn;?></td>
				<td><?=$ptname;?></td>
				<td><?=$endate;?></td>
				<td><?=$tradname.'//'.$part;?></td>
				<td align="center"><?=$amount;?></td>
				<td align="right"><?=number_format($unit, 2);?></td>
				<td align="right"><?=number_format($sum, 2);?></td>
				<td align="right"><?=$dpn;?></td>
			</tr>
			<?php
			if ($price == "-")
				$price = 0;

			if ($price1 == "-")
				$price1 = 0;

			$payyes += $price;
			$payno += $price1;
			
		}
	}


	$sql_dep = "SELECT b.`code`,b.`detail`,b.`amount`,b.`price`,b.`yprice`,b.`nprice` 
	FROM ( SELECT `row_id` FROM depart WHERE date like '$date%' AND `hn` = '$hn' ) AS a 
	LEFT JOIN `patdata` AS b ON b.`idno` = a.`row_id` ";
	$q_dep = $dbi->query($sql_dep);
	while($dep = $q_dep->fetch_assoc()){

		$code = $dep['code'];
		$detail = $dep['detail'];

		$amount = $dep['amount'];
		$price = $dep['price'];
		$yprice = $dep['yprice'];
		$nprice = $dep['nprice'];

		// if($nprice>0){
		// 	$dpn = number_format($dpn, 2, ',');
		// 	$sum = $dpy;
		// }else{
		// 	$nprice = '';
		// }

		?>
		<tr>
			<td><?=$hn;?></td>
			<td><?=$ptname;?></td>
			<td><?=$endate;?></td>
			<td><?=$detail.'//'.$code;?></td>
			<td align="center"><?=$amount;?></td>
			<td align="right"><?=number_format($price, 2);?></td>
			<td align="right"><?=number_format($yprice, 2);?></td>
			<td align="right"><?=$nprice;?></td>
		</tr>
		<?php
	}

/*

		//////////////////////////////////////////////////////////////
		// $query10 = "SELECT row_id FROM drugrx01 WHERE hn = '$hn'";
		$query10 = "";
		$query10 = "SELECT b.`tradname`,b.`amount`,b.`price`,b.`part` 
		FROM ( SELECT * FROM `phardep` WHERE `date` LIKE '$date%' AND `hn` = '$hn' AND price >0 ) AS a 
		LEFT JOIN `drugrx` AS b ON b.`idno` = a.`row_id` 
		AND ( b.`part` = 'DDY' OR b.`part`='DDN' ) ";
		$result10 = mysql_query($query10)or die("Query failed ".mysql_error());
		// while ($fetch = mysql_fetch_array($result10)) {


			//print "<font face='Angsana New'>$sPtname<br> ";
			// $ptright = substr($sPtright, 4);
			// $doctor = substr($sDoctor, 5);
			//print "HN: $sHn, สิทธิ์:$ptright<br>";
			//print "โรค: $sDiag, แพทย์ :$doctor<br>";
		
			while (list($tradname, $amount, $price, $part) = mysql_fetch_row($result10)) {
				//        array_push($aPrice,$price);
//        $x++;
				if ($part == 'DDY') {
					$price = $price;
					$price1 = "-";
					$sum = $price;
					$unit = number_format($price / $amount, 2);
				} else {
					$price1 = $price;
					$price = "-";
					$sum = $price1;
					$unit = number_format($price1 / $amount, 2);
				}

				if (substr($tradname, 0, 13) == "(55020/55021)") {

				} else {
					print(" <tr bordercolor='#FFFFFF'>\n" .
						"  <td>$hn</td>" .
						"  <td>$ptname</td>" .
						"  <td>$thidate</td>" .
						"  <td>&nbsp;&nbsp;&nbsp;$tradname</td>\n" .
						"  <td>$amount</td>\n" .
						"  <td>$unit</td>\n" .
						"  <td>$price</td>\n" .
						"  <td>$price1</td>\n" .
						"  <td>$sum</td>\n" .
						" </tr>\n");
					if ($price == "-")
						$price = 0;
					if ($price1 == "-")
						$price1 = 0;
					$payyes += $price;
					$payno += $price1;
				}
			}
		// }


*/


/*
		/////////////////////////////////////////////////////////////
		$query10 = "SELECT b.`tradname`,b.`amount`,b.`price`,b.`part` 
		FROM ( SELECT * FROM `phardep` WHERE `date` LIKE '$date%' AND `hn` = '$hn' AND price >0 ) AS a 
		LEFT JOIN `drugrx` AS b ON b.`idno` = a.`row_id` 
		AND ( b.`part` = 'DSY' OR b.`part`='DSN' ) ";
		// dump($query10);
		// $query10 = "SELECT row_id FROM drugrx01 WHERE hn = '$hn'";
		// $result10 = mysql_query($query10) or die("Query failed");
		// while ($fetch = mysql_fetch_array($result10)) {
		// 	$query13 = "SELECT tradname,amount,price,part FROM drugrx02 WHERE idno = '" . $fetch['row_id'] . "' and (part = 'DSY' or part = 'DSN')";
		// 	$result13 = mysql_query($query13) or die("Query failed");
		// 	$nn = mysql_num_rows($result13);



			//print "<font face='Angsana New'>$sPtname<br> ";
			// $ptright = substr($sPtright, 4);
			// $doctor = substr($sDoctor, 5);
			//print "HN: $sHn, สิทธิ์:$ptright<br>";
			//print "โรค: $sDiag, แพทย์ :$doctor<br>";
			while (list($tradname, $amount, $price, $part) = mysql_fetch_row($query10)) {
				//        array_push($aPrice,$price);
//        $x++;
				if ($part == 'DSY') {
					$price1 = $price;
					$price = "-";
					$sum = $price1;
					$unit = number_format($price1 / $amount, 2);
				} else {
					$price1 = $price;
					$price = "-";
					$sum = $price1;
					$unit = number_format($price1 / $amount, 2);
				}
				if (substr($tradname, 0, 13) == "(55020/55021)") {

				} else {
					print(" <tr bordercolor='#FFFFFF'>\n" .
						"  <td>$hn</td>" .
						"  <td>$ptname</td>" .
						"  <td>$thidate</td>" .
						"  <td>&nbsp;&nbsp;&nbsp;$tradname</td>\n" .
						"  <td>$amount</td>\n" .
						"  <td>$unit</td>\n" .
						"  <td>$price</td>\n" .
						"  <td>$price1</td>\n" .
						"  <td>$sum</td>\n" .
						" </tr>\n");
					if ($price == "-")
						$price = 0;
					if ($price1 == "-")
						$price1 = 0;
					$payyes += $price;
					$payno += $price1;
				}
			}

*/

		// }
		////////////////////////////////////////////////////////

/*

		$result13 = "SELECT b.`tradname`,b.`amount`,b.`price`,b.`part` 
		FROM ( SELECT * FROM `phardep` WHERE `date` LIKE '$date%' AND `hn` = '$hn' AND price >0 ) AS a 
		LEFT JOIN `drugrx` AS b ON b.`idno` = a.`row_id` 
		AND ( b.`part` = 'DPY' OR b.`part`='DPN' ) ";
		// dump($result13);

			//print "<font face='Angsana New'>$sPtname<br> ";
			// $ptright = substr($sPtright, 4);
			// $doctor = substr($sDoctor, 5);
			//print "HN: $sHn, สิทธิ์:$ptright<br>";
			//print "โรค: $sDiag, แพทย์ :$doctor<br>";
			while (list($tradname, $amount, $price, $part) = mysql_fetch_row($result13)) {
				//        array_push($aPrice,$price);
				//        $x++;
		
				if ($part == 'DPY') {
					$price = $price;
					$price1 = "-";
					$sum = $price;
					$unit = number_format($price / $amount, 2);
				} else {
					$price1 = $price;
					$price = "-";
					$sum = $price1;
					$unit = number_format($price1 / $amount, 2);
				}
				if (substr($tradname, 0, 13) == "(55020/55021)") {

				} else {
					print(" <tr bordercolor='#FFFFFF'>\n" .
						"  <td>$hn</td>" .
						"  <td>$ptname</td>" .
						"  <td>$thidate</td>" .
						"  <td>&nbsp;&nbsp;&nbsp;$tradname</td>\n" .
						"  <td>$amount</td>\n" .
						"  <td>$unit</td>\n" .
						"  <td>$price</td>\n" .
						"  <td>$price1</td>\n" .
						"  <td>$sum</td>\n" .
						" </tr>\n");
					if ($price == "-")
						$price = 0;
					if ($price1 == "-")
						$price1 = 0;
					$payyes += $price;
					$payno += $price1;
				}
			}

*/



		// }
		////////////////////////////////////////////////////////
		
		/*
		$sql_depart_tmp = "CREATE TEMPORARY TABLE depart01 
		SELECT * FROM depart WHERE date like '$date%' AND `hn` = '$hn' ";
		// dump($sql_depart_tmp);
		$result = mysql_query($sql_depart_tmp) or die("Query failed, depart01 ".mysql_error());
		// dump($result);
		
		$sql_patdata_tmp = "CREATE TEMPORARY TABLE patdata01 
		SELECT * FROM patdata WHERE date like '$date%' AND `hn` = '$hn' ";
		$result = mysql_query($sql_patdata_tmp) or die("Query failed, patdata01 ".mysql_error());
		// dump($result);

		$sql_depart = "SELECT row_id FROM depart01 WHERE date LIKE '$date%' and hn = '$hn' and depart = 'PATHO'";
		$result_dep = mysql_query($sql_depart) or die("Query failed1 ".mysql_error());


		// var_dump($result_dep);

		while ($rowid = mysql_fetch_array($result_dep)) {
			// dump($rowid);

			$query10 = "SELECT code,detail,amount,price,yprice,nprice FROM patdata01 WHERE idno = '" . $rowid['row_id'] . "'";
			$result10 = mysql_query($query10) or die("Query failed2");
			while (list($code, $detail, $amount, $price, $yprice, $nprice) = mysql_fetch_row($result10)) {
				$unit = number_format($price / $amount, 2);
				$sum = number_format($yprice + $nprice, 2);
				if ($yprice == "0.00")
					$price = "-";
				else
					$price = number_format($yprice, 2);
				if ($nprice == "0.00")
					$price1 = "-";
				else
					$price1 = number_format($nprice, 2);
				print(" <tr bordercolor='#FFFFFF'>\n" .
				"  <td>$hn</td>" .
						"  <td>$ptname</td>" .
						"  <td>$thidate</td>" .
					"  <td>&nbsp;&nbsp;&nbsp;$detail</td>\n" .
					"  <td align='center'>$amount</td>\n" .
					"  <td align='center'>$unit</td>\n" .
					"  <td align='center'>$price</td>\n" .
					"  <td align='center'>$price1</td>\n" .
					"  <td align='center'>$sum</td>\n" .
					" </tr>\n");
				if ($yprice == "0.00")
					$price = 0;
				else
					$price = $yprice;
				if ($nprice == "0.00")
					$price1 = 0;
				else
					$price1 = $nprice;
				$payyes += $price;
				$payno += $price1;
				switch ($code) {
					case '67201':
						$detail2_0 = " Checked ";
						break;
					case '62101':
						$detail2_1 = " Checked ";
						break;
					case '64101':
						$detail2_2 = " Checked ";
						break;
				}

			}
		}
		///////////////////////////////////////////////////////////////
		
		$query = "SELECT row_id FROM depart01 WHERE date LIKE '$date%' and hn = '$hn' and depart = 'XRAY'";
		$result = mysql_query($query)
			or die("Query failed3");
		$nn = @mysql_num_rows($result);
		if ($nn == "0") {
		} else {
			?>
			<tr bordercolor="#333333">
				<td colspan="6"><strong>ค่าตรวจวินิจฉัยและรักษาทางรังสีวิทยา</strong></td>
			</tr>
		<?
		}
		while ($rowid = mysql_fetch_array($result)) {

			$query10 = "SELECT code,detail,amount,price,yprice,nprice FROM patdata01 WHERE idno = '" . $rowid['row_id'] . "'";
			$result10 = mysql_query($query10)
				or die("Query failed4");
			while (list($code, $detail, $amount, $price, $yprice, $nprice) = mysql_fetch_row($result10)) {
				$unit = number_format($price / $amount, 2);
				$sum = number_format($yprice + $nprice, 2);
				if ($yprice == "0.00")
					$price = "-";
				else
					$price = number_format($yprice, 2);
				if ($nprice == "0.00")
					$price1 = "-";
				else
					$price1 = number_format($nprice, 2);
				print(" <tr bordercolor='#FFFFFF'>\n" .
				"  <td>$hn</td>" .
						"  <td>$ptname</td>" .
						"  <td>$thidate</td>" .
					"  <td>&nbsp;&nbsp;&nbsp;$detail</td>\n" .
					"  <td align='center'>$amount</td>\n" .
					"  <td align='center'>$unit</td>\n" .
					"  <td align='center'>$price</td>\n" .
					"  <td align='center'>$price1</td>\n" .
					"  <td align='center'>$sum</td>\n" .
					" </tr>\n");
				if ($yprice == "0.00")
					$price = 0;
				else
					$price = $yprice;
				if ($nprice == "0.00")
					$price1 = 0;
				else
					$price1 = $nprice;
				$payyes += $price;
				$payno += $price1;
				switch ($code) {
					case '67201':
						$detail2_0 = " Checked ";
						break;
					case '62101':
						$detail2_1 = " Checked ";
						break;
					case '64101':
						$detail2_2 = " Checked ";
						break;
				}
			}
		}

		/////////////////////////////////////////////////////////////
		
		$query = "SELECT row_id FROM depart01 WHERE date LIKE '$date%' and hn = '$hn' and depart = 'SURG'";
		$result = mysql_query($query)
			or die("Query failed5");
		$nn = @mysql_num_rows($result);
		if ($nn == "0") {
		} else {
			?>
			<tr bordercolor="#333333">
				<td colspan="6"><strong>ค่าผ่าตัด ทำคลอด ทำหัตถการและบริการวิสัญญี</strong></td>
			</tr>
		<?
		}
		while ($rowid = mysql_fetch_array($result)) {

			$query10 = "SELECT code,detail,amount,price,yprice,nprice FROM patdata01 WHERE idno = '" . $rowid['row_id'] . "'";
			$result10 = mysql_query($query10)
				or die("Query failed6");

			while (list($code, $detail, $amount, $price, $yprice, $nprice) = mysql_fetch_row($result10)) {
				$unit = number_format($price / $amount, 2);
				$sum = number_format($yprice + $nprice, 2);
				if ($yprice == "0.00")
					$price = "-";
				else
					$price = number_format($yprice, 2);
				if ($nprice == "0.00")
					$price1 = "-";
				else
					$price1 = number_format($nprice, 2);
				print(" <tr bordercolor='#FFFFFF'>\n" .
				"  <td>$hn</td>" .
						"  <td>$ptname</td>" .
						"  <td>$thidate</td>" .
					"  <td>&nbsp;&nbsp;&nbsp;$detail</td>\n" .
					"  <td align='center'>$amount</td>\n" .
					"  <td align='center'>$unit</td>\n" .
					"  <td align='center'>$price</td>\n" .
					"  <td align='center'>$price1</td>\n" .
					"  <td align='center'>$sum</td>\n" .
					" </tr>\n");
				if ($yprice == "0.00")
					$price = 0;
				else
					$price = $yprice;
				if ($nprice == "0.00")
					$price1 = 0;
				else
					$price1 = $nprice;
				$payyes += $price;
				$payno += $price1;
				switch ($code) {
					case '67201':
						$detail2_0 = " Checked ";
						break;
					case '62101':
						$detail2_1 = " Checked ";
						break;
					case '64101':
						$detail2_2 = " Checked ";
						break;
				}
			}
		}

		////////////////////////////////////////////////////////////
		
		$query = "SELECT row_id FROM depart01 WHERE date LIKE '$date%' and hn = '$hn' and depart = 'DENTA'";
		$result = mysql_query($query)
			or die("Query failed");
		$nn = @mysql_num_rows($result);
		if ($nn == "0") {
		} else {
			?>
			<tr bordercolor="#333333">
				<td colspan="6"><strong>ค่าบริการทางทันตกรรม</strong></td>
			</tr>
		<?
		}
		while ($rowid = mysql_fetch_array($result)) {

			$query10 = "SELECT code,detail,amount,price,yprice,nprice FROM patdata01 WHERE idno = '" . $rowid['row_id'] . "'";
			$result10 = mysql_query($query10)
				or die("Query failed");

			while (list($code, $detail, $amount, $price, $yprice, $nprice) = mysql_fetch_row($result10)) {
				$unit = number_format($price / $amount, 2);
				$sum = number_format($yprice + $nprice, 2);
				if ($yprice == "0.00")
					$price = "-";
				else
					$price = number_format($yprice, 2);
				if ($nprice == "0.00")
					$price1 = "-";
				else
					$price1 = number_format($nprice, 2);
				print(" <tr bordercolor='#FFFFFF'>\n" .
				"  <td>$hn</td>" .
						"  <td>$ptname</td>" .
						"  <td>$thidate</td>" .
					"  <td>&nbsp;&nbsp;&nbsp;$detail</td>\n" .
					"  <td align='center'>$amount</td>\n" .
					"  <td align='center'>$unit</td>\n" .
					"  <td align='center'>$price</td>\n" .
					"  <td align='center'>$price1</td>\n" .
					"  <td align='center'>$sum</td>\n" .
					" </tr>\n");
				if ($yprice == "0.00")
					$price = 0;
				else
					$price = $yprice;
				if ($nprice == "0.00")
					$price1 = 0;
				else
					$price1 = $nprice;
				$payyes += $price;
				$payno += $price1;
				switch ($code) {
					case '67201':
						$detail2_0 = " Checked ";
						break;
					case '62101':
						$detail2_1 = " Checked ";
						break;
					case '64101':
						$detail2_2 = " Checked ";
						break;
				}
			}
		}

		////////////////////////////////////////////////////////////
		
		$query = "SELECT row_id FROM depart01 WHERE date LIKE '$date%' and hn = '$hn' and depart = 'PHYSI'";
		$result = mysql_query($query)
			or die("Query failed");
		$nn = @mysql_num_rows($result);
		if ($nn == "0") {
		} else {
			?>
			<tr bordercolor="#333333">
				<td colspan="6"><strong>ค่าบริการทางกายภาพบำบัดและเวชกรรมฟื้นฟู</strong></td>
			</tr>
		<?
		}
		while ($rowid = mysql_fetch_array($result)) {

			$query10 = "SELECT code,detail,amount,price,yprice,nprice FROM patdata01 WHERE idno = '" . $rowid['row_id'] . "'";
			$result10 = mysql_query($query10)
				or die("Query failed");

			while (list($code, $detail, $amount, $price, $yprice, $nprice) = mysql_fetch_row($result10)) {
				$unit = number_format($price / $amount, 2);
				$sum = number_format($yprice + $nprice, 2);
				if ($yprice == "0.00")
					$price = "-";
				else
					$price = number_format($yprice, 2);
				if ($nprice == "0.00")
					$price1 = "-";
				else
					$price1 = number_format($nprice, 2);
				print(" <tr bordercolor='#FFFFFF'>\n" .
				"  <td>$hn</td>" .
						"  <td>$ptname</td>" .
						"  <td>$thidate</td>" .
					"  <td>&nbsp;&nbsp;&nbsp;$detail</td>\n" .
					"  <td align='center'>$amount</td>\n" .
					"  <td align='center'>$unit</td>\n" .
					"  <td align='center'>$price</td>\n" .
					"  <td align='center'>$price1</td>\n" .
					"  <td align='center'>$sum</td>\n" .
					" </tr>\n");
				if ($yprice == "0.00")
					$price = 0;
				else
					$price = $yprice;
				if ($nprice == "0.00")
					$price1 = 0;
				else
					$price1 = $nprice;
				$payyes += $price;
				$payno += $price1;
				switch ($code) {
					case '67201':
						$detail2_0 = " Checked ";
						break;
					case '62101':
						$detail2_1 = " Checked ";
						break;
					case '64101':
						$detail2_2 = " Checked ";
						break;
				}
			}
		}

		////////////////////////////////////////////////////////////
		
		$query = "SELECT row_id FROM depart01 WHERE date LIKE '$date%' and hn = '$hn' and depart = 'NID'";
		$result = mysql_query($query)
			or die("Query failed");
		$nn = @mysql_num_rows($result);
		if ($nn == "0") {
		} else {
			?>
			<tr bordercolor="#333333">
				<td colspan="6"><strong>ค่าบริการฝังเข็ม/การบำบัดของผู้ประกอบโรคศิลปะอื่นๆ</strong></td>
			</tr>
		<?
		}
		while ($rowid = mysql_fetch_array($result)) {

			$query10 = "SELECT code,detail,amount,price,yprice,nprice FROM patdata01 WHERE idno = '" . $rowid['row_id'] . "'  ";
			$result10 = mysql_query($query10)
				or die("Query failed");

			while (list($code, $detail, $amount, $price, $yprice, $nprice) = mysql_fetch_row($result10)) {
				$unit = number_format($price / $amount, 2);
				$sum = number_format($yprice + $nprice, 2);
				if ($yprice == "0.00")
					$price = "-";
				else
					$price = number_format($yprice, 2);
				if ($nprice == "0.00")
					$price1 = "-";
				else
					$price1 = number_format($nprice, 2);
				print(" <tr bordercolor='#FFFFFF'>\n" .
				"  <td>$hn</td>" .
						"  <td>$ptname</td>" .
						"  <td>$thidate</td>" .
					"  <td>&nbsp;&nbsp;&nbsp;$detail</td>\n" .
					"  <td align='center'>$amount</td>\n" .
					"  <td align='center'>$unit</td>\n" .
					"  <td align='center'>$price</td>\n" .
					"  <td align='center'>$price1</td>\n" .
					"  <td align='center'>$sum</td>\n" .
					" </tr>\n");
				if ($yprice == "0.00")
					$price = 0;
				else
					$price = $yprice;
				if ($nprice == "0.00")
					$price1 = 0;
				else
					$price1 = $nprice;
				$payyes += $price;
				$payno += $price1;
				switch ($code) {
					case '67201':
						$detail2_0 = " Checked ";
						break;
					case '62101':
						$detail2_1 = " Checked ";
						break;
					case '64101':
						$detail2_2 = " Checked ";
						break;
				}
			}
		}

		////////////////////////////////////////////////////////////
		
		$query = "SELECT row_id FROM depart01 WHERE (depart = 'EMER' OR depart = 'HEMO' OR depart = 'WARD' ) AND hn = '$hn' AND date LIKE '$date%'";
		$result = mysql_query($query)
			or die("Query failed");
		$nn = @mysql_num_rows($result);
		if ($nn == "0") {
		} else {
			?>
			<tr bordercolor="#333333">
				<td colspan="6"><strong>ค่าบริการทางการพยาบาลทั่วไป</strong></td>
			</tr>
		<?
		}
		while ($rowid = mysql_fetch_array($result)) {

			$query10 = "SELECT code,detail,amount,price,yprice,nprice FROM patdata01 WHERE idno = '" . $rowid['row_id'] . "'";
			$result10 = mysql_query($query10)
				or die("Query failed");
			while (list($code, $detail, $amount, $price, $yprice, $nprice) = mysql_fetch_row($result10)) {
				$unit = number_format($price / $amount, 2);
				$sum = number_format($yprice + $nprice, 2);
				if ($yprice == "0.00")
					$price = "-";
				else
					$price = number_format($yprice, 2);
				if ($nprice == "0.00")
					$price1 = "-";
				else
					$price1 = number_format($nprice, 2);
				print(" <tr bordercolor='#FFFFFF'>\n" .
				"  <td>$hn</td>" .
						"  <td>$ptname</td>" .
						"  <td>$thidate</td>" .
					"  <td>&nbsp;&nbsp;&nbsp;$detail</td>\n" .
					"  <td align='center'>$amount</td>\n" .
					"  <td align='center'>$unit</td>\n" .
					"  <td align='center'>$price</td>\n" .
					"  <td align='center'>$price1</td>\n" .
					"  <td align='center'>$sum</td>\n" .
					" </tr>\n");
				if ($yprice == "0.00")
					$price = 0;
				else
					$price = $yprice;
				if ($nprice == "0.00")
					$price1 = 0;
				else
					$price1 = $nprice;
				$payyes += $price;
				$payno += $price1;
				switch ($code) {
					case '67201':
						$detail2_0 = " Checked ";
						break;
					case '62101':
						$detail2_1 = " Checked ";
						break;
					case '64101':
						$detail2_2 = " Checked ";
						break;
				}
			}
		}

		////////////////////////////////////////////////////////////
		$query = "SELECT  * FROM depart01 WHERE depart NOT IN (  'EMER',  'HEMO',  'WARD',  'PATHO',  'XRAY',  'SURG',  'DENTA',  'PHYSI',  'NID') AND hn =  '$hn' AND date
		LIKE  '$date%'";
		$result = mysql_query($query) or die("Query failed depart01 ".mysql_error());
		$nn = @mysql_num_rows($result);
		if ($nn == "0") {
		} else {
			?>
			<tr bordercolor="#333333">
				<td colspan="6"><strong>ค่าบริการอื่น</strong></td>
			</tr>
		<?
		}
		while ($rowid = mysql_fetch_array($result)) {

			$query10 = "SELECT code,detail,amount,price,yprice,nprice FROM patdata01 WHERE idno = '" . $rowid['row_id'] . "' ";
			$result10 = mysql_query($query10) or die("Query failed patdata01 ".mysql_error());

			while (list($code, $detail, $amount, $price, $yprice, $nprice) = mysql_fetch_row($result10)) {
				$unit = number_format($price / $amount, 2);
				$sum = number_format($yprice + $nprice, 2);
				if ($yprice == "0.00")
					$price = "-";
				else
					$price = number_format($yprice, 2);
				if ($nprice == "0.00")
					$price1 = "-";
				else
					$price1 = number_format($nprice, 2);
				print(" <tr bordercolor='#FFFFFF'>\n" .
				"  <td>$hn</td>" .
						"  <td>$ptname</td>" .
						"  <td>$thidate</td>" .
					"  <td>&nbsp;&nbsp;&nbsp;$detail</td>\n" .
					"  <td align='center'>$amount</td>\n" .
					"  <td align='center'>$unit</td>\n" .
					"  <td align='center'>$price</td>\n" .
					"  <td align='center'>$price1</td>\n" .
					"  <td align='center'>$sum</td>\n" .
					" </tr>\n");
				if ($yprice == "0.00")
					$price = 0;
				else
					$price = $yprice;
				if ($nprice == "0.00")
					$price1 = 0;
				else
					$price1 = $nprice;
				$payyes += $price;
				$payno += $price1;
				switch ($code) {
					case '67201':
						$detail2_0 = " Checked ";
						break;
					case '62101':
						$detail2_1 = " Checked ";
						break;
					case '64101':
						$detail2_2 = " Checked ";
						break;
				}
			}
		}
		
		include("unconnect.inc");
		$total = $payyes + $payno;
		?>
		<tr bordercolor="#333333">
			<td colspan="3" align="right"><strong>รวมทั้งสิ้น</strong>&nbsp;&nbsp;</td>
			<td align="center"><strong>
					<?= number_format($payyes, 2) ?>
				</strong></td>
			<td align="center"><strong>
					<?= number_format($payno, 2) ?>
				</strong></td>
			<td align="center"><strong>
					<?= number_format($total, 2) ?>
				</strong></td>
		</tr>
	</table>
</div>

<div id="print-page">
	<?

	*/
	




	/*
	include("connect.inc");
	$sql2 = "select distinct(doctor),hn,ptname,diag,row_id from phardep where hn = '$hn' and date like '$date%'";
	$query2 = mysql_query($sql2);
	while ($rows2 = mysql_fetch_array($query2)) {
		?>
		<table width="85%">
			<tr>
				<td align="center" class="textcash1"><strong>รายงานการจ่ายยา</strong></td>
			</tr>
			<tr>
				<td class="textcash"><strong>ชื่อผู้ป่วย :
						<?= $rows2["ptname"]; ?> HN :
						<?= $rows2["hn"] ?> แพทย์ :
						<?= $rows2["doctor"]; ?>
						<?
						if (!empty($rows2["diag"])) {
							echo " Diag : " . $rows2["diag"];
						}
						?>
						<?
						$sql24 = "select * from  opicd9cm where hn = '$hn' and svdate like '$date%'";
						$query24 = mysql_query($sql24);
						$rows24 = mysql_fetch_array($query24);
						if (!empty($rows24["icd9cm"])) {
							echo " icd9 : " . $rows24["icd9cm"];
						}
						?>
						<?
						$sql25 = "select * from diag where hn = '$hn' and svdate like '$date%'";
						$query25 = mysql_query($sql25);
						$rows25 = mysql_fetch_array($query25);
						if (!empty($rows25["icd10"])) {
							echo " icd10 : " . $rows25["icd10"];
						}
						?>
				</td>
			</tr>
		</table>
		<table width="85%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000"
			style="border-collapse:collapse;">
			<tr>
				<td width="29%" align="center" class="textcash"><strong>ชื่อยา</strong></td>
				<td width="7%" align="center" class="textcash"><strong>ประเภท</strong></td>
				<td width="7%" align="center" class="textcash"><strong>จำนวน</strong></td>
				<td width="12%" align="center" class="textcash"><strong>วิธีใช้</strong></td>
				<td width="21%" align="center" class="textcash"><strong>เหตุผล</strong></td>
				<td width="11%" align="right" class="textcash"><strong>ราคา/หน่วย</strong></td>
				<td width="13%" align="right" class="textcash"><strong>ราคารวม</strong></td>
			</tr>
			<?
			include("connect.inc");
			$sql22 = "select * from drugrx where hn = '$hn' and date like '$date%' and idno='" . $rows2["row_id"] . "' and amount !='0' order by part";
			$query22 = mysql_query($sql22);
			$total = 0;
			while ($rows22 = mysql_fetch_array($query22)) {
				$sumprice = $rows22["amount"] * $rows22["price"];
				$priceunit = $rows22["price"] / $rows22["amount"];
				$total = $total + $rows22["price"];
				?>
				<tr>
					<td class="textcash">
						<?="(" . $rows22["drugcode"] . ") " . $rows22["tradname"]; ?>
					</td>
					<td align="center" class="textcash">
						<?= $rows22["part"]; ?>
					</td>
					<td align="center" class="textcash">
						<?= $rows22["amount"]; ?>
					</td>
					<td class="textcash">
						<?
						$sqlslc = "select * from drugslip where slcode='" . $rows22["slcode"] . "'";
						$queryslc = mysql_query($sqlslc);
						$rowsslc = mysql_fetch_array($queryslc);
						echo $rowsslc["slcode"];
						//echo $rowsslc["detail1"]." ".$rowsslc["detail2"]." ".$rowsslc["detail3"];
						?>
					</td>
					<td class="textcash">
						<? if (empty($rows22["reason"])) {
							echo "&nbsp;";
						} else {
							echo $rows22["reason"];
						} ?>
					</td>
					<td align="right" class="textcash">
						<?= $priceunit; ?>
					</td>
					<td align="right" class="textcash">
						<?= number_format($rows22["price"], 2); ?>
					</td>
				</tr>
			<?
			}
			?>
			<tr>
				<td colspan="6" align="right" class="textcash"><strong>รวมทั้งสิ้น&nbsp;&nbsp;</strong></td>
				<td align="right" class="textcash"><strong>
						<?= number_format($total, 2); ?>
					</strong></td>
			</tr>
		</table>
	<?
	}
	?>
</div>
<div id="print-page">
	<?
	include("connect.inc");
	$thdate = substr($date, 0, 10);
	list($y, $m, $d) = explode("-", $thdate);
	$y = $y - 543;
	$newdate = "$y-$m-$d";
	$sql31 = "select * from  resulthead where hn = '$hn' and orderdate  like '$newdate%'";
	$query31 = mysql_query($sql31);
	$num31 = mysql_num_rows($query31);
	if (empty($num31)) {
		echo "";
	} else {
		$rows31 = mysql_fetch_array($query31);
		?>
		<table width="85%">
			<tr>
				<td align="center" class="textcash1"><strong>รายงานผล LAB</strong></td>
			</tr>
			<tr>
				<td class="textcash"><strong>ชื่อผู้ป่วย :
						<?= $rows31["patientname"]; ?> HN :
						<?= $rows31["hn"] ?>
				</td>
			</tr>
		</table>
		<table width="85%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000"
			style="border-collapse:collapse">
			<tr>
				<td width="32%" align="center" class="textcash"><strong>Lab</strong></td>
				<td width="8%" align="center" class="textcash"><strong>result</strong></td>
				<td width="13%" align="center" class="textcash"><strong>unit</strong></td>
				<td width="23%" align="center" class="textcash"><strong>normalrange</strong></td>
			</tr>
			<?
			include("connect.inc");
			$thdate = substr($date, 0, 10);
			list($y, $m, $d) = explode("-", $thdate);
			$y = $y - 543;
			$newdate = "$y-$m-$d";
			$sql3 = "select * from  resulthead where hn = '$hn' and orderdate  like '$newdate%'";
			//echo $sql3."<br>";
			$query3 = mysql_query($sql3);
			while ($rows3 = mysql_fetch_array($query3)) {

				$sql33 = "select * from  resultdetail where autonumber='" . $rows3["autonumber"] . "'";
				//echo $sql33;
				$query33 = mysql_query($sql33);
				while ($rows33 = mysql_fetch_array($query33)) {
					?>
					<tr>
						<td class="textcash">
							<?="(" . $rows33["labcode"] . ") " . $rows33["labname"]; ?>
						</td>
						<td align="center" class="textcash">
							<?= $rows33["result"]; ?>
						</td>
						<td class="textcash">
							<? if (empty($rows33["unit"])) {
								echo "&nbsp;";
							} else {
								echo $rows33["unit"];
							} ?>
						</td>
						<td class="textcash">
							<? if (empty($rows33["normalrange"])) {
								echo "&nbsp;";
							} else {
								echo $rows33["normalrange"];
							} ?>
						</td>
					</tr>
				<?
				}
			}
			?>
		</table>
	<?
	}
	*/
}
	?>
</div>