<?php
session_start();

include("connect.inc");


function displaydate($datex) {
	$date_array=explode("-",$datex);
	$y=$date_array[0];
	$m=$date_array[1];
	$d=$date_array[2];
	$displaydate="$d-$m-$y";
	return $displaydate;
}



?>
<html>
<head>
<title>Ẻ��§ҹ�ä�����</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}


</style>
<SCRIPT LANGUAGE="JavaScript">

	window.onload = function(){
		window.print();
		window.close();
	}

</SCRIPT>
</head>
<body>
<p><!--<TABLE align="center" width="400"  border="1" bordercolor="#3366FF">
<TR>
	<TD align="center">-->
  <?php
Function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}


$str="select yot,name,surname,idcard, date_format(dbirth,'%d-%m-%Y'), concat(address,' ', tambol,' ', ampur,' ', changwat) as address, nation, religion, sex, married, dbirth from opcard where hn='".$_GET["hn"]."'";

$strresult = mysql_query($str) or die(mysql_error());
$strarr = mysql_fetch_array($strresult);
$name1=$strarr['yot'].' '.$strarr['name'];
$name2=$strarr['surname'];

$pAge = calcage($strarr['dbirth']);


/////////////////////////
$sql = "Select hn, id, date_diag, lab_name, lab_no, diag_type1, diag_type2, diag_type3, diag_type4, diag_type5, diag_type6, diag_type7, diag_type8, diag_type9, position, lab_detail, stage, a, b, cure_surgery, cure_radiation, cure_chemotherapy,cure_targeted, cure_hormone, cure_intervention,cure_immuno, cure_other, cure_support, status, last_update, dead ,register_date,officer,date1,date2,date3,date4,date5,date6,date7,date8,date9,grade,side From cancer Where hn = '".$_GET["hn"]."' limit 1 ";
		$result = Mysql_Query($sql) or die(mysql_error());
		$arr_edit = Mysql_fetch_assoc($result);
?>
<p>&nbsp; </p>
<div class="forntsarabun"  align="center"><u>Ẻ��§ҹ�ä����� (Cancer Report Form)<br>�ٹ��������ӻҧ</u></div>
<div class="forntsarabun"  align="right"><u>�Ţ����¹�����......................</u></div>

<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse"  bordercolor="#333333" >
  <tr>
    <td colspan="2" bgcolor="#CCCCCC" class="forntsarabun">���觢�����</td>
  </tr>
  <tr>
    <td width="40%"  class="fornttable1">�����ç��Һ�ŷ����§ҹ&nbsp;&nbsp;&nbsp;<div align="center" class="forntb">&nbsp;�ç��Һ�Ť�������ѡ��������</div></td>
    <td width="60%" class="fornttable1">�Ţ����¹������ (HN)
    <div align="center" class="forntb"><?=$_GET["hn"];?></div></td>
  </tr>
