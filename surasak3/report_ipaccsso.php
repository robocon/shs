<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>�����Ť������¼������ (�Է�Ի�Сѹ�ѧ��)</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.forntsarabun1 {	font-family: "TH SarabunPSK";
	font-size: 18px;
}
@media print{
#no_print{display:none;}
}
-->
</style>
</head>
<?
include("connect.inc");
$d=date('d');
$m=date('m');
?>
<body>
<div align="center" id="no_print">
<p align="center"><strong>�����Ť������¼������ (�Է�Ի�Сѹ�ѧ��)</strong></p>
<form action="report_ipaccsso.php" method="post" name="form1">
<input name="act" type="hidden" value="show" />
  <p align="center"><strong>�к� CODE :</strong> 
    <input name="code" type="text" class="forntsarabun" id="code" />
  </p>
  <div><strong>��ǧ�����ҧ�ѹ��� 
    <input name="d_start" type="text" class="forntsarabun" id="d_start" value="01" size="3" /> 
    ��͹ :</strong> 
    <select name="m_start" class="forntsarabun">
        <option value="01" <? if($m=='01'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>�չҤ�</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>����¹</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>����Ҥ�</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>�Զع�¹</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>�ѹ��¹</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
      </select> 
    <strong>�� :</strong> 
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
				?> 
  <strong>�֧</strong> <strong>�ѹ���
  <input name="d_end" type="text" class="forntsarabun" id="d_end" value="<?=$d;?>" size="3" />
��͹ :</strong>
  <select name="m_end" class="forntsarabun" id="m_end">
    <option value="01" <? if($m=='01'){ echo "selected"; }?>>���Ҥ�</option>
    <option value="02" <? if($m=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
    <option value="03" <? if($m=='03'){ echo "selected"; }?>>�չҤ�</option>
    <option value="04" <? if($m=='04'){ echo "selected"; }?>>����¹</option>
    <option value="05" <? if($m=='05'){ echo "selected"; }?>>����Ҥ�</option>
    <option value="06" <? if($m=='06'){ echo "selected"; }?>>�Զع�¹</option>
    <option value="07" <? if($m=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
    <option value="08" <? if($m=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
    <option value="09" <? if($m=='09'){ echo "selected"; }?>>�ѹ��¹</option>
    <option value="10" <? if($m=='10'){ echo "selected"; }?>>���Ҥ�</option>
    <option value="11" <? if($m=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
    <option value="12" <? if($m=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
  </select>
  <strong>�� :</strong>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_end' class='forntsarabun'>";
				foreach($dates as $i){

				?>
  <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
  <?=$i;?>
  </option>
  <?
				}
				echo "<select>";
				?>
  </div>
       <p><input name="submit" type="submit" class="forntsarabun" value="���Ң�����"/></p>
</form>
</div>
<?
if($_POST["act"]=="show"){
echo "<div align='center'>";
echo "<hr>";
	$code=$_POST["code"];
  	$startdate=$_POST["y_start"]."-".$_POST["m_start"]."-".$_POST["d_start"];
	$enddate=$_POST["y_end"]."-".$_POST["m_end"]."-".$_POST["d_end"];
	$showstart=$_POST["d_start"]."/".$_POST["m_start"]."/".$_POST["y_start"];
	$showend=$_POST["d_end"]."/".$_POST["m_end"]."/".$_POST["y_end"];	
	if(empty($code)){
		echo "<script>alert('��س��к� CODE ���¤�Ѻ');</script>";
	}else{	
	$tbsql="SELECT ipacc.date, ipcard.hn, ipacc.an, ipcard.ptname, ipcard.ptright, ipacc.code, ipacc.detail, ipacc.amount, ipacc.price
FROM `ipacc`
INNER JOIN ipcard ON ipacc.an = ipcard.an
WHERE ipacc.code
LIKE '$code%' AND ipcard.ptright = 'R07 ��Сѹ�ѧ��' AND ipacc.amount !='0' AND (
ipacc.date
BETWEEN '$startdate 00:00:00' AND '$enddate 23:59:59'
)";
	}
	//echo $tbsql;
	$tbquery=mysql_query($tbsql);
	$tbnum=mysql_num_rows($tbquery);
?> 
<div align="center"><strong>�����Ť������¼������ (�Է�Ի�Сѹ�ѧ��)</strong></div>
<div align="center"><strong>��ǧ�����ҧ�ѹ��� </strong>
  <?=$showstart." �֧�ѹ��� ".$showend;?>
</div>
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>�ӴѺ</strong></td>
    <td width="12%" align="center" bgcolor="#66CC99"><strong>�ѹ���</strong></td>
    <td width="7%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="7%" align="center" bgcolor="#66CC99"><strong>AN</strong></td>
    <td width="17%" align="center" bgcolor="#66CC99"><strong>����-���ʡ��</strong></td>
    <td width="13%" align="center" bgcolor="#66CC99"><strong>�Է�ԡ���ѡ��</strong></td>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>����</strong></td>
    <td width="22%" align="center" bgcolor="#66CC99"><strong>��������´</strong></td>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>�ӹǹ</strong></td>
    <td width="7%" align="center" bgcolor="#66CC99"><strong>�Ҥ�</strong></td>
  </tr>
  <?
	if($tbnum < 1){
		echo "<tr><td colspan='10' align='center' style='color:red;'>------------------------ ����բ����� ------------------------</td></tr>";
	}else{
		$i=0;
		while($tbrows=mysql_fetch_array($tbquery)){
		$i++;
?>
  <tr>
    <td align="center" bgcolor="#CCFFCC"><?=$i;?></td>
    <td align="center" bgcolor="#CCFFCC"><?=$tbrows["date"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["hn"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["an"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["ptname"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["ptright"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["code"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["detail"];?></td>
    <td align="right" bgcolor="#CCFFCC"><?=$tbrows["amount"];?></td>
    <td align="right" bgcolor="#CCFFCC"><?=$tbrows["price"];?></td>
  </tr>
  <?
	  	}
	}
  ?>
</table>
<?
echo "</div>";
}
?>
</body>
</html>