<?php
    include("connect.inc");
?>
<style>
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
.font1 {
	font-family: TH SarabunPSK;
	font-size:18px;
}

.fromthai {
font-family: TH SarabunPSK;
font-size: 18px;
}
body,td,th {
	font-family: TH SarabunPSK;
}
</style>
<div id="no_print" >
<span class="font1">
<font face="TH SarabunPSK" size="+2">
<strong>����¹���������Ǫ�ѳ��</strong>
</font>
</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< �����</a>
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
<span class="font1">
��͹ 
</span>
<?
$mm=date("m");
?>
 <select name="mon" class="fromthai">
   <option value="01" <? if($mm=="01"){ echo "selected='selected'";}?>>���Ҥ�</option>
   <option value="02" <? if($mm=="02"){ echo "selected='selected'";}?>>����Ҿѹ��</option>
   <option value="03" <? if($mm=="03"){ echo "selected='selected'";}?>>�չҤ�</option>
   <option value="04" <? if($mm=="04"){ echo "selected='selected'";}?>>����¹</option>
   <option value="05" <? if($mm=="05"){ echo "selected='selected'";}?>>����Ҥ�</option>
   <option value="06" <? if($mm=="06"){ echo "selected='selected'";}?>>�Զع�¹</option>
   <option value="07" <? if($mm=="07"){ echo "selected='selected'";}?>>�á�Ҥ�</option>
   <option value="08" <? if($mm=="08"){ echo "selected='selected'";}?>>�ԧ�Ҥ�</option>
   <option value="09" <? if($mm=="09"){ echo "selected='selected'";}?>>�ѹ��¹</option>
   <option value="10" <? if($mm=="10"){ echo "selected='selected'";}?>>���Ҥ�</option>
   <option value="11" <? if($mm=="11"){ echo "selected='selected'";}?>>��Ȩԡ�¹</option>
   <option value="12" <? if($mm=="12"){ echo "selected='selected'";}?>>�ѹ�Ҥ�</option>
 </select>
<span class="font1">
��
</span>
<?
$Y=date("Y")+543;
$date=date("Y")+543+5;
			  
$dates=range(2547,$date);
echo "<select name='year' class='fromthai'>";
foreach($dates as $i){
?>
	<option value='<?=$i-543; ?>' <? if($Y==$i){ echo "selected"; }?>>
	<?=$i;?>
	</option>
<?
}
echo "<select>";
?>
&nbsp;&nbsp;<input name="BOK" value="��ŧ" class="fromthai" type="submit" />
  </span>
</form>
<hr>
</div>
<?
if(isset($_POST['BOK'])){
$year=$_POST["year"]+543;
$yymm=$year."-".$_POST["mon"];
	if($_POST['mon']=="01"){
		$mon ="���Ҥ�";
		$d1="01";
		$d2="31";
	}else if($_POST['mon']=="02"){
		$mon ="����Ҿѹ��";
		$d1="01";
		$d2="28";
	}else if($_POST['mon']=="03"){
		$mon ="�չҤ�";
		$d1="01";
		$d2="31";
	}else if($_POST['mon']=="04"){
		$mon ="����¹";
		$d1="01";
		$d2="30";
	}else if($_POST['mon']=="05"){
		$mon ="����Ҥ�";
		$d1="01";
		$d2="31";
	}else if($_POST['mon']=="06"){
		$mon ="�Զع�¹";
		$d1="01";
		$d2="30";
	}else if($_POST['mon']=="07"){
		$mon ="�á�Ҥ�";
		$d1="01";
		$d2="31";
	}else if($_POST['mon']=="08"){
		$mon ="�ԧ�Ҥ�";
		$d1="01";
		$d2="31";
	}else if($_POST['mon']=="09"){
		$mon ="�ѹ��¹";
		$d1="01";
		$d2="30";
	}else if($_POST['mon']=="10"){
		$mon ="���Ҥ�";
		$d1="01";
		$d2="31";
	}else if($_POST['mon']=="11"){
		$mon ="��Ȩԡ�¹";
		$d1="01";
		$d2="30";
	}else if($_POST['mon']=="12"){
		$mon ="�ѹ�Ҥ�";
		$d1="01";
		$d2="31";
	}																		
?>
<div align="center">ʶҹ��Һ�� �ç��Һ�Ť�������ѡ��������</div>
<div align="center">��������´��èѴ���� ���Ըա�õ�ŧ�Ҥ� (Ἱ����Ѫ����)</div>
<div align="center">�������ҵ������͹ <?=$d1." ".$mon." ".$year;?> �֧ <?=$d2." ".$mon." ".$year;?></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="2%" align="center"><strong>�ӴѺ</strong></td>
    <td width="5%" align="center"><strong>�Ţ����ѭ��</strong></td>
    <td width="4%" align="center"><strong>��¡��</strong></td>
    <td width="5%" align="center"><strong>�ӹǹ�Թ</strong></td>
    <td width="36%" align="center"><strong>����ѭ��</strong></td>
    <td width="9%" align="center"><strong>͹��ѵԧ�����ҳ</strong></td>
    <td width="9%" align="center"><strong>͹��ѵԨѴ����</strong></td>
    <td width="9%" align="center"><strong>�ѹ���ŧ�����ѭ��</strong></td>
    <td width="8%" align="center"><strong>��˹����ͺ</strong></td>
    <td width="8%" align="center"><strong>�ѹ������ͺ</strong></td>
    <td width="5%" align="center"><strong>�����˵�</strong></td>
  </tr>
<?
$sql = "SELECT * FROM pocompany  WHERE date LIKE '$yymm%' AND prepono !='¡��ԡ' ORDER BY date";
$result = mysql_query($sql) or die("Query failed1");
$num=mysql_num_rows($result);
$i=0;
while($rows = mysql_fetch_array($result)){
$i++;
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$rows["pono"].$rows["ponoyear"];?></td>
    <td align="center">&nbsp;</td>
    <td align="right"><?=number_format($rows["netprice"],2)?></td>
    <td><?=$rows["comname"];?></td>
    <td align="right"><?=$rows["podate"];?></td>
    <td align="right"><?=$rows["podate"];?></td>
    <td align="right"><?=$rows["podate"];?></td>
    <td align="right"><?=$rows["bounddate"];?></td>
    <td align="right"><?=$rows["bounddate"];?></td>
    <td>&nbsp;</td>
  </tr>
<?
}
?>  
</table>

<?
}  //if bok
?>