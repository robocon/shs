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
        <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>˹���á</span></a></li>
        <li><a href="ncf2.php" class="parent"><span>�ѹ�֡��§ҹ�˵ء�ó��Ӥѭ</span></a></li>
		<li><a href="fha_from.php" class="parent"><span>�ѹ�֡��§ҹ������Ҵ����͹�ҧ��</span></a></li>
        <li><a href="report_ift.php" class="parent"><span>Ẻ�ѹ�֡��õԴ������С�õԴ����</span></a></li>
        <li><a href="report_accident.php" class="parent"><span>Ẻ��§ҹ������Ѻ�غѵ��˵�</span></a></li>
      <?
		if($_SESSION["statusncr"]=='admin'){
	  ?>    
    
    	<li><a href="#"><span>���§ҹ�˵ء�ó��</span></a></li>
        <ul>
		<li class="last"><a href="ncf_list_clinic.php"><span>���§ҹ����ѧ�����ѹ�֡�дѺ�����ع�ç</a></span></li>
        <li class="last"><a href="ncf_list_risk.php"><span>���§ҹ����ѧ�����ѹ�֡��������§</a></span></li>
        <li class="last"><a href="ncf_list_ic.php"><span>���§ҹ ੾�� IC ��� MR </span></a></li>
    	<li class="last"><a href="ncf_listall.php"><span>���§ҹ������</span></a></li>
        <li class="last"><a href="ncf_list_riskmore2.php"><span>��Ǩ�ͺ���§ҹ</span></a></li>
        </ul>
        <li><a href="#"><span>��§ҹ��ػ</span></a></li>
     	<ul>
        <li class="last"><a href="ncr_report_all.php"><span>��§ҹ��ػ�غѵԡ�ó� ���������</span></a></li>
	  	<li class="last"><a href="ncr_report_progarm.php"><span>��§ҹ��ػ�غѵԡ�ó��ṡ��������</span></a></li>
        <li class="last"><a href="ncr_report_event.php"><span>��§ҹ��ػ�غѵԡ�ó��ṡ����˵ء�ó�</span></a></li>
        <li class="last"><a href="ncf_report_departall.php"><span>��§ҹ��ػ�غѵԡ�ó��ṡ���Ἱ�</span></a></li>
        <li class="last"><a href="ncr_report_progarmdepart2.php"><span>��§ҹ��ػ��������§����Ἱ�</span></a></li>
        <li class="last"><a href="ncr_report_clinic.php"><span>��§ҹ��ػ�дѺ�����ع�ç</span></a></li>
	  	<li class="last"><a href="ncf_report_depart.php"><span>˹��§ҹ�����§ҹ�غѵԡ�ó�</a></span></li>
        <li class="last"><a href="fha_report_depart.php"><span>��§ҹ��ػ ������Ҵ����͹�ҧ��</a></span></li>
        <li class="last"><a href="report_ic_accident.php"><span>��§ҹ�غѵԡ�ó� IC</span></a></li>
        <li class="last"><a href="ic_report_depart.php"><span>��ػ�غѵԡ�ó� IC  ��Шӻ�</span></a></li>
       	</ul>
        <li><a href="#"><span>��§ҹ������Ҵ����͹�ҧ��</span></a></li>
     
     <ul>
	  	<li class="last"><a href="fha_data_old.php"><span>��������� ��ѧ��͹ �.�.2555</span></a></li>
	  	<li class="last"><a href="report_fha.php"><span>���������� ����� �.�.2555 ����</a></span></li>
       	</ul>
        <li><a href="ncf_member.php"><span>��ª��ͼ������к�</span></a></li>
        <li><a href="logout.php"><span>�͡�ҡ�к�</span></a></li>
        
       <? } if($_SESSION["statusncr"]=='staff'){?>
       <li><a href="ncf_list_depart.php"><span>���§ҹ�˵ء�ó��</span></a></li>
        <ul>
	  	<li class="last"><a href="ncf_list_depart.php"><span>���§ҹ�˵ء�ó��  (��������� 2556)</span></a></li>
	  	<li class="last"><a href="ncf_list_old.php"><span>���§ҹ�˵ء�ó�� (�������� < 2556)</a></span></li>
       	</ul>
       <li><a href="#"><span>ʶԵ�</span></a></li> 
       
       <ul>
	  	<li class="last"><a href="ncr_report_progarmdepart.php"><span>ʶԵԤ�������§�ͧἹ�</span></a></li> 
	  	<li class="last"><a href="ncr_report_all_depart.php"><span>ʶԵ��غѵԡ�ó� </a></span></li>
       	</ul>
       <li><a href="ncf_member.php"><span>��ª��ͼ������к�</span></a></li>
        <li><a href="logout.php"><span>�͡�ҡ�к�</span></a></li>
        
     <? } if($_SESSION["statusncr"]=='phar'){?>
     
     <li><a href="#"><span>��§ҹ������Ҵ����͹�ҧ��</span></a></li>
     
     <ul>
	  	<li class="last"><a href="fha_data_old.php"><span>��������� ��ѧ��͹ �.�.2555</span></a></li>
	  	<li class="last"><a href="report_fha.php"><span>���������� ����� �.�.2555 ����</a></span></li>
       	</ul>
       
        <li><a href="logout.php"><span>�͡�ҡ�к�</span></a></li>
        <? } if($_SESSION["statusncr"]!='admin' && $_SESSION["statusncr"]!='staff' && $_SESSION["statusncr"]!='phar'  && $_SESSION["Userncr"]!=""){ ?>
        <li><a href="ncf_list_depart.php"><span>���§ҹ�˵ء�ó��</span></a></li>
        <ul>
	  	<li class="last"><a href="ncf_list_depart.php"><span>���§ҹ�˵ء�ó��  (��������� 2556)</span></a></li>
	  	<li class="last"><a href="ncf_list_old.php"><span>���§ҹ�˵ء�ó�� (�������� < 2556)</a></span></li>
       	</ul>
        <li><a href="#"><span>��§ҹ��ػ</span></a></li>
     	<ul>
	  	<li class="last"><a href="ncr_report_progarm.php"><span>��§ҹ��ػ�غѵԡ�ó��ṡ��������</span></a></li>
        <? if($_SESSION["statusncr"]=='IC'){ ?>
        <li class="last"><a href="report_ic_accident.php"><span>��§ҹ�غѵԡ�ó� IC</span></a></li>
        <li class="last"><a href="ic_report_depart.php"><span>��ػ�غѵԡ�ó� IC  ��Шӻ�</span></a></li>
        <? } ?>
	  <!--	<li class="last"><a href="ncf_report_depart.php"><span>˹��§ҹ�����§ҹ�غѵԡ�ó�</a></span></li>-->
       	</ul>
        <!--<li><a href="ncf_member.php"><span>ʶԵԤ�������§</span></a></li>--> 
        <li><a href="ncf_member.php"><span>��ª��ͼ������к�</span></a></li>
        <li><a href="logout.php"><span>�͡�ҡ�к�</span></a></li>
      <?  }   if(!$_SESSION["Userncr"]){?>
        <li class="last"><a href="login.php"><span>�������к�</span></a></li>
        <? } ?>
         
	

    </ul>
