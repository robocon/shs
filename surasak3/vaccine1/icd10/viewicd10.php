<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />

  <?
include("Connections/connect.inc.php");
$thidate=$_REQUEST['date'];



	if($_REQUEST['list']=="all"){
		
		$status="��¡�÷�����";
		
		  $select="SELECT  *  FROM opday  WHERE  thidate  LIKE  '$thidate%' ";
		 
}elseif($_REQUEST['list']=="null"){
	
		$status="��¡�÷���繤����ҧ";
	
		  $select="SELECT  *  FROM opday WHERE  thidate  LIKE  '$thidate%' and icd10=''  ";


}elseif($_REQUEST['list']=="notnull"){
	
			$status="��¡�÷������繤����ҧ";
	
		  $select="SELECT  *  FROM opday WHERE  thidate  LIKE  '$thidate%' and icd10 !='' ";
}

			$result = mysql_query($select) or die("Query failed");	
		
			$rows=mysql_num_rows($result);
			$no=1;
			
			
			
?>
<title>�ʴ���¡�� Icd10 ��� <?=$status;?></title>
</head>

<body>

<p>

</p>
<h1> �ʴ���¡�� Icd10 ��� <?=$status;?> <input type=button value='��Ѻ' onClick="window.location='icd10_from.php'"></h1> 
<table width="100%" border="1" cellpadding="2" cellspacing="2" bgcolor="#FFFFCC">
  <tr>
    <td width="33" align="center" bgcolor="#CCCCCC">�ӴѺ</td>
    <td width="111" align="center" bgcolor="#CCCCCC">Hn</td>
    <td width="69" align="center" bgcolor="#CCCCCC">Vn</td>
    <td width="50" align="center" bgcolor="#CCCCCC">An</td>
    <td width="224" align="center" bgcolor="#CCCCCC">����-ʡ��</td>
    <td width="199" align="center" bgcolor="#CCCCCC">�Է��</td>
    <td width="117" align="center" bgcolor="#CCCCCC">�����</td>
    <td width="167" align="center" bgcolor="#CCCCCC">������</td>
    <td width="142" align="center" bgcolor="#CCCCCC">�ҡ��</td>
    <td width="136" align="center" bgcolor="#CCCCCC">ᾷ��</td>
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
    <td><?=$dbarr['ptright'];?></td>
    <td><?=$dbarr['goup'];?></td>
    <td><?=$dbarr['camp'];?></td>
    <td><?=$dbarr['diag'];?></td>
    <td><?=$dbarr['doctor'];?></td>
  </tr>
  <? } ?>
</table>

</body>
</html>