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
<link type="text/css" href="datepicker/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<link type="text/css" href="datepicker/css/ui-lightness/jquery-ui-timepicker-addon.css" rel="stylesheet" />
<!--		<script type="text/javascript" src="datepicker/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="datepicker/js/jquery-ui-1.8.20.custom.min.js"></script>
     	<script type="text/javascript" src="datepicker/js/jquery-ui-timepicker-addon.js"></script>-->
        
        
        <script type="text/javascript" src="datepicker/js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="datepicker/js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript" src="datepicker/js/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="datepicker/js/jquery-ui-sliderAccess.js"></script>

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
.font{
	font-family:"TH SarabunPSK";
	font-size:18px;
}
</style>
<style type="text/css">
table.sample {
	font-family:"TH SarabunPSK";
	border-width: 2px;
	border-spacing: 1px;
	border-style: none;
	border-color: black;
	border-collapse: collapse;
	background-color: white;
	font-weight:bold;
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

<script type="text/javascript">
		  $(function () {
		    var d = new Date();
		    var toDay =  d.getDate() + '/' + (d.getMonth() + 1) + '/' +  (d.getFullYear());
			

		    $('#date1').datetimepicker({ dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay, dayNames: ['�ҷԵ��', '�ѹ���', '�ѧ���', '�ظ', '����ʺ��', '�ء��', '�����'],
              dayNamesMin: ['��.','�.','�.','�.','��.','�.','�.'],
              monthNames: ['���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�'],
              monthNamesShort: ['�.�.','�.�.','��.�.','��.�.','�.�.','��.�.','�.�.','�.�.','�.�.','�.�.','�.�.','�.�.']});


			});
		</script>
        <style>
		.forntsarabun{
			font-family:"TH SarabunPSK";
			font-size:18px;
		}
		</style>
        

<!--<a href="../../nindex.htm" class="forntsarabun">��Ѻ������ѡ </a>&nbsp;&nbsp;<a href="report_ift.php" class="forntsarabun">Ẻ�ѹ�֡��õԴ������С�õԴ���� � </a>-->

<script language="javascript">
function fncSubmit1(strPage)
{
	if(strPage == "page1")
	{
		document.form1.action="<?=$_SERVER['PHP_SELF'];?>?do=select";
	}
/*	if(document.f1.hn.value==''){
		alert('��س��к� HN ��е�Ǩ�ͺ���¤�Ѻ');
		document.f1.hn.focus();
	}*/
	
	
	document.form1.submit();
}
</script>
<?

include("connect2.php");

if($_REQUEST['do']=='select'){

$sql = "Select * From opcard where hn = '".$_POST["hn"]."' ";

$result = Mysql_Query($sql);	
$row=mysql_num_rows($result);
if($row>0){
$dbarr=mysql_fetch_array($result);

$ptname=$dbarr['yot'].$dbarr['name'].' '.$dbarr['surname'];
global  $ptname;

include("connect.inc");
$mysql="Select * From ic_accident  where hn = '".$_POST["hn"]."' order by regisdate desc limit 1 ";
$myresult = mysql_query($mysql);

	$myrow=mysql_num_rows($myresult);
	if($myrow){
	$myarr=mysql_fetch_array($myresult);
	$action = "edit_accident.php";
	}else{
	$action = "add_accident.php";
	}
}else{
	echo "<script>alert('��辺 HN $_POST[hn]');</script>";
}

}

//if($myarr['staff']=='' ){ echo "��ҧ"; }else{ echo "�դ��".$myarr['staff']; } 

Function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}
?>

<h2 class="h" align="center" >�ç��Һ�Ť�������ѡ��������</h2>
<h2 class="h" align="center" ><u>��§ҹ�غѵԡ�ó� ����Ҩ�ռ����ؤ�ҡ����Ѻ��õԴ���ͨҡ��Ժѵԧҹ</u></h2>
<h2 class="h" align="center" >FR-ICC-001/1,01, 10  �.�. 49</h2>
<p align="center">.............................................................................................</p>
<form id="form1" name="form1" method="post" action="<? echo $action;?>">
  <table border="0" align="center" class="sample">
    <tr>
      <td>&nbsp;</td>
      <td colspan="4">HN 
      <input name="hn" type="text" class="hfont" id="hn"  value="<?=$dbarr['hn']?>"/> <input name="chkhn" type="button" class="font22" id="chkhn" value="��Ǩ�ͺ"  onclick="JavaScript:fncSubmit1('page1')"/></td>
    </tr>
    <tr>
      <td>1.</td>
      <td colspan="4">����˹��§ҹ
      <select name="depart" class="hfont">
      <option value="0">---��س����͡---</option>
      <? 
