<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.font1{
	font-family: TH SarabunPSK;
	font-size: 20px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style><p align="center"><strong>��§ҹʶԵԷҧ���ᾷ�� �ͧ þ.��.</strong></p>
<div align="center">
<form action="menupst.php" method="post">
  <span> ���͡ ��͹ </span>: 
  <select name="mon" class="font1">
    <option value="01">���Ҥ�</option>
    <option value="02">����Ҿѹ��</option>
    <option value="03">�չҤ�</option>
    <option value="04">����¹</option>
    <option value="05">����Ҥ�</option>
    <option value="06">�Զع�¹</option>
    <option value="07">�á�Ҥ�</option>
    <option value="08">�ԧ�Ҥ�</option>
    <option value="09">�ѹ��¹</option>
    <option value="10">���Ҥ�</option>
    <option value="11">��Ȩԡ�¹</option>
    <option value="12">�ѹ�Ҥ�</option>
  </select>
  &nbsp;&nbsp;<span class="font1">��</span>
  : <?
$Y=date("Y")+543;
$date=date("Y")+543+5;
			  
$dates=range(2547,$date);
echo "<select name='year' class='font1'>";
foreach($dates as $i){
?>
  <option value='<?=$i-543; ?>' <? if($Y==$i){ echo "selected"; }?>>
  <?=$i;?>
  </option>
  <?
}
echo "<select>";
?>
&nbsp;  
<input name="BOK" class="font1" value="����§ҹ" type="submit" />
</form>
<p><a href="../nindex.htm">������ѡ</a></p>
</div>