<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
<body>
<h1 class="forntsarabun">��§ҹ��õ�Ǩ�آ�Ҿ���� ��Шӻ� 2555</h1>
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">�ѹ���</span></td>
    <td >
    <select name="d_start" class="forntsarabun">
    <?  for($i=1;$i<=31;$i++){  
			if($i<=9){
				$i="0".$i;
			}else{ $i=$i; }
	?>
    <option value="<?=$i;?>"><?=$i;?></option>
    <?  }  ?>
    </select>
	
	
	<? $m=date('m'); ?>
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
				?></td>
    
    </tr>
  <tr>
    <td colspan="4" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
      <a href="../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a><!--&nbsp;&nbsp; 
      <a href="xray_menu.php" class="forntsarabun">������§ҹ</a>-->
      </td>
  </tr>
</table>
</form>
<br/>


<? 
if($_POST['submit']=="����"){

include("connect.php"); 
$y_start=$_POST['y_start']-543;

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
	
   $dateshow=$_POST['d_start'].' '.$printmonth.' '.$y_start;


$date1=$y_start.'-'.$_POST['m_start'].'-'.$_POST['d_start'];


  print "<font class='forntsarabun'> ��Ш��ѹ���  $dateshow </font><br> ";
  
/*$sql1="CREATE TEMPORARY TABLE  xray1  Select * ,count(*)as Cdetail  from  xray_doctor_detail  WHERE date  LIKE  '$date1%' GROUP BY doctor_detail";
$query1 = mysql_query($sql1);   */
  
  
/*$query="SELECT  * FROM xray1 ";
$result = mysql_query($query);
$rows=mysql_num_rows($result);*/

$sql="Select  *  from  condxofyear_so   WHERE  thidate  LIKE  '$date1%'";
$result = mysql_query($sql);

$rows=mysql_num_rows($result);
$n=0;
?>
<br />

<table border="1" cellspacing="0" cellpadding="0" class="forntsarabun" style="border-collapse:collapse" bordercolor="#000000">
    <tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td align="center">�ӴѺ</td>
    <td align="center">HN</td>
    <td align="center">����-ʡ��</td>
    <td align="center">�ѧ�Ѵ</td>
  </tr>
  <?
if($rows){

while($dbarr=mysql_fetch_array ($result)) {
$n++;

  ?>
  <tr onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td align="center"><?=$n;?></td>
    <td><?=$dbarr['hn'];?></td>
    <td align="left"><?=$dbarr['ptname'];?></td>
    <td align="left"><?=$dbarr['camp'];?></td>
  </tr>
<?
}
}else{ 
echo "<tr><td colspan='4' align='center'>�������¡�õ�Ǩ</td></tr>";
}
?>
</table>
<?
} 
?>
</body>
</html>
