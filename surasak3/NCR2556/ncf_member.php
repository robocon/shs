<?php
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>�к���§ҹ�˵ء�ó��Ӥѭ/�غѵԡ�ó�/��������ʹ���ͧ</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<body>
<?php include 'menu.php'; ?>

<div><!-- InstanceBeginEditable name="detail" -->
<style type="text/css">

.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
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

</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>

<?php


include("connect.inc");

// �������� admin �����੾��Ἱ��ͧ����ͧ
$where = "";
if( $_SESSION['Userncr'] !== NULL AND $_SESSION['Userncr'] !== 'admin' ){
    $code = $_SESSION['Codencr'];
    $where = "WHERE until = '$code' ";
}

$sql1="SELECT *  FROM  member $where Order by member_id asc";	
$query1 = mysql_query($sql1)or die (mysql_error());
print "<div align=\"center\"><font class='forntsarabun' >��ª��ͼ����ҹ��к� ���§ҹ�˵ء�ó��Ӥѭ�</font></div><br>";

	?>
   <?php   if($_SESSION["statusncr"]=='admin'){ ?><div align="center" class='forntsarabun'> 
   <a href="javascript:MM_openBrWindow('ncf_member_add.php','','width=600,height=500')">���������</a>
   </div>
   <?php } ?>
   <table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun" style="border-collapse:collapse"> 
    <tr bgcolor="#0099FF">
    <td width="5%" align="center">�ӴѺ</td>
    <?php   if($_SESSION["statusncr"]=='admin'){ ?>
    <td width="35%" align="center">User</td>
    <td align="center">password</td>
    <?php } ?>
    <td align="center">����</td>
    <td align="center">˹��§ҹ </td>
     <?php   if($_SESSION["statusncr"]=='admin'){ ?>
    <td width="5%" align="center">���</td>
    <td width="5%" align="center">ź</td>

<?php } ?>
    </tr>
    <?php
	$i=0;
	while($arr1=mysql_fetch_array($query1)){
		
		
		$sql="SELECT * FROM `departments` where code='".$arr1['until']."' and status='y' ";
		$query=mysql_query($sql)or die (mysql_error());
		$arr=mysql_fetch_array($query);
		
$i++;
if($i%2==0)
{
$bg = "#CCCCCC";
}
else
{
$bg = "#FFFFFF";
}
	?>
    <tr bgcolor="<?=$bg;?>">
      <td align="center"><?=$arr1['member_id']?></td>
      <?php   if($_SESSION["statusncr"]=='admin'){ ?>
      <td><?=$arr1['username']?></td>
      <td><?=$arr1['password']?></td>
      <?php } ?>
      <td><?=$arr1['name']?></td>
      <td><?=$arr['name']?></td>
      <?php   if($_SESSION["statusncr"]=='admin'){ ?>
      <td align="center"><a href="javascript:MM_openBrWindow('ncf_member_edit.php?id=<?=$arr1['member_id']?>','','width=400,height=500')">���</a></td>
      <td align="center"><a href="javascript:if(confirm('�׹�ѹ���ź <?=$arr1['name']?>?')==true){MM_openBrWindow('ncf_member_del.php?id=<?=$arr1['member_id']?>','','width=400,height=500')}">ź</a></td>

      
<?php } ?>
     </tr>
    <?php
	}  
	
	
	?>
    </table>
   <!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>