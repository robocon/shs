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
	font-size: 16 pt;
}
.fontsara {
	font-family:"TH SarabunPSK";
	font-size: 16 pt;
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
 
  <!--http://10.0.1.4/sm3/nindex.htm-->
        <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>˹���á</span></a></li>
        <li><a href="ncf2.php" class="parent"><span>�ѹ�֡��§ҹ�˵ء�ó��Ӥѭ</span></a></li>
		<li><a href="fha_from.php" class="parent"><span>�ѹ�֡��§ҹ������Ҵ����͹�ҧ��</span></a></li>
        <li><a href="report_ift.php" class="parent"><span>Ẻ�ѹ�֡��õԴ������С�õԴ����</span></a></li>
        <li><a href="report_accident.php" class="parent"><span>Ẻ��§ҹ������Ѻ�غѵ��˵�</span></a></li>
      <?
		if($_SESSION["statusncr"]=='admin'){
	  ?>    
    
    	<li><a href="#"><span>���§ҹ�˵ء�ó��</span></a></li>
        <ul>
		<li class="last"><a href="ncf_list_clinic.php"><span>���§ҹ����ѧ�����ѹ�֡�дѺ�����ع�ç</a></span></li>
        <li class="last"><a href="ncf_list_risk.php"><span>���§ҹ����ѧ�����ѹ�֡��������§</a></span></li>
        <li class="last"><a href="ncf_list_ic.php"><span>���§ҹ ੾�� IC ��� MR </span></a></li>
    	<li class="last"><a href="ncf_listall.php"><span>���§ҹ������</span></a></li>
        <li class="last"><a href="ncf_list_riskmore2.php"><span>��Ǩ�ͺ���§ҹ</span></a></li>
        </ul>
        <li><a href="#"><span>��§ҹ��ػ</span></a></li>
     	<ul>
        <li class="last"><a href="ncr_report_all.php"><span>��§ҹ��ػ�غѵԡ�ó� ���������</span></a></li>
	  	<li class="last"><a href="ncr_report_progarm.php"><span>��§ҹ��ػ�غѵԡ�ó��ṡ��������</span></a></li>
        <li class="last"><a href="ncr_report_event.php"><span>��§ҹ��ػ�غѵԡ�ó��ṡ����˵ء�ó�</span></a></li>
        <li class="last"><a href="ncf_report_departall.php"><span>��§ҹ��ػ�غѵԡ�ó��ṡ���Ἱ�</span></a></li>
        <li class="last"><a href="ncr_report_progarmdepart2.php"><span>��§ҹ��ػ��������§����Ἱ�</span></a></li>
        <li class="last"><a href="ncr_report_clinic.php"><span>��§ҹ��ػ�дѺ�����ع�ç</span></a></li>
	  	<li class="last"><a href="ncf_report_depart.php"><span>˹��§ҹ�����§ҹ�غѵԡ�ó�</a></span></li>
        <li class="last"><a href="fha_report_depart.php"><span>��§ҹ��ػ ������Ҵ����͹�ҧ��</a></span></li>
        <li class="last"><a href="report_ic_accident.php"><span>��§ҹ�غѵԡ�ó� IC</span></a></li>
        <li class="last"><a href="ic_report_depart.php"><span>��ػ�غѵԡ�ó� IC  ��Шӻ�</span></a></li>
       	</ul>
        <li><a href="#"><span>��§ҹ������Ҵ����͹�ҧ��</span></a></li>
     
     <ul>
	  	<li class="last"><a href="fha_data_old.php"><span>��������� ��ѧ��͹ �.�.2555</span></a></li>
	  	<li class="last"><a href="report_fha.php"><span>���������� ����� �.�.2555 ����</a></span></li>
       	</ul>
        <li><a href="ncf_member.php"><span>��ª��ͼ������к�</span></a></li>
        <li><a href="logout.php"><span>�͡�ҡ�к�</span></a></li>
        
       <? } if($_SESSION["statusncr"]=='staff'){?>
       <li><a href="ncf_list_depart.php"><span>���§ҹ�˵ء�ó��</span></a></li>
        <ul>
	  	<li class="last"><a href="ncf_list_depart.php"><span>���§ҹ�˵ء�ó��  (��������� 2556)</span></a></li>
	  	<li class="last"><a href="ncf_list_old.php"><span>���§ҹ�˵ء�ó�� (�������� < 2556)</a></span></li>
       	</ul>
       <li><a href="#"><span>ʶԵ�</span></a></li> 
       
       <ul>
	  	<li class="last"><a href="ncr_report_progarmdepart.php"><span>ʶԵԤ�������§�ͧἹ�</span></a></li> 
	  	<li class="last"><a href="ncr_report_all_depart.php"><span>ʶԵ��غѵԡ�ó� </a></span></li>
       	</ul>
       <li><a href="ncf_member.php"><span>��ª��ͼ������к�</span></a></li>
        <li><a href="logout.php"><span>�͡�ҡ�к�</span></a></li>
        
     <? } if($_SESSION["statusncr"]=='phar'){?>
     
     <li><a href="#"><span>��§ҹ������Ҵ����͹�ҧ��</span></a></li>
     
     <ul>
	  	<li class="last"><a href="fha_data_old.php"><span>��������� ��ѧ��͹ �.�.2555</span></a></li>
	  	<li class="last"><a href="report_fha.php"><span>���������� ����� �.�.2555 ����</a></span></li>
       	</ul>
       
        <li><a href="logout.php"><span>�͡�ҡ�к�</span></a></li>
        <? } if($_SESSION["statusncr"]!='admin' && $_SESSION["statusncr"]!='staff' && $_SESSION["statusncr"]!='phar'  && $_SESSION["Userncr"]!=""){ ?>
        <li><a href="ncf_list_depart.php"><span>���§ҹ�˵ء�ó��</span></a></li>
        <ul>
	  	<li class="last"><a href="ncf_list_depart.php"><span>���§ҹ�˵ء�ó��  (��������� 2556)</span></a></li>
	  	<li class="last"><a href="ncf_list_old.php"><span>���§ҹ�˵ء�ó�� (�������� < 2556)</a></span></li>
       	</ul>
        <li><a href="#"><span>��§ҹ��ػ</span></a></li>
     	<ul>
	  	<li class="last"><a href="ncr_report_progarm.php"><span>��§ҹ��ػ�غѵԡ�ó��ṡ��������</span></a></li>
        <? if($_SESSION["statusncr"]=='IC'){ ?>
        <li class="last"><a href="report_ic_accident.php"><span>��§ҹ�غѵԡ�ó� IC</span></a></li>
        <li class="last"><a href="ic_report_depart.php"><span>��ػ�غѵԡ�ó� IC  ��Шӻ�</span></a></li>
        <? } ?>
	  <!--	<li class="last"><a href="ncf_report_depart.php"><span>˹��§ҹ�����§ҹ�غѵԡ�ó�</a></span></li>-->
       	</ul>
        <!--<li><a href="ncf_member.php"><span>ʶԵԤ�������§</span></a></li>--> 
        <li><a href="ncf_member.php"><span>��ª��ͼ������к�</span></a></li>
        <li><a href="logout.php"><span>�͡�ҡ�к�</span></a></li>
      <?  }   if(!$_SESSION["Userncr"]){?>
        <li class="last"><a href="login.php"><span>�������к�</span></a></li>
        <? } ?>
         
	

    </ul>
</div>
<?
if(isset($_SESSION["Userncr"])){
include("connect.inc");

$strSQL = "SELECT * FROM member WHERE  username = '".$_SESSION["Userncr"]."'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
?>
<span class="fontsara">�����ҹ��й�� ::  <strong><?=$objResult['name']?></strong> &nbsp;&nbsp;<strong><?=$_SESSION["Untilncr"]?></strong></span> <? } ?>
<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">aaa</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->
<style type="text/css">
<!--
.h {
	font-family: "TH SarabunPSK";
	font-size:24px;
}
.hfont{
	font-family: "TH SarabunPSK";
	font-size:18px;
}
-->
</style>
<style type="text/css">
table.sample {
	border-width: 2px;
	border-spacing: 1px;
	border-style: none;
	border-color: black;
	border-collapse: collapse;
	background-color: white;
}
table.sample th {
	border-width: 2px;
	padding: 2px;
	/*border-style: dashed; */
	border-color: black;
	background-color: rgb(255, 245, 238);
	-moz-border-radius: ;
}
table.sample td {
	border-width: 2px;
	padding: 2px;
	/* border-style: dashed; */
	border-color: black;
	background-color: rgb(255, 245, 238);
	-moz-border-radius: ;
}
.font22{
	font-family:"TH SarabunPSK";
	font-size:18px;
	color:#00F;
}
</style>

<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('addate'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('dcdate'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date1'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date2'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date3'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date4'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date5'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date6'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date7'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date8'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date9'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date10'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date11'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date12'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date13'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date14'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date15'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date16'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('dateproc'));
	
	
	
	
	
};
</script>
 <style>
		.forntsarabun{
			font-family:"TH SarabunPSK";
			font-size:18px;
		}
		</style>

<!--<a href="../../nindex.htm" class="forntsarabun">��Ѻ������ѡ </a>&nbsp;&nbsp;<a href="report_accident.php" class="forntsarabun">Ẻ��§ҹ������Ѻ�غѵ��˵� � </a>-->
<h2 class="h" align="center">Ẻ�ѹ�֡��õԴ������С�õԴ������ç��Һ�Ť�������ѡ�������� �ͧ�����¡��������§</h2>
<h3 class="h" align="center">FR-ICC-001/1,00,1  �.�. 50</h3>
<p align="center">.............................................................................................</p>


<script language="javascript">
function fncSubmit1(strPage)
{
	if(strPage == "page1")
	{
		document.f1.action="<?=$_SERVER['PHP_SELF'];?>?do=select";
	}
/*	if(document.f1.hn.value==''){
		alert('��س��к� HN ��е�Ǩ�ͺ���¤�Ѻ');
		document.f1.hn.focus();
	}*/
	
	
	document.f1.submit();
}
</script>

<?

include("connect2.php");

if($_REQUEST['do']=='select'){

$sql = "Select * From ipcard where an = '".$_POST["an"]."' ";

$result = mysql_query($sql)or die (mysql_error());
$row=mysql_num_rows($result);
if($row>0){
$dbarr=mysql_fetch_array($result);

$ptname=$dbarr['ptname'];
global  $ptname;
include("connect.inc");
$mysql="Select * From ic_infection where an = '".$_POST["an"]."' order by registerdate desc limit 1 ";
$myresult = mysql_query($mysql);

	$myrow=mysql_num_rows($myresult);
	if($myrow){
	$myarr=mysql_fetch_array($myresult);
	$action = "edit_ift.php";
	}else{
	$action = "add_ift.php";
	}
}else{
	echo "<script>alert('��辺 AN $_POST[an]');</script>";
}

}

?>

<form name="f1" action="<?php echo $action;?>" method="post">
<table  class="sample" align="center">
  <tr class="hfont">
    <td height="33" colspan="5" bgcolor="#CCCCCC"><b class="h">�����ŷ���仢ͧ������</b></td>
  </tr>
  <tr class="hfont">
    <td><strong>AN</strong></td>
    <td><strong>
      <input name="an" type="text"  class="hfont" id="an" value="<?=$dbarr['an']; ?>"/>
      <input name="b1" type="button" class="font22"  value="��Ǩ�ͺ" onClick="JavaScript:fncSubmit1('page1')"/>
    </strong></td>
    <td ><strong>HN</strong></td>
    <td><strong>
      <input name="hn" type="text"  class="hfont" id="hn" value="<?=$dbarr['hn']; ?>"/>
    </strong></td>
    <td>&nbsp;</td>
    </tr>
  <tr class="hfont">
    <td><strong>���� - ʡ��</strong></td>
    <td><strong>
      <input name="ptname" type="text"  class="hfont" id="ptname" value="<?=$dbarr['ptname']; ?>"/>
    </strong></td>
    <td><strong>����</strong></td>
    <td><strong>
      <input name="age" type="text"  class="hfont" id="age" value="<?=$dbarr['age']; ?>"/>
    </strong></td>
    <td><strong>�Է�ԡ���ѡ��
      <input name="ptright" type="text"  class="hfont" id="ptright" value="<?=$dbarr['ptright']; ?>"/>
    </strong></td>
    </tr>
  <tr class="hfont">
    <td><strong>�Ѻ���������</strong></td>
    <td><strong>
      <input name="addate" type="text"  class="hfont" id="addate" value="<?=$dbarr['date']; ?>"/>
    </strong></td>
    <td><strong>��˹��������</strong></td>
    <td><strong>
      <input name="dcdate" type="text"  class="hfont" id="dcdate" value="<?=$dbarr['dcdate']; ?>"/>
    </strong></td>
    <td>&nbsp;</td>
    </tr>
  <tr class="hfont">
    <td><strong>�������Ѿ��Դ���</strong></td>
    <td><strong>
      <input name="tel" type="text"  class="hfont" id="tel" value="<?=$myarr['tel'];?>"/>
    </strong></td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    </tr>
  <tr class="hfont">
    <td align="right"><strong>����ԹԨ����ä 1.</strong></td>
    <td><strong>
      <input name="diag1" type="text"  class="hfont" id="diag1" value="<?=$myarr['diag1'];?>"/>
      </strong></td>
    <td colspan="2"><strong>2.
      <input name="diag2" type="text"  class="hfont" id="diag2" value="<?=$myarr['diag2'];?>"/>
      </strong></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr class="hfont">
    <td align="right"><strong>3.</strong></td>
    <td><strong>
      <input name="diag3" type="text"  class="hfont" id="diag3" value="<?=$myarr['diag3'];?>"/>
    </strong></td>
    <td colspan="2"><strong>4.
      <input name="diag4" type="text"  class="hfont" id="diag4" value="<?=$myarr['diag4'];?>"/>
    </strong></td>
    <td align="center">&nbsp;</td>
    </tr>
  <tr class="hfont">
    <td><strong>�ä��Шӵ��</strong></td>
    <td colspan="4"><strong>
      <input name="disease" type="text"  class="hfont" id="disease" value="<?=$myarr['disease'];?>"/>
    </strong></td>
    </tr>
  <tr class="hfont">
    <td colspan="2"><strong>ʶҹТͧ����������ͨ�˹���</strong></td>
    <td colspan="3"><strong>
      <label>
        <input type="radio" name="status_dc" id="status_dc1"   value="1" <? if($myarr['status_dc']==1){ echo "checked='checked'";} ?>/>
      </label>      
      ����ó�</strong></td>
    </tr>
  <tr class="hfont">
    <td colspan="2">&nbsp;</td>
    <td colspan="3"><strong>
      <input type="radio" name="status_dc" id="status_dc2"  value="2" <? if($myarr['status_dc']==2){ echo "checked='checked'";} ?>/>      
      ��ͧ��á�ô��ŵ�����ͧ����ҹ</strong></td>
    </tr>
  <tr class="hfont">
    <td colspan="2">&nbsp;</td>
    <td colspan="3"><strong>
      <input type="radio" name="status_dc" id="status_dc3"  value="3" <? if($myarr['status_dc']==3){ echo "checked='checked'";} ?>/>      
      ������Ѻ����ѡ�ҵ�ͷ�� �.�.
      <input name="refer_host" type="text"  class="hfont" size="50" value="<?=$myarr['refer_host'];?>"/>
    </strong></td>
    </tr>
  <tr class="hfont">
    <td height="53" colspan="5" bgcolor="#CCCCCC"><b class="h">��ǹ��� 1 �Ѩ�������§��������Դ��õԴ������ç��Һ�� �ͧ��������¹�� ��� </b></td>
    </tr>
  <tr class="hfont">
    <td colspan="5">
    <table border="1" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bgcolor="#000000">
      <tr>
        <td width="34" ><strong>�ӴѺ</strong></td>
        <td colspan="7" align="center"><strong>�Ѩ�������§</strong></td>
        <td width="287" align="center"><strong>�ѹ ��͹ �� </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>1</strong></td>
        <td colspan="7"><strong>����������ǹ�������</strong></td>
        <td><strong>
          <input name="date2" type="text"  class="hfont" id="date2" value="<?=$myarr['date2'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>2</strong></td>
        <td colspan="3"><strong>���������ͧ��������</strong></td>
        <td colspan="2"><strong>
          <input type="radio" name="respirator" id="Respirator1"  value="��� ET-Tube" <? if($myarr['respirator']=='��� ET-Tube'){ echo "checked='checked'";}?>/>          
          ��� ET-Tube</strong></td>
        <td colspan="2"><strong>
          <input type="radio" name="respirator" id="Respirator2" value="��Ф�" <? if($myarr['respirator']=='��Ф�'){ echo "checked='checked'";}?>/>          
          ��Ф�</strong></td>
        <td><strong>
          <input name="date3" type="text"  class="hfont" id="date3" value="<?=$myarr['date3'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>3</strong></td>
        <td colspan="7"><strong>����ѵԡ�����ѡ�����,���</strong></td>
        <td><strong>
          <input name="date4" type="text"  class="hfont" id="date4" value="<?=$myarr['date4'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>4</strong></td>
        <td colspan="3"><strong>��ü�ҵѴ          
          <input name="surgery" type="text"  class="hfont" id="surgery" value="<?=$myarr['surgery'];?>"/>
        </strong></td>
        <td colspan="2"><strong>
          <input type="radio" name="surgeryor" id="Surgeryor1" value="��� Drain" <? if($myarr['surgeryor']=='��� Drain'){ echo "checked='checked'";}?> />          
          ��� Drain</strong></td>
        <td colspan="2"><strong>
          <input type="radio" name="surgeryor" id="Surgeryor2" value="������ Drain"  <? if($myarr['surgeryor']=='������ Drain'){ echo "checked='checked'";}?>/>          
          ������ Drain</strong></td>
        <td><strong>
          <input name="date5" type="text"  class="hfont" id="date5" value="<?=$myarr['date5'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>5</strong></td>
        <td colspan="2"><strong>��ä�ʹ</strong></td>
        <td width="83"><strong>
          <input type="radio" name="birth" id="Birth1"  value="C/S"  <? if($myarr['birth']=='C/S'){ echo "checked='checked'";}?>/> 
          C/S </strong></td>
        <td colspan="2"><strong>
          <input type="radio" name="birth" id="Birth2"  value="N/L" <? if($myarr['birth']=='N/L'){ echo "checked='checked'";}?>/>
          N/L</strong></td>
        <td colspan="2"><strong>
          <input type="radio" name="birth" id="Birth3"  value="�ѵ����" <? if($myarr['birth']=='�ѵ����'){ echo "checked='checked'";}?>/> 
          �ѵ����</strong></td>
        <td><strong>
          <input name="date6" type="text"  class="hfont" id="date6" value="<?=$myarr['date6'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center" valign="top"><strong>6</strong></td>
        <td width="129" valign="top"><strong>��÷��ѵ���õ�ҧ�</strong></td>
        <td colspan="6"><strong>
          <label>
            <input name="procedure" type="text" class="hfont" id="procedure" value="<?=$myarr['procedure'];?>" size="40">
          </label>
        </strong></td>
        <td><strong>
          <input name="dateproc" type="text"  class="hfont" id="dateproc" value="<?=$myarr['dateproc'];?>">
        </strong></td>
      </tr>
    </table>

    </td>
    </tr>
  <tr class="hfont">
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr class="h">
    <td colspan="5"><strong>��ǹ��� 2 �š�õԴ��� ������ ����� ( �ѹ ��͹ �� )
      
        <input name="date7" type="text"  class="hfont" id="date7" value="<?=$myarr['date7'];?>"/>
���ҡ�ôѧ��� </strong></td>
  </tr>
  <tr class="hfont">
    <td colspan="5"><table border="1" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bgcolor="#000000">
      <tr>
        <td align="center"><strong>�ӴѺ</strong></td>
        <td align="center"><strong>�ҡ��</strong></td>
        <td align="center">��</td>
        <td align="center">�����</td>
        <td align="center"><strong>������ѹ��� </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>1</strong></td>
        <td><strong>�� �ҡ���� 38 ͧ��������</strong></td>
        <td align="center"><input type="radio" name="fever" id="fever1"  value="1" <? if($myarr['fever']==1){ echo "checked='checked'";}?>/></td>
        <td align="center"><input type="radio" name="fever" id="fever2"  value="2" <? if($myarr['fever']==2){ echo "checked='checked'";}?>/></td>
        <td><strong>
          <input name="date8" type="text"  class="hfont" id="date8" value="<?=$myarr['date8'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>2</strong></td>
        <td><strong> - ������СлԴ�л���</strong></td>
        <td align="center"><input type="radio" name="urine" id="Urine1"  value="1" <? if($myarr['urine']==1){ echo "checked='checked'";}?>/></td>
        <td align="center"><input type="radio" name="urine" id="Urine2"  value="2" <? if($myarr['urine']==2){ echo "checked='checked'";}?>/></td>
        <td><strong>
          <input name="date9" type="text"  class="hfont" id="date9" value="<?=$myarr['date9'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td><strong>- �Ǵ��ͧ����</strong></td>
        <td align="center"><input type="radio" name="abdominal" id="abdominal1"  value="1" <? if($myarr['abdominal']==1){ echo "checked='checked'";}?>/></td>
        <td align="center"><input type="radio" name="abdominal" id="abdominal2"  value="2" <? if($myarr['abdominal']==2){ echo "checked='checked'";}?> /></td>
        <td><strong>
          <input name="date10" type="text"  class="hfont" id="date10" value="<?=$myarr['date10'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td><strong>- ���纺���ǳ����˹��</strong></td>
        <td align="center"><input type="radio" name="pubis" id="pubis1"  value="1" <? if($myarr['pubis']==1){ echo "checked='checked'";}?>/></td>
        <td align="center"><input type="radio" name="pubis" id="pubis2"  value="2" <? if($myarr['pubis']==2){ echo "checked='checked'";}?>/></td>
        <td><strong>
          <input name="date11" type="text"  class="hfont" id="date11" value="<?=$myarr['date11'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>3</strong></td>
        <td><strong>�� ������� ������ / ����ͧ</strong></td>
        <td align="center"><input type="radio" name="cough" id="cough1"  value="1" <? if($myarr['cough']==1){ echo "checked='checked'";}?>/></td>
        <td align="center"><input type="radio" name="cough" id="cough2"  value="2" <? if($myarr['cough']==2){ echo "checked='checked'";}?>/></td>
        <td><strong>
          <input name="date12" type="text"  class="hfont" id="date12" value="<?=$myarr['date12'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>4</strong></td>
        <td><strong>- �ż�ҵѴ �ѡ�ʺ ��� ��˹ͧ</strong></td>
        <td align="center"><input type="radio" name="wound" id="wound1"  value="1" <? if($myarr['wound']==1){ echo "checked='checked'";}?>/></td>
        <td align="center"><input type="radio" name="wound" id="wound2"  value="2" <? if($myarr['wound']==2){ echo "checked='checked'";}?>/></td>
        <td><strong>
          <input name="date13" type="text"  class="hfont" id="date13" value="<?=$myarr['date13'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td><strong>- ����纺�� / ᴧ /�¡ /��˹ͧ</strong></td>
        <td align="center"><input type="radio" name="episiotomy" id="episiotomy1"  value="1" <? if($myarr['episiotomy']==1){ echo "checked='checked'";}?>/></td>
        <td align="center"><input type="radio" name="episiotomy" id="episiotomy2"  value="2" <? if($myarr['episiotomy']==2){ echo "checked='checked'";}?>/></td>
        <td><strong>
          <input name="date14" type="text"  class="hfont" id="date14"  value="<?=$myarr['date14'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td><strong>- ��Ӥ�ǻ���ա�������</strong></td>
        <td align="center"><input type="radio" name="smell" id="smell1"  value="1" <? if($myarr['smell']==1){ echo "checked='checked'";}?>/></td>
        <td align="center"><input type="radio" name="smell" id="smell2"  value="2" <? if($myarr['smell']==2){ echo "checked='checked'";}?>/></td>
        <td><strong>
          <input name="date15" type="text"  class="hfont" id="date15" value="<?=$myarr['date15'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>5</strong></td>
        <td><strong>- ���˹ѧ����ǳ�����ѵ���� ��� ᴧ �ѡ�ʺ ��˹ͧ</strong></td>
        <td align="center"><input type="radio" name="skin" id="skin1"  value="1" <? if($myarr['skin']==1){ echo "checked='checked'";}?>/></td>
        <td align="center"><input type="radio" name="skin" id="skin2"  value="2" <? if($myarr['skin']==2){ echo "checked='checked'";}?>/></td>
        <td><strong>
          <input name="date16" type="text"  class="hfont" id="date16" value="<?=$myarr['date16'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td colspan="5" align="left" valign="top"><table width="0%" border="0" align="left" cellpadding="0" cellspacing="0" bordercolorlight="#FFFFFF" bordercolordark="#000000">
          <tr class="hfont">
            <td width="118"><strong>����ԹԨ������ͧ��</strong></td>
            <td width="756"><strong>
              <label>
                <input type="radio" name="initial_diag" id="initial_diag1"  value="1" <? if($myarr['initial_diag']==1){ echo "checked='checked'";}?> />
                </label>
              �Ҵ��ҹ�Ҩ��ա�õԴ���ͨҡ�ç��Һ��</strong></td>
            </tr>
          <tr class="hfont">
            <td>&nbsp;</td>
            <td><strong>
              <label>
                <input type="radio" name="initial_diag" id="initial_diag2"  value="0" <? if($myarr['initial_diag']=='0'){ echo "checked='checked'";}?>/>
                </label>
              </strong>
              <label>              </label>
              <strong>
                ��辺���С�õԴ���ͨҡ��õԴ���������ѧ </strong></td>
            </tr>
          <tr class="hfont">
            <td colspan="2" align="center"><input type="hidden" name="row_id" value="<?=$myarr['row_id'];?>" /><input name="b1" type="submit" class="font22" id="b1" value="�ѹ�֡������" /></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>