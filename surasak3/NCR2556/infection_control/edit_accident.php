<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>�ѹ�֡�����š�õԴ������С�õԴ����</title>
</head>
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
<body>
<?
function displaydate($datex) {
	$date_array=explode("-",$datex);
	$y=$date_array[0];
	$m=$date_array[1];
	$d=$date_array[2];
	$displaydate="$d-$m-$y";
	return $displaydate;
}
include("../connect.inc");


$d1=substr($_POST['date1'],0,10);
$d2=substr($_POST['date1'],11);
$datexp=explode("/",$d1);
$date=(($datexp[2])+543).'-'.$datexp[1].'-'.$datexp[0].' '.$d2;


$strsql="UPDATE  `ic_accident` SET  `thidate` =  '".$date."',
`depart` =  '".$_POST['depart']."',
`ptname` =   '".$_POST['ptname']."',
`age` =   '".$_POST['age']."',
`staff` =   '".$_POST['staff']."',
`staff_other` =   '".$_POST['staff_other']."',
`ac_type1` =   '".$_POST['ac_type1']."',
`ac_by` =   '".$_POST['ac_by']."',
`ac_by_detail` =   '".$_POST['ac_by_detail']."',
`ac_type2` =   '".$_POST['ac_type2']."',
`ac_type3` =   '".$_POST['ac_type3']."',
`ac_type4` =   '".$_POST['ac_type4']."',
`ac_type5` =   '".$_POST['ac_type5']."',
`ac_detail` =   '".$_POST['ac_detail']."',
`ac_organ` =   '".$_POST['ac_organ']."',
`first_aid` =   '".$_POST['first_aid']."',
`9hivab` =   '".$_POST['9hivab']."',
`9hivag` =   '".$_POST['9hivag']."',
`9hbsag` =   '".$_POST['9hbsag']."',
`9hbsab` =   '".$_POST['9hbsab']."',
`9history` =   '".$_POST['9history']."',
`ac101` =   '".$_POST['ac101']."',
`ac102` =   '".$_POST['ac102']."',
`ac103` =   '".$_POST['ac103']."',
`ac104` =   '".$_POST['ac104']."',
`11hivab` =  '".$_POST['11hivab']."',
`11hivag` =   '".$_POST['11hivag']."',
`11hbsag` =   '".$_POST['11hbsag']."',
`11hbsab` =  '".$_POST['11hbsab']."',
`11history` =   '".$_POST['11history']."',
`12detail` =   '".$_POST['12detail']."',
`19detail1` =   '".$_POST['19detail1']."',
`19detail2` =   '".$_POST['19detail2']."' WHERE  `row_id` =  '".$_POST['row_id']."' ";
$strresult=mysql_query($strsql)or die(mysql_error());

for($i=1;$i<=3;$i++)
{

$sql="UPDATE  `ic_accident_azt` SET  `hemoglobin` =  '".$_POST["hemoglobin$i"]."',
`hematocrit` =  '".$_POST["hematiocrit$i"]."',
`red_cell` =  '".$_POST["red_cell$i"]."',
`wbc` =  '".$_POST["wbc$i"]."',
`neutrophil` =  '".$_POST["neutrophil$i"]."',
`lymphocyte` = '".$_POST["lymphocyte$i"]."',
`monocytes` =  '".$_POST["monocytes$i"]."',
`basophil` = '".$_POST["basophil$i"]."',
`eosinophil` =  '".$_POST["eosinophil$i"]."',
`band` = '".$_POST["band$i"]."',
`platelet` =  '".$_POST["platelet$i"]."' WHERE  `ref_id` = '".$_POST['row_id']."' and start='".$_POST["day$i"]."' ";
$query=mysql_query($sql)or die(mysql_error());

}
//echo $sql."<br>";
$sql2="UPDATE  `ic_accident_pi` SET  `hiv_ab` =  '".$_POST['blood1']."',
`hiv_ag` =  '".$_POST['blood2']."',
`hbs_ag` =  '".$_POST['blood3']."',
`hbs_ab` =  '".$_POST['blood4']."' WHERE  `ref_id` =  '".$_POST['row_id']."' and after_cbc='�ѻ������ 6' ";
$query2=mysql_query($sql2)or die(mysql_error());

/////////////////////////

