<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<style>
body{
	font-family:"TH SarabunPSK";
}
.font1{ 
/*font-family:"Angsana New";*/
font-size:18pt;
font-weight:bold;
}
.font2 { /*font-family:"Angsana New";*/
font-size:16pt;
}
.font3 { /*font-family:"Angsana New";*/
font-size:16pt;
font-weight:bold;
}
</style>
<? include("connect.inc"); ?>
<body>

<? 
$sql="SELECT * FROM `refer` WHERE refer_runno='".$_GET['runno']."'  ";
$query=mysql_query($sql);
$arr=mysql_fetch_array($query);
$cHn=$arr['hn'];
$cAn=$arr['an'];
$cPtname=$arr['name'].' '.$arr['sname'];


switch ($arr['type_wound']) {
	case "P02":
	$type_wound="���� (�)";
	 break;
	case "P03":
	$type_wound="���� (��)";
	 break;
 	case "P04":
	$type_wound="���� (���)";
	 break;
	case "P05":
	$type_wound="��ͺ����";
	 break;
	case "P06":
	$type_wound= "�.��";
	 break;
	case "P07":
	$type_wound= "�.";
	 break;
	case "P08":
	$type_wound= "��Сѹ�ѧ��";
	 break;
	case "P09":
	$type_wound="30�ҷ";
	 break;
	 case "P10":
	$type_wound= "30�ҷ�ء�Թ";
	 break;
	 case "P11":
	$type_wound= "�ú.";
	 break;
	 case "P12":
	$type_wound= "��.44";
	 break;
	

}

?>
<table width="100%" border="0" >
  <tr>
    <td colspan="2" align="center" class="font1">��觵�ͼ�����</td>
  </tr>
  <tr>
    <td colspan="2" align="center" class="font1">�ç��Һ�Ť�������ѡ��������  �.�ӻҧ <hr width="50%"/></td>
  </tr>
  <tr>
    <td width="1%"  class="font3">&nbsp;</td>
    <td width="99%"  class="font3">�Ţ��� Refer : <?=$arr['refer_runno'];?> &nbsp;&nbsp;&nbsp;  �ѹ����觵�� : <?=$arr['dateopd'];?></td>
  </tr>
  <tr>
    <td class="font3">&nbsp;</td>
    <td class="font3">HN : <?=$cHn;?>&nbsp;&nbsp;&nbsp; <? if($cAn!=''){ ?>AN : <?=$cAn;  }?> ����-ʡ�� :<?=$cPtname;?> &nbsp;&nbsp;&nbsp; ���� : <?=$arr['age'];?> </td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">ID : <?=$arr['idcard'];?> &nbsp;&nbsp;&nbsp; �Է�� : <?=$type_wound;?>&nbsp;&nbsp;&nbsp; ᾷ�����ѡ�� :  <?=$arr['doctor'];?></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">Refer��� : <?=$arr['ward'];?> 
    <? /*if($arr['ward']=="opd"){ echo "��ͧ��Ǩ�ä"; }else if($arr['ward']=="opd_obg"){ echo "�ͼ������ٵ�"; }else if($arr['ward']=="opd_eye"){ echo "�ѡ��"; }else if($arr['ward']=="ER"){ echo "��ͧ�ء�Թ"; }*/?></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">�ѵػ��ʧ��/���� : <? if($arr['target_refer']==1){ echo "��֡��/�ԹԨ���"; }else if($arr['target_refer']==2){ echo "�ѡ����������觡�Ѻ"; }else if($arr['target_refer']==3){ echo "�͹����"; }?></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">����ԹԨ����ä : <span class="font21">
      <?=$arr['diag'];?>
    </span></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">�ҡ�� : <span class="font21">
      <?=$arr['organ'];?>
    </span></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">����ѡ�� : <span class="font21">
      <?=$arr['maintenance'];?>
    </span></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">���˵ء�� Refer&nbsp;: <?=$arr['exrefer'];?></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">Refer 价�� :  <? $sub=explode(" ",$arr['referh']); echo "�ç��Һ��".$sub[1]?></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">�ѭ�ҡ�� Refer&nbsp;:<?=$arr['problem_refer'];?></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">��������� Refer&nbsp;:
<? if($arr['pttype']==1){ echo "Emergency "; }else if($arr['pttype']==2){ echo "Urgent "; }else if($arr['pttype']==3){ echo "Non-Urgent  "; }?></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">����������&nbsp;:&nbsp;
    <?=$arr['list_type_patient'];?></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">���&nbsp;:  <?=$arr['refercar'];?>
</td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">�š�õԴ���������  : <?=$arr['follow_refer'];?></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">&nbsp;</td>
  </tr>
</table>
</body>
</html>