include("connect.inc");
	  	$sql="select code ,name from departments where status='y'";
	  	    $query=mysql_query($sql);
			while($arr=mysql_fetch_array($query)){
					if($myarr['depart']==$arr['code']){
				echo "<option value='$arr[code]' selected='selected'>$arr[name]</option>";
					}else{
				echo "<option value='$arr[code]'>$arr[name]</option>";	
					}
			}
	  
	  ?>
      </select>
      
      </td>
    </tr>
    <tr>
      <td>2.</td>
      <td colspan="2" class="sample">���ͺؤ�ҡ�
        <input name="ptname" type="text" class="hfont" id="ptname" size="40"  value="<?=$ptname;?>"/></td>
      <td>����</td>
      <td>
      <input name="age" type="text" class="hfont" id="age"  value="<?=calcage($dbarr['dbirth']);?>"/></td>
    </tr>
    <tr>
      <td>3.</td>
      <td colspan="4">�������ؤ�ҡ�</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4">
<input type="radio" name="staff" id="staff1" value="ᾷ��" <? if($myarr['staff']=='ᾷ��'){ echo "checked='checked'"; }?> onClick="javaScript:if(this.checked){document.all.staff_other.style.display='none';}"/>
ᾷ�� 
<input type="radio" name="staff" id="staff2" value="��Һ��" <? if($myarr['staff']=='��Һ��'){ echo "checked='checked'"; }?> onClick="javaScript:if(this.checked){document.all.staff_other.style.display='none';}" />
��Һ��
<input type="radio" name="staff" id="staff3" value="�����¾�Һ��" <? if($myarr['staff']=='�����¾�Һ��'){ echo "checked='checked'"; }?> onClick="javaScript:if(this.checked){document.all.staff_other.style.display='none';}"/>
�����¾�Һ��
<input type="radio" name="staff" id="staff4" value="��ѡ�ҹ���¡�þ�Һ��" <? if($myarr['staff']=='��ѡ�ҹ���¡�þ�Һ��'){ echo "checked='checked'"; }?> onClick="javaScript:if(this.checked){document.all.staff_other.style.display='none';}"/>
��ѡ�ҹ���¡�þ�Һ��
<input type="radio" name="staff" id="staff5" value="other" <?   if($myarr['staff']=='other' ){ echo "checked='checked'"; }?> onClick="javaScript:if(this.checked){document.all.staff_other.style.display='';}" /> 
���� 
<input name="staff_other" type="text" class="hfont" id="staff_other" size="30"  value="<?=$myarr['staff_other'];?>" style="display:none;"/></td>
    </tr>
    <tr>
      <td>4.</td>
      <td colspan="4">�Դ�غѵ��˵� �ѹ���
      <?
	
	if($myarr['thidate']!=''){
$d1=substr($myarr['thidate'],0,10);
$d2=substr($myarr['thidate'],11);
$datexp=explode("-",$d1);
$date=$datexp[2].'/'.$datexp[1].'/'.(($datexp[0])-543).' '.$d2; 

	}
	  ?>
      <input name="date1" type="text" class="hfont" id="date1" value="<?=$date;?>" /> 
      <span class="font">*���͡�ѹ���ҡ��ԷԹ</span></td>
    </tr>
    <tr>
      <td>5.</td>
      <td colspan="4">�ѡɳ��غѵ��˵�</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4" ><input type="checkbox" name="ac_type1" id="ac_type1" value="1" <? if($myarr['ac_type1']==1){ echo "checked='checked'"; }?>/>
    �ͧ��������軹���͹���ʹ ������ù�Өҡ��ҧ��¼����� ������ ���ͺҴ</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4"><input type="radio" name="ac_by" id="ac_by1" value="�մ" <? if($myarr['ac_by']=='�մ'){ echo "checked='checked'"; }?>onClick="javaScript:if(this.checked){document.all.ac_by_detail.style.display='none';}"/>
        �մ 
          <input type="radio" name="ac_by" id="ac_by2" value="���" <? if($myarr['ac_by']=='���'){ echo "checked='checked'"; }?> onClick="javaScript:if(this.checked){document.all.ac_by_detail.style.display='none';}"/>
