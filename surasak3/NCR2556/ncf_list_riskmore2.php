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
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
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
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('nonconf_date'));

};

</script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>


<form name="f1" action="" method="post">
  <table  border="0" cellpadding="3" cellspacing="3">
    <tr class="forntsarabun">
      <td  align="right" bgcolor="#FFFFCC">&nbsp;</td>
      <td bgcolor="#FFFFCC" >����</td>
    </tr>
    <tr class="forntsarabun">
      <td width="64"  align="right">���͡��</td>
      <td width="387" ><!--      <select name="m_start" class="forntsarabun">
        <option value="">---������͡��͹---</option>
        <option value="01" <?//if($m=='01'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="02" <?//if($m=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
        <option value="03" <?//if($m=='03'){ echo "selected"; }?>>�չҤ�</option>
        <option value="04" <?//if($m=='04'){ echo "selected"; }?>>����¹</option>
        <option value="05" <?//if($m=='05'){ echo "selected"; }?>>����Ҥ�</option>
        <option value="06" <?//if($m=='06'){ echo "selected"; }?>>�Զع�¹</option>
        <option value="07" <?//if($m=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
        <option value="08" <?//if($m=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
        <option value="09" <?//if($m=='09'){ echo "selected"; }?>>�ѹ��¹</option>
        <option value="10" <?//if($m=='10'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="11" <?//if($m=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
        <option value="12" <?//if($m=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
      </select>-->
        <? 
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
        <input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun"></td>
    </tr>
  </table>
</form>
<HR>
<?php

include("connect.inc");

	if($_POST['y_start']!=''){
	$date1=($_POST['y_start']);
	}else{
	$date1=(date("Y")+543);
	}

