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
include("connect.inc");

if(isset($_SESSION["Userncr"])){


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
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<div id="no_print" >
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td  align="right" bgcolor="#FFFFCC">&nbsp;</td>
    <td bgcolor="#FFFFCC" >����</td>
  </tr>
  <tr class="forntsarabun">
    <td width="64"  align="right">���͡��</td>
    <td width="387" >
<!--<select name="m_start" class="forntsarabun">
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
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
    <input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun"></td>
  </tr>
</table>
</form>
</div>
<?
// include("connect.inc");
//if($_POST['submit']=="����"){
	if($_POST['y_start']!=''){
		$date1=($_POST['y_start']);
	}else{
		$date1=(date("Y")+543);
	}


$sqlncr= "CREATE TEMPORARY TABLE ncr SELECT *  FROM  ncr2556  WHERE nonconf_date  like '".$date1."%' ";
$result = Mysql_Query($sqlncr) or die(mysql_error());
			
/////////////////////////////  �������Ἱ�  //////////////////////		

$list01 = array();

	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		

		$selectsql = "SELECT COUNT(*)  FROM    ncr  WHERE nonconf_date  like '".$date1."-".$m."-%' and 
		risk1='1'  and until ='".$_SESSION["Codencr"]."' ";
		$result = mysql_query($selectsql);
		$arr01 = mysql_fetch_array($result);
		array_push($list01,$arr01[0]);
	
		
		
	}

?>

	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
<tr>
  <td rowspan="2" align="center" bgcolor="#00CCFF" class="forntsarabun">
    <p>Ἱ�</p></td>
<td colspan="13" align="center" bgcolor="#00CCFF" class="forntsarabun">�� 
  <?=($date1)?></td>
</tr>
<tr>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">��.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">��.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">��.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">���</td>
</tr>
<? 
// $sql="SELECT  distinct(`until`)as newuntil
// FROM  `ncr2556` 
// WHERE  nonconf_date  like '".$date1."%'
// GROUP  BY until";

$sql = "SELECT `id`,`code`,`name` AS newuntil FROM `departments` WHERE `status` = 'y' ORDER BY `id` ASC";

$query=mysql_query($sql);
while($arruntil=mysql_fetch_assoc($query)){
	// var_dump($arruntil);
	// $sqlname="SELECT name  FROM `departments` WHERE code='".$arruntil['newuntil']."'  ";
	// $queryname=mysql_query($sqlname);
	// $arrname=mysql_fetch_assoc($queryname)
?>
<tr>
<td class="forntsarabun"><?=$arruntil['newuntil']?></td>

<? 
$sum=0;
$sum2=0;
for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		
$selectsql = "SELECT COUNT(*)as count   FROM ncr  WHERE until ='".$arruntil['code']."' and nonconf_date  like '".$date1."-".$m."-%'";

// var_dump($selectsql);

		$result = mysql_query($selectsql);
		$arr01 = mysql_fetch_array($result);
		
 ?>
<? if ($arr01['count']!=0){?>
  <td align="center" class="forntsarabun"><a href="detail_report_progarm.php?y=<?=$date1;?>&m=<?=$m;?>&until=<?=$arruntil['code']?>" target="_blank"><?=$arr01['count'];?></a></td>
 <? 
	}else{
?>
<td align="center" class="forntsarabun"><?=$arr01['count'];?></td>
<?
  }
  $sum+=$arr01['count'];
  $sum2+=$sum;
}
  ?>
  <td align="center" class="forntsarabun"  width="7%"><?=$sum;?></td>
  </tr>

<? 

} 

?>
<tr>
  <td align="center"  class="forntsarabun">���</td>
  <? 

 	 for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		
$selectsql = "SELECT COUNT(*)as count   FROM    ncr  WHERE nonconf_date  like '".$date1."-".$m."-%'"; 	
$result = mysql_query($selectsql);
$arr01 = mysql_fetch_array($result);	
$sum2=0;
		for($a=0;$a<=11;$a++){
		$sum2+=$arr01[$a];
  		}
		$sumall+=$sum2;
  ?>
  
  <td  align="center" bgcolor="#FFFFCC"  class="forntsarabun"><?=$sum2;?></td>
  
  <? 
	
	 } 
  
  ?>
  <td align="center" bgcolor="#FFFFCC" class="forntsarabun"><strong><?=$sumall;?></strong></td>
  </tr>
</table>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>