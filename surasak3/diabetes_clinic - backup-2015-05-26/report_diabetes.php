<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>�к���§ҹ�˵ء�ó��Ӥѭ/�غѵԡ�ó�/��������ʹ���ͧ</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script> 
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:20pt;
}
.table_font1{
	font-family:"TH SarabunPSK";
	font-size:18pt;
	font-weight:bold;
	color:#600;	
}
.table_font2{
	font-family:"TH SarabunPSK";
	font-size:18pt;
}
legend{
	
font-family:"TH SarabunPSK";
font-size: 18pt;
font-weight: bold;
color:#600;	
padding:0px 3px;
}
fieldset{
display:inline;
background-color:#FEFDDE;
/*width:300px;*/
border-color:#000;

}
</style>

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
	font-size: 20 px;
}
.fontsara {
	font-family:"TH SarabunPSK";
	font-size: 18 px;
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
<body>


<div id="no_print">
<div id="menu">
  <ul class="menu">
        <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>������ç��Һ��</span></a></li>
         <li><a href="#"><span>ŧ����¹</span></a></li>
          <ul>
		 <li class="last"><a href="diabetes.php"><span>ŧ����¹ DM</span></a></li>
         <li class="last"><a href="hypertension.php"><span>ŧ����¹ HT</span></a></li>
       	</ul>
     	  <li><a href="diabetes_edit.php"><span>��䢢�����</span></a></li>
           <ul>
		 <li class="last"><a href="diabetes_edit.php"><span>��䢢����� DM</span></a></li>
         <li class="last"><a href="hypertension_edit.php"><span>��䢢����� HT</span></a></li>
       	</ul>
         <li><a href="#"><span>��ª��ͼ����� DM</span></a></li>
         <ul>
		 <li class="last"><a href="diabetes_list.php"><span>��ª��ͷ�����</span></a></li>
         <li class="last"><a href="diabetes_list_so.php"><span>��ª��� ����/��ͺ����</span></a></li>
       	</ul>
       <li><a href="#"><span>��ª��ͼ����� HT</span></a></li>
         <ul>
		 <li class="last"><a href="hypertension_list.php"><span>��ª��ͷ�����</span></a></li>
         <li class="last"><a href="hypertension_list_so.php"><span>��ª��� ����/��ͺ����</span></a></li>
       	</ul>
     <li><a href="report_diabetes.php"><span>ʶԵ�</span></a></li>
 		<ul>
		 <li class="last"><a href="report_diabetes.php"><span>ʶԵ� DM</span></a></li>
         <li class="last"><a href="report_hypertension.php"><span>ʶԵ� HT</span></a></li>
       	</ul>
     <li><a href="#"><span>��§ҹ</span></a></li>
 		<ul>
		 <li class="last"><a href="report_diabetesofyear.php"><span>��§ҹ DM</span></a></li>
         <li class="last"><a href="report_hypertensionofyear.php"><span>��§ҹ HT</span></a></li>
       	</ul>        
    </ul>
</div>

<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->
<!--<h1 class="forntsarabun">��ԹԤ����ҹ</h1>-->
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
<!--<h1 class="forntsarabun">ʶԵ�Ἱ��ѧ�ա���</h1>-->
<div id="no_print" >
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
	<tr class="forntsarabun">
		<td  align="right">���͡��</td>
		<td >
		<?php 
			$Y = date("Y")+543;
			$date = date("Y")+543+5;
			$dates = range(2547,$date);
			?>
			<select name="y_start" class="forntsarabun">
			<?php
			foreach($dates as $i){
				
				if(isset($_POST['y_start'])){
					$select = ($i == $_POST['y_start']) ? 'selected' : '' ;
				}else{
					$select = ($i == $Y) ? 'selected' : '' ;
				}
				
				?>
				<option value="<?=$i?>" <?php echo $select; ?>><?=$i;?></option>
				<?php
			}
		?>
			<select>
		</td>
	</tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
   <!-- <input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">
      <a href="../../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a>&nbsp;  <a href="diabetes.php" class="forntsarabun">ŧ����¹����</a> &nbsp; <a href="diabetes_edit.php" class="forntsarabun">�٢����ż���������ҹ</a>
-->      </td>
  </tr>
</table>
</form>
</div>
<?

if(isset($_POST['y_start'])){
	$date1 = intval($_POST['y_start']) - 543;
}else{
	$date1 = date('Y');
}

include("../connect.inc");

// Build a temp
$sql_temp = "CREATE TEMPORARY TABLE hn_merge 
SELECT a.hn, b.orderdate, b.profilecode, a.smork, a.retinal
FROM diabetes_clinic AS a, resulthead AS b 
WHERE a.hn = b.hn 
AND b.orderdate LIKE '$date1-%';";
$query_temp = mysql_query($sql_temp);

if($_POST['submit']=="����"){
	
	// Testing new code
	// echo "<pre>";
	// $test_time = microtime(true);
	
	// Filter HBA1C
	$sql = "
SELECT COUNT(hn) AS rows, DATE_FORMAT( orderdate, '%Y-%m' ) AS new_orderdate
FROM hn_merge
WHERE profilecode = 'HBA1C'
GROUP BY MONTH(orderdate) 
ORDER BY orderdate ASC 
";
	$query = mysql_query($sql) or die( mysql_error($Conn) );
	$hba1c_items = array();
	$hba1c_total = 0;
	while($item = mysql_fetch_assoc($query)){
		$hba1c_total += $item['rows'];
		$hba1c_items[$item['new_orderdate']] = $item;
	}
	
	// Filter LDL
	$sql = "
SELECT COUNT(hn) AS rows, DATE_FORMAT( orderdate, '%Y-%m' ) AS new_orderdate
FROM hn_merge
WHERE profilecode = 'LDL'
GROUP BY MONTH(orderdate) 
ORDER BY orderdate ASC 
";
	$query = mysql_query($sql) or die( mysql_error($Conn) );
	$ldl_items = array();
	$ldl_total = 0;
	while($item = mysql_fetch_assoc($query)){
		$ldl_total += $item['rows'];
		$ldl_items[$item['new_orderdate']] = $item;
	}
	
	// MALB
	$sql = "
	SELECT COUNT(hn) AS rows, DATE_FORMAT( orderdate, '%Y-%m' ) AS new_orderdate
	FROM hn_merge
	WHERE profilecode = 'MALB'
	GROUP BY MONTH(orderdate) 
	ORDER BY orderdate ASC 
	";
	$query = mysql_query($sql) or die( mysql_error($Conn) );
	$malb_items = array();
	$malb_total = 0;
	while($item = mysql_fetch_assoc($query)){
		$malb_total += $item['rows'];
		$malb_items[$item['new_orderdate']] = $item;
	}
	
	
	// Create temp for diabetes_clinic only
	$sql_temp = "CREATE TEMPORARY TABLE diabetes_temp 
	( l_hbalc FLOAT NOT NULL, l_creatinine FLOAT NOT NULL, thidate DATE NOT NULL, dbbirt DATE NOT NULL  ) 
	SELECT *
	FROM diabetes_clinic 
	WHERE thidate LIKE '$date1-%';";
	// var_dump($sql_temp);
	mysql_query($sql_temp);
	
	// �ӹǹ�����·�����㹻չ��
	$query = mysql_query("SELECT COUNT(row_id) AS total FROM diabetes_temp");
	$all_user = mysql_fetch_assoc($query);
	
	
	// var_dump(microtime(true) - $test_time);
	// Ending new code
	
	// Set default variable
	$months = array(
		'01' => '�.�.', 
		'02' => '�.�.', 
		'03' => '��.�', 
		'04' => '��.�.', 
		'05' => '�.�.', 
		'06' => '��.�.', 
		'07' => '�.�.', 
		'08' => '�.�.', 
		'09' => '�.�.', 
		'10' => '�.�.', 
		'11' => '�.�.', 
		'12' => '�.�.'
	);
	$key_year = $date1;

	?>
	<style>
		td{ padding: 4px; }
	</style>
	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
		<tr>
			<td rowspan="2" align="center" class="forntsarabun"><p>����ͧ����Ѵ</p></td>
			<td rowspan="2" align="center" class="forntsarabun">���</td>
			<!-- <td rowspan="2" align="center" class="forntsarabun">��<br><?=($date1+543)?></td> -->
			<td colspan="12" align="center" class="forntsarabun">�� <?=($date1+543)?></td>
		</tr>
		<tr>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">��.�.</td>
			<td align="center" class="forntsarabun">��.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">��.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
		</tr>
		<tr>
			<td class="forntsarabun">1. �ѵ�Ҽ����� DM ������Ѻ������ HbA1c ���ҧ���� 1 ����/��</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<!-- <td align="center" class="forntsarabun"><?=$hba1c_total;?></td> -->
			<?php 
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($hba1c_items[$find_key]){
					$pre_row = $hba1c_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $hba1c_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">2. �ѵ�Ҽ����� DM ������Ѻ������ LDL ���ҧ���� 1 ����/��</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<!-- <td align="center" class="forntsarabun"><?=$ldl_total;?></td> -->
			<?php 
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($ldl_items[$find_key]){
					$pre_row = $ldl_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $ldl_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">3. �ѵ�Ҽ����� DM ������Ѻ��õ�Ǩ Micro albuminuria ���ҧ���� 1 ����/��</td>
			<td align="center" class="forntsarabun">&gt;70%</td>
			<!-- <td align="center" class="forntsarabun"><?=$malb_total;?></td> -->
			<?php 
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($malb_items[$find_key]){
					$pre_row = $malb_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $malb_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">4. �ѵ�Ҽ����� DM ������Ѻ��õ�Ǩ�ͻ���ҷ��</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// ��Ǩ�ͻ���ҷ��
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE `retinal` !=  ''
			GROUP BY MONTH( thidate ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$retinal_items = array();
			$retinal_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$retinal_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($retinal_items[$find_key]){
					$pre_row = $retinal_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $retinal_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">5. �ѵ�Ҽ����� DM ������Ѻ��õ�Ǩ�آ�Ҿ��ͧ�ҡ</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				// if($retinal_items[$find_key]){
					// $pre_row = $retinal_items[$find_key]['rows'];
					// $item_row = round( ( ( $pre_row / $retinal_total ) * 100 ) ,1);
				// }
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">6. �ѵ�Ҽ����� DM ������Ѻ��õ�Ǩ���</td>
			<td align="center" class="forntsarabun">&gt;20%</td>
			<?php 
			
			// ��Ǩ���
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE `foot` !=  '' AND `foot` != '-'
			GROUP BY MONTH( thidate ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$foot_items = array();
			$foot_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$foot_items[$item['new_daten']] = $item;
			}
	
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($foot_items[$find_key]){
					$pre_row = $foot_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">7. �ѵ�Ҽ����� DM �������ٺ������</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// DM �������ٺ������
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE `smork` =  '' OR `smork` = '0'
			GROUP BY MONTH( thidate ) 
			";
			// var_dump($sql);
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$smoke_items = array();
			$smoke_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$smoke_items[$item['new_daten']] = $item;
			}
	
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($smoke_items[$find_key]){
					$pre_row = $smoke_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">8. �ѵ�Ҽ����� DM ������Ѻ���йӴ�ҹ����ҡ��</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// Nutrition ���йӴ�ҹ����ҡ��
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE `nutrition` !=  '' AND `nutrition` = 1
			GROUP BY MONTH( thidate ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$nutrition_items = array();
			$nutrition_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$nutrition_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($nutrition_items[$find_key]){
					$pre_row = $nutrition_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">9. �ѵ�Ҽ����� DM ������Ѻ�����������ͧ Exercise</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// Nutrition ���йӴ�ҹ����á�áԹ
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE `exercise` !=  '' AND `exercise` = 1
			GROUP BY MONTH( thidate ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$exercise_items = array();
			$exercise_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$exercise_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($exercise_items[$find_key]){
					$pre_row = $exercise_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">
			10. �ѵ�Ҽ����� DM ���дѺ Fasting Blood Glucose �����ࡳ��<br>
			( FBG &lt; 130 mg % 㹼����� DM ����<br>
			FBG &lt; 150 mg % 㹼����� DM �������á��͹)
			</td>
			<td align="center" class="forntsarabun">&gt;60%</td>
			<?php 
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE ( `l_bs` < 130 AND ( `ht` = '' OR `ht` = 0 ) ) 
			OR (
				`l_bs` < 150 AND `l_bs` != '' AND ( `ht_etc` != '' OR `ht` = 1 OR `ht` = 3 ) 
			)
			GROUP BY MONTH( thidate ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$fbg_items = array();
			$fbg_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$fbg_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($fbg_items[$find_key]){
					$pre_row = $fbg_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">
			11. �ѵ�Ҽ����� DM ���дѺ HbA1c �����ࡳ���������<br>
			( HbA1c &lt; 7 % 㹼����� DM ����<br>
			HbA1c &lt; 8 % 㹼����� DM �������á��͹)
			</td>
			<td align="center" class="forntsarabun">&gt;60%</td>
			<?php 
			$sql = "
			SELECT COUNT( `l_hbalc` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE (`l_hbalc` <  7 AND `l_hbalc` > 0 )
			OR (
				`l_hbalc` < 8 AND `l_hbalc` > 0 AND ( `ht` = 1 OR `ht` = 3 OR `ht_etc` != '' ) 
			) 
			GROUP BY MONTH( thidate ) 
			";
			// var_dump($sql);
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$hba1c_dm_items = array();
			$hba1c_dm_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$hba1c_dm_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($hba1c_dm_items[$find_key]){
					$pre_row = $hba1c_dm_items[$find_key]['rows'];
					$item_percent = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
					
					$item_row = '<a href="diabetes_more.php?type=hba1c&year='.$date1.'&month='.$key.'" target="_blank" title="��ԡ�����Դ˹�ҵ�ҧ����">'.$item_percent.'</a>';
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">
			12. �ѵ�Ҽ����� DM ���дѺ LDL �����ࡳ���������<br>
			( LDL &lt; 100 mg/dl 㹼����� DM ����<br>
			LDL &lt; 70 mg/dl 㹼����� DM �������á��͹)
			</td>
			<td align="center" class="forntsarabun">&gt;60%</td>
			<?php 
			$sql = "
			SELECT COUNT( `l_hbalc` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE ( `l_ldl` <  100 AND `l_ldl` > 0 )
			OR (
				`l_ldl` < 70 AND `l_ldl` > 0 AND ( `ht` = 1 OR `ht` = 3 OR `ht_etc` != '' )
			)
			GROUP BY MONTH( thidate ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$hba1c_dm_items = array();
			$hba1c_dm_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$hba1c_dm_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($hba1c_dm_items[$find_key]){
					$pre_row = $hba1c_dm_items[$find_key]['rows'];
					$item_percent = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
					
					$item_row = '<a href="diabetes_more.php?type=ldl&year='.$date1.'&month='.$key.'" target="_blank" title="��ԡ�����Դ˹�ҵ�ҧ����">'.$item_percent.'</a>';
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">
			13. �ѵ�Ҽ����� DM ���дѺ�����ѹ���Ե �����ࡳ���������<br>
			- SBP &lt; 140 mmHg 㹼����� DM ����<br>
			- DBP &lt; 90 mmHg 㹼����� DM ����<br>
			- SBP &lt; 130 mmHg 㹼����� DM ������õչ����㹻����<br>
			- DBP &lt; 80 mmHg 㹼����� DM ������õչ����㹻����<br>
			- SBP &lt; 150 mmHg 㹼����� DM ����������á��͹��������ҡ���� 60 ��<br>
			- DBP &lt; 80 mmHg 㹼����� DM ����������á��͹��������ҡ���� 60 ��
			</td>
			<td align="center" class="forntsarabun">&gt;60%</td>
			<?php 
			
			// GET y_start from post
			$year_current = intval($_POST['y_start']).date('-m-d');
			
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE ( `bp1` < 140 AND ( `ht` = '' OR `ht` = 0 ) )
			OR ( `bp2` < 90 AND ( `ht` = '' OR `ht` = 0 ) )
			OR ( `bp1` < 130 AND `l_creatinine` >= 1.30 )
			OR ( `bp2` < 80 AND `l_creatinine` >= 1.30 )
			OR (
				`bp1` < 150  AND ( `ht` = 1 OR `ht` = 3 OR `ht_etc` != '' ) AND TIMESTAMPDIFF( YEAR, dbbirt, '$year_current' ) > 60
			)
			OR (
				`bp2` < 80  AND ( `ht` = 1 OR `ht` = 3 OR `ht_etc` != '' ) AND TIMESTAMPDIFF( YEAR, dbbirt, '$year_current' ) > 60
			)
			GROUP BY MONTH( thidate ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$hba1c_dm_items = array();
			$hba1c_dm_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$hba1c_dm_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($hba1c_dm_items[$find_key]){
					$pre_row = $hba1c_dm_items[$find_key]['rows'];
					$item_percent = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
					
					$item_row = '<a href="diabetes_more.php?type=ldl&year='.$date1.'&month='.$key.'" target="_blank" title="��ԡ�����Դ˹�ҵ�ҧ����">'.$item_percent.'</a>';
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">16. �ѵ�Ҽ����� DM ����ٺ������</td>
			<td align="center" class="forntsarabun">&lt;20%</td>
			<?php 
			
			// DM ����ٺ������
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE `smork` !=  '' AND `smork` = '1'
			GROUP BY MONTH( thidate ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$smoke_items = array();
			$smoke_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$smoke_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($smoke_items[$find_key]){
					$pre_row = $smoke_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">20. �����¡���� DM ��� Clinic DM</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// HbA1c ����ҡ���� 7% ������Ѻ��õ�Ǩ���
			// $sql = "
			// SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			// FROM `diabetes_temp` 
			// WHERE `foot` !=  '' AND `l_hbalc` >= 7
			// GROUP BY MONTH( thidate ) 
			// ";
			// $query = mysql_query($sql) or die( mysql_error($Conn) );
			// $hba1c_foot_items = array();
			// $hba1c_foot_total = $all_user['total'];
			
			// while($item = mysql_fetch_assoc($query)){
				// $hba1c_foot_items[$item['new_daten']] = $item;
			// }
			
			foreach($months AS $key => $value){
				$item_row = 0;
				// $find_key = "$key_year-$key";
				// if($hba1c_foot_items[$find_key]){
					// $pre_row = $hba1c_foot_items[$find_key]['rows'];
					// $item_row = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
				// }
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">21. �����¡���� DM ����դ�� HbA1c > 7% ���Ǩ���</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// HbA1c ����ҡ���� 7% ������Ѻ��õ�Ǩ���
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE `foot` !=  '' AND `l_hbalc` >= 7
			GROUP BY MONTH( thidate ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$hba1c_foot_items = array();
			$hba1c_foot_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$hba1c_foot_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($hba1c_foot_items[$find_key]){
					$pre_row = $hba1c_foot_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
	</table>

<?php } // End if submit ?>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd -->
</html>