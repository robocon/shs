<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size:20px;
}
-->
</style>
  <?
include("../Connections/connect.inc.php");

$thidate=$_REQUEST['date'];



	if($_REQUEST['list']=="all"){
		
		$status="��¡�÷�����";
		
		  $select="SELECT  *  FROM opday  WHERE  thidate  LIKE  '$thidate%' ";
		 
}elseif($_REQUEST['list']=="null"){
	
		 $status="��¡�÷�� ����� diag";
	
		  $select="SELECT  *  FROM opday WHERE thidate  LIKE  '$thidate%' and ((diag !='' and diag!='�к��ä���ͧ��')OR(diag !='' and diag IS NULL))";


}elseif($_REQUEST['list']=="notnull"){
	
			$status="��¡�÷�� �� diag";
	
		  $select="SELECT  *  FROM opday WHERE thidate  LIKE  '$thidate%' and ((diag ='' and diag IS NOT NULL) OR(diag ='' and  diag='�к��ä���ͧ��')OR diag='�к��ä���ͧ��' OR diag IS NULL) ";
}

			$result = mysql_query($select) or die("Query failed");	
		
			$rows=mysql_num_rows($result);
			$no=1;
			
			
			
?>
<title>�ʴ���¡�� Diag ��� <?=$status;?></title>
</head>

<body>

<p>

</p>
<h1 class='forntsarabun'> �ʴ���¡�� Diag ��� <?=$status;?> <input type=button value='��Ѻ' onClick="JavaScript:history.back();"></h1> 
<table width="85%" border="1" cellpadding="2" cellspacing="2" class="forntsarabun">
  <tr>
    <td width="63" align="center" bgcolor="#CCCCCC">�ӴѺ</td>
    <td width="200" align="center" bgcolor="#CCCCCC">Hn</td>
    <td width="126" align="center" bgcolor="#CCCCCC">Vn</td>
    <td width="93" align="center" bgcolor="#CCCCCC">An</td>
    <td width="327" align="center" bgcolor="#CCCCCC">����-ʡ��</td>
    <td width="275" align="center" bgcolor="#CCCCCC">�ѹ������Ѻ��ԡ��</td>
  </tr>
  
  <?
  while($dbarr=mysql_fetch_array($result)){
  ?>
  <tr>
    <td align="center"><?=$no++;?></td>
    <td><?=$dbarr['hn'];?></td>
    <td><?=$dbarr['vn'];?></td>
    <td><?=$dbarr['an'];?></td>
    <td><?=$dbarr['ptname'];?></td>
    <td><?=$dbarr['thidate'];?></td>
  </tr>
  <? } ?>
</table>

</body>
</html>