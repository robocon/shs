<?
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.font1 {	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.font1 {
	font-family: "TH SarabunPSK";
}
.style1 {font-family: "TH SarabunPSK"; font-size: 22px; font-weight: bold; }
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
.style3 {font-family: "TH SarabunPSK"; font-size: 22px}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
</head>

<body>

<?
if(!isset($_POST['search'])){
?>
<a target=_self  href='../nindex.htm' class='forntsarabun'><------ �����</a>
<form action="<? $_SERVER['PHP_SELF']?>" name="f1" method="post" target="_blank">
<table width="291">
	<tr><td align="center" class="font1"><strong>��§ҹ��Ш���͹</strong></td>
	</tr>
    <tr>
      <td align="center" class="style1">��͹
          <select name="m" class="forntsarabun">
<?
	$m=date("m");
	$month = array('0','���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�');
	for($a=1;$a<13;$a++){
		if($a<10) $ss = "0";
		else $ss='';
	?>
            <option value="<?=$ss?><?=$a?>" <? if($m==$a) echo "selected='selected'"?>>
              <?=$month[$a]?>
            </option>
            <?
	}
	?>
          </select>
      ��
          <select name="yr" class="forntsarabun">
            <?
	$year = date("Y")+543;
	for($a=($year-5);$a<($year+5);$a++){
	?>
            <option value="<?=$ss?><?=$a?>" <? if($year==$a) echo "selected='selected'"?>>
            <?=$a?>
            </option>
            <?
	}
	?>
          </select>      </td>
</tr>
      <tr>
  <td align="center" class="font1">
    <input name="search" type="submit" class="forntsarabun" value="  ��ŧ  " style="font:TH SarabunPSK"/>  </td>
</tr> 
</table>

</form>
<?
}
if(isset($_POST['search'])){
	$month = array('0','���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�');
	$sql = "select * from com_support where date like '".$_POST['yr']."-".$_POST['m']."%' and dateend != '0000-00-00 00:00:00'";
	//echo $sql;
	$row = mysql_query($sql);
	$num=mysql_num_rows($row);

?>
<center>
  <span class="style1">��§ҹ����駫����ػ�ó�ҧ���������� �����䢻�Ѻ��ا������ç��Һ��<br />
  ��Ш���͹ 
  <?=$month[$_POST['m']+0]?> �� <?=$_POST['yr']?>
  </span>
</center>
<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse; font-size: 14px;">
<tr><td width="3%" align="center" valign="top" class="font1"><strong>�ӴѺ</strong></td>
  <td width="7%" align="center" valign="top" class="style1">�ѹ�����</td>
  <td width="7%" align="center" valign="top" class="style1">Ἱ�</td>
  <td width="10%" align="center" valign="top" class="style1">�����ͧ��</td>
  <td width="10%" align="center" valign="top" class="style1">�������ҹ</td>
  <td width="10%" align="center" valign="top" class="style1">��Ǣ��</td>
  <td width="28%" align="center" valign="top" class="style1">��������´</td>
  <td width="20%" align="center" valign="top" class="style1">�š�ô��Թ���</td>
  <td width="6%" align="center" valign="top" class="style1">����Ѻ�Դ�ͺ</td>
  <td width="7%" align="center" valign="top" class="style1">�ѹ�����Թ���</td>
  <td width="7%" align="center" valign="top" class="style1">��������/�ѹ</td>
</tr>
<?
	if($num <1){
		echo "<tr><td colspan='11' align='center'>----------------------------------------------- ����բ�������к� -----------------------------------------------</td></tr>";
	}else{
	while($result = mysql_fetch_array($row)){
		$i++;	
?>
		<tr><td align="center" valign="top" class="font1">
	    <?=$i?>
		</td>
		  <td valign="top" class="font1">
	      <?=$result['date']?>		  </td>
		  <td valign="top" class="font1">
	      <?=$result['depart']?>		  </td>
		  <td valign="top" class="font1">
	      <?=$result['user1']?>		  </td>
		  <td valign="top" class="font1"><?=$result['jobtype']?>          </td>
		  <td valign="top" class="font1">
	      <?=$result['head']?>		  </td>
		  <td valign="top" class="font1">
	      <?=nl2br($result['detail'])?>		  </td>
		  <td valign="top" class="font1">
	      <?=$result['p_edit']?>		  </td>
		  <td valign="top" class="font1">
	      <?=$result['programmer']?>		  </td>
		  <td valign="top" class="font1">
	      <?=$result['dateend']?>		  </td>
		  <td align="center" valign="top" class="font1"><?=$result['hold']?></td>
		</tr>
<?
	}}
?>
</table>
<?
}
?>
</body>
</html>