���
<input type="radio" name="ac_by" id="ac_by3" value="���" <? if($myarr['ac_by']=='���'){ echo "checked='checked'"; }?> onClick="javaScript:if(this.checked){document.all.ac_by_detail.style.display='none';}"/>
���
<input type="radio" name="ac_by" id="ac_by4" value="����" <? if($myarr['ac_by']=='����'){ echo "checked='checked'"; }?> onClick="javaScript:if(this.checked){document.all.ac_by_detail.style.display='';}" />
����
<input name="ac_by_detail" type="text" class="hfont" id="ac_by_detail"  value="<?=$myarr['ac_by_detail'];?>" style="display:none;"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4"><input type="checkbox" name="ac_type2" id="ac_type2" value="2" <? if($myarr['ac_type2']==2){ echo "checked='checked'"; }?>/>���˹ѧ����պҴ�� �����ʶ١���ʹ������ù�Өҡ��ҧ��¼�����
        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4"><input type="checkbox" name="ac_type3" id="ac_type3" value="3"  <? if($myarr['ac_type3']==3){ echo "checked='checked'"; }?> />����ͺص� �����������͹ �����ʶ١������ʹ������ù�Өҡ��ҧ��¼�����</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4"><input type="checkbox" name="ac_type4" id="ac_type4" value="4"  <? if($myarr['ac_type4']==4){ echo "checked='checked'"; }?> onClick="javaScript:if(this.checked){document.all.ac_type5.style.display='';}else{ document.all.ac_type5.style.display='none'; } "/>���� �к� 
        
      <input name="ac_type5" type="text" class="hfont" id="ac_type5"  value="<?=$myarr['ac_type5'];?>" style="display:none;"/></td>
    </tr>
    <tr>
      <td>6.</td>
      <td colspan="4">�������ѡɳЧҹ��軯Ժѵ�����غѵ��˵ط���Դ���</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4">
      <textarea name="ac_detail" cols="45" rows="5" class="hfont" id="ac_detail"><?=$myarr['ac_detail'];?></textarea></td>
    </tr>
    <tr>
      <td>7.</td>
      <td colspan="4">���˹������з���Դ�غѵ��˵�
        <input name="ac_organ" type="text" class="hfont" id="ac_organ" size="50"  value="<?=$myarr['ac_organ'];?>"/></td>
    </tr>
    <tr>
      <td>8.</td>
      <td colspan="4">��û����Һ�ŷ�����Ѻ ��� 
      <input name="first_aid" type="text" class="hfont" id="first_aid" size="50"  value="<?=$myarr['first_aid'];?>"/></td>
    </tr>
    <tr>
      <td>9.</td>
      <td colspan="4">������ ���� ������ԡ���ռš�õ�Ǩ���ʹ��л���ѵ�</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.1 HIV Ab  </td>
      <td colspan="3"><input type="radio" name="9hivab" id="9hivab1" value="�ǡ" <? if($myarr['9hivab']=='�ǡ'){ echo "checked='checked'"; }?>/>
      �ǡ 
      <input type="radio" name="9hivab" id="9hivab2" value="ź" <? if($myarr['9hivab']=='ź'){ echo "checked='checked'"; }?>/>
      ź
      <input type="radio" name="9hivab" id="9hivab2" value="����Һ" <? if($myarr['9hivab']=='����Һ'){ echo "checked='checked'"; }?>/>
����Һ 
<input type="radio" name="9hivab" id="9hivab3" value="������Ǩ" <? if($myarr['9hivab']=='������Ǩ'){ echo "checked='checked'"; }?>/>
������Ǩ
</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.2 HIV Ag</td>
      <td colspan="3"><input type="radio" name="9hivag" id="9hivag1" value="�ǡ" <? if($myarr['9hivag']=='�ǡ'){ echo "checked='checked'"; }?>/>
�ǡ
<input type="radio" name="9hivag" id="9hivag2" value="ź"<? if($myarr['9hivag']=='ź'){ echo "checked='checked'"; }?> />
ź
<input type="radio" name="9hivag" id="9hivag3" value="����Һ"<? if($myarr['9hivag']=='����Һ'){ echo "checked='checked'"; }?> />
����Һ
<input type="radio" name="9hivag" id="9hivag4" value="������Ǩ" <? if($myarr['9hivag']=='������Ǩ'){ echo "checked='checked'"; }?>/>

������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.3 HBs Ag</td>
      <td colspan="3"><input type="radio" name="9hbsag" id="9hbsag1" value="�ǡ" <? if($myarr['9hbsag']=='�ǡ'){ echo "checked='checked'"; }?> />

�ǡ
<input type="radio" name="9hbsag" id="9hbsag2" value="ź" <? if($myarr['9hbsag']=='ź'){ echo "checked='checked'"; }?>/>

ź
<input type="radio" name="9hbsag" id="9hbsag3" value="����Һ" <? if($myarr['9hbsag']=='����Һ'){ echo "checked='checked'"; }?>/>

����Һ
<input type="radio" name="9hbsag" id="9hbsag4" value="������Ǩ" <? if($myarr['9hbsag']=='������Ǩ'){ echo "checked='checked'"; }?>/>

������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.4 HBs Ab</td>
      <td colspan="3"><input type="radio" name="9hbsab" id="9hbsab1" value="�ǡ"  <? if($myarr['9hbsab']=='�ǡ'){ echo "checked='checked'"; }?>/>

�ǡ
<input type="radio" name="9hbsab" id="9hbsab2" value="ź" <? if($myarr['9hbsab']=='ź'){ echo "checked='checked'"; }?>/>

ź
<input type="radio" name="9hbsab" id="9hbsab3" value="����Һ" <? if($myarr['9hbsab']=='����Һ'){ echo "checked='checked'"; }?>/>

����Һ
<input type="radio" name="9hbsab" id="9hbsab4" value="������Ǩ"<? if($myarr['9hbsab']=='������Ǩ'){ echo "checked='checked'"; }?> />

������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.5 ����ѵԾĵԡ�������§</td>
      <td colspan="3"><input type="radio" name="9history" id="9history1" value="��" <? if($myarr['9history']=='��'){ echo "checked='checked'"; }?>/>
