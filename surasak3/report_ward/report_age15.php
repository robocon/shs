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
	font-size: 20px;
}
.forntsarabun2 {
	font-family: "TH SarabunPSK";
	font-size: 16pt;
	border-collapse:collapse;
}
.fornbody {
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
<div id="no_print">
<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" bgcolor="#99CC99"><span class="forntsarabun2">��ª��������ص�ӡ��� 15 ��</span></td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">��͹/��</span></td>
    <td >
	<? $m=date('m'); ?>
      <select name="m_start" class="forntsarabun">
      <option value="" >�ٷ�駻�</option>
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
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right">�ͼ�����</td>
    <td ><select name="ward"  class="forntsarabun">
    <option value="42">�ͼ��������</option>
     <option value="43">�ͼ������ٵ�</option>
      <option value="44">�ͼ�����˹ѡ</option>
       <option value="45">�ͼ����¾����</option>
    </select>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
      <!--<input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">--></td>
  </tr>
</table>
</form>
<HR>
</div>

<?php
if($_POST['submit']){
	
?>
<!--<script>
//window.print() ;
</script>-->
<?	
	
include("../connect.inc"); 
$month=$_POST['m_start'];

$year1=$_POST['y_start'];

$code=$_POST['ward'];

$date1=$year1.'-'.$month;



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
	
	
	$sql="SELECT * 
  FROM `ipcard` 
  WHERE  substring(age,1,2) <15 
  and dcdate like '$date1%' 
  and bedcode like '$code%' 
  order by date ";
	$query = mysql_query($sql)or die (mysql_error());

$i=1;
?>
 <h1 class="forntsarabun2" align="center">��ª��������ص�ӡ��� 15 ��</h1>
<table  border="1" cellpadding="0" cellspacing="0" class="forntsarabun2" bordercolor="#000000">
  <tr align="center">
    <td>�ӴѺ</td>
    <td>HN</td>
    <td>AN</td>
    <td>����-���ʡ��</td>
    <td>����</td>
    <td>�Է��</td>
    <td>diag</td>
    <td>ᾷ��</td>
    <td>Admit</td>
    <td>D/C</td>
    <td>�ѹ�͹</td>
    <td>ʶҹ�</td>
  </tr>
  
  <? 	while($arr=mysql_fetch_array($query)){ ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$arr['hn'];?></td>
    <td><?=$arr['an'];?></td>
    <td><?=$arr['ptname'];?></td>
    <td><?=$arr['age'];?></td>
    <td><?=$arr['ptright'];?></td>
    <td><?=$arr['diag'];?></td>
    <td><?=$arr['doctor'];?></td>
    <td><?=$arr['date'];?></td>
    <td><?=$arr['dcdate'];?></td>
    <td align="right"><?=$arr['days'];?></td>
    <td>&nbsp;</td>
  </tr>
  <?  
  $i++;
  
  } ?>
</table>




<?  
}
	  
	  ?>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>