$sql3="UPDATE  `ic_accident_pi` SET  `hiv_ab` =  '".$_POST['blood5']."',
`hiv_ag` =  '".$_POST['blood6']."',
`hbs_ag` =  '".$_POST['blood7']."',
`hbs_ab` =  '".$_POST['blood8']."' WHERE  `ref_id` =  '".$_POST['row_id']."' and after_cbc='��͹��� 3' ";
$query3=mysql_query($sql3)or die(mysql_error());

////////////////////////

$sql3="UPDATE  `ic_accident_pi` SET  `hiv_ab` =  '".$_POST['blood9']."',
`hiv_ag` =  '".$_POST['blood10']."',
`hbs_ag` =  '".$_POST['blood11']."',
`hbs_ab` =  '".$_POST['blood12']."' WHERE  `ref_id` =  '".$_POST['row_id']."' and after_cbc='��͹��� 6' ";
$query3=mysql_query($sql3)or die(mysql_error());

/////////////////////

$sql3="UPDATE  `ic_accident_pi` SET  `hiv_ab` =  '".$_POST['blood13']."',
`hiv_ag` =  '".$_POST['blood14']."',
`hbs_ag` =  '".$_POST['blood15']."',
`hbs_ab` =  '".$_POST['blood16']."' WHERE  `ref_id` =  '".$_POST['row_id']."' and after_cbc='��͹��� 12' ";
$query3=mysql_query($sql3)or die(mysql_error());

//
if($strresult){
   		echo "<div id='no_print'>";
		echo "<BR><A HREF=\"report_accident.php\">�ѹ�֡����</A><BR>";
		echo "<BR><A HREF=\"../../nindex.htm\">����</A><BR>";
		echo "<BR>�ѹ�֡���������º��������";
		echo "</div>";
		
		echo "<SCRIPT LANGUAGE='JavaScript'>
				window.onload = function(){
				window.print();
				window.close();
				}
				</SCRIPT>";			
}
?>
<br />
<br />
<h2 class="h" align="center" style="line-height:1px;">�ç��Һ�Ť�������ѡ��������</h2>
<h2 class="h" align="center" style="line-height:1px;"><u>Ẻ��§ҹ������Ѻ�غѵ��˵� ����Ҩ���Ѻ���ͷ��Դ��ͷҧ���ʹ�ͧ�ؤ�ҡ�</u></h2>
<h2 class="h" align="center" style="line-height:1px;">FR-ICC-001/1,01, 10  �.�. 49</h2>
<p align="center" style="line-height:1px;">.............................................................................................</p>

<table border="0" align="center" class="hfont">
    <tr>
      <td>1.</td>
      <td colspan="6">����˹��§ҹ......<?=$_POST['depart'];?>......</td>
    </tr>
    <tr>
      <td>2.</td>
      <td colspan="2" class="sample">���ͺؤ�ҡ�....<?=$_POST['ptname'];?>.....</td>
      <td>����</td>
      <td>
      <?=$_POST['age'];?></td>
      <td>HN</td>
      <td>
      <?=$_POST['hn'];?></td>
    </tr>
    <tr>
      <td>3.</td>
      <td colspan="6">�������ؤ�ҡ�.....<? if($_POST['staff']=="other" ||  $_POST['staff']==""){ echo $_POST['staff_other']; }else{ echo $_POST['staff']; }?></td>
    </tr>
    <tr>
      <td>4.</td>
      <td>�Դ�غѵ��˵�</td>
      <td>�ѹ���</td>
      <td>&nbsp;</td>
      <td><?=$_POST['date1'];?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>5.</td>
      <td colspan="6">�ѡɳ��غѵ��˵�</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="checkbox" name="ac_type1" id="ac_type1" value="1"  <? if($_POST['ac_type1']==1){ echo "checked='checked'"; }?>/>
    �ͧ��������軹���͹���ʹ ������ù�Өҡ��ҧ��¼����� ������ ���ͺҴ</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="radio" name="ac_by" id="ac_by1" value="�մ" checked="checked" <? if($_POST['ac_by']=='�մ'){ echo "checked='checked'"; }?> />
        �մ 
          <input type="radio" name="ac_by" id="ac_by2" value="���"  <? if($_POST['ac_by']=='���'){ echo "checked='checked'"; }?>/>
