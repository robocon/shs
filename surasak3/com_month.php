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
	font-size: 20px;
}
.font1 {
	font-family: AngsanaUPC;
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
	<tr><td align="center" class="font1">��§ҹ��Ш���͹</td>
	</tr>
    <tr>
      <td align="center" class="font1">��͹
          <select name="m">
            <?
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
          <select name="yr">
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
          </select>
      </td>
    </tr>
      <tr>
  <td align="center" class="font1">
    <input name="search" type="submit" value="  ��ŧ  "/>
  </td>
</tr> 
</table>

</form>
<?
}
if(isset($_POST['search'])){
	$month = array('0','���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�');
	$sql = "select * from com_support where dateend like '".$_POST['yr']."-".$_POST['m']."%' and dateend != '0000-00-00 00:00:00'";
	$row = mysql_query($sql);
?>
<center>
  <span class="font1">��§ҹ��Ш���͹ 
  <?=$month[$_POST['m']+0]?> �� <?=$_POST['yr']?>
  </span>
</center>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse; font-size: 14px;">
<tr><td width="3%" align="center" valign="top" class="font1">�ӴѺ</td>
  <td width="7%" align="center" valign="top" class="font1">�ѹ���</td>
  <td width="7%" align="center" valign="top" class="font1">Ἱ�</td>
  <td width="10%" align="center" valign="top" class="font1">�����ͧ��</td>
  <td width="10%" align="center" valign="top" class="font1">��Ǣ��</td>
  <td width="28%" align="center" valign="top" class="font1">��������´</td>
  <td width="20%" align="center" valign="top" class="font1">�š�ô��Թ���</td>
  <td width="6%" align="center" valign="top" class="font1">����Ѻ�Դ�ͺ</td>
  <td width="7%" align="center" valign="top" class="font1">�ѹ���ҷ����Թ���</td>
</tr>
<?
	while($result = mysql_fetch_array($row)){
		$i++;
?>
		<tr><td align="center" valign="top" class="font1">
	    <?=$i?>
		</td>
		  <td valign="top" class="font1">
	      <?=$result['date']?>
		  </td>
		  <td valign="top" class="font1">
	      <?=$result['depart']?>
		  </td>
		  <td valign="top" class="font1">
	      <?=$result['user']?>
		  </td>
		  <td valign="top" class="font1">
	      <?=$result['head']?>
		  </td>
		  <td valign="top" class="font1">
	      <?=nl2br($result['detail'])?>
		  </td>
		  <td valign="top" class="font1">
	      <?=$result['p_edit']?>
		  </td>
		  <td valign="top" class="font1">
	      <?=$result['programmer']?>
		  </td>
		  <td valign="top" class="font1">
	      <?=$result['dateend']?>
		  </td>
		</tr>
<?
	}
?>

</table>
<?
}
?>
</body>
</html>