��
<input type="radio" name="9history" id="9history2" value="�����" <? if($myarr['9history']=='�����'){ echo "checked='checked'"; }?> />
�����
<input type="radio" name="9history" id="9history3" value="����Һ"<? if($myarr['9history']=='����Һ'){ echo "checked='checked'"; }?>/>
����Һ
<input type="radio" name="9history" id="9history4" value="������Ǩ"<? if($myarr['9history']=='������Ǩ'){ echo "checked='checked'"; }?> />
������Ǩ </td>
    </tr>
    <tr>
      <td>10.</td>
      <td>�ؤ�ҡ� ��Һ�֧��ʹ� ������� �ͧ��õ�Ǩ���ʹ        </td>
      <td colspan="3">
       <input type="radio" name="ac101" id="ac1011" value="��" <? if($myarr['ac101']=='��'){ echo "checked='checked'"; }?> />
        ��
        <input type="radio" name="ac101" id="ac1012" value="�����" <? if($myarr['ac101']=='�����'){ echo "checked='checked'"; }?> />
        �����
        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>�ؤ�ҡ� �Թ�����������Ǩ���ʹ      </td>
      <td colspan="3">
       <input type="radio" name="ac102" id="ac1021" value="��" <? if($myarr['ac102']=='��'){ echo "checked='checked'"; }?>/>
        ��
        <input type="radio" name="ac102" id="ac1022" value="�����"  <? if($myarr['ac102']=='�����'){ echo "checked='checked'"; }?>/>
        ����� 
</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>�ؤ�ҡ� �Թ���ѡ�Ң�鹵� ���ͻ�ͧ�ѹ��õԴ���� HIV 
</td>
      <td colspan="3">
      <input type="radio" name="ac103" id="ac1031" value="��"  <? if($myarr['ac103']=='��'){ echo "checked='checked'"; }?>/>
        ��
        <input type="radio" name="ac103" id="ac1032" value="�����"  <? if($myarr['ac103']=='�����'){ echo "checked='checked'"; }?>/>
        ����� </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>�ؤ�ҡ� �Թ���ѡ�Ң�鹵� ���ͻ�ͧ�ѹ��õԴ���� Hepatitis B</td>
      <td colspan="3">
    <input type="radio" name="ac104" id="ac1041" value="��" <? if($myarr['ac104']=='��'){ echo "checked='checked'"; }?>/>
        ��
        <input type="radio" name="ac104" id="ac1042" value="�����"  <? if($myarr['ac104']=='�����'){ echo "checked='checked'"; }?>/>
        ����� </td>
    </tr>
    <tr>
      <td>11.</td>
      <td>�ؤ�ҡ÷���ռš�õ�Ǩ���ʹ��л���ѵ�</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.1 HIV Ab</td>
      <td colspan="3"><input type="radio" name="11hivab" id="11hivab1" value="�ǡ"  <? if($myarr['11hivab']=='�ǡ'){ echo "checked='checked'"; }?>/>
�ǡ
  <input type="radio" name="11hivab" id="11hivab2" value="ź" <? if($myarr['11hivab']=='ź'){ echo "checked='checked'"; }?>/>
ź
<input type="radio" name="11hivab" id="11hivab3" value="����Һ" <? if($myarr['11hivab']=='����Һ'){ echo "checked='checked'"; }?>/>
����Һ
<input type="radio" name="11hivab" id="11hivab4" value="������Ǩ" <? if($myarr['11hivab']=='������Ǩ'){ echo "checked='checked'"; }?>/>
������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.2 HIV Ag</td>
      <td colspan="3"><input type="radio" name="11hivag" id="11hivag1" value="�ǡ" <? if($myarr['11hivag']=='�ǡ'){ echo "checked='checked'"; }?>/>
�ǡ
  <input type="radio" name="11hivag" id="11hivag2" value="ź" <? if($myarr['11hivag']=='ź'){ echo "checked='checked'"; }?>/>
ź
<input type="radio" name="11hivag" id="11hivag3" value="����Һ" <? if($myarr['11hivag']=='����Һ'){ echo "checked='checked'"; }?>/>
����Һ
<input type="radio" name="11hivag" id="11hivag4" value="������Ǩ" <? if($myarr['11hivag']=='������Ǩ'){ echo "checked='checked'"; }?>/>
������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.3 HBs Ag</td>
      <td colspan="3"><input type="radio" name="11hbsag" id="11hbsag1" value="�ǡ" <? if($myarr['11hbsag']=='�ǡ'){ echo "checked='checked'"; }?>/>
�ǡ
  <input type="radio" name="11hbsag" id="11hbsag2" value="ź"<? if($myarr['11hbsag']=='ź'){ echo "checked='checked'"; }?> />