$sql1="SELECT nonconf_id, ncr, until, date_format(nonconf_date,'%d/%m/')as date1,date_format(nonconf_date,'%Y')as date2,  left(nonconf_time,5) as time ,risk1, risk2, risk3, risk4, risk5, risk6, risk7, risk8, risk9,nonconf_dategroup ,`return`,clinic FROM  ncr2556  	WHERE  `nonconf_date` 
LIKE  '$date1%' AND ( `risk1`  =1 OR  `risk2`  =1 OR  `risk3`  =1 OR  `risk4`  =1 OR  `risk5`  =1 OR  `risk6`  =1 OR  `risk7`  =1 OR  `risk8`  =1 OR  `risk9`  =1 ) order by ncr desc";	

	//echo $sql1;
	$query1 = mysql_query($sql1)or die (mysql_error());
	$row=mysql_num_rows($query1);
	
	

	/*if($row){*/

	// print "<div><font class='forntsarabun' >ʶԵԼ�����㹨�ṡ��� ᾷ�� $_POST[doctor]  $��Ш�$day  $dateshow </font></div><br>";
	?>
  <h1 class="forntsarabun" align="center">���§ҹ�˵ء�ó����ա���кؤ�������§�ҡ����1��� <font color="#FF0000"> �� 
  <?=($date1)?></font></h1>
   <table width="100%" border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td width="5%" align="center">�ӴѺ</td>
    <td width="35%" align="center">˹��§ҹ/���</td>
    <td align="center">�ѹ�����¹��§ҹ</td>
    <td align="center">�ѹ�����§ҹ��ԧ</td>
    <td align="center">����</td>
    <td align="center">NCR </td>
    <td align="center">ʶҹ��觡�Ѻ</td>
    <td align="center">�����ع�ç</td>
    <td align="center">��������§</td>
    <?
	 if($_SESSION["statusncr"]=='admin'){
	?>
    <td width="5%" align="center">���</td>
    <td width="5%" align="center">ź</td>
    <? } ?>
    <td width="5%" align="center">�����</td>
    </tr>
    <?
	$i=0;
	while($arr1=mysql_fetch_array($query1)){
	
	$sum=$arr1['risk1']+$arr1['risk2']+$arr1['risk3']+$arr1['risk4']+$arr1['risk5']+$arr1['risk6']+$arr1['risk7']+$arr1['risk8']+$arr1['risk9'];
	
	if($sum>1){
	
		
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

if($arr1['risk2']=='1'){
	$risk="IC";
	$riskCount1++;
}else if ($arr1['risk3']=='1'){
	$risk="MR";
	$riskCount2++;
}else if ($arr1['risk2']=='1' and $arr1['risk3']=='1'){
	$risk="IC,MR";
	$riskCount3++;	
}else{
	$risk="";
}
$dategroup=explode("-",$arr1['nonconf_dategroup']);

if($arr1['return']==1){
	$arr1['return']="�ٹ��س�Ҿ";
}else{
	$arr1['return']="";
}



if($arr1['risk1']=="1"){	
		$showrisk1="1.Clinical Risk , ";
		}else{
		$showrisk1="";
		}
		if($arr1['risk2']=="1"){
		$showrisk2="2.Infection control Risk , ";	
		}else{
		$showrisk2="";
		}
		if($arr1['risk3']=="1"){
		$showrisk3="3.Medication Risk , ";
		}else{
		$showrisk3="";
		}
		if($arr1['risk4']=="1"){
		$showrisk4="4.Medical Equipment Risk , ";
		}else{
		$showrisk4="";
		}
		if($arr1['risk5']=="1"){
		$showrisk5="5.Safety and Environment Risk , ";	
		}else{
		$showrisk5="";
		}
		if($arr1['risk6']=="1"){
		$showrisk6="6.Customer Complaint Risk , ";	
		}else{
		$showrisk6="";
		}
		if($arr1['risk7']=="1"){
		$showrisk7="7.Financial Risk ,";	
		}else{
		$showrisk7="";
		}
		if($arr1['risk8']=="1"){
		$showrisk8="8.Utilization Management Risk , ";
		}else{
		$showrisk8="";
		}
		if($arr1['risk9']=="1"){
		$showrisk9="9.Information Risk ";	
		}else{
		$showrisk9="";
		}
	?>
    <tr bgcolor="<?=$bg;?>">
      <td align="center"><?=$i?></td>
      <td><?=$arr['name']?></td>
      <td><?=$arr1['date1'].($arr1['date2'])?></td>
      <td><?=$dategroup[1].'-'.$dategroup[0]?></td>
      <td><?=$arr1['time']?></td>
      <td><?=$arr1['ncr']?></td>
      <td><?=$arr1['return']?></td>
      <td align="center"><?=$arr1['clinic']?>&nbsp;</td>
      <td><?=$showrisk1.$showrisk2.$showrisk3.$showrisk4.$showrisk5.$showrisk6.$showrisk7.$showrisk8.$showrisk9?></td>
      <?
	 if($_SESSION["statusncr"]=='admin'){
	?>
      <td align="center"><a  href="ncf2_edit.php?nonconf_id=<?=$arr1['nonconf_id'];?>" target="_blank">���</a></td>
      <td align="center"><a href="javascript:if(confirm('�׹�ѹ���ź NCR : <?=$arr1['nonconf_id']?>')==true){MM_openBrWindow('ncf_del.php?id=<?=$arr1['nonconf_id']?>','','width=400,height=500')}">ź</a></td>
      <?  } ?>
      <td align="center"><a  href="ncf_print.php?ncr_id=<?=$arr1['nonconf_id'];?>" target="_blank">�����</a></td>
     </tr>
    <?
	}  
	
	}
	?>
    </table>
    
    <BR>
    
    <? 	
	$sql2="SELECT nonconf_id, ncr, until, date_format(nonconf_date,'%d/%m/')as date1,date_format(nonconf_date,'%Y')as date2,  left(nonconf_time,5) as time ,risk1, risk2, risk3, risk4, risk5, risk6, risk7, risk8, risk9,nonconf_dategroup ,`return`,clinic FROM  ncr2556  	WHERE  `nonconf_date` 
