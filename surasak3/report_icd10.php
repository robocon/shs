<?
session_start();


include("connect.inc");

?>
<style type="text/css">
<!--
.texticd {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
-->
</style>

<?
if(isset($_POST['okbtn'])){
	if($_POST['in']=="1"){
	$sqlicd10 = "CREATE TEMPORARY TABLE ipcard01 SELECT * FROM ipcard where icd10 like '%".$_POST['search']."%'";
	$result = Mysql_Query($sqlicd10 ) or die(mysql_error());
	//year now
	$listicd = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT count(*) FROM ipcard01 where date like '".(date("Y")+543)."-".$m."-%' ";
		$result = Mysql_Query($selectsql);
		$arr = mysql_fetch_array($result);
		array_push($listicd,$arr[0]);
	}
	//now-1
	$listicd1 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT count(*) FROM ipcard01 where date like '".((date("Y")+543)-1)."-".$m."-%' ";
		$result = Mysql_Query($selectsql);
		$arr = mysql_fetch_array($result);
		array_push($listicd1,$arr[0]);
	}
	//now-2
	$listicd2 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT count(*) FROM ipcard01 where date like '".((date("Y")+543)-2)."-".$m."-%' ";
		$result = Mysql_Query($selectsql);
		$arr = mysql_fetch_array($result);
		array_push($listicd2,$arr[0]);
	}
	//now-3
	$listicd3 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT count(*) FROM ipcard01 where date like '".((date("Y")+543)-3)."-".$m."-%' ";
		$result = Mysql_Query($selectsql);
		$arr = mysql_fetch_array($result);
		array_push($listicd3,$arr[0]);
	}
	
	//now-4
	$listicd4 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT count(*) FROM ipcard01 where date like '".((date("Y")+543)-4)."-".$m."-%' ";
		$result = Mysql_Query($selectsql);
		$arr = mysql_fetch_array($result);
		array_push($listicd4,$arr[0]);
	}
	
	$sql = "SELECT count(*) FROM ipcard where icd10 like '%".$_POST['search']."%' and date like '".(date("Y")+543)."%' ";
	$result = Mysql_Query($sql);
	$arr = mysql_fetch_array($result);
	
	$sql2 = "SELECT count(*) FROM ipcard where icd10 like '%".$_POST['search']."%' and date like '".((date("Y")+543)-1)."%' ";
	$result2 = Mysql_Query($sql2);
	$arr2 = mysql_fetch_array($result2);
	
	$sql3 = "SELECT count(*) FROM ipcard where icd10 like '%".$_POST['search']."%' and date like '".((date("Y")+543)-2)."%' ";
	$result3 = Mysql_Query($sql3);
	$arr3 = mysql_fetch_array($result3);
	
	$sql5 = "SELECT count(*) FROM ipcard where icd10 like '%".$_POST['search']."%' and date like '".((date("Y")+543)-3)."%' ";
	$result5 = Mysql_Query($sql5);
	$arr5 = mysql_fetch_array($result5);
	
	$sql6 = "SELECT count(*) FROM ipcard where icd10 like '%".$_POST['search']."%' and date like '".((date("Y")+543)-4)."%' ";
	$result6 = Mysql_Query($sql6);
	$arr6 = mysql_fetch_array($result6);
	}//////////////////////////////////////////////////
	elseif($_POST['in']=="2"){
	$sqlicd10 = "CREATE TEMPORARY TABLE opday01 SELECT * FROM opday where icd10 like '%".$_POST['search']."%' and (an is null or an='')";
	$result = Mysql_Query($sqlicd10 ) or die(mysql_error());
	//year now
	$listicd = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT count(*) FROM opday01 where thidate like '".(date("Y")+543)."-".$m."-%' ";
		$result = Mysql_Query($selectsql);
		$arr = mysql_fetch_array($result);
		array_push($listicd,$arr[0]);
	}
	//now-1
	$listicd1 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT count(*) FROM opday01 where thidate like '".((date("Y")+543)-1)."-".$m."-%' ";
		$result = Mysql_Query($selectsql);
		$arr = mysql_fetch_array($result);
		array_push($listicd1,$arr[0]);
	}
	//now-2
	$listicd2 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT count(*) FROM opday01 where thidate like '".((date("Y")+543)-2)."-".$m."-%' ";
		$result = Mysql_Query($selectsql);
		$arr = mysql_fetch_array($result);
		array_push($listicd2,$arr[0]);
	}
	//now-3
	$listicd3 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT count(*) FROM opday01 where thidate like '".((date("Y")+543)-3)."-".$m."-%' ";
		$result = Mysql_Query($selectsql);
		$arr = mysql_fetch_array($result);
		array_push($listicd3,$arr[0]);
	}
	
	//now-4
	$listicd4 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT count(*) FROM opday01 where thidate like '".((date("Y")+543)-4)."-".$m."-%' ";
		$result = Mysql_Query($selectsql);
		$arr = mysql_fetch_array($result);
		array_push($listicd4,$arr[0]);
	}
	
	$sql = "SELECT count(*) FROM opday01 where thidate like '".(date("Y")+543)."%' ";
	$result = Mysql_Query($sql);
	$arr = mysql_fetch_array($result);
	
	$sql2 = "SELECT count(*) FROM opday01 where thidate like '".((date("Y")+543)-1)."%' ";
	$result2 = Mysql_Query($sql2);
	$arr2 = mysql_fetch_array($result2);
	
	$sql3 = "SELECT count(*) FROM opday01 where thidate like '".((date("Y")+543)-2)."%' ";
	$result3 = Mysql_Query($sql3);
	$arr3 = mysql_fetch_array($result3);
	
	$sql5 = "SELECT count(*) FROM opday01 where thidate like '".((date("Y")+543)-3)."%' ";
	$result5 = Mysql_Query($sql5);
	$arr5 = mysql_fetch_array($result5);
	
	$sql6 = "SELECT count(*) FROM opday01 where thidate like '".((date("Y")+543)-4)."%' ";
	$result6 = Mysql_Query($sql6);
	$arr6 = mysql_fetch_array($result6);
	}
	$sql4 = "SELECT * FROM icd10 where code = '".$_POST['search']."' ";
	$result4 = Mysql_Query($sql4);
	$arr4 = mysql_fetch_array($result4);

	?>
    <!--//////////////////////////////////////////////////////////now////////////////////////////////////////////////////////-->
    <? if($_POST['in']=="1") echo "ข้อมูลผู้ป่วยใน"; elseif($_POST['in']=="2") echo "ข้อมูลผู้ป่วยนอก";?>
	<table border="1" cellpadding="0" cellspacing="0" width="100%">