ź
<input type="radio" name="11hbsag" id="11hbsag3" value="����Һ" <? if($myarr['11hbsag']=='����Һ'){ echo "checked='checked'"; }?>/>
����Һ
<input type="radio" name="11hbsag" id="11hbsag4" value="������Ǩ"<? if($myarr['11hbsag']=='������Ǩ'){ echo "checked='checked'"; }?> />
������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.4 HBs Ab</td>
      <td colspan="3"><input type="radio" name="11hbsab" id="11hbsab1" value="�ǡ" <? if($myarr['11hbsab']=='�ǡ'){ echo "checked='checked'"; }?>/>
�ǡ
  <input type="radio" name="11hbsab" id="11hbsab2" value="ź" <? if($myarr['11hbsab']=='ź'){ echo "checked='checked'"; }?>/>
ź
<input type="radio" name="11hbsab" id="11hbsab3" value="����Һ" <? if($myarr['11hbsab']=='����Һ'){ echo "checked='checked'"; }?>/>
����Һ
<input type="radio" name="11hbsab" id="11hbsab4" value="������Ǩ" <? if($myarr['11hbsab']=='������Ǩ'){ echo "checked='checked'"; }?>/>
������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.5 ����ѵԾĵԡ�������§</td>
      <td colspan="3"><input type="radio" name="11history" id="11history1" value="��" <? if($myarr['11history']=='��'){ echo "checked='checked'"; }?> />
��
  <input type="radio" name="11history" id="11history2" value="�����" <? if($myarr['11history']=='�����'){ echo "checked='checked'"; }?>/>
�����
<input type="radio" name="11history" id="11history3" value="����Һ"<? if($myarr['11history']=='����Һ'){ echo "checked='checked'"; }?>/>
����Һ
<input type="radio" name="11history" id="11history4" value="������Ǩ" <? if($myarr['11history']=='������Ǩ'){ echo "checked='checked'"; }?>/>
������Ǩ </td>
    </tr>
    <tr>
      <td>12.</td>
      <td>�ؤ�ҡ����Ѻ����ѡ�����ͻ�ͧ�ѹ��õԴ���� ���</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4"><textarea name="12detail" cols="45" rows="5" class="hfont" id="12detail"><?=$myarr['12detail'];?></textarea></td>
    </tr>
    <tr>
      <td>13.</td>
      <td colspan="4">㹡ó����� AZT �š�õ�Ǩ���ʹ</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4">13.1 �������������Ѻ�� ( day 0 )</td>
      <?  $sql1="select * from ic_accident_azt where ref_id='".$myarr['row_id']."' and start='day 0' ";
	  		 $result1=mysql_query($sql1);
	 		 $arr1=mysql_fetch_array($result1);

	  ?>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="61">Hemoglobin</td>
          <td width="205"><input type="text" name="hemoglobin1" id="hemoglobin1" value="<?=$arr1['hemoglobin'];?>" class="hfont" /> 
            mg % </td>
          <td width="244">Hematiocrit
            <input type="text" name="hematiocrit1" id="hematiocrit1"   value="<?=$arr1['hematocrit'];?>" class="hfont" />
            vol%</td>
          </tr>
        <tr>
          <td>Red cell morphology</td>
          <td colspan="2"><input name="red_cell1" type="text" id="red_cell1" size="50"  value="<?=$arr1['red_cell'];?>" class="hfont" /></td>
          </tr>
        <tr>
          <td>WBC Count</td>
          <td colspan="2"><input name="wbc1" type="text" id="wbc1" size="50"  value="<?=$arr1['wbc'];?>" class="hfont" /> 
            per cu.mm.</td>
          </tr>
        <tr>
          <td>Neutrophil</td>
          <td><input type="text" name="neutrophil1" id="neutrophil1" value="<?=$arr1['neutrophil'];?>" class="hfont" />
            %</td>
          <td>Lymphocyte 
            <input type="text" name="lymphocyte1" id="lymphocyte1" value="<?=$arr1['lymphocyte'];?>" class="hfont" /> 
            %</td>
        </tr>
        <tr>
          <td>Monocytes
            &nbsp; </td>
          <td><input type="text" name="monocytes1" id="monocytes1" value="<?=$arr1['monocytes'];?>" class="hfont" />
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Basophil</td>
          <td><input type="text" name="basophil1" id="basophil1" value="<?=$arr1['basophil'];?>" class="hfont" />
            %</td>
          <td>Eosinophil 
            <input type="text" name="eosinophil1" id="eosinophil1" value="<?=$arr1['eosinophil'];?>" class="hfont" /> 
            %</td>
        </tr>
        <tr>
          <td>Band Form</td>
          <td><input type="text" name="band1" id="band1" value="<?=$arr1['band'];?>" class="hfont" /> 
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Platelet Count</td>
          <td colspan="2"><input name="platelet1" type="text" id="platelet1" size="50" value="<?=$arr1['platelet'];?>" class="hfont" />
