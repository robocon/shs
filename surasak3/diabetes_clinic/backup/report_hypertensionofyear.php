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
  	$startdate=$_POST["y_start"]."-".$_POST["m_start"]."-".$_POST["d_start"];
	$enddate=$_POST["y_end"]."-".$_POST["m_end"]."-".$_POST["d_end"];
	$showstart=$_POST["d_start"]."/".$_POST["m_start"]."/".$_POST["y_start"];
	$showend=$_POST["d_end"]."/".$_POST["m_end"]."/".$_POST["y_end"];
	$tbsql="SELECT * FROM `hypertension_clinic` WHERE thidate between '2015-07-01' and '2015-09-30' GROUP BY hn ORDER BY joint_disease DESC";
	//echo $tbsql;
	$tbquery=mysql_query($tbsql);
	$tbnum=mysql_num_rows($tbquery);
?> 
<p align="center"><strong>��§ҹ������ HT ��ǧ�������ҵ�����ѹ��� 1 ��͹ �á�Ҥ� �.�. 2558 �֧�ѹ��� 30 ��͹ �ѹ��¹ �.�. 2558 </strong></p>
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>�ӴѺ</strong></td>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="16%" align="center" bgcolor="#66CC99"><strong>����-���ʡ��</strong></td>
    <td width="15%" align="center" bgcolor="#66CC99"><strong>�Է�ԡ���ѡ��</strong></td>
    <td width="18%" align="center" bgcolor="#66CC99"><strong>������</strong></td>
    <td width="18%" align="center" bgcolor="#66CC99"><strong>�ä���� HT </strong></td>
    <td width="14%" align="center" bgcolor="#66CC99"><strong>
    <div>���ä����</div>
    <div>�����ѹ���Ե 3 �����ش���µԴ��͡ѹ &lt; 130/80 mmHg.</div>
    </strong></td>
    <td width="14%" align="center" bgcolor="#66CC99"><strong>
    <div>������ä����</div>
    <div>�����ѹ���Ե 3 �����ش���µԴ��͡ѹ &lt; 140/90 mmHg.</div>
    </strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>��.�ҵ�Ǩ����Ѵ</strong></td>
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
    <td align="left" bgcolor="#CCFFCC">
	<?
	if($tbrows["joint_disease_dm"]=="Y" || $tbrows["joint_disease_nephritic"]=="Y" || $tbrows["joint_disease_myocardial"]=="Y" || $tbrows["joint_disease_paralysis"]=="Y"){
		echo "���ä���� (";
		if($tbrows["joint_disease_dm"]=="Y"){
			echo "����ҹ, ";
		}
		if($tbrows["joint_disease_nephritic"]=="Y"){
			echo "�������ѧ, ";
		}
		if($tbrows["joint_disease_myocardial"]=="Y"){
			echo "������������㨵��, ";
		}
		if($tbrows["joint_disease_paralysis"]=="Y"){
			echo "����ġ������ҵ";
		}				
		echo ")";
	}else{
		echo "������ä����";
	}
	?>    </td>
    <td align="center" bgcolor="#CCFFCC">
	<?
	if($tbrows["joint_disease_dm"]=="Y" || $tbrows["joint_disease_nephritic"]=="Y" || $tbrows["joint_disease_myocardial"]=="Y" || $tbrows["joint_disease_paralysis"]=="Y"){
		$sql="SELECT thidate, bp1, bp2 FROM opd WHERE hn = '".$tbrows["hn"]."' AND (bp1 !='' OR bp2 !='') AND thidate between '2558-07-01 00:00:00' and '2558-09-30 23:59:59' ORDER  BY thidate DESC LIMIT 3";
		//echo $sql;
		$query=mysql_query($sql);
	    $rownum=mysql_num_rows($query);
	    if($rownum < 3){
	  	   if($rownum < 1){
		 	  	echo "������Ǩ";
	  	 	}else{
		 		echo "��Ǩ���֧ 3 ����";
			}
	    }else{		
			$num=0;
			while($rows=mysql_fetch_array($query)){
				if($rows["bp1"] < 130 && $rows["bp2"] < 80){
					$code="y";
					$num++;
				}else{
					$code="n";
				}	
			}  //close while
			if($num==3){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
	?>    </td>
    <td align="center" bgcolor="#CCFFCC">
	<?
	if($tbrows["joint_disease_dm"]=="" && $tbrows["joint_disease_nephritic"]=="" && $tbrows["joint_disease_myocardial"]=="" && $tbrows["joint_disease_paralysis"]==""){
		$sql="SELECT thidate, bp1, bp2 FROM opd WHERE hn = '".$tbrows["hn"]."' AND (bp1 !='' OR bp2 !='') AND thidate between '2558-07-01 00:00:00' and '2558-09-30 23:59:59' ORDER  BY thidate DESC LIMIT 3";
		$query=mysql_query($sql);
	    $rownum=mysql_num_rows($query);
	    if($rownum < 3){
	  	   if($rownum < 1){
		 	  	echo "������Ǩ";
	  	 	}else{
		 		echo "��Ǩ���֧ 3 ����";
			}
	    }else{			
			$num=0;
			while($rows=mysql_fetch_array($query)){
				if($rows["bp1"] < 140 && $rows["bp2"] < 90){
					$code="y";
					$num++;
				}else{
					$code="n";
				}
			}  //close while
			if($num==3){
				echo "1";
			}else{
				echo "0";
			}
		}		
	}
	?>    </td>
    <td align="center" bgcolor="#CCFFCC">
    <?
		$sql="SELECT thidate, bp1, bp2, organ FROM opd WHERE hn = '".$tbrows["hn"]."' AND (bp1 !='' OR bp2 !='') AND organ like '%��Ǩ����Ѵ%'   AND thidate between '2558-07-01 00:00:00' and '2558-09-30 23:59:59' ORDER  BY thidate DESC LIMIT 3";
		$query=mysql_query($sql);
		$recode=mysql_num_rows($query);
		if(!empty($recode)){
			echo "1";
		}else{
			echo "0";
		}
	?>    </td>
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