</div>
<?
include("connect.inc");
if(isset($_SESSION["Userncr"])){

$strSQL = "SELECT * FROM member WHERE  username = '".$_SESSION["Userncr"]."'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
?>
<span class="fontsara">�����ҹ��й�� ::  <strong><?=$objResult['name']?></strong> &nbsp;&nbsp;<strong><?=$_SESSION["Untilncr"]?></strong></span> <? } ?>
<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">aaa</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->
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
<div id="no_print" >
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td  align="right" bgcolor="#FFFFCC">&nbsp;</td>
    <td bgcolor="#FFFFCC" >����</td>
  </tr>
  <tr class="forntsarabun">
    <td width="64"  align="right">���͡��</td>
    <td width="387" >
<!--      <select name="m_start" class="forntsarabun">
        <option value="">---������͡��͹---</option>
        <option value="01" <?//if($m=='01'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="02" <?//if($m=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
        <option value="03" <?//if($m=='03'){ echo "selected"; }?>>�չҤ�</option>
        <option value="04" <?//if($m=='04'){ echo "selected"; }?>>����¹</option>
        <option value="05" <?//if($m=='05'){ echo "selected"; }?>>����Ҥ�</option>
        <option value="06" <?//if($m=='06'){ echo "selected"; }?>>�Զع�¹</option>
        <option value="07" <?//if($m=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
        <option value="08" <?//if($m=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
        <option value="09" <?//if($m=='09'){ echo "selected"; }?>>�ѹ��¹</option>
        <option value="10" <?//if($m=='10'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="11" <?//if($m=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
        <option value="12" <?//if($m=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
      </select>-->
<? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){
 
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
    <input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun"></td>
  </tr>
</table>
</form>
</div>
<?

	if($_POST['y_start']!=''){
		$date1=($_POST['y_start']);
	}else{
		$date1=(date("Y")+543);
	}
	
	
$sqlncr= "CREATE TEMPORARY TABLE ncr SELECT *  FROM  ncr2556  WHERE nonconf_date  like '".$date1."%' ";
$result = Mysql_Query($sqlncr) or die(mysql_error());

//$arr=array("risk1","risk2","risk3","risk4","risk5","risk6","risk7","risk8","risk9");


	

?>

<h1 align="center" class="forntsarabun">��§ҹ��ػ�غѵԡ�ó�  ��Шӻ� <?=$date1;?></h1>
<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
  <tr>
    <td rowspan="2" align="center" bgcolor="#00CCFF" class="forntsarabun"><p>��͹</p></td>
    <td colspan="10" align="center" bgcolor="#00CCFF" class="forntsarabun">�дѺ�����ع�ç�ҧ��Թԡ</td>
    <td colspan="9" align="center" bgcolor="#00CCFF" class="forntsarabun">�˵ء�ó�</td>
    <td colspan="10" align="center" bgcolor="#00CCFF" class="forntsarabun">��Դ�ͧ��������§</td>
    <td colspan="6" align="center" bgcolor="#00CCFF" class="forntsarabun">PSG</td>
    <!--<td rowspan="2" align="center" bgcolor="#00CCFF" class="forntsarabun"><p>���������</p></td>-->
  </tr>
  <tr>
	<!--��Ǣ�� A - I -->
	<?  for ($i='A'; $i<='I'; $i++) {  ?>
		<td align="center" bgcolor="#00CCFF" class="forntsarabun"  width="2%"><?=$i;?></td>
	<? } ?>
	<td align="center" bgcolor="#FF9966" class="forntsarabun" width="2%">���</td>
	<!--�� ��Ǣ�� A - I -->

	<!--��Ǣ�� �˵��ó� 1-8 -->
	<? 
	for($ev=1;$ev<=8;$ev++){
	?>
		<td align="center" bgcolor="#00CCFF" class="forntsarabun" width="2%"><?=$ev;?></td>
	<? } ?>    
	<td align="center" bgcolor="#FF9966" class="forntsarabun" width="2%">���</td>
	<!--�� ��Ǣ�� �˵��ó� 1-8 -->
 
	<!--��Ǣ�� ��Դ�ͧ��������§ 1-9 -->
	<? 
	for($risk=1;$risk<=9;$risk++){
	?>
		<td align="center" bgcolor="#00CCFF" class="forntsarabun" width="2%"><?=$risk;?></td>
	<? } ?>    
	<td align="center" bgcolor="#FF9966" class="forntsarabun" width="2%" >���</td>
	<!--�� ��Ǣ�� ��Դ�ͧ��������§ 1-9 -->
 
    <td align="center" bgcolor="#00CCFF" class="forntsarabun" width="2%">F</td>
    <td align="center" bgcolor="#00CCFF" class="forntsarabun" width="2%">B</td>
    <td align="center" bgcolor="#00CCFF" class="forntsarabun" width="2%">I</td>
    <td align="center" bgcolor="#00CCFF" class="forntsarabun" width="2%">T</td>
    <td align="center" bgcolor="#00CCFF" class="forntsarabun" width="2%">S</td>
    <td align="center" bgcolor="#FF9966" class="forntsarabun" width="2%">���</td>
  </tr>

<? 
// for �����ҧ �.�. 仨��֧ �.�.
for($n=1;$n<=12;$n++){
	
	$item_lists = array();
	$item_already_exists = array();
	
	if($n<10){
		$n="0".$n;		
	}
	
	$nonconf_date = $date1.'-'.$n;
	switch($n){
		case "01": $printmonth = "���Ҥ�"; break;
		case "02": $printmonth = "����Ҿѹ��"; break;
		case "03": $printmonth = "�չҤ�"; break;
		case "04": $printmonth = "����¹"; break;
		case "05": $printmonth = "����Ҥ�"; break;
		case "06": $printmonth = "�Զع�¹"; break;
		case "07": $printmonth = "�á�Ҥ�"; break;
		case "08": $printmonth = "�ԧ�Ҥ�"; break;
		case "09": $printmonth = "�ѹ��¹"; break;
		case "10": $printmonth = "���Ҥ�"; break;
		case "11": $printmonth = "��Ȩԡ�¹"; break;
		case "12": $printmonth = "�ѹ�Ҥ�"; break;
	}
	$mm=$printmonth.' '.$date1;

?>
  <tr>
    <td class="forntsarabun"><?=$mm;?></td>
	
	<!----///////////////// A - I  ////////////////////////////////--->
	<?php 
	$sum1=0;
	for ($i='A'; $i<='I'; $i++) {
		$selectsql = "SELECT COUNT(*)as count FROM ncr WHERE  nonconf_date like '$nonconf_date%' and clinic ='$i'";
		
		// var_dump($selectsql);
		
		$result1 = mysql_query($selectsql);
		// $numrow1=mysql_num_rows($result1);
		$arr1  = mysql_fetch_array($result1);

		if($arr1['count']!=0){
			?>
			<td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&clinic=<?=$i;?>" target="_blank"><?=$arr1['count'];?></a></td>
		<? }else{ ?>
			<td align="center" class="forntsarabun"><?=$arr1['count'];?></td>
			<? 
		}
		$sum1+=$arr1['count'];
	} 
	?>
	<td align="center" class="forntsarabun"  bgcolor="#FF9966"><?=$sum1;?></td>

	<!----///////////////// �� A - I  ////////////////////////////////--->
 
	<?php 
	$selectsql_event1= "SELECT COUNT(*)as count1 FROM    ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic1_1 or topic1_2 or topic1_3 or topic1_4 or topic1_5 or  topic1_6 !=0  or topic1_7 !='' ) ";
	$result_event1= mysql_query($selectsql_event1); 
	$arrevent1  = mysql_fetch_array($result_event1);

	$selectsql_event2= "SELECT COUNT(*)as count2 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic2_1 or topic2_2 or topic2_3 or topic2_4 or topic2_5   or topic2_6 !=0  or topic2_7 !='' ) ";
	
	// var_dump($selectsql_event2);
	$result_event2= mysql_query($selectsql_event2); 
	$arrevent2  = mysql_fetch_array($result_event2);

$selectsql_event3= "SELECT COUNT(*)as count3 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic3_1 or topic3_2 or topic3_3 !=0 or  topic3_4 !='' ) ";
$result_event3= mysql_query($selectsql_event3); 
$arrevent3  = mysql_fetch_array($result_event3);

$selectsql_event4= "SELECT COUNT(*)as count4 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic4_1 or topic4_2 or topic4_3 or topic4_4 or topic4_5 !=0 or  topic4_6 !='' ) ";
$result_event4= mysql_query($selectsql_event4); 
$arrevent4  = mysql_fetch_array($result_event4);

$selectsql_event5= "SELECT COUNT(*)as count5 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic5_1 or topic5_2 or topic5_3 or topic5_4 or topic5_5 or topic5_6 or topic5_7 or topic5_8 or topic5_9 or topic5_10  !=0 or  topic5_11 !='' ) ";
$result_event5= mysql_query($selectsql_event5); 
$arrevent5  = mysql_fetch_array($result_event5);

$selectsql_event6= "SELECT COUNT(*)as count6 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic6_1 or topic6_2 or topic6_3 or topic6_4   !=0  or  topic6_5 !='' ) ";
$result_event6= mysql_query($selectsql_event6); 
$arrevent6  = mysql_fetch_array($result_event6);

$selectsql_event7= "SELECT COUNT(*)as count7 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic7_1 or topic7_2 or topic7_3 or topic7_4 or topic7_5 or topic7_6 !=0 or  topic7_7 !='' ) ";
$result_event7= mysql_query($selectsql_event7); 
$arrevent7  = mysql_fetch_array($result_event7);

$selectsql_event8= "SELECT COUNT(*)as count8 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic8_1 or topic8_2 or topic8_3 or topic8_4 or topic8_5 or topic8_6 or topic8_7 or topic8_8 or topic8_9 or topic8_10  !=0 or  topic8_11 !='' ) ";
$result_event8= mysql_query($selectsql_event8); 
$arrevent8  = mysql_fetch_array($result_event8);



	
	######################## ���ͺ�óշ�� 1 �ѹ�֡��§ҹ���ҡ���� 1 �˵ء�ó�  ############################
	
	$test_sql = "SELECT `nonconf_id` FROM `ncr` 
	WHERE `nonconf_date` LIKE '$nonconf_date%' AND (
	`topic1_1` != 0 OR `topic1_2` != 0 OR `topic1_3` != 0 OR `topic1_4` != 0 OR `topic1_5` != 0 OR `topic1_6` != 0 OR `topic1_7` != '' OR `topic1_7` IS NULL
	)";
	$test_query = mysql_query($test_sql); 
	$test_rows = mysql_num_rows($test_query);
	
	if($test_rows > 0){
		
		while($test_result  = mysql_fetch_assoc($test_query)){
			
			if(in_array($test_result['nonconf_id'], $item_lists) === false){
				$item_lists[] = $test_result['nonconf_id'];
			}else{
				$item_already_exists[] = $test_result['nonconf_id'];
			}
			
		}

	}
	
	
	$test_sql = "SELECT `nonconf_id` FROM `ncr` 
	WHERE `nonconf_date` LIKE '$nonconf_date%' AND (
	`topic2_1` != 0 OR `topic2_2` != 0 OR `topic2_3` != 0 OR `topic2_4` != 0 OR `topic2_5` != 0 OR `topic2_6` != 0 OR `topic2_7` != '' OR `topic2_7` IS NULL
	)";
	$test_query = mysql_query($test_sql); 
	$test_rows = mysql_num_rows($test_query);
	
	if($test_rows > 0){
		
		while($test_result  = mysql_fetch_assoc($test_query)){
			
			if(in_array($test_result['nonconf_id'], $item_lists) === false){
				$item_lists[] = $test_result['nonconf_id'];
			}else{
				$item_already_exists[] = $test_result['nonconf_id'];
			}
			
		}

	}
	
	$test_sql = "SELECT `nonconf_id` FROM `ncr` 
	WHERE `nonconf_date` LIKE '$nonconf_date%' AND (
	`topic3_1` != 0 OR `topic3_2` != 0 OR `topic3_3` != 0 OR `topic3_4` != '' OR `topic3_4` IS NULL
	)";
	$test_query = mysql_query($test_sql); 
	$test_rows = mysql_num_rows($test_query);
	
	if($test_rows > 0){
		
		while($test_result  = mysql_fetch_assoc($test_query)){
			
			if(in_array($test_result['nonconf_id'], $item_lists) === false){
				$item_lists[] = $test_result['nonconf_id'];
			}else{
				$item_already_exists[] = $test_result['nonconf_id'];
			}
			
		}

	}
	
	$test_sql = "SELECT `nonconf_id` FROM `ncr` 
	WHERE `nonconf_date` LIKE '$nonconf_date%' AND (
	`topic4_1` != 0 OR `topic4_2` != 0 OR `topic4_3` != 0 OR `topic4_4` != 0 OR `topic4_5` != 0 OR `topic4_6` != '' OR `topic4_6` IS NULL
	)";
	$test_query = mysql_query($test_sql); 
	$test_rows = mysql_num_rows($test_query);
	
	if($test_rows > 0){
		
		while($test_result  = mysql_fetch_assoc($test_query)){
			
			if(in_array($test_result['nonconf_id'], $item_lists) === false){
				$item_lists[] = $test_result['nonconf_id'];
			}else{
				$item_already_exists[] = $test_result['nonconf_id'];
			}
			
		}

	}
	
	$test_sql = "SELECT `nonconf_id` FROM `ncr` 
	WHERE `nonconf_date` LIKE '$nonconf_date%' AND (
	`topic5_1` != 0 OR `topic5_2` != 0 OR `topic5_3` != 0 OR `topic5_4` != 0 OR `topic5_5` != 0 OR `topic5_6` != 0 OR `topic5_7` != 0 OR `topic5_8` != 0 OR `topic5_9` != 0 OR `topic5_10` != 0 OR `topic5_11` != '' OR `topic5_11` IS NULL
	)";
	$test_query = mysql_query($test_sql); 
	$test_rows = mysql_num_rows($test_query);
	
	if($test_rows > 0){
		
		while($test_result  = mysql_fetch_assoc($test_query)){
			
			if(in_array($test_result['nonconf_id'], $item_lists) === false){
				$item_lists[] = $test_result['nonconf_id'];
			}else{
				$item_already_exists[] = $test_result['nonconf_id'];
			}
			
		}

	}
	
	
	$test_sql = "SELECT `nonconf_id` FROM `ncr` 
	WHERE `nonconf_date` LIKE '$nonconf_date%' AND (
	`topic6_1` != 0 OR `topic6_2` != 0 OR `topic6_3` != 0 OR `topic6_4` != 0 OR `topic6_5` != '' OR `topic6_5` IS NULL
	)";
	$test_query = mysql_query($test_sql); 
	$test_rows = mysql_num_rows($test_query);
	
	if($test_rows > 0){
		
		while($test_result  = mysql_fetch_assoc($test_query)){
			
			if(in_array($test_result['nonconf_id'], $item_lists) === false){
				$item_lists[] = $test_result['nonconf_id'];
			}else{
				$item_already_exists[] = $test_result['nonconf_id'];
			}
			
		}

	}
	
	$test_sql = "SELECT `nonconf_id` FROM `ncr` 
	WHERE `nonconf_date` LIKE '$nonconf_date%' AND (
	`topic7_1` != 0 OR `topic7_2` != 0 OR `topic7_3` != 0 OR `topic7_4` != 0 OR `topic7_5` != 0 OR `topic7_6` != 0 OR `topic7_7` != '' OR `topic7_7` IS NULL
	)";
	$test_query = mysql_query($test_sql); 
	$test_rows = mysql_num_rows($test_query);
	
	if($test_rows > 0){
		
		while($test_result  = mysql_fetch_assoc($test_query)){
			
			if(in_array($test_result['nonconf_id'], $item_lists) === false){
				$item_lists[] = $test_result['nonconf_id'];
			}else{
				$item_already_exists[] = $test_result['nonconf_id'];
			}
			
		}

	}
	
	$test_sql = "SELECT `nonconf_id` FROM `ncr` 
	WHERE `nonconf_date` LIKE '$nonconf_date%' AND (
	`topic8_1` != 0 OR `topic8_2` != 0 OR `topic8_3` != 0 OR `topic8_4` != 0 OR `topic8_5` != 0 OR `topic8_6` != 0 OR `topic8_7` != 0 OR `topic8_8` != 0 OR `topic8_9` != 0 OR `topic8_10` != 0 OR `topic8_11` != '' OR `topic8_11` IS NULL
	)";
	$test_query = mysql_query($test_sql); 
	$test_rows = mysql_num_rows($test_query);
	
	if($test_rows > 0){
		
		while($test_result  = mysql_fetch_assoc($test_query)){
			
			if(in_array($test_result['nonconf_id'], $item_lists) === false){
				$item_lists[] = $test_result['nonconf_id'];
			}else{
				$item_already_exists[] = $test_result['nonconf_id'];
			}
			
		}

	}
	
	
			
		// var_dump($item_already_exists);
		// echo "<hr>";
		
		
		
	######################## ����÷��ͺ�óշ�� 1 �ѹ�֡��§ҹ���ҡ���� 1 �˵ء�ó�  ############################




if($arrevent1['count1']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&event=1" target="_blank"><?=$arrevent1['count1'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrevent1['count1'];?></td>
<?  } 

if($arrevent2['count2']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&event=2" target="_blank"><?=$arrevent2['count2'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrevent2['count2'];?></td>
<?  } 
if($arrevent3['count3']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&event=3" target="_blank"><?=$arrevent3['count3'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrevent3['count3'];?></td>
<?  } 

if($arrevent4['count4']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&event=4" target="_blank"><?=$arrevent4['count4'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrevent4['count4'];?></td>
<?  } 
if($arrevent5['count5']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&event=5"  target="_blank"><?=$arrevent5['count5'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrevent5['count5'];?></td>
<?  } 
if($arrevent6['count6']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&event=6" target="_blank"><?=$arrevent6['count6'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrevent6['count6'];?></td>
<?  } 
if($arrevent7['count7']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&event=7" target="_blank"><?=$arrevent7['count7'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrevent7['count7'];?></td>
<?  } 
if($arrevent8['count8']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&event=8" target="_blank"><?=$arrevent8['count8'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrevent8['count8'];?></td>
<?  } ?>
<? 
$sumevent=$arrevent1['count1']+$arrevent2['count2']+$arrevent3['count3']+$arrevent4['count4']+$arrevent5['count5']+$arrevent6['count6']+$arrevent7['count7']+$arrevent8['count8'];
?>
    <td align="center" class="forntsarabun" bgcolor="#FF9966"><?=$sumevent;?></td>
    
<!----///////////////// �� �˵ء�ó� 1-8  ////////////////////////////////--->   
    
<? 
$sumrisk=0;
for($r=1;$r<=9;$r++){
	$risk="risk".$r;
$selectsql_risk1= "SELECT COUNT(*)as countrisk1 FROM    ncr  WHERE  nonconf_date like '$nonconf_date%' and   ($risk !=0 or $risk !='') ";
$result_risk1= mysql_query($selectsql_risk1); 
$arrrisk1  = mysql_fetch_array($result_risk1);
?> 
<? 
if($arrrisk1['countrisk1']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&risk=<?=$risk;?>" target="_blank"><?=$arrrisk1['countrisk1'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrrisk1['countrisk1'];?></td>
<?  
}
$sumrisk+=$arrrisk1['countrisk1'];
}
?> 
    <td align="center" class="forntsarabun" bgcolor="#FF9966"><?=$sumrisk;?></td>

    
<!----///////////////// �� ��Դ�ͧ��������§  ////////////////--->   
  
  <?
$sumpsg=0;
for($psg=1;$psg<=5;$psg++){
	
	if($psg==1){
	$valuepsg="pro_f";
	}elseif($psg==2){
	$valuepsg="pro_b";
	}elseif($psg==3){
	$valuepsg="pro_i";
	}elseif($psg==4){
	$valuepsg="pro_t";
	}elseif($psg==5){
	$valuepsg="pro_s";
	}
$selectsql_psg= "SELECT COUNT(*)as countpsg FROM    ncr  WHERE  nonconf_date like '$nonconf_date%' and  $valuepsg =1 ";
$result_psg= mysql_query($selectsql_psg); 
$arrpsg  = mysql_fetch_array($result_psg);

?>

<?
if($arrpsg['countpsg']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&psg=<?=$valuepsg;?>" target="_blank"><?=$arrpsg['countpsg'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrpsg['countpsg'];?></td>
<?  
}
$sumpsg+=$arrpsg['countpsg'];
}
?> 

  
    <td align="center" class="forntsarabun" bgcolor="#FF9966"><?=$sumpsg;?></td>
    
 <!----///////////////// �� FBIT  ////////////////////////////--->      
   <? 
   $all_sum=$sum1+$sumevent+$sumrisk+$sumpsg;
   ?> 
  <!--  <td align="center" class="forntsarabun"><?//=$all_sum;?> </td>-->
  </tr>
  <? 
  } // End for �.�. �֧ �.�.
  ?>
  
  
  
  
  <tr>
    <td align="center" class="forntsarabun">���</td>
    <? 
	$nonconf_date=substr($nonconf_date,0,4);
	$sum_ai=0; 
	for ($i='A'; $i<='I'; $i++) { 
	$selectsql = "SELECT COUNT(*)as count$i FROM ncr WHERE nonconf_date like '$nonconf_date%' and clinic ='$i' "; 
	$result1 = mysql_query($selectsql); 
	$numrow1=mysql_num_rows($result1); 
	$arr= mysql_fetch_array($result1);
	//echo $selectsql; 
	$sum_ai+=$arr['count'.$i];
	
	//if($arr['count'.$i]!=0){ 
	?> 
<!--    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?//=$nonconf_date;?>&risk=<?//=$arr[$n];?>&clinic=<?//=$i;?>" target="_blank"><?//=$arr['count'.$i];?></a></td> -->
	<? //}else{ ?> <td align="center" class="forntsarabun"><?=$arr['count'.$i];?></td>
     <? 
	// } 
	 
	 }
	 ?>
<td align="center" class="forntsarabun"  bgcolor="#FF9966"><?=$sum_ai;?></td>
   <!-- //////////////////////////////////////////////////////// ---> 
<? 
$selectsql_event1= "SELECT COUNT(*)as count1 FROM    ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic1_1 or topic1_2 or topic1_3 or topic1_4 or topic1_5 or  topic1_6 !=0  or topic1_7 !='' ) ";
$result_event1= mysql_query($selectsql_event1); 
$arrevent1  = mysql_fetch_array($result_event1);
 
$selectsql_event2= "SELECT COUNT(*)as count2 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic2_1 or topic2_2 or topic2_3 or topic2_4 or topic2_5   or topic2_6 !=0  or topic2_7 !='' ) ";
$result_event2= mysql_query($selectsql_event2); 
$arrevent2  = mysql_fetch_array($result_event2);

$selectsql_event3= "SELECT COUNT(*)as count3 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic3_1 or topic3_2 or topic3_3 !=0 or  topic3_4 !='' ) ";
$result_event3= mysql_query($selectsql_event3); 
$arrevent3  = mysql_fetch_array($result_event3);


$selectsql_event4= "SELECT COUNT(*)as count4 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic4_1 or topic4_2 or topic4_3 or topic4_4 or topic4_5 !=0 or  topic4_6 !='' ) ";
$result_event4= mysql_query($selectsql_event4); 
$arrevent4  = mysql_fetch_array($result_event4);

$selectsql_event5= "SELECT COUNT(*)as count5 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic5_1 or topic5_2 or topic5_3 or topic5_4 or topic5_5 or topic5_6 or topic5_7 or topic5_8 or topic5_9 or topic5_10  !=0 or  topic5_11 !='' ) ";
$result_event5= mysql_query($selectsql_event5); 
$arrevent5  = mysql_fetch_array($result_event5);

$selectsql_event6= "SELECT COUNT(*)as count6 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic6_1 or topic6_2 or topic6_3 or topic6_4   !=0  or  topic6_5 !='' ) ";
$result_event6= mysql_query($selectsql_event6); 
$arrevent6  = mysql_fetch_array($result_event6);

$selectsql_event7= "SELECT COUNT(*)as count7 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic7_1 or topic7_2 or topic7_3 or topic7_4 or topic7_5 or topic7_6 !=0 or  topic7_7 !='' ) ";
$result_event7= mysql_query($selectsql_event7); 
$arrevent7  = mysql_fetch_array($result_event7);

$selectsql_event8= "SELECT COUNT(*)as count8 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic8_1 or topic8_2 or topic8_3 or topic8_4 or topic8_5 or topic8_6 or topic8_7 or topic8_8 or topic8_9 or topic8_10  !=0 or  topic8_11 !='' ) ";
$result_event8= mysql_query($selectsql_event8); 
$arrevent8  = mysql_fetch_array($result_event8);


$sumevent=$arrevent1['count1']+$arrevent2['count2']+$arrevent3['count3']+$arrevent4['count4']+$arrevent5['count5']+$arrevent6['count6']+$arrevent7['count7']+$arrevent8['count8'];
	 ?>   
    <td align="center" class="forntsarabun"><?=$arrevent1['count1'];?></td>
    <td align="center" class="forntsarabun"><?=$arrevent2['count2'];?></td>
    <td align="center" class="forntsarabun"><?=$arrevent3['count3'];?></td>
    <td align="center" class="forntsarabun"><?=$arrevent4['count4'];?></td>
    <td align="center" class="forntsarabun"><?=$arrevent5['count5'];?></td>
    <td align="center" class="forntsarabun"><?=$arrevent6['count6'];?></td>
    <td align="center" class="forntsarabun"><?=$arrevent7['count7'];?></td>
    <td align="center" class="forntsarabun"><?=$arrevent8['count8'];?></td>
    <td align="center" class="forntsarabun"  bgcolor="#FF9966"><?=$sumevent;?></td>
<!-- //////////////////////////////////////////////////////// --->     
<? 
$sumrisk=0;
for($r=1;$r<=9;$r++){
$risk="risk".$r;
$selectsql_risk1= "SELECT COUNT(*)as countrisk1 FROM    ncr  WHERE  nonconf_date like '$nonconf_date%' and   ($risk !=0 or $risk !='') ";
$result_risk1= mysql_query($selectsql_risk1); 
$arrrisk1  = mysql_fetch_array($result_risk1);
?> 
<? 
//if($arrrisk1['countrisk1']!=0){
?>
    <!--<td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?//=$nonconf_date;?>&risk=<?//=$arr[$n];?>&clinic=<?//=$i;?>" target="_blank"><?//=$arrrisk1['countrisk1'];?></a></td>-->
<? //}else{ ?>
<td align="center" class="forntsarabun"><?=$arrrisk1['countrisk1'];?></td>
<?  
//}
$sumrisk+=$arrrisk1['countrisk1'];
}
?> 
<td align="center" class="forntsarabun"  bgcolor="#FF9966"><?=$sumrisk;?></td>

   <?
$sumpsg=0;
for($psg=1;$psg<=5;$psg++){
	
	if($psg==1){
	$valuepsg="pro_f";
	}elseif($psg==2){
	$valuepsg="pro_b";
	}elseif($psg==3){
	$valuepsg="pro_i";
	}elseif($psg==4){
	$valuepsg="pro_t";
	}elseif($psg==5){
	$valuepsg="pro_s";
	}
$selectsql_psg= "SELECT COUNT(*)as countpsg FROM  ncr  WHERE  nonconf_date like '$nonconf_date%' and  $valuepsg =1 ";
$result_psg= mysql_query($selectsql_psg); 
$arrpsg  = mysql_fetch_array($result_psg);
//echo $selectsql_psg;
?>

<?
//if($arrpsg['countpsg']!=0){
?>
<!--    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&risk=<?//=$arr[$n];?>&clinic=<?//=$i;?>" target="_blank"><?//=$arrpsg['countpsg'];?></a></td>-->
<? // }else{ ?>
<td align="center" class="forntsarabun"><?=$arrpsg['countpsg'];?></td>
<?  
//}
$sumpsg+=$arrpsg['countpsg'];
}
?> 
<td align="center" class="forntsarabun"  bgcolor="#FF9966"><?=$sumpsg;?></td>
<!--<td align="center" class="forntsarabun"><?//=$sum_ai+$sumrisk+$sumevent+$sumpsg;?></td>-->
  </tr>



</table>

<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>