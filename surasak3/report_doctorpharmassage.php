<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}

.style1 {
	font-size: 20px;
	font-weight: bold;
}
.style2 {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<?php
 include("connect.inc");  
?> 
<p align="center" class="style1">��§ҹ�������Ңͧᾷ��Ἱ��</p>

<form action="<? $PHP_SELF;?>" method="post">
<input type="hidden" name="act" value="show">
<p align="center">���͡ ᾷ�� : <select name="doctor"  class="style2">
  <option value="���Ծ� �Թ�ѹ (��.� 1272)">���Ծ� �Թ�ѹ (��.� 1272)</option>
  <option value="�ѭ��Ǵ� ����ѵ�� (��.� 1038)">�ѭ��Ǵ� ����ѵ�� (��.� 1038)</option>
  <option value="�.�.˷���ѵ�� ��Ūԧ��� (��.�.2252)">˷���ѵ�� ��Ūԧ��� (��.�.2252)</option>
  <option value="�Ѩ��� �Ǵ���� (��.�. 2556)">�Ѩ��� �Ǵ���� (��.�. 2556)</option>
</select> 
��͹ :   
<select name="chkmonth" class="style2">
    <option selected>-------���͡-------</option>
    <option value="01" <? if(date("m")=="01"){ echo "selected";} ?>>���Ҥ�</option>
    <option value="02" <? if(date("m")=="02"){ echo "selected";} ?>>����Ҿѹ��</option>
    <option value="03" <? if(date("m")=="03"){ echo "selected";} ?>>�չҤ�</option>
    <option value="04" <? if(date("m")=="04"){ echo "selected";} ?>>����¹</option>
    <option value="05" <? if(date("m")=="05"){ echo "selected";} ?>>����Ҥ�</option>
    <option value="06" <? if(date("m")=="06"){ echo "selected";} ?>>�Զع�¹</option>
    <option value="07" <? if(date("m")=="07"){ echo "selected";} ?>>�á�Ҥ�</option>
    <option value="08" <? if(date("m")=="08"){ echo "selected";} ?>>�ԧ�Ҥ�</option>
    <option value="09" <? if(date("m")=="09"){ echo "selected";} ?>>�ѹ��¹</option>
    <option value="10" <? if(date("m")=="10"){ echo "selected";} ?>>���Ҥ�</option>
    <option value="11" <? if(date("m")=="11"){ echo "selected";} ?>>��Ȩԡ�¹</option>
    <option value="12" <? if(date("m")=="12"){ echo "selected";} ?>>�ѹ�Ҥ�</option>

  </select> �� �.�. :  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='chkyear'  class='style2'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?> </p>
<p align="center"><input type="submit" name="submit" value="����§ҹ"></p>
</form>
<hr>
<? if($_POST["act"]=="show"){ 
if($_POST["chkmonth"]=="01"){
	$month="���Ҥ�";
}else if($_POST["chkmonth"]=="02"){
	$month="����Ҿѹ��";
}else if($_POST["chkmonth"]=="03"){
	$month="�չҤ�";
}else if($_POST["chkmonth"]=="04"){
	$month="����¹";
}else if($_POST["chkmonth"]=="05"){
	$month="����Ҥ�";
}else if($_POST["chkmonth"]=="06"){
	$month="�Զع�¹";
}else if($_POST["chkmonth"]=="07"){
	$month="�á�Ҥ�";
}else if($_POST["chkmonth"]=="08"){
	$month="�ԧ�Ҥ�";
}else if($_POST["chkmonth"]=="09"){
	$month="�ѹ��¹";
}else if($_POST["chkmonth"]=="10"){
	$month="���Ҥ�";
}else if($_POST["chkmonth"]=="11"){
	$month="��Ȩԡ�¹";
}else if($_POST["chkmonth"]=="12"){
	$month="�ѹ�Ҥ�";
}
?>
<div align="center">ᾷ�� : <? echo $_POST["doctor"]; ?></div>
<div align="center">��͹ : <? echo $month; ?> �� �.�. <? echo $_POST["chkyear"]; ?></div>
<p>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" height="30" align="center" bgcolor="#66CC99"><strong>�ӴѺ</strong></td>
    <td width="17%" align="center" bgcolor="#66CC99"><strong>�ѹ/��͹/�</strong>�</td>
    <td width="43%" height="35" align="center" bgcolor="#66CC99"><strong>������</strong></td>
    <td width="7%" height="35" align="center" bgcolor="#66CC99"><strong>�ӹǹ</strong></td>
    <td width="29%" height="35" align="center" bgcolor="#66CC99"><strong>������ä</strong></td>
  </tr>
<?
$sql="select * from phardep as a inner join drugrx as b on a.row_id=b.idno where a.doctor='$_POST[doctor]' and a.date like '$_POST[chkyear]-$_POST[chkmonth]%'";
//echo $sql;
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
?>  
  <tr>
    <td height="30" align="center"><?=$i;?></td>
    <td align="center"><?=$rows["date"];?></td>
    <td height="35"><?=$rows["tradname"];?></td>
    <td height="35" align="center"><?=$rows["amount"];?></td>
    <td height="35"><?=$rows["diag"];?></td>
  </tr>
<?
}
?>  
</table>
</p>
<? } ?>