per cu.mm.</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4">13.2 ��������Ѻ������ 14 �ѹ ( day 14 )</td>
      
      <?
	  		$sql2="select * from ic_accident_azt where ref_id='".$myarr['row_id']."' and start='day 14' ";
	  		 $result2=mysql_query($sql2);
	 		 $arr2=mysql_fetch_array($result2);
	  ?>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="61">Hemoglobin</td>
          <td width="205"><input name="hemoglobin2" type="text" class="hfont" id="hemoglobin2"  value="<?=$arr2['hemoglobin'];?>"/> 
            mg % </td>
          <td width="244">Hematiocrit
            <input type="text" name="hematiocrit2" id="hematiocrit2" class="hfont" value="<?=$arr2['hematocrit'];?>"/>
            vol%</td>
          </tr>
        <tr>
          <td>Red cell morphology</td>
          <td colspan="2"><input name="red_cell2" type="text" id="red_cell2" size="50" class="hfont" value="<?=$arr2['red_cell'];?>"/></td>
          </tr>
        <tr>
          <td>WBC Count</td>
          <td colspan="2"><input name="wbc2" type="text" id="wbc2" size="50" class="hfont" value="<?=$arr2['wbc'];?>"/> 
            per cu.mm.</td>
          </tr>
        <tr>
          <td>Neutrophil</td>
          <td><input type="text" name="neutrophil2" id="neutrophil2" class="hfont" value="<?=$arr2['neutrophil'];?>"/>
            %</td>
          <td>Lymphocyte 
            <input type="text" name="lymphocyte2" id="lymphocyte2" class="hfont" value="<?=$arr2['lymphocyte'];?>"/> 
            %</td>
        </tr>
        <tr>
          <td>Monocytes
            &nbsp; </td>
          <td><input type="text" name="monocytes2" id="monocytes2" class="hfont" value="<?=$arr2['monocytes'];?>"/>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Basophil</td>
          <td><input type="text" name="basophil2" id="basophil2" class="hfont" value="<?=$arr2['basophil'];?>"/>
            %</td>
          <td>Eosinophil 
            <input type="text" name="eosinophil2" id="eosinophil2" class="hfont" value="<?=$arr2['eosinophil'];?>"/> 
            %</td>
        </tr>
        <tr>
          <td>Band Form</td>
          <td><input type="text" name="band2" id="band2" class="hfont" value="<?=$arr2['band'];?>"/> 
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Platelet Count</td>
          <td colspan="2"><input name="platelet2" type="text" id="platelet2" size="50" class="hfont" value="<?=$arr2['platelet'];?>"/>
per cu.mm.</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4">13.3 ��������Ѻ������ 28 �ѹ ( day 28 )</td>
      <?
	         $sql3="select * from ic_accident_azt where ref_id='".$myarr['row_id']."' and start='day 28' ";
	  		 $result3=mysql_query($sql3);
	 		 $arr3=mysql_fetch_array($result3);

	  ?>
	 
      
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="61">Hemoglobin</td>
          <td width="205"><input type="text" name="hemoglobin3" id="hemoglobin3" class="hfont" value="<?=$arr3['hemoglobin'];?>"/> 
            mg % </td>
          <td width="244">Hematiocrit
            <input type="text" name="hematiocrit3" id="hematiocrit3" class="hfont" value="<?=$arr3['hematocrit'];?>" />
            vol%</td>
          </tr>
        <tr>
          <td>Red cell morphology</td>
          <td colspan="2"><input name="red_cell3" type="text" id="red_cell3" size="50" class="hfont" value="<?=$arr3['red_cell'];?>" /></td>
          </tr>
        <tr>
          <td>WBC Count</td>
          <td colspan="2"><input name="wbc3" type="text" id="wbc3" size="50" class="hfont" value="<?=$arr3['wbc'];?>"/> 
            per cu.mm.</td>
          </tr>
        <tr>
          <td>Neutrophil</td>
          <td><input type="text" name="neutrophil3" id="neutrophil3" class="hfont" value="<?=$arr3['neutrophil'];?>"/>
            %</td>
          <td>Lymphocyte 
            <input type="text" name="lymphocyte3" id="lymphocyte3" class="hfont" value="<?=$arr3['lymphocyte'];?>"/> 
            %</td>
        </tr>
        <tr>
          <td>Monocytes
            &nbsp; </td>
          <td><input type="text" name="monocytes3" id="monocytes3" class="hfont" value="<?=$arr3['monocytes'];?>" />
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Basophil</td>
          <td><input type="text" name="basophil3" id="basophil3" class="hfont" value="<?=$arr3['basophil'];?>"/>
            %</td>
          <td>Eosinophil 
            <input type="text" name="eosinophil3" id="eosinophil3" class="hfont" value="<?=$arr3['eosinophil'];?>"/> 
            %</td>
        </tr>
        <tr>
          <td>Band Form</td>
          <td><input type="text" name="band3" id="band3" class="hfont" value="<?=$arr3['band'];?>" /> 
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Platelet Count</td>
          <td colspan="2"><input name="platelet3" type="text" id="platelet3" size="50"  class="hfont" value="<?=$arr3['platelet'];?>"/>