</table>
<br>
<table width="100%"  border="1" cellpadding="0" cellspacing="0"  bordercolor="#333333" style="border-collapse:collapse" >
  <tr>
    <td colspan="6" bgcolor="#CCCCCC" class="forntsarabun">�����ż����� (Patient Information)</td>
  </tr>
  <tr>
    <td width="454" rowspan="2" valign="top"   style="line-height:1"><font class="fornttable1">1.���� (���/�ҧ/�.�./�.�./�.�.)</font>
    <div align="center" class="fornttable" >
      <?=$name1;?>
    </div></td>
    <td width="199" rowspan="2"  valign="top" ><font class="fornttable1">2.���ʡ��</font>
      <div align="center" class="fornttable">
        <?=$name2;?>
    </div></td>
    <td colspan="2" rowspan="2"  valign="top" ><font class="fornttable1">3.�Ţ��Шӵ�ǻ�ЪҪ�</font>
    <div align="center" class="fornttable">
      <?=$strarr["idcard"];?>
    </div></td>
    <td width="111" rowspan="2"  valign="top"><font class="fornttable1">4.��</font>
    <div align="center" class="fornttable">
    <? if($strarr["sex"]=='�'){ echo "���"; }elseif($strarr["sex"]=='�'){ echo "˭ԧ"; }?></div></td>
    <td width="133"  valign="top" ><font class="fornttable1">5.����(�����)</font>
    <div align="center" class="fornttable">
      <?=$pAge;?>
    </div></td>
  </tr>
  <tr>
    <td  valign="top" ><font class="fornttable1">6.�ѹ/��͹/��/�Դ</font>
    <div align="center" class="fornttable">
      <?=displaydate($strarr["dbirth"]);?>
    </div></td>
  </tr>
  <tr>
    <td colspan="2"  style="line-height:1"><font class="fornttable1">7.�������</font>
    <div class="fornttable">&nbsp;
      <?=$strarr["address"];?>
    </div>
    <div align="center">&nbsp;</div>
 
      <div align="center"><!--������ɳ��� [ ][ ][ ][ ][ ] ���ʷ������ [ ][ ][ ][ ][ ][ ]--></div></td>
    <td width="227"  valign="top"><font class="fornttable1"> 8.ʶҹ�Ҿ�������</font>
    <div align="center" class="fornttable"><?=$strarr["married"];?></div></td>
    <td colspan="2"  valign="top"><font class="fornttable1">9.���ͪҵ�</font>
      <div align="center" class="fornttable">
    <?=$strarr["nation"];?></div></td>
    <td  valign="top"><font class="fornttable1">10.��ʹ�</font>    
    <div align="center" class="fornttable"><?=$strarr["religion"];?></div></td>
  </tr>
