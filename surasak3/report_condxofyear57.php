<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
  <form name="form1" method="post" action="<? $PHP_SELF; ?>">
    <tr>
      <td align="right" valign="bottom"><span>˹��§ҹ :</span>
        <select  name="txtcamp">
          <option value="0">---------- ���͡ ----------</option>
          <option value="M02">�.17 �ѹ2</option>
          <option value="M04">�.�.��������ѡ��������</option>
          <option value="M05">�.�ѹ4</option>
          <option value="M06">���½֡ú����ɻ�еټ�</option>
          <option value="M0301">��.���.32</option>
          <option value="M0302">���.���.32</option>
          <option value="M0303">���.,���.���.32</option>
          <option value="M0304">�¡.���.32</option>
          <option value="M0305">���.���.32</option>
          <option value="M0306">���.���.32</option>
          <option value="M0307">���.���.32</option>
          <option value="M0308">���.���.32</option>
          <option value="M0309">�ʡ.���.32</option>
          <option value="M0311">���.���.32</option>
          <option value="͡.���">͡.��� ���.32</option>
          <option value="����">����.���.32</option>
          <option value="M0314">���.���.32</option>
          <option value="M0315">�Ȩ.���.32</option>
          <option value="M0316">����.���.32</option>
          <option value="M0317">ʢ�.���.32</option>
          <option value="è">è.���.32</option>
          <option value="M0318">���.���.32</option>
          <option value="M0319">���.���.32</option>
          <option value="M0320">���.���.32</option>
          <option value="M0321">����.��.���.32</option>
          <option value="M0322">��.��.���.32</option>
          <option value="M0323">�ʾ.���.32</option>
          <option value="M0324">��þ���ѧ ���.32</option>
          <option value="M0325">Ƚ.�ȷ.���.32</option>
          <option value="���.���.32">���.���.32</option>
          <option value="M0327">�ٹ�����Ѿ�� ���.32</option>
          <option value="M0328">���.���.32</option>
          <option value="M08">��ʴըѧ��Ѵ�ӻҧ</option>
        </select>        &nbsp;�� :
        <select name="year" id="yr">
        <?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
        <option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
        <?php }?>
        </select>
                  <input type="submit" class="formbutton" name="submit" value="���Ң�����" />
                  <input type="hidden" name="page" value="1" />	  </td>
    </tr>
  </form>
</table>
<?php
include("../connect.inc");
$sql = "select * from condxofyear_so where yearcheck='$_POST[year]' and camp like '%$_POST[txtcamp]%'";
$query=mysql_query($sql);
$num=mysql_num_rows($query);
$rows=mysql_fetch_array($query);
$camp = $rows["camp"];
?>
<p><span><strong>�ĵԡ�����ô��Թ���Ե�ͧ���ѧ�� ��. ��������Դ��������§����ä<br />
</strong></span> <strong>˹��·�����Ѻ��õ�Ǩ
    <? if($_POST["txtcamp"]=="0"){ echo "����ء˹���"; }else{ echo $camp; }?>
</strong></p>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="36%" align="center" valign="middle"><strong>����������ǡѺ�ĵԡ�����ô��Թ���Ե</strong></td>
    <td width="19%" align="center" valign="middle"><strong>��·����ѭ�Һѵ� (���)</strong></td>
    <td width="21%" align="center" valign="middle"><strong>��·��ê�鹻�зǹ (���)</strong></td>
    <td width="16%" align="center" valign="middle"><strong>�١��ҧ��Ш� (���)</strong></td>
    <td width="8%" align="center" valign="middle"><strong>��� (���)</strong></td>
  </tr>
  <tr>
    <td align="left" valign="middle">����ٺ������</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="middle"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ������ٺ</td>
    <td align="center" valign="middle">
<?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%'
)
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="0"){
		echo $rows["cigsun"];
	}	
	}
?>    </td>
    <td align="center" valign="middle">
<?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�.�%' OR ptname
LIKE '%�.�.�%' OR ptname
LIKE '%�.�.�%'
)
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="0"){
		echo $rows["cigsun"];
	}	
	}
?></td>
    <td align="center" valign="middle"><?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%�ҧ%'
)
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="0"){
		echo $rows["cigsun"];
	}	
	}
?></td>
    <td align="center" valign="middle">
<?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' 
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="0"){
		echo $rows["cigsun"];
	}	
	}
?>    </td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ���ٺ����ԡ����</td>
    <td align="center" valign="middle">
<?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%'
)
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="2"){
		echo $rows["cigsun"];
	}	
	}
?>   </td>
    <td align="center" valign="middle">
<?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%'AND (
ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�.�%' OR ptname
LIKE '%�.�.�%' OR ptname
LIKE '%�.�.�%'
)
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="2"){
		echo $rows["cigsun"];
	}	
	}
?></td>
    <td align="center" valign="middle"><?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%'AND (
