<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Clinic hypertension</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script> 
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:20pt;
}
.table_font1{
	font-family:"TH SarabunPSK";
	font-size:18pt;
	font-weight:bold;
	color:#600;	
}
.table_font2{
	font-family:"TH SarabunPSK";
	font-size:18pt;
}
legend{
	
font-family:"TH SarabunPSK";
font-size: 18pt;
font-weight: bold;
color:#600;	
padding:0px 3px;
}
fieldset{
display:inline;
background-color:#FEFDDE;
/*width:300px;*/
border-color:#000;

}
</style>

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
<body>


<div id="no_print">
<div id="menu">
  <ul class="menu">
        <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>������ç��Һ��</span></a></li>
         <li><a href="#"><span>ŧ����¹</span></a></li>
          <ul>
		 <li class="last"><a href="diabetes.php"><span>ŧ����¹ DM</span></a></li>
         <li class="last"><a href="hypertension.php"><span>ŧ����¹ HT</span></a></li>
       	</ul>
     	  <li><a href="diabetes_edit.php"><span>��䢢�����</span></a></li>
           <ul>
		 <li class="last"><a href="diabetes_edit.php"><span>��䢢����� DM</span></a></li>
         <li class="last"><a href="hypertension_edit.php"><span>��䢢����� HT</span></a></li>
       	</ul>
         <li><a href="#"><span>��ª��ͼ����� DM</span></a></li>
         <ul>
		 <li class="last"><a href="diabetes_list.php"><span>��ª��ͷ�����</span></a></li>
         <li class="last"><a href="diabetes_list_so.php"><span>��ª��� ����/��ͺ����</span></a></li>
       	</ul>
       <li><a href="#"><span>��ª��ͼ����� HT</span></a></li>
         <ul>
		 <li class="last"><a href="hypertension_list.php"><span>��ª��ͷ�����</span></a></li>
         <li class="last"><a href="hypertension_list_so.php"><span>��ª��� ����/��ͺ����</span></a></li>
       	</ul>
     <li><a href="report_diabetes.php"><span>ʶԵ�</span></a></li>
 		<ul>
		 <li class="last"><a href="report_diabetes.php"><span>ʶԵ� DM</span></a></li>
         <li class="last"><a href="report_hypertension.php"><span>ʶԵ� HT</span></a></li>
       	</ul>
     <li><a href="#"><span>��§ҹ</span></a></li>
 		<ul>
		 <li class="last"><a href="report_diabetesofyear.php"><span>��§ҹ DM</span></a></li>
         <li class="last"><a href="report_hypertensionofyear.php"><span>��§ҹ HT</span></a></li>
       	</ul>        
		<li><a href="history.php"><span>���һ���ѵ�</span></a></li>
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
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.forntsarabun1 {	font-family: "TH SarabunPSK";
	font-size: 18px;
}
@media print{
#no_print{display:none;}
}
-->
</style>
<?
include("../connect.php");
$d=date('d');
$m=date('m');
$year=date("Y");
  	$startdate=$_POST["y_start"]."-".$_POST["m_start"]."-".$_POST["d_start"];
	$enddate=$_POST["y_end"]."-".$_POST["m_end"]."-".$_POST["d_end"];
	$showstart=$_POST["d_start"]."/".$_POST["m_start"]."/".$_POST["y_start"];
	$showend=$_POST["d_end"]."/".$_POST["m_end"]."/".$_POST["y_end"];
	$tbsql="SELECT * FROM `diabetes_clinic` WHERE thidate between '2013-10-01' and '2014-09-30' GROUP BY hn";
	//echo $tbsql;
	$tbquery=mysql_query($tbsql);
	$tbnum=mysql_num_rows($tbquery);