LIKE  '$date1%' AND ( `risk1`  =0 and `risk2`  =0 and  `risk3`  =0 and  `risk4`  =0 and `risk5`  =0 and  `risk6`  =0 and `risk7` =0 and  `risk8`  =0 and  `risk9`  =0 ) order by ncr desc";	

	$query2 = mysql_query($sql2)or die (mysql_error());
	$row2=mysql_num_rows($query2);
	
	?>
  <h1 class="forntsarabun" align="center">���§ҹ�˵ء�ó����ѧ������кؤ�������§ <font color="#FF0000"> �� 
  <?=($date1)?></font></h1>
   <table width="100%" border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td width="5%" align="center">�ӴѺ</td>
    <td width="35%" align="center">˹��§ҹ/���</td>
    <td align="center">�ѹ�����¹��§ҹ</td>
    <td align="center">�ѹ�����§ҹ��ԧ</td>
    <td align="center">����</td>
    <td align="center">NCR </td>
    <td align="center">ʶҹ��觡�Ѻ</td>
    <td align="center">�����ع�ç</td>
    <td align="center">��������§</td>
    <?
	 if($_SESSION["statusncr"]=='admin'){
	?>
    <td width="5%" align="center">���</td>
    <td width="5%" align="center">ź</td>
    <? } ?>
    <td width="5%" align="center">�����</td>
    </tr>
    <?
	$i=0;
	while($arr2=mysql_fetch_array($query2)){
	
	//$sum=$arr1['risk1']+$arr1['risk2']+$arr1['risk3']+$arr1['risk4']+$arr1['risk5']+$arr1['risk6']+$arr1['risk7']+$arr1['risk8']+$arr1['risk9'];
	
	//if($sum>1){
	
		
		$sql="SELECT * FROM `departments` where code='".$arr2['until']."' and status='y' ";
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

if($arr2['risk2']=='1'){
	$risk="IC";
	$riskCount1++;
}else if ($arr2['risk3']=='1'){
	$risk="MR";
	$riskCount2++;
}else if ($arr2['risk2']=='1' and $arr2['risk3']=='1'){
	$risk="IC,MR";
	$riskCount3++;	
}else{
	$risk="";
}
$dategroup=explode("-",$arr2['nonconf_dategroup']);

if($arr2['return']==1){
	$arr2['return']="�ٹ��س�Ҿ";
}else{
	$arr2['return']="";
}

if($arr2['risk1']=="1"){	
		$showrisk1="1.Clinical Risk , ";
		}else{
		$showrisk1="";
		}
		if($arr2['risk2']=="1"){
		$showrisk2="2.Infection control Risk , ";	
		}else{
		$showrisk2="";
		}
		if($arr2['risk3']=="1"){
		$showrisk3="3.Medication Risk , ";
		}else{
		$showrisk3="";
		}
		if($arr2['risk4']=="1"){
		$showrisk4="4.Medical Equipment Risk , ";
		}else{
		$showrisk4="";
		}
		if($arr2['risk5']=="1"){
		$showrisk5="5.Safety and Environment Risk , ";	
		}else{
		$showrisk5="";
		}
		if($arr2['risk6']=="1"){
		$showrisk6="6.Customer Complaint Risk , ";	
		}else{
		$showrisk6="";
		}
		if($arr2['risk7']=="1"){
		$showrisk7="7.Financial Risk ,";	
		}else{
		$showrisk7="";
		}
		if($arr2['risk8']=="1"){
		$showrisk8="8.Utilization Management Risk , ";
		}else{
		$showrisk8="";
		}
		if($arr2['risk9']=="1"){
		$showrisk9="9.Information Risk ";	
		}else{
		$showrisk9="";
		}
	?>
    <tr bgcolor="<?=$bg;?>">
      <td align="center"><?=$i?></td>
      <td><?=$arr['name']?></td>
      <td><?=$arr2['date1'].($arr2['date2'])?></td>
      <td><?=$dategroup[1].'-'.$dategroup[0]?></td>
      <td><?=$arr2['time']?></td>
      <td><?=$arr2['ncr']?></td>
      <td><?=$arr2['return']?></td>
      <td align="center"><?=$arr2['clinic']?></td>
      <td><?=$showrisk1.$showrisk2.$showrisk3.$showrisk4.$showrisk5.$showrisk6.$showrisk7.$showrisk8.$showrisk9?></td>
      <?
	 if($_SESSION["statusncr"]=='admin'){
	?>
      <td align="center"><a  href="ncf2_edit.php?nonconf_id=<?=$arr2['nonconf_id'];?>" target="_blank">���</a></td>
      <td align="center"><a href="javascript:if(confirm('�׹�ѹ���ź NCR : <?=$arr2['nonconf_id']?>')==true){MM_openBrWindow('ncf_del.php?id=<?=$arr2['nonconf_id']?>','','width=400,height=500')}">ź</a></td>
      <?  } ?>
      <td align="center"><a  href="ncf_print.php?ncr_id=<?=$arr2['nonconf_id'];?>" target="_blank">�����</a></td>
     </tr>
    <?
	}  
	
	//}
	?>
  </table>
