<? 
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

<style type="text/css">
* { margin:0;
    padding:0;
}
ody { /*background:rgb(74,81,85); */}
div#menu { margin:5px auto; }
div#copyright {
    font:11px 'Trebuchet MS';
    color:#fff;
    text-indent:30px;
    padding:40px 0 0 0;
}
td,th {
	font-family:"TH SarabunPSK";
	font-size: 20 px;
}
.fontsara {
	font-family:"TH SarabunPSK";
	font-size: 18 px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 

/*div#copyright a { color:#00bfff; }
div#copyright a:hover { color:#fff; }*/
</style>
<div id="no_print">
<div id="menu">
<ul class="menu">
  <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>˹���á</span></a></li>
  <li><a href="gward_report_doctor.php" class="parent"><span>��§ҹ������㹵��ᾷ��</span></a></li>
  <li><a href="report_wardlog.php" class="parent"><span>��§ҹ�������¹�����ż�����</span></a></li>

  <li>
    <a href="#"><span>ʶԵ��ͼ����»�Ш���͹</span></a>
    <ul>
      <li class="last"><a href="report_fward.php"><span>�ͼ��������</span></a></li>
      <li class="last"><a href="report_gward.php"><span>�ͼ������ٵ�</span></a></li>
      <li class="last"><a href="report_icuward.php"><span>�ͼ�����˹ѡ</span></a></li>
      <li class="last"><a href="report_vipward.php"><span>�ͼ����¾����</span></a></li>
    </ul>
  </li>
     
  <li>
    <a href="#"><span>Diagnosis ��Шӻ�</span></a>
    <ul>
      <li class="last"><a href="report_icd10_ofyear.php?code=42"><span>�ͼ��������</span></a></li>
      <li class="last"><a href="report_icd10_ofyear.php?code=43"><span>�ͼ������ٵ�</span></a></li>
      <li class="last"><a href="report_icd10_ofyear.php?code=44"><span>�ͼ�����˹ѡ</span></a></li>
      <li class="last"><a href="report_icd10_ofyear.php?code=45"><span>�ͼ����¾����</span></a></li>
    </ul>
  </li>

  <li>
    <a href="#"><span>Diagnosis Top5 ��Шӻ�</span></a>
    <ul>
      <li class="last"><a href="report_icd10_top5.php?code=42"><span>�ͼ��������</span></a></li>
      <li class="last"><a href="report_icd10_top5.php?code=43"><span>�ͼ������ٵ�</span></a></li>
      <li class="last"><a href="report_icd10_top5.php?code=44"><span>�ͼ�����˹ѡ</span></a></li>
      <li class="last"><a href="report_icd10_top5.php?code=45"><span>�ͼ����¾����</span></a></li>
    </ul>
  </li>
     
  <li>
    <a href="#"><span>��§ҹ���������ª��Ե</span></a>
    <ul>
      <li class="last"><a href="report_dead.php?code=42"><span>�ͼ��������</span></a></li>
      <li class="last"><a href="report_dead.php?code=43"><span>�ͼ������ٵ�</span></a></li>
      <li class="last"><a href="report_dead.php?code=44"><span>�ͼ�����˹ѡ</span></a></li>
      <li class="last"><a href="report_dead.php?code=45"><span>�ͼ����¾����</span></a></li>
    </ul>
  </li>
  <li><a href="report_age15.php" class="parent"><span>��ª��������ص�ӡ��� 15��</span></a></li>
  </ul>
</div>

<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->
<style type="text/css">
<!--
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
-->
</style>
<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" bgcolor="#99CC99">��§ҹ�������¹�ŧ�����ż�����</td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right">&nbsp;AN&nbsp;</td>
    <td ><input type="text" name="an" class="forntsarabun" />
   </td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
    <!--<input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">-->
      <!--<a href="../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a>-->
      </td>
  </tr>
</table>
</form>
<HR>
<?php

if($_POST['submit']){

include("../../connect.inc"); 

$an=trim($_POST['an']);

$tsql1="CREATE TEMPORARY TABLE   ward_log1  Select * from   ward_log  WHERE an ='$an'";
$tquery1 = mysql_query($tsql1);


	
	$sql1="SELECT * FROM ward_log1";
	$query1 = mysql_query($sql1);
	$row=mysql_num_rows($query1);
	if($row){
	$i=1;

	
	 print "<div><font class='forntsarabun' >��§ҹ�������¹�ŧ�����ż����� AN: $an</font></div><br>";
	?>
   <table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td align="center">�ӴѺ</td>
    <td align="center">�ѹ���</td>
    <td align="center">HN</td>
    <td align="center">AN</td>
    <td align="center">�ͼ�����</td>
    <td align="center">Bedcode</td>
    <td align="center">Change code</td>
    <td align="center">���������</td>
    <td align="center">����������</td>
     <td align="center">���˹�ҷ��</td>
    </tr>
    <?
	while($arr1=mysql_fetch_array($query1)){
			
			$subdate=explode(" ",$arr1['date']);
		
	?>
    <tr>
      <td align="center"><?=$i;?></td>
      <td><?=$arr1['regisdate']?></td>
      <td><?=$arr1['hn']?></td>
      <td><?=$arr1['an']?></td>
      <td><?=$arr1['ward']?></td>
      <td><?=$arr1['bedcode']?></td>
      <td><?=$arr1['chgcode']?></td>
      <td><?=$arr1['old']?></td>
      <td><?=$arr1['new']?></td>
      <td><?=$arr1['office']?></td>
    </tr>
    <? $i++;
	}  
	
	
	?>
    </table>
<?

}else{
	echo "<font class=\"forntsarabun\">����բ����Ţͧ AN : $an</font>";
}
}
?><!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>