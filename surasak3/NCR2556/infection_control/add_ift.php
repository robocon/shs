<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>�к���§ҹ�˵ء�ó��Ӥѭ/�غѵԡ�ó�/��������ʹ���ͧ</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="../menu.css" rel="stylesheet" />
    <script type="text/javascript" src="../jquery.js"></script>
    <script type="text/javascript" src="../menu.js"></script>
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
        <li><a href="infection_control/report_ift.php" class="parent"><span>Ẻ�ѹ�֡��õԴ������С�õԴ����</span></a></li>
        <li><a href="infection_control/report_accident.php" class="parent"><span>Ẻ��§ҹ������Ѻ�غѵ��˵�</span></a></li>
      <?
		if($_SESSION["statusncr"]=='admin'){
	  ?>    
    
    	<li><a href="#"><span>���§ҹ�˵ء�ó��</span></a></li>
        <ul>
		<li class="last"><a href="ncf_list_clinic.php"><span>���§ҹ����ѧ�����ѹ�֡�дѺ�����ع�ç</a></span></li>
        <li class="last"><a href="ncf_list_risk.php"><span>���§ҹ����ѧ�����ѹ�֡��������§</a></span></li>
    	<li class="last"><a href="ncf_listall.php"><span>���§ҹ������</span></a></li>
        </ul>
        <li><a href="#"><span>��§ҹ��ػ</span></a></li>
     	<ul>
	  	<li class="last"><a href="ncr_report_progarm.php"><span>��§ҹ��ػ�غѵԡ�ó��ṡ��������</span></a></li>
        <li class="last"><a href="ncr_report_event.php"><span>��§ҹ��ػ�غѵԡ�ó��ṡ����˵ء�ó�</span></a></li>
        <li class="last"><a href="ncf_report_departall.php"><span>��§ҹ��ػ�غѵԡ�ó��ṡ���Ἱ�</span></a></li>
        <li class="last"><a href="ncr_report_progarmdepart2.php"><span>��§ҹ��ػ��������§����Ἱ�</span></a></li>
        <li class="last"><a href="ncr_report_clinic.php"><span>��§ҹ��ػ�дѺ�����ع�ç</span></a></li>
	  	<li class="last"><a href="ncf_report_depart.php"><span>˹��§ҹ�����§ҹ�غѵԡ�ó�</a></span></li>
        <li class="last"><a href="fha_report_depart.php"><span>��§ҹ��ػ ������Ҵ����͹�ҧ��</a></span></li>
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
       <li><a href="ncr_report_progarmdepart.php"><span>ʶԵԤ�������§�ͧἹ�</span></a></li> 
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
<link rel="stylesheet" type="text/css" href="../style.css" />
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

<?
function displaydate($datex) {
	$date_array=explode("-",$datex);
	$y=$date_array[0];
	$m=$date_array[1];
	$d=$date_array[2];
	$displaydate="$d-$m-$y";
	return $displaydate;
}
//include("../connect.inc");
include("../connect2.php");
//echo $_GET['row_id'];

$registerdate=(date("Y")+543).date("-m-d H:i:s");

$strsql="INSERT INTO  `ic_infection` (registerdate,`an` ,  `hn` ,  `ptname` ,  `age` ,  `ptright` ,  `addate` ,  `dcdate` ,  `tel` ,  `diag1` ,  `diag2` ,  `diag3` ,  `diag4` ,  `disease` ,  `status_dc` ,  `refer_host` ,  `date2` ,  `respirator` ,  `date3` ,  `date4` ,  `surgery` ,  `surgeryor` ,  `date5` ,  `birth` ,  `date6` ,  `procedure`,  `dateproc` ,  `date7` ,  `fever` ,  `date8` ,  `urine` ,  `date9` ,  `abdominal` ,  `date10` ,  `pubis` ,  `date11` ,  `cough` ,  `date12` ,  `wound` ,  `date13` ,  `episiotomy` ,  `date14` ,  `smell` ,`date15` ,`skin` ,`date16`,`initial_diag`)
VALUES ('".$registerdate."','".$_POST['an']."', '".$_POST['hn']."',  '".$_POST['ptname']."', '".$_POST['age']."',  '".$_POST['ptright']."',  '".$_POST['addate']."',  '".$_POST['dcdate']."', '".$_POST['tel']."',  '".$_POST['diag1']."', '".$_POST['diag2']."',  '".$_POST['diag3']."',  '".$_POST['diag4']."', '".$_POST['disease']."',  '".$_POST['status_dc']."', '".$_POST['refer_host']."',  '".$_POST['date2']."', '".$_POST['respirator']."', '".$_POST['date3']."',  '".$_POST['date4']."', '".$_POST['surgery']."',  '".$_POST['surgeryor']."',  '".$_POST['date5']."', '".$_POST['birth']."', '".$_POST['date6']."',  '".$_POST['procedure']."',  '".$_POST['dateproc']."',  '".$_POST['date7']."', '".$_POST['fever']."', '".$_POST['date8']."',  '".$_POST['urine']."',  '".$_POST['date9']."',  '".$_POST['abdominal']."', '".$_POST['date10']."',  '".$_POST['pubis']."',  '".$_POST['date11']."', '".$_POST['cough']."',  '".$_POST['date12']."',  '".$_POST['wound']."','".$_POST['date13']."',  '".$_POST['episiotomy']."', '".$_POST['date14']."', '".$_POST['smell']."',  '".$_POST['date15']."', '".$_POST['skin']."',  '".$_POST['date16']."',  '".$_POST['initial_diag']."')";
$strresult=mysql_query($strsql)or die(mysql_error());

if($strresult){
	echo "<div id='no_print'>";
		//echo "<BR><A HREF=\"report_ift.php\">�ѹ�֡����</A><BR>";
		//echo "<BR><A HREF=\"../../nindex.htm\">����</A><BR>";
		echo "<BR>�ѹ�֡���������º��������";
		echo "</div>";
		
		echo "<SCRIPT LANGUAGE='JavaScript'>
				window.onload = function(){
				window.print();
				window.close();
				}
				</SCRIPT>";
	?>
    <br /><br />
<h2 class="h" align="center" >Ẻ�ѹ�֡��õԴ������С�õԴ������ç��Һ�Ť�������ѡ�������� �ͧ�����¡��������§</h2>
<h3 class="h" align="center" >FR-ICC-001/1,00,1  �.�. 50</h3>
<p align="center">.............................................................................................</p>

<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
  <tr>
    <td>
    
    <table  border="0" align="center" cellpadding="0" cellspacing="0" class="hfont" width="100%">
      <tr>
        <td colspan="8"><strong>�����ŷ���仢ͧ������</strong></td>
      </tr>
      <tr>
        <td><strong>����-ʡ��</strong></td>
        <td><?=$_POST['ptname'];?></td>
        <td><strong>����</strong></td>
        <td><?=$_POST['age'];?></td>
        <td><strong>�Է�ԡ���ѡ��</strong></td>
        <td ><?=$_POST['ptright'];?></td>
        <td><strong>�������Ѿ�� </strong></td>
        <td><?=$_POST['tel'];?></td>
      </tr>
      <tr>
        <td><strong>HN</strong></td>
        <td><?=$_POST['hn'];?></td>
        <td><strong>AN</strong></td>
        <td><?=$_POST['an'];?></td>
        <td><strong>�Ѻ���� �����</strong></td>
        <td><?=$_POST['addate'];?></td>
        <td><strong>��˹��� �����  </strong></td>
        <td><?=$_POST['dcdate'];?></td>
      </tr>
      </table>
      <table width="100%" class="hfont">
      <tr>
        <td colspan="2"><strong>����ԹԨ����ä</strong></td>
        <td colspan="4">1. <?=$_POST['diag1'];?></td>
        <td width="65%">2. <?=$_POST['diag2'];?></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td colspan="4">3. <?=$_POST['diag3'];?></td>
        <td>4. <?=$_POST['diag4'];?></td>
      </tr>
      <tr>
        <td width="11%"><strong>�ä��Шӵ��</strong></td>
        <td colspan="6"><?=$_POST['disease'];?></td>
        </tr>
      <tr>
        <td colspan="6"><strong>����Тͧ����������ͨ�˹���</strong></td>
        <td><strong>
          <label>
            <input name="status_dc" type="radio" id="status_dc1"  value="1"  <? if($_POST['status_dc']==1){ echo "checked='checked'";} ?>/>
          </label>
          </strong>����ó�</td>
      </tr>
      <tr>
        <td colspan="6">&nbsp;</td>
        <td><strong>
          <input type="radio" name="status_dc" id="status_dc2"  value="2" <? if($_POST['status_dc']==2){ echo "checked='checked'";} ?>/>
          </strong>��ͧ��á�ô��ŵ�����ͧ����ҹ</td>
      </tr>
      <tr>
        <td colspan="6">&nbsp;</td>
        <td><strong>
          <input type="radio" name="status_dc" id="status_dc3"  value="3" <? if($_POST['status_dc']==3){ echo "checked='checked'";} ?>/>
        </strong>
          ������Ѻ����ѡ�ҵ�ͷ�� �.�.
          <?=$_POST['refer_host'];?></td>
      </tr>
    </table><br />
    <div class="hfont">��ǹ��� 1 �Ѩ�������§��������Դ��õԴ������ç��Һ�� �ͧ��������¹�� ��� </div>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" class="hfont" style="border-collapse:collapse" bordercolor="#000000">
  <tr>
    <td align="center">�ӴѺ</td>
    <td align="center">�Ѩ�������§</td>
    <td align="center">�ѹ ��͹ ��</td>
  </tr>
  <tr>
    <td align="center">1.</td>
    <td>����������ǹ�������</td>
    <td align="center"><?=displaydate($_POST['date2']);?></td>
  </tr>
  <tr>
    <td align="center">2.</td>
    <td>���������ͧ��������<strong>
<input type="radio" name="respirator" id="Respirator1"  value="��� ET-Tube" <? if($_POST['respirator']=='��� ET-Tube'){ echo "checked='checked'";} ?>/>
</strong>��� ET-Tube<strong>
<input type="radio" name="respirator" id="Respirator2" value="��Ф�" <? if($_POST['respirator']=='��Ф�'){ echo "checked='checked'";} ?> />
</strong> ��Ф�</td>
    <td align="center"><?=displaydate($_POST['date3']);?></td>
  </tr>
  <tr>
    <td align="center">3.</td>
    <td>����ѵԡ�����ѡ�����,���</td>
    <td align="center"><?=displaydate($_POST['date4']);?></td>
  </tr>
  <tr>
    <td align="center">4.</td>
    <td>��ü�ҵѴ....<?=$_POST['surgery'];?>
<input type="radio" name="surgeryor" id="Surgeryor1" value="��� Drain"  <? if($_POST['surgeryor']=='��� Drain'){ echo "checked='checked'";} ?>/>
��� Drain 
<input type="radio" name="surgeryor" id="Surgeryor2" value="������ Drain"  <? if($_POST['surgeryor']=='������ Drain'){ echo "checked='checked'";} ?>/>
������ Drain</td>
    <td align="center"><?=displaydate($_POST['date5']);?></td>
  </tr>
  <tr>
    <td align="center">5.</td>
    <td>��ä�ʹ 
      <input type="radio" name="birth" id="Birth1"  value="C/S"  <? if($_POST['birth']=='C/S'){ echo "checked='checked'";} ?>/>
C/S 
<input type="radio" name="Birth" id="Birth2"  value="N/L" <? if($_POST['birth']=='N/L'){ echo "checked='checked'";} ?>/>
N/L 
<input type="radio" name="birth" id="Birth3"  value="�ѵ����" <? if($_POST['birth']=='�ѵ����'){ echo "checked='checked'";} ?> />
�ѵ����</td>
    <td align="center"><?=displaydate($_POST['date6']);?></td>
  </tr>
  <tr>
    <td align="center">6.</td>
    <td>��÷��ѵ���õ�ҧ�...........................<?=$_POST['procedure'];?></td>
    <td align="center"><?=displaydate($_POST['dateproc']);?></td>
  </tr>
    </table>
<br/>
    <div class="hfont">��ǹ��� 2 �š�õԴ��������� �ѹ���Դ���......<?=displaydate($_POST['date7']);?></div>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" class="hfont" style="border-collapse:collapse;" bordercolor="#000000">
  <tr>
    <td width="7%" align="center">�ӴѺ</td>
    <td width="63%" align="center">�ҡ��</td>
    <td width="5%" align="center">��</td>
    <td width="5%" align="center">�����</td>
    <td width="20%" align="center">�ѹ�����������ҡ��</td>
  </tr>
  <tr>
    <td align="center">1.</td>
    <td>�� �ҡ���� 38 ͧ��������</td>
    <td align="center"><input type="radio" name="fever" id="fever1"  value="1" <? if($_POST['fever']==1){ echo "checked='checked'";} ?>/></td>
    <td align="center"><input type="radio" name="fever" id="fever2"  value="2" <? if($_POST['fever']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($_POST['date8']);?></td>
  </tr>
  <tr>
    <td align="center" valign="top">2.</td>
    <td>������СлԴ�л���<br />�Ǵ��ͧ����<br />���纺���ǳ����˹��</td>
    <td align="center">
    <input type="radio" name="urine" id="Urine1"  value="1"  <? if($_POST['urine']==1){ echo "checked='checked'";} ?>/><br />
    <input type="radio" name="abdominal" id="abdominal1"  value="1" <? if($_POST['abdominal']==1){ echo "checked='checked'";} ?>/><br />
    <input type="radio" name="pubis" id="pubis1"  value="1" <? if($_POST['pubis']==1){ echo "checked='checked'";} ?>/></td>
    <td align="center">
    <input type="radio" name="urine" id="Urine2"  value="2" <? if($_POST['urine']==2){ echo "checked='checked'";} ?>/><br />
    <input type="radio" name="abdominal" id="abdominal2"  value="2" <? if($_POST['abdominal']==2){ echo "checked='checked'";} ?>/><br />
    <input type="radio" name="pubis" id="pubis2"  value="2" <? if($_POST['pubis']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($_POST['date9']);?><br /><?=displaydate($_POST['date10']);?><br /><?=displaydate($_POST['date11']);?></td>
  </tr>
  <tr>
    <td align="center">3.</td>
    <td>�� ������� ������ / �����</td>
    <td align="center"><input type="radio" name="cough" id="cough1"  value="1"  <? if($_POST['cough']==1){ echo "checked='checked'";} ?>/></td>
        <td align="center"><input type="radio" name="cough" id="cough2"  value="2" <? if($_POST['cough']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($_POST['date12']);?></td>
  </tr>
  <tr>
    <td align="center" valign="top">4.</td>
    <td>�ż�ҵѴ �ѡ�ʺ ��� ��˹ͧ<br />����纺�� / ᴧ /�¡ /��˹ͧ<br />
    ��Ӥ�ǻ���ա�������</td>
 <td align="center">
 <input type="radio" name="wound" id="wound1"  value="1" <? if($_POST['wound']==1){ echo "checked='checked'";} ?>/><br />
 <input type="radio" name="episiotomy" id="episiotomy1"  value="1" <? if($_POST['episiotomy']==1){ echo "checked='checked'";} ?>/><br />
 <input type="radio" name="smell" id="smell1"  value="1"/ <? if($_POST['smell']==1){ echo "checked='checked'";} ?>></td>
    <td align="center">
<input type="radio" name="wound" id="wound2"  value="2" <? if($_POST['wound']==2){ echo "checked='checked'";} ?>/><br />
<input type="radio" name="episiotomy" id="episiotomy2"  value="2" <? if($_POST['episiotomy']==2){ echo "checked='checked'";} ?>/><br />
<input type="radio" name="smell" id="smell2"  value="2" <? if($_POST['smell']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($_POST['date13']);?><br /><?=displaydate($_POST['date14']);?><br /><?=displaydate($_POST['date15']);?></td>
  </tr>
  <tr>
    <td align="center" valign="top">5.</td>
    <td>���˹ѧ����ǳ�����ѵ���� ��� ᴧ �ѡ�ʺ ��˹ͧ</td>
    <td align="center"><input type="radio" name="skin" id="skin1"  value="1" <? if($_POST['skin']==1){ echo "checked='checked'";} ?>/></td>
        <td align="center"><input type="radio" name="skin" id="skin2"  value="2" <? if($_POST['skin']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($_POST['date16']);?></td>
  </tr>
    </table>
<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
          <tr class="hfont">
            <td><strong>����ԹԨ������ͧ��</strong></td>
            <td><label>
              <input type="radio" name="initial_diag" id="initial_diag1"  value="1" <? if($_POST['initial_diag']==1){ echo "checked='checked'";} ?>/>
            </label>
              �Ҵ��ҹ�Ҩ��ա�õԴ���ͨҡ�ç��Һ��</td>
        </tr>
          <tr class="hfont">
            <td>&nbsp;</td>
            <td><label>
              <input type="radio" name="initial_diag" id="initial_diag2"  value="0" <? if($_POST['initial_diag']==0){ echo "checked='checked'";} ?>/>
            </label>              ��辺���С�õԴ���ͨҡ��õԴ���������ѧ </td>
        </tr>
      </table>
    
    
    
    </td>
   </tr>
    </table>  
    
	<?
	}else{
		echo "�������ö�ѹ�֡��������";
	}
	
	
	echo "</div>";

?>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>