?> 
<p align="center"><strong>��§ҹ������ DM ��Шӻէ�����ҳ 2557</strong></p>
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="4%" rowspan="2" align="center" bgcolor="#66CC99"><strong>�ӴѺ</strong></td>
    <td width="7%" rowspan="2" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="14%" rowspan="2" align="center" bgcolor="#66CC99"><strong>����-���ʡ��</strong></td>
    <td width="15%" rowspan="2" align="center" bgcolor="#66CC99"><strong>�Է�ԡ���ѡ��</strong></td>
    <td width="15%" rowspan="2" align="center" bgcolor="#66CC99"><strong>������</strong></td>
    <td width="16%" rowspan="2" align="center" bgcolor="#66CC99"><strong>
    <div>HBA1C �����ش����</div>
    <div>���¡��� 7 %</div>
    </strong></td>
    <td width="17%" rowspan="2" align="center" bgcolor="#66CC99"><strong>
    <div>FBS 3 �����ش���µԴ��͡ѹ</div>
    <div>����Թ 130 mg/D1</div>
    </strong></td>
    <td width="27%" colspan="5" align="center" bgcolor="#66CC99"><strong>
      <div>���Ѻ��õ�Ǩ     </div><div>���ҧ���� 1 ���� ��ͻ�</div></strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#66CC99"><strong>BS</strong></td>
    <td align="center" bgcolor="#66CC99"><strong>HbA1c</strong></td>
    <td align="center" bgcolor="#66CC99"><strong>LDL</strong></td>
    <td align="center" bgcolor="#66CC99"><strong>Creatinine</strong></td>
    <td align="center" bgcolor="#66CC99"><strong>Microalbuminuria</strong></td>
  </tr>
  <?
	if($tbnum < 1){
		echo "<tr><td colspan='8' align='center' style='color:red;'>------------------------ ����բ����� ------------------------</td></tr>";
	}else{
		$i=0;
		while($tbrows=mysql_fetch_array($tbquery)){
		$i++;
		$sql=mysql_query("select idguard, camp from opcard where hn='".$tbrows["hn"]."'");
		list($idguard, $camp)=mysql_fetch_array($sql);
/*		if($camp=="M01 �����͹" && $idguard !="MX01 ����/��ͺ����"){
			$idguard="MX00 �ؤ�ŷ����";
		}*/		
?>  
  <tr>
    <td align="center" bgcolor="#CCFFCC"><?=$i;?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["hn"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["ptname"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["ptright"];?></td>  
    <td align="left" bgcolor="#CCFFCC"><?=$idguard;?></td>
    <td align="center" bgcolor="#CCFFCC">
	<?
      $laball1="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$tbrows["hn"]."' and  a.labname='HBA1C' and b.orderdate like '$year%' Order by b.orderdate desc";
	  $result_laball1=mysql_query($laball1);
	  $rowall1=mysql_num_rows($result_laball1);
	  $resultall1=mysql_fetch_array($result_laball1);
	  if($rowall1 < 1){
	  	echo "������Ǩ";
	  }else{
	  	if($resultall1["result"] < 7.0){
			echo "1";
		}else{
			echo "0";
		}
	  }
	?>    </td>
    <td align="center" bgcolor="#CCFFCC">
	<?
      $laball1="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$tbrows["hn"]."' and  a.labname='Blood Sugar' and b.orderdate like '$year%' Order by b.orderdate desc limit 3";
	  $result_laball1=mysql_query($laball1);
	  $rowall1=mysql_num_rows($result_laball1);

	  if($rowall1 < 3){
	  	 if($rowall1 < 1){
		 	echo "������Ǩ";
	  	 }else{
		 	echo "��Ǩ���֧ 3 ����";
		 }
	  }else{
	  	$num=0;
	  	while($resultall1=mysql_fetch_array($result_laball1)){
			if($resultall1["result"] < 130){
				$num++;
			}
		}  //close while
			if($num==3){
				echo "1";
			}else{
				echo "0";
			}			
	  } //close if
	?>    </td>
    <td align="center" bgcolor="#CCFFCC">
	<?
      $labtest1="Select labname,result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$tbrows["hn"]."' and  a.labname='Blood Sugar' and b.orderdate like '$year%' Order by b.orderdate desc LIMIT 1";
	  $result_labtest1=mysql_query($labtest1);
	  $rowlabtest1=mysql_num_rows($result_labtest1);
		  if($rowlabtest1 < 1){
			echo "0";
		  }else{
			echo "1";
		  }
	?>    </td>
    <td align="center" bgcolor="#CCFFCC"><?
      $labtest2="Select labname,result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$tbrows["hn"]."' and  a.labname='HBA1C' and b.orderdate like '$year%' Order by b.orderdate desc LIMIT 1";
	  $result_labtest2=mysql_query($labtest2);
	  $rowlabtest2=mysql_num_rows($result_labtest2);
		  if($rowlabtest2 < 1){
			echo "0";
		  }else{
			echo "1";
		  }
	?></td>
    <td align="center" bgcolor="#CCFFCC"><?
      $labtest3="Select labname,result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$tbrows["hn"]."' and  a.labname='LDL' and b.orderdate like '$year%' Order by b.orderdate desc LIMIT 1";
	  $result_labtest3=mysql_query($labtest3);
	  $rowlabtest3=mysql_num_rows($result_labtest3);
		  if($rowlabtest3 < 1){
			echo "0";
		  }else{
			echo "1";
		  }
	?></td>
    <td align="center" bgcolor="#CCFFCC"><?
      $labtest4="Select labname,result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$tbrows["hn"]."' and  a.labname='Creatinine' and b.orderdate like '$year%' Order by b.orderdate desc LIMIT 1";
	  $result_labtest4=mysql_query($labtest4);
	  $rowlabtest4=mysql_num_rows($result_labtest4);
		  if($rowlabtest4 < 1){
			echo "0";
		  }else{
			echo "1";
		  }
	?></td>
    <td align="center" bgcolor="#CCFFCC"><?
      $labtest5="Select labname,result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$tbrows["hn"]."' and  a.labname='Urine Microalbumin' and b.orderdate like '$year%' Order by b.orderdate desc LIMIT 1";
	  $result_labtest5=mysql_query($labtest5);
	  $rowlabtest5=mysql_num_rows($result_labtest5);
		  if($rowlabtest5 < 1){
			echo "0";
		  }else{
			echo "1";
		  }
	?></td>
  </tr>
  <?
	  	}
	}
  ?>
</table>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>