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
<div align="center">
<style type="text/css">
.hd {
	color: #FFF;
}
</style>




<?

include("connect.inc");

$strSQL = "SELECT * FROM member WHERE  username = '".$_SESSION["Userncr"]."'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
?>

<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" bgcolor="#999999" class="hd"> ���§ҹ�˵ء�ó��Ӥѭ / �غѵԡ�ó� / ��������ʹ���ͧ</td>
  </tr>
  <tr>
    <td align="center" valign="middle"><br />
      ���ʴդ�Ѻ �س :<?=$objResult['name']?>
      <br />
       <?=$_SESSION["Untilncr"]?>
      <br />
    �дѺ�����ҹ : 
    <?=$objResult['status']?>
    <br />
    <br /></td>
  </tr>
</table>

</div>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>