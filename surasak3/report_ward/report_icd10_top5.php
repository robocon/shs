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
.forntsarabun {font-family: "TH SarabunPSK";
	font-size: 22px;
}
.texticd {	font-family: "TH SarabunPSK";
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
</style>
<div id='no_print'>
<form name="f1" action="" method="post">
<table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="texticd">
    <td colspan="2" align="center" bgcolor="#99CC99">Diagnosis TOP 5</td>
  </tr>
  <tr class="texticd">
    <td  align="right">��</td>
    <td><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){
				?>
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
        <?=$i;?>
      </option>
      <?
				}
				echo "<select>";
				?></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>
      &nbsp;&nbsp;
      <!--<input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">--></td>
  </tr>
</table>
</form>
</div>
<?
if($_POST['submit']){

$date1=$_POST['y_start'];
include("../connect.inc");

/*$sql1="CREATE TEMPORARY TABLE  bed1  Select * from  ipcard  WHERE bedcode  LIKE  '42%' and icd10 !='' and dcdate like '".$_POST['y_start']."%' ";
$query1 = mysql_query($sql1);*/

/*$sqltop="SELECT  icd10, COUNT(`icd10`) AS  `top` 
FROM bed1
WHERE  icd10 !=''
GROUP BY icd10
ORDER BY  `top` DESC 
LIMIT 5";
$objtop=mysql_query($sqltop);

$i=0;*/
$lbedcode=$_GET['code'];
	
	if($lbedcode=='42'){
$wardname="�ͼ��������";	
$sortname="���";
	}elseif($lbedcode=='43'){
$wardname="�ͼ������ٵ�";	
$sortname="�ٵ�";
	}elseif($lbedcode=='44'){
$wardname="�ͼ�����ICU";	
$sortname="ICU";
	}elseif($lbedcode=='45'){
$wardname="�ͼ����¾����";	
$sortname="�����";
	}
 ?>
 <h1 class="forntsarabun" align="center">Diagnosis Top 5 <?=$wardname?> ��Шӻ� <?=$_POST['y_start'];?></h1> 
 <table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun" align="center">
  <tr align="center">
<!--<td width="48" align="center"  class="texticd"><strong>�ӴѺ</strong></td>-->
  <td  align="center" bgcolor="#66CCFF"  class="texticd"><strong>�ӴѺ/��͹</strong></td>
  <td width="48" align="center" bgcolor="#66CCFF"  class="texticd"><strong>�.�.</strong></td>
  <td width="51" align="center" bgcolor="#66CCFF"  class="texticd"><strong>�.�.</strong></td>
  <td width="51" align="center" bgcolor="#66CCFF"  class="texticd"><strong>��.�.</strong></td>
  <td width="59" align="center" bgcolor="#66CCFF"  class="texticd"><strong>��.�.</strong></td>
  <td width="51" align="center" bgcolor="#66CCFF"  class="texticd"><strong>�.�.</strong></td>
  <td width="51" align="center" bgcolor="#66CCFF"  class="texticd"><strong>��.�.</strong></td>
  <td width="51" align="center" bgcolor="#66CCFF"  class="texticd"><strong>�.�.</strong></td>
  <td width="51" align="center" bgcolor="#66CCFF"  class="texticd"><strong>�.�.</strong></td>
  <td width="51" align="center" bgcolor="#66CCFF"  class="texticd"><strong>�.�.</strong></td>
  <td width="51" align="center" bgcolor="#66CCFF"  class="texticd"><strong>�.�.</strong></td>
  <td width="51" align="center" bgcolor="#66CCFF"  class="texticd"><strong>�.�.</strong></td>
  <td width="62" align="center" bgcolor="#66CCFF"  class="texticd"><strong>�.�.</strong></td>

  </tr>
  <?
  //while($array2=mysql_fetch_array($objtop)){
	  
/*	  $icd="select detail  from icd10 Where code='$array2[icd10]' ";
	  $q=mysql_query($icd);
	  $r=mysql_fetch_array($q);
*/
  ?>

	<!--<tr>/*<td align="center"><?//=$i;?></td>*/-->
 <?
 $arrtest=array();
 $arrm1=array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;	
		
		$selectsql1 = "SELECT  icd10, COUNT(`icd10`) AS  `top`  FROM ipcard WHERE dcdate like '".$_POST['y_start']."-$m-%' and bedcode like '$lbedcode%' and icd10!='' GROUP BY icd10 ORDER BY  `top` DESC  limit 5";
		$result1 = mysql_query($selectsql1)or die(mysql_error());
		//echo $selectsql1."<br>";
		while($arr1  = mysql_fetch_array($result1)){
			
/*		$sicd10="SELECT detail FROM `icd10` WHERE code='".$arr1['icd10']."' ";
		$sresult = mysql_query($sicd10)or die(mysql_error());
		$sarr  = mysql_fetch_array($sresult);*/
		
			$txt = $arr1['icd10']."<BR>(".$arr1['top'].")";
		//	echo $txt."<BR>";
			array_push($arrm1,$txt);
		//echo $arrtest[$m][$p];
		}
		array_push($arrtest,$arrm1);
		$arrm1=array();
 }
// print_r($arrtest);
 	$p=0;
	$m=1;
	echo "<tr><td align='center'>1</td>";
 	for($n=0;$n<12;$n++){
		
		//echo $n.",".$p."<br>";

		echo "<td align='center'>".$arrtest[$n][$p]."</td>";
		
		if($n==11){
			$p++;
			$m++;
			if($m<=5)
				echo "</tr><tr ><td align='center'>".$m."</td>";
			
			$n=-1;
		}
		if($p==5){
			exit;
		}
 }
  ?>
</tr>


</table>




<? }?>

<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>