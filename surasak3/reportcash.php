<style type="text/css">
<!--
.textcash {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.textcash1 {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
<script>
print();
</script>
<table width="85%">
<tr><td align="center" class="textcash1"><strong>เอกสารแสดงค่าใช้จ่ายในการรักษาพยาบาลใบระบบเบิกจ่ายตรงประเภทผู้ป่วยนอก</strong></td>
</tr>
<tr>
  <td align="center" class="textcash1">โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง โทร.054-839305</td>
</tr>
<?
include("connect.inc");
 $sqlopcard = "select * from opcard where hn = '$hn' limit 1";
 $rows = mysql_query($sqlopcard);
 $results = mysql_fetch_array($rows);
 $yy = substr($date,0,4); 
 $mm = substr($date,5,2); 
 $dd = substr($date,8,2); 
 $payyes=0;
 $payno=0;
 $total = 0;
 $thdatehn=$dd.'-'.$mm.'-'.$yy.$hn;

?>
<?
	  	  $sql3 = "SELECT vn from opday where thdatehn = '$thdatehn'";
$result3 = mysql_query($sql3) ;
$row3= mysql_fetch_array($result3);

$vn=$row3['vn'];
?>

<tr>
  <td class="textcash1"><span class="textcash"><strong>ชื่อผู้ป่วย : 
    <?=$results['yot']." ".$results['name']." ".$results['surname']?> 
  </strong>HN :
<?=$hn?>
    VN :
<?=$vn?> บัตร ปปช. : 
     <?=$results['idcard']?> วันที่ : <?=$dd?>/<?=$mm?>/<?=$yy?>
  </span></td>
</tr>
</table>
<table width="85%" border="1" cellpadding="0" cellspacing="0" class="textcash" style="border-collapse:collapse">
<tr>
  <td width="49%" align="center" class="textcash"><strong>รายการ</strong></td>
<td width="8%" align="center" class="textcash"><strong>จำนวน</strong></td>
<td width="12%" align="center" class="textcash"><strong>ราคา/หน่วย</strong></td>
<td width="10%" align="center" class="textcash"><strong>เบิกได้</strong></td>
<td width="10%" align="center" class="textcash"><strong>เบิกไม่ได้</strong></td>
<td width="10%" align="center" class="textcash"><strong>สุทธิ</strong></td>
</tr>
<?php
$query="CREATE TEMPORARY TABLE drugrx01 SELECT * FROM phardep WHERE date like '$date%' ";
    $result = mysql_query($query) or die("Query failed,warphar");
	
$query="CREATE TEMPORARY TABLE drugrx02 SELECT * FROM drugrx WHERE date like '$date%' ";
    $result = mysql_query($query) or die("Query failed,warphar");

  $query10 = "SELECT row_id FROM drugrx01 WHERE hn = '$hn'";
    $result10 = mysql_query($query10)
        or die("Query failed");
		while($fetch = mysql_fetch_array($result10)){
    $query13 = "SELECT tradname,amount,price,part FROM drugrx02 WHERE idno = '".$fetch['row_id']."' and part = 'DDL'";
    $result13 = mysql_query($query13)
        or die("Query failed");
	$nn = @mysql_num_rows($result13);
	if($nn=="0"){
	}
	else{
		?> 
<tr bordercolor="#333333">
  <td colspan="6"><strong>ค่ายาในบัญชียาหลักแห่งชาติ</strong></td></tr>
		<?
	}

    //print "<font face='Angsana New'>$sPtname<br> ";
    $ptright=substr($sPtright,4);
    $doctor=substr($sDoctor,5);
    //print "HN: $sHn, สิทธิ์:$ptright<br>";
    //print "โรค: $sDiag, แพทย์ :$doctor<br>";
	
    while (list ($tradname,$amount, $price,$part) = mysql_fetch_row ($result13)) {
//        array_push($aPrice,$price);
//        $x++;
	$unit = number_format($price/$amount,2);
	$price1 = "-";
	$sum = number_format($price,2);
	$price10 = number_format($price,2);
	if(substr($tradname,0,13)=="(55020/55021)"){
	
	}
	else{
        print (" <tr bordercolor='#FFFFFF'>\n".
           "  <td>&nbsp;&nbsp;&nbsp;$tradname</td>\n".
           "  <td align='center'>$amount</td>\n".
           "  <td align='center'>$unit</td>\n".
           "  <td align='center'>$price10</td>\n".
		   "  <td align='center'>$price1</td>\n".
		   "  <td align='center'>$sum</td>\n".
           " </tr>\n");
		if($price=="-") $price = 0;
		if($price1=="-") $price1 = 0;
		$payyes +=$price;
		$payno +=$price1;
      }
	}
		}
	//////////////////////////////////////////////////////////////
	$query10 = "SELECT row_id FROM drugrx01 WHERE hn = '$hn'";
    $result10 = mysql_query($query10)
        or die("Query failed");
	while($fetch = mysql_fetch_array($result10)){
    $query13 = "SELECT tradname,amount,price,part FROM drugrx02 WHERE idno = '".$fetch['row_id']."' and (part = 'DDY' or part = 'DDN')";
    $result13 = mysql_query($query13)
        or die("Query failed");
	$nn = @mysql_num_rows($result13);
	if($nn=="0"){
	}
	else{
		?> 
<tr bordercolor="#333333">
  <td colspan="6"><strong>ค่ายานอกบัญชียาหลักแห่งชาติ</strong></td></tr>
		<?
	}

    //print "<font face='Angsana New'>$sPtname<br> ";
    $ptright=substr($sPtright,4);
    $doctor=substr($sDoctor,5);
    //print "HN: $sHn, สิทธิ์:$ptright<br>";
    //print "โรค: $sDiag, แพทย์ :$doctor<br>";
	
    while (list ($tradname,$amount, $price,$part) = mysql_fetch_row ($result13)) {
//        array_push($aPrice,$price);
//        $x++;
	if($part=='DDY') {
		$price = $price;
		$price1 = "-";
		$sum = $price;
		$unit = number_format($price/$amount,2);
	}
	else{
		$price1 = $price;
		$price = "-";
		$sum = $price1;
		$unit = number_format($price1/$amount,2);
	}
	
	if(substr($tradname,0,13)=="(55020/55021)"){
	
	}
	else{
        print (" <tr bordercolor='#FFFFFF'>\n".
           "  <td>&nbsp;&nbsp;&nbsp;$tradname</td>\n".
           "  <td align='center'>$amount</td>\n".
           "  <td align='center'>$unit</td>\n".
           "  <td align='center'>$price</td>\n".
		   "  <td align='center'>$price1</td>\n".
		   "  <td align='center'>$sum</td>\n".
           " </tr>\n");
		if($price=="-") $price = 0;
		if($price1=="-") $price1 = 0;
		$payyes +=$price;
		$payno +=$price1;
      }
	}
	}

/////////////////////////////////////////////////////////////
$query10 = "SELECT row_id FROM drugrx01 WHERE hn = '$hn'";
    $result10 = mysql_query($query10)
        or die("Query failed");
	while($fetch = mysql_fetch_array($result10)){
$query13 = "SELECT tradname,amount,price,part FROM drugrx02 WHERE idno = '".$fetch['row_id']."' and (part = 'DSY' or part = 'DSN')";
    $result13 = mysql_query($query13)
        or die("Query failed");
	$nn = @mysql_num_rows($result13);
	if($nn=="0"){
	}
	else{
		?> 
<tr bordercolor="#333333">
  <td colspan="6"><strong>ค่าเวชภัณฑ์</strong></td></tr>
		<?
	}
    //print "<font face='Angsana New'>$sPtname<br> ";
    $ptright=substr($sPtright,4);
    $doctor=substr($sDoctor,5);
    //print "HN: $sHn, สิทธิ์:$ptright<br>";
    //print "โรค: $sDiag, แพทย์ :$doctor<br>";
    while (list ($tradname,$amount, $price,$part) = mysql_fetch_row ($result13)) {
//        array_push($aPrice,$price);
//        $x++;
	if($part=='DSY') {
		$price = $price;
		$price1 = "-";
		$sum = $price;
		$unit = number_format($price/$amount,2);
	}
	else{
		$price1 = $price;
		$price = "-";
		$sum = $price1;
		$unit = number_format($price1/$amount,2);
	}
	if(substr($tradname,0,13)=="(55020/55021)"){
	
	}
	else{
        print (" <tr bordercolor='#FFFFFF'>\n".
           "  <td>&nbsp;&nbsp;&nbsp;$tradname</td>\n".
           "  <td align='center'>$amount</td>\n".
           "  <td align='center'>$unit</td>\n".
           "  <td align='center'>$price</td>\n".
		   "  <td align='center'>$price1</td>\n".
		   "  <td align='center'>$sum</td>\n".
           " </tr>\n");
		if($price=="-") $price = 0;
		if($price1=="-") $price1 = 0;
		$payyes +=$price;
		$payno +=$price1;
      }
	}
	}
	////////////////////////////////////////////////////////
	$query10 = "SELECT row_id FROM drugrx01 WHERE hn = '$hn'";
    $result10 = mysql_query($query10)
        or die("Query failed");
	while($fetch = mysql_fetch_array($result10)){
	$query13 = "SELECT tradname,amount,price,part FROM drugrx02 WHERE idno = '".$fetch['row_id']."' and (part = 'DPY' or part = 'DPN')";
    $result13 = mysql_query($query13)
        or die("Query failed");
	$nn = @mysql_num_rows($result13);
	if($nn=="0"){
	}
	else{
		?> 
<tr bordercolor="#333333">
  <td colspan="6"><strong>ค่าอุปกรณ์</strong></td></tr>
		<?
	}
    //print "<font face='Angsana New'>$sPtname<br> ";
    $ptright=substr($sPtright,4);
    $doctor=substr($sDoctor,5);
    //print "HN: $sHn, สิทธิ์:$ptright<br>";
    //print "โรค: $sDiag, แพทย์ :$doctor<br>";
    while (list ($tradname,$amount, $price,$part) = mysql_fetch_row ($result13)) {
//        array_push($aPrice,$price);
//        $x++;
	
	if($part=='DPY') {
		$price = $price;
		$price1 = "-";
		$sum = $price;
		$unit = number_format($price/$amount,2);
	}
	else{
		$price1 = $price;
		$price = "-";
		$sum = $price1;
		$unit = number_format($price1/$amount,2);
	}
	if(substr($tradname,0,13)=="(55020/55021)"){
	
	}
	else{
        print (" <tr bordercolor='#FFFFFF'>\n".
           "  <td>&nbsp;&nbsp;&nbsp;$tradname</td>\n".
           "  <td align='center'>$amount</td>\n".
           "  <td align='center'>$unit</td>\n".
           "  <td align='center'>$price</td>\n".
		   "  <td align='center'>$price1</td>\n".
		   "  <td align='center'>$sum</td>\n".
           " </tr>\n");
		if($price=="-") $price = 0;
		if($price1=="-") $price1 = 0;
		$payyes +=$price;
		$payno +=$price1;
      }
	}
	}
	////////////////////////////////////////////////////////

$query="CREATE TEMPORARY TABLE depart01 SELECT * FROM depart WHERE date like '$date%' ";
    $result = mysql_query($query) or die("Query failed,warphar");

	$query="CREATE TEMPORARY TABLE patdata01 SELECT * FROM patdata WHERE date like '$date%' ";
    $result = mysql_query($query) or die("Query failed,warphar");
	

	$query = "SELECT row_id FROM depart01 WHERE date LIKE '$date%' and hn = '$hn' and depart = 'PATHO'";
	$result = mysql_query($query)
        or die("Query failed1");
	$nn = @mysql_num_rows($result);
	if($nn=="0"){
	}
	else{
		?>
<tr bordercolor="#333333">
  <td colspan="6"><strong>ค่าตรวจวินิจฉัยทางเทคนิคการแพทย์</strong></td></tr>
		<?
	}
	while($rowid = mysql_fetch_array($result)){
	
    $query10 = "SELECT code,detail,amount,price,yprice,nprice FROM patdata01 WHERE idno = '".$rowid['row_id']."'";
    $result10 = mysql_query($query10)
        or die("Query failed2");
    while (list ($code, $detail,$amount, $price,$yprice,$nprice) = mysql_fetch_row ($result10)) {
		$unit = number_format($price/$amount,2);
		$sum = number_format($yprice+$nprice,2);
		if($yprice=="0.00") $price = "-";
		else $price = number_format($yprice,2);
		if($nprice=="0.00") $price1 = "-";
		else $price1 = number_format($nprice,2);
        print (" <tr bordercolor='#FFFFFF'>\n".
           "  <td>&nbsp;&nbsp;&nbsp;$detail</td>\n".
           "  <td align='center'>$amount</td>\n".
		   "  <td align='center'>$unit</td>\n".
           "  <td align='center'>$price</td>\n".
           "  <td align='center'>$price1</td>\n".
           "  <td align='center'>$sum</td>\n".
		   " </tr>\n");
		if($yprice=="0.00") $price = 0; else $price=$yprice;
		if($nprice=="0.00") $price1 = 0; else $price1=$nprice;
		$payyes +=$price;
		$payno +=$price1;
		   switch($code){
				case '67201':  $detail2_0 = " Checked "; break;
				case '62101':  $detail2_1 = " Checked "; break;
				case '64101':  $detail2_2 = " Checked "; break;
		   }

      }
	}
///////////////////////////////////////////////////////////////

	$query = "SELECT row_id FROM depart01 WHERE date LIKE '$date%' and hn = '$hn' and depart = 'XRAY'";
	$result = mysql_query($query)
        or die("Query failed3");
	$nn = @mysql_num_rows($result);
	if($nn=="0"){
	}
	else{
		?>
<tr bordercolor="#333333">
  <td colspan="6"><strong>ค่าตรวจวินิจฉัยและรักษาทางรังสีวิทยา</strong></td></tr>
		<?
	}
	while($rowid = mysql_fetch_array($result)){
	
    $query10 = "SELECT code,detail,amount,price,yprice,nprice FROM patdata01 WHERE idno = '".$rowid['row_id']."'";
    $result10 = mysql_query($query10)
        or die("Query failed4");
    while (list ($code, $detail,$amount, $price,$yprice,$nprice) = mysql_fetch_row ($result10)) {
		$unit = number_format($price/$amount,2);
		$sum = number_format($yprice+$nprice,2);
		if($yprice=="0.00") $price = "-";
		else $price = number_format($yprice,2);
		if($nprice=="0.00") $price1 = "-";
		else $price1 = number_format($nprice,2);
        print (" <tr bordercolor='#FFFFFF'>\n".
           "  <td>&nbsp;&nbsp;&nbsp;$detail</td>\n".
           "  <td align='center'>$amount</td>\n".
		   "  <td align='center'>$unit</td>\n".
           "  <td align='center'>$price</td>\n".
           "  <td align='center'>$price1</td>\n".
           "  <td align='center'>$sum</td>\n".
		   " </tr>\n");
		if($yprice=="0.00") $price = 0; else $price=$yprice;
		if($nprice=="0.00") $price1 = 0; else $price1=$nprice;
		$payyes +=$price;
		$payno +=$price1;
		   switch($code){
				case '67201':  $detail2_0 = " Checked "; break;
				case '62101':  $detail2_1 = " Checked "; break;
				case '64101':  $detail2_2 = " Checked "; break;
		   }
      }
	}

/////////////////////////////////////////////////////////////

	$query = "SELECT row_id FROM depart01 WHERE date LIKE '$date%' and hn = '$hn' and depart = 'SURG'";
	$result = mysql_query($query)
        or die("Query failed5");
	$nn = @mysql_num_rows($result);
	if($nn=="0"){
	}
	else{
		?>
<tr bordercolor="#333333">
  <td colspan="6"><strong>ค่าผ่าตัด ทำคลอด ทำหัตถการและบริการวิสัญญี</strong></td></tr>
		<?
	}
	while($rowid = mysql_fetch_array($result)){
	
    $query10 = "SELECT code,detail,amount,price,yprice,nprice FROM patdata01 WHERE idno = '".$rowid['row_id']."'";
    $result10 = mysql_query($query10)
        or die("Query failed6");
	
    while (list ($code, $detail,$amount, $price,$yprice,$nprice) = mysql_fetch_row ($result10)) {
		$unit = number_format($price/$amount,2);
		$sum = number_format($yprice+$nprice,2);
		if($yprice=="0.00") $price = "-";
		else $price = number_format($yprice,2);
		if($nprice=="0.00") $price1 = "-";
		else $price1 = number_format($nprice,2);
        print (" <tr bordercolor='#FFFFFF'>\n".
           "  <td>&nbsp;&nbsp;&nbsp;$detail</td>\n".
           "  <td align='center'>$amount</td>\n".
		   "  <td align='center'>$unit</td>\n".
           "  <td align='center'>$price</td>\n".
           "  <td align='center'>$price1</td>\n".
           "  <td align='center'>$sum</td>\n".
		   " </tr>\n");
		if($yprice=="0.00") $price = 0; else $price=$yprice;
		if($nprice=="0.00") $price1 = 0; else $price1=$nprice;
		$payyes +=$price;
		$payno +=$price1;
		   switch($code){
				case '67201':  $detail2_0 = " Checked "; break;
				case '62101':  $detail2_1 = " Checked "; break;
				case '64101':  $detail2_2 = " Checked "; break;
		   }
      }
	}

////////////////////////////////////////////////////////////

	$query = "SELECT row_id FROM depart01 WHERE date LIKE '$date%' and hn = '$hn' and depart = 'DENTA'";
	$result = mysql_query($query)
        or die("Query failed");
	$nn = @mysql_num_rows($result);
	if($nn=="0"){
	}
	else{
		?>
<tr bordercolor="#333333">
  <td colspan="6"><strong>ค่าบริการทางทันตกรรม</strong></td></tr>
		<?
	}
	while($rowid = mysql_fetch_array($result)){
	
    $query10 = "SELECT code,detail,amount,price,yprice,nprice FROM patdata01 WHERE idno = '".$rowid['row_id']."'";
    $result10 = mysql_query($query10)
        or die("Query failed");
	
    while (list ($code, $detail,$amount, $price,$yprice,$nprice) = mysql_fetch_row ($result10)) {
		$unit = number_format($price/$amount,2);
		$sum = number_format($yprice+$nprice,2);
		if($yprice=="0.00") $price = "-";
		else $price = number_format($yprice,2);
		if($nprice=="0.00") $price1 = "-";
		else $price1 = number_format($nprice,2);
        print (" <tr bordercolor='#FFFFFF'>\n".
           "  <td>&nbsp;&nbsp;&nbsp;$detail</td>\n".
           "  <td align='center'>$amount</td>\n".
		   "  <td align='center'>$unit</td>\n".
           "  <td align='center'>$price</td>\n".
           "  <td align='center'>$price1</td>\n".
           "  <td align='center'>$sum</td>\n".
		   " </tr>\n");
		if($yprice=="0.00") $price = 0; else $price=$yprice;
		if($nprice=="0.00") $price1 = 0; else $price1=$nprice;
		$payyes +=$price;
		$payno +=$price1;
		   switch($code){
				case '67201':  $detail2_0 = " Checked "; break;
				case '62101':  $detail2_1 = " Checked "; break;
				case '64101':  $detail2_2 = " Checked "; break;
		   }
      }
	}

////////////////////////////////////////////////////////////

	$query = "SELECT row_id FROM depart01 WHERE date LIKE '$date%' and hn = '$hn' and depart = 'PHYSI'";
	$result = mysql_query($query)
        or die("Query failed");
	$nn = @mysql_num_rows($result);
	if($nn=="0"){
	}
	else{
		?>
<tr bordercolor="#333333">
  <td colspan="6"><strong>ค่าบริการทางกายภาพบำบัดและเวชกรรมฟื้นฟู</strong></td></tr>
		<?
	}
	while($rowid = mysql_fetch_array($result)){
	
    $query10 = "SELECT code,detail,amount,price,yprice,nprice FROM patdata01 WHERE idno = '".$rowid['row_id']."'";
    $result10 = mysql_query($query10)
        or die("Query failed");

    while (list ($code, $detail,$amount, $price,$yprice,$nprice) = mysql_fetch_row ($result10)) {
		$unit = number_format($price/$amount,2);
		$sum = number_format($yprice+$nprice,2);
		if($yprice=="0.00") $price = "-";
		else $price = number_format($yprice,2);
		if($nprice=="0.00") $price1 = "-";
		else $price1 = number_format($nprice,2);
        print (" <tr bordercolor='#FFFFFF'>\n".
           "  <td>&nbsp;&nbsp;&nbsp;$detail</td>\n".
           "  <td align='center'>$amount</td>\n".
		   "  <td align='center'>$unit</td>\n".
           "  <td align='center'>$price</td>\n".
           "  <td align='center'>$price1</td>\n".
           "  <td align='center'>$sum</td>\n".
		   " </tr>\n");
		if($yprice=="0.00") $price = 0; else $price=$yprice;
		if($nprice=="0.00") $price1 = 0; else $price1=$nprice;
		$payyes +=$price;
		$payno +=$price1;
		   switch($code){
				case '67201':  $detail2_0 = " Checked "; break;
				case '62101':  $detail2_1 = " Checked "; break;
				case '64101':  $detail2_2 = " Checked "; break;
		   }
      }
	}

////////////////////////////////////////////////////////////

	$query = "SELECT row_id FROM depart01 WHERE date LIKE '$date%' and hn = '$hn' and depart = 'NID'";
	$result = mysql_query($query)
        or die("Query failed");
	$nn = @mysql_num_rows($result);
	if($nn=="0"){
	}
	else{
		?>
<tr bordercolor="#333333">
  <td colspan="6"><strong>ค่าบริการฝังเข็ม/การบำบัดของผู้ประกอบโรคศิลปะอื่นๆ</strong></td></tr>
		<?
	}
	while($rowid = mysql_fetch_array($result)){
	
    $query10 = "SELECT code,detail,amount,price,yprice,nprice FROM patdata01 WHERE idno = '".$rowid['row_id']."'  ";
    $result10 = mysql_query($query10)
        or die("Query failed");

    while (list ($code, $detail,$amount, $price,$yprice,$nprice) = mysql_fetch_row ($result10)) {
		$unit = number_format($price/$amount,2);
		$sum = number_format($yprice+$nprice,2);
		if($yprice=="0.00") $price = "-";
		else $price = number_format($yprice,2);
		if($nprice=="0.00") $price1 = "-";
		else $price1 = number_format($nprice,2);
        print (" <tr bordercolor='#FFFFFF'>\n".
           "  <td>&nbsp;&nbsp;&nbsp;$detail</td>\n".
           "  <td align='center'>$amount</td>\n".
		   "  <td align='center'>$unit</td>\n".
           "  <td align='center'>$price</td>\n".
           "  <td align='center'>$price1</td>\n".
           "  <td align='center'>$sum</td>\n".
		   " </tr>\n");
		if($yprice=="0.00") $price = 0; else $price=$yprice;
		if($nprice=="0.00") $price1 = 0; else $price1=$nprice;
		$payyes +=$price;
		$payno +=$price1;
		   switch($code){
				case '67201':  $detail2_0 = " Checked "; break;
				case '62101':  $detail2_1 = " Checked "; break;
				case '64101':  $detail2_2 = " Checked "; break;
		   }
      }
	}

////////////////////////////////////////////////////////////

	$query = "SELECT row_id FROM depart01 WHERE (depart = 'EMER' OR depart = 'HEMO' OR depart = 'WARD' ) AND hn = '$hn' AND date LIKE '$date%'"; 
	$result = mysql_query($query)
        or die("Query failed");
	$nn = @mysql_num_rows($result);
	if($nn=="0"){
	}
	else{
		?>
<tr bordercolor="#333333">
  <td colspan="6"><strong>ค่าบริการทางการพยาบาลทั่วไป</strong></td></tr>
		<?
	}
	while($rowid = mysql_fetch_array($result)){
	
    $query10 = "SELECT code,detail,amount,price,yprice,nprice FROM patdata01 WHERE idno = '".$rowid['row_id']."'";
    $result10 = mysql_query($query10)
        or die("Query failed");
    while (list ($code, $detail,$amount, $price,$yprice,$nprice) = mysql_fetch_row ($result10)) {
		$unit = number_format($price/$amount,2);
		$sum = number_format($yprice+$nprice,2);
		if($yprice=="0.00") $price = "-";
		else $price = number_format($yprice,2);
		if($nprice=="0.00") $price1 = "-";
		else $price1 = number_format($nprice,2);
        print (" <tr bordercolor='#FFFFFF'>\n".
           "  <td>&nbsp;&nbsp;&nbsp;$detail</td>\n".
           "  <td align='center'>$amount</td>\n".
		   "  <td align='center'>$unit</td>\n".
           "  <td align='center'>$price</td>\n".
           "  <td align='center'>$price1</td>\n".
           "  <td align='center'>$sum</td>\n".
		   " </tr>\n");
		if($yprice=="0.00") $price = 0; else $price=$yprice;
		if($nprice=="0.00") $price1 = 0; else $price1=$nprice;
		$payyes +=$price;
		$payno +=$price1;
		   switch($code){
				case '67201':  $detail2_0 = " Checked "; break;
				case '62101':  $detail2_1 = " Checked "; break;
				case '64101':  $detail2_2 = " Checked "; break;
		   }
      }
	}

////////////////////////////////////////////////////////////
$query = "SELECT  * FROM depart01 WHERE depart NOT IN (  'EMER',  'HEMO',  'WARD',  'PATHO',  'XRAY',  'SURG',  'DENTA',  'PHYSI',  'NID') AND hn =  '$hn' AND date
LIKE  '$date%'";
	$result = mysql_query($query)
        or die("Query failed");
	$nn = @mysql_num_rows($result);
	if($nn=="0"){
	}
	else{
		?>
<tr bordercolor="#333333">
  <td colspan="6"><strong>ค่าบริการอื่น</strong></td></tr>
		<?
	}
	while($rowid = mysql_fetch_array($result)){
	
    $query10 = "SELECT code,detail,amount,price,yprice,nprice FROM patdata01 WHERE idno = '".$rowid['row_id']."' ";
    $result10 = mysql_query($query10)
        or die("Query failed");
	
    while (list ($code, $detail,$amount, $price,$yprice,$nprice) = mysql_fetch_row ($result10)) {
		$unit = number_format($price/$amount,2);
		$sum = number_format($yprice+$nprice,2);
		if($yprice=="0.00") $price = "-";
		else $price = number_format($yprice,2);
		if($nprice=="0.00") $price1 = "-";
		else $price1 = number_format($nprice,2);
        print (" <tr bordercolor='#FFFFFF'>\n".
           "  <td>&nbsp;&nbsp;&nbsp;$detail</td>\n".
           "  <td align='center'>$amount</td>\n".
		   "  <td align='center'>$unit</td>\n".
           "  <td align='center'>$price</td>\n".
           "  <td align='center'>$price1</td>\n".
           "  <td align='center'>$sum</td>\n".
		   " </tr>\n");
		if($yprice=="0.00") $price = 0; else $price=$yprice;
		if($nprice=="0.00") $price1 = 0; else $price1=$nprice;
		$payyes +=$price;
		$payno +=$price1;
		   switch($code){
				case '67201':  $detail2_0 = " Checked "; break;
				case '62101':  $detail2_1 = " Checked "; break;
				case '64101':  $detail2_2 = " Checked "; break;
		   }
      }
	}
////////////////////////////////////////////////////////////
/*$query10 = "SELECT * FROM drugrx01 WHERE hn = '$hn'";
    $result10 = mysql_query($query10)
        or die("Query failed");
$fetch = mysql_fetch_array($result10);
		
 $query = "SELECT * FROM phardep  WHERE row_id = '".$fetch['row_id']."'  ";
    $result = mysql_query($query)
        or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
		 $sNetprice=$row->price;
		 $sAn=$row->an;
      if (empty($sAn) && $sNetprice > 0){
        print (" <tr bordercolor='#FFFFFF'>\n".
           "  <td><strong>(55020/55021)ค่าบริการผู้ป่วยนอก</strong></td>\n".
           "  <td align='center'>1</td>\n".
           "  <td align='center'>50.00</td>\n".
           "  <td align='center'>50.00</td>\n".
		   "  <td align='center'>-</td>\n".
		   "  <td align='center'>50.00</td>\n".
           " </tr>\n");
		$payyes +=50;
                           }
//กรณีคืนยา จะติดลบ
    if (empty($sAn) && $sNetprice < 0){
        print (" <tr bordercolor='#FFFFFF'>\n".
           "  <td><strong>(55020/55021)ค่าบริการผู้ป่วยนอก</strong></td>\n".
           "  <td align='center'>-1</td>\n".
           "  <td align='center'>-50.00</td>\n".
		   "  <td align='center'>-50.00</td>\n".
           "  <td align='center'>-</td>\n".
		   "  <td align='center'>-50.00</td>\n".
           " </tr>\n");
		$payyes -=50;
                           }*/
	 include("unconnect.inc");
	 $total = $payyes+$payno;
  ?>
 <tr bordercolor="#333333">
   <td colspan="3" align="right"><strong>รวมทั้งสิ้น</strong>&nbsp;&nbsp;</td><td align="center"><strong>
     <?=number_format($payyes,2)?>
   </strong></td><td align="center"><strong>
   <?=number_format($payno,2)?>
   </strong></td><td align="center"><strong>
   <?=number_format($total,2)?>
   </strong></td></tr>
</table>
<br />
<table width="85%">
<tr>
  <td align="right" class="textcash">
 <strong>ลงชื่อ .............................................................................. ผู้ป่วย/ผู้รับยาแทน<br />
 (<?=$results['yot']." ".$results['name']." ".$results['surname']?>/.....................................)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 </td></tr>
 </table>