���
<input type="radio" name="ac_by" id="ac_by3" value="���" <? if($_POST['ac_by']=='���'){ echo "checked='checked'"; }?> />
���
<input type="radio" name="ac_by" id="ac_by4" value="����" <? if($_POST['ac_by']=='����'){ echo "checked='checked'"; }?> />
����
<?=$_POST['ac_by_detail'];?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="checkbox" name="ac_type2" id="ac_type2" value="2"  <? if($_POST['ac_type2']==2){ echo "checked='checked'"; }?>/>���˹ѧ����պҴ�� �����ʶ١���ʹ������ù�Өҡ��ҧ��¼�����
        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="checkbox" name="ac_type3" id="ac_type3" value="3"  <? if($_POST['ac_type3']==3){ echo "checked='checked'"; }?>/>����ͺص� �����������͹ �����ʶ١������ʹ������ù�Өҡ��ҧ��¼�����</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="checkbox" name="ac_type4" id="ac_type4" value="4"  <? if($_POST['ac_type4']==4){ echo "checked='checked'"; }?>/>���� �к� 
        <?=$_POST['ac_type5'];?></td>
    </tr>
    <tr>
      <td>6.</td>
      <td colspan="6">�������ѡɳЧҹ��軯Ժѵ�����غѵ��˵ط���Դ���</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6">
     <?=$_POST['ac_detail']?></td>
    </tr>
    <tr>
      <td>7.</td>
      <td colspan="6">���˹������з����Դ�غѵ��˵�......<?=$_POST['ac_organ']?>.....</td>
    </tr>
    <tr>
      <td>8.</td>
      <td colspan="6">��û����Һ�ŷ�����Ѻ ��� .....<?=$_POST['first_aid']?>.....
      </td>
    </tr>
    <tr>
      <td>9.</td>
      <td colspan="6">������ ���� ������ԡ���ռš�õ�Ǩ���ʹ��л���ѵ�</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.1 HIV Ab  </td>
      <td colspan="5"><input type="radio" name="9hivab" id="9hivab1" value="�ǡ" <? if($_POST['9hivab']=='�ǡ'){ echo "checked='checked'"; }?>/>
      �ǡ 
      <input type="radio" name="9hivab" id="9hivab1" value="ź" <? if($_POST['9hivab']=='ź'){ echo "checked='checked'"; }?>/>
      ź
      <input type="radio" name="9hivab" id="9hivab1" value="����Һ" <? if($_POST['9hivab']=='����Һ'){ echo "checked='checked'"; }?>/>
����Һ 
<input type="radio" name="9hivab" id="9hivab1" value="������Ǩ" <? if($_POST['9hivab']=='������Ǩ'){ echo "checked='checked'"; }?>/>
������Ǩ
</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.2 HIV Ag</td>
      <td colspan="5"><input type="radio" name="9hivag" id="9hivag1" value="�ǡ"  <? if($_POST['9hivag']=='�ǡ'){ echo "checked='checked'"; }?>/>
�ǡ
<input type="radio" name="9hivag" id="9hivag1" value="ź" <? if($_POST['9hivag']=='ź'){ echo "checked='checked'"; }?>/>
ź
<input type="radio" name="9hivag" id="9hivag1" value="����Һ" <? if($_POST['9hivag']=='����Һ'){ echo "checked='checked'"; }?>/>
����Һ
<input type="radio" name="9hivag" id="9hivag1" value="������Ǩ" <? if($_POST['9hivag']=='������Ǩ'){ echo "checked='checked'"; }?>/>

������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.3 HBs Ag</td>
      <td colspan="5"><input type="radio" name="9hbsag" id="9hbsag1" value="�ǡ" <? if($_POST['9hbsag']=='�ǡ'){ echo "checked='checked'"; }?> />

�ǡ
<input type="radio" name="9hbsag" id="9hbsag1" value="ź"  <? if($_POST['9hbsag']=='ź'){ echo "checked='checked'"; }?> />

ź
<input type="radio" name="9hbsag" id="9hbsag1" value="����Һ"<? if($_POST['9hbsag']=='����Һ'){ echo "checked='checked'"; }?>  />

����Һ
<input type="radio" name="9hbsag" id="9hbsag1" value="������Ǩ" <? if($_POST['9hbsag']=='������Ǩ'){ echo "checked='checked'"; }?> />

������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.4 HBs Ab</td>
      <td colspan="5"><input type="radio" name="9hbsab" id="9hbsab1" value="�ǡ" <? if($_POST['9hbsag']=='�ǡ'){ echo "checked='checked'"; }?> />

�ǡ
<input type="radio" name="9hbsab" id="9hbsab1" value="ź"  <? if($_POST['9hbsab']=='ź'){ echo "checked='checked'"; }?>/>

ź
<input type="radio" name="9hbsab" id="9hbsab1" value="����Һ" <? if($_POST['9hbsab']=='����Һ'){ echo "checked='checked'"; }?>/>

����Һ
<input type="radio" name="9hbsab" id="9hbsab1" value="������Ǩ"<? if($_POST['9hbsab']=='������Ǩ'){ echo "checked='checked'"; }?> />

������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.5 ����ѵԾĵԡ�������§</td>
      <td colspan="5"><input type="radio" name="9history" id="9history1" value="��"  <? if($_POST['9history']=='��'){ echo "checked='checked'"; }?>/>
��
<input type="radio" name="9history" id="9history1" value="�����"  <? if($_POST['9history']=='�����'){ echo "checked='checked'"; }?>/>
�����
<input type="radio" name="9history" id="9history1" value="����Һ" <? if($_POST['9history']=='����Һ'){ echo "checked='checked'"; }?>/>
����Һ
<input type="radio" name="9history" id="9history1" value="������Ǩ" <? if($_POST['9history']=='������Ǩ'){ echo "checked='checked'"; }?>/>
������Ǩ </td>
    </tr>
    <tr>
      <td>10.</td>
      <td>�ؤ�ҡ� ��Һ�֧��ʹ� ������� �ͧ��õ�Ǩ���ʹ        </td>
      <td colspan="5">
       <input type="radio" name="ac101" id="ac1011" value="��" <? if($_POST['ac101']=='��'){ echo "checked='checked'"; }?> />
        ��
        <input type="radio" name="ac101" id="ac1012" value="�����" <? if($_POST['ac101']=='�����'){ echo "checked='checked'"; }?>/>
        �����
        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>�ؤ�ҡ� �Թ�����������Ǩ���ʹ      </td>
      <td colspan="5">
       <input type="radio" name="ac102" id="ac1021" value="��" <? if($_POST['ac102']=='��'){ echo "checked='checked'"; }?>/>
        ��
        <input type="radio" name="ac102" id="ac1022" value="�����" <? if($_POST['ac102']=='�����'){ echo "checked='checked'"; }?> />
        ����� 