<tr>
  <td width="50" rowspan="2" align="center" class="texticd"><strong>ICD10</strong></td>
<td width="31" rowspan="2" align="center" class="texticd"><strong>ปี 
  <?=(date("Y")+543)?>
</strong></td>
  <td colspan="12" align="center" class="texticd"><strong>ปี 
    <?=(date("Y")+543)?>
  </strong></td>
</tr>
<tr>
  <td width="48" align="center" class="texticd"><strong>ม.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ก.พ.</strong></td>
  <td width="51" align="center" class="texticd"><strong>มี.ค.</strong></td>
  <td width="59" align="center" class="texticd"><strong>เม.ย.</strong></td>
  <td width="51" align="center" class="texticd"><strong>พ.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>มิ.ย.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ก.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ส.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ก.ย.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ต.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>พ.ย.</strong></td>
  <td width="62" align="center" class="texticd"><strong>ธ.ค.</strong></td>
</tr>

<tr><td class="texticd">
  <span class="texticd">
    <?=$arr4['detail']?> 
    (<?=$_POST['search']?>)</span></td>
  <td align="center" class="texticd">
    <span class="texticd">
      <?=$arr[0]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd[0]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd[1]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd[2]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd[3]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd[4]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd[5]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd[6]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd[7]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd[8]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd[9]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd[10]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd[11]?>
    </span></td>
</tr>
</table>
	<br />
    <!--///////now-1-->
    <table border="1" cellpadding="0" cellspacing="0" width="100%">
<tr><td width="50" rowspan="2" align="center" class="texticd"><strong>ICD10</strong></td>
<td width="31" rowspan="2" align="center" class="texticd"><strong>ปี 
  <?=(date("Y")+543)-1?>
</strong></td>
  <td colspan="12" align="center" class="texticd"><strong>ปี 
    <?=(date("Y")+543)-1?>
  </strong></td>
</tr>
<tr>
  <td width="48" align="center" class="texticd"><strong>ม.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ก.พ.</strong></td>
  <td width="51" align="center" class="texticd"><strong>มี.ค.</strong></td>
  <td width="59" align="center" class="texticd"><strong>เม.ย.</strong></td>
  <td width="51" align="center" class="texticd"><strong>พ.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>มิ.ย.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ก.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ส.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ก.ย.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ต.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>พ.ย.</strong></td>
  <td width="62" align="center" class="texticd"><strong>ธ.ค.</strong></td>
</tr>

<tr><td class="texticd">
  <span class="texticd">
    <?=$arr4['detail']?> 
    (<?=$_POST['search']?>)</span></td>
  <td align="center" class="texticd">
    <span class="texticd">
      <?=$arr2[0]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd1[0]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd1[1]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd1[2]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd1[3]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd1[4]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd1[5]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd1[6]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd1[7]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd1[8]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd1[9]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd1[10]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd1[11]?>
    </span></td>
</tr>
</table>
    <br />
    <!--///////now-2-->
    <table border="1" cellpadding="0" cellspacing="0" width="100%">
<tr>
  <td width="50" rowspan="2" align="center" class="texticd"><strong>ICD10</strong></td>
<td width="31" rowspan="2" align="center" class="texticd"><strong>ปี 
  <?=(date("Y")+543)-2?>
</strong></td>
  <td colspan="12" align="center" class="texticd"><strong>ปี 
    <?=(date("Y")+543)-2?>
  </strong></td>