<?
/*echo "<BR>IC =".$riskCount1;
echo "<BR>MR=".$riskCount2;

echo "<BR>��� =".$a=$riskCount1+$riskCount2;*/
/*}else{
	echo "<font class=\"forntsarabun\">����բ����Ţͧ $_POST[doctor]  $day  $dateshow</font>";
}*/
?>
 <BR>
    
    <? 	
	$sql2="SELECT nonconf_id, ncr, until, date_format(nonconf_date,'%d/%m/')as date1,date_format(nonconf_date,'%Y')as date2,  left(nonconf_time,5) as time ,nonconf_dategroup ,risk1, risk2, risk3, risk4, risk5, risk6, risk7, risk8, risk9,nonconf_dategroup ,`return`,clinic FROM  ncr2556  	WHERE  `nonconf_date` 
LIKE  '$date1%' and clinic ='' order by ncr desc";	

	$query2 = mysql_query($sql2)or die (mysql_error());
	$row2=mysql_num_rows($query2);

	?>
  <h1 class="forntsarabun" align="center">���§ҹ�˵ء�ó����ѧ������кؤ����ع�ç <font color="#FF0000"> �� 
  <?=($date1)?></font></h1>
   <table width="100%" border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td width="5%" align="center">�ӴѺ</td>
    <td width="35%" align="center">˹��§ҹ/���</td>
    <td align="center">�ѹ�����¹��§ҹ</td>
    <td align="center">�ѹ�����§ҹ��ԧ</td>
    <td align="center">����</td>
    <td align="center">NCR </td>
    <td align="center">ʶҹ��觡�Ѻ</td>
    <td align="center">�����ع�ç</td>
    <td align="center">��������§</td>
    <?
	 if($_SESSION["statusncr"]=='admin'){
	?>
    <td width="5%" align="center">���</td>
    <td width="5%" align="center">ź</td>
    <? } ?>
    <td width="5%" align="center">�����</td>
    </tr>
    <?
	$i=0;
	while($arr2=mysql_fetch_array($query2)){
	
	//$sum=$arr1['risk1']+$arr1['risk2']+$arr1['risk3']+$arr1['risk4']+$arr1['risk5']+$arr1['risk6']+$arr1['risk7']+$arr1['risk8']+$arr1['risk9'];
	
	//if($sum>1){
	
		
		$sql="SELECT * FROM `departments` where code='".$arr2['until']."' and status='y' ";
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

if($arr2['risk2']=='1'){
	$risk="IC";
	$riskCount1++;
}else if ($arr2['risk3']=='1'){
	$risk="MR";
	$riskCount2++;
}else if ($arr2['risk2']=='1' and $arr2['risk3']=='1'){
	$risk="IC,MR";
	$riskCount3++;	
}else{
	$risk="";
}
$dategroup=explode("-",$arr2['nonconf_dategroup']);

if($arr2['return']==1){
	$arr2['return']="�ٹ��س�Ҿ";
}else{
	$arr2['return']="";
}

if($arr2['risk1']=="1"){	
		$showrisk1="1.Clinical Risk , ";
		}else{
		$showrisk1="";
		}
		if($arr2['risk2']=="1"){
		$showrisk2="2.Infection control Risk , ";	
		}else{
		$showrisk2="";
		}
		if($arr2['risk3']=="1"){
		$showrisk3="3.Medication Risk , ";
		}else{
		$showrisk3="";
		}
		if($arr2['risk4']=="1"){
		$showrisk4="4.Medical Equipment Risk , ";
		}else{
		$showrisk4="";
		}
		if($arr2['risk5']=="1"){
		$showrisk5="5.Safety and Environment Risk , ";	
		}else{
		$showrisk5="";
		}
		if($arr2['risk6']=="1"){
		$showrisk6="6.Customer Complaint Risk , ";	
		}else{
		$showrisk6="";
		}
		if($arr2['risk7']=="1"){
		$showrisk7="7.Financial Risk ,";	
		}else{
		$showrisk7="";
		}
		if($arr2['risk8']=="1"){
		$showrisk8="8.Utilization Management Risk , ";
		}else{
		$showrisk8="";
		}
		if($arr2['risk9']=="1"){
		$showrisk9="9.Information Risk ";	
		}else{
		$showrisk9="";
		}
	?>
    <tr bgcolor="<?=$bg;?>">
      <td align="center"><?=$i?></td>
      <td><?=$arr['name']?></td>
      <td><?=$arr2['date1'].($arr2['date2'])?></td>
      <td><?=$dategroup[1].'-'.$dategroup[0]?></td>
      <td><?=$arr2['time']?></td>
      <td><?=$arr2['ncr']?></td>
      <td><?=$arr2['return']?></td>
      <td align="center"><?=$arr1['clinic']?></td>
      <td><?=$showrisk1.$showrisk2.$showrisk3.$showrisk4.$showrisk5.$showrisk6.$showrisk7.$showrisk8.$showrisk9?></td>
      <?
	 if($_SESSION["statusncr"]=='admin'){
	?>
      <td align="center"><a  href="ncf2_edit.php?nonconf_id=<?=$arr2['nonconf_id'];?>" target="_blank">���</a></td>
      <td align="center"><a href="javascript:if(confirm('�׹�ѹ���ź NCR : <?=$arr2['nonconf_id']?>')==true){MM_openBrWindow('ncf_del.php?id=<?=$arr2['nonconf_id']?>','','width=400,height=500')}">ź</a></td>
      <?  } ?>
      <td align="center"><a  href="ncf_print.php?ncr_id=<?=$arr2['nonconf_id'];?>" target="_blank">�����</a></td>
     </tr>
    <?
	}  
	
	//}
	?>
  </table>
