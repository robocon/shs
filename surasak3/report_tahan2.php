<?php
    session_start();
	include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.ppo {
	font-family: "TH SarabunPSK";
	font-size:20px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
-->
</style>
</head>
 
<body>
<div id="no_print" >
<a href ="../nindex.htm" >&lt;&lt; �����</a>
<form id="form1" name="form1" method="post" action="report_tahan2.php">
<table width="42%" border="0" align="center">
  <tr>
    <td align="center">������ª��ͼ�����ѧ�����ӡ�õ�Ǩ��ҧ��»�Шӻ� ��.</td>
  </tr>
  <tr>
    <td align="center">
          ����� :  
<select  name='camp'>
<option value='0' >--���͡�ѧ�Ѵ--</option>
<option value='�����͹'>�����͹</option>
<option value='�.17 �ѹ2'>�.17 �ѹ2</option>
<option value='���ŷ��ú����32'>���ŷ��ú����32</option>
<option value='�.�.��������ѡ��������'>�.�.��������ѡ��������</option>
<option value='�.�ѹ4'>�.�ѹ4</option>
<option value='���½֡ú����ɻ�еټ�'>���½֡ú����ɻ�еټ�</option>
<option value='��.���.32'>��.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='���.,���.���.32'>���.,���.���.32</option>
<option value='�¡.���.32'>�¡.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='�ʡ.���.32'>�ʡ.���.32</option>
<option value='����.���.32'>����.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='͡.��� ���.32'>͡.��� ���.32</option>
<option value='����.���.32'>����.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='�Ȩ.���.32'>�Ȩ.���.32</option>
<option value='����.���.32'>����.���.32</option>
<option value='ʢ�.���.32'>ʢ�.���.32</option>
<option value='è.���.32'>è.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='��.���.32'>��.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='����.��.���.32'>����.��.���.32</option>
<option value='��.��.���.32'>��.��.���.32</option>
<option value='�ʾ.���.32'>�ʾ.���.32</option>
<option value='��þ���ѧ ���.32'>��þ���ѧ ���.32</option>
<option value='Ƚ.�ȷ.���.32'>Ƚ.�ȷ.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='�ٹ�����Ѿ�� ���.32'>�ٹ�����Ѿ�� ���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='��ʴըѧ��Ѵ�ӻҧ'>��ʴըѧ��Ѵ�ӻҧ</option>
<option value='��.��ѧ ʻ.��'>��.��ѧ ʻ.��</option>
<option value='��� ��.33'>��� ��.33</option>
<option value='˹��·�������'>˹��·�������</option>
</select>
&nbsp;�� :
<select name="year">
<?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
<option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
<?php }?>
</select>
    </td>
    </tr>
  <tr>
    <td align="center"><input type="submit" name="button" id="button" value="��ŧ" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
</table>
</form>
</div>
<?
if(isset($_POST['button'])){
	$sql = "select *,concat(yot,' ',name,' ',surname) as ptname from opcard where camp like '%".$_POST['camp']."%' and (goup like '%G11%' or goup like '%G12%' or goup like '%G14%') and (yot != '���' and yot !='�ŷ���' and yot !='�� �') and (idguard !='MX07�����»���ѵ�' and idguard !='MX05��غ����ѵ�') ";
	$row = mysql_query($sql);
	$z=0;
	$p=0;
	echo "<span class='ppo'>��ª��ͼ�����ѧ�����ӡ�õ�Ǩ�آ�Ҿ ".$_POST['camp']."</span><br>";
	echo "<table class='ppo' border='1' cellpadding='0' cellspacing='0' style='border-collapse:collapse' width='50%'>";
	while($result2 = mysql_fetch_array($row)){
		
		$sql2 = "select * from condxofyear_so where status_dr='Y' and yearcheck='".$_POST['year']."' and hn='".$result2['hn']."'";
		$row2 = mysql_query($sql2);
		$numrow = mysql_num_rows($row2);
		if($numrow==0){
			$result = mysql_fetch_array($row2);
			$z++;
			$p++;
			echo "<tr valign='top'><td align='center'>".$z."</td><td>&nbsp;".$result2['hn']."</td><td>&nbsp;".$result2['ptname']."</td>";
			echo "</tr>";
		}
		if($p==35){
			echo "</table>";
			echo "<div style='page-break-after: always'></div>";
			echo "<table class='ppo' border='1' cellpadding='0' cellspacing='0' style='border-collapse:collapse' width='50%'>";
			$p=0;
		}		
	}
		echo "</table>";
		
}
?>

</body>
</html>