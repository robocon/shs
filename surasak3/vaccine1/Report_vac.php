<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>˹���á</title>
<!--<link rel="stylesheet" href="../reset.css" />--> 

<!--[if IE]>
	<link rel="stylesheet" href="ie-hack-style.css" />
<![endif]-->

<style type="text/css">
<!--
-->
</style>
<Style>
ul {
	padding: 10px;
	margin: 10px;
	border: thin solid black;
	width: 250px;
	height: autopx;
	overflow-x: scroll;
	overflow-y: auto;


}
#apDiv1 {
	position:absolute;
	left:298px;
	top:25px;
	width:1022px;
	height:486px;
	z-index:1;
}
</style>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size:20px;
}
-->
</style>
</head>
<body>
		
<div id="apDiv1">
<h1 align="left" class="forntsarabun">����§ҹ�����¡���Ѥ�չ</h1>
<?
include("Connections/connect.inc.php"); 


$select="select * from  vaccine order by id_vac asc ";
$query=mysql_query($select);
$rows=mysql_num_rows($query);
$n=1;
?>
<table width="395" border="0" cellpadding="2" cellspacing="3">
  <tr class="forntsarabun">
    <td width="157" align="center" bgcolor="#999999">�����Ѥ�չ</td>
    <td width="222" align="center" bgcolor="#999999">�����Ѥ�չ</td>
    <td width="222" align="center" bgcolor="#999999">�ӹǹ/����</td>
    <td width="222" align="center" bgcolor="#999999">���</td>
    </tr>
  <?
  while($dbarr=mysql_fetch_array($query)){
	$id_vac=$dbarr['id_vac'];
	  
	    $select2 = "SELECT count(id_vac)as number  FROM  tb_service  where id_vac='$id_vac' GROUP BY id_vac";
 		$result2 = mysql_query($select2);
		$dbarr2=mysql_fetch_array($result2);
  ?>
  <tr class="forntsarabun">
    <td align="center"><?=$n++;?></td>
    <td align="center"><a href="Report.php?id=<?=$id_vac;?>"><?=$dbarr['vac_name'];?></a></td>
    <td align="center"><? if($dbarr2['number']==''){ echo "�ѧ�������¡��"; }else{ echo $dbarr2['number']; }?></td>
    <td align="center"><? if($dbarr2['number']==''){ echo "0"; }else{ echo $dbarr2['number']; }?></td>
    </tr>
  <?
$number+=$dbarr2['number'];
  }
  ?>
  <tr class="forntsarabun">
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">���������</td>
    <td align="center" bgcolor="#CCCCCC"><?=$number;?></td>
    </tr>
  
</table>

</div>
<ul class="forntsarabun"> <div align="center">   
���١���Ѻ��ԡ���Ѥ�չ </div>
<li><a href="../../nindex.htm"  title="��Ѻ˹���á">˹���á</a> </li> 
<li><a href="service.php" title="����Ѻ��ԡ���Ѥ�չ">����Ѻ��ԡ���Ѥ�չ</a></li>
<li><a href="Report_vac.php" title="��§ҹ����Ѻ��ԡ��">��§ҹ����Ѻ��ԡ�õ���Ѥ�չ</a></li>  
<li><a href="Report_m.php" title="��§ҹ����Ѻ��ԡ��">��§ҹ����Ѻ��ԡ�û�Ш���͹</a></li>
<li><a href="Report_all.php" title="��§ҹ����Ѻ��ԡ��">��§ҹ����Ѻ��ԡ�÷�����</a>  </li>
<li><a href="show_edit.php" title="�����¡�ú�ԡ���Ѥ�չ">�����¡�ú�ԡ���Ѥ�չ</a>  </li>
<li><a href="add_vac.php" title="�Ѵ��â������Ѥ�չ">�Ѵ��â������Ѥ�չ (����/���/ź)</a>  </li>

</ul>
</body>
</html>
<!--show_edit.php-->