<?
/*echo "<BR>IC =".$riskCount1;
echo "<BR>MR=".$riskCount2;

echo "<BR>��� =".$a=$riskCount1+$riskCount2;*/
/*}else{
	echo "<font class=\"forntsarabun\">����բ����Ţͧ $_POST[doctor]  $day  $dateshow</font>";
}*/
?>
<BR>
 <? 	
	$sql2="SELECT nonconf_id, ncr, until, date_format(nonconf_date,'%d/%m/')as date1,date_format(nonconf_date,'%Y')as date2,  left(nonconf_time,5) as time ,nonconf_dategroup ,risk1, risk2, risk3, risk4, risk5, risk6, risk7, risk8, risk9,nonconf_dategroup ,`return`,clinic FROM  ncr2556  	WHERE  `nonconf_date` 
LIKE  '$date1%' and (( pro_f =''  and  pro_b ='' and pro_i ='' and pro_t='' and pro_s='')  or  ( pro_f is null and  pro_b is null and pro_i is null and pro_t is null and pro_s is null))order by ncr desc";	

	$query2 = mysql_query($sql2)or die (mysql_error());
	$row2=mysql_num_rows($query2);

	?>
  <h1 class="forntsarabun" align="center">���§ҹ�˵ء�ó����ѧ������к�  F B I T S<font color="#FF0000"> �� 
  <?=($date1)?></font></h1>
   <table width="100%" border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td width="5%" align="center">�ӴѺ</td>
    <td width="35%" align="center">˹��§ҹ/���</td>
    <td align="center">�ѹ�����¹��§ҹ</td>
    <td align="center">�ѹ�����§ҹ��ԧ</td>
    <td align="center">����</td>
    <td align="center">NCR </td>
    <td align="center">ʶҹ��觡�Ѻ</td>
    <td align="center">�����ع�ç</td>
    <td align="center">��������§</td>
    <?
	 if($_SESSION["statusncr"]=='admin'){
	?>
    <td width="5%" align="center">���</td>
    <td width="5%" align="center">ź</td>
    <? } ?>
    <td width="5%" align="center">�����</td>
    </tr>
    <?
	$i=0;
	while($arr2=mysql_fetch_array($query2)){
	
	//$sum=$arr1['risk1']+$arr1['risk2']+$arr1['risk3']+$arr1['risk4']+$arr1['risk5']+$arr1['risk6']+$arr1['risk7']+$arr1['risk8']+$arr1['risk9'];
	
	//if($sum>1){
	
		
		$sql="SELECT * FROM `departments` where code='".$arr2['until']."' and status='y' ";
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

if($arr2['risk2']=='1'){
	$risk="IC";
	$riskCount1++;
}else if ($arr2['risk3']=='1'){
	$risk="MR";
	$riskCount2++;
}else if ($arr2['risk2']=='1' and $arr2['risk3']=='1'){
	$risk="IC,MR";
	$riskCount3++;	
}else{
	$risk="";
}
$dategroup=explode("-",$arr2['nonconf_dategroup']);

if($arr2['return']==1){
	$arr2['return']="�ٹ��س�Ҿ";
}else{
	$arr2['return']="";
}

if($arr2['risk1']=="1"){	
		$showrisk1="1.Clinical Risk , ";
		}else{
		$showrisk1="";
		}
		if($arr2['risk2']=="1"){
		$showrisk2="2.Infection control Risk , ";	
		}else{
		$showrisk2="";
		}
		if($arr2['risk3']=="1"){
		$showrisk3="3.Medication Risk , ";
		}else{
		$showrisk3="";
		}
		if($arr2['risk4']=="1"){
		$showrisk4="4.Medical Equipment Risk , ";
		}else{
		$showrisk4="";
		}
		if($arr2['risk5']=="1"){
		$showrisk5="5.Safety and Environment Risk , ";	
		}else{
		$showrisk5="";
		}
		if($arr2['risk6']=="1"){
		$showrisk6="6.Customer Complaint Risk , ";	
		}else{
		$showrisk6="";
		}
		if($arr2['risk7']=="1"){
		$showrisk7="7.Financial Risk ,";	
		}else{
		$showrisk7="";
		}
		if($arr2['risk8']=="1"){
		$showrisk8="8.Utilization Management Risk , ";
		}else{
		$showrisk8="";
		}
		if($arr2['risk9']=="1"){
		$showrisk9="9.Information Risk ";	
		}else{
		$showrisk9="";
		}
	?>
    <tr bgcolor="<?=$bg;?>">
      <td align="center"><?=$i?></td>
      <td><?=$arr['name']?></td>
      <td><?=$arr2['date1'].($arr2['date2'])?></td>
      <td><?=$dategroup[1].'-'.$dategroup[0]?></td>
      <td><?=$arr2['time']?></td>
      <td><?=$arr2['ncr']?></td>
      <td><?=$arr2['return']?></td>
      <td align="center"><?=$arr1['clinic']?></td>
      <td><?=$showrisk1.$showrisk2.$showrisk3.$showrisk4.$showrisk5.$showrisk6.$showrisk7.$showrisk8.$showrisk9?></td>
      <?
	 if($_SESSION["statusncr"]=='admin'){
	?>
      <td align="center"><a  href="ncf2_edit.php?nonconf_id=<?=$arr2['nonconf_id'];?>" target="_blank">���</a></td>
      <td align="center"><a href="javascript:if(confirm('�׹�ѹ���ź NCR : <?=$arr2['nonconf_id']?>')==true){MM_openBrWindow('ncf_del.php?id=<?=$arr2['nonconf_id']?>','','width=400,height=500')}">ź</a></td>
      <?  } ?>
      <td align="center"><a  href="ncf_print.php?ncr_id=<?=$arr2['nonconf_id'];?>" target="_blank">�����</a></td>
     </tr>
    <?
	}  
	
	//}
	?>
  </table>
<?
/*echo "<BR>IC =".$riskCount1;
echo "<BR>MR=".$riskCount2;

echo "<BR>��� =".$a=$riskCount1+$riskCount2;*/
/*}else{
	echo "<font class=\"forntsarabun\">����բ����Ţͧ $_POST[doctor]  $day  $dateshow</font>";
}*/
?>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>