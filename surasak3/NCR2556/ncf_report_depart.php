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
<!--<div align="center" class="forntsarabun">˹��§ҹ����ա����§ҹ�غѵԡ�ó����§�ҡ�ҡ仹��� </div>-->
<div id="no_print" align="center">
<fieldset class="fontsara" style="width:60%">
  <legend>����  </legend><form id="form1" name="form1" method="post">
  <table border="0" align="center">
    <tr>
      <td>���Ҩҡ ��͹ / ��<!--<select name="seach" class="font1" id="seach"  disabled="disabled">
      <option value="">----��س����͡-----</option>
      <option value="thidate" selected="selected">�ѹ���</option>
    <option value="time">��ǧ����</option>
      <option value="hn">HN</option>
       <option value="ptname">����-ʡ��</option>
       <option value="all">������</option>
      </select>-->      </td>
      <td>�к�</td>
      <td>
<!--<span id="text1" style="display:none">-->
	<? $m=date('m'); ?>
      <select name="m_start" class="fontsara">
      	<option value="" >�٢����ŷ�駻�</option>
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
				echo "<select name='y_start' class='fontsara'>";
				foreach($dates as $i){
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "</select>";
				?>

      </td>
    </tr>
    
    <tr>
      <td colspan="3" align="center"><input name="button" type="submit" class="fontsara" id="button" value="��ŧ" />
</td>
    </tr>
  </table>
</form>
</fieldset>
</div>
<br />

<?php
if(isset($_POST['button'])){

include("connect.inc");

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

if($_POST['m_start'] ==""){
	$day="��";
	$thidate=$_POST['y_start'];
}else{
	$day="��͹";
	$thidate=$_POST['y_start'].'-'.$_POST['m_start'];
	
}


$sqlncr= "CREATE TEMPORARY TABLE ncrjoin SELECT * FROM ncr2556 AS a,  departments AS b WHERE a.until = b.code and a.nonconf_date like '$thidate%' ";
$resultncr= Mysql_Query($sqlncr) or die(mysql_error());

$sql2 = "SELECT name,count(until) as cc FROM ncrjoin  Group by until Order by cc DESC";
	
$result2 = Mysql_Query($sql2) or die(mysql_error());
$sum2=0;

?>
<h1 class="fontsara" align="center">ʶԵ���§ҹ�غѵԡ�ó� ��Ш�<?=$day;?> <?=$dateshow;?></h1>
 <TABLE width="282" align="center" class="forntsarabun">
<TR>
	<TD colspan="2" align="center" bgcolor="#CCCCCC">˹��§ҹ</TD>
</TR>

<?
while(list($name,$count2) = Mysql_fetch_row($result2)){
?>
<TR>
	<TD >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $name;?></TD>
	<TD><?php echo $count2;?></TD>
</TR>
<?php 
$sum2+=$count2;
}

?>

<TR>
	<TD bgcolor="#CCCCCC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���</TD>
	<TD bgcolor="#CCCCCC"><?php echo $sum2;?></TD>
</TR>

</TABLE> 


<?  } ?>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>