</tr>
<tr>
  <td width="48" align="center" class="texticd"><strong>ม.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ก.พ.</strong></td>
  <td width="51" align="center" class="texticd"><strong>มี.ค.</strong></td>
  <td width="59" align="center" class="texticd"><strong>เม.ย.</strong></td>
  <td width="51" align="center" class="texticd"><strong>พ.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>มิ.ย.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ก.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ส.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ก.ย.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ต.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>พ.ย.</strong></td>
  <td width="62" align="center" class="texticd"><strong>ธ.ค.</strong></td>
</tr>

<tr><td class="texticd">
  <span class="texticd">
    <?=$arr4['detail']?> 
    (<?=$_POST['search']?>)</span></td>
  <td align="center" class="texticd">
    <span class="texticd">
      <?=$arr3[0]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd2[0]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd2[1]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd2[2]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd2[3]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd2[4]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd2[5]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd2[6]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd2[7]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd2[8]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd2[9]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd2[10]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd2[11]?>
    </span></td>
</tr>
</table>
    <br />
    <!--///////now-3-->
    <table border="1" cellpadding="0" cellspacing="0" width="100%">
<tr><td width="50" rowspan="2" align="center" class="texticd"><strong>ICD10</strong></td>
<td width="31" rowspan="2" align="center" class="texticd"><strong>ปี 
  <?=(date("Y")+543)-3?>
</strong></td>
  <td colspan="12" align="center" class="texticd"><strong>ปี 
    <?=(date("Y")+543)-3?>
  </strong></td>
</tr>
<tr>
  <td width="48" align="center" class="texticd"><strong>ม.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ก.พ.</strong></td>
  <td width="51" align="center" class="texticd"><strong>มี.ค.</strong></td>
  <td width="59" align="center" class="texticd"><strong>เม.ย.</strong></td>
  <td width="51" align="center" class="texticd"><strong>พ.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>มิ.ย.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ก.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ส.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ก.ย.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ต.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>พ.ย.</strong></td>
  <td width="62" align="center" class="texticd"><strong>ธ.ค.</strong></td>
</tr>

<tr><td class="texticd">
  <span class="texticd">
    <?=$arr4['detail']?> 
    (<?=$_POST['search']?>)</span></td>
  <td align="center" class="texticd">
    <span class="texticd">
      <?=$arr5[0]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[0]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[1]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[2]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[3]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[4]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[5]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[6]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[7]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[8]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[9]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[10]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[11]?>
    </span></td>
</tr>
</table>
<br />
    <!--///////now-4-->
    <table border="1" cellpadding="0" cellspacing="0" width="100%">
<tr><td width="50" rowspan="2" align="center" class="texticd"><strong>ICD10</strong></td>
<td width="31" rowspan="2" align="center" class="texticd"><strong>ปี 
  <?=(date("Y")+543)-4?>
</strong></td>
  <td colspan="12" align="center" class="texticd"><strong>ปี 
    <?=(date("Y")+543)-4?>
  </strong></td>
</tr>
<tr>
  <td width="48" align="center" class="texticd"><strong>ม.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ก.พ.</strong></td>
  <td width="51" align="center" class="texticd"><strong>มี.ค.</strong></td>
  <td width="59" align="center" class="texticd"><strong>เม.ย.</strong></td>
  <td width="51" align="center" class="texticd"><strong>พ.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>มิ.ย.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ก.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ส.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ก.ย.</strong></td>
  <td width="51" align="center" class="texticd"><strong>ต.ค.</strong></td>
  <td width="51" align="center" class="texticd"><strong>พ.ย.</strong></td>
  <td width="62" align="center" class="texticd"><strong>ธ.ค.</strong></td>
</tr>

<tr><td class="texticd">
  <span class="texticd">
    <?=$arr4['detail']?> 
    (<?=$_POST['search']?>)</span></td>
  <td align="center" class="texticd">
    <span class="texticd">
      <?=$arr6[0]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[0]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[1]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[2]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[3]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[4]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[5]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[6]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[7]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[8]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[9]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[10]?>
    </span></td>
  <td align="center" class="texticd">
    <span class="texticd">
    <?=$listicd3[11]?>
    </span></td>
</tr>
</table>
	<?
}
elseif(!isset($_POST['okbtn'])){
	
?>
<form action="<? $_SERVER['PHP_SELF']?>" method="post" target="_blank" name="form_icd10">
<table>
<tr><td>ค้นหาตาม ICD10 :</td><td><input type="text" name="search" size="10"><input type="submit" value=" ค้นหา " name="okbtn"></td></tr>
<tr><td colspan="2"><input name="in" type="radio" value="1" />ผู้ป่วยใน<input name="in" type="radio" value="2" />ผู้ป่วยนอก</td></tr>

<!--<tr><td>ค้นหาตาม ICD10 :</td><td><input type="text" name="search" size="10"><input type="button" value=" เลือก " name="add" onClick="OnClick_add_icd10(document.form_icd10.search.value)"></td></tr>
-->


<!--<tr><td>ต้องการค้นหา :</td><td><Div id="listicd"></Div><input type="submit" name="okbtn" size="10"></td></tr>-->
</table>
<a href="../nindex.htm"><h3> &lt;&lt;ไปเมนู</h3></a>
</form>
<?
}
?>