</table>
<br>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse"  bordercolor="#333333" >
  <tr>
    <td colspan="4" bgcolor="#CCCCCC" class="forntsarabun">�������ä����� (Cancer Information)</td>
  </tr>
  <tr>
    <td width="21%" ><font class="fornttable1">11.�ѹ����Ҿ�ᾷ������á</font>
    <div align="center" class="fornttable"><?=displaydate($arr_edit["doctor_date"]);?></div></td>
    <td width="21%" ><font class="fornttable1">12.�ѹ����ԹԨ�������������</font>
    <div align="center" class="fornttable"><?=displaydate($arr_edit["date_diag"]);?></div></td>
    <td width="30%" ><font class="fornttable1">13.���� Lab</font>
    <div align="center" class="fornttable"><?=$arr_edit["lab_name"];?></div></td>
    <td width="28%"><font class="fornttable1">14.�Ţ��Ҹ�</font>
    <div align="center" class="fornttable"><?=$arr_edit["lab_no"];?></div></td>
  </tr>
  <tr>
    <td colspan="2" rowspan="3" valign="top"><font class="fornttable1">15.�Ը��ԹԨ����ä�����</font><br>
      <INPUT TYPE="checkbox" NAME="diag_type1" <?php if($arr_edit["diag_type1"] == "0 �óкѵ�") echo " Checked "; ?> value="0 �óкѵ�">
      <font class="fornttable">0 �óкѵ�</font><BR>
      <INPUT TYPE="checkbox" NAME="diag_type2" <?php if($arr_edit["diag_type2"] == "1 �ѡ����ѵ���е�Ǩ��ҧ���") echo " Checked "; ?>  value="1 �ѡ����ѵ���е�Ǩ��ҧ���">
     <font class="fornttable"> 1 �ѡ����ѵ���е�Ǩ��ҧ���</font><BR>
      <INPUT TYPE="checkbox" NAME="diag_type3" <?php if($arr_edit["diag_type3"] == "2 �ѧ���ԹԨ��� ��ͧ���ͧ Ultrasound") echo " Checked "; ?>  value="2 �ѧ���ԹԨ��� ��ͧ���ͧ Ultrasound">
      <font class="fornttable">2 �ѧ���ԹԨ��� ��ͧ���ͧ Ultrasound</font><BR>
      <INPUT TYPE="checkbox" NAME="diag_type4" <?php if($arr_edit["diag_type4"] == "3 ��ҵѴ ���� ���Ⱦ ������ռŪ������") echo " Checked "; ?>  value="3 ��ҵѴ ���� ���Ⱦ ������ռŪ������">
      <font class="fornttable">3 ��ҵѴ ���� ���Ⱦ ������ռŪ������</font><BR>
      <INPUT TYPE="checkbox" NAME="diag_type5" <?php if($arr_edit["diag_type5"] == "4 Specific Biochem / Immuno tests") echo " Checked "; ?>  value="4 Specific Biochem / Immuno tests">
      <font class="fornttable">4 Specific Biochem / Immuno tests</font><BR>
      <INPUT TYPE="checkbox" NAME="diag_type6" <?php if($arr_edit["diag_type6"] == "5 ��õ�Ǩ���� ���� ��õ�Ǩ���ʹ") echo " Checked "; ?>  value="5 ��õ�Ǩ���� ���� ��õ�Ǩ���ʹ">
      <font class="fornttable">5 ��õ�Ǩ���� ���� ��õ�Ǩ���ʹ</font><BR>
      <INPUT TYPE="checkbox" NAME="diag_type7" <?php if($arr_edit["diag_type7"] == "6 ��õ�Ǩ������ͷ���Ш��") echo " Checked "; ?>  value="6 ��õ�Ǩ������ͷ���Ш��">
      <font class="fornttable">6 ��õ�Ǩ������ͷ���Ш��</font><BR>
      <INPUT TYPE="checkbox" NAME="diag_type8" <?php if($arr_edit["diag_type8"] == "7 ��õ�Ǩ������ͧ͡�������") echo " Checked "; ?>  value="7 ��õ�Ǩ������ͧ͡�������">
      <font class="fornttable">7 ��õ�Ǩ������ͧ͡�������</font><BR>
      <INPUT TYPE="checkbox" NAME="diag_type9" <?php if($arr_edit["diag_type9"] == "8 ��ü��Ⱦ����ռŪ������") echo " Checked "; ?>  value="8 ��ü��Ⱦ����ռŪ������">
      <font class="fornttable">8 ��ü��Ⱦ����ռŪ������</font>      <br>
    </p></td>
    <td colspan="2" valign="top" ><font class="fornttable1">16.���˹�/�����з���������</font>
    <div align="center" class="fornttable"><?=$arr_edit["position"];?></div></td>
  </tr>
  <tr>
    <td height="122" colspan="2" valign="top" ><font class="fornttable1">17.�ŷҧ��Ҹ��Է��</font>
    <div align="center" class="fornttable"><?=$arr_edit["lab_detail"];?></div></td>
  </tr>
  <tr>
    <td height="42" valign="top"><font class="fornttable1">18.�ô</font>
    <div align="center" class="fornttable"><?=$arr_edit["grade"];?></div></td>
    <td valign="top"><font class="fornttable1">19.TNM</font>
    <div align="center" class="fornttable">T__N__M</div></td>
  </tr>
  <tr>
    <td valign="top"><font class="fornttable1">20.��ҧ</font>
    <div align="center" class="fornttable"><?=$arr_edit["side"];?></div></td>
    <td valign="top"><font class="fornttable1">21.���Тͧ�ä</font>
    <div align="center" class="fornttable"><?=$arr_edit["stage"];?></div></td>
    <td height="42" valign="top"><font class="fornttable1">22.�������è�¢ͧ�ä</font>
    <div align="center" class="fornttable"><?=$arr_edit["a"];?></div></td>
    <td valign="top"><font class="fornttable1">23.���˹觷������Ш��</font>
    <div align="center" class="fornttable"><?=$arr_edit["b"];?></div></td>
  </tr>
  <tr>
    <td colspan="2" rowspan="3" valign="top"><div align="center">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="45%"><font class="fornttable1">24.����ѡ��</font></td>
          <td width="25%" align="center" valign="top">&nbsp;</td>
          <td width="30%" align="center" valign="top"><font class="fornttable1">�ѹ���������ѡ��</font></td>
        </tr>
        <tr class="fornttable">
          <td>Surgery</td>
          <td align="center" valign="top"><?=$arr_edit["cure_surgery"];?></td>
          <td align="center" valign="top"><?=displaydate($arr_edit["date1"]);?></td>
        </tr>
        <tr class="fornttable">
          <td>Radiotherapy</td>
          <td align="center" valign="top"><?=$arr_edit["cure_radiation"];?></td>
          <td align="center" valign="top"><?=displaydate($arr_edit["date2"]);?></td>
        </tr>
        <tr class="fornttable">
          <td>Chemotherapy</td>
         <td align="center" valign="top"><?=$arr_edit["cure_chemotherapy"];?></td>
          <td align="center" valign="top"><?=displaydate($arr_edit["date3"]);?></td>
        </tr>
        <tr class="fornttable">
          <td>Targeted therapy</td>
        <td align="center" valign="top"><?=$arr_edit["cure_targeted"];?></td>
          <td align="center" valign="top"><?=displaydate($arr_edit["date4"]);?></td>
        </tr>
        <tr class="fornttable">
          <td>Hormone therapy</td>
		  <td align="center" valign="top"><?=$arr_edit["cure_hormone"];?></td>
          <td align="center" valign="top"><?=displaydate($arr_edit["date5"]);?></td>
        </tr>
        <tr class="fornttable">
          <td>Immunotherapy</td>
		  <td align="center" valign="top"><?=$arr_edit["cure_immuno"];?></td>
          <td align="center" valign="top"><?=displaydate($arr_edit["date6"]);?></td>
        </tr>
        <tr class="fornttable">
          <td>Intervention treatment</td>
		  <td align="center" valign="top"><?=$arr_edit["cure_intervention"];?></td>
          <td align="center" valign="top"><?=displaydate($arr_edit["date7"]);?></td>        </tr>
        <tr class="fornttable">
          <td>Other treatment</td>
		  <td align="center" valign="top"><?=$arr_edit["cure_other"];?></td>
          <td align="center" valign="top"><?=displaydate($arr_edit["date8"]);?></td>
        </tr>
        <tr class="fornttable">
          <td>Support treatment</td>
		  <td align="center" valign="top"><?=$arr_edit["cure_support"];?></td>
          <td align="center" valign="top"><?=displaydate($arr_edit["date9"]);?></td>        </tr>
      </table>
    </div>      <div align="center"></div></td>
    <td height="42" valign="top"><font class="fornttable1">25.��Ҿ�Ѩ�غѹ</font>
    <div align="center" class="fornttable"><?=$arr_edit["status"];?></div></td>
    <td valign="top"><font class="fornttable1">26.�ѹ���Դ�������ش / �ѹ�����������ª��Ե</font>
    <div align="center" class="fornttable"><?=displaydate($arr_edit["last_update"]);?></div></td>
  </tr>
  <tr>
    <td rowspan="2" valign="top"><font class="fornttable1">27.���˵ء�õ��</font>
    <div align="center" class="fornttable"><?=$arr_edit["dead"];?></div></td>
    <td height="42" valign="top"><font class="fornttable1">28.�ѹ������Ǻ���������</font>
    <div align="center" class="fornttable"><?=displaydate($arr_edit["register_date"]);?></div></td>
  </tr>
  <tr>
    <td height="42" valign="top"><font class="fornttable1">29.����Ǻ���������</font>
      <div align="center" class="fornttable">
        <?=$arr_edit["officer"];?>
    </div></td>
  </tr>
</table>
<?php include("unconnect.inc");?>
</body>
</html>
