
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<link href="sm3_style.css" rel="stylesheet" type="text/css" />
</head>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<body>
<div id="no_print">
<form id="form1" name="form1" method="post" action="">
  <table  border="0" align="center">
    <tr>
      <td colspan="2" align="center" bgcolor="#CCCCCC">��§ҹ����駵��</td>
    </tr>
    <tr>
      <td colspan="2" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td>��͹/��</td>
      <td>
        <? $m=date('m'); ?>
        <select name="m_start" class="fontsara1">
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
        <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='fontsara1'>";
				foreach($dates as $i){
				?>
        <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
          <?=$i;?>
        </option>
        <?
				}
				echo "</select>";
				?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="��ŧ"  class="fontsara1"/>
      <a target=_self  href='../nindex.htm'><<�����</a>&nbsp;&nbsp;&nbsp;
      <a target=_self  href='hn_death.php'>���Ţ����駵��</a>
      </td>
    </tr>
  </table>
</form>
<br />
</div>

<?
if(isset($_POST['button'])){

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

include("connect.inc");


	
$today=$_POST['y_start'].'-'.$_POST['m_start'];
$sh="��Ш���͹";
$shtodate=($_POST['y_start']-543).'-'.$_POST['m_start'];
$dateshow=$printmonth." ".$_POST['y_start'];



print "<div align=\"center\" class=\"forntsarabun\">��§ҹ����駵��  $sh  $dateshow</div><BR>";

$query = "SELECT  *  FROM  death  WHERE d_update like '$shtodate%' order by row_id asc";
	
	
	$result = mysql_query($query) or die("Query failed ".$query."");

//echo $query;
?>
<table  border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-color:#000;" class="forntsarabun">
  <tr bgcolor="#CCCCCC">
    <td align="center">�ӴѺ</td>
    <td align="center">HN</td>
    <td align="center">����-ʡ��</td>
    <td align="center">��</td>
    <td align="center">�Ţ����駵��</td>
    <td align="center">�����˵�</td>
  </tr>
 <?   
 $i=1;
 while ($arr= mysql_fetch_array($result)) {
	 
	 $strsql2="SELECT  concat(yot,name,' ',surname) as ptname ,sex  FROM opcard    WHERE  hn='".$arr['hn']."' ";
	 $objquery2  = mysql_query($strsql2);
	list($ptname,$sex) = mysql_fetch_row($objquery2);
		 
//echo $strsql2;
if($sex=='�'){
$sex="���";	
}else if($sex=='�'){
$sex="˭ԧ";	
}else{
$sex="";	
}
?>

  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$arr['hn'];?></td>
    <td><?=$ptname;?></td>
    <td><?=$sex?></td>
    <td><?=$arr['runno'];?></td>
    <td>&nbsp;</td>
  </tr>
  <? 	
  $i++;
  }

  ?>
</table>
<? } ?>
</body>
</html>