per cu.mm.</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td>14.</td>
      <td colspan="4">.㹡óշ������ PI IDV ��ͧ��Ǩ UA </td>
    </tr>
    <tr>
      <td>15.</td>
      <td colspan="4">�š�õ�Ǩ���ʹ�ؤ�ҡ���ѻ������ 6 ��ѧ�Դ�غѵ��˵�</td>
      <?
	         $sql4="select * from ic_accident_pi where ref_id='".$myarr['row_id']."' and after_cbc='�ѻ������ 6' ";
	  		 $result4=mysql_query($sql4);
	 		 $arr4=mysql_fetch_array($result4);

	  ?>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.1 HIV Ab</td>
      <td colspan="3"><input type="radio" name="blood1" id="hivab151" value="�ǡ" <? if($arr4['hiv_ab']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood1" id="hivab151" value="ź"  <? if($arr4['hiv_ab']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood1" id="hivab151" value="����Һ" <? if($arr4['hiv_ab']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood1" id="hivab151" value="������Ǩ" <? if($arr4['hiv_ab']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.2 HIV Ag</td>
      <td colspan="3"><input type="radio" name="blood2" id="hivag152" value="�ǡ"  <? if($arr4['hiv_ag']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood2" id="hivag152" value="ź" <? if($arr4['hiv_ag']=='�ǡ'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood2" id="hivag152" value="����Һ" <? if($arr4['hiv_ag']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood2" id="hivag152" value="������Ǩ" <? if($arr4['hiv_ag']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.3 HBs Ag</td>
      <td colspan="3"><input type="radio" name="blood3" id="hbsag153" value="�ǡ" <? if($arr4['hbs_ag']=='�ǡ'){ echo "checked='checked'"; }?> />
        �ǡ
        <input type="radio" name="blood3" id="hbsag153" value="ź" <? if($arr4['hbs_ag']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood3" id="hbsag153" value="����Һ" <? if($arr4['hbs_ag']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood3" id="hbsag153" value="������Ǩ" <? if($arr4['hbs_ag']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.4 HBs Ab</td>
      <td colspan="3"><input type="radio" name="blood4" id="hbsab154" value="�ǡ" <? if($arr4['hbs_ab']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood4" id="hbsab154" value="ź" <? if($arr4['hbs_ab']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood4" id="hbsab154" value="����Һ" <? if($arr4['hbs_ab']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood4" id="hbsab154" value="������Ǩ"  <? if($arr4['hbs_ab']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>16</td>
      <td>�š�õ�Ǩ���ʹ�ؤ�ҡ����͹��� 3 ��ѧ�Դ�غѵ��˵�</td>
      <?
	         $sql5="select * from ic_accident_pi where ref_id='".$myarr['row_id']."' and after_cbc='��͹��� 3' ";
	  		 $result5=mysql_query($sql5);
	 		 $arr5=mysql_fetch_array($result5);

	  ?>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.1 HIV Ab</td>
      <td colspan="3"><input type="radio" name="blood5" id="hivab161" value="�ǡ" <? if($arr5['hiv_ab']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood5" id="hivab161" value="ź" <? if($arr5['hiv_ab']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood5" id="hivab161" value="����Һ" <? if($arr5['hiv_ab']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood5" id="hivab161" value="������Ǩ" <? if($arr5['hiv_ab']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.2 HIV Ag</td>
      <td colspan="3"><input type="radio" name="blood6" id="hivag162" value="�ǡ" <? if($arr5['hiv_ag']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood6" id="hivag162" value="ź" <? if($arr5['hiv_ag']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood6" id="hivag162" value="����Һ" <? if($arr5['hiv_ag']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood6" id="hivag162" value="������Ǩ" <? if($arr5['hiv_ag']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.3 HBs Ag</td>
      <td colspan="3"><input type="radio" name="blood7" id="hbsag163" value="�ǡ" <? if($arr5['hbs_ag']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood7" id="hbsag163" value="ź"  <? if($arr5['hbs_ag']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood7" id="hbsag163" value="����Һ" <? if($arr5['hbs_ag']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood7" id="hbsag33" value="������Ǩ" <? if($arr5['hbs_ag']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.4 HBs Ab</td>
      <td colspan="3"><input type="radio" name="blood8" id="hbsab164" value="�ǡ"  <? if($arr5['hbs_ab']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood8" id="hbsab164" value="ź" <? if($arr5['hbs_ab']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood8" id="hbsab164" value="����Һ" <? if($arr5['hbs_ab']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood8" id="hbsab164" value="������Ǩ" <? if($arr5['hbs_ab']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>17.</td>
      <td>�š�õ�Ǩ���ʹ�ؤ�ҡ����͹��� 6 ��ѧ�Դ�غѵ��˵�</td>
      <?
	         $sql6="select * from ic_accident_pi where ref_id='".$myarr['row_id']."' and after_cbc='��͹��� 6' ";
	  		 $result6=mysql_query($sql6);
	 		 $arr6=mysql_fetch_array($result6);

	  ?>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.1 HIV Ab</td>
      <td colspan="3"><input type="radio" name="blood9" id="hivab171" value="�ǡ"  <? if($arr6['hiv_ab']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood9" id="hivab171" value="ź"  <? if($arr6['hiv_ab']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood9" id="hivab171" value="����Һ"  <? if($arr6['hiv_ab']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood9" id="hivab171" value="������Ǩ" <? if($arr6['hiv_ab']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.2 HIV Ag</td>
      <td colspan="3"><input type="radio" name="blood10" id="hivag172" value="�ǡ" <? if($arr6['hiv_ag']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood10" id="hivag172" value="ź"  <? if($arr6['hiv_ag']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood10" id="hivag172" value="����Һ" <? if($arr6['hiv_ag']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood10" id="hivag172" value="������Ǩ"  <? if($arr6['hiv_ag']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.3 HBs Ag</td>
      <td colspan="3"><input type="radio" name="blood11" id="hbsag173" value="�ǡ" <? if($arr6['hbs_ag']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood11" id="hbsag173" value="ź" <? if($arr6['hbs_ag']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood11" id="hbsag173" value="����Һ"  <? if($arr6['hbs_ag']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood11" id="hbsag173" value="������Ǩ" <? if($arr6['hbs_ag']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.4 HBs Ab</td>
      <td colspan="3"><input type="radio" name="blood12" id="hbsab174" value="�ǡ" <? if($arr6['hbs_ab']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood12" id="hbsab174" value="ź" <? if($arr6['hbs_ab']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood12" id="hbsab174" value="����Һ"  <? if($arr6['hbs_ab']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood12" id="hbsab174" value="������Ǩ"  <? if($arr6['hbs_ab']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>18.</td>
      <td>�š�õ�Ǩ���ʹ�ؤ�ҡ����͹��� 12 ��ѧ�Դ�غѵ��˵�</td>
      <?
	         $sql7="select * from ic_accident_pi where ref_id='".$myarr['row_id']."' and after_cbc='��͹��� 12' ";
	  		 $result7=mysql_query($sql7);
	 		 $arr7=mysql_fetch_array($result7);

	  ?>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.1 HIV Ab</td>
      <td colspan="3"><input type="radio" name="blood13" id="hivab181" value="�ǡ"  <? if($arr7['hiv_ab']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood13" id="hivab181" value="ź" <? if($arr7['hiv_ab']=='ź'){ echo "checked='checked'"; }?> />
        ź
  <input type="radio" name="blood13" id="hivab181" value="����Һ" <? if($arr7['hiv_ab']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood13" id="hivab181" value="������Ǩ"  <? if($arr7['hiv_ab']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.2 HIV Ag</td>
      <td colspan="3"><input type="radio" name="blood14" id="hivag182" value="�ǡ" <? if($arr7['hiv_ag']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood14" id="hivag182" value="ź" <? if($arr7['hiv_ag']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood14" id="hivag182" value="����Һ" <? if($arr7['hiv_ag']=='����Һ'){ echo "checked='checked'"; }?> />
        ����Һ
  <input type="radio" name="blood14" id="hivag182" value="������Ǩ" <? if($arr7['hiv_ag']=='������Ǩ'){ echo "checked='checked'"; }?> />
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.3 HBs Ag</td>
      <td colspan="3"><input type="radio" name="blood15" id="hbsag183" value="�ǡ"  <? if($arr7['hbs_ag']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood15" id="hbsag183" value="ź"  <? if($arr7['hbs_ag']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood15" id="hbsag183" value="����Һ"  <? if($arr7['hbs_ag']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood15" id="hbsag183" value="������Ǩ"  <? if($arr7['hbs_ag']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.4 HBs Ab</td>
      <td colspan="3"><input type="radio" name="blood16" id="hbsab184" value="�ǡ" <? if($arr7['hbs_ab']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood16" id="hbsab184" value="ź"  <? if($arr7['hbs_ab']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood16" id="hbsab184" value="����Һ"  <? if($arr7['hbs_ab']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood16" id="hbsab184" value="������Ǩ"  <? if($arr7['hbs_ab']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4"><table border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td><strong>�����˵</strong></td>
          <td>1.�ó���ش�ҡ�͹�ú 6 �ѻ���� ���� </td>
          <td><input name="19detail1" type="text" class="hfont" id="19detail1" size="50"  value="<?=$myarr['19detail1'];?>" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="top">2. ����</td>
          <td><textarea name="19detail2" cols="45" rows="5" class="hfont" id="19detail2"><?=$myarr['19detail2'];?></textarea></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="5" align="center"><input name="button" type="submit" class="font22" id="button" value="�ѹ�֡������" />
      <input type="hidden" name="row_id" id="row_id"  value="<?=$myarr['row_id'];?>"/>
      <input type="hidden" name="day1" id="day1"  value="day 0"/>
      <input type="hidden" name="day2" id="day2"  value="day 14"/>
      <input type="hidden" name="day3" id="day3"  value="day 28"/>
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>