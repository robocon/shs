<?php
session_start();
include("connect.inc");

if( empty($_SESSION["statusncr"]) ){
	echo "Session ������� ��س���ͤ�Թ�ա�������������ҹ";
	exit;
}

// Set time to print only admin
if($_SESSION["statusncr"]=='admin' && $_SESSION['Userncr'] == 'admin' ){
	$print_by = $_SESSION['Namencr'];
	$sql = "UPDATE `ncr2556` 
	SET `date_print` = NOW(), 
	`print_by` = '$print_by'
	WHERE `nonconf_id` = '".$_GET['ncr_id']."';";
	$query = mysql_query($sql) or die( mysql_error($Conn) );
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<style>
.fonth1{
	font-family:"TH SarabunPSK";
	font-size:18px;
}
.fonth3{
	font-family:"TH SarabunPSK";
	font-size:16px;
}
.fonttable{
	font-family:"TH SarabunPSK";
	font-size:14px;
}
.line{
	text-indent:10px;
}
checkbox-style:disabled { }
	
</style>
<body onload="window.print();">
<?


$sql="SELECT * FROM `ncr2556` WHERE nonconf_id='".$_GET['ncr_id']."' ";
$query=mysql_query($sql);
$arr_show=mysql_fetch_array($query);

	$sql2="SELECT * FROM `departments` WHERE  code ='".$arr_show['until']."' ";
	$query2=mysql_query($sql2);
	$arr_until=mysql_fetch_array($query2);
	
	$sql3="SELECT * FROM `departments` WHERE  code  ='".$arr_show['come_from_detail']."' ";
	$query3=mysql_query($sql3);
	$arr_detail=mysql_fetch_array($query3);
	
	function displaydate($datex) {
	$date_array=explode("-",$datex);
	$y=$date_array[0];
	$m=$date_array[1];
	$d=$date_array[2];
	$displaydate="$d-$m-$y";
	return $displaydate;
}
?>
<div align="center">
<h1 class="fonth1">���§ҹ�˵ء�ó��Ӥѭ / �غѵԡ�ó� / ��������ʹ���ͧ ( Non-Conforming Report)</h1>
<h3 class="fonth3">�ٹ��Ѳ�Ҥس�Ҿ  �͡��������Ţ FR-QMR-009/1 ,06, 3 �.�.56</h3>
</div>

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="fonttable" style="border-collapse:collapse;">
  <tr>
	<td width="33%" valign="top">�Ţ��� NCR : 
	  <?=$arr_show['ncr']?>
	  <br />
	˹��§ҹ /���

	  <?=$arr_until['name']?><br />
	�ѹ���  : <?=displaydate($arr_show['nonconf_date']);?> ���� <?=$arr_show['nonconf_time']?>
	</td>
	<td colspan="2" valign="top"><table border="0">
	  <tr>
		<td width="33">�����</td>
		<td width="105"><input type="checkbox"  name="come_from_id" id="come_from_id"  <?php if($arr_show["come_from_id"] == "1") echo " Checked ";?> disabled/>ENV ROUND</td>
		<td width="275"><input type="checkbox" id="checkbox-1-6" <?php if($arr_show["come_from_id"] == "4") echo " Checked ";?> disabled/>
		  12 �Ԩ�������ǹ</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td><input type="checkbox" id="checkbox-1-2" <?php if($arr_show["come_from_id"] == "2") echo " Checked ";?> disabled/>
		  IC ROUND</td>
		<td><input type="checkbox" id="checkbox-1-5" <?php if($arr_show["come_from_id"] == "5") echo " Checked ";?> disabled/>
		  ˹�����§ҹ�ͧ</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td><input type="checkbox" id="checkbox-1-3" <?php if($arr_show["come_from_id"] == "3") echo " Checked ";?> disabled/>
		  RM ROUND</td>
		<td><input type="checkbox" id="checkbox-1-4" <?php if($arr_show["come_from_id"] == "6") echo " Checked ";?> disabled/>  
		  &nbsp;����  <?=$arr_detail["name"]?></td>
	  </tr>
	</table></td>
  </tr>
  <tr>
	<td colspan="3">�˵ء�ó� (��������ͧ���¶١㹪�ͧ�����������ء��ͷ���Դ�������͸Ժ���˵ء�ó����Դ��� )</td>
  </tr>
  <tr>
	<td colspan="2"><table width="100%" border="0">
	  <tr>
		<td width="50%"><strong><u>**Sentinel Event**</u></strong></td>
		<td width="50%">&nbsp;</td>
		</tr>
	  <tr>
		<td width="50%" valign="top"><div><input type="checkbox"  name="event1" id="event1"  <?php if($arr_show["event"] == "1") echo " Checked ";?> disabled/>
		  1. ���������ª��Ե�ҡ��æ�ҵ�ǵ��
		 </div>
		 <div>  <input type="checkbox"  name="event2" id="event2"  <?php if($arr_show["event"] == "2") echo " Checked ";?> disabled/>
		  2.������ª��Ե�ҡ���������ʹ�Դ���� �Դ��</div>
		  <div><input type="checkbox"  name="event3" id="event3"  <?php if($arr_show["event"] == "3") echo " Checked ";?> disabled/>
		  3.���������ª��Ե����������ǡѺ��ô��Թ�ͧ�ä���͡���纻���㹢�й�� </div>
		  <div>
		  <input type="checkbox"  name="event4" id="event4"  <?php if($arr_show["event"] == "4") echo " Checked ";?> disabled/>
		  4.��ü�ҵѴ�Դ���˹�/�Դ������/��ҵѴ�Դ�� </div>
		  <div>
		  <input type="checkbox"  name="event5" id="event5"  <?php if($arr_show["event"] == "5") echo " Checked ";?> disabled/>
		  5.�������٭����˹�ҷ���÷ӧҹ�ͧ��ҧ��������շؾ��Ҿ���ҧ�������������Ǣ�ͧ�Ѻ��ô��Թ�ͧ�ä���͡���纻���㹢�й�� </div></td>
		<td width="50%" valign="top" class="line1"><div>
		  <input type="checkbox"  name="event6" id="event6"  <?php if($arr_show["event"] == "6") echo " Checked ";?> disabled/>
		  6.���������Ѻ�š�з����ͤ�����������Ҩ�֧�ԡ���������ª��Ե �ѹ���˵ؤ��������ͧ�ͧ�ػ�ó�/����ͧ��ͷҧ���ᾷ�� ����֧�ҡ�ؤ�ҡ÷ҧ���ᾷ��/��кǹ����ѡ����ç��Һ�� 
		 </div>
		  <div><input type="checkbox"  name="event7" id="event7"  <?php if($arr_show["event"] == "7") echo " Checked ";?> disabled/>
		  7.�������觢ͧ/�ػ�ó쵡��ҧ�������ҧ��¼�����<br />
		  </div>
		  <div><input type="checkbox"  name="event8" id="event8"  <?php if($arr_show["event"] == "8") echo " Checked ";?> disabled/>
		  8.��÷�������ҧ���/����׹������ǧ�Թ�ҧ��/�ҵ������ç��Һ��<br />
		  </div>
		  <div><input type="checkbox"  name="event9" id="event9"  <?php if($arr_show["event"] == "9") echo " Checked ";?> disabled/>
		  9.����ѡ�ҵ�Ƿ�á/������ͺ��á�Դ��ͺ����</div></td>
	  </tr>
	</table></td>
	<td width="32%" align="center"><strong>��§ҹ��ǹ���� 6 �������<br />
��.þ�����, ����Ѵ��ä�������§</strong></td>
  </tr>
  <tr>
	<td valign="top" width="33%"><p><b>1. ������ʹ��� / ��/ ˡ���</b><br />
	  <input type="checkbox" name="topic1_1" value="1" <?php if($arr_show["topic1_1"] == "1") echo " Checked ";?> disabled />
	  1. ���<br />
  <input type="checkbox" name="topic1_2" value="1" <?php if($arr_show["topic1_2"] == "1") echo " Checked ";?> disabled />
	  2. ����ҹ͹���躹���<br />
  <input type="checkbox" name="topic1_3" value="1" <?php if($arr_show["topic1_3"] == "1") echo " Checked ";?> disabled />
	  3. ���ҡ��§/������/���<br />
  <input type="checkbox" name="topic1_4" value="1" <?php if($arr_show["topic1_4"] == "1") echo " Checked ";?> disabled />
	  4. ����ͧ�Ѵ��֧��ش<br />
  <input type="checkbox" name="topic1_5" value="1" <?php if($arr_show["topic1_5"] == "1") echo " Checked ";?> disabled />
	  5. �չ�����������§<br />
  <input type="checkbox" name="topic1_6" value="1" <?php if($arr_show["topic1_6"] == "1") echo " Checked ";?> disabled/>
	  6. ��Ѵ�������ҧ�������͹����<br /><?=$arr_show["topic1_7"];?>
	</p>
	  <p><b>2. ��õԴ����������</b><br />
		<input type="checkbox" name="topic2_1" value="1" <?php if($arr_show["topic2_1"] == "1") echo " Checked ";?> disabled/>
1. �������§ҹ�� Lab/Film X-ray ��ǹ<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���� �Դ����<br />
<input type="checkbox" name="topic2_2" value="1" <?php if($arr_show["topic2_2"] == "1") echo " Checked ";?> disabled/>
2. �������§ҹᾷ��/ᾷ�����ͺ<br />
<input type="checkbox" name="topic2_3" value="1" <?php if($arr_show["topic2_3"] == "1") echo " Checked ";?> disabled/>
3. ��Ժѵ����١��ͧ��������<br />
<input type="checkbox" name="topic2_4" value="1" <?php if($arr_show["topic2_4"] == "1") echo " Checked ";?> disabled/>
4. �Ǫ����¹�������ó�<br />
<input type="checkbox" name="topic2_5" value="1" <?php if($arr_show["topic2_5"] == "1") echo " Checked ";?> disabled/>
5. ��Թ������ç�Ѻ�ѵ����<br />
<input type="checkbox" name="topic2_6" value="1" <?php if($arr_show["topic2_6"] == "1") echo " Checked ";?> disabled/>
6. ���ѵ�������������Թ���<br />
<?=$arr_show["topic2_7"];?>
	  </p>
	  <p><b>3. ���ʹ</b><br />
		<input type="checkbox" name="topic3_1" value="1" <?php if($arr_show["topic3_1"] == "1") echo " Checked ";?> disabled/>
1. �Դ��<br />
<input type="checkbox" name="topic3_2" value="1" <?php if($arr_show["topic3_2"] == "1") echo " Checked ";?> disabled/>
2. �����á��͹�ҡ���������ʹ<br />
<input type="checkbox" name="topic3_3" value="1" <?php if($arr_show["topic3_3"] == "1") echo " Checked ";?>disabled />
3. �����ʹ<br />
<?=$arr_show["topic3_4"];?>
	  </p></td>
	<td valign="top" width=""><p><b>4. ����ͧ���</b><br />
	  <input type="checkbox" name="topic4_1" value="1" <?php if($arr_show["topic4_1"] == "1") echo " Checked ";?> disabled/>
	  1.�����¶١�ǡ / ����<br />
  <input type="checkbox" name="topic4_2" value="1" <?php if($arr_show["topic4_2"] == "1") echo " Checked ";?> disabled/>
	  2.����������<br />
  <input type="checkbox" name="topic4_3" value="1" <?php if($arr_show["topic4_3"] == "1") echo " Checked ";?> disabled/>
	  3.���ӧҹ / �ӧҹ�Դ����<br />
  <input type="checkbox" name="topic4_4" value="1" <?php if($arr_show["topic4_4"] == "1") echo " Checked ";?> disabled/>
	  4.���������ͧ��� ��<br />
  <input type="checkbox" name="topic4_5" value="1" <?php if($arr_show["topic4_5"] == "1") echo " Checked ";?> disabled/>
	  5.�Կ�����ӧҹ<br />
	  <?=$arr_show["topic4_6"];?>
	</p>
	  <p><b>5. ����ԹԨ��� / �ѡ��</b><br />
		<input type="checkbox" name="topic5_1" value="1" <?php if($arr_show["topic5_1"] == "1") echo " Checked ";?> disabled/>
1. �Ѻ Admit ������ä����  7 �ѹ<br />
<input type="checkbox" name="topic5_2" value="1" <?php if($arr_show["topic5_2"] == "1") echo " Checked ";?> disabled/>
2. �������ö�ԹԨ����ä����ͧ admit  ������ ER ���<br />
<input type="checkbox" name="topic5_3" value="1" <?php if($arr_show["topic5_3"] == "1") echo " Checked ";?> disabled/>
3. ��ҹ����硫�����Դ<br />
<input type="checkbox" name="topic5_4" value="1" <?php if($arr_show["topic5_4"] == "1") echo " Checked ";?> disabled/>
4. ��Ҫ��㹡���ѡ�Ҽ����·���شŧ<br />
<input type="checkbox" name="topic5_5" value="1" <?php if($arr_show["topic5_5"] == "1") echo " Checked ";?> disabled/>
5. �����á��͹�ҡ�ѵ����<br />
<input type="checkbox" name="topic5_6" value="1" <?php if($arr_show["topic5_6"] == "1") echo " Checked ";?> disabled/>
6. �� Diag  Proc ����������Ἱ<br />
<input type="checkbox" name="topic5_7" value="1" <?php if($arr_show["topic5_7"] == "1") echo " Checked ";?> disabled/>
7. ���������ѧ�����§��<br />
<input type="checkbox" name="topic5_8" value="1" <?php if($arr_show["topic5_8"] == "1") echo " Checked ";?> disabled/>
8. ��� Cath / Tube / Drain ���١<br />
<input type="checkbox" name="topic5_9" value="1" <?php if($arr_show["topic5_9"] == "1") echo " Checked ";?> disabled/>
9. ���� Cath / Tube / Drain <br />
<input type="checkbox" name="topic5_10" value="1" <?php if($arr_show["topic5_10"] == "1") echo " Checked ";?> disabled/>
10. ���¼�������� ICU �������Ἱ<br />
<?=$arr_show["topic5_11"];?>
	  </p>
	  <p><b>6. ��ä�ʹ</b><br />
		<input type="checkbox" name="topic6_1" value="1" <?php if($arr_show["topic6_1"] == "1") echo " Checked ";?> disabled/>
1. ��辺 Fetal distress �ѹ��ǧ��<br />
<input type="checkbox" name="topic6_2" value="1" <?php if($arr_show["topic6_2"] == "1") echo " Checked ";?>disabled />
2. ��ҵѴ��ʹ����Թ�<br />
<input type="checkbox" name="topic6_3" value="1" <?php if($arr_show["topic6_3"] == "1") echo " Checked ";?> disabled/>
3. �����á��͹�ҡ��ä�ʹ<br />
<input type="checkbox" name="topic6_4" value="1" <?php if($arr_show["topic6_4"] == "1") echo " Checked ";?> disabled/>
4. �Ҵ�纨ҡ��ä�ʹ<br />
<?=$arr_show["topic6_5"];?>
	  </p></td>
	<td valign="top"><p><b>7. ��ü�ҵѴ / ���ѭ��</b><br />
	  <input type="checkbox" name="topic7_1" value="1" <?php if($arr_show["topic7_1"] == "1") echo " Checked ";?> disabled/>
	  1. �����á��͹�ҧ���ѭ��<br />
  <input type="checkbox" name="topic7_2" value="1" <?php if($arr_show["topic7_2"] == "1") echo " Checked ";?> disabled/>
	  2. ��ҵѴ�Դ�� / �Դ��ҧ / �Դ���˹�<br />
  <input type="checkbox" name="topic7_3" value="1" <?php if($arr_show["topic7_3"] == "1") echo " Checked ";?> disabled/>
	  3. �Ѵ�������͡��������ҧἹ<br />
  <input type="checkbox" name="topic7_4" value="1" <?php if($arr_show["topic7_4"] == "1") echo " Checked ";?> disabled/>
	  4. ��纫��������з��Ҵ��<br />
  <input type="checkbox" name="topic7_5" value="1" <?php if($arr_show["topic7_5"] == "1") echo " Checked ";?>disabled />
	  5. �������ͧ��� / ���� ���㹼�����<br />
  <input type="checkbox" name="topic7_6" value="1" <?php if($arr_show["topic7_6"] == "1") echo " Checked ";?> disabled/>
	  6. ��Ѻ�Ҽ�ҵѴ���<br /><?=$arr_show["topic7_7"];?>
	</p>
	  <b>8. ��� �</b><br />
	  <input type="checkbox" name="topic8_1" value="1" <?php if($arr_show["topic8_1"] == "1") echo " Checked ";?> disabled/>
1. ������ / �ҵ� ���֧���<br />
<input type="checkbox" name="topic8_2" value="1" <?php if($arr_show["topic8_2"] == "1") echo " Checked ";?>disabled />
2. �����Ѥ������ þ.<br />
<input type="checkbox" name="topic8_3" value="1" <?php if($arr_show["topic8_3"] == "1") echo " Checked ";?>disabled />
3. �ա�÷�������ҧ��� ������ /�ҵ� /���˹�ҷ��<br />
<input type="checkbox" name="topic8_4" value="1" <?php if($arr_show["topic8_4"] == "1") echo " Checked ";?> disabled/>
4. �����¾�������ҵ�ǵ�� /��������ҧ��µ���ͧ<br />
<input type="checkbox" name="topic8_5" value="1" <?php if($arr_show["topic8_5"] == "1") echo " Checked ";?> disabled/>
5. �á���/�ѡ����<br />
<input type="checkbox" name="topic8_6" value="1" <?php if($arr_show["topic8_6"] == "1") echo " Checked ";?>disabled />
6. ��äء���/ ������<br />
<input type="checkbox" name="topic8_7" value="1" <?php if($arr_show["topic8_7"] == "1") echo " Checked ";?> disabled/>
7. ����Ǵ�������ѹ����/�����͹<br />
<input type="checkbox" name="topic8_8" value="1" <?php if($arr_show["topic8_8"] == "1") echo " Checked ";?>disabled />
8. �غѵ��˵������<br />
<input type="checkbox" name="topic8_9" value="1" <?php if($arr_show["topic8_9"] == "1") echo " Checked ";?>disabled />
9. ���. �Ҵ�纨ҡ��÷ӧҹ <br />
<input type="checkbox" name="topic8_10" value="1" <?php if($arr_show["topic8_10"] == "1") echo " Checked ";?>disabled />
10. ��������¡�纤�������<br /><?=$arr_show["topic8_11"];?></td>
  </tr>
</table>

<div style="page-break-after:always;"></div>

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="fonttable" style="border-collapse:collapse;">
  <tr>
	<td colspan="3"><strong>��������ػ�˵ء�ó�</strong></td>
  </tr>
  <tr>
	<td colspan="3" class="line"><?=$arr_show['sum_up'];?></td>
  </tr>
  <tr>
	<td colspan="3">&nbsp;</td>
  </tr>
  <tr>
	<td colspan="3"><strong>�����ع�ç</strong></td>
  </tr>
  <tr>
	<td width="78%"><input type="radio" name="clinic"   id="clinic1" value="A" <?php if($arr_show["clinic"] == "A") echo " Checked ";?> disabled/>
  A ���˵ء�ó������͡�ʷ��������Դ������Ҵ����͹ �����Ҩ�Դ����˹��§ҹ ���ѧ����Դ<br />
<input type="radio" name="clinic"  id="clinic2"  value="B" <?php if($arr_show["clinic"] == "B") echo " Checked ";?>disabled />
B  �Դ������Ҵ����͹��� ������֧������/þ./���˹�ҷ�� ����ѧ����դ�����������</td>
	<td width="10%" align="center" valign="top">�дѺ 1<br />
	  ��ͺ��Ҵ      <br /></td>
	<td width="12%" rowspan="3" align="center"><strong>����§ҹ�ٹ��Ѳ�Ҥس�Ҿ</strong></td>
  </tr>
  <tr>
	<td><input type="radio" name="clinic" id="clinic3"  value="C" <?php if($arr_show["clinic"] == "C") echo " Checked ";?> disabled/>
C  �Դ������Ҵ����͹�Ѻ������ /þ./���˹�ҷ�� ��������Ѻ�ѹ�����������������ª������§ ��Ѿ���Թ���������硹��� ��Ť������Թ 2,000 �ҷ</td>
	<td align="center">�дѺ 2<br />
	  ����</td>
  </tr>
  <tr>
	<td><input type="radio" name="clinic"  id="clinic4" value="D" <?php if($arr_show["clinic"] == "D") echo " Checked ";?> disabled/>
D  �Դ������Ҵ����͹�Ѻ������ /þ./���˹�ҷ�� ��觵�ͧ������ѧ / �Դ���������� �������§�Ҿ����������� �Դ�����������ҧ㨨ҡ��������Ф�������дǡ����Ѻ��ԡ�� ��Ѿ���Թ���������硹�����Ť�� 2,000 -5,000 �ҷ<br />
  <input type="radio" name="clinic"  id="clinic5" value="E" <?php if($arr_show["clinic"] == "E") echo " Checked ";?> disabled/>
E  �Դ������Ҵ����͹�Ѻ������ /þ./���˹�ҷ�� �觼�����Դ�ѹ���ª��Ǥ�����е�ͧ�ա�úӺѴ�ѡ�� �Դ�����������ҧ� �ҡ����ѷ��Сѹ /˹��§ҹ�ͧ�Ѱ ��Ѿ���Թ��������ҡ���� 5,000 - 15,000 �ҷ <br />
  <input type="radio" name="clinic"  id="clinic6" value="F" <?php if($arr_show["clinic"] == "F") echo " Checked ";?> disabled/>
F  �Դ������Ҵ����͹�Ѻ������ /þ./���˹�ҷ�� �觼�����Դ�ѹ���ª��Ǥ��� ��е�ͧ�͹�ç��Һ�����������ç��Һ�Źҹ��� �Դ�����������ҧ㨨ҡ����ѷ��Сѹ / ˹��§ҹ�ͧ�Ѱ ��ͧ��ش�ҹ�ҡ���� 3 �ѹ ��Ѿ���Թ��������ҡ���� 15,000 �ҷ������Թ 30,000 �ҷ</td>
	<td align="center">�дѺ 3 <br />
	  �ҹ��ҧ</td>
  </tr>
  <tr>
	<td><input type="radio" name="clinic"  id="clinic7" value="G" <?php if($arr_show["clinic"] == "G") echo " Checked ";?> disabled/>
G  �Դ������Ҵ����͹�Ѻ������ /þ./���˹�ҷ�� �觼�����Դ�ѹ���¶��� ��Ѿ���Թ������� ����Ť���ҡ���� 30,000 �ҷ ������Թ 50,000 �ҷ �������§�Ҿ����������»�ҡ�������Ҹ�ó�<br />
<input type="radio" name="clinic"  id="clinic8" value="H" <?php if($arr_show["clinic"] == "H") echo " Checked ";?> disabled/>
H  �Դ������Ҵ����͹�Ѻ������  /þ./���˹�ҷ�� �觼�����ͧ�ӡ�ê��ª��Ե ��úҴ��/�纻��¨ҡ�ҹ��дѺ�ع�ç ��Ѿ���Թ������� ����Ť���ҡ���� 50,000 ������Թ 100,000 �ҷ �������§�Ҿ����������»�ҡ�������Ҹ�ó�<br />
<input type="radio" name="clinic" id="clinic9"  value="I" <?php if($arr_show["clinic"] == "I") echo " Checked ";?> disabled/>
I   �Դ������Ҵ����͹�Ѻ������   /þ./���˹�ҷ��  ��������˵آͧ������ª��Ե ��Ѿ���Թ������� ����Ť���ҡ���� 100,000 �ҷ �������§�Ҿ����������»�ҡ�������Ҹ�ó�/�١��ͧ��ͧ���ͧ����ԪҪվ</td>
	<td align="center">�дѺ 4 <br />
	  �ҡ</td>
	<td align="center">��§ҹ��ǹ���� 6 �������<br />
��.þ�����, ����Ѵ���<br />
��������§</td>
  </tr>
  <tr>
	<td colspan="3"><strong>�ѭ�ҷ�辺 /���˵�</strong></td>
  </tr>
  <tr>
	<td colspan="3" class="line"><span class="line1">
	  <?=$arr_show['problem'];?>
	</span></td>
  </tr>
  <tr>
	<td colspan="3" class="line">&nbsp;</td>
  </tr>
  <tr>
	<td colspan="3"><strong>�ҵá����䢷������Թ�������� / �ҵá�û�ͧ�ѹ</strong></td>
  </tr>
  <tr>
	<td colspan="3" class="line"><span class="line1">
	  <?=$arr_show['protect'];?>
	</span></td>
  </tr>
   <tr>
	<td colspan="3" class="line">&nbsp;</td>
  </tr>
  <tr>
	<td colspan="3">ŧ���� <span class="line1">
	  <?=$arr_show['head_name'];?>
	</span> ���˹��˹��§ҹ</td>
  </tr>
  <? if($_SESSION["statusncr"]=='admin'){ ?>
  <tr>
	<td colspan="3"><strong>���¤س�Ҿ </strong></td>
  </tr>
  <tr>
	<td colspan="3"><input name="quality" type="radio" id="quality1"  value="1"  <?php if($arr_show["quality"] == "1") echo " Checked ";?> disabled/>
	  �Ң������������
	  <input name="quality" type="radio" id="quality2" value="2"  <?php if($arr_show["quality"] == "2") echo " Checked ";?> disabled/>
	  �Դ����������ͧ��������ʹ���ͧ
  <input name="quality" type="radio" id="quality3"  value="3" <?php if($arr_show["quality"] == "3") echo " Checked ";?> disabled/>
	  �͡ CAR / PAR �Ţ���
	  
  <?=$arr_show['cpno'];?>
</td>
  </tr>
  <tr>
	<td colspan="3"><strong>��Դ�ͧ��������§</strong></td>
  </tr>
  <tr>
	<td colspan="3"><table border="0">
	  <tr>
		<td><input name="risk1" type="checkbox" id="risk1" value="1"  <?php if($arr_show["risk1"] == "1") echo " Checked ";?> disabled/>
		  1.Clinical Risk </td>
		<td><input name="risk6" type="checkbox" id="risk6" value="6" <?php if($arr_show["risk6"] == "1") echo " Checked ";?> disabled/>
		  6.Customer Complaint Risk </td>
		</tr>
	  <tr>
		<td><input name="risk2" type="checkbox" id="risk2" value="2"  <?php if($arr_show["risk2"] == "1") echo " Checked ";?> disabled/>
		  2.Infection control Risk </td>
		<td><input name="risk7" type="checkbox" id="risk7" value="7" <?php if($arr_show["risk7"] == "1") echo " Checked ";?> disabled/>
		  7.Financial Risk </td>
		</tr>
	  <tr>
		<td><input name="risk3" type="checkbox" id="risk3" value="3" <?php if($arr_show["risk3"] == "1") echo " Checked ";?> disabled/>
		  3.Medication Risk </td>
		<td><input name="risk8" type="checkbox" id="risk8" value="8" <?php if($arr_show["risk8"] == "1") echo " Checked ";?> disabled/>
		  8.Utilization Management Risk </td>
		</tr>
	  <tr>
		<td><input name="risk4" type="checkbox" id="risk4" value="4" <?php if($arr_show["risk4"] == "1") echo " Checked ";?> disabled/>
		  4.Medical Equipment Risk </td>
		<td><input name="risk9" type="checkbox" id="risk9" value="9"  <?php if($arr_show["risk9"] == "1") echo " Checked ";?> disabled/>
		  9.Information Risk</td>
		</tr>
	  <tr>
		<td><input name="risk5" type="checkbox" id="risk5" value="5" <?php if($arr_show["risk5"] == "1") echo " Checked ";?> disabled/>
		  5.Safety and Environment Risk </td>
		<td>&nbsp;</td>
		</tr>
		<? } ?>
	</table></td>
  </tr>
</table>


</body>
</html>