</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>�ؤ�ҡ� �Թ���ѡ�Ң�鹵� ���ͻ�ͧ�ѹ��õԴ���� HIV 
</td>
      <td colspan="5">
      <input type="radio" name="ac103" id="ac1031" value="��"  <? if($_POST['ac103']=='��'){ echo "checked='checked'"; }?>/>
        ��
        <input type="radio" name="ac103" id="ac1032" value="�����"  <? if($_POST['ac103']=='�����'){ echo "checked='checked'"; }?>/>
        ����� </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>�ؤ�ҡ� �Թ���ѡ�Ң�鹵� ���ͻ�ͧ�ѹ��õԴ���� Hepatitis B</td>
      <td colspan="5">
    <input type="radio" name="ac104" id="ac1041" value="��"  <? if($_POST['ac104']=='��'){ echo "checked='checked'"; }?>/>
        ��
        <input type="radio" name="ac104" id="ac1042" value="�����"  <? if($_POST['ac104']=='�����'){ echo "checked='checked'"; }?>/>
        ����� </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>ŧ����.....................................................( �ؤ�ҡ� )</td>
      <td colspan="5">ŧ����..................................................( ᾷ������� )</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(.................................................) </td>
      <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(.................................................) </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="5">ŧ����................................................( ����ӹ�¡�� </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(.................................................) </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>11.</td>
      <td>�ؤ�ҡ÷���ռš�õ�Ǩ���ʹ��л���ѵ�</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.1 HIV Ab</td>
      <td colspan="5"><input type="radio" name="11hivab" id="11hivab1" value="�ǡ"   <? if($_POST['11hivab']=='�ǡ'){ echo "checked='checked'"; }?>/>
�ǡ
  <input type="radio" name="11hivab" id="11hivab2" value="ź"  <? if($_POST['11hivab']=='ź'){ echo "checked='checked'"; }?>/>
ź
<input type="radio" name="11hivab" id="11hivab3" value="����Һ"  <? if($_POST['11hivab']=='����Һ'){ echo "checked='checked'"; }?> />
����Һ
<input type="radio" name="11hivab" id="11hivab4" value="������Ǩ"   <? if($_POST['11hivab']=='������Ǩ'){ echo "checked='checked'"; }?>/>
������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.2 HIV Ag</td>
      <td colspan="5"><input type="radio" name="11hivag" id="11hivag1" value="�ǡ"  <? if($_POST['11hivag']=='�ǡ'){ echo "checked='checked'"; }?>/>
�ǡ
  <input type="radio" name="11hivag" id="11hivag2" value="ź" <? if($_POST['11hivag']=='ź'){ echo "checked='checked'"; }?>/>
ź
<input type="radio" name="11hivag" id="11hivag3" value="����Һ"  <? if($_POST['11hivag']=='����Һ'){ echo "checked='checked'"; }?>/>
����Һ
<input type="radio" name="11hivag" id="11hivag4" value="������Ǩ"  <? if($_POST['11hivag']=='������Ǩ'){ echo "checked='checked'"; }?>/>
������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.3 HBs Ag</td>
      <td colspan="5"><input type="radio" name="11hbsag" id="11hbsag1" value="�ǡ" <? if($_POST['11hbsag']=='�ǡ'){ echo "checked='checked'"; }?>/>
�ǡ
  <input type="radio" name="11hbsag" id="11hbsag2" value="ź" <? if($_POST['11hbsag']=='ź'){ echo "checked='checked'"; }?> />
ź
<input type="radio" name="11hbsag" id="11hbsag3" value="����Һ"  <? if($_POST['11hbsag']=='����Һ'){ echo "checked='checked'"; }?>/>
����Һ
<input type="radio" name="11hbsag" id="11hbsag4" value="������Ǩ"  <? if($_POST['11hbsag']=='������Ǩ'){ echo "checked='checked'"; }?>/>
������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.4 HBs Ab</td>
      <td colspan="5"><input type="radio" name="11hbsab" id="11hbsab1" value="�ǡ"  <? if($_POST['11hbsab']=='�ǡ'){ echo "checked='checked'"; }?>/>
�ǡ
  <input type="radio" name="11hbsab" id="11hbsab2" value="ź"  <? if($_POST['11hbsab']=='ź'){ echo "checked='checked'"; }?>/>
ź
<input type="radio" name="11hbsab" id="11hbsab3" value="����Һ" <? if($_POST['11hbsab']=='����Һ'){ echo "checked='checked'"; }?> />
����Һ
<input type="radio" name="11hbsab" id="11hbsab4" value="������Ǩ"  <? if($_POST['11hbsab']=='������Ǩ'){ echo "checked='checked'"; }?>/>
������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.5 ����ѵԾĵԡ�������§</td>
      <td colspan="5"><input type="radio" name="11history" id="11history1" value="��"  <? if($_POST['11history']=='��'){ echo "checked='checked'"; }?>/>
��
  <input type="radio" name="11history" id="11history2" value="�����"  <? if($_POST['11history']=='�����'){ echo "checked='checked'"; }?>/>
�����
<input type="radio" name="11history" id="11history3" value="����Һ"  <? if($_POST['11history']=='����Һ'){ echo "checked='checked'"; }?>/>
����Һ
<input type="radio" name="11history" id="11history4" value="������Ǩ" <? if($_POST['11history']=='������Ǩ'){ echo "checked='checked'"; }?>/>
������Ǩ </td>
    </tr>
    <tr>
      <td>12.</td>
      <td>�ؤ�ҡ����Ѻ����ѡ�����ͻ�ͧ�ѹ��õԴ���� ���</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><?=$_POST['12detail'];?></td>
    </tr>
    <tr>
      <td>13.</td>
      <td colspan="6">㹡ó����� AZT �š�õ�Ǩ���ʹ</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6">13.1 �������������Ѻ�� ( day 0 )</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>Hemoglobin</td>
          <td><?=$_POST['hemoglobin1']?>
            mg % </td>
          <td>Hematiocrit
            <?=$_POST['hematiocrit1']?>
            vol%</td>
          </tr>
        <tr>
          <td>Red cell morphology</td>
          <td colspan="2"><?=$_POST['red_cell1']?></td>
          </tr>
        <tr>
          <td>WBC Count</td>
          <td colspan="2"><?=$_POST['wbc1']?>
            per cu.mm.</td>
          </tr>
        <tr>
          <td>Neutrophil</td>
          <td><?=$_POST['neutrophil1']?>
            %</td>
          <td>Lymphocyte 
<?=$_POST['lymphocyte1']?>
            %</td>
        </tr>
        <tr>
          <td>Monocytes
            &nbsp; </td>
          <td><?=$_POST['monocytes1']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Basophil</td>
          <td><?=$_POST['basophil1']?>
            %</td>
          <td>Eosinophil 
            <?=$_POST['eosinophil1']?>
            %</td>
        </tr>
        <tr>
          <td>Band Form</td>
          <td><?=$_POST['band1']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Platelet Count</td>
          <td colspan="2"><?=$_POST['platelet1']?>
per cu.mm.</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6">13.2 ��������Ѻ������ 14 �ѹ ( day 14 )</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>Hemoglobin</td>
          <td><?=$_POST['hemoglobin2']?>
            mg % </td>
          <td>Hematiocrit
            <?=$_POST['hematiocrit2']?>
            vol%</td>
        </tr>
        <tr>
          <td>Red cell morphology</td>
          <td colspan="2"><?=$_POST['red_cell2']?></td>
        </tr>
        <tr>
          <td>WBC Count</td>
          <td colspan="2"><?=$_POST['wbc2']?>
            per cu.mm.</td>
        </tr>
        <tr>
          <td>Neutrophil</td>
          <td><?=$_POST['neutrophil2']?>
            %</td>
          <td>Lymphocyte
            <?=$_POST['lymphocyte2']?>
            %</td>
        </tr>
        <tr>
          <td>Monocytes
            &nbsp; </td>
          <td><?=$_POST['monocytes2']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Basophil</td>
          <td><?=$_POST['basophil2']?>
            %</td>
          <td>Eosinophil
            <?=$_POST['eosinophil2']?>
            %</td>
        </tr>
        <tr>
          <td>Band Form</td>
          <td><?=$_POST['band2']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Platelet Count</td>
          <td colspan="2"><?=$_POST['platelet2']?>
            per cu.mm.</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6">13.3 ��������Ѻ������ 28 �ѹ ( day 14 )</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>Hemoglobin</td>
          <td><?=$_POST['hemoglobin3']?>
            mg % </td>
          <td>Hematiocrit
            <?=$_POST['hematiocrit3']?>
            vol%</td>
        </tr>
        <tr>
          <td>Red cell morphology</td>
          <td colspan="2"><?=$_POST['red_cell3']?></td>
        </tr>
        <tr>
          <td>WBC Count</td>
          <td colspan="2"><?=$_POST['wbc3']?>
            per cu.mm.</td>
        </tr>
        <tr>
          <td>Neutrophil</td>
          <td><?=$_POST['neutrophil3']?>
            %</td>
          <td>Lymphocyte
            <?=$_POST['lymphocyte3']?>
            %</td>
        </tr>
        <tr>
          <td>Monocytes
            &nbsp; </td>
          <td><?=$_POST['monocytes3']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Basophil</td>
          <td><?=$_POST['basophil3']?>
            %</td>
          <td>Eosinophil
            <?=$_POST['eosinophil3']?>
            %</td>
        </tr>
        <tr>
          <td>Band Form</td>
          <td><?=$_POST['band3']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Platelet Count</td>
          <td colspan="2"><?=$_POST['platelet3']?>
            per cu.mm.</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>14.</td>
      <td colspan="6">.㹡óշ������ PI IDV ��ͧ��Ǩ UA </td>
    </tr>
    <tr>
      <td>15.</td>
      <td colspan="6">�š�õ�Ǩ���ʹ�ؤ�ҡ���ѻ������ 6 ��ѧ�Դ�غѵ��˵�</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.1 HIV Ab</td>
      <td colspan="5"><input type="radio" name="blood1" id="blood1" value="�ǡ" <? if($_POST['blood1']=='�ǡ'){ echo "checked='checked'"; }?>  />
        �ǡ
        <input type="radio" name="blood1" id="blood1" value="ź"  <? if($_POST['blood1']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood1" id="blood1" value="����Һ" <? if($_POST['blood1']=='����Һ'){ echo "checked='checked'"; }?> />
        ����Һ
  <input type="radio" name="blood1" id="blood1" value="������Ǩ"  <? if($_POST['blood1']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.2 HIV Ag</td>
      <td colspan="5"><input type="radio" name="blood2" id="blood1" value="�ǡ"  <? if($_POST['blood2']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood2" id="blood1" value="ź"  <? if($_POST['blood2']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood2" id="blood1" value="����Һ"  <? if($_POST['blood2']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood2" id="blood1" value="������Ǩ" <? if($_POST['blood2']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.3 HBs Ag</td>
      <td colspan="5"><input type="radio" name="blood3" id="11hbsag1" value="�ǡ"  <? if($_POST['blood3']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood3" id="11hbsag2" value="ź"  <? if($_POST['blood3']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood3" id="11hbsag3" value="����Һ"  <? if($_POST['blood3']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood3" id="11hbsag4" value="������Ǩ" <? if($_POST['blood3']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.4 HBs Ab</td>
      <td colspan="5"><input type="radio" name="blood4" id="11hivab1" value="�ǡ"  <? if($_POST['blood4']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood4" id="11hivab2" value="ź" <? if($_POST['blood4']=='ź'){ echo "checked='checked'"; }?> />
        ź
  <input type="radio" name="blood4" id="11hivab3" value="����Һ"  <? if($_POST['blood4']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood4" id="11hivab4" value="������Ǩ"  <? if($_POST['blood4']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>16</td>
      <td>�š�õ�Ǩ���ʹ�ؤ�ҡ����͹��� 3 ��ѧ�Դ�غѵ��˵�</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.1 HIV Ab</td>
      <td colspan="5"><input type="radio" name="blood5" id="11hivab1" value="�ǡ" <? if($_POST['blood5']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood5" id="11hivab2" value="ź" <? if($_POST['blood5']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood5" id="11hivab3" value="����Һ" <? if($_POST['blood5']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood5" id="11hivab4" value="������Ǩ" <? if($_POST['blood5']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.2 HIV Ag</td>
      <td colspan="5"><input type="radio" name="blood6" id="11hivab1" value="�ǡ" <? if($_POST['blood6']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood6" id="11hivab2" value="ź" <? if($_POST['blood6']=='ź'){ echo "checked='checked'"; }?> />
        ź
  <input type="radio" name="blood6" id="11hivab3" value="����Һ" <? if($_POST['blood6']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood6" id="11hivab4" value="������Ǩ" <? if($_POST['blood6']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.3 HBs Ag</td>
      <td colspan="5"><input type="radio" name="blood7" id="11hivab1" value="�ǡ" <? if($_POST['blood7']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood7" id="11hivab2" value="ź"  <? if($_POST['blood7']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood7" id="11hivab3" value="����Һ"  <? if($_POST['blood7']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood7" id="11hivab4" value="������Ǩ" <? if($_POST['blood7']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.4 HBs Ab</td>
      <td colspan="5"><input type="radio" name="blood8" id="11hivab1" value="�ǡ" <? if($_POST['blood8']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood8" id="11hivab2" value="ź" <? if($_POST['blood8']=='ź'){ echo "checked='checked'"; }?> />
        ź
  <input type="radio" name="blood8" id="11hivab3" value="����Һ" <? if($_POST['blood8']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood8" id="11hivab4" value="������Ǩ"  <? if($_POST['blood8']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>17.</td>
      <td>�š�õ�Ǩ���ʹ�ؤ�ҡ����͹��� 6 ��ѧ�Դ�غѵ��˵�</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.1 HIV Ab</td>
      <td colspan="5"><input type="radio" name="blood9" id="11hivab1" value="�ǡ" <? if($_POST['blood9']=='�ǡ'){ echo "checked='checked'"; }?> />
        �ǡ
        <input type="radio" name="blood9" id="11hivab2" value="ź" <? if($_POST['blood9']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood9" id="11hivab3" value="����Һ" <? if($_POST['blood9']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood9" id="11hivab4" value="������Ǩ" <? if($_POST['blood9']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.2 HIV Ag</td>
      <td colspan="5"><input type="radio" name="blood10" id="11hivab1" value="�ǡ"  <? if($_POST['blood10']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood10" id="11hivab2" value="ź" <? if($_POST['blood10']=='ź'){ echo "checked='checked'"; }?> />
        ź
  <input type="radio" name="blood10" id="11hivab3" value="����Һ"  <? if($_POST['blood10']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood10" id="11hivab4" value="������Ǩ" <? if($_POST['blood10']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.3 HBs Ag</td>
      <td colspan="5"><input type="radio" name="blood11" id="11hivab1" value="�ǡ" <? if($_POST['blood11']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood11" id="11hivab2" value="ź" <? if($_POST['blood11']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood11" id="11hivab3" value="����Һ" <? if($_POST['blood11']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood11" id="11hivab4" value="������Ǩ" <? if($_POST['blood11']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.4 HBs Ab</td>
      <td colspan="5"><input type="radio" name="blood12" id="11hivab1" value="�ǡ" <? if($_POST['blood12']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood12" id="11hivab2" value="ź" <? if($_POST['blood12']=='ź'){ echo "checked='checked'"; }?>/>
        ź
  <input type="radio" name="blood12" id="11hivab3" value="����Һ" <? if($_POST['blood12']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
  <input type="radio" name="blood12" id="11hivab4" value="������Ǩ" <? if($_POST['blood12']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>18.</td>
      <td>�š�õ�Ǩ���ʹ�ؤ�ҡ����͹��� 12 ��ѧ�Դ�غѵ��˵�</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.1 HIV Ab</td>
      <td colspan="5"><input type="radio" name="blood13" id="11hivab17" value="�ǡ"  <? if($_POST['blood13']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood13" id="11hivab18" value="ź" <? if($_POST['blood13']=='ź'){ echo "checked='checked'"; }?>/>
        ź
        <input type="radio" name="blood13" id="11hivab19" value="����Һ" <? if($_POST['blood13']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
        <input type="radio" name="blood13" id="11hivab20" value="������Ǩ" <? if($_POST['blood13']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.2 HIV Ag</td>
      <td colspan="5"><input type="radio" name="blood14" id="11hivab13" value="�ǡ" <? if($_POST['blood14']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood14" id="11hivab14" value="ź" <? if($_POST['blood14']=='ź'){ echo "checked='checked'"; }?>/>
        ź
        <input type="radio" name="blood14" id="11hivab15" value="����Һ" <? if($_POST['blood14']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
        <input type="radio" name="blood14" id="11hivab16" value="������Ǩ" <? if($_POST['blood14']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.3 HBs Ag</td>
      <td colspan="5"><input type="radio" name="blood15" id="11hivab9" value="�ǡ" <? if($_POST['blood15']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood15" id="11hivab10" value="ź" <? if($_POST['blood15']=='ź'){ echo "checked='checked'"; }?>/>
        ź
        <input type="radio" name="blood15" id="11hivab11" value="����Һ" <? if($_POST['blood15']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
        <input type="radio" name="blood15" id="11hivab12" value="������Ǩ"<? if($_POST['blood15']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.4 HBs Ab</td>
      <td colspan="5"><input type="radio" name="blood16" id="11hivab5" value="�ǡ"  <? if($_POST['blood16']=='�ǡ'){ echo "checked='checked'"; }?>/>
        �ǡ
        <input type="radio" name="blood16" id="11hivab6" value="ź"<? if($_POST['blood16']=='ź'){ echo "checked='checked'"; }?>/>
        ź
        <input type="radio" name="blood16" id="11hivab7" value="����Һ" <? if($_POST['blood16']=='����Һ'){ echo "checked='checked'"; }?>/>
        ����Һ
        <input type="radio" name="blood16" id="11hivab8" value="������Ǩ" <? if($_POST['blood16']=='������Ǩ'){ echo "checked='checked'"; }?>/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><table border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td><strong>�����˵</strong></td>
          <td>1.�ó���ش�ҡ�͹�ú 6 �ѻ���� ���� </td>
          <td><?=$_POST['19detail1'];?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="top">2. ����</td>
          <td></textarea><?=$_POST['19detail2'];?></td>
        </tr>
      </table></td>
    </tr>
  </table>

</body>
</html>