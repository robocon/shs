<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>��§ҹ ��� REFER</title>
 <link type="text/css" href="sm3_style.css" rel="stylesheet" />
</head>

<body>

<div id="no_print" align="center">
<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="fontsara">
    <td colspan="2" align="center" bgcolor="#99CC99">��§ҹʶԵԡ�� Refer  �ҡ OPD ��</td>
    </tr>
  <tr class="fontsara">
    <td  align="right"><span class="fontsara">��͹/��</span></td>
    <td >
	<? $m=date('m'); ?>
      <select name="m_start" class="fontsara">
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
        </select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='fontsara'>";
				foreach($dates as $i){
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="fontsara" value="����"/>&nbsp;&nbsp;
      <!--<input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">-->
      <a href="../nindex.htm" class="fontsara">��Ѻ������ѡ</a>
      </td>
  </tr>
</table>
</form>
<HR>
</div>
<? if(isset($_POST['submit'])){

$date1=$_POST['y_start'].'-'.$_POST['m_start'];	
	switch($_POST['m_start']){
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
 $dateshow=$printmonth." ".$_POST['y_start'];	
include("connect.inc");	
$sql = "Select row_id, name, sname, hn, an, date_format(dateopd,'%d-%m-%Y'), ward, officer,exrefer,diag  From refer Where dateopd like '$date1%' and ward ='opd_eye' Order by row_id DESC  ";	
$result = mysql_query($sql) or die (mysql_error());

$i=1;
?>
<BR /> 

<div align="center"><font class='fontsara' >�����š�� REFER  OPD �� ��Ш���͹  <?=$dateshow;?> </font></div><BR />

<table border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#000000">
  <tr class="fontsara" bgcolor="#ffff99" onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td align="center">�ӴѺ</td>
    <td align="center">HN</td>
    <td align="center">���� - ʡ��</td>
    <td align="center">�ѹ��� refer</td>
    <td align="center">refer �ҡ</td>
    <td align="center">�˵ؼ�</td>
    <td align="center">Diag</td>
    <td align="center">���ѹ�֡</td>
  </tr>
  <? while(list($row_id, $name, $sname, $hn, $an, $dateopd, $ward, $officer,$exrefer,$diag) = Mysql_fetch_row($result)){ 
  
  switch($ward){
		case "opd" : $by = "��ͧ��Ǩ�ä"; break;  
		case "opd_eye" : $by = "�ѡ��"; break;
		case "opd_obg" : $by = "�ٵ�"; break;
	}

  ?>
  <tr onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td align="center"><?=$i;?></td>
    <td><?=$hn;?></td>
    <td><?=$name." ".$sname;?></td>
    <td><?=$dateopd;?></td>
    <td align="center"><?=$by;?></td>
    <td align="center"><?=$exrefer;?></td>
    <td align="center"><?=$diag;?></td>
    <td><?=$officer;?></td>
  </tr>
  <?
  $i++;
   } ?>
</table>
<? } ?>
</body>
</html>