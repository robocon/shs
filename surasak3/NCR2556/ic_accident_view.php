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
	font-size:16pt;
}
.hfont{
	font-family: "TH SarabunPSK";
	font-size:14pt;
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
//include("../connect.inc");
include("connect.inc");

$sql="SELECT * FROM ic_accident  as a , departments as b WHERE a.depart=b.code and row_id='".$_GET['id']."' ";

$query=mysql_query($sql);
$arr=mysql_fetch_array($query);

?>
<script>

</script>
<h2 class="h" align="center" >�ç��Һ�Ť�������ѡ��������</h2>
<h2 class="h" align="center" ><u>��§ҹ�غѵԡ�ó� ����Ҩ�ռ����ؤ�ҡ����Ѻ��õԴ���ͨҡ��Ժѵԧҹ</u></h2>
<h2 class="h" align="center" >FR-ICC-001/1,01, 10  �.�. 49</h2>
<p align="center" style="line-height:1px;">.............................................................................................</p>

<table border="0" align="center" class="hfont">
    <tr>
      <td>1.</td>
      <td colspan="6">����˹��§ҹ......<?=$arr['name'];?>......</td>
    </tr>
    <tr>
      <td>2.</td>
      <td colspan="6" class="sample">���ͺؤ�ҡ�....<?=$arr['ptname'];?>.....&nbsp;&nbsp;&nbsp;&nbsp;����
      <?=$arr['age'];?>      &nbsp;&nbsp;&nbsp;&nbsp;HN
      <?=$arr['hn'];?></td>
    </tr>
    <tr>
      <td>3.</td>
      <td colspan="6">�������ؤ�ҡ�.....<? if($arr['staff']=="other" ||  $arr['staff']==""){ echo $arr['staff_other']; }else{ echo $arr['staff']; }?></td>
    </tr>
    <tr>
      <td>4.</td>
      <td colspan="6">�Դ�غѵ��˵�&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ѹ���
      <?=$arr['thidate'];?></td>
    </tr>
    <tr>
      <td>5.</td>
      <td colspan="6">�ѡɳ��غѵ��˵�</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="checkbox" name="ac_type1" id="ac_type1" value="1"  disabled="disabled" <? if($arr['ac_type1']==1){ echo "checked='checked'"; }?>/>
    �ͧ��������軹���͹���ʹ ������ù�Өҡ��ҧ��¼����� ������ ���ͺҴ</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="radio" name="ac_by" id="ac_by1"  disabled="disabled" value="�մ" checked="checked" <? if($arr['ac_by']=='�մ'){ echo "checked='checked'"; }?> />
        �մ 
          <input type="radio" name="ac_by" id="ac_by2" value="���"  <? if($arr['ac_by']=='���'){ echo "checked='checked'"; }?> disabled="disabled"/>
���
<input type="radio" name="ac_by" id="ac_by3" value="���" <? if($arr['ac_by']=='���'){ echo "checked='checked'"; }?> disabled="disabled" />
���
<input type="radio" name="ac_by" id="ac_by4" value="����" <? if($arr['ac_by']=='����'){ echo "checked='checked'"; }?> disabled="disabled" />
����
<?=$arr['ac_by_detail'];?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="checkbox" name="ac_type2" id="ac_type2" disabled="disabled" value="2"  <? if($arr['ac_type2']==2){ echo "checked='checked'"; }?>/>���˹ѧ����պҴ�� �����ʶ١���ʹ������ù�Өҡ��ҧ��¼�����
        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="checkbox" name="ac_type3" id="ac_type3" value="3"  disabled="disabled" <? if($arr['ac_type3']==3){ echo "checked='checked'"; }?>/>����ͺص� �����������͹ �����ʶ١������ʹ������ù�Өҡ��ҧ��¼�����</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="checkbox" name="ac_type4" id="ac_type4" value="4"  disabled="disabled" <? if($arr['ac_type4']==4){ echo "checked='checked'"; }?>/>���� �к� 
        <?=$arr['ac_type5'];?></td>
    </tr>
    <tr>
      <td>6.</td>
      <td colspan="6">�������ѡɳЧҹ��軯Ժѵ�����غѵ��˵ط���Դ���</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6">
     <?=$arr['ac_detail']?></td>
    </tr>
    <tr>
      <td>7.</td>
      <td colspan="6">���˹������з����Դ�غѵ��˵�......<?=$arr['ac_organ']?>.....</td>
    </tr>
    <tr>
      <td>8.</td>
      <td colspan="6">��û����Һ�ŷ�����Ѻ ��� .....<?=$arr['first_aid']?>.....
      </td>
    </tr>
    <tr>
      <td>9.</td>
      <td colspan="6">������ ���� ������ԡ���ռš�õ�Ǩ���ʹ��л���ѵ�</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.1 HIV Ab  </td>
      <td colspan="5"><input type="radio" name="9hivab" id="9hivab1" value="�ǡ" <? if($arr['9hivab']=='�ǡ'){ echo "checked='checked'"; }?> disabled="disabled"/>
      �ǡ 
      <input type="radio" name="9hivab" id="9hivab1" value="ź" <? if($arr['9hivab']=='ź'){ echo "checked='checked'"; }?> disabled/>
      ź
      <input type="radio" name="9hivab" id="9hivab1" value="����Һ" <? if($arr['9hivab']=='����Һ'){ echo "checked='checked'"; }?> disabled/>
����Һ 
<input type="radio" name="9hivab" id="9hivab1" value="������Ǩ" <? if($arr['9hivab']=='������Ǩ'){ echo "checked='checked'"; }?> disabled/>
������Ǩ
</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.2 HIV Ag</td>
      <td colspan="5"><input type="radio" name="9hivag" id="9hivag1" value="�ǡ"  <? if($arr['9hivag']=='�ǡ'){ echo "checked='checked'"; }?> disabled/>
�ǡ
<input type="radio" name="9hivag" id="9hivag1" value="ź" <? if($arr['9hivag']=='ź'){ echo "checked='checked'"; }?> disabled/>
ź
<input type="radio" name="9hivag" id="9hivag1" value="����Һ" <? if($arr['9hivag']=='����Һ'){ echo "checked='checked'"; }?> disabled/>
����Һ
<input type="radio" name="9hivag" id="9hivag1" value="������Ǩ" <? if($arr['9hivag']=='������Ǩ'){ echo "checked='checked'"; }?> disabled/>

������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.3 HBs Ag</td>
      <td colspan="5"><input type="radio" name="9hbsag" id="9hbsag1" value="�ǡ" <? if($arr['9hbsag']=='�ǡ'){ echo "checked='checked'"; }?>disabled />

�ǡ
<input type="radio" name="9hbsag" id="9hbsag1" value="ź"  <? if($arr['9hbsag']=='ź'){ echo "checked='checked'"; }?>disabled />

ź
<input type="radio" name="9hbsag" id="9hbsag1" value="����Һ"<? if($arr['9hbsag']=='����Һ'){ echo "checked='checked'"; }?>disabled  />

����Һ
<input type="radio" name="9hbsag" id="9hbsag1" value="������Ǩ" <? if($arr['9hbsag']=='������Ǩ'){ echo "checked='checked'"; }?>disabled />

������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.4 HBs Ab</td>
      <td colspan="5"><input type="radio" name="9hbsab" id="9hbsab1" value="�ǡ" <? if($arr['9hbsag']=='�ǡ'){ echo "checked='checked'"; }?>disabled />

�ǡ
<input type="radio" name="9hbsab" id="9hbsab1" value="ź"  <? if($arr['9hbsab']=='ź'){ echo "checked='checked'"; }?> disabled/>

ź
<input type="radio" name="9hbsab" id="9hbsab1" value="����Һ" <? if($arr['9hbsab']=='����Һ'){ echo "checked='checked'"; }?> disabled/>

����Һ
<input type="radio" name="9hbsab" id="9hbsab1" value="������Ǩ"<? if($arr['9hbsab']=='������Ǩ'){ echo "checked='checked'"; }?> disabled />

������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.5 ����ѵԾĵԡ�������§</td>
      <td colspan="5"><input type="radio" name="9history" id="9history1" value="��"  <? if($arr['9history']=='��'){ echo "checked='checked'"; }?> disabled/>
��
<input type="radio" name="9history" id="9history1" value="�����"  <? if($arr['9history']=='�����'){ echo "checked='checked'"; }?> disabled/>
�����
<input type="radio" name="9history" id="9history1" value="����Һ" <? if($arr['9history']=='����Һ'){ echo "checked='checked'"; }?> disabled/>
����Һ
<input type="radio" name="9history" id="9history1" value="������Ǩ" <? if($arr['9history']=='������Ǩ'){ echo "checked='checked'"; }?> disabled/>
������Ǩ </td>
    </tr>
    <tr>
      <td>10.</td>
      <td>�ؤ�ҡ� ��Һ�֧��ʹ� ������� �ͧ��õ�Ǩ���ʹ        </td>
      <td colspan="5">
       <input type="radio" name="ac101" id="ac1011" value="��" <? if($arr['ac101']=='��'){ echo "checked='checked'"; }?> disabled />
        ��
        <input type="radio" name="ac101" id="ac1012" value="�����" <? if($arr['ac101']=='�����'){ echo "checked='checked'"; }?> disabled/>
        �����
        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>�ؤ�ҡ� �Թ�����������Ǩ���ʹ      </td>
      <td colspan="5">
       <input type="radio" name="ac102" id="ac1021" value="��" <? if($arr['ac102']=='��'){ echo "checked='checked'"; }?> disabled/>
        ��
        <input type="radio" name="ac102" id="ac1022" value="�����" <? if($arr['ac102']=='�����'){ echo "checked='checked'"; }?> disabled />
        ����� 
</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>�ؤ�ҡ� �Թ���ѡ�Ң�鹵� ���ͻ�ͧ�ѹ��õԴ���� HIV 
</td>
      <td colspan="5">
      <input type="radio" name="ac103" id="ac1031" value="��"  <? if($arr['ac103']=='��'){ echo "checked='checked'"; }?> disabled/>
        ��
        <input type="radio" name="ac103" id="ac1032" value="�����"  <? if($arr['ac103']=='�����'){ echo "checked='checked'"; }?> disabled/>
        ����� </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>�ؤ�ҡ� �Թ���ѡ�Ң�鹵� ���ͻ�ͧ�ѹ��õԴ���� Hepatitis B</td>
      <td colspan="5">
    <input type="radio" name="ac104" id="ac1041" value="��"  <? if($arr['ac104']=='��'){ echo "checked='checked'"; }?> disabled/>
        ��
        <input type="radio" name="ac104" id="ac1042" value="�����"  <? if($arr['ac104']=='�����'){ echo "checked='checked'"; }?> disabled/>
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
      <td colspan="5">ŧ����................................................( ����ӹ�¡�� ) </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(.................................................) </td>
    </tr>
   </table>
   <div align="center" style="page-break-after:always;"></div>
  <table border="0" align="center" class="hfont">
    <tr>
      <td>11.</td>
      <td>�ؤ�ҡ÷���ռš�õ�Ǩ���ʹ��л���ѵ�</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.1 HIV Ab</td>
      <td colspan="5"><input type="radio" name="11hivab" id="11hivab1" value="�ǡ"   <? if($arr['11hivab']=='�ǡ'){ echo "checked='checked'"; }?> disabled/>
�ǡ
  <input type="radio" name="11hivab" id="11hivab2" value="ź"  <? if($arr['11hivab']=='ź'){ echo "checked='checked'"; }?>disabled/>
ź
<input type="radio" name="11hivab" id="11hivab3" value="����Һ"  <? if($arr['11hivab']=='����Һ'){ echo "checked='checked'"; }?>  disabled/>
����Һ
<input type="radio" name="11hivab" id="11hivab4" value="������Ǩ"   <? if($arr['11hivab']=='������Ǩ'){ echo "checked='checked'"; }?> disabled/>
������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.2 HIV Ag</td>
      <td colspan="5"><input type="radio" name="11hivag" id="11hivag1" value="�ǡ"  <? if($arr['11hivag']=='�ǡ'){ echo "checked='checked'"; }?> disabled/>
�ǡ
  <input type="radio" name="11hivag" id="11hivag2" value="ź" <? if($arr['11hivag']=='ź'){ echo "checked='checked'"; }?> disabled/>
ź
<input type="radio" name="11hivag" id="11hivag3" value="����Һ"  <? if($arr['11hivag']=='����Һ'){ echo "checked='checked'"; }?> disabled/>
����Һ
<input type="radio" name="11hivag" id="11hivag4" value="������Ǩ"  <? if($arr['11hivag']=='������Ǩ'){ echo "checked='checked'"; }?> disabled/>
������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.3 HBs Ag</td>
      <td colspan="5"><input type="radio" name="11hbsag" id="11hbsag1" value="�ǡ" <? if($arr['11hbsag']=='�ǡ'){ echo "checked='checked'"; }?> disabled/>
�ǡ
  <input type="radio" name="11hbsag" id="11hbsag2" value="ź" <? if($arr['11hbsag']=='ź'){ echo "checked='checked'"; }?> disabled />
ź
<input type="radio" name="11hbsag" id="11hbsag3" value="����Һ"  <? if($arr['11hbsag']=='����Һ'){ echo "checked='checked'"; }?> disabled/>
����Һ
<input type="radio" name="11hbsag" id="11hbsag4" value="������Ǩ"  <? if($arr['11hbsag']=='������Ǩ'){ echo "checked='checked'"; }?> disabled/>
������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.4 HBs Ab</td>
      <td colspan="5"><input type="radio" name="11hbsab" id="11hbsab1" value="�ǡ"  <? if($arr['11hbsab']=='�ǡ'){ echo "checked='checked'"; }?> disabled/>
�ǡ
  <input type="radio" name="11hbsab" id="11hbsab2" value="ź"  <? if($arr['11hbsab']=='ź'){ echo "checked='checked'"; }?> disabled/>
ź
<input type="radio" name="11hbsab" id="11hbsab3" value="����Һ" <? if($arr['11hbsab']=='����Һ'){ echo "checked='checked'"; }?> disabled/>
����Һ
<input type="radio" name="11hbsab" id="11hbsab4" value="������Ǩ"  <? if($arr['11hbsab']=='������Ǩ'){ echo "checked='checked'"; }?> disabled/>
������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.5 ����ѵԾĵԡ�������§</td>
      <td colspan="5"><input type="radio" name="11history" id="11history1" value="��"  <? if($arr['11history']=='��'){ echo "checked='checked'"; }?> disabled/>
��
  <input type="radio" name="11history" id="11history2" value="�����"  <? if($arr['11history']=='�����'){ echo "checked='checked'"; }?> disabled/>
�����
<input type="radio" name="11history" id="11history3" value="����Һ"  <? if($arr['11history']=='����Һ'){ echo "checked='checked'"; }?> disabled/>
����Һ
<input type="radio" name="11history" id="11history4" value="������Ǩ" <? if($arr['11history']=='������Ǩ'){ echo "checked='checked'"; }?>disabled/>
������Ǩ </td>
    </tr>
    <tr>
      <td>12.</td>
      <td>�ؤ�ҡ����Ѻ����ѡ�����ͻ�ͧ�ѹ��õԴ���� ���</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><?=$arr['12detail'];?></td>
    </tr>
    <tr>
      <td>13.</td>
      <td colspan="6">㹡ó����� AZT �š�õ�Ǩ���ʹ</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6">13.1 �������������Ѻ�� ( day 0 )</td>
    </tr>
    <?  $sql1="select * from ic_accident_azt where ref_id='".$arr['row_id']."' and start='day 0' ";
	  		 $result1=mysql_query($sql1);
	 		 $arr1=mysql_fetch_array($result1);

	  ?>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>Hemoglobin</td>
          <td><?=$arr1['hemoglobin1']?>
            mg % </td>
          <td>Hematiocrit
            <?=$arr1['hematiocrit1']?>
            vol%</td>
          </tr>
        <tr>
          <td>Red cell morphology</td>
          <td colspan="2"><?=$arr1['red_cell1']?></td>
          </tr>
        <tr>
          <td>WBC Count</td>
          <td colspan="2"><?=$arr1['wbc1']?>
            per cu.mm.</td>
          </tr>
        <tr>
          <td>Neutrophil</td>
          <td><?=$arr1['neutrophil1']?>
            %</td>
          <td>Lymphocyte 
<?=$arr1['lymphocyte1']?>
            %</td>
        </tr>
        <tr>
          <td>Monocytes
            &nbsp; </td>
          <td><?=$arr1['monocytes1']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Basophil</td>
          <td><?=$arr1['basophil1']?>
            %</td>
          <td>Eosinophil 
            <?=$arr1['eosinophil1']?>
            %</td>
        </tr>
        <tr>
          <td>Band Form</td>
          <td><?=$arr1['band1']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Platelet Count</td>
          <td colspan="2"><?=$arr1['platelet1']?>
per cu.mm.</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6">13.2 ��������Ѻ������ 14 �ѹ ( day 14 )</td>
    </tr>
    <?
	  		$sql2="select * from ic_accident_azt where ref_id='".$arr['row_id']."' and start='day 14' ";
	  		 $result2=mysql_query($sql2);
	 		 $arr2=mysql_fetch_array($result2);
	  ?>

    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>Hemoglobin</td>
          <td><?=$arr2['hemoglobin2']?>
            mg % </td>
          <td>Hematiocrit
            <?=$arr2['hematiocrit2']?>
            vol%</td>
        </tr>
        <tr>
          <td>Red cell morphology</td>
          <td colspan="2"><?=$arr2['red_cell2']?></td>
        </tr>
        <tr>
          <td>WBC Count</td>
          <td colspan="2"><?=$arr2['wbc2']?>
            per cu.mm.</td>
        </tr>
        <tr>
          <td>Neutrophil</td>
          <td><?=$arr2['neutrophil2']?>
            %</td>
          <td>Lymphocyte
            <?=$arr2['lymphocyte2']?>
            %</td>
        </tr>
        <tr>
          <td>Monocytes
            &nbsp; </td>
          <td><?=$arr2['monocytes2']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Basophil</td>
          <td><?=$arr2['basophil2']?>
            %</td>
          <td>Eosinophil
            <?=$arr2['eosinophil2']?>
            %</td>
        </tr>
        <tr>
          <td>Band Form</td>
          <td><?=$arr2['band2']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Platelet Count</td>
          <td colspan="2"><?=$arr2['platelet2']?>
            per cu.mm.</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6">13.3 ��������Ѻ������ 28 �ѹ ( day 14 )</td>
    </tr>
    <?
	         $sql3="select * from ic_accident_azt where ref_id='".$arr['row_id']."' and start='day 28' ";
	  		 $result3=mysql_query($sql3);
	 		 $arr3=mysql_fetch_array($result3);

	  ?>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>Hemoglobin</td>
          <td><?=$arr3['hemoglobin3']?>
            mg % </td>
          <td>Hematiocrit
            <?=$arr3['hematiocrit3']?>
            vol%</td>
        </tr>
        <tr>
          <td>Red cell morphology</td>
          <td colspan="2"><?=$arr3['red_cell3']?></td>
        </tr>
        <tr>
          <td>WBC Count</td>
          <td colspan="2"><?=$arr3['wbc3']?>
            per cu.mm.</td>
        </tr>
        <tr>
          <td>Neutrophil</td>
          <td><?=$arr3['neutrophil3']?>
            %</td>
          <td>Lymphocyte
            <?=$arr3['lymphocyte3']?>
            %</td>
        </tr>
        <tr>
          <td>Monocytes
            &nbsp; </td>
          <td><?=$arr3['monocytes3']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Basophil</td>
          <td><?=$arr3['basophil3']?>
            %</td>
          <td>Eosinophil
            <?=$arr3['eosinophil3']?>
            %</td>
        </tr>
        <tr>
          <td>Band Form</td>
          <td><?=$arr3['band3']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Platelet Count</td>
          <td colspan="2"><?=$arr3['platelet3']?>
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
	         $sql4="select * from ic_accident_pi where ref_id='".$arr['row_id']."' and after_cbc='�ѻ������ 6' ";
	  		 $result4=mysql_query($sql4);
	 		 $arr4=mysql_fetch_array($result4);

	  ?>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.1 HIV Ab</td>
      <td colspan="3"><input type="radio" name="blood1" id="hivab151" value="�ǡ" <? if($arr4['hiv_ab']=='�ǡ'){ echo "checked='checked'"; }?> disabled/>
        �ǡ
        <input type="radio" name="blood1" id="hivab151" value="ź"  <? if($arr4['hiv_ab']=='ź'){ echo "checked='checked'"; }?> disabled/>
        ź
  <input type="radio" name="blood1" id="hivab151" value="����Һ" <? if($arr4['hiv_ab']=='����Һ'){ echo "checked='checked'"; }?> disabled/>
        ����Һ
  <input type="radio" name="blood1" id="hivab151" value="������Ǩ" <? if($arr4['hiv_ab']=='������Ǩ'){ echo "checked='checked'"; }?>disabled/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.2 HIV Ag</td>
      <td colspan="3"><input type="radio" name="blood2" id="hivag152" value="�ǡ"  <? if($arr4['hiv_ag']=='������Ǩ'){ echo "checked='checked'"; }?>disabled/>
        �ǡ
        <input type="radio" name="blood2" id="hivag152" value="ź" <? if($arr4['hiv_ag']=='�ǡ'){ echo "checked='checked'"; }?> disabled/>
        ź
  <input type="radio" name="blood2" id="hivag152" value="����Һ" <? if($arr4['hiv_ag']=='����Һ'){ echo "checked='checked'"; }?> disabled/>
        ����Һ
  <input type="radio" name="blood2" id="hivag152" value="������Ǩ" <? if($arr4['hiv_ag']=='������Ǩ'){ echo "checked='checked'"; }?> disabled/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.3 HBs Ag</td>
      <td colspan="3"><input type="radio" name="blood3" id="hbsag153" value="�ǡ" <? if($arr4['hbs_ag']=='�ǡ'){ echo "checked='checked'"; }?>  disabled/>
        �ǡ
        <input type="radio" name="blood3" id="hbsag153" value="ź" <? if($arr4['hbs_ag']=='ź'){ echo "checked='checked'"; }?>disabled/>
        ź
  <input type="radio" name="blood3" id="hbsag153" value="����Һ" <? if($arr4['hbs_ag']=='����Һ'){ echo "checked='checked'"; }?> disabled/>
        ����Һ
  <input type="radio" name="blood3" id="hbsag153" value="������Ǩ" <? if($arr4['hbs_ag']=='������Ǩ'){ echo "checked='checked'"; }?> disabled/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.4 HBs Ab</td>
      <td colspan="3"><input type="radio" name="blood4" id="hbsab154" value="�ǡ" <? if($arr4['hbs_ab']=='�ǡ'){ echo "checked='checked'"; }?> disabled/>
        �ǡ
        <input type="radio" name="blood4" id="hbsab154" value="ź" <? if($arr4['hbs_ab']=='ź'){ echo "checked='checked'"; }?> disabled/>
        ź
  <input type="radio" name="blood4" id="hbsab154" value="����Һ" <? if($arr4['hbs_ab']=='����Һ'){ echo "checked='checked'"; }?>disabled/>
        ����Һ
  <input type="radio" name="blood4" id="hbsab154" value="������Ǩ"  <? if($arr4['hbs_ab']=='������Ǩ'){ echo "checked='checked'"; }?> disabled/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>16</td>
      <td>�š�õ�Ǩ���ʹ�ؤ�ҡ����͹��� 3 ��ѧ�Դ�غѵ��˵�</td>
      <?
	         $sql5="select * from ic_accident_pi where ref_id='".$arr['row_id']."' and after_cbc='��͹��� 3' ";
	  		 $result5=mysql_query($sql5);
	 		 $arr5=mysql_fetch_array($result5);

	  ?>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.1 HIV Ab</td>
      <td colspan="3"><input type="radio" name="blood5" id="hivab161" value="�ǡ" <? if($arr5['hiv_ab']=='�ǡ'){ echo "checked='checked'"; }?> disabled/>
        �ǡ
        <input type="radio" name="blood5" id="hivab161" value="ź" <? if($arr5['hiv_ab']=='ź'){ echo "checked='checked'"; }?> disabled/>
        ź
  <input type="radio" name="blood5" id="hivab161" value="����Һ" <? if($arr5['hiv_ab']=='����Һ'){ echo "checked='checked'"; }?>disabled/>
        ����Һ
  <input type="radio" name="blood5" id="hivab161" value="������Ǩ" <? if($arr5['hiv_ab']=='������Ǩ'){ echo "checked='checked'"; }?> disabled/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.2 HIV Ag</td>
      <td colspan="3"><input type="radio" name="blood6" id="hivag162" value="�ǡ" <? if($arr5['hiv_ag']=='�ǡ'){ echo "checked='checked'"; }?> disabled/>
        �ǡ
        <input type="radio" name="blood6" id="hivag162" value="ź" <? if($arr5['hiv_ag']=='ź'){ echo "checked='checked'"; }?>disabled/>
        ź
  <input type="radio" name="blood6" id="hivag162" value="����Һ" <? if($arr5['hiv_ag']=='����Һ'){ echo "checked='checked'"; }?> disabled/>
        ����Һ
  <input type="radio" name="blood6" id="hivag162" value="������Ǩ" <? if($arr5['hiv_ag']=='������Ǩ'){ echo "checked='checked'"; }?> disabled/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.3 HBs Ag</td>
      <td colspan="3"><input type="radio" name="blood7" id="hbsag163" value="�ǡ" <? if($arr5['hbs_ag']=='�ǡ'){ echo "checked='checked'"; }?> disabled/>
        �ǡ
        <input type="radio" name="blood7" id="hbsag163" value="ź"  <? if($arr5['hbs_ag']=='ź'){ echo "checked='checked'"; }?>disabled/>
        ź
  <input type="radio" name="blood7" id="hbsag163" value="����Һ" <? if($arr5['hbs_ag']=='����Һ'){ echo "checked='checked'"; }?>disabled/>
        ����Һ
  <input type="radio" name="blood7" id="hbsag33" value="������Ǩ" <? if($arr5['hbs_ag']=='������Ǩ'){ echo "checked='checked'"; }?>disabled/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.4 HBs Ab</td>
      <td colspan="3"><input type="radio" name="blood8" id="hbsab164" value="�ǡ"  <? if($arr5['hbs_ab']=='�ǡ'){ echo "checked='checked'"; }?>disabled/>
        �ǡ
        <input type="radio" name="blood8" id="hbsab164" value="ź" <? if($arr5['hbs_ab']=='ź'){ echo "checked='checked'"; }?>disabled/>
        ź
  <input type="radio" name="blood8" id="hbsab164" value="����Һ" <? if($arr5['hbs_ab']=='����Һ'){ echo "checked='checked'"; }?>disabled/>
        ����Һ
  <input type="radio" name="blood8" id="hbsab164" value="������Ǩ" <? if($arr5['hbs_ab']=='������Ǩ'){ echo "checked='checked'"; }?>disabled/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>17.</td>
      <td>�š�õ�Ǩ���ʹ�ؤ�ҡ����͹��� 6 ��ѧ�Դ�غѵ��˵�</td>
      <?
	         $sql6="select * from ic_accident_pi where ref_id='".$arr['row_id']."' and after_cbc='��͹��� 6' ";
	  		 $result6=mysql_query($sql6);
	 		 $arr6=mysql_fetch_array($result6);

	  ?>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.1 HIV Ab</td>
      <td colspan="3"><input type="radio" name="blood9" id="hivab171" value="�ǡ"  <? if($arr6['hiv_ab']=='�ǡ'){ echo "checked='checked'"; }?>disabled/>
        �ǡ
        <input type="radio" name="blood9" id="hivab171" value="ź"  <? if($arr6['hiv_ab']=='ź'){ echo "checked='checked'"; }?>disabled/>
        ź
  <input type="radio" name="blood9" id="hivab171" value="����Һ"  <? if($arr6['hiv_ab']=='����Һ'){ echo "checked='checked'"; }?>disabled/>
        ����Һ
  <input type="radio" name="blood9" id="hivab171" value="������Ǩ" <? if($arr6['hiv_ab']=='������Ǩ'){ echo "checked='checked'"; }?> disabled/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.2 HIV Ag</td>
      <td colspan="3"><input type="radio" name="blood10" id="hivag172" value="�ǡ" <? if($arr6['hiv_ag']=='�ǡ'){ echo "checked='checked'"; }?> disabled/>
        �ǡ
        <input type="radio" name="blood10" id="hivag172" value="ź"  <? if($arr6['hiv_ag']=='ź'){ echo "checked='checked'"; }?> disabled/>
        ź
  <input type="radio" name="blood10" id="hivag172" value="����Һ" <? if($arr6['hiv_ag']=='����Һ'){ echo "checked='checked'"; }?> disabled/>
        ����Һ
  <input type="radio" name="blood10" id="hivag172" value="������Ǩ"  <? if($arr6['hiv_ag']=='������Ǩ'){ echo "checked='checked'"; }?> disabled/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.3 HBs Ag</td>
      <td colspan="3"><input type="radio" name="blood11" id="hbsag173" value="�ǡ" <? if($arr6['hbs_ag']=='�ǡ'){ echo "checked='checked'"; }?> disabled/>
        �ǡ
        <input type="radio" name="blood11" id="hbsag173" value="ź" <? if($arr6['hbs_ag']=='ź'){ echo "checked='checked'"; }?> disabled/>
        ź
  <input type="radio" name="blood11" id="hbsag173" value="����Һ"  <? if($arr6['hbs_ag']=='����Һ'){ echo "checked='checked'"; }?> disabled/>
        ����Һ
  <input type="radio" name="blood11" id="hbsag173" value="������Ǩ" <? if($arr6['hbs_ag']=='������Ǩ'){ echo "checked='checked'"; }?> disabled/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.4 HBs Ab</td>
      <td colspan="3"><input type="radio" name="blood12" id="hbsab174" value="�ǡ" <? if($arr6['hbs_ab']=='�ǡ'){ echo "checked='checked'"; }?> disabled/>
        �ǡ
        <input type="radio" name="blood12" id="hbsab174" value="ź" <? if($arr6['hbs_ab']=='ź'){ echo "checked='checked'"; }?> disabled/>
        ź
  <input type="radio" name="blood12" id="hbsab174" value="����Һ"  <? if($arr6['hbs_ab']=='����Һ'){ echo "checked='checked'"; }?> disabled/>
        ����Һ
  <input type="radio" name="blood12" id="hbsab174" value="������Ǩ"  <? if($arr6['hbs_ab']=='������Ǩ'){ echo "checked='checked'"; }?> disabled/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>18.</td>
      <td>�š�õ�Ǩ���ʹ�ؤ�ҡ����͹��� 12 ��ѧ�Դ�غѵ��˵�</td>
      <?
	         $sql7="select * from ic_accident_pi where ref_id='".$arr['row_id']."' and after_cbc='��͹��� 12' ";
	  		 $result7=mysql_query($sql7);
	 		 $arr7=mysql_fetch_array($result7);

	  ?>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.1 HIV Ab</td>
      <td colspan="3"><input type="radio" name="blood13" id="hivab181" value="�ǡ"  <? if($arr7['hiv_ab']=='�ǡ'){ echo "checked='checked'"; }?> disabled/>
        �ǡ
        <input type="radio" name="blood13" id="hivab181" value="ź" <? if($arr7['hiv_ab']=='ź'){ echo "checked='checked'"; }?>  disabled/>
        ź
  <input type="radio" name="blood13" id="hivab181" value="����Һ" <? if($arr7['hiv_ab']=='����Һ'){ echo "checked='checked'"; }?> disabled/>
        ����Һ
  <input type="radio" name="blood13" id="hivab181" value="������Ǩ"  <? if($arr7['hiv_ab']=='������Ǩ'){ echo "checked='checked'"; }?> disabled/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.2 HIV Ag</td>
      <td colspan="3"><input type="radio" name="blood14" id="hivag182" value="�ǡ" <? if($arr7['hiv_ag']=='�ǡ'){ echo "checked='checked'"; }?> disabled/>
        �ǡ
        <input type="radio" name="blood14" id="hivag182" value="ź" <? if($arr7['hiv_ag']=='ź'){ echo "checked='checked'"; }?> disabled/>
        ź
  <input type="radio" name="blood14" id="hivag182" value="����Һ" <? if($arr7['hiv_ag']=='����Һ'){ echo "checked='checked'"; }?> disabled />
        ����Һ
  <input type="radio" name="blood14" id="hivag182" value="������Ǩ" <? if($arr7['hiv_ag']=='������Ǩ'){ echo "checked='checked'"; }?>  disabled/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.3 HBs Ag</td>
      <td colspan="3"><input type="radio" name="blood15" id="hbsag183" value="�ǡ"  <? if($arr7['hbs_ag']=='�ǡ'){ echo "checked='checked'"; }?> disabled/>
        �ǡ
        <input type="radio" name="blood15" id="hbsag183" value="ź"  <? if($arr7['hbs_ag']=='ź'){ echo "checked='checked'"; }?> disabled/>
        ź
  <input type="radio" name="blood15" id="hbsag183" value="����Һ"  <? if($arr7['hbs_ag']=='����Һ'){ echo "checked='checked'"; }?> disabled/>
        ����Һ
  <input type="radio" name="blood15" id="hbsag183" value="������Ǩ"  <? if($arr7['hbs_ag']=='������Ǩ'){ echo "checked='checked'"; }?> disabled/>
        ������Ǩ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.4 HBs Ab</td>
      <td colspan="3"><input type="radio" name="blood16" id="hbsab184" value="�ǡ" <? if($arr7['hbs_ab']=='�ǡ'){ echo "checked='checked'"; }?> disabled/>
        �ǡ
        <input type="radio" name="blood16" id="hbsab184" value="ź"  <? if($arr7['hbs_ab']=='ź'){ echo "checked='checked'"; }?> disabled/>
        ź
  <input type="radio" name="blood16" id="hbsab184" value="����Һ"  <? if($arr7['hbs_ab']=='����Һ'){ echo "checked='checked'"; }?> disabled/>
        ����Һ
  <input type="radio" name="blood16" id="hbsab184" value="������Ǩ"  <? if($arr7['hbs_ab']=='������Ǩ'){ echo "checked='checked'"; }?> disabled/>
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
          <td><?=$arr['19detail1'];?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="top">2. ����</td>
          <td></textarea><?=$arr['19detail2'];?></td>
        </tr>
      </table></td>
    </tr>
  </table>

</body>
</html>