ptname
LIKE '%�ҧ%'
)
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="2"){
		echo $rows["cigsun"];
	}	
	}
?></td>
    <td align="center" valign="middle">
<?
$sql = "SELECT cigarette, count(cigarette) AS countcig
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%'
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="2"){
		echo $rows["countcig"];
	}	
	}
?>    </td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- �ѧ�ٺ����</td>
    <td align="center" valign="middle">
<?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%'
)
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="1"){
		echo $rows["cigsun"];
	}	
	}
?>    </td>
    <td align="center" valign="middle"><?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�.�%' OR ptname
LIKE '%�.�.�%' OR ptname
LIKE '%�.�.�%'
)
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="1"){
		echo $rows["cigsun"];
	}	
	}
?>	</td>
    <td align="center" valign="middle"><?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%�ҧ%' 
)
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="1"){
		echo $rows["cigsun"];
	}	
	}
?>    </td>
    <td align="center" valign="middle">
<?
$sql = "SELECT cigarette, count(cigarette) AS countcig
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%'
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="1"){
		echo $rows["countcig"];
	}	
	}
?>    </td>
  </tr>
  <tr>
    <td align="left" valign="middle">��ô�������ͧ������š�����</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ������</td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count( alcohol ) AS achsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%'
)
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="0"){
		echo $rows["achsun"];
	}	
	}
?>    </td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count( alcohol ) AS achsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�.�%' OR ptname
LIKE '%�.�.�%' OR ptname
LIKE '%�.�.�%'
)
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="0"){
		echo $rows["achsun"];
	}	
	}
?>	</td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count( alcohol ) AS achsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%�ҧ%'
)
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="0"){
		echo $rows["achsun"];
	}	
	}
?>	</td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count(alcohol) AS countach
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%'
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="0"){
		echo $rows["countach"];
	}	
	}
?>    </td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- �����繤��駤���</td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count( alcohol ) AS achsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%'
)
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="2"){
		echo $rows["achsun"];
	}	
	}
?>    </td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count( alcohol ) AS achsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�.�%' OR ptname
LIKE '%�.�.�%' OR ptname
LIKE '%�.�.�%'
)
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="2"){
		echo $rows["achsun"];
	}	
	}
?></td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count( alcohol ) AS achsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%�ҧ%'
)
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="2"){
		echo $rows["achsun"];
	}	
	}
?>	</td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count(alcohol) AS countach
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%'
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="2"){
		echo $rows["countach"];
	}	
	}
?>    </td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- �����繻�Ш�</td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count( alcohol ) AS achsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%'
)
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="1"){
		echo $rows["achsun"];
	}	
	}
?>    </td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count( alcohol ) AS achsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�%' OR ptname
LIKE '%�.�.�%' OR ptname
LIKE '%�.�.�%' OR ptname
LIKE '%�.�.�%'
)
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="1"){
		echo $rows["achsun"];
	}	
	}
?></td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count( alcohol ) AS achsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%�ҧ%'
)
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="1"){
		echo $rows["achsun"];
	}	
	}
?>    </td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count(alcohol) AS countach
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%'
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="1"){
		echo $rows["countach"];
	}
	}
?>    </td>
  </tr>
  <tr>
    <td align="left" valign="middle">����͡���ѧ��� (ࡳ�� 3 ����/�ѻ����)</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ����͡���ѧ���</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- �͡���ѧ������֧ࡳ��</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- �͡���ѧ��µ��ࡳ��</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
  </tr>
</table>

<p>&nbsp;</p>
<p><strong>�ӹǹ��������Тͧ���ѧ�ŷ���ռš�÷��ͺ���ö�Ҿ��ҧ��¼�ҹࡳ��ͧ˹���<br>
</strong></p>
<table width="100%" border="1" cellpadding="0" cellspacing="0"  bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="36%" rowspan="2" align="center" valign="middle"><strong>�ӹǹ��������Тͧ���ѧ�ŷ����<br>
    �š�÷��ͺ���ö�Ҿ��ҧ��¼�ҹࡳ��</strong></td>
    <td width="19%" align="center" valign="middle" bordercolor="#000000"><strong>��·����ѭ�Һѵ�<br> 
    (���)</strong></td>
    <td width="19%" align="center" valign="middle" bordercolor="#000000"><strong>��·��ê�鹻�зǹ <br>
    (���)</strong></td>
    <td width="26%" align="center" valign="middle"><strong>�Դ��������</strong></td>
  </tr>
  <tr>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
  </tr>
</table>
<br>
<br>
<table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td width="9%" height="31"><strong>����Ǻ���������</strong> .......................................................................</td>
  </tr>
  <tr>
    <td height="29"><strong>���˹�</strong> ...................................................................................</td>
  </tr>
  <tr>
    <td height="31"><strong>�������Ѿ��</strong> ...........................................................<strong>�÷���</strong>................................................<strong>��Ͷ��</strong>................................................</td>
  </tr>
</table>
