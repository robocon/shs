<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>

<?
include("connect.inc");
print "<div align=\"center\" class=\"forntsarabun\">��ª��� �صá��ѧ�� ����ç������������ǹ �ѧ�Ѵ ".$_GET['addwork']."</div><BR>";

$query = "SELECT * FROM survey_nofat WHERE addwork1='".$_GET['addwork']."' ";
$result = mysql_query($query) or die("Query failed ".$query."");
?>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-color:#000;" class="forntsarabun">
  <tr bgcolor="#CCCCCC">
    <td align="center">�ӴѺ</td>
    <td align="center">����-ʡ��</td>
    <td align="center">�ѹ�Դ</td>
    <td align="center">����</td>
    <td align="center">����-ʡ�� �Դ�</td>
    <td align="center">����-ʡ�� �Դ�</td>
    <td align="center">���˹ѡ</td>
    <td align="center">��ǹ�٧</td>
    <td align="center">�����˵�</td>
  </tr>
 <?   
 $i=1;
 while ($arr = mysql_fetch_array ($result)) {
	
?>

  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$arr['ptname'];?></td>
    <td><?=$arr['bdate']?></td>
    <td><?=$arr['age']?></td>
    <td><?=$arr['father'];?></td>
    <td><?=$arr['mother'];?></td>
    <td><?=$arr['weight'];?></td>
    <td><?=$arr['height'];?></td>
    <td>&nbsp;</td>
  </tr>
  <? 	
  $i++;
  }
  
  ?>
